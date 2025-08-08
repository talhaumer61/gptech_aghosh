<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'add' => '1'))){ 
	echo'
	<a href="#make_guide" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Teaching Guide
	</a>';
}
echo '
	<h2 class="panel-title"><i class="fa fa-list"></i>  Teaching Guides List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Term</th>
		<th>Title</th>
		<th>Session</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Note</th>
		<th style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.guide_id, s.guide_status, s.guide_title, s.guide_term,
								   s.id_session, s.guide_file, s.id_class, s.id_subject, s.note,
								   se.session_id, se.session_status, se.session_name,
								   c.class_id, c.class_status, c.class_name,
								   cs.subject_id, cs.subject_status, cs.subject_name
								   FROM ".TEACHING_GUIDES." s 
								   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								   INNER JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = s.id_subject
								   ORDER BY s.guide_id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
if($rowsvalues['guide_term'] == 1){
	$term = 'First';
}
elseif($rowsvalues['guide_term'] == 2){
	$term = 'Second';
}
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$term.'</td>
	<td>'.$rowsvalues['guide_title'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['guide_status']).'</td>
	<td  width="120px" class="center">
		<a href="uploads/teaching_guides/'.$rowsvalues['guide_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['class_name'].'-'.$rowsvalues['subject_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
		<a href="uploads/teaching_guides/'.$rowsvalues['guide_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>';
		
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'edit' => '1'))){ 
		echo'
			<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/teaching_guide/update.php?guide_id='.$rowsvalues['guide_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'delete' => '1'))){ 
		echo'
			<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'teaching_guide.php?deleteid='.$rowsvalues['guide_id'].'\');"><i class="el el-trash"></i></a>';
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