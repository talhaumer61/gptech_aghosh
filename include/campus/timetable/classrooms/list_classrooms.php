<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_classroom" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Classroom
	</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Classroom List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Room No</th>
		<th>Room Capacity</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT room_id,  room_status, room_no, room_capacity
								   FROM ".CLASS_ROOMS."  
								   WHERE room_id != '' AND is_deleted != '1'
								   AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   ORDER BY room_no ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['room_no'].'</td>
	<td>'.$rowsvalues['room_capacity'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['room_status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'edit' => '1'))){ 
	echo '
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/timetable/classrooms/modals_update_classrooms.php?id='.$rowsvalues['room_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'delete' => '1'))){ 
	echo '
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'timetable_classrooms.php?deleteid='.$rowsvalues['room_id'].'\');"><i class="el el-trash"></i></a>';
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