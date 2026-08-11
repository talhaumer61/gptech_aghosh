<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
	if($_SESSION['userlogininfo']['LOGINAFOR'] == 2){
		
	$sqllmscampus  = $dblms->querylms("SELECT * 
									   FROM ".CAMPUS." 
									   WHERE campus_status = '1' AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
    $value_campus = mysqli_fetch_array($sqllmscampus);
	
	if(isset($_GET['id_class']))
	{
		$sqllmsCls	= $dblms->querylms("SELECT class_name
										FROM ".CLASSES."
										WHERE class_id != '' AND class_status = '1' AND class_id IN (".$_GET['id_class'].") ");
										$classes = array();
		while($valueCls = mysqli_fetch_array($sqllmsCls)){
			array_push($classes, $valueCls['class_name']);
		}
	}
	
	// if(isset($_GET['status']))
	// {
	// 	$status = "Active";
	// }
	// if(isset($_GET['is_orphan']))
	// {
	// 	$is_orphan = "Orphan";
	// }
	//------------------------------------------------
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>'.SCHOOL_SHORT.' Students List</title>
<style type="text/css">
body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: A4 portrait;
	   margin: 4mm 4mm 4mm 4mm; 
	}
}
h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; }
h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:18px; font-weight:700; text-transform:uppercase; }
h4 { 
	text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:15px; font-weight:700; word-spacing:0.1em;  
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
//-------------- Students List Start ---------------
//-----------------------------------------------------
$class_id = $_GET['id_class'];
if(($_GET['id_class']))
{
    $sql2 = " AND s.id_class IN (".$class_id.") ";
	$clsJoin = " INNER JOIN ".CLASSES." c  ON c.class_id = s.id_class ";
	$clsVars = ', c.class_name ';
	$title = "of Class (".implode(", ",$classes).")";
}
else
{
    $sql2 = "";
	$clsJoin = " INNER JOIN ".CLASSES." c  ON c.class_id = s.id_class ";
	$clsVars = ', c.class_name ';
	$title = "of ".SCHOOL_NAME."";
}
// status
if($_GET['status'])
{
	$status = ", ".get_admstatus($_GET['status']);
	$sql3 = "AND s.std_status = '".$_GET['status']."'";
	$std_status = $_GET['status'];
}
else{
	$status = "";
	$sql3 = "";
	$std_status = "";
}
// oprhan
if($_GET['is_orphan'] && $_GET['is_orphan']==1)
{
	$is_orphan = ", Orphan";
	$sql4 = "AND s.is_orphan = '".$_GET['is_orphan']."'";
	$orphan = $_GET['is_orphan'];
}
else{
	$is_orphan = "";
	$sql4 = "";
	$orphan = "";
}
// gender
if($_GET['std_gender'])
{
	$gender = ", ".$_GET['std_gender'];
	$sql5 = "AND s.std_gender = '".$_GET['std_gender']."'";
	$std_gender = $_GET['std_gender'];
}
else{
	$gender = "";
	$sql5 = "";
	$std_gender = "";
}

//	is_hostelized
if($_GET['is_hostelized']){
	if($_GET['is_hostelized']==1){
		$sql6 = "AND s.is_hostelized = '1'";
		$is_hostelized = ", ".get_studenttype($_GET['is_hostelized']);
	}else{
		$sql6 = "AND s.is_hostelized != '1'";
		$is_hostelized = ", ".get_studenttype($_GET['is_hostelized']);
	}
}else{
	$sql6 = "";
	$is_hostelized = "";
}
//-----------------------------------------------------

$sqllms	= $dblms->querylms("SELECT s.std_status, s.std_name, s.std_fathername, s.std_rollno $clsVars
								   FROM ".STUDENTS." s
								   $clsJoin
								   WHERE s.std_id != '' AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   $sql2 $sql3 $sql4 $sql5 $sql6
								   ORDER BY c.class_name DESC");
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
	//------------------------------------------------------
	echo '
	<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top" '.$rightborder.' class="'.$clspaid.'">
			<div class="row">
			<h2>
				<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;">
				'.SCHOOL_NAME.' <span style="font-size: 14px;"></span>
			</h2>
			<h4>Students List '.$title.$status.$is_orphan.$gender.$is_hostelized.'</u></h4>
			</div>
	<div class="line1"></div>
	<div style="font-size:12px; margin-top:5px;">


	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 70px;">Sr #</td>
		<td style="text-align:left; font-size:12px; font-weight:bold;">Student Name</td>
		<td style="text-align:left; font-size:12px; font-weight:bold;">Father Name</td>
		<td style="text-align:left; font-size:12px; font-weight:bold;">Class</td>
		<td style="text-align:left; font-size:12px; font-weight:bold; width: 70px;">Roll No.</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 70px;">Status</td>
	</tr>';
	//------------------------------------------------
	while($valueStudent = mysqli_fetch_array($sqllms)) {
        $srno++;	
        echo '
        <tr>
            <td style="text-align: center;">'.$srno.'</td>
            <td>'.$valueStudent['std_name'].'</td>
            <td>'.$valueStudent['std_fathername'].'</td>
            <td>'.$valueStudent['class_name'].'</td>
            <td>'.$valueStudent['std_rollno'].'</td>
            <td style="text-align:center;">'.get_stdstatus($valueStudent['std_status']).'</td>
        </tr>';
	}
	echo'
	</table>';
}
else{
    echo'<h3 style="color: red; text-align: center;">No Record Found!</h3>';
}

	echo'

	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">';
//------------ STUDENTS LIST END -----------------



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
}
else{
    header("Location: dashboard.php");
}
?>