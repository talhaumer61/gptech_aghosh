<?php 
//----------------Student insert record--------------------
if(isset($_POST['submit_student'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT std_nic, std_regno  
										FROM ".STUDENTS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND std_nic = '".cleanvars($_POST['std_nic'])."' 
										AND std_regno = '".cleanvars($_POST['std_regno'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: students.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else {
		
//------------Date variable--------------------------
$dob = date('Y-m-d' , strtotime(cleanvars($_POST['std_dob'])));
$admissiondate = date('Y-m-d' , strtotime(cleanvars($_POST['std_admissiondate'])));

	$sqllms  = $dblms->querylms("INSERT INTO ".STUDENTS."(
														std_status								, 
														std_firstname							,
														std_lastname							,  
														std_gender								,  
														id_guardian								,  
														std_dob									,  
														std_bloodgroup							,
														id_country								,
														std_city								,  
														std_nic									,  
														std_religion							,  
														std_phone								,  
														std_address								,  
														id_class								,  
														id_section								,  
														id_group								,  
														id_session								,  
														std_rollno								,  
														std_regno								,  
														std_admissiondate						,  
														id_loginid								,
														id_campus							 	,
														id_added								,  
														date_added															
													  )
	   											VALUES(
														'".cleanvars($_POST['std_status'])."'							, 
														'".cleanvars($_POST['std_firstname'])."'						,
														'".cleanvars($_POST['std_lastname'])."'							,
														'".cleanvars($_POST['std_gender'])."'							, 
														'".cleanvars($_POST['id_guardian'])."'							, 
														'".$dob."'														,
														'".cleanvars($_POST['std_bloodgroup'])."'						, 
														'".cleanvars($_POST['id_country'])."'							, 
														'".cleanvars($_POST['std_city'])."'								, 
														'".cleanvars($_POST['std_nic'])."'								, 
														'".cleanvars($_POST['std_religion'])."'							, 
														'".cleanvars($_POST['std_phone'])."'							, 
														'".cleanvars($_POST['std_address'])."'							, 
														'".cleanvars($_POST['id_class'])."'								, 
														'".cleanvars($_POST['id_section'])."'							, 
														'".cleanvars($_POST['id_group'])."'								, 
														'".cleanvars($_POST['id_session'])."'							, 
														'".cleanvars($_POST['std_rollno'])."'							, 
														'".cleanvars($_POST['std_regno'])."'							, 
														'".$admissiondate."'											,
														'".cleanvars($_POST['id_loginid'])."'							, 
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														NOW()
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
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['std_firstname'].'-'.$_POST['std_lastname'])).'_'.$std_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['std_firstname'].'-'.$_POST['std_lastname'])).'_'.$std_id.".".($extension);
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
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Student: "'.cleanvars($_POST['std_nic']).'" detail';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks										, 
															id_campus				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: students.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
}
//--------------------------------------
 
//----------------class update reocrd----------------------
if(isset($_POST['changes_student'])) { 
//------------Date variable--------------------------
$dob = date('Y-m-d' , strtotime(cleanvars($_POST['std_dob'])));
$admissiondate = date('Y-m-d' , strtotime(cleanvars($_POST['std_admissiondate'])));
//------------------------------------------------

$sqllms  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													std_status				= '".cleanvars($_POST['std_status'])."'
												  , std_firstname			= '".cleanvars($_POST['std_firstname'])."' 
												  , std_lastname			= '".cleanvars($_POST['std_lastname'])."' 
												  , std_gender				= '".cleanvars($_POST['std_gender'])."' 
												  , id_guardian				= '".cleanvars($_POST['id_guardian'])."' 
												  , std_dob					= '".$dob."' 
												  , std_bloodgroup			= '".cleanvars($_POST['std_bloodgroup'])."' 
												  , id_country				= '".cleanvars($_POST['id_country'])."' 
												  , std_city				= '".cleanvars($_POST['std_city'])."' 
												  , std_nic					= '".cleanvars($_POST['std_nic'])."' 
												  , std_religion			= '".cleanvars($_POST['std_religion'])."' 
												  , std_phone				= '".cleanvars($_POST['std_phone'])."' 
												  , std_address				= '".cleanvars($_POST['std_address'])."' 
												  , id_class				= '".cleanvars($_POST['id_class'])."' 
												  , id_section				= '".cleanvars($_POST['id_section'])."' 
												  , id_group				= '".cleanvars($_POST['id_group'])."' 
												  , id_session				= '".cleanvars($_POST['id_session'])."' 
												  , std_rollno				= '".cleanvars($_POST['std_rollno'])."' 
												  , std_regno				= '".cleanvars($_POST['std_regno'])."' 
												  , std_admissiondate		= '".$admissiondate."'  
												  , id_loginid				= '".cleanvars($_POST['id_loginid'])."' 
												  , id_campus				= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify				= NOW()
													WHERE std_id			= '".cleanvars($_POST['std_id'])."'");
									
//--------------------------------------
if(!empty($_FILES['std_photo']['name'])) { 
//--------------------------------------
	$path_parts 	= pathinfo($_FILES["std_photo"]["name"]);
	$extension 		= strtolower($path_parts['extension']);
	$img_dir 	= 'uploads/images/students/';
//--------------------------------------
	$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['std_firstname'].'-'.$_POST['std_lastname'])).'_'.$_POST['std_id'].".".($extension);
	$img_fileName	= to_seo_url(cleanvars($_POST['std_firstname'].'-'.$_POST['std_lastname'])).'_'.$_POST['std_id'].".".($extension);
//--------------------------------------
	if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 
//--------------------------------------
		$sqllmsupload  = $dblms->querylms("UPDATE ".STUDENTS."
														SET std_photo = '".$img_fileName."'
													WHERE  std_id		  = '".cleanvars($_POST['std_id'])."'");
		unset($sqllmsupload);
		$mode = '0644'; 
//--------------------------------------	
		move_uploaded_file($_FILES['std_photo']['tmp_name'],$originalImage);
		chmod ($originalImage, octdec($mode));
//--------------------------------------
	}
//--------------------------------------
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Student: "'.cleanvars($_POST['std_nic']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks										, 
															id_campus				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: students.php", true, 301);
			exit();
//--------------------------------------
	}
}
//--------------------------------------


