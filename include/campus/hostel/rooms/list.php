<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'added' => '1'))){ 
	echo'
	<a href="#make_hostel_room" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Hostel Room
	</a>
	';
}
echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Hostel Room List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
<tr>
	<th class="center" width=70>#</th>
	<th>Room No</th>
	<th>Hostel Name</th>
	<th>Floor</th>
	<th>Hostel Type</th>
	<th class="center">No Of Beds</th>
	<th class="center">Bed Fee</th>
	<th width="70px;" class="center">Status</th>
	<th width="100px;" class="center">Options</th>
</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT r.room_id, r.room_status, r.room_name, r.room_type, r.room_beds, r.room_bedfee, r.room_detail,
								   h.hostel_name, f.floor_name  
								   FROM ".HOSTEL_ROOMS." r  
								   LEFT JOIN ".HOSTELS." 	   h ON h.hostel_id = r.id_hostel    
								   LEFT JOIN ".HOSTEL_FLOORS." f ON f.floor_id = r.id_floor   
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND r.is_deleted != '1'
								   ORDER BY r.room_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['room_name'].'</td>
	<td>'.$rowsvalues['hostel_name'].'</td>
	<td>'.$rowsvalues['floor_name'].'</td>
	<td>'.get_usertype($rowsvalues['room_type']).'</td>
	<td class="center" width=100">'.$rowsvalues['room_beds'].'</td>
	<td class="center" width=80>'.number_format($rowsvalues['room_bedfee']).'</td>
	<td class="center">'.get_status($rowsvalues['room_status']).'</td>
	<td class="center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'updated' => '1'))){ 
		echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/hostel/rooms/update.php?id='.$rowsvalues['room_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'deleted' => '1'))){ 
		echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'hostelrooms.php?deleteid='.$rowsvalues['room_id'].'\');"><i class="el el-trash"></i></a>';
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