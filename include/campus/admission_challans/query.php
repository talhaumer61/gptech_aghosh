<?php

// for sending message
require_once("include/functions/send_message.php");

//---------------- Update Admission Challan ----------------------
if(isset($_POST['changes_admission_challan'])) { 
	//------------------------------------
	if($_POST['status'] == 1){
		$paidAmount = $_POST['payable'];
		$paidDate = date('Y-m-d', strtotime($_POST['paid_date']));
	}
	else{
		$paidAmount = 0;
		$paidDate = "0000-00-00";
	}

	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));

	if($_POST['status'] == 1){
		//----------------- Update Chllan as Paid ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
											  status		= '".cleanvars($_POST['status'])."'
											, id_month		= '".cleanvars($_POST['id_month'])."'
											, due_date		= '".cleanvars($due_date)."'
											, pay_mode		= '".cleanvars($_POST['pay_mode'])."'
											, paid_date		= '".cleanvars($paidDate)."'
											, total_amount	= '".cleanvars($_POST['payable'])."'
											, paid_amount	= '".cleanvars($paidAmount)."'
											, note			= '".cleanvars($_POST['note'])."'
											, id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, date_modify	= NOW()
											  WHERE	id		= '".cleanvars($_POST['id_fee'])."'
											");
		if($sqllms) 
		{
			//----------------- Update Chllan Details ---------------------
			for($i=0; $i< count($_POST['id']); $i++) {
				$sqllmsPart  = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
														amount		= '".cleanvars($_POST['amount'][$i])."'
														WHERE   id	= '".cleanvars($_POST['id'][$i])."'
												  		AND	id_fee	= '".cleanvars($_POST['id_fee'])."' ");
			}
			// Check If Record Not Exist
			$sqllmsCheckStd	= $dblms->querylms("SELECT std_id
													FROM ".STUDENTS." 
													WHERE admission_formno = '".cleanvars($_POST['form_no'])."'
													AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													AND is_deleted != '1' LIMIT 1");
			if(mysqli_num_rows($sqllmsCheckStd) == 0) {
				// Get Inquiry Details
				$sqllmsInquiry	= $dblms->querylms("SELECT name, fathername, gender, cell_no, address, id_class, is_hostelized, is_orphan, cnicno
														FROM ".ADMISSIONS_INQUIRY." 
														WHERE form_no = '".cleanvars($_POST['form_no'])."'
														AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														AND is_deleted != '1' LIMIT 1");
				$valueInquiry = mysqli_fetch_array($sqllmsInquiry);

				// Date Conversion
				$admissiondate = date('Y-m-d');
				$admission_year = date('Y');
				
				//For Campus Short Code
				$sqllmsCampus = $dblms->querylms("SELECT campus_code FROM ".CAMPUS." WHERE campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
				$valueCampus = mysqli_fetch_array($sqllmsCampus);
				$campus_code = $valueCampus['campus_code'];

				// For Class Code
				$sqllmsClass = $dblms->querylms("SELECT class_code FROM ".CLASSES." WHERE class_id = '".cleanvars($valueInquiry['id_class'])."' LIMIT 1");
				$valueClass = mysqli_fetch_array($sqllmsClass);

				// For Current Admission Session
				$sqllmsSession = $dblms->querylms("SELECT se.session_id, se.session_name
														FROM ".SESSIONS." se
														INNER JOIN ".SETTINGS." st ON st.adm_session = se.session_id
														WHERE se.session_status = '1' AND st.status = '1' AND st.is_deleted != '1' LIMIT 1");
				$valueSession = mysqli_fetch_array($sqllmsSession);

				// Std Rollno
				$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno FROM ".STUDENTS." WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' AND id_class = '".$valueInquiry['id_class']."'");
				if(mysqli_num_rows($sqllmsRoll) > 0 ){
					$valueRoll = mysqli_fetch_array($sqllmsRoll);
					(int)$valueRoll['rollno'];
					$newRollno = (int)$valueRoll['rollno'] + 1;
				}else{
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
				//---------------- Reg No -----------------

				// Insert Student
				$sqllmsStd = $dblms->querylms("INSERT INTO ".STUDENTS."(
														  std_status 
														, std_name
														, std_fathername  
														, std_gender  
														, id_country
														, std_whatsapp 
														, std_nic
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
													) VALUES (
														  '1'
														, '".cleanvars($valueInquiry['name'])."'
														, '".cleanvars($valueInquiry['fathername'])."'
														, '".cleanvars($valueInquiry['gender'])."' 
														, '1'
														, '".cleanvars($valueInquiry['cell_no'])."' 
														, '".cleanvars($valueInquiry['cnicno'])."' 
														, '".cleanvars($valueInquiry['address'])."' 
														, '".cleanvars($valueInquiry['is_orphan'])."' 
														, '".cleanvars($valueInquiry['is_hostelized'])."' 
														, '".cleanvars($valueInquiry['id_class'])."'
														, '".cleanvars($valueSession['session_id'])."' 
														, '".cleanvars($newRollno)."' 
														, '".cleanvars($regno)."' 
														, '".cleanvars($_POST['form_no'])."' 
														, '".$admissiondate."'
														, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, NOW()
													)");

				$std_id = $dblms->lastestid();

				$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
													  id_std		= '".cleanvars($std_id)."'
													, id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
													, date_modify	= NOW()
													  WHERE	id		= '".cleanvars($_POST['id_fee'])."'
											");
															
				// Enrolled In Hostel
				if($valueInquiry['is_hostelized'] == '1'){

					$sqllmsHostel = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
																	  status 
																	, id_std
																	, joining_date 
																	, id_campus
																	, id_added
																	, date_added
																) VALUES (
																	  '1'
																	, '".cleanvars($std_id)."'
																	, '".cleanvars($admissiondate)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
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
				$remarks = 'Admission Fee Paid, Record Added In Student.';
				$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																	  id_user 
																	, action
																	, challan_no
																	, dated
																	, ip
																	, remarks 
																	, id_campus				
																) VALUES (
																	  '4'
																	, '1'
																	, '".cleanvars($_POST['challan_no'])."'
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
																)");
			}

			// Send Message
			$phone = str_replace("-","",$_POST['std_phone']);
			$message = 'Dear Parents,\n\nYour child admission challan # '.cleanvars($_POST['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
			sendMessage($phone, $message);

			//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
			// $sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
			// $values_trans_head = mysqli_fetch_array($sqllms_head);

			//-------------------- ADD IN EARNING -------------------------------
			$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
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
																, id_added  
																, date_added 	
															) VALUES (
																  '1'	 
																, '".cleanvars($_POST['challan_no'])."'
																, '".cleanvars($_POST['pay_mode'])."'
																, '".cleanvars($paidAmount)."'
																, '".cleanvars($_POST['challan_no'])."'
																, '".cleanvars($_POST['pay_mode'])."'
																, '".cleanvars($_POST['note'])."'				
																, '".cleanvars($paidDate)."'
																, '1'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, NOW()	
															)" );
			
			//-------------------- Make Log ------------------------
			$remarks = 'Admission Challan Paid';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																  id_user 
																, filename 
																, action
																, challan_no
																, dated
																, ip
																, remarks 
																, id_campus				
															) VALUES (
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '3'
																, '".cleanvars($_POST['challan_no'])."'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															) ");

			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: admission_challans.php", true, 301);
			exit();
		}
	}else{
		//----------------- Update Chllan ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
												  due_date		= '".cleanvars($due_date)."'
												, id_month		= '".cleanvars($_POST['id_month'])."'
												, total_amount	= '".cleanvars($_POST['total_amount'])."'
												, note			= '".cleanvars($_POST['note'])."'
												, id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												, date_modify	= NOW()
												  WHERE id		= '".cleanvars($_POST['id_fee'])."'
											");

		if($sqllms) 
		{	
			//----------------- Update Chllan Details ---------------------
			for($i=0; $i< count($_POST['id']); $i++){
				$sqllmsPart  = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
														amount	= '".cleanvars($_POST['amount'][$i])."'
												WHERE   id		= '".cleanvars($_POST['id'][$i])."'
												AND   id_fee	= '".cleanvars($_POST['id_fee'])."' ");
			}
			//-------------------- Make Log ------------------------
			$remarks = 'Admission Challan update';
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
																, '".cleanvars($_POST['challan_no'])."'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
										");
			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: $requestedPage", true, 301);
			exit();
		}
	}
}

//---------------- Make Admission Partial Payment ----------------------
if(isset($_POST['admission_partialPayment'])) { 

	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));

	//----------------- Update Challan ---------------------
	$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
											  total_amount		= '".cleanvars($_POST['partial_amount'])."'
											, remaining_amount	= '".cleanvars($_POST['remaining_amount'])."'
											, due_date			= '".cleanvars($due_date)."'
											, note				= '".cleanvars($_POST['note'])."'
											, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, date_modify		= NOW()
											  WHERE id			= '".cleanvars($_POST['id_fee'])."'
										");
	//----------------------------------
	$remainingFromPrev = $_POST['remaining_amount'];

	//---------- Get All Values -------------
    $sqllmsFeePart  = $dblms->querylms("SELECT p.id, p.id_cat, p.amount, c.cat_name
											FROM ".FEE_PARTICULARS." p
											INNER JOIN ".FEE_CATEGORY." c ON c.cat_id = p.id_cat
											WHERE p.id_fee = '".cleanvars($_POST['id_fee'])."'
											AND cat_id != '17'
											ORDER BY c.cat_partialpay_ordering ASC");
    while($valFeePart  = mysqli_fetch_array($sqllmsFeePart)) {  

		if($remainingFromPrev > 0) {
			if($valFeePart['amount'] > $remainingFromPrev){
				$addAmount = $valFeePart['amount'] - $remainingFromPrev;
				// echo "checl rem".$addAmount;
				$remainingFromPrev = 0;
				// echo "<br> Update" .$valFeePart['cat_name'].": ".$addAmount;
				// echo"<br>";
				
				$sqllmsUpdateTut = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET  
														amount      = '".cleanvars($addAmount)."'                        
													WHERE id_fee	= '".cleanvars($_POST['id_fee'])."'
													AND id_cat      = '".cleanvars($valFeePart['id_cat'])."'
													AND id          = '".cleanvars($valFeePart['id'])."' ");

			} else {

				$remainingFromPrev = $remainingFromPrev - $valFeePart['amount'];
				// echo "<br> Del, ".$valFeePart['cat_name'].": ".$remainingFromPrev;
				

				$sqllmsDelTut = $dblms->querylms("DELETE FROM ".FEE_PARTICULARS."                        
													WHERE id_fee	= '".cleanvars($_POST['id_fee'])."'
													AND id_cat      = '".cleanvars($valFeePart['id_cat'])."'
													AND id          = '".cleanvars($valFeePart['id'])."' ");
			}
		}

    } // end while loop

	if($sqllms) {
		//-------------------- Make Log ------------------------
		$remarks = 'Admission Partial Payment Added of Amount: '.cleanvars($_POST['partial_amount']).' and Remainigs : '.cleanvars($_POST['remaining_amount']).'';
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
															, '".cleanvars($_POST['challan_no'])."'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														) ");
														
		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: $requestedPage", true, 301);
		exit();
	}
}
?>