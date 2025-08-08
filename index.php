<?php
	include "include/dbsetting/lms_vars_config.php";
	include "include/dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "include/functions/login_func.php";
	checkCpanelLMSALogin();
if(isset($_SESSION['userlogininfo']['LOGINIDA'])) {
	header("Location:dashboard.php");
	exit();
} else { 
	header("Location:login.php");
	exit();
}
//echo 'hello';
?>