<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'add' => '1'))){ 
	echo'
	<a href="#make_video_lecture" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Video Lecture
	</a>';
}
echo '
	<h2 class="panel-title"><i class="fa fa-list"></i>  Video Lecture List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">#</th>
		<th>Session</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Title</th>
		<th width="70px;" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT v.id, v.status, v.title, v.facebook_code, v.youtube_code, se.session_name, c.class_name, cs.subject_name
								   FROM ".VIDEO_LECTURE." v 
								   INNER JOIN ".SESSIONS." se ON se.session_id = v.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = v.id_class
								   INNER JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = v.id_subject
								   WHERE v.id != ''
								   ORDER BY v.id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['title'].'</td>
	<td class="center">'.get_status($rowsvalues['status']).'</td>
	<td class="center">
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/video-lecture/modal_video_view.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-link"></i></a>';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'edit' => '1'))){ 
		echo '
			<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/video-lecture/modal_video_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'delete' => '1'))){ 
		echo '
			<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'video-lecture.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
		}
		echo '
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