<?php
session_start();
//**********Admin Area Login checking ***********************/
function checkCpanelLMSALogin() {
// if the session id is not set, redirect to login page
	if(!isset($_SESSION['userlogininfo']['LOGINIDA'])) {
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

	require_once ("include/dbsetting/lms_vars_config.php");
	require_once ("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
//******* if we found an error save the error message in this variable**********
	$errorMessage = '';
	$admin_user   = cleanvars($_POST['login_id']);
	$admin_pass1  = cleanvars($_POST['login_pass']);
	$admin_pass3  = ($admin_pass1);

//*************** first, make sure the adminname & password are not empty******
	if($admin_user == '') {
		$errorMessage = 'You must enter your User Name';
	} else if ($admin_pass3 == '') {
		$errorMessage = 'You must enter the User Password';
	} else {
// **************Check the admin name and password exist*****************
		$sqllms	= $dblms->querylms("SELECT * FROM ".ADMINS."
											 WHERE adm_username = '".$admin_user."' 
											 AND adm_status = '1' LIMIT 1");

//************** if the admin name and password exist then **************** 	
	if (mysqli_num_rows($sqllms) == 1) {
	$row = mysqli_fetch_array($sqllms); 
	$salt = $row['adm_salt'];
	$password = hash('sha256', $admin_pass3 . $salt);
	for ($round = 0; $round < 65536; $round++) {
		$password = hash('sha256', $password . $salt);
	}
	
	if($password == $row['adm_userpass']) {

//******************* MAKE LOGIN HISTORY START ***********************
	$sqllms  = $dblms->querylms("INSERT INTO ".LOGIN_HISTORY."(
														login_type			, 
														id_login_id			,  
														user_pass			,
														id_campus			,
														dated			
													  )
	   											VALUES(
														'".cleanvars($row['adm_logintype'])."'	, 
														'".cleanvars($row['adm_id'])."'			,
														'".cleanvars($_POST['login_pass'])."'	,
														'".cleanvars($row['id_campus'])."'		,
														NOW()												
													  )"
							);
//******************* MAKE LOGIN HISTORY END ***********************	

//******************* SELECT ACTIVE SESSION START *********************

$sqllms_setting	= $dblms->querylms("SELECT s.adm_session, s.acd_session, s.exam_session, se.session_name, se.session_startdate 
											FROM ".SETTINGS." s  
											INNER JOIN ".SESSIONS." se ON se.session_id = s.acd_session 
											WHERE s.status ='1' AND s.is_deleted != '1' LIMIT 1");
//-----------------------------------------------------
$values_setting = mysqli_fetch_array($sqllms_setting);

//******************* SELECT ACTIVE SESSION END ***********************
	
// ***************Login time when the admin login **************
	$userlogininfo = array();
		$userlogininfo['LOGINIDA'] 			= $row['adm_id'];
		$userlogininfo['LOGINTYPE'] 		= $row['adm_type'];
		$userlogininfo['LOGINAFOR'] 		= $row['adm_logintype'];
		$userlogininfo['LOGINUSER'] 		= $row['adm_username'];
		$userlogininfo['LOGINNAME'] 		= $row['adm_fullname'];
		$userlogininfo['LOGINPHOTO'] 		= 'uploads/admin_image/'.$row['adm_photo'];
		$userlogininfo['LOGINCAMPUS'] 		= $row['id_campus'];
		$userlogininfo['ADM_SESSION'] 		= $values_setting['adm_session'];
		$userlogininfo['ACADEMICSESSION'] 	= $values_setting['acd_session'];
		$userlogininfo['EXAM_SESSION']	 	= $values_setting['exam_session'];
		$userlogininfo['ACA_SESSION_NAME'] 	= $values_setting['session_name'];
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

$remarks = 'Login to Software';
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
															'4'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");

//**************Store into session url  Last page visit*******************  
	if($row['adm_id'] == 2095) {
		header("Location: feecollections.php");
		exit();
	} else {
		header("Location: dashboard.php");
		exit();
	}
	
	} else {
	$errorMessage = '<span style="color: yellow;"><p> Invalid User  Password.</p></span>';
	}
	
	} else {

//********** admin name and password dosn't much *******************
	$errorMessage = '<span style="color: yellow;"><p> Invalid User Name or Password.</p></span>';
	}		
}

return $errorMessage;
//mysql_close($link);
}

//****************Logout Function for admin site *******************************
function panelLMSALogout() {
	if (isset($_SESSION['userlogininfo']['LOGINIDA'])) {
		unset($_SESSION['userlogininfo']);
		unset($_SESSION['userroles']);
		session_destroy();
	}
	header("Location: login.php");
	exit;
}
?>