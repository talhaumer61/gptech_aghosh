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

    echo '
    <table width="100%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
        <tr>
            <td  valign="top" colspan="10">
                <h2 style="text-align: center;">
                    <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                    <span>'.SCHOOL_NAME.'</span>
                </h2>';
                    
	
		$arrygrandtotal = array();
	 foreach ($classgroup as $group) { 
		
		
                    $sqllmsCats = $dblms->querylms("SELECT class_id, class_name 
                                                        FROM ".CLASSES."			   
                                                        WHERE class_id != '' AND class_status = '1' AND is_deleted != '1'
														AND id_classgroup   = '".cleanvars($group['id'])."'
                                                        ORDER BY class_ordering ASC");
                    
                    if(mysqli_num_rows($sqllmsCats) > 0) {
						echo '<h2>'.get_classgroup($group['id']).'</h2>';
								
						
						 while($valueCats = mysqli_fetch_array($sqllmsCats)) { 
							  $sr = 0; 
							 	$grandStudents 	  = 0;
								$grandConcessions = 0;
								$grandTuitionFee = 0;
								$grandRECEIVABLE = 0;
							 
							 	$hgrandStudents 	= 0;
								$hgrandConcessions = 0;
								$hgrandTuitionFee = 0;
								$hgrandRECEIVABLE = 0;	
                        echo'
                        <div style="">
                           <table class="datatable" style="margin:3px 0; width:100%;">
                                <thead>
									<tr>
                                          <td colspan="10"><h3>'.$valueCats['class_name'].'</h3></td>
                                    </tr>
									 <tr>
                                        <td colspan="10"><h4 style="margin-top: 10px;"> Students Fee & Concession Report</td>
                                    </tr>
                                   <tr>
                                        <td colspan="10"><h4 style="margin-top: 10px;">Day Scholar</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center; font-weight:bold; width: 50px;">Sr #</th>
                                        <th style="text-align:center; font-weight:bold;">Student name</th>
                                        <th style="text-align:center; font-weight:bold;width: 100px;">Form no</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Actual Fee</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Concession</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Monthly Fee</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $TotalStudents = 0;
                                $ConcessionsTotal = 0;
                                $TotalTuitionFee = 0;
                                $TOTALRECEIVABLE = 0;
							 	$hostelstudents = 0;
							 	$dayscholarstudents = 0;
							 	
							 $arrystudents = array();
						$srno = 0;
						$srjs = 0;
							 $conditions = array ( 
															'select' 		=> "*, (SELECT id_std FROM ".HOSTEL_REG." WHERE status = '1' 
																						AND ".HOSTEL_REG.".id_std =".STUDENTS.".std_id 
																				) as ishostel ",
															'where' 		=> array ( 
																							  'std_status' 	=> 1
																							, 'id_class' 	=> $valueCats['class_id']
																							, 'is_deleted' 	=> 0
																					 ), 
															'search_by' 	=> " AND is_orphan !='1'",
															'order_by' 		=> ' admission_formno ASC',
															'return_type' 	=> 'all' 
												); 
							$students 	= $dblms->getRows(STUDENTS, $conditions);
                               foreach($students as $liststudent)  {
								  
								   $conditionsset = array ( 
															'select' 		=> "SUM(CASE WHEN ".FEESETUPDETAIL.".id_cat IN ('2', '9') AND ".FEESETUPDETAIL.".duration = 'Monthly' then ".FEESETUPDETAIL.".amount end) as TuitionFee, 
																				SUM(CASE WHEN ".FEESETUPDETAIL.".id_cat IN ('2', '9', '8', '7', '6') AND ".FEESETUPDETAIL.".duration = 'Monthly' then ".FEESETUPDETAIL.".amount end) as BoarderFee",
															'join' 			=> "INNER JOIN ".FEESETUPDETAIL." ON ".FEESETUPDETAIL.".id_setup =  ".FEESETUP.".id 
																				INNER JOIN ".CLASSES." ON ".CLASSES.".class_id =  ".FEESETUP.".id_class ",
															'where' 		=> array ( 
																							  ''.FEESETUP.'.id_session' => $liststudent['id_session']
																							, ''.FEESETUP.'.id_class' 	=> $liststudent['id_class']
																							, ''.FEESETUP.'.is_deleted' => 0
																					 ), 
															'limit' 		=> 1,
															'return_type' 	=> 'single' 
												); 
									$Setupfee 	= $dblms->getRows(FEESETUP, $conditionsset);
								   $conditioncons = array ( 
															'select' 		=> "SUM(".SCHOLARSHIP.".amount) as TotalConcessions",
															'join' 			=> "INNER JOIN ".CLASSES." ON ".CLASSES.".class_id =  ".SCHOLARSHIP.".id_class 
																				INNER JOIN ".STUDENTS." ON ".STUDENTS.".std_id =  ".SCHOLARSHIP.".id_std",
															'where' 		=> array ( 
																							  ''.STUDENTS.'.id_class' 	   => $liststudent['id_class']
																							, ''.STUDENTS.'.std_id' 	   =>  $liststudent['std_id']
																							, ''.SCHOLARSHIP.'.status' 		=> 1 
																							, ''.SCHOLARSHIP.'.is_deleted' 	=> 0
																							, ''.SCHOLARSHIP.'.id_campus' 	=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS']) 
																							, ''.SCHOLARSHIP.'.id_session' 	=> cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])
																					 ), 
															 'limit' 		=> 1,
															'return_type' 	=> 'single' 
												); 
									$Concessions 	= $dblms->getRows(SCHOLARSHIP, $conditioncons);
								   
								   if($liststudent['ishostel']) { 
									    $data1['std_name'] 			= $liststudent['std_name'];
										$data1['admission_formno'] 	= $liststudent['admission_formno'];
										$data1['tuitionFee'] 		= $Setupfee['BoarderFee'];
										$data1['totalconcessions'] 	= $Concessions['TotalConcessions'];

										array_push($arrystudents,$data1);
									   //$arrystudents[] = $liststudent;
								  }
								   if(!$liststudent['ishostel']) { 
									   $srno++;
									   $TuitionFee = $Setupfee['TuitionFee'];
								   
									 echo '
                                        <tr>
                                            <td style="text-align:center;">'.$srno.'</td>
                                            <td >'.$liststudent['std_name'].'</td>
                                            <td>'.$liststudent['admission_formno'].'</td>
                                            <td style="text-align:right;">'.number_format($TuitionFee).'</td>
                                            <td style="text-align:right;">'.number_format($Concessions['TotalConcessions']).'</td>
                                            <td style="text-align:right;">'.number_format($TuitionFee - $Concessions['TotalConcessions']).'</td>
                                        </tr>';
								   $TotalTuitionFee = ($TotalTuitionFee + $TuitionFee);
								   $ConcessionsTotal = ($ConcessionsTotal + $Concessions['TotalConcessions']);
								   $TOTALRECEIVABLE = ($TOTALRECEIVABLE + ($TuitionFee - $Concessions['TotalConcessions']));
							  }
							   }
                  echo '
									</tbody>
                                    <tr style=" text-align: center; border: 2px solid black;">
                                        <th colspan="3">Total</th>
                                        <th style="text-align: right;">'.number_format($TotalTuitionFee).'</th>
                                        <th style="text-align: right;">'.number_format($ConcessionsTotal).'</th>
                                        <th style="text-align: right;">'.number_format($TOTALRECEIVABLE).'</th>
                                    </tr>';
								 $grandStudents = ($grandStudents + $TotalStudents);
								$grandTuitionFee = ($grandTuitionFee + $TotalTuitionFee);
								$grandConcessions = ($grandConcessions + $ConcessionsTotal);
								$grandRECEIVABLE = ($grandRECEIVABLE + $TOTALRECEIVABLE);
							 if(!empty($arrystudents)) { 
								 $HConcessionsTotal = 0;
                                $HTotalTuitionFee = 0;
                                $HTOTALRECEIVABLE = 0;
								 echo '
							
									<tr>
                                        <td colspan="10"><h4 style="margin-top: 10px;">Hostalize</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center; font-weight:bold; width: 50px;">Sr #</th>
                                        <th style="text-align:center; font-weight:bold;">Student name</th>
                                        <th style="text-align:center; font-weight:bold;width: 100px;">Form no</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Actual Fee</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Concession</th>
                                        <th style="text-align:center; font-weight:bold; width: 130px;">Monthly Fee</th>
                                    </tr>';
								 foreach($arrystudents as $listhostel) { 
									 $srjs++;
								  echo '
                                        <tr>
                                            <td style="text-align:center;">'.$srjs.'</td>
                                            <td >'.$listhostel['std_name'].'</td>
                                            <td>'.$listhostel['admission_formno'].'</td>
                                            <td style="text-align:right;">'.number_format($listhostel['tuitionFee']).'</td>
                                            <td style="text-align:right;">'.number_format($listhostel['totalconcessions']).'</td>
                                            <td style="text-align:right;">'.number_format($listhostel['tuitionFee'] - $listhostel['totalconcessions']).'</td>
                                        </tr>';
								  	$HTotalTuitionFee = ($HTotalTuitionFee + $listhostel['tuitionFee']);
								   $HConcessionsTotal = ($HConcessionsTotal + $listhostel['totalconcessions']);
								   $HTOTALRECEIVABLE = ($HTOTALRECEIVABLE + ($listhostel['tuitionFee'] - $listhostel['totalconcessions']));
								 
							 }
							echo '
								</tbody>
                                    <tr style=" text-align: center; border: 2px solid black;">
                                        <th colspan="3">Total</th>
                                        <th style="text-align: right;">'.number_format($HTotalTuitionFee).'</th>
                                        <th style="text-align: right;">'.number_format($HConcessionsTotal).'</th>
                                        <th style="text-align: right;">'.number_format($HTOTALRECEIVABLE).'</th>
                                    </tr>';
								$hgrandStudents = ($hgrandStudents + ($TotalStudents + $hConcessionsTotal));
								$hgrandTuitionFee = ($hgrandTuitionFee + ($HTotalTuitionFee));
								$hgrandConcessions = ($hgrandConcessions + ($HConcessionsTotal));
								$hgrandRECEIVABLE = ($hgrandRECEIVABLE + ($HTOTALRECEIVABLE));
									}
							 echo '
                            </table>
							<table class="datatable" style="margin:30px 0; width:100%; ">
							<thead>
						   <tr style=" text-align: center;  border: 2px solid black;">
							 <th colspan="3">Grand Total</th>
							 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandTuitionFee + $hgrandTuitionFee).'</th>
							 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandConcessions +$hgrandConcessions).'</th>
							 <th style="font-size:20px !important;text-align: right;width: 130px;">'.number_format($grandRECEIVABLE + $hgrandRECEIVABLE).'</th>
							</tr>
							  </thead>
						  </table>
                        </div>                    
                        <div class="page-break"></div>';
							 
							 $data12['group_id'] 			= $group['id'];
							 $data12['class_name'] 			= $valueCats['class_name'];
							 $data12['dayscholars'] 		= $srno;
							 $data12['hostilize'] 			= $srjs;
							 $data12['TuitionFee'] 			= ($grandTuitionFee + $hgrandTuitionFee);
							 $data12['Concessions'] 		= ($grandConcessions +$hgrandConcessions);
							 $data12['monthlyfee'] 			= ($grandRECEIVABLE + $hgrandRECEIVABLE);
							array_push($arrygrandtotal,$data12); 
						
						 }
					
					}
		 				
                    }
                echo '
                  
            </td>
        </tr>
		
    </table>';
 if(!empty($arrygrandtotal)) { 
	 foreach ($classgroup as $group) { 
	echo '
	 <table class="datatable" style="margin:3px 0; width:100%;">
                                <thead>
                                    <tr>
                                        <td colspan="10">
											<h2 style="text-align:center;">'.get_classgroup($group['id']).'</h2>
											<h4 style="margin-top: 10px;">Active Students Fee & Concession Report
										</td>
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

	 $fjks = 0;
	 $sumdayscholars 	= 0;
	 $sumhostilize 		= 0;
	 $sumTuitionFee 	= 0;
	 $sumConcessions 	= 0;
	 $summonthlyfee		= 0;
	 foreach($arrygrandtotal as $listgrand) { 
		 if($group['id'] == $listgrand['group_id']) {
			 $fjks++;
			 echo '<tr>
												<td style="text-align:center;">'.$fjks.'</td>
												<td>'.$listgrand['class_name'].'</td>
												<td style="text-align:right;">'.number_format($listgrand['dayscholars']).'</td>
												<td style="text-align:right;">'.number_format($listgrand['hostilize']).'</td>
												<td style="text-align:right;">'.number_format($listgrand['dayscholars'] + $listgrand['hostilize']).'</td>
												<td style="text-align:right;">'.number_format($listgrand['TuitionFee']).'</td>
												<td style="text-align:right;">'.number_format($listgrand['Concessions']).'</td>
												<td style="text-align:right;">'.number_format($listgrand['monthlyfee']).'</td>
											</tr>';
			 $sumdayscholars = ($sumdayscholars + $listgrand['dayscholars']);
			 $sumhostilize = ($sumhostilize + $listgrand['hostilize']);
			 $sumTuitionFee = ($sumTuitionFee + $listgrand['TuitionFee']);
			 $sumConcessions = ($sumConcessions + $listgrand['Concessions']);
			 $summonthlyfee = ($summonthlyfee + $listgrand['monthlyfee']);
		 }
		 
	 }
	 echo '</tbody>
	 		<tr style=" text-align: center; border: 2px solid black;">
                                        <th colspan="2">Grand Total</th>
										 <th style="text-align: right;">'.number_format($sumdayscholars).'</th>
										 <th style="text-align: right;">'.number_format($sumhostilize).'</th>
										 <th style="text-align: right;">'.number_format($sumdayscholars + $sumhostilize).'</th>
                                        <th style="text-align: right;">'.number_format($sumTuitionFee).'</th>
                                        <th style="text-align: right;">'.number_format($sumConcessions).'</th>
                                        <th style="text-align: right;">'.number_format($summonthlyfee).'</th>
                                    </tr>
</table>
<div class="page-break"></div>';
	 }
 }
echo '
								
								
	<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
    <span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>';



echo '
</body>

</html>';
?>