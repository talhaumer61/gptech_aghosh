<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '57', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Syllabus List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Session</th>
		<th>Term</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Note</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.syllabus_id, s.syllabus_status, s.syllabus_term, s.id_session,
								   s.syllabus_file, s.id_class, s.id_subject, s.note,
								   se.session_id, se.session_status, se.session_name,
								   c.class_id, c.class_status, c.class_name,
								   cs.subject_id, cs.subject_status, cs.subject_name
								   FROM ".SYLLABUS." s 
								   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								   LEFT JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = s.id_subject
								   WHERE s.syllabus_status = '1' AND s.is_deleted != '1'
								   AND s.syllabus_type = '1'
								   AND s.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
								   ORDER BY se.session_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
if($rowsvalues['syllabus_term'] == 1){
	$term = 'First';
}
elseif($rowsvalues['syllabus_term'] == 2){
	$term = 'Second';
}
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$term.'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>';
	if($rowsvalues['subject_name']){
		echo' '.$rowsvalues['subject_name'].' ';}
	else{
		echo'All Subjects';
	} echo'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td style="text-align:center;">
		<a href="uploads/syllabus/'.$rowsvalues['syllabus_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['class_name'].'-'.$rowsvalues['subject_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
		<a href="uploads/syllabus/'.$rowsvalues['syllabus_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>
	</td>
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