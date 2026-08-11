<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
$yearmonth 	= (isset($_REQUEST['yearmonth']) && $_REQUEST['yearmonth'] != '') ? $_REQUEST['yearmonth'] : '';
$idclass 	= (isset($_REQUEST['idclass']) && $_REQUEST['idclass'] != '') ? $_REQUEST['idclass'] : '';
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Collection Report Print</title>
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
                <span style="">Aghosh Grammar School</span>
            </h2>';

if($yearmonth && !$idclass) {
                foreach ($classgroup as $group):
                    $sr = 0;
                    
                    $totalstudents      = 0;
                    $totalpayable       = 0; 
                    $totalpaid          = 0;
                    $totalpending       = 0;
                    $totalActaulfee     = 0;
                    $totalConcession     = 0;

                    $sqllmsClass = $dblms->querylms("SELECT class_id, class_name, id_classgroup
                                                            FROM ".CLASSES."			   
                                                            WHERE class_id     != '' 
                                                            AND class_status    = '1' 
                                                            AND is_deleted      = '0' 
                                                            AND id_classgroup   = '".cleanvars($group['id'])."'
                                                            ORDER BY class_id ASC");
                    if(mysqli_num_rows($sqllmsClass) > 0){
                        echo'
                            <div style="font-size:12px; margin-top:10px;">
                                <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan="6"><h4>'.get_classgroup($group['id']).'</h4></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><h4 style="margin: 5px; color: #000;">Fee Collection Summary ('.date("F, Y", strtotime($yearmonth)).')</h4></td>
                                        </tr>
                                        
                                        <tr>
                                            <th width="50">Sr #</th>
                                            <th style="text-align:left;">Class</th>
                                            <th width="100">Students</th>
                                            <!--th width="100">Actual Fee</th-->
											<!--th width="100">Concession</th-->
											<th width="100">Monthly Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        while($rowClass = mysqli_fetch_array($sqllmsClass)){
											
											/*$sqllmsfeedetail = $dblms->querylms("SELECT SUM(fsd.amount) as Actaulfee 
																FROM ".FEESETUPDETAIL." fsd 
																INNER JOIN ".FEESETUP." f ON fsd.id_setup = f.id 													 
																WHERE f.is_deleted != '1' AND f.status = '1'
																AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																AND fsd.id_cat IN (2,9) AND  f.id_class = ".$rowClass['class_id']." 
																GROUP BY fsd.id_setup ORDER BY f.id DESC LIMIT 1");
											$value_detail = mysqli_fetch_array($sqllmsfeedetail);*/
											
                                            $sr++;
                                            $sqllmsFeeDefaulter	= $dblms->querylms("SELECT COUNT(DISTINCT f.id_std) totalstudents, SUM(f.total_amount) as totalamount
                                                                                    FROM ".FEES." f
                                                                                    WHERE f.id_class = ".$rowClass['class_id']." 
																					AND f.yearmonth = '".date("Y-m", strtotime($yearmonth))."'
                                                                                    AND f.is_deleted != '1'
                                                                                    AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");																				
                                            
                                            if(mysqli_num_rows($sqllmsFeeDefaulter) > 0) { 
												
                                            
                                                $rowStudent = mysqli_fetch_array($sqllmsFeeDefaulter);
                                              
                                                echo '
                                                <tr>
                                                    <td style="text-align: center;">'.$sr.'</td>
                                                    <td><a href="feecollectionreportprint.php?yearmonth='.$yearmonth.'&idclass='.$rowClass['class_id'].'" style="text-decoration: none; color: #000;" target="_blank">'.$rowClass['class_name'].'</a></td>
                                                    <td style="text-align: center;">'.number_format($rowStudent['totalstudents']).'</td>
                                                   
                                                   
                                                    <td style="text-align: right;">'.number_format($rowStudent['totalamount']).'</td>
                                                </tr>';
                                            }
                                            $totalstudents     = ($totalstudents + $rowStudent['totalstudents']);
                                           // $totalActaulfee    = ($totalActaulfee + ($rowStudent['totalstudents'] * $value_detail['Actaulfee']));
                                          //  $totalConcession   = ($totalConcession + (($rowStudent['totalstudents'] * $value_detail['Actaulfee']) - $rowStudent['totalamount']));
                                            $totalpayable      = ($totalpayable + $rowStudent['totalamount']);
                                           
                                        }
                                        echo'
                                        <tr>
                                            <td colspan="2" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Grand Total</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalstudents).'</td>
                                            <!--td style="text-align:right; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalActaulfee).'</td-->
                                            <!--td style="text-align:right; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalConcession).'</td-->
                                            <td style="text-align:right; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalpayable).'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="page-break"></div>';
                    }

                endforeach;
} elseif($yearmonth && $idclass) { 
	$sqllmsClass = $dblms->querylms("SELECT class_id, class_name
                                            FROM ".CLASSES."			   
                                            WHERE class_id     = '".$idclass."' LIMIT 1");
	$rowClass = mysqli_fetch_array($sqllmsClass);
	   echo'
                            <div style="font-size:12px; margin-top:10px;">
                                <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan="6"><h4>'.($rowClass['class_name']).'</h4></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><h4 style="margin: 5px; color: #000;">Fee Collection Summary ('.date("F, Y", strtotime($yearmonth)).')</h4></td>
                                        </tr>
                                        
                                        <tr>
                                            <th width="50">Sr #</th>
                                            
                                            <th style="text-align:left;">Student Name</th>
                                            <th style="text-align:left;">Father Name</th>
											<th width="100">Challan #</th>
                      						<th width="100">Monthly Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
	
											 $totalpayable       = 0; 
                                            $sr = 0;
                                            $sqllmsFeeDefaulter	= $dblms->querylms("SELECT f.challan_no, f.total_amount, st.* 
                                                                                    FROM ".FEES." f 
																					INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std	
                                                                                    WHERE f.id_class = ".$rowClass['class_id']." 
																					AND f.yearmonth = '".date("Y-m", strtotime($yearmonth))."'
                                                                                    AND f.is_deleted != '1'
                                                                                    AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");																				
                                            
                                            if(mysqli_num_rows($sqllmsFeeDefaulter) > 0) { 
												
                                           
                                                while($rowStudent = mysqli_fetch_array($sqllmsFeeDefaulter)) {
                                               $sr++;
                                                echo '
                                                <tr>
                                                    <td style="text-align: center;">'.$sr.'</td>
                                                   
                                                    <td>'.$rowStudent['std_name'].'</td>
                                                    <td>'.$rowStudent['std_fathername'].'</td>
                                                    <td style="text-align: center;"><a href="feechallanprint.php?id='.$rowStudent['challan_no'].'" target="_blank" style="text-decoration: none; color: #000;">'.$rowStudent['challan_no'].'</a></td>  
                                                    <td style="text-align: right;">'.number_format($rowStudent['total_amount']).'</td>
                                                </tr>';
													$totalpayable     = ($totalpayable + $rowStudent['total_amount']);
                                            }
                                            
                                            
                                           
                                        }
                                        echo'
                                        <tr>
                                            <td colspan="4" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Grand Total</td>
                                            <td style="text-align:right; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalpayable).'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>';
	
}
			echo '
			<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
			<span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
		</td>
	</tr>
</table>
</body>

</html>';
?>