<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 1)  ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINIDA']  == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){ 
echo '
	<a href="#make_classroom" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Classroom
	</a>';
}
echo'
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
$campus_id = '';

if($_SESSION['userlogininfo']['LOGINTYPE'] != 1){
	$campus_id .= "AND cr.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'";
}
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT cr.room_id,  cr.room_status, cr.room_no, cr.room_capacity
								   FROM ".CLASS_ROOMS." cr  
								   WHERE cr.room_id != '' $campus_id
								   ORDER BY cr.room_no ASC");
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
	<td style="text-align:center;">'.get_status($rowsvalues['room_status']).'</td>';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'updated' => '1'))){ 
echo '
	<td>';
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/timetable/classrooms/modals_update_classrooms.php?id='.$rowsvalues['room_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'timetable_classrooms.php?deleteid='.$rowsvalues['room_id'].'\');"><i class="el el-trash"></i></a>';
	}
	echo'
	</td>';
}
echo '
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