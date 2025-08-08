<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'added' => '1'))){ 
	echo'
	<a href="#make_hostel" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Syllabus
	</a>';
}
echo '
	<h2 class="panel-title"><i class="fa fa-list"></i>  Syllabus List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Month</th>
		<th>Session</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Date</th>
		<th>Note</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.syllabus_id, s.syllabus_status, s.id_session, s.id_month,
								   s.dated, s.syllabus_file, s.id_class, s.id_subject, s.note,
								   se.session_id, se.session_status, se.session_name,
								   c.class_id, c.class_status, c.class_name,
								   cs.subject_id, cs.subject_status, cs.subject_name
								   FROM ".SYLLABUS." s 
								   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								   INNER JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = s.id_subject
								   ORDER BY s.id_month ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['syllabus_status']).'</td>
	<td>
	<a href="uploads/syllabus/'.$rowsvalues['syllabus_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['class_name'].'-'.$rowsvalues['subject_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>';
	
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/syllabus-breakdown/modal_syllabus_update.php?id='.$rowsvalues['syllabus_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'syllabus_breakdown.php?deleteid='.$rowsvalues['syllabus_id'].'\');"><i class="el el-trash"></i></a>';
	}
	echo'
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