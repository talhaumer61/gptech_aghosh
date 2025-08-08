<?php 

//Add Bank Deposit Record
if(isset($_POST['submit_bank_deposit'])) {

	$queryCheck = $dblms->querylms("SELECT id 
										FROM ".FEES_COLLECTION_BANK_DEPOSIT."
										WHERE deposit_slip = '".cleanvars($_POST['deposit_slip'])."'
										AND is_deleted = '0'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'");
	if(mysqli_num_rows($queryCheck) == 1) {
		
		// Set Error MSG in Session
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Deposit Slip already exists.';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: ".$_SERVER['HTTP_REFERER']."", true, 301);
		exit();

	} else {

		$depositDate = date('Y-m-d', strtotime(cleanvars($_POST['date'])));

		$data = array(
						  'id_bank'	        => cleanvars($_POST['id_bank'])
						, 'id_dept'	        => cleanvars($_POST['id_dept'])
						, 'payeee'			=> cleanvars($_POST['payeee'])
						, 'expense_head'	=> cleanvars($_POST['expense_head'])
						, 'yearlysrno'		=> cleanvars($_POST['yearlysrno'])
						, 'deposit_slip'	=> cleanvars($_POST['deposit_slip'])
						, 'amount'		    => cleanvars($_POST['amount'])
						, 'date'		    => $depositDate
						, 'remarks'		    => cleanvars($_POST['remarks'])
						, 'id_campus'	    => cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
						, 'id_added'	    => cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						, 'date_added'		=> date("Y-m-d H:i:s")
					);

		$queryInsert = $dblms->Insert(FEES_COLLECTION_BANK_DEPOSIT, $data);

		if($queryInsert) {

			//Set Success MSG in Session
			// Set Error MSG in Session
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record has been added successfully.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: feecollections.php?view=bankdeposit", true, 301);
			exit();
		}
	}
}

//	Delete record
if(isset($_GET['deleteid'])){ 
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".FEES_COLLECTION." SET  
												  is_deleted		= '1'
												, date_deleted		= NOW()
												  WHERE id	= '".cleanvars($_GET['deleteid'])."'");
	//--------------------------------------
	if($sqllms){ 
		$sqllmsfee  = $dblms->querylms("UPDATE ".FEES." SET  
												  status			= '2'
												, paid_date			= '0000-00-00'
												, paid_amount		= '0'
												  WHERE id IN (".cleanvars($_GET['challano']).")");
		//-------------------- Make Log ------------------------
		$remarks = 'Fee Challan Deleted #: "'.cleanvars($_GET['deleteid']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																id_user 
															, filename 
															, action
															, challan_no
															, dated
															, ip
															, remarks 
															, id_campus				
														)
		
													VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
															, '3' 
															, '".cleanvars($_GET['deleteid'])."'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														)
									");

		
		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: $requestedPage", true, 301);
		exit();
	}
	//--------------------------------------
}



//	Add Payment Fee Challan
if(isset($_POST['challan_cashpay'])){
	
	$queryCheck = $dblms->querylms("SELECT challan_no 
										FROM ".FEES_COLLECTION."
										WHERE challan_no = '".cleanvars($_POST['challanno'])."'
										AND is_deleted = '0'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'");
	if(mysqli_num_rows($queryCheck) == 1) {		
		// Set Error MSG in Session
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Challan already Paid.';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: ".$_SERVER['HTTP_REFERER']."", true, 301);
		exit();
	} else {
		if(!empty($_POST['paid_date'])){
			$paidDate = date('Y-m-d' , strtotime($_POST['paid_date']));
		}else{
			$paidDate = date('Y-m-d');
		}


        if($_POST['whatsappno']) {
            $msgs = 'Dear '.($_POST['stdname']).'
				Your Fee Challan No '.$_POST['challanno'].' Rs. '.number_format($_POST['totaltransamount']).'/ Month of '.$_POST['monthname'].'-'.date('Y' , strtotime($paidDate)).' has been paid Dated '.date('d-m-Y' , strtotime($paidDate)).'.

				https://aghosh.gptech.pk/feechallanprintwa.php?id='.$_POST['challanno'].'

				Thanks for your Payment

				Regards:
				Accounts Department
				Aghosh Complex';
            // whatsapp message
            $datawa = array(
                                   'status'         => 0
                                , 'dated'           => $paidDate
                                , 'challanno'       => ($_POST['challanno'])
                                , 'amount'          => $_POST['totaltransamount']
                                , 'cellno'          => ($_POST['whatsappno'])
                                , 'message_type'    => 3
                                , 'message'         => $msgs
            );
            $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);

        }
	
		$challandate = date('Ym');
	 	$sqllmsfee 	= $dblms->querylms("SELECT yearlysrno 
										FROM ".FEES_COLLECTION." 
										WHERE recepit_no LIKE '".$_POST['classgroup']."-%' 
										AND yearlysrno LIKE '".$challandate."%' 
										ORDER by yearlysrno DESC LIMIT 1 ");
		$rowfeeid 	= mysqli_fetch_array($sqllmsfee);

		if($rowfeeid['yearlysrno']<1) {
			$yearlysrno	= $challandate.'00001';
		} else  {
			$yearlysrno = ($rowfeeid['yearlysrno'] +1);
		}
		
		$arraychecked = $_POST['id_fee'];
	
		// FULL PAYMENT		
		$data = array(
						 'status'		            => 1 
						,'type'		            	=> 1 
						,'dated'					=> date("Y-m-d") 
						,'yearlysrno'	        	=> $yearlysrno
						,'recepit_no'	        	=> $_POST['classgroup']."-".$yearlysrno 
						,'id_fee'	        		=> cleanvars(implode(',', $_POST['id_fee']))
						,'challan_no'	        	=> cleanvars($_POST['challanno'])
						,'total_amount'		        => cleanvars($_POST['totaltransamount'])
						,'pay_mode'		        	=> cleanvars($_POST['pay_mode'])
						,'id_head'		       		=> 1 
						,'id_sub_head'		       	=> 1 
						,'remarks'		        	=> cleanvars($_POST['note']) 
						,'id_session'	       		=> cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION']) 
						,'id_campus'				=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS']) 
						,'id_added'	        		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA']) 
						,'date_added'		        => date("Y-m-d H:i:s") 
					);
		$queryInsert = $dblms->Insert(FEES_COLLECTION, $data);

		for($ichk=0; $ichk<sizeof($arraychecked); $ichk++){ 
			//------------ Update Previous pending Challans as Paid ----------------
			$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
														  status			= '1'
														, paid_amount		= '".cleanvars($_POST['amount'][$ichk])."'
														, paid_date			= '".cleanvars($paidDate)."'
														, pay_mode			= '".cleanvars($_POST['pay_mode'])."'
														, note				= '".cleanvars($_POST['note'])."'
														, date_modify		= NOW()
														  WHERE id			= '".cleanvars($_POST['id_fee'][$ichk])."'
												");
			$remarks = 'Fee Challan Paid';

			//-------------------- Make Log ------------------------
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																	id_user 
																, filename 
																, action
																, challan_no
																, dated
																, ip
																, remarks 
																, id_campus				
															)
			
														VALUES(
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '3'
																, '".cleanvars($_POST['challan_no'][$ichk])."'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															)
										");
		}

		// check student exist in case of admisison challan
		if($_POST['id_type'] == 1){
			$sqllmsAdmissionStudents = $dblms->querylms("SELECT inq.*, f.paid_date
                                                FROM ".ADMISSIONS_INQUIRY." inq
                                                INNER JOIN ".FEES." f ON f.inquiry_formno = inq.form_no
                                                WHERE NOT EXISTS(
                                                                    SELECT s.std_id
                                                                    FROM ".STUDENTS." s
                                                                    WHERE s.admission_formno = inq.form_no
                                                                    AND s.is_deleted = '0'
                                                                )
                                                AND f.status        = '1'
                                                AND f.id_type       = '1'
                                                AND f.is_deleted    = '0'
                                                AND inq.is_deleted  = '0'
												AND f.challan_no	= '".cleanvars($_POST['challanno'])."'
                                            ");
			$row = mysqli_fetch_array($sqllmsAdmissionStudents);

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
			} else {
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
			} else {
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
																, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA']) ."'
																, NOW()
															)
										");  														   
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
		
			// Make Login
			// password salt
			$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		
			// Password
			$pass = 'ags786';
		
			// hash password
			$password = hash('sha256', $pass . $salt);
			for($round = 0; $round < 65536; $round++) {
				$password = hash('sha256', $password . $salt);
			}
		
			// Insert
			$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
															  adm_status  
															, adm_type
															, adm_logintype 
															, adm_username 
															, adm_salt
															, adm_userpass
															, adm_fullname
															, adm_phone
															, id_campus
															, id_added
															, date_added
														)
													VALUES(
															  '1'
															, '0'
															, '5'
															, '".cleanvars($regno)."'
															, '".cleanvars($salt)."'
															, '".cleanvars($password)."'
															, '".cleanvars($row['name'])."'
															, '".cleanvars($row['cell_no'])."'
															, '".cleanvars($row['id_campus'])."'
															, '4'
															, Now()	
														)");
					
			// Update LogoinID
			$adm_id = $dblms->lastestid();
			
			$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
															id_loginid		= '".$adm_id."'  
															WHERE std_id	= '".$std_id."'");
		}

		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Payment Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		// header("Location: feedepositslip.php?receipt_no=".$_POST['receipt_no']."&&book_no=".$_POST['book_no']."&&grandTotal=".$grandTotal."", true, 301);
		header("Location: feecollections.php", true, 301);
		exit();
	}
}



//	Add partial Payment Fee Challan
if(isset($_POST['challan_partialcashpay'])){
	
	$queryCheck = $dblms->querylms("SELECT challan_no 
										FROM ".FEES_COLLECTION."
										WHERE challan_no = '".cleanvars($_POST['challanno'])."'
										AND status = '1'
										AND is_deleted = '0'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'");
	if(mysqli_num_rows($queryCheck) == 1) {		
		// Set Error MSG in Session
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Challan already Paid.';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: ".$_SERVER['HTTP_REFERER']."", true, 301);
		exit();
	} else {
		if(!empty($_POST['paid_date'])){
			$paidDate = date('Y-m-d' , strtotime($_POST['paid_date']));
		}else{
			$paidDate = date('Y-m-d');
		}

        if($_POST['whatsappno']) {
            $msgs = 'Dear '.($_POST['stdname']).'
			Your Fee Challan No '.$_POST['challanno'].' Rs. '.number_format($_POST['totaltransamount']).'/ Month of '.$_POST['monthname'].'-'.date('Y' , strtotime($paidDate)).' has been paid Dated '.date('d-m-Y' , strtotime($paidDate)).'.

			https://aghosh.gptech.pk/feechallanprintwa.php?id='.$_POST['challanno'].'

			Thanks for your Payment

			Regards:
			Accounts Department
			Aghosh Complex';
            // whatsapp message
            $datawa = array(
                                  'status'          => 0
                                , 'dated'           => $paidDate
                                , 'challanno'       => ($_POST['challanno'])
                                , 'amount'          => $_POST['totaltransamount']
                                , 'cellno'          => ($_POST['whatsappno'])
                                , 'message_type'    => 3
                                , 'message'         => $msgs
                            );
            $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);

        }

        $challandate = date('Ym');
	 	$sqllmsfee 	= $dblms->querylms("SELECT yearlysrno 
										FROM ".FEES_COLLECTION." 
										WHERE recepit_no LIKE '".$_POST['classgroup']."-%' 
										AND yearlysrno LIKE '".$challandate."%' 
										ORDER by yearlysrno DESC LIMIT 1 ");
		$rowfeeid 	= mysqli_fetch_array($sqllmsfee);

		if($rowfeeid['yearlysrno']<1) {
			$yearlysrno	= $challandate.'00001';
		} else  {
			$yearlysrno = ($rowfeeid['yearlysrno'] +1);
		}
		
		
		$arraychecked = $_POST['id_fee'];
	
		// FULL PAYMENT		
		$data = array(
						 'status'		            => ($_POST['totaltransamount'] >= $_POST['grandTotal'] ? '1' : '4')
						,'type'		            	=> 1 
						,'dated'					=> date("Y-m-d") 
						,'yearlysrno'	        	=> $yearlysrno 
						,'recepit_no'	        	=> $_POST['classgroup']."-".$yearlysrno 
						,'id_fee'	        		=> cleanvars(implode(',', $_POST['id_fee']))
						,'challan_no'	        	=> cleanvars($_POST['challanno'])
						,'total_amount'		        => cleanvars($_POST['totaltransamount'])
						,'pay_mode'		        	=> cleanvars($_POST['pay_mode'])
						,'id_head'		       		=> 1 
						,'id_sub_head'		       	=> 1 
						,'remarks'		        	=> cleanvars($_POST['note']) 
						,'id_session'	       		=> cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION']) 
						,'id_campus'				=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS']) 
						,'id_added'	        		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA']) 
						,'date_added'		        => date("Y-m-d H:i:s") 
					);
		$queryInsert = $dblms->Insert(FEES_COLLECTION, $data);
		
		$remainingamount = $_POST['totaltransamount'];
		
		for($ichk=0; $ichk<sizeof($arraychecked); $ichk++){ 
			
			
			if($remainingamount>0) { 
				
				//($paidamount>=$_POST['amount'][$ichk]) ? '1' : '4';
			//------------ Update Previous pending Challans as Paid ----------------
			$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
														  status			= '".($remainingamount>=$_POST['amount'][$ichk] ? '1' : '4')."'
														, paid_amount		= '".($remainingamount>=$_POST['amount'][$ichk] ? cleanvars($_POST['amount'][$ichk]) : $remainingamount)."'
														, paid_date			= '".$paidDate."'
														, pay_mode			= '".cleanvars($_POST['pay_mode'])."'
														, note				= '".cleanvars($_POST['note'])."'
														, date_modify		= NOW()
														  WHERE id			= '".cleanvars($_POST['id_fee'][$ichk])."'
												");
			$remarks = 'Fee Challan Paid';

			//-------------------- Make Log ------------------------
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																	id_user 
																, filename 
																, action
																, challan_no
																, dated
																, ip
																, remarks 
																, id_campus				
															)
			
														VALUES(
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '3'
																, '".cleanvars($_POST['challan_no'][$ichk])."'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															)
										");
				
			}
			$remainingamount = ($remainingamount - $_POST['amount'][$ichk]);
			echo $remainingamount.'<br>';	
			
			
		}

		// check student exist in case of admisison challan
		if($_POST['id_type'] == 1){
			$sqllmsAdmissionStudents = $dblms->querylms("SELECT inq.*, f.paid_date
                                                FROM ".ADMISSIONS_INQUIRY." inq
                                                INNER JOIN ".FEES." f ON f.inquiry_formno = inq.form_no
                                                WHERE NOT EXISTS(
                                                                    SELECT s.std_id
                                                                    FROM ".STUDENTS." s
                                                                    WHERE s.admission_formno = inq.form_no
                                                                    AND s.is_deleted = '0'
                                                                )
                                                AND f.status        = '1'
                                                AND f.id_type       = '1'
                                                AND f.is_deleted    = '0'
                                                AND inq.is_deleted  = '0'
												AND f.challan_no	= '".cleanvars($_POST['challanno'])."'
                                            ");
			$row = mysqli_fetch_array($sqllmsAdmissionStudents);

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
			} else {
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
			} else {
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
																, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA']) ."'
																, NOW()
															)
										");  														   
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
		
			// Make Login
			// password salt
			$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		
			// Password
			$pass = 'ags786';
		
			// hash password
			$password = hash('sha256', $pass . $salt);
			for($round = 0; $round < 65536; $round++) {
				$password = hash('sha256', $password . $salt);
			}
		
			// Insert
			$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
															  adm_status  
															, adm_type
															, adm_logintype 
															, adm_username 
															, adm_salt
															, adm_userpass
															, adm_fullname
															, adm_phone
															, id_campus
															, id_added
															, date_added
														)
													VALUES(
															  '1'
															, '0'
															, '5'
															, '".cleanvars($regno)."'
															, '".cleanvars($salt)."'
															, '".cleanvars($password)."'
															, '".cleanvars($row['name'])."'
															, '".cleanvars($row['cell_no'])."'
															, '".cleanvars($row['id_campus'])."'
															, '4'
															, Now()	
														)");
					
			// Update LogoinID
			$adm_id = $dblms->lastestid();
			
			$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
															id_loginid		= '".$adm_id."'  
															WHERE std_id	= '".$std_id."'");
		//}
		}
		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Payment Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		// header("Location: feedepositslip.php?receipt_no=".$_POST['receipt_no']."&&book_no=".$_POST['book_no']."&&grandTotal=".$grandTotal."", true, 301);
		header("Location: feecollections.php", true, 301);
		exit();
	}
}