<?php
error_reporting(0);
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once ("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){ 
	
	echo'<title>Exam Report Print | '.TITLE_HEADER.'</title>';
	
	if(isset($_POST['exam_stdList'])){
		// CAMPUS
		$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code, campus_name, campus_address, campus_email
											FROM ".CAMPUS." 
											WHERE campus_id = '".$_POST['id_campus']."' LIMIT 1");
		$value_campus = mysqli_fetch_array($sqllmscampus);

		// DATESHEET
		$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_exam, t.id_session, t.id_class, t.id_section, t.id_campus,
											e.type_name, c.class_name
											FROM ".DATESHEET." t
											INNER JOIN ".EXAM_TYPES."	e	ON 	e.type_id 	= t.id_exam
											INNER JOIN ".CLASSES."		c 	ON 	c.class_id 	= t.id_class
											WHERE e.type_id = '".$_POST['id_type']."' AND t.id_campus = '".$_POST['id_campus']."' 
											AND t.is_deleted != '1'
											LIMIT 1");
		$rowsvalues = mysqli_fetch_array($sqllms);
		
		// EXAM SESSION
		$sqllms_setting	= $dblms->querylms("SELECT session_name 
													FROM ".SESSIONS."
													WHERE session_status ='1' AND is_deleted != '1' AND session_id = '".$_SESSION['userlogininfo']['EXAM_SESSION']."' LIMIT 1");
		$values_setting = mysqli_fetch_array($sqllms_setting);
		echo'
		<br>
		<div class="text-right mr-lg on-screen">
			<button onclick="print_report(\'printResult\')" class="mr-xs btn btn-danger btn-sm"><i class="glyphicon glyphicon-print"></i> Print</button>
			<button id="export_button" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-file"></i> Excel</button>
		</div>
		<div id="printResult">
			<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
			<link rel="stylesheet" href="assets/stylesheets/theme.css"/>

			<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>
			<script src="assets/vendor/jquery/jquery.js"></script>
			<style type="text/css">
				td {
					padding: 5px;
					border: 1px solid #ffcfcf;
				}
				th {
					border: 1px solid #ffcfcf;
				}
				@media all {
					.page-break	{ display: none; }
				}
				@media print {
					.page-break	{ display: block; page-break-before: always; }
					@page {
						margin: 4mm 4mm 4mm 4mm; 
					}
				}
			</style>
			<br>

			<img src="uploads/logo.png" style="max-height : 100px;">
			<center style="margin-top: -100px;  text-align:right">
				<h3 style="font-weight: 100;">Laurel Home International Schools </h3>
				Students List ('.$rowsvalues['type_name'].' - '.$values_setting['session_name'].')
			</center>
			<br>
			<h4 style="font-weight: 100;">Campus: <span style="text-transform: capitalize;"><u>'.$value_campus['campus_name'].'</u></span></h4>
			<h4 style="font-weight: 100; text-align: right; margin-top: -30px;">Campus Code: <span style="text-transform: capitalize;"><u>'.$value_campus['campus_code'].'</u></span></h4>
			<div id="header" style="display:none;"></div>
			<br>
			<table class="table mt-md">
				<thead>
					<tr>
						<th style="text-align:center;">Sr. #</th>
						<th>Registration#</th>
						<th>Class</th>
						<th>Student Name</th>
						<th>Father\'s Name</th>
						<th width="70px;" style="text-align:center;">Photo</th>
					</tr>
				</thead>
				<tbody>';
					// STUDENT DETAILS
					$sqllms_std	= $dblms->querylms("SELECT  s.std_name, s.std_fathername, s.std_rollno, s.std_regno, c.class_name, cs.section_name, s.std_photo
																	FROM ".STUDENTS." 		s
																	INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
																	INNER JOIN ".CLASS_SECTIONS."  cs  ON cs.section_id = s.id_section
																	WHERE s.std_id != '' 
																	AND s.id_campus ='".$_POST['id_campus']."' 
																	ORDER BY c.class_id");
					$srno = 0;
					while($value_std = mysqli_fetch_array($sqllms_std)){
						if($value_std['std_photo']) { 
							$photo = "uploads/images/students/".$value_std['std_photo']."";
						}else{
							$photo = "uploads/default-student.jpg";
						}
						$srno++;
						echo'
						<tr>
							<td style="text-align: center;">'.$srno.'</td>
							<td>'.$value_std['std_regno'].'</td>
							<td>'.$value_std['class_name'].'</td>
							<td>'.$value_std['std_name'].' </td>
							<td>'.$value_std['std_fathername'].'</td>
							<td style="width: 150px; text-align: center;"><img src="'.$photo.'" style="width:50px; height:50px;"></td>
						</tr>';
					}
					echo'
				</tbody>
			</table>
		</div>
		<div class="page-break"></div>';

	}elseif(isset($_POST['exam_campusClass']) || isset($_POST['exam_campusRecivables'])){
		
		// DATESHEET
		$sqllms	= $dblms->querylms("SELECT type_name
											FROM ".EXAM_TYPES."  	
											WHERE type_id = '".$_POST['id_type']."'
											AND is_deleted != '1' LIMIT 1");
		$rowsvalues = mysqli_fetch_array($sqllms);

		// EXAM SESSION NAME
		$sqllms_setting	= $dblms->querylms("SELECT session_name 
													FROM ".SESSIONS."
													WHERE session_status ='1' AND is_deleted != '1' AND session_id = '".$_SESSION['userlogininfo']['EXAM_SESSION']."' LIMIT 1");
		$values_setting = mysqli_fetch_array($sqllms_setting);

		// CLASSES
		$sqllms_classes	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE class_id != '' AND class_status ='1' AND is_deleted != '1' ");
		echo'		
		<br>
		<div class="text-right mr-lg on-screen">
			<button onclick="print_report(\'printResult\')" class="mr-xs btn btn-danger btn-sm"><i class="glyphicon glyphicon-print"></i> Print</button>
			<button id="export_button" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-file"></i> Excel</button>
		</div>
		<div id="printResult" style="orientation: landscape">
			<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
			<link rel="stylesheet" href="assets/stylesheets/theme.css"/>

			<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>
			<script src="assets/vendor/jquery/jquery.js"></script>
			<style type="text/css">
				td {
					padding: 5px;
					border: 1px solid #ffcfcf;
				}
				th {
					border: 1px solid #ffcfcf;
				}
				@media all {
					.page-break	{ display: none; }
				}
				@media print {
					.page-break	{ display: block; page-break-before: always; }
					@page {
						margin: 4mm 4mm 4mm 4mm; 
					}
				}
			</style>
			<br>
			<img src="uploads/logo.png" style="max-height : 100px;">
			<center style="margin-top: -100px;  text-align:right">
				<h3 style="font-weight: 100;">Laurel Home International Schools </h3>';
				if(isset($_POST['exam_campusClass'])){
					echo'<th>Class Wise Students Report </th>';
				}elseif(isset($_POST['exam_campusRecivables'])){
					echo'<th>Campus Wise Receivables Report </th>';
				}
				echo'
				('.$rowsvalues['type_name'].' - '.$values_setting['session_name'].')
			</center>
			<br>
			<div id="header" style="display:none;"></div>
			<br>
			<table class="table mt-md">
				<thead>
					<tr>
						<th style="text-align:center;">Sr.</th>
						<th>Campus</th>';
						while($values_class = mysqli_fetch_array($sqllms_classes)){
							echo'<th>'.$values_class['class_name'].'</th>';
							$classes[] = $values_class;
						}
						if(isset($_POST['exam_campusClass'])){
							echo'<th>Total</th>';
						}elseif(isset($_POST['exam_campusRecivables'])){
							echo'<th>Amount</th>';
						}
						echo'
					</tr>
				</thead>
				<tbody>';
					$srno = 0;
					$sqllms_camp	= $dblms->querylms("SELECT campus_id, campus_name FROM ".CAMPUS." WHERE campus_status = '1' ORDER BY campus_name ");
					while($value_camp = mysqli_fetch_array($sqllms_camp)){
						$srno++;
						echo'
						<tr>
							<td style="text-align: center;">'.$srno.'</td>
							<td>'.$value_camp['campus_name'].' </td>';
							$t_stds = 0;
							foreach($classes as $class){ 
								// STUDENT DETAILS
								$sqllms_std	= $dblms->querylms("SELECT  COUNT(std_id) AS students
																				FROM ".STUDENTS."
																				WHERE std_id != '' AND std_status = '1' AND is_deleted != '1'
																				AND id_class = '".$class['class_id']."' 
																				AND id_campus = '".$value_camp['campus_id']."' ");
								$value_std = mysqli_fetch_array($sqllms_std);
								echo'<td>'.$value_std['students'].' </td>';
								$t_stds = $t_stds + $value_std['students'];
							}
							if(isset($_POST['exam_campusClass'])){
								echo'<td>'.$t_stds.' </td>';
							}elseif(isset($_POST['exam_campusRecivables'])){
								echo'<td></td>';
							}
							echo'
						</tr>';
					}
					echo'
				</tbody>
			</table>
		</div>
		<div class="page-break"></div>';

	}
}
?>
<!-- EXPORT TO EXCEL -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
    // PRINT THE TABLE 
    function print_report(printResult) {
		
		document.getElementById('header').style.display = 'block';
        var printContents = document.getElementById(printResult).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
		var css = '@page {   }',
		head = document.head || document.getElementsByTagName('head')[0],
		style = document.createElement('style');
		style.type = 'text/css';
		style.media = 'print';
		if (style.styleSheet){
		style.styleSheet.cssText = css;
		} else {
		style.appendChild(document.createTextNode(css));
		}
		head.appendChild(style);
        window.print();
        document.body.innerHTML = originalContents;
		document.getElementById('header').style.display = 'none';
    }

	// EXPORT TO EXCEL
	function html_table_to_excel(type){
		var data = document.getElementById('printResult');
		var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
		XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
		XLSX.writeFile(file, 'report.' + type);
	}

	const export_button = document.getElementById('export_button');
	export_button.addEventListener('click', () =>  {
		html_table_to_excel('xlsx');
	});
</script>