<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'add' => '1'))){ 
	echo'
	<a href="#make_video" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Training Video
	</a>';
}
echo '
	<h2 class="panel-title"><i class="fa fa-list"></i>  Training Videos List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">#</th>
		<th>Title</th>
		<th>Session</th>
		<th>Detail</th>
		<th width="70" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT v.id, v.status, v.title, v.id_session, v.thumbnail, v.youtube_url, v.details, se.session_name
								   FROM ".TRAINING_VIDEOS." v 
								   INNER JOIN ".SESSIONS." se ON se.session_id = v.id_session
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
	<td>'.$rowsvalues['title'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['details'].'</td>
	<td class="center">'.get_status($rowsvalues['status']).'</td>
	<td  width="120px;" class="center">
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-info btn-xs" onclick="showAjaxModalZoom(\'include/modals/training_videos/view.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-link"></i></a>';
		
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'edit' => '1'))){ 
		echo'
			<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/training_videos/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'delete' => '1'))){ 
		echo'
			<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'training_videos.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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