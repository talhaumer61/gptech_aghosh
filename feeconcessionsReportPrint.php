<?php 
//------------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//------------------------------------------------
$dated   =  date('Y-m', strtotime($_POST['monthdate']));

$mode_id 	= '';
$mode_name 	= '';
$sql1 		= '';


echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Concessions Report Print</title>
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
table td.label { font-weight:bold; margin: 0; text-align:left; padding:2px; vertical-align:middle !important; }

table.datatable { border: 1px solid #333; border-collapse: collapse; border-spacing: 0; margin-top:10px; }

table.datatable td { 
	border: 1px solid #888; border-collapse:collapse; border-spacing: 0; padding:5px; 
	font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:13px; color:#000; 
}

table.datatable th { 
	border: 1px solid #888; border-collapse:collapse; border-spacing: 0; padding:5px; background:#f4f4f4; 
	font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:13px;  font-weight:600; 
}



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
if(isset($_POST['show_result'])){
    echo '
    <table width="100%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
        <tr>
            <td  valign="top" colspan="10">
                <h2 style="text-align: center;">
                    <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                    <span>'.SCHOOL_NAME.'</span>
                </h2>';
                    $sr = 0; 
	$grandStudents 	  = 0;
	$granddayscholars   = 0;
	$grandHosalize 	  = 0;
	$grandConcessions = 0;
	$grandTuitionFee = 0;
	$grandRECEIVABLE = 0;
	
	 foreach ($classgroup as $group) {
                    $sqllmsCats = $dblms->querylms("SELECT class_id, class_name, 
														(SELECT COUNT(std_id) as Students FROM ".STUDENTS." 
															WHERE id_class = ".CLASSES.".class_id 
															AND std_id NOT IN (SELECT id_std FROM ".HOSTEL_REG." WHERE status = '1' 
																						AND id_std =".STUDENTS.".std_id 
																				)
															AND std_status = '1' AND is_orphan != '1' ) as TotalStudents, 
														(SELECT COUNT(std_id) as Students FROM ".STUDENTS." 
															WHERE id_class = ".CLASSES.".class_id 
															AND std_id IN (SELECT id_std FROM ".HOSTEL_REG." WHERE status = '1' 
																						AND id_std =".STUDENTS.".std_id 
																				)
															AND std_status = '1' AND is_orphan != '1') as TotalBoarderStudents
                                                        FROM ".CLASSES."			   
                                                        WHERE class_id != '' AND class_status = '1' AND is_deleted != '1'
														 AND id_classgroup   = '".cleanvars($group['id'])."'
                                                        ORDER BY class_ordering ASC");  
                    
                    if(mysqli_num_rows($sqllmsCats) > 0) {
                        echo'
                        <div style="">
                           <table class="datatable" style="margin:3px 0; width:100%;">
                                <thead>
                                    <tr>
                                        <td colspan="10"><h4 style="margin-top: 10px;">Active Students Fee & Concession Report</td>
                                    </tr>
									<tr>
                                          <td colspan="10"><h3>'.get_classgroup($group['id']).'</h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan="10"><h4>For the month of '.date('F Y', strtotime($_POST['monthdate'])).'</h4></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center; font-weight:bold; width: 50px;">Sr #</th>
                                        <th style="text-align:center; font-weight:bold;">Class Name</th>
                                        <th style="text-align:center; font-weight:bold;width: 100px;">Day Scholar</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Hosalize</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Total Students</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Actual Total Fee</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Concession</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Monthly Fee Receivable</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $TotalStudents = 0;
                                $TotalDayScholar = 0;
                                $TotalHosalize = 0;
                                $ConcessionsTotal = 0;
                                $TotalTuitionFee = 0;
                                $TOTALRECEIVABLE = 0;
						$srno = 0;
                                    while($valueCats = mysqli_fetch_array($sqllmsCats)) { 
								$srno++;
									$conditions = array ( 
															'select' 		=> "SUM(CASE WHEN ".FEESETUPDETAIL.".id_cat IN ('2', '9') AND ".FEESETUPDETAIL.".duration = 'Monthly' then ".FEESETUPDETAIL.".amount end) as TuitionFee, 
																				SUM(CASE WHEN ".FEESETUPDETAIL.".id_cat IN ('2', '9', '8', '7', '6') AND ".FEESETUPDETAIL.".duration = 'Monthly' then ".FEESETUPDETAIL.".amount end) as BoarderFee",
															'join' 			=> "INNER JOIN ".FEESETUPDETAIL." ON ".FEESETUPDETAIL.".id_setup =  ".FEESETUP.".id 
																				INNER JOIN ".CLASSES." ON ".CLASSES.".class_id =  ".FEESETUP.".id_class ",
															'where' 		=> array ( 
																							  ''.FEESETUP.'.id_session' 	=> $_SESSION['userlogininfo']['ACADEMICSESSION']
																							, ''.FEESETUP.'.id_class' 		=> $valueCats['class_id']
																							, ''.FEESETUP.'.is_deleted' 	=> 0
																					 ), 
															'limit' 		=> 1,
															'return_type' 	=> 'single' 
												); 
									$Setupfee 	= $dblms->getRows(FEESETUP, $conditions);
										
									$conditioncons = array ( 
															'select' 		=> "SUM(".SCHOLARSHIP.".amount) as TotalConcessions",
															'join' 			=> "INNER JOIN ".CLASSES." ON ".CLASSES.".class_id =  ".SCHOLARSHIP.".id_class 
																				INNER JOIN ".STUDENTS." ON ".STUDENTS.".std_id =  ".SCHOLARSHIP.".id_std",
															'where' 		=> array ( 
																							  ''.STUDENTS.'.id_class' 	=> $valueCats['class_id']
																							, ''.SCHOLARSHIP.'.status' 		=> 1 
																							, ''.SCHOLARSHIP.'.is_deleted' 	=> 0 
																							, ''.SCHOLARSHIP.'.id_session' 	=> $_SESSION['userlogininfo']['ACADEMICSESSION']
																					 ), 
															 'search_by' 	=> " AND ".STUDENTS.".std_status = '1' AND ".STUDENTS.".is_orphan != '1' AND ".STUDENTS.".std_id NOT IN (SELECT id_std FROM ".HOSTEL_REG." WHERE status = '1' 
																						AND ".HOSTEL_REG.".id_std =".STUDENTS.".std_id 
																				)"
															, 'limit' 		=> 1,
															'return_type' 	=> 'single' 
												); 
									$Concessions 	= $dblms->getRows(SCHOLARSHIP, $conditioncons);
										
									$conditionconsboardar = array ( 
															'select' 		=> "SUM(".SCHOLARSHIP.".amount) as TotalBoarderConcessions",
															'join' 			=> "INNER JOIN ".CLASSES." ON ".CLASSES.".class_id =  ".SCHOLARSHIP.".id_class 
																				INNER JOIN ".STUDENTS." ON ".STUDENTS.".std_id =  ".SCHOLARSHIP.".id_std",
															'where' 		=> array ( 
																							  ''.STUDENTS.'.id_class' 	=> $valueCats['class_id']
																							, ''.SCHOLARSHIP.'.status' 		=> 1 
																							, ''.SCHOLARSHIP.'.is_deleted' 	=> 0 
																							, ''.SCHOLARSHIP.'.id_session' 	=> $_SESSION['userlogininfo']['ACADEMICSESSION']
																					 ), 
															 'search_by' 	=> " AND ".STUDENTS.".std_status = '1' AND ".STUDENTS.".is_orphan != '1' AND ".STUDENTS.".std_id IN (SELECT id_std FROM ".HOSTEL_REG." WHERE status = '1' 
																						AND ".HOSTEL_REG.".id_std =".STUDENTS.".std_id 
																				)"
															, 'limit' 		=> 1,
															'return_type' 	=> 'single' 
												); 
									$Concessionsboarder 	= $dblms->getRows(SCHOLARSHIP, $conditionconsboardar);
									if($valueCats['TotalBoarderStudents']>0) {
										$boardarfee 			= $Setupfee['BoarderFee'];
										$totalboardarfee 		= ($Setupfee['BoarderFee'] * $valueCats['TotalBoarderStudents']);
										$boardarfeeconcession 	= ($Concessionsboarder['TotalBoarderConcessions']);
										$balanceboardarfee 		= (($Setupfee['BoarderFee'] * $valueCats['TotalBoarderStudents']) - $Concessionsboarder['TotalBoarderConcessions']);
									} else {
										$boardarfee 			= 0;
										$totalboardarfee 		= 0;
										$boardarfeeconcession 	= 0;
										$balanceboardarfee 		= 0;
									}
									if($valueCats['TotalStudents']>0) {
										$dayscholarfee 				= $Setupfee['TuitionFee'];
										$totaldayscholarfee 		= ($Setupfee['TuitionFee'] * $valueCats['TotalStudents']);
										$dayscholarfeeconcession 	= ($Concessionsboarder['TotalConcessions']);
										$balancedayscholarfee 		= (($Setupfee['TuitionFee'] * $valueCats['TotalStudents']) - $Concessionsboarder['TotalConcessions']);
									} else {
										$dayscholarfee 				= 0;
										$totaldayscholarfee 		= 0;
										$dayscholarfeeconcession 	= 0;
										$balancedayscholarfee 		= 0;
									}
                                        
                                        echo '
                                        <tr>
                                            <td style="text-align:center;">'.$srno.'</td>
                                            <td>'.$valueCats['class_name'].'</td>
                                            <td style="text-align:right;">'.number_format($valueCats['TotalStudents']).'</td>
											<td style="text-align:right;">'.number_format($valueCats['TotalBoarderStudents']).'</td>
											<td style="text-align:right;">'.number_format($valueCats['TotalStudents'] + $valueCats['TotalBoarderStudents']).'</td>
                                            <td style="text-align:right;">'.number_format($totaldayscholarfee + $totalboardarfee).'</td>
                                            <td style="text-align:right;">'.number_format($dayscholarfeeconcession + $boardarfeeconcession).'</td>
                                            <td style="text-align:right;">'.number_format(($totaldayscholarfee + $totalboardarfee) - ($dayscholarfeeconcession + $boardarfeeconcession)).'</td>
                                        </tr>';
                                       $TotalStudents 	 = ($TotalStudents + ($valueCats['TotalStudents'] + $valueCats['TotalBoarderStudents']));
                                       $ConcessionsTotal = ($ConcessionsTotal + ($dayscholarfeeconcession + $boardarfeeconcession));
                                       $TotalTuitionFee  = ($TotalTuitionFee + ($totaldayscholarfee + $totalboardarfee));
                                       $TOTALRECEIVABLE  = ($TOTALRECEIVABLE + (($totaldayscholarfee + $totalboardarfee) - ($dayscholarfeeconcession + $boardarfeeconcession))); 
										
										$TotalDayScholar = ($TotalDayScholar + $valueCats['TotalStudents']);
										$TotalHosalize 	= ($TotalHosalize + $valueCats['TotalBoarderStudents']);
                                    }
                                    
                                    echo'
									</tbody>
                                    <tr style=" text-align: center; border: 2px solid black;">
                                        <th colspan="2">Sub Total</th>
										 <th style="text-align: right;">'.number_format($TotalDayScholar).'</th>
										 <th style="text-align: right;">'.number_format($TotalHosalize).'</th>
										 <th style="text-align: right;">'.number_format($TotalStudents).'</th>
                                        <th style="text-align: right;">'.number_format($TotalTuitionFee).'</th>
                                        <th style="text-align: right;">'.number_format($ConcessionsTotal).'</th>
                                        <th style="text-align: right;">'.number_format($TOTALRECEIVABLE).'</th>
                                    </tr>
                                
                            </table>
                        </div>                    
                        <div class="page-break"></div>';
					}
		 				$grandStudents 		= ($grandStudents + $TotalStudents);
		 				$granddayscholars 	= ($granddayscholars + $TotalDayScholar);
		 				$grandHosalize		= ($grandHosalize + $TotalHosalize);
		 				$grandTuitionFee 	= ($grandTuitionFee + $TotalTuitionFee);
		 				$grandConcessions 	= ($grandConcessions + $ConcessionsTotal);
		 				$grandRECEIVABLE 	= ($grandRECEIVABLE + $TOTALRECEIVABLE);
                    }
                echo '
                  <table class="datatable" style="margin:30px 0; width:100%; ">
				    <thead>
				   <tr style=" text-align: center;  border: 2px solid black;">
					 <th colspan="2">Grand Total</th>
					 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($granddayscholars).'</th>
					 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandHosalize).'</th>
					 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandStudents).'</th>

					 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandTuitionFee).'</th>
					 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandConcessions).'</th>
					 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandRECEIVABLE).'</th>
					</tr>
					  </thead>
				  </table>
            </td>
        </tr>
		
    </table>
	<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
    <span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>';
}


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