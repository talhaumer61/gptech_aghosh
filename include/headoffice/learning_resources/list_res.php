<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '58', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '58', 'add' => '1'))){ 
	echo'
	<a href="#make_dlp" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Students Learning Resources
	</a>';
}
echo '
	<h2 class="panel-title"><i class="fa fa-list"></i> Students Learning Resources List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Week</th>
		<th>Session</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Note</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="120" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT r.res_id, r.res_status, r.res_file, r.id_class, r.week,
								   r.id_term, r.note, se.session_name, c.class_name,
								   cs.subject_name
								   FROM ".LEARNING_RESOURCES." r 
								   INNER JOIN ".SESSIONS." se ON se.session_id = r.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = r.id_class
								   LEFT JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = r.id_subject
								   ORDER BY r.res_id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['week'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['res_status']).'</td>
	<td>
	<a href="uploads/learning_resources/'.$rowsvalues['res_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['week'].'-'.$rowsvalues['class_name'].'-'.$rowsvalues['subject_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
	<a href="uploads/learning_resources/'.$rowsvalues['res_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>';
	
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '58', 'edit' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/learning_resources/modal_res_update.php?id='.$rowsvalues['res_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '58', 'delete' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'learning_resources.php?deleteid='.$rowsvalues['res_id'].'\');"><i class="el el-trash"></i></a>';
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