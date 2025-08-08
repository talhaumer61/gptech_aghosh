<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//------------------------------------------------
$sqllmscampus  = $dblms->querylms("SELECT * 
									FROM ".CAMPUS." 
									WHERE campus_status = '1' AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
$value_campus = mysqli_fetch_array($sqllmscampus);
//------------------------------------------------
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Cards Print</title>
<style type="text/css">
body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; }
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: A4 landscape;
	   margin: 4mm 4mm 1mm 4mm; 
	}
}
h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; }
h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:18px; font-weight:700; text-transform:uppercase; }
h4 { 
	margin:0;  margin-top: -31%; line-height: 0px; margin-bottom:1px; font-weight:normal; font-size:15px; font-weight:700; word-spacing:0.1em; margin-left: 53%;  
}
h5{
    margin-left: 53%;
}
table { font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; 
    background-image: url("assets/images/student_card/card_front.jpeg");background-repeat: no-repeat; background-size: 100% 100%;}
.line1 { width:100%; margin-top:2px; margin-bottom:5px; }

</style>
<link rel="shortcut icon" href="images/favicon/favicon.ico">
</head>

<body>';
//STUDENTS CARDS PRINT START
//-----------------------------------------------------
$class_id = $_GET['id_class'];

if(isset($_GET['id_class']))
{
    $sql2 = " AND s.id_class = '".$class_id."' ";
}
else
{
    $sql2 = "";
}
//-----------------------------------------------------
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_name, s.std_fathername, s.std_gender, 
								   s.std_nic, s.std_phone, s.id_class, s.id_session,
								   s.std_rollno, s.std_regno, s.std_photo, c.class_name, se.session_name
								   FROM ".STUDENTS." s
                                   INNER JOIN ".CLASSES." c  ON c.class_id = s.id_class
                                   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   WHERE s.std_id != '' AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2
								   ORDER BY s.std_id DESC");
//-----------------------------------------------------
// echo'<table width="30%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">';

//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
    //-----------------------------------------------------
    if($rowsvalues['std_photo']) { 
        $photo = 'uploads/images/students/'.$rowsvalues['std_photo'].'';
    } else {
        $photo = 'uploads/default-student.jpg';
    }
    //-----------------------------------------------------
    echo'
    <table width="49%" class="page" cellpadding="8" cellspacing="15" align="left" style="border-collapse:collapse; margin-left: 10px;">
        <tr>
            <td>
                <img src="'.$photo.'" style="width: 99px; height: 93px; margin-top: 22%; margin-bottom: 15px; margin-left: 23px;">
            </td>
        </tr>
        <tr>
            <td>
                <h4>'.$rowsvalues['std_name'].' '.$rowsvalues['std_fathername'].'</h4>
                <h5 >'.$rowsvalues['class_name'].'</h5>
                <h5 style="margin-top: -10px;">';if($rowsvalues['std_regno']){echo''.$rowsvalues['std_regno'].'';}else{echo'<br>';}echo'</h5>
                <h5 style="margin-top: -7px;">'.$rowsvalues['session_name'].'</h5>
            </td>

        </tr>
    </table>
    ';
}
//-----------------------------------------------------
// echo'</table>';
//----------------------------------------------------
//-------------------PRINT DETAILS------------------------
 /*   if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
        echo '<span style="font-size:9px; padding: 20px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
        }
    echo '
    <table width="100%" border="0" style="border-collapse:collapse;" cellpadding="10" cellspacing="5">
    
        <span style="font-size:9px; float:right; margin-top:3px; padding: 20px;">issue Date: '.date("m/d/Y").'</span>
        </div>
        
        <div style="clear:both;"></div>
        <div style="font-size:13px; color:#000; margin-top:20px;">
    </table>
    ';
	 */
//STUDENTS CARDS PRINT END



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