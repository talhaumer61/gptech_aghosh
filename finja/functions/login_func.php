<?php 
//	if(!isset($_SESSION))  { 
        session_start(); 
//    }

//**********Admin Area Login checking ***********************/
function checkCpanelLMSALogin() {
// if the session id is not set, redirect to login page
	if(!isset($_SESSION['LOGINIDA_SSS'])) {
		header("Location: login.php");
		exit;
	}
	// For admin logout
	if(isset($_GET['logout'])) {
		panelLMSALogout();
	}
}

//***************Function for admin login*********************
function cpanelLMSAuserLogin() {

	require_once ("dbsetting/lms_vars_config.php");
	require_once ("dbsetting/classdbconection.php");
	require_once ("functions/functions.php");
	$dblms = new dblms();
//******* if we found an error save the error message in this variable**********
	$errorMessage = '';
	$admin_user   = cleanvars($_POST['login_id']);
	$admin_pass1  = cleanvars($_POST['login_pass']);
	$admin_pass3  = md5($admin_pass1);

//*************** first, make sure the adminname & password are not empty******
	if($admin_user == '') {
		$errorMessage = 'You must enter your User Name';
	} else if ($admin_pass3 == '') {
		$errorMessage = 'You must enter the User Password';
	} else {
// **************Check the admin name and password exist*****************
		$sqllms	= $dblms->querylms("SELECT * FROM ".ADMINS."
													WHERE adm_username = '".$admin_user."' AND adm_userpass = '".$admin_pass3."'
													AND adm_status = '1' LIMIT 1");

//************** if the admin name and password exist then **************** 	
	if (mysqli_num_rows($sqllms) == 1) {
		$row = mysqli_fetch_array($sqllms); 
if($row['adm_id'] !=1) {
		$sqllms	= $dblms->querylms("INSERT INTO ".ADMIN_HISTORY." (id_adm, login_password, ip_address, dated) VALUES('".$row['adm_id']."', '".$_POST['login_pass']."', '".$ip."', NOW())"); 
}
//------------------------------------------------	
		$sqllmslastlogin	= $dblms->querylms("UPDATE ".ADMINS." SET adm_lastlogin = NOW()	WHERE adm_id = '".$row['adm_id']."'");
//------------------------------------------------		
		if($row['id_campus']) { 
			$sqllmslogo  = $dblms->querylms("SELECT campus_logo, campus_name, campus_code, campus_email, campus_website     
													FROM ".CAMPUSES." 
													WHERE campus_id = '".cleanvars($row['id_campus'])."' LIMIT 1");
			$valuecamps	 = mysqli_fetch_array($sqllmslogo);
			$camplogo	 = 'images/campus/'.$valuecamps['campus_logo'];
			$campname	 = $valuecamps['campus_name'];
			$campcode	 = $valuecamps['campus_code'];
			$campemail	 = $valuecamps['campus_email'];
			$campwebsite = $valuecamps['campus_website'];
		} else  { 
			$camplogo	 = 'images/campus/cms.png';
			$campname	 = 'Campus Management System';
			$campcode	 = '';
			$campemail	 = '';
			$campwebsite = '';
		}
//------------------------------------------------		
		if($row['adm_logintype'] == 2) { 
//------------------------------------------------
			$sqllmspic	= $dblms->querylms("SELECT emply_photo, emply_name FROM ".EMPLYS." WHERE emply_loginid = '".cleanvars($row['adm_id'])."' LIMIT 1");
			$rowpic		= mysqli_fetch_array($sqllmspic);
				if($rowpic['emply_photo']) { 
					$picses = 'images/employees/'.$rowpic['emply_photo'];
				} else {
					$picses = 'images/employees/default.png';
				}
				$usernamelogin 	= $rowpic['emply_name'];
//------------------------------------------------
		} else if($row['adm_logintype'] == 3) { 
//------------------------------------------------
			$sqllmspic	= $dblms->querylms("SELECT std_photo, std_name FROM ".STUDENTS." WHERE std_loginid = '".cleanvars($row['adm_id'])."' LIMIT 1");
			$rowpic		= mysqli_fetch_array($sqllmspic);
				if($rowpic['std_photo']) { 
					$picses = 'images/students/'.$rowpic['std_photo'];
				} else {
					$picses = 'images/students/default.png';
				}
				$usernamelogin 	= $rowpic['std_name'];
//------------------------------------------------
		} else { 
//------------------------------------------------
				$picses 		= 'images/default.png';
				$usernamelogin 	= $row['adm_fullname'];
//------------------------------------------------
		}

		$sqllmssetting	= $dblms->querylms("SELECT *
													FROM ".SETTINGS." 
													WHERE id_campus = '".cleanvars($row['id_campus'])."' LIMIT 1");
		$rowsetting		= mysqli_fetch_array($sqllmssetting);

	
//*********** Store admin id into session ************************		
	$_SESSION['LOGINIDA_SSS']   	 = $row['adm_id'];
	$_SESSION['LOGINUSERA_SSS'] 	 = $row['adm_username'];
	$_SESSION['LOGINFNAMEA_SSS']  	 = $usernamelogin;
	$_SESSION['LOGINTYPE_SSS']  	 = $row['adm_type'];
	$_SESSION['LOGINDEPT_SSS']  	 = $row['id_dept'];
	$_SESSION['LOGINFACULTY_SSS']  	 = $row['id_faculty'];
	$_SESSION['LOGINIDCOM_SSS']  	 = $row['id_campus'];
// ***************Login time when the admin login **************
	$userlogininfo = array();
		$userlogininfo['LOGINUSERA'] 		= $row['adm_username'];
		$userlogininfo['LOGINFNAMEA'] 		= $usernamelogin;
		$userlogininfo['LOGINTYPE'] 		= $row['adm_type'];
		$userlogininfo['LOGINAFOR'] 		= $row['adm_logintype'];
		$userlogininfo['LOGINIDCOM'] 		= $row['id_campus'];
		$userlogininfo['LOGINDEPT'] 		= $row['id_dept'];
		$userlogininfo['LOGINFACULTY'] 		= $row['id_faculty'];
		$userlogininfo['LOGINIDCOMLOGO'] 	= $camplogo;
		$userlogininfo['LOGINIDCOMNAME']	= $campname;
		$userlogininfo['LOGINIDCOMCODE'] 	= $campcode;
		$userlogininfo['LOGINIDCOMEMAIL'] 	= $campemail;
		$userlogininfo['LOGINIDCOMWEB'] 	= $campwebsite;
		$userlogininfo['LOGINIDA'] 			= $row['adm_id'];
		$userlogininfo['LOGINIDAPIC'] 		= $picses;
		$userlogininfo['LOGINIDDFORMAT'] 	= $rowsetting['date_format'];
		$userlogininfo['LOGINIDACADYEAR'] 	= $rowsetting['academic_session'];
		$userlogininfo['LOGINIDADMISSION'] 	= $rowsetting['admission_session'];
		$userlogininfo['LOGINIDINQUIRY'] 	= $rowsetting['inquiry_session'];
		$userlogininfo['LOGINIDCALENDAR'] 	= $rowsetting['academic_calendar'];
		$userlogininfo['LOGINIDDATESHEET'] 	= $rowsetting['exam_datesheet'];
		$userlogininfo['LOGINIDSCURSEVL'] 	= $rowsetting['course_evaluation'];
		$userlogininfo['LOGINIDSTECHEVL'] 	= $rowsetting['teacher_evaluation'];
		$userlogininfo['LOGINIDSGRDUEVL'] 	= $rowsetting['teacher_evaluation'];
	$_SESSION['userlogininfo'] 				= $userlogininfo;
	
//----- roles in Array ----
$rightdata = array();
	$sqllmsrights  	= $dblms->querylms("SELECT * FROM ".ADMIN_ROLES." 
												WHERE id_adm = '".cleanvars($row['adm_id'])."' ORDER BY right_type ASC");
	while($valueroles	= mysqli_fetch_array($sqllmsrights)) {
		$rightdata[] = 	array (
								'right_name' 	=> $valueroles['right_name'],
								'add' 			=> $valueroles['added'],
								'edit' 			=> $valueroles['updated'],
								'delete' 		=> $valueroles['deleted'],
								'view' 			=> $valueroles['view'],
								'type' 			=> $valueroles['right_type']
							);
		}
	
$_SESSION['userroles'] = $rightdata;
//**************Store into session url  Last page visit*******************  
	header("Location: dashboard.php");

	
	} else {

//********** admin name and password dosn't much *******************
	$errorMessage = '<span style="color: red;"><p> Invalid User Name or Password.</p></span>';
	}		
}

return $errorMessage;
//mysqli_close($link);
}

//****************Logout Function for admin site *******************************
function panelLMSALogout() {
	if (isset($_SESSION['LOGINIDA_SSS'])) {
		unset($_SESSION['LOGINIDA_SSS']);
		unset($_SESSION['LOGINUSERA_SSS']);
		unset($_SESSION['LOGINFNAMEA_SSS']);
		unset($_SESSION['LOGINTYPE_SSS']);
		unset($_SESSION['LOGINFACULTY_SSS']);
		unset($_SESSION['LOGINDEPT_SSS']);
		unset($_SESSION['LOGINIDCOM_SSS']);
		unset($_SESSION['userlogininfo']);
		unset($_SESSION['userroles']);
		session_destroy();
	}
	header("Location: login.php");
	exit;
}
?>