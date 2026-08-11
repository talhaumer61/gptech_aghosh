<?php 

require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
include('phpqrcode/qrlib.php');

	//$directoryName 		= 'uploads/qrcodes/'.$sesdir;
	$directoryNameterm 	= 'uploads/qrcodes/'.date("Y");

	if(!is_dir($directoryNameterm)){
		//Directory does not exist, so lets create it.
		mkdir($directoryNameterm, 0777);
		$content = "Options -Indexes";
		$fp = fopen($directoryNameterm."/.htaccess","wb");
		fwrite($fp,$content);
		fclose($fp);
	}
	
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.$directoryNameterm.DIRECTORY_SEPARATOR;
    	
    //html PNG location prefix
    $PNG_WEB_DIR = 'uploads/qrcodes/'.date("Y").'/';
	

$sqllmscampus  = $dblms->querylms("SELECT * 
									FROM ".CAMPUS." 
									WHERE campus_status = '1' AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
$value_campus = mysqli_fetch_array($sqllmscampus);

//$barcodeText 	= trim($_POST['barcodeText']);
$barcodeType	= 'code128';
$barcodeDisplay	= 'horizontal';
$barcodeSize	= 50;
$printText		= 'true';

echo '
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Fee Challan Form</title>
		<style type="text/css">
		body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
		@media all {
			.page-break	{ display: none; }
		}

		@media print {
			.page-break	{ display: block; page-break-before: always; }
			@page { 
				size: A4 landscape;
			margin: 0mm 4mm 2mm 4mm; 
			}
		}
		h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
		.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:0px; }
		h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:22px; font-weight:700; text-transform:uppercase; }
		.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
		h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:19px; font-weight:700; text-transform:uppercase; padding: 0px; }
		h4 { 
			text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:13px; font-weight:700; word-spacing:0.1em;  
		}
		td { padding-bottom:4px; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; }
		.line1 { border:1px solid #333; width:100%; margin-top:2px; margin-bottom:5px; }
		.payable { border:2px solid #000; padding:2px; text-align:center; font-size:14px; }

		.paid:after
		{
			content:"PAID";
			
			position:absolute;
			top:30%;
			left:20%;
			z-index:1;
			font-family:Arial,sans-serif;
			-webkit-transform: rotate(-5deg); /* Safari */
			-moz-transform: rotate(-5deg); /* Firefox */
			-ms-transform: rotate(-5deg); /* IE */
			-o-transform: rotate(-5deg); /* Opera */
			transform: rotate(-5deg);
			font-size:250px;
			color:green;
			background:#fff;
			border:solid 4px yellow;
			padding:5px;
			border-radius:5px;
			zoom:1;
			filter:alpha(opacity=50);
			opacity:0.1;
			-webkit-text-shadow: 0 0 2px #c00;
			text-shadow: 0 0 2px #c00;
			box-shadow: 0 0 2px #c00;
		}
		</style>
		<link rel="shortcut icon" href="images/favicon/favicon.ico">
		
	</head>
	<body>';

	//Single Challan Print
	if(isset($_GET['id'])){
		include_once("include/prints/feechallans/singlewa.php");
	}
	//End Single Challan Print

	echo '
	</body>
	<script type="text/javascript" language="javascript1.2">
		<!--
		//Do print the page
		if (typeof(window.print) != "undefined") {
			window.print();
		}
		-->
	</script>
</html>';
?>