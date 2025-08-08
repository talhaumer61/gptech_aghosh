<?php

// for sending message
require_once("include/functions/send_message.php");

//---------------- Update Admission Challan ----------------------
if(isset($_POST['changes_admission_challan'])) { 
	//------------------------------------
	if($_POST['status'] == 1){
		$paidAmount = $_POST['payable'];
		$paidDate = date('Y-m-d');
	}
	else{
		$paidAmount = 0;
		$paidDate = "0000-00-00";
	}
	//------------------------------------
	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
	//------------------------------------
	if($_POST['status'] == 1){

		//----------------- Update Chllan as Paid ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
												status					= '".cleanvars($_POST['status'])."'
											,	due_date				= '".cleanvars($due_date)."'
											,	pay_mode				= '".cleanvars($_POST['pay_mode'])."'
											,	paid_date				= '".cleanvars($paidDate)."'
											,	total_amount			= '".cleanvars($_POST['payable'])."'
											,	paid_amount				= '".cleanvars($paidAmount)."'
											,	note					= '".cleanvars($_POST['note'])."'
											,	id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify				= NOW()
										WHERE   id						= '".cleanvars($_POST['id_fee'])."'
											");
		if($sqllms) 
		{	
			

			//----------------- Update Chllan Details ---------------------
			for($i=0; $i< count($_POST['id']); $i++) {
				$sqllmsPart  = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
														amount	= '".cleanvars($_POST['amount'][$i])."'
												WHERE   id		= '".cleanvars($_POST['id'][$i])."'
												  AND   id_fee	= '".cleanvars($_POST['id_fee'])."' ");
			}

			

			// Check If Record Not Exist
			$sqllmsCheckStd	= $dblms->querylms("SELECT std_id
													FROM ".STUDENTS." 
													WHERE admission_formno = '".cleanvars($_POST['form_no'])."'
													AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													AND is_deleted != '1' LIMIT 1");

			echo "SELECT std_id
			FROM ".STUDENTS." 
			WHERE admission_formno = '".cleanvars($_POST['form_no'])."'
			AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
			AND is_deleted != '1' LIMIT 1 <br>";
			if(mysqli_num_rows($sqllmsCheckStd) < 1) {
				
				echo 'Student = 0 <br>';

				// Get Inquiry Details
				$sqllmsInquiry	= $dblms->querylms("SELECT name, fathername, gender, cell_no, address, id_class, is_hostelized, is_orphan
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
				} else {
					$newRollno = 1;
				}
				// Std Regno
				$reg_no	= $admission_year.'-'.$valueCampus['campus_code'].'-'.$valueClass['class_code'].'-'.$newRollno;
				// Remove Spaces
				$regno = str_replace(" ","", $reg_no);

				echo 'Student: <br>';

				echo "INSERT INTO ".STUDENTS."(
					std_status			, 
					std_name			,
					std_fathername		,  
					std_gender			,  
					id_country			,
					std_phone			, 
					std_address			,
					is_orphan			, 
					is_hostelized		, 
					id_class			,  
					id_session			,  
					std_rollno			,  
					std_regno			,  
					admission_formno	,
					std_admissiondate	,
					id_campus			,
					id_added			,  
					date_added															
				) VALUES (
					'1'																, 
					'".cleanvars($valueInquiry['name'])."'							,
					'".cleanvars($valueInquiry['fathername'])."'					,
					'".cleanvars($valueInquiry['gender'])."'						, 
					'1'																, 
					'".cleanvars($valueInquiry['cell_no'])."'						, 
					'".cleanvars($valueInquiry['address'])."'						, 
					'".cleanvars($valueInquiry['is_orphan'])."'						, 
					'".cleanvars($valueInquiry['is_hostelized'])."'					, 
					'".cleanvars($valueInquiry['id_class'])."'						,
					'".cleanvars($valueSession['session_id'])."'					, 
					'".cleanvars($newRollno)."'										, 
					'".cleanvars($regno)."'											, 
					'".cleanvars($_POST['form_no'])."'								, 
					'".$admissiondate."'											,
					'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
					'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
					NOW()
				)";

				// Insert Student
				$sqllmsStd = $dblms->querylms("INSERT INTO ".STUDENTS."(
														std_status			, 
														std_name			,
														std_fathername		,  
														std_gender			,  
														id_country			,
														std_phone			, 
														std_address			,
														is_orphan			, 
														is_hostelized		, 
														id_class			,  
														id_session			,  
														std_rollno			,  
														std_regno			,  
														admission_formno	,
														std_admissiondate	,
														id_campus			,
														id_added			,  
														date_added															
													) VALUES (
														'1'																, 
														'".cleanvars($valueInquiry['name'])."'							,
														'".cleanvars($valueInquiry['fathername'])."'					,
														'".cleanvars($valueInquiry['gender'])."'						, 
														'1'																, 
														'".cleanvars($valueInquiry['cell_no'])."'						, 
														'".cleanvars($valueInquiry['address'])."'						, 
														'".cleanvars($valueInquiry['is_orphan'])."'						, 
														'".cleanvars($valueInquiry['is_hostelized'])."'					, 
														'".cleanvars($valueInquiry['id_class'])."'						,
														'".cleanvars($valueSession['session_id'])."'					, 
														'".cleanvars($newRollno)."'										, 
														'".cleanvars($regno)."'											, 
														'".cleanvars($_POST['form_no'])."'								, 
														'".$admissiondate."'											,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														NOW()
													)");

				$std_id = $dblms->lastestid();

				// Enrolled In Hostel
				if($valueInquiry['is_hostelized'] == '1'){

					$sqllmsHostel = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
																	status							, 
																	id_std							,
																	joining_date					, 
																	id_campus 						,
																	id_added						,
																	date_added
																) VALUES (
																	'1'															, 
																	'".cleanvars($std_id)."'									,
																	'".cleanvars($admissiondate)."'								,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
																	Now()
																)" );
				}

				// Make Login
				// hashing
				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				//Rand Password
				$pass = str_pad(mt_rand(),8,'0',STR_PAD_LEFT);
				$password = hash('sha256', $pass . $salt);
				for($round = 0; $round < 65536; $round++) {
					$password = hash('sha256', $password . $salt);
				}

				
				echo '<br> Admin: <br>';

				echo"INSERT INTO ".ADMINS."(
					adm_status						,  
					adm_type                        ,
					adm_logintype					, 
					adm_username					, 
					adm_salt						,
					adm_userpass					,
					adm_fullname					,
					adm_phone						,
					id_campus 						,
					id_added						,
					date_added
				) VALUES (
					'1'															,
					'0'															,
					'5'															,
					'".cleanvars($regno.'@ags.edu.pk')."'						,
					'".cleanvars($salt)."'										,
					'".cleanvars($password)."'									,
					'".cleanvars($valueInquiry['name'])."'						,
					'".cleanvars($valueInquiry['cell_no'])."'					,
					'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
					'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
					Now()	
				)";

				// Insert
				$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
																adm_status						,  
																adm_type                        ,
																adm_logintype					, 
																adm_username					, 
																adm_salt						,
																adm_userpass					,
																adm_fullname					,
																adm_phone						,
																id_campus 						,
																id_added						,
																date_added
															) VALUES (
																'1'															,
																'0'															,
																'5'															,
																'".cleanvars($regno.'@ags.edu.pk')."'						,
																'".cleanvars($salt)."'										,
																'".cleanvars($password)."'									,
																'".cleanvars($valueInquiry['name'])."'						,
																'".cleanvars($valueInquiry['cell_no'])."'					,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
																Now()	
															)");

				// Update LogoinID
				$adm_id = $dblms->lastestid();

				echo '<br> Login Update <br>';
				echo"UPDATE ".STUDENTS." SET  
																	id_loginid	= '".$adm_id."'  
															  WHERE std_id		= '".$std_id."' ";

				
				$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
																	id_loginid	= '".$adm_id."'  
															  WHERE std_id		= '".$std_id."' ");

				// Make Log
				$remarks = 'Admission Fee Paid, Record Added In Student.';
				$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																	id_user 				, 
																	action					,
																	challan_no 				,
																	dated					,
																	ip						,
																	remarks					, 
																	id_campus				
																) VALUES (
																	'4'											,
																	'1'											, 
																	'".cleanvars($_POST['challan_no'])."'		,
																	NOW()										,
																	'".cleanvars($ip)."'						,
																	'".cleanvars($remarks)."'					,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
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
																trans_status							, 
																trans_title							    ,
																trans_type							    ,
																trans_amount							,
																voucher_no							    ,
																trans_method							,
																trans_note							    ,
																dated							        ,
																id_head							        ,
																id_campus							    ,  
																id_added							    ,  
																date_added 	
															) VALUES (
																'1'		                                    				,	 
																'".cleanvars($_POST['challan_no'])."'						,
																'".cleanvars($_POST['pay_mode'])."'            				,
																'".cleanvars($paidAmount)."'								,
																'".cleanvars($_POST['challan_no'])."'						,
																'".cleanvars($_POST['pay_mode'])."'            				,
																'".cleanvars($_POST['note'])."'								,				
																'".cleanvars($paidDate)."' 									,
																'1'   														,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
																NOW()	
															)" );
			
			//-------------------- Make Log ------------------------
			$remarks = 'Admission Challan Paid';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																id_user 				, 
																filename				, 
																action					,
																challan_no 				,
																dated					,
																ip						,
																remarks					, 
																id_campus				
															) VALUES (
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'3'																	, 
																'".cleanvars($_POST['challan_no'])."'								,
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'											,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															) ");

			exit();
			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: admission_challans.php", true, 301);
			exit();
		}
	} else {

		//----------------- Update Chllan as Paid ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
												due_date				= '".cleanvars($due_date)."'
											,	total_amount			= '".cleanvars($_POST['payable'])."'
											,	note					= '".cleanvars($_POST['note'])."'
											,	id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify				= NOW()
										WHERE   id						= '".cleanvars($_POST['id_fee'])."'
											");
		//------------------------------------
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
																id_user 				, 
																filename				, 
																action					,
																challan_no 				,
																dated					,
																ip						,
																remarks					, 
																id_campus				
															)
			
														VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'3'																	, 
																'".cleanvars($_POST['challan_no'])."'								,
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'											,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
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
										,	remaining_amount	= '".cleanvars($_POST['remaining_amount'])."'
										,	due_date			= '".cleanvars($due_date)."'
										,	note				= '".cleanvars($_POST['note'])."'
										,	id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										, 	date_modify			= NOW()
									  WHERE id					= '".cleanvars($_POST['id_fee'])."'
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
															id_user 				, 
															filename				, 
															action					,
															challan_no 				,
															dated					,
															ip						,
															remarks					, 
															id_campus				
														)
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
															'3'																	, 
															'".cleanvars($_POST['challan_no'])."'								,
															NOW()																,
															'".cleanvars($ip)."'												,
															'".cleanvars($remarks)."'											,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
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