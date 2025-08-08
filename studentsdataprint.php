<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();

	$arrclass  	= explode("|", $_POST['idclass']);
	$idclass	= $arrclass[0];
	$classname 	= $arrclass[1];
	$sqllms  	= $dblms->querylms("SELECT * 
									FROM ".STUDENTS." s
									INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
									WHERE s.std_status = '1' AND s.is_deleted != '1' 
									AND s.id_class = '".$idclass."'
									AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
									ORDER BY s.std_name");
	
	echo '
	<!doctype html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Student Form </title>
			<style type="text/css">
				body { font-size:14px; overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri; }
				h1 { font-size:40px; font-weight:700; margin:0; margin-bottom:10px; padding-bottom:0;  }
				h2 { font-size:27px; font-weight:normal; margin-top:0; }
				.admissionform { background-color:#000; color:#fff; width:300px; font-size:32px; font-weight:700; font-style:italic; } 
				th { font-weight:600; font-size:14px; }
				td { font-size:14px; }

				@media all {
					.page-break	{ display: none; }
				}

				@media print {
					.page-break	{ display: block; page-break-before: always; }
					@page { 
						size: letter;
						size: portrait; 
					}
				}
				
			</style>
			<script language="JavaScript1.2">
				function openwindow() {
					window.open("studentsdataprint.php", "studentsdataprint","toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no,width=800,height=700");
				}
			</script>
		</head>

		<body>
			<center><h3>'.strtoupper(SCHOOL_NAME).'</h3></center>
			<center><h4>class Name: '.$classname.'</h4></center>
			<center><h3>Student List</h3></center>
			<div style="font-size:13px; color:#000; margin-top:20px;">
				<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
					<tr>
						<td style="text-align:center; font-size:12px; font-weight:bold; width: 30px;">Sr #</td>
						<td style="text-align:left; font-size:12px; font-weight:bold; width: 90px;">Form No</td>
						<td style="text-align:left; font-size:12px; font-weight:bold;">Student Name</td>
						<td style="text-align:left; font-size:12px; font-weight:bold;">Father Name</td>
						<td style="text-align:left; font-size:12px; font-weight:bold; width: 115px;">Father Cnic No</td>
						<td style="text-align:left; font-size:12px; font-weight:bold; width: 95px;"">WhatsApp No</td>
					</tr>';
					$srno = 0;
					while($valueStudent = mysqli_fetch_array($sqllms)) {
						$srno++;	
						echo '
						<tr>
							<td style="text-align: center;">'.$srno.'</td>
							<td>'.$valueStudent['admission_formno'].'</td>
							<td>'.$valueStudent['std_name'].'</td>
							<td>'.$valueStudent['std_fathername'].'</td>
							<td>'.$valueStudent['std_fathercnic'].'</td>
							<td>'.$valueStudent['std_whatsapp'].'</td>
						</tr>';
					}
					echo '
				</table>
			</div>
		</body>
		<script type="text/javascript">
			setTimeout(function(){if (typeof(window.print) != "undefined") {
				window.print();
				window.close();
			}}, 3500);
		</script>
	</html>'; 
