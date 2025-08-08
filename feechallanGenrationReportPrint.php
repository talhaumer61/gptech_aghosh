<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();

//------------------------------------------------
if(isset($_GET['cls']) && $_GET['cls'] != 'all' && $_GET['cls'] != '') {
    $sql2 = "AND class_id = '".cleanvars($_GET['cls'])."'";
}
else{
    $sql2 = "";
}
if(isset($_POST['yearmonth']) && !empty($_POST['yearmonth'])){
    $yearmonth  = $_POST['yearmonth'];
    $id_month   = date('m',strtotime($yearmonth));
}else{
    $yearmonth = date('Y-m');    
    $id_month   = date('m');
}
//------------------------------------------------
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Defaulter Report Print</title>
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

<body>
<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top">
            <h2 style="text-align: center;">
                <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                <span style="">'.SCHOOL_NAME.'</span>
            </h2>';
                $sr = 0; 

                $sqllmsClass = $dblms->querylms("SELECT class_id, class_name
                                                        FROM ".CLASSES."			   
                                                        WHERE class_id != '' AND class_status = '1' AND is_deleted != '1'
                                                        $sql2 ORDER BY class_id ASC");
                
                if(mysqli_num_rows($sqllmsClass) > 0) {
                    //----------------------------------------
                    echo'
                    <div style="font-size:12px; margin-top:10px;">
                        <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                            <thead>
                                <tr>
                                    <td colspan="7"><h4 style="margin-top: 10px;">Challan Generation Report of '.get_monthtypes($id_month).'</h4></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><h4>'.date('l d M Y').'</h4></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center; font-size:12px; font-weight:bold; width: 15px;">Sr #</td>
                                    <td style="text-align:center; font-size:12px; font-weight:bold;">Class</td>
                                    <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Challan Status</td>
                                </tr>
                            </thead>
                            <tbody>';
                                //-----------------------------------------------------
                                while($rowClass = mysqli_fetch_array($sqllmsClass)) {
                                    
                                    $sqllmsTotalChallan	= $dblms->querylms("SELECT f.id
                                                                                FROM ".FEES." f
                                                                                INNER JOIN ".FEE_PARTICULARS." p ON p.id_fee = f.id AND p.id_cat = '2'
                                                                                WHERE f.id_class    = '".cleanvars($rowClass['class_id'])."'
                                                                                AND f.yearmonth     = '".cleanvars($yearmonth)."'
                                                                                AND f.id_month      = '".cleanvars($id_month)."'
                                                                                AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                                                AND f.id_session    = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                                                                AND f.is_deleted    = '0' ");
                                    if(mysqli_num_rows($sqllmsTotalChallan) > 0) {
                                        $genrationStatus = 'Genrated';
                                    } else {
                                        $genrationStatus = 'Not Genrated';
                                    }
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td style="text-align:center;">'.$sr.'</td>
                                        <td style="width:100px;">'.$rowClass['class_name'].'</td> 
                                        <td style="text-align:right;">'.$genrationStatus.'</td>
                                    </tr>';
                                }
                                echo'
                            </tbody>
                        </table>
                    </div>';
                }
			echo '
			<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
			<span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
		</td>
	</tr>
</table>';

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