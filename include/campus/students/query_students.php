<?php 
//-------Student insert record----------
if(isset($_POST['submit_student'])){
	
	//------------Date variable--------------------------
	$dob = date('Y-m-d' , strtotime(cleanvars($_POST['std_dob'])));
	$admissiondate = date('Y-m-d' , strtotime(cleanvars($_POST['std_admissiondate'])));
	$admission_year = date('Y' , strtotime(cleanvars($_POST['std_admissiondate'])));

	// ----------- Class -------------------
	//------------- Seprate The Values ----------------
	$values = explode("|",$_POST['id_class']);
	$class_id   = $values[0];
	$class_code = $values[1];
	//------------------------------------------------
	//For Campus Short Code
	$sqllmscampus = $dblms->querylms("SELECT campus_code FROM ".CAMPUS." WHERE campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	$value_campus = mysqli_fetch_array($sqllmscampus);
	$campus_code  = $value_campus['campus_code'];

	//--------------- Roll No -----------------
	$newRollno = 0;
	$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
									FROM ".STUDENTS."
									WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
									AND id_class = '".$class_id."'");
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
	//---------------- Reg No -----------------

	$sqllmscheck  = $dblms->querylms("SELECT std_id
										FROM ".STUDENTS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND std_regno = '".cleanvars($regno)."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck) > 0) {
		//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: students.php", true, 301);
		exit();
		//------------if not exist--------------------------
	}else{

		// Insert Student
		$sqllms  = $dblms->querylms("INSERT INTO ".STUDENTS."(
															  std_status 
															, std_name
															, std_fathername  
															, std_gender  
															, id_guardian  
															, std_dob  
															, std_bloodgroup
															, id_country
															, std_city  
															, std_nic  
															, std_religion  
															, std_phone 
															, std_whatsapp 
															, std_address
															, is_orphan 
															, is_hostelized 
															, id_class  
															, id_section  
															, id_group  
															, id_session  
															, std_rollno  
															, std_regno  
															, admission_formno
															, std_admissiondate
															, remaining_amount
															, id_campus
															, id_added  
															, date_added															
														)
													VALUES(
															  '".cleanvars($_POST['std_status'])."' 
															, '".cleanvars($_POST['std_name'])."'
															, '".cleanvars($_POST['std_fathername'])."'
															, '".cleanvars($_POST['std_gender'])."' 
															, '".cleanvars($_POST['id_guardian'])."' 
															, '".$dob."'
															, '".cleanvars($_POST['std_bloodgroup'])."' 
															, '1' 
															, '".cleanvars($_POST['std_city'])."' 
															, '".cleanvars($_POST['std_nic'])."' 
															, '".cleanvars($_POST['std_religion'])."' 
															, '".cleanvars($_POST['std_phone'])."' 
															, '".cleanvars($_POST['std_whatsapp'])."' 
															, '".cleanvars($_POST['std_address'])."' 
															, '".cleanvars($_POST['is_orphan'])."' 
															, '".cleanvars($_POST['is_hostelized'])."' 
															, '".cleanvars($class_id)."' 
															, '".cleanvars($_POST['id_section'])."' 
															, '".cleanvars($_POST['id_group'])."' 
															, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
															, '".cleanvars($newRollno)."' 
															, '".cleanvars($regno)."' 
															, '".cleanvars($_POST['form_no'])."' 
															, '".$admissiondate."'
															, '".cleanvars($_POST['remaining_amount'])."' 
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, NOW()
														)"
								);
		$std_id = $dblms->lastestid();
		//--------------------------------------
		if(!empty($_FILES['std_photo']['name'])) { 
			//--------------------------------------
			$path_parts 	= pathinfo($_FILES["std_photo"]["name"]);
			$extension 		= strtolower($path_parts['extension']);
			$img_dir 	= 'uploads/images/students/';
			//--------------------------------------
			$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['std_name'])).'_'.$std_id.".".($extension);
			$img_fileName	= to_seo_url(cleanvars($_POST['std_name'])).'_'.$std_id.".".($extension);
			//--------------------------------------
			if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 
			//--------------------------------------
				$sqllmsupload  = $dblms->querylms("UPDATE ".STUDENTS."
																SET std_photo = '".$img_fileName."'
														WHERE  std_id		  = '".cleanvars($std_id)."'");
				unset($sqllmsupload);
				$mode = '0644'; 
			//--------------------------------------	
				move_uploaded_file($_FILES['std_photo']['tmp_name'],$originalImage);
				chmod ($originalImage, octdec($mode));
			//--------------------------------------
			}
			//--------------------------------------
		}

		// password salt
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

		// Password
		$pass = 'ags786';

		// hash password
		$password = hash('sha256', $pass . $salt);
		for($round = 0; $round < 65536; $round++) {
			$password = hash('sha256', $password . $salt);
		}
		
		$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
														  adm_status  
														, adm_logintype 
														, adm_username 
														, adm_salt
														, adm_userpass
														, adm_fullname
														, adm_email 
														, adm_phone
														, id_campus 	
													  )
	   											VALUES(
														  '".cleanvars($_POST['std_status'])."' 
														, '5'
														, '".cleanvars($regno)."'
														, '".cleanvars($salt)."'
														, '".cleanvars($password)."'
														, '".cleanvars($_POST['std_name'])."'
														, '".cleanvars($_POST['std_email'])."'
														, '".cleanvars($_POST['std_phone'])."'
														, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )");
		if($sqllmsLogin){
			$adm_id = $dblms->lastestid();
			$sqlloginid  = $dblms->querylms("UPDATE ".STUDENTS."
														SET id_loginid	= '".cleanvars($adm_id)."'
														WHERE  std_id	= '".cleanvars($std_id)."'
											");
		}

		//---------- Enrolled In Hostel -------------
		if($_POST['is_hostelized'] == 1){

			$sqllms  = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
															  status 
															, id_std
															, joining_date 
															, id_campus
															, id_added
															, date_added
														)
													VALUES(
															  '".cleanvars($_POST['std_status'])."' 
															, '".cleanvars($std_id)."'
															, '".cleanvars($admissiondate)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, Now()
														)" );
		}

		if($_POST['is_orphan'] != '1'){
			//--------- GET Fee Structure -------------------
		
			//----- For Hostelized -------
			if($_POST['is_hostelized'] == 1){
				$sql2 = "";
			}
			else{		
				$sql2 = "AND d.id_cat NOT IN(6,7,8)";
			}
			//----------------------------
			$sqllmsfeesetup	= $dblms->querylms("SELECT f.id, d.id_cat, d.amount
														FROM ".FEESETUP." f 
														INNER JOIN ".FEESETUPDETAIL." d ON d.id_setup = f.id 	
														WHERE f.status = '1'
														AND f.id_class = '".cleanvars($class_id)."' $sql2
														AND f.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
														AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
														AND f.is_deleted != '1'
														ORDER BY f.id DESC");
			$toalAmount = 0;
			while($value_feesetup = mysqli_fetch_array($sqllmsfeesetup)){

				$toalAmount = $toalAmount + $value_feesetup['amount'];
				$feeDetail[] = array('id_cat'=>$value_feesetup['id_cat'], 'amount'=>$value_feesetup['amount']);

			}

			//----------------- Make Challans ---------------------
			$challandate= substr(date('Y'),2,4);
			$issue_date = $admissiondate;
			$due_date 	= date('Y-m-d' , strtotime($issue_date. ' + 15 days'));
			$yearmonth 	= date('Y-m', strtotime(cleanvars($admissiondate)));
			$year 		= date('y', strtotime(cleanvars($admissiondate)));
			$idmonth 	= date('n', strtotime(cleanvars($admissiondate)));

			// challan no
			do {
				$challano = '9930'.$year.mt_rand(10000,99999);
				$sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
				$sqlCheck	= $dblms->querylms($sqlChallan);
			} while (mysqli_num_rows($sqlCheck) > 0);
			
			//----------------- Remaining Amount ------------------
			$rem_amount = cleanvars($_POST['remaining_amount']);
			//------------------- Chllans ---------------------
			$sqllmsFee  = $dblms->querylms("INSERT INTO ".FEES."(
																  status 
																, id_type
																, challan_no 
																, id_session 
																, id_class 
																, id_section
																, inquiry_formno
																, id_std
																, id_month
																, yearmonth
																, issue_date
																, due_date
																, total_amount
																, remaining_amount
																, id_campus
																, id_added
																, date_added
															)
														VALUES(
																  '2'
																, '1'
																, '".cleanvars($challano)."'
																, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
																, '".cleanvars($class_id)."'
																, '".cleanvars($_POST['id_section'])."'   
																, '".cleanvars($_POST['form_no'])."'
																, '".cleanvars($std_id)."'  
																, '".cleanvars($idmonth)."'  
																, '".cleanvars($yearmonth)."'
																, '".cleanvars($issue_date)."' 
																, '".cleanvars($due_date)."'
																, '".cleanvars($toalAmount)."'
																, '".cleanvars($rem_amount)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, Now()	
															)"
													);

			//------------------- Chllans Details ---------------------
			if($sqllmsFee) { 
				//-------------------------Get latest Id----------------------- 
				$challan_id = $dblms->lastestid();	
				//--------------------------------------
				foreach($feeDetail as $det){
					$sqllms  = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																	  id_fee
																	, id_cat
																	, amount						
																	)
																	VALUES(
																			'".cleanvars($challan_id)."'
																			, '".cleanvars($det['id_cat'])."'
																			, '".cleanvars($det['amount'])."'			
																	)
																");

				}
				//-------------------- Make Log ------------------------
				$remarks = 'Fee Challan genrate at the time admission.';
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
																	, '1'
																	, '".cleanvars($challano)."'
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
											");
				//--------------------------------------
			}
			//-----------------------end---------------
		}
		
		if($sqllms) { 
		
			if($_POST['is_orphan'] != '1'){
				$remarks = 'Added Student ID: "'.cleanvars($std_id).' and Challan ID: "'.cleanvars($challan_id).'" " detail';
				$headerLocation = header("Location: feechallanprint.php?id=$challano", true, 301);
			} else{	
				$remarks = 'Added Student ID: "'.cleanvars($std_id).'" detail';
				$headerLocation = header("Location: students.php", true, 301);
			}

			//Send Message				
			$phone = str_replace("-","",$_POST['std_phone']);
			$data['message'] = 'Dear Parents Congratulations,\n\nYour child admission has been confirmed. CMS Login details:\n\nUsername: '.$regno.'@ags.edu.pk'.'\nPassword: '.$pass.'\nCMS Link: https://aghosh.gptech.pk/\n\nThanks,\nAghosh Grammar School';
			sendMessage($phone, $message);

			// Make Log
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks 
																, id_campus				
															)
			
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '1'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															) ");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			$headerLocation;
			exit();
		}
	} // end checker
}
//--------------------------------------
 
//--------class update reocrd-----------
if(isset($_POST['changes_student'])){ 
	//------------Date variable--------------------------
	$dob = date('Y-m-d' , strtotime(cleanvars($_POST['std_dob'])));
	$admissiondate = date('Y-m-d' , strtotime(cleanvars($_POST['std_admissiondate'])));
	$admission_year = date('Y' , strtotime(cleanvars($_POST['std_admissiondate'])));

	// ----------- Class -------------------
	//------------- Seprate The Values ----------------
	$values = explode("|",$_POST['id_class']);
	$class_id   = $values[0];
	$class_code = $values[1];

	// Check if class change
	$sqlCheck  = $dblms->querylms("SELECT std_id, id_class
									FROM ".STUDENTS."
									WHERE  std_id = '".cleanvars($_POST['std_id'])."'
									AND id_class = '".cleanvars($class_id)."' LIMIT 1
									");
	if(mysqli_num_rows($sqlCheck)==0){
		//--------------- Roll No -----------------
		$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
										FROM ".STUDENTS."
										WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
										AND id_class = '".$class_id."'");
		if(mysqli_num_rows($sqllmsRoll) > 0 ){
			$valueRoll = mysqli_fetch_array($sqllmsRoll);
			(int)$valueRoll['rollno'];
			$newRollno = (int)$valueRoll['rollno'] + 1;
		}
		else{
			$newRollno = 1;
		}
		$sqlRoll = ", std_rollno = '".cleanvars($newRollno)."' ";
	}else{
		$sqlRoll = "";
	}
	
	//--------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													std_status				= '".cleanvars($_POST['std_status'])."'
												  , std_name				= '".cleanvars($_POST['std_name'])."' 
												  , std_fathername			= '".cleanvars($_POST['std_fathername'])."' 
												  , std_fathercnic			= '".cleanvars($_POST['std_fathercnic'])."' 
												  , std_gender				= '".cleanvars($_POST['std_gender'])."' 
												  , id_guardian				= '".cleanvars($_POST['id_guardian'])."' 
												  , std_dob					= '".$dob."' 
												  , std_bloodgroup			= '".cleanvars($_POST['std_bloodgroup'])."' 
												  , std_city				= '".cleanvars($_POST['std_city'])."' 
												  , std_nic					= '".cleanvars($_POST['std_nic'])."' 
												  , std_religion			= '".cleanvars($_POST['std_religion'])."' 
												  , std_phone				= '".cleanvars($_POST['std_phone'])."' 
												  , std_whatsapp			= '".cleanvars($_POST['std_whatsapp'])."' 
												  , std_address				= '".cleanvars($_POST['std_address'])."' 
												  , is_orphan				= '".cleanvars($_POST['is_orphan'])."' 
												  , is_hostelized			= '".cleanvars($_POST['is_hostelized'])."' 
												  , id_class				= '".cleanvars($class_id)."' 
												  , id_section				= '".cleanvars($_POST['id_section'])."' 
												  $sqlRoll
												  , id_group				= '".cleanvars($_POST['id_group'])."' 
												  , std_admissiondate		= '".$admissiondate."'   
												  , transport_fee			= '".cleanvars($_POST['transport_fee'])."' 
												  , id_campus				= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify				= NOW()
											  		WHERE std_id			= '".cleanvars($_POST['std_id'])."'");
									
											  
	if(!empty($_FILES['std_photo']['name'])) { 
		
		$path_parts 	= pathinfo($_FILES["std_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/images/students/';
		
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['std_name'])).'_'.$_POST['std_id'].".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['std_name'])).'_'.$_POST['std_id'].".".($extension);
		
		if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 
			
			$sqllmsupload  = $dblms->querylms("UPDATE ".STUDENTS."
															SET std_photo = '".$img_fileName."'
														WHERE  std_id		  = '".cleanvars($_POST['std_id'])."'");
			unset($sqllmsupload);
			$mode = '0644'; 
				
			move_uploaded_file($_FILES['std_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
			
		}
		
	}
	
	if($sqllms) { 
		
		$remarks = 'Updated Student ID: "'.cleanvars($_POST['std_id']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															  id_user 
															, filename 
															, action
															, dated
															, ip
															, remarks 
															, id_campus				
														  )
		
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
															, '2'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														  )
									");
									
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: students.php", true, 301);
		exit();	
	}
}
//--------------------------------------

//-------- Approval for Orphan ---------
if(isset($_GET['oprhanid'])){ 
	// if($_GET['approv'] == 3){
		$sqllms  = $dblms->querylms("UPDATE ".STUDENTS." SET
														  is_orphan_approved	= '1'
														, id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, date_modify			= NOW()
													WHERE std_id				= '".cleanvars($_GET['oprhanid'])."'");
										
		//--------------------------------------
		if($sqllms) { 
			//--------------------------------------
			$remarks = 'Student Approbed as Orphan: "'.cleanvars($_POST['std_id']).'" details';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks 
																, id_campus				
																)
			
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '2'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
										");
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: students.php", true, 301);
			exit();
			//--------------------------------------
		}
	// }
}
//--------------------------------------

//---------- Delete record -------------
if(isset($_GET['deleteid'])){
	$sqllms  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													is_deleted				= '1'
												  , id_deleted				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , ip_deleted				= '".$ip."'
												  , date_deleted			= NOW()
													WHERE std_id			= '".cleanvars($_GET['deleteid'])."'");

	//--------------------------------------
	if($sqllms) { 
		//--------------------------------------
		$remarks = 'Student Deleted ID: "'.cleanvars($_GET['deleteid']).'" details';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks 
																, id_campus				
																)
			
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '3'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
										");
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: students.php", true, 301);
		exit();
		//--------------------------------------
	}
}
//--------------------------------------
?>