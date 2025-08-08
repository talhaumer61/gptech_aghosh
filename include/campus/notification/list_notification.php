<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'add' => '1'))){
	echo'<a href="#make_notification" class="modal-with-move-anim btn btn-primary btn-xs pull-right">';
}
echo'
	<i class="fa fa-plus-square"></i> Make Notification</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Notifications List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Title</th>
		<th>Date</th>
		<th>Type</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT not_id, not_status, id_type, not_title, dated, not_description
								   FROM ".NOTIFICATIONS." 
								   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY dated ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
if($rowsvalues['id_type'] == 1){
	$type = "Popup";
}else if($rowsvalues['id_type'] == 2){
	$type = "Navbar";
}
else{
	
}
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['not_title'].'</td>
	<td>'.date('d M Y' , strtotime(cleanvars($rowsvalues['dated']))).'</td>
	<td>'.$type.'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['not_status']).'</td>
	<td class="text-center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'edit' => '1'))){
	echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/notification/notification_update.php?id='.$rowsvalues['not_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'delete' => '1'))){
		echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'message.php?deleteid='.$rowsvalues['not_id'].'\');"><i class="el el-trash"></i></a>';
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