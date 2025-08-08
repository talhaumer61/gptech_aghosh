<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '45', 'view' => '1'))){ 
	include_once("include/".get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/admins.php");
}
else{
	header("Location: dashboard.php");
}
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>