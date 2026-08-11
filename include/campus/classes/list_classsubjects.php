<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '5', 'view' => '1'))){
echo '
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
		<th style="text-align:center;">Subject Type</th>
		<th>Book Name</th>
		<th>Book Edition</th>
		<th>Class Name</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sub.subject_code, sub.subject_name, sub.subject_type, sub.subject_book, sub.subject_edition, sub.subject_publisher, sub.id_class,
									c.class_name
								   FROM ".CLASS_SUBJECTS." sub 
								   INNER JOIN ".CLASSES." c ON c.class_id = sub.id_class
								   WHERE sub.subject_id != '' AND sub.is_deleted != '1'
								   AND sub.subject_status = '1' 
								   ORDER BY c.class_name ASC");
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
	<td style="text-align:center;">'.get_subjecttype($rowsvalues['subject_type']).'</td>
	<td style="text-align:center;">'.$rowsvalues['subject_book'].'</td>
	<td style="text-align:center;">'.$rowsvalues['subject_edition'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
?>
