<?php 

    require_once ("../include/dbsetting/lms_vars_config.php");
	require_once ("../include/dbsetting/classdbconection.php");
	require_once ("../include/functions/functions.php");
	$dblms = new dblms();
 	date_default_timezone_set("Asia/Karachi");


    header('Content-Type: application/json');

    $json_data = file_get_contents('php://input');
    // $json_data = '{"isSuccess":true,"responseCode":200,"message":"Transaction status retrieved successfully","responseData":{"billNo":"d04a398344b7194bd3798","paymentMsgId":"BAFLP2M656d04a398344b7194bd3798","currency":"PKR","amount":14300,"status":"success","otherInfo":{"challan_no":"99302661991","customerName":"Rida Fatima"}}}';

    if(empty($json_data)) {
        http_response_code(400);
        echo json_encode(['status' => '400', 'description' => 'No data received.']);
        exit();
    }

    $data = json_decode($json_data, true);

    if($data === null) { 
        http_response_code(400);
        echo json_encode(['status' => '400', 'description' => 'Invalid JSON format.']);
        exit();
    }

    $respData = $data['responseData'] ?? null;

    if(!$respData || empty($respData['billNo']) || empty($respData['status']) || empty($respData['otherInfo']['challan_no'])) {
        http_response_code(400);
        echo json_encode(['status' => '400', 'description' => 'Missing required data in payload (billNo, status, or challan_no).']);
        error_log("Error: Missing data in payload. Payload: ".print_r($data, true));
        exit();
    }


    // CHECK RAAST QR DETAILS
    $conditions = array ( 
								'select' 		=> 'id', 
								'where' 		=> array ( 
															 'status'       =>'2'
															,'challan_no'   =>$respData['otherInfo']['challan_no']
														 ), 
								'return_type' 	=> 'count' 
							); 
    $rowchecked 	= $dblms->getRows(RAAST_QR_DETAILS, $conditions);




    $requests = json_encode($data); 
    if($respData['status'] === 'success' && $rowchecked > 0) { 


        // UPDATE RAAST QR DETAILS
        $dataQRDetails = array(
                                  'status'                  => 1
                                , 'detail'			        => $data['message']
                                , 'payment_response'		=> json_encode($data)
                                , 'payment_response_date'	=> date("Y-m-d H:i:s")			
                            );
        $qryUpdateQRDetails = $dblms->Update(RAAST_QR_DETAILS, $dataQRDetails, "WHERE challan_no = '".$respData['otherInfo']['challan_no']."' ORDER BY id DESC LIMIT 1");


        $sqllmschallan	= $dblms->querylms("SELECT f.status, f.id_type, f.yearmonth, f.challan_no, f.id_std, f.due_date, f.paid_date, f.total_amount, f.paid_amount, f.id_campus, f.id_month,  
                                            cls.class_name, cm.campus_customercode, std.std_name, std.std_regno, std.std_phone, std_whatsapp,
                                            std.std_rollno, q.name, q.form_no, q.cell_no, don.donor_name, donor_phone
                                            FROM ".FEES." f
                                            LEFT JOIN ".CLASSES."  cls ON cls.class_id 	= f.id_class 
                                            LEFT JOIN ".STUDENTS." std ON std.std_id 	= f.id_std 
                                            LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no	= f.inquiry_formno 
                                            LEFT JOIN ".DONORS."   don ON don.donor_id 	= f.id_donor
                                            INNER JOIN ".CAMPUS." cm ON cm.campus_id = f.id_campus  
                                            WHERE f.challan_no	= '".cleanvars($respData['otherInfo']['challan_no'])."' 
                                            AND f.is_deleted	= '0'  LIMIT 1");

        if(mysqli_num_rows($sqllmschallan) == 1){
            //Fetch Query Data
            $rowchallan = mysqli_fetch_array($sqllmschallan);

            // CHECK CHALLAN TYPE(ADMISSION, DONATION, FEE)
            if($rowchallan['id_type'] == 2){
                // FETCH LATEST CHALLAN
                $sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
                                        FROM ".FEES." f						 
                                        INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
                                        WHERE f.id_type		= '2'
                                        AND f.is_deleted	= '0'
                                        AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
                                        AND st.is_deleted	= '0'
                                        ORDER BY f.id DESC LIMIT 1");
                $valuesqllmscheck = mysqli_fetch_array($sqllmscheck);
                // FETCH LATEST CHALLAN END
            }else{
                $valuesqllmscheck['challan_no'] = $rowchallan['challan_no'];
            }
            
            $customercode = $rowchallan['campus_customercode'];

            //Check Type of Challan
            if($rowchallan['id_type'] == 3) {
                // If Donation Challan
                $name = $rowchallan['donor_name'];
                $phone = '92'.str_replace('-', '', ltrim($rowchallan['donor_phone'], '0'));
                $message = 'Dear '.$name.',\n\nYour donation challan # '.cleanvars($rowchallan['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
                $class = "Null";
                $regno = "Null";
                $rollno = "Null";

            }elseif($rowchallan['id_type'] == 2){
                $sqllmsInquiry	= $dblms->querylms("SELECT name
                                                        FROM ".ADMISSIONS_INQUIRY." 
                                                        WHERE form_no = '".cleanvars($rowchallan['form_no'])."'
                                                        AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
                                                        AND is_deleted != '1' LIMIT 1");
                $stdData = mysqli_fetch_array($sqllmsInquiry);
                // If Fee Challan
                $name = $rowchallan['std_name'];
                $phone = '92'.str_replace('-', '', ltrim($rowchallan['std_whatsapp'], '0'));

                $message =  "Dear " . $stdData['name'] . "\n" .
                            "Your Fee Challan No " . $rowchallan['challan_no'] . " Rs. " . number_format($respData['amount']) . "/ Month of " . get_monthtypes($rowchallan['id_month']) . "-" . date('Y') . " has been paid Dated " . date('d-m-Y') . ".\n\n" .
                            "https://aghosh.gptech.pk/feechallanprintwa.php?id=" . $rowchallan['challan_no'] . "\n\n" .
                            "Thanks for your Payment\n\n" .
                            "Regards:\n" .
                            "Accounts Department\n" .
                            "Aghosh Complex";
                                            
                $class = $rowchallan['class_name'];

                if($rowchallan['std_regno']) { 
                    $regno = $rowchallan['std_regno'];
                }else{
                    $regno = "Null";	
                }
                
                if($rowchallan['std_rollno']){
                    $rollno = $rowchallan['std_rollno'];
                }else{
                    $rollno = "Null";
                }

            }else{
                // If Admission Challan
                $name = $rowchallan['name'];
                $phone = '92'.str_replace('-', '', ltrim($rowchallan['cell_no'], '0'));
                $message =  'Dear '.$name.',
                            Your Fee Challan No '.$rowchallan['challan_no'].' Rs. '.number_format(($respData['amount'])).'/ Month of '.get_monthtypes($rowchallan['id_month']).' '.date('Y').'. has been paid, dated '.date('d-m-Y').'.

                            https://aghosh.gptech.pk/feechallanprintwa.php?id='.$rowchallan['challan_no'].'

                            Thanks for your Payment

                            Regards:
                            Accounts Department
                            Aghosh Complex';
                $class = $rowchallan['class_name'];
                $regno = $rowchallan['form_no'];
                $rollno = "Null";

            }

            //Grand Total with Previous Month
            $grandTotal = 0;
            foreach($monthtypes as $month):
                if($rowchallan['id_month']==$month['id']){

                    $amount = $rowchallan['total_amount'] - $rowchallan['paid_amount'];

                }else{
                    $sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.challan_no, f.id_std,
                                                        f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
                                                        FROM ".FEES." f
                                                        WHERE f.id_month	= '".cleanvars($month['id'])."'
                                                        AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
                                                        AND (f.status = '2' OR f.status = '4')
                                                        AND f.id_type		= '2'
                                                        AND f.is_deleted	= '0' LIMIT 1");
                    if(mysqli_num_rows($sqlnarration)>0){
                        $valnarration = mysqli_fetch_array($sqlnarration);

                        $amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

                        if($valnarration['due_date'] < date('Y-m-d')){
                            $amount = $amount + LATEFEE;
                        }
                    }else{
                        $amount = 0;
                    }
                }
                $grandTotal = $grandTotal + $amount;
            endforeach;

            $transamount = $respData['amount'];

            $lastdate	= date ("Y-m-d", strtotime("+15 day", strtotime($rowchallan['due_date'])));

            if($rowchallan['due_date'] >= date("Y-m-d")){
                $dueamount = ($grandTotal);
            }else{
                $dueamount = ($grandTotal + LATEFEE);
            }

            if($rowchallan['status'] == '2' && $valuesqllmscheck['challan_no'] != $rowchallan['challan_no']){


                http_response_code(400);
                echo json_encode(['status' => '400', 'description' => 'Chalan Number Not Matched with Latest Challan.']);
                exit();

            }elseif($rowchallan['status'] == '1' && $rowchallan['paid_date'] != '0000-00-00'){

                http_response_code(400);
                echo json_encode(['status' => '400', 'description' => 'Chalan is already paid']);
                exit();


            }elseif(($rowchallan['status'] == '2' && $rowchallan['status'] == '4') && ($dueamount != $transamount)){

                http_response_code(400);
                echo json_encode(['status' => '400', 'description' => 'General Exception']);
                exit();

            }elseif($rowchallan['status'] != '1' && $valuesqllmscheck['challan_no'] == $rowchallan['challan_no']){

                $totalrecived = 0; 
                
                // Add API Trans
                $sqllmstrans  = $dblms->querylms("INSERT INTO ".PAY_API_TRAN." (
                                                                        status
                                                                    , customer_code
                                                                    , branch_code
                                                                    , challan_no
                                                                    , trans_id
                                                                    , trans_amount
                                                                    , trans_currency
                                                                    , trans_date
                                                                    , date_added
                                                                )
                                                        VALUES (
                                                                        '1'
                                                                    , 'AGSTS'
                                                                    , 'RAAST QR'
                                                                    , '".cleanvars($respData['otherInfo']['challan_no'])."'
                                                                    , '".cleanvars($respData['paymentMsgId'])."'
                                                                    , '".cleanvars($transamount)."'
                                                                    , '".cleanvars($respData['currency'])."'
                                                                    , '".date('Y-m-d')."'
                                                                    , NOW()
                                                                )
                                                ");

                // Add Income
                $incomeRemarks = 'Fee Pay Through RAAST QR';								
                $sqllmsIncome = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
                                                                        trans_status 
                                                                    , trans_title
                                                                    , trans_type
                                                                    , trans_amount
                                                                    , voucher_no
                                                                    , trans_method
                                                                    , trans_note
                                                                    , dated
                                                                    , id_head
                                                                    , id_campus  
                                                                    , date_added 	
                                                                )
                                                            VALUES(
                                                                        '1'		                                    							 
                                                                    , '".cleanvars($respData['otherInfo']['challan_no'])."'
                                                                    , '1'
                                                                    , '".cleanvars($transamount)."'
                                                                    , '".cleanvars($respData['otherInfo']['challan_no'])."'
                                                                    , '7'
                                                                    , '".cleanvars($incomeRemarks)."'
                                                                    , '".date('Y-m-d')."'
                                                                    , '1'
                                                                    , '".cleanvars($rowchallan['id_campus'])."'
                                                                    , NOW()	
                                                                )"
                                                );
                    
                if($transamount >= $grandTotal){

                    $totaltransamount = $transamount;

                    $sqlnar  = $dblms->querylms("SELECT f.id, f.challan_no, f.total_amount, f.paid_amount, f.due_date
                                                    FROM ".FEES." f
                                                    WHERE f.yearmonth	< '".cleanvars($rowchallan['yearmonth'])."'
                                                    AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
                                                    AND (f.status = '2' OR f.status ='4')
                                                    AND f.id_type		= '2'
                                                    AND f.is_deleted	= '0'
                                                ");
                    if(mysqli_num_rows($sqlnar)>0){
                        while($rownar = mysqli_fetch_array($sqlnar)){
                            $payable = $rownar['total_amount'] - $rownar['paid_amount'];

                            if($rownar['due_date']<date('Y-m-d')){
                                $payable = $payable + LATEFEE;
                            }
                            
                            $final_paid = $payable + $rownar['paid_amount'];

                            // Update Previous pending Challans as Paid
                            $sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
                                                                            status			= '1'
                                                                            , paid_amount		= '".cleanvars($final_paid)."'
                                                                            , paid_date			= '".date('Y-m-d')."'
                                                                            , pay_mode			= '7' 
                                                                            , date_modify		= NOW()
                                                                            WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
                                                                    ");
                            if($sqllmsUpdatePrev){
                                $totaltransamount = $totaltransamount - $payable;
                            }
                        }
                    }

                    // Update Current Month Challan as Paid
                    $sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
                                                                status    	= '1'
                                                                , paid_date		= '".date('Y-m-d')."'
                                                                , paid_amount	= '".cleanvars($totaltransamount)."'
                                                                , pay_mode		= '7' 
                                                                , date_modify	= NOW()
                                                                WHERE challan_no	= '".$rowchallan['challan_no']."' "
                                                    );
                    
                    if($sqllmsupdate){
                        // Check If Record Not Exist
                        $sqllmsCheckStd	= $dblms->querylms("SELECT std_id
                                                                FROM ".STUDENTS." 
                                                                WHERE admission_formno = '".cleanvars($rowchallan['form_no'])."'
                                                                AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
                                                                AND is_deleted != '1' LIMIT 1");
                        if(mysqli_num_rows($sqllmsCheckStd) < 1) {
                            
                            // Get Inquiry Details
                            $sqllmsInquiry	= $dblms->querylms("SELECT name, fathername, cnicno, gender, cell_no, address, id_class, is_hostelized, is_orphan
                                                                    FROM ".ADMISSIONS_INQUIRY." 
                                                                    WHERE form_no = '".cleanvars($rowchallan['form_no'])."'
                                                                    AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
                                                                    AND is_deleted != '1' LIMIT 1");
                            $valueInquiry = mysqli_fetch_array($sqllmsInquiry);

                            // Date Conversion
                            $admissiondate = date('Y-m-d');
                            $admission_year = date('Y');
                            
                            //For Campus Short Code
                            $sqllmsCampus = $dblms->querylms("SELECT campus_code FROM ".CAMPUS." WHERE campus_id = '".cleanvars($rowchallan['id_campus'])."' LIMIT 1");
                            $valueCampus = mysqli_fetch_array($sqllmsCampus);
                            // For Class Code
                            $sqllmsClass = $dblms->querylms("SELECT class_code FROM ".CLASSES." WHERE class_id = '".cleanvars($valueInquiry['id_class'])."' LIMIT 1");
                            $valueClass = mysqli_fetch_array($sqllmsClass);
                            // For Current Admission Session
                            $sqllmsSession = $dblms->querylms("SELECT se.session_id, se.session_name
                                                                    FROM ".SESSIONS." se
                                                                    INNER JOIN ".SETTINGS." st ON st.adm_session = se.session_id
                                                                    WHERE se.session_status = '1' AND st.status = '1' AND st.is_deleted != '1' LIMIT 1");
                            $valueSession = mysqli_fetch_array($sqllmsSession);

                            // Roll No
                            $newRollno = 0;
                            $sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
                                                            FROM ".STUDENTS."
                                                            WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                            AND id_class = '".$valueInquiry['id_class']."'");
                            if(mysqli_num_rows($sqllmsRoll) > 0 ){
                                $valueRoll = mysqli_fetch_array($sqllmsRoll);
                                (int)$valueRoll['rollno'];
                                $newRollno = (int)$valueRoll['rollno'] + 1;
                            }
                            else{
                                $newRollno = 1;
                            }

                            // Reg No
                            $chkregno = $admission_year.'-'.$campus_code.'-';
                            $sqllmsCheck	= $dblms->querylms("SELECT std_id, std_regno
                                                                        FROM ".STUDENTS."
                                                                        WHERE std_regno LIKE '".$chkregno."%'
                                                                        ORDER BY std_regno DESC LIMIT 1");
                            if(mysqli_num_rows($sqllmsCheck)>0){
                                $valueCheck = mysqli_fetch_array($sqllmsCheck);
                                $regno = $valueCheck['std_regno'];
                                $regno++;
                            }else{
                                $regno = $admission_year.'-'.$campus_code.'-000001';
                            }
                            // Remove Spaces
                            $regno = str_replace(" ","", $regno);
                            // Reg No

                            // Insert Student
                            $sqllmsStd = $dblms->querylms("INSERT INTO ".STUDENTS."(
                                                                        std_status 
                                                                    , std_name
                                                                    , std_fathername  
                                                                    , std_gender  
                                                                    , id_country
                                                                    , std_phone 
                                                                    , std_address
                                                                    , is_orphan 
                                                                    , is_hostelized 
                                                                    , id_class  
                                                                    , id_session  
                                                                    , std_rollno  
                                                                    , std_regno  
                                                                    , admission_formno
                                                                    , std_admissiondate
                                                                    , id_campus
                                                                    , id_added  
                                                                    , date_added															
                                                                )
                                                            VALUES(
                                                                        '1' 
                                                                    , '".cleanvars($valueInquiry['name'])."'
                                                                    , '".cleanvars($valueInquiry['fathername'])."'
                                                                    , '".cleanvars($valueInquiry['gender'])."' 
                                                                    , '1'
                                                                    , '".cleanvars($valueInquiry['cell_no'])."' 
                                                                    , '".cleanvars($valueInquiry['address'])."' 
                                                                    , '".cleanvars($valueInquiry['is_orphan'])."' 
                                                                    , '".cleanvars($valueInquiry['is_hostelized'])."' 
                                                                    , '".cleanvars($valueInquiry['id_class'])."'
                                                                    , '".cleanvars($valueSession['session_id'])."' 
                                                                    , '".cleanvars($newRollno)."' 
                                                                    , '".cleanvars($regno)."' 
                                                                    , '".cleanvars($rowchallan['form_no'])."' 
                                                                    , '".$admissiondate."'
                                                                    , '".cleanvars($rowchallan['id_campus'])."'
                                                                    , '4'
                                                                    , NOW()
                                                                )");

                            $std_id = $dblms->lastestid();

                            // Enrolled In Hostel
                            if($valueInquiry['is_hostelized'] == '1'){

                                $sqllmsHostel = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
                                                                                    status 
                                                                                , id_std
                                                                                , joining_date 
                                                                                , id_campus
                                                                                , id_added
                                                                                , date_added
                                                                            )
                                                                        VALUES(
                                                                                    '1' 
                                                                                , '".cleanvars($std_id)."'
                                                                                , '".cleanvars($admissiondate)."'
                                                                                , '".cleanvars($rowchallan['id_campus'])."'
                                                                                , '4'
                                                                                , Now()
                                                                            )" );
                            }

                            // Make Parent Login
                            $fatherCNIC = $valueInquiry['cnicno'];
                            $pass = "ags@786";

                            if(!empty($fatherCNIC)){
                                $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

                                $password = hash('sha256', $pass.$salt);
                                for($round=0;$round<65536;$round++){
                                    $password = hash('sha256', $password.$salt);
                                }

                                // Check if parent login already exists
                                $sqllmscheck = $dblms->querylms("
                                    SELECT adm_id, is_deleted 
                                    FROM sms_admins 
                                    WHERE adm_username = '".$fatherCNIC."' 
                                    AND adm_logintype = 4 
                                    LIMIT 1
                                ");

                                if(mysqli_num_rows($sqllmscheck)){
                                    $row = mysqli_fetch_array($sqllmscheck);
                                    $parentLoginID = $row['adm_id'];

                                    // Restore deleted parent account
                                    if($row['is_deleted'] == 1){
                                        $dblms->querylms("
                                            UPDATE sms_admins 
                                            SET is_deleted = 0, adm_status = 1, adm_userpass = '".$password."', adm_salt = '".$salt."', date_modify = NOW(), id_modify = '".$_SESSION['userlogininfo']['LOGINIDA']."'
                                            WHERE adm_id = '".$parentLoginID."'
                                        ");
                                    }
                                    else{
                                        $_SESSION['msg']['title'] 	= 'Error';
                                        $_SESSION['msg']['text'] 	= 'Parent login already exists for CNIC: '.$fatherCNIC;
                                        $_SESSION['msg']['type'] 	= 'error';
                                    }

                                } else {

                                    // Create Parent Login
                                    $dblms->querylms("
                                        INSERT INTO sms_admins(
                                            adm_status, adm_logintype, adm_username, adm_salt, adm_userpass,
                                            adm_fullname, adm_phone, id_campus, date_added, id_added
                                        ) VALUES(
                                            1, 4, '".$fatherCNIC."', '".$salt."', '".$password."',
                                            '".(!empty($valueInquiry['fathername']) ? $valueInquiry['fathername'] : 'Parent Account')."', '".$valueInquiry['cell_no']."', '".$_SESSION['userlogininfo']['LOGINCAMPUS']."', NOW(), '".$_SESSION['userlogininfo']['LOGINIDA']."'
                                        )
                                    ");

                                    $parentLoginID = $dblms->lastestid();
                                }

                                // 🔥 UPDATE ALL STUDENTS WITH SAME FATHER CNIC
                                $dblms->querylms("
                                    UPDATE sms_students 
                                    SET id_loginid = '".$parentLoginID."'
                                    WHERE std_fathercnic = '".$fatherCNIC."'
                                ");
                            }
                            $phone = '92'.str_replace('-', '', ltrim($valueInquiry['cell_no'], '0'));
                            $data['message'] = "Dear ".$valueInquiry['name'].",\n\n"
                            . "Welcome to Aghosh Complex! 🎉\n\n"
                            . "Thank you for joining us. We’re not just a school — we’re a family.\n\n"
                            . "At Aghosh Complex, Education and Character Building are our core values and top priority.\n\n"
                            . "Please join our official WhatsApp group for regular updates.\n\n"
                            . "https://www.whatsapp.com/channel/0029VagSuUsKWEKl4Zod8x3d"
			                . "\n\n"
                            . "Aghosh Complex\n\n"
                            . "Parents Portal Details:\n\n"
                            . "Link: https://aghosh.gptech.pk/\n\n"
                            . "Username: ".$fatherCNIC."\n"
                            . "Password: ".$pass."\n\n"
                            . "Regards,\n"
                            . "Aghosh Complex";
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL             => WA_URL,
                                CURLOPT_RETURNTRANSFER  => true,
                                CURLOPT_ENCODING        => '',
                                CURLOPT_MAXREDIRS       => 10,
                                CURLOPT_TIMEOUT         => 0,
                                CURLOPT_FOLLOWLOCATION  => true,
                                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST   => 'POST',
                                CURLOPT_POSTFIELDS      => array(
                                                                    'api_key' => WA_APPKEY
                                                                    , 'sender'  => WA_SENDER
                                                                    , 'number'  => $phone
                                                                    , 'message' => $data['message']
                                                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);
                            $responseArray = json_decode($response, true);

                            // Make Log
                            $remarks = 'Admission Fee Paid through Finja, Record Added In Student.';
                            $sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
                                                                                    id_user 
                                                                                , action
                                                                                , challan_no
                                                                                , dated
                                                                                , ip
                                                                                , remarks 
                                                                                , id_campus				
                                                                            )
                                                                        VALUES(
                                                                                    '4'
                                                                                , '1' 
                                                                                , '".cleanvars($rowchallan['challan_no'])."'
                                                                                , NOW()
                                                                                , '".cleanvars($ip)."'
                                                                                , '".cleanvars($remarks)."'
                                                                                , '".cleanvars($rowchallan['id_campus'])."'			
                                                                            )");
                        }
                        
                    }
                                                            
                    //if challan paid successfully
                    if($sqllmsupdate){ 


                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL             => WA_URL,
                            CURLOPT_RETURNTRANSFER  => true,
                            CURLOPT_ENCODING        => '',
                            CURLOPT_MAXREDIRS       => 10,
                            CURLOPT_TIMEOUT         => 0,
                            CURLOPT_FOLLOWLOCATION  => true,
                            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST   => 'POST',
                            CURLOPT_POSTFIELDS      => array(
                                                                  'api_key' => WA_APPKEY
                                                                , 'sender'  => WA_SENDER
                                                                , 'number'  => $phone
                                                                , 'message' => $message
                                                            ),
                        ));

                        $response = curl_exec($curl);
                        echo $response;
                        curl_close($curl);
                        $responseArray = json_decode($response, true);

                        
                        http_response_code(200);
                        echo json_encode(["status" => "200", 'description' => 'Challan Status Updated']);
                        
                    }
                }else{

                    http_response_code(400);
                    echo json_encode(['status' => '400', 'description' => 'General Exception']);
                    exit();

                }
            }else{

                http_response_code(400);
                echo json_encode(['status' => '400', 'description' => 'General Exception']);
                exit();
                
            }
        }

    } else { 

        http_response_code(200);
        echo json_encode(["status" => "200", 'description' => 'Challan Status Not Updated (payment failed)']);
    }

    exit();

?>