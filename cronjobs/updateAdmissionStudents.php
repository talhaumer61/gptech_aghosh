<?php

require_once("../include/dbsetting/lms_vars_config.php");
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");
$dblms = new dblms();


$sqllmsAdmissionStudents = $dblms->querylms("SELECT inq.*, f.paid_date
                                                FROM ".ADMISSIONS_INQUIRY." inq
                                                INNER JOIN ".FEES." f ON f.inquiry_formno = inq.form_no
                                                WHERE NOT EXISTS(
                                                                    SELECT s.std_id
                                                                    FROM ".STUDENTS." s
                                                                    WHERE s.admission_formno = inq.form_no
                                                                    AND s.is_deleted = '0'
                                                                )
                                                AND f.status        IN (1,4)
                                                AND f.id_type       = '1'
                                                AND f.is_deleted    = '0'
                                                AND inq.is_deleted  = '0'
                                            ");
while($row = mysqli_fetch_array($sqllmsAdmissionStudents)) {

    // Date Conversion
    $admissiondate = date('Y-m-d');
    $admission_year = date('Y');

    //For Campus Short Code
    $sqllmsCampus = $dblms->querylms("SELECT campus_code 
                                        FROM ".CAMPUS." 
                                        WHERE campus_id = '".cleanvars($row['id_campus'])."' 
                                        LIMIT 1
                                    ");
    $valueCampus = mysqli_fetch_array($sqllmsCampus);
    $campus_code = $valueCampus['campus_code'];

    // For Class Code
    $sqllmsClass = $dblms->querylms("SELECT class_code 
                                        FROM ".CLASSES." 
                                        WHERE class_id = '".cleanvars($row['id_class'])."' 
                                        LIMIT 1
                                    ");
    $valueClass = mysqli_fetch_array($sqllmsClass);


        $id_session   = $row['id_session'];

    

    //Roll No 
    $newRollno = 0;
    $sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
                                    FROM ".STUDENTS."
                                    WHERE id_campus = '".$row['id_campus']."'
                                    AND id_class    = '".$row['id_class']."'");
    if(mysqli_num_rows($sqllmsRoll) > 0 ){
        $valueRoll = mysqli_fetch_array($sqllmsRoll);
        (int)$valueRoll['rollno'];
        $newRollno = (int)$valueRoll['rollno'] + 1;
    }
    else{
        $newRollno = 1;
    }

	//---------------- Reg No -----------------
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

    // Insert Student
    $sqllms  = $dblms->querylms("INSERT INTO ".STUDENTS."(
                                                          std_status 
                                                        , std_name
                                                        , std_fathername  
                                                        , std_gender  
                                                        , id_guardian  
                                                        , std_dob  
                                                        , id_country 
                                                        , std_nic   
                                                        , std_whatsapp 
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
                                                        , '".cleanvars($row['name'])."'
                                                        , '".cleanvars($row['fathername'])."'
                                                        , '".cleanvars($row['gender'])."' 
                                                        , '".cleanvars($row['guardian'])."' 
                                                        , '".cleanvars($row['dob'])."'
                                                        , '1' 
                                                        , '".cleanvars($row['cnicno'])."' 
                                                        , '".cleanvars($row['cell_no'])."' 
                                                        , '".cleanvars($row['address'])."' 
                                                        , '".cleanvars($row['is_orphan'])."' 
                                                        , '".cleanvars($row['is_hostelized'])."' 
                                                        , '".cleanvars($row['id_class'])."' 
                                                        , '".cleanvars($id_session)."' 
                                                        , '".cleanvars($newRollno)."' 
                                                        , '".cleanvars($regno)."' 
                                                        , '".cleanvars($row['form_no'])."' 
                                                        , '".$admissiondate."' 
                                                        , '".cleanvars($row['id_campus'])."'
                                                        , '4'
                                                        , NOW()
                                                    )");  
                                                   
    $std_id = $dblms->lastestid();  
			
    // Enrolled In Hostel
    if($row['is_hostelized'] == '1'){

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
                                                        , '".cleanvars($row['id_campus'])."'
                                                        , '4'
                                                        , Now()
                                                    )" );
    }

    // Make Parent Login
    $fatherCNIC = $row['cnicno'];
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
                    '".(!empty($row['fathername']) ? $row['fathername'] : 'Parent Account')."', '".$row['cell_no']."', '".$_SESSION['userlogininfo']['LOGINCAMPUS']."', NOW(), '".$_SESSION['userlogininfo']['LOGINIDA']."'
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
    $phone = '92'.str_replace('-', '', ltrim($row['cell_no'], '0'));
    $data['message'] = "Dear ".$row['name'].",\n\n"
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
}
?>