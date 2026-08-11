<?php
require_once ("../include/dbsetting/lms_vars_config.php");
require_once ("../include/dbsetting/classdbconection.php");
require_once ("../include/functions/functions.php");
//include_once '../PHPMailer/PHPMailerAutoload.php';
$dblms = new dblms();

date_default_timezone_set("Asia/Karachi");

$apiKey 		= 'Ag0$HG$a8s6duiabsdY$AYrsd4a6sUYS%AD564';
$bankCode 		= array(4000, 4011);
$bankCharges 	= 0;
$latefee 		= 300;
$challanprefix 	= 9930;

$dataArray = json_decode(file_get_contents('php://input'), true);

if($controller == 'get-voucher-info') {

	include_once("include/voucher-info.php");

}  else if($controller == 'voucher-payment') {

	include_once("include/voucher-payment.php");

} else {

	echo 'Not Allowed!';

}
?>