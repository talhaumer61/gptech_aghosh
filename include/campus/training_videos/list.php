<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
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
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT v.id, v.status, v.title, v.id_session, v.thumbnail, v.youtube_url, v.details, se.session_name
								   FROM ".TRAINING_VIDEOS." v 
								   INNER JOIN ".SESSIONS." se ON se.session_id = v.id_session
								   WHERE v.id != '' AND v.status = '1' AND v.is_deleted != '1' 
								   AND v.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
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
	<td  width="120px;" class="center">
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-info btn-xs" onclick="showAjaxModalZoom(\'include/modals/training_videos/view.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-link"></i></a>
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