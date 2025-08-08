<?php
//-----------------------------------------------
echo '
<title> Subject Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Subject Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Subject List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Subject Code</th>
		<th>Subject Name</th>
		<th>Total Marks</th>
		<th>Passing Marks</th>
		<th>Book Name</th>
		<th>Book Edition</th>
		<th>Class Name</th>
		<th>Teacher</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllmstudent  = $dblms->querylms("SELECT std_id, id_class, id_section  
										FROM ".STUDENTS." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
$value_stu = mysqli_fetch_array($sqllmstudent);
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sub.subject_code, sub.subject_name, sub.subject_totalmarks, sub.subject_passmarks, sub.subject_book, sub.subject_edition, c.class_name
								   FROM ".CLASS_SUBJECTS." sub 
								   INNER JOIN ".CLASSES." c ON c.class_id = sub.id_class
								   WHERE sub.subject_status = '1' AND sub.id_class = '".$value_stu['id_class']."'
								   ORDER BY sub.subject_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['subject_code'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['subject_totalmarks'].'</td>
	<td>'.$rowsvalues['subject_passmarks'].'</td>
	<td style="text-align:center;">'.$rowsvalues['subject_book'].'</td>
	<td style="text-align:center;">'.$rowsvalues['subject_edition'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>
</div>
</div>
</section>';
//-----------------------------------------------
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
</script>