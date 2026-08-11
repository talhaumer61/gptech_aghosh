<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '32', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '32', 'add' => '1'))){ 
	echo'
	<a href="#make_hostel_registration" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Registration
	</a>
	';
}
echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Hostels Registered List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
<tr>
	<th class="center" width=70>#</th>
	<th>Student Name</th>
	<th>Hostel Name</th>
	<th>Floor</th>
	<th>Room No</th>
	<!-- <th class="center">Monthly Fee</th> -->
	<th width="70px;" class="center">Status</th>
	<th width="100px;" class="center">Options</th>
</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT r.id, r.status, r.type, r.monthly_fee, h.hostel_name, f.floor_name, ro.room_name, s.std_name, c.class_name
								   FROM ".HOSTEL_REG." r  
								   LEFT JOIN ".HOSTELS." 	   h  ON h.hostel_id = r.id_hostel    
								   LEFT JOIN ".HOSTEL_FLOORS." f  ON f.floor_id  = r.id_floor   
								   LEFT JOIN ".HOSTEL_ROOMS."  ro ON ro.room_id  = r.id_room 
								   LEFT JOIN ".STUDENTS." 	   s  ON s.std_id    = r.id_std 
								   INNER JOIN ".CLASSES." 	   c  ON c.class_id  = s.id_class
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   ORDER BY r.id ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['std_name'].'</td>
	<td>'.$rowsvalues['hostel_name'].'</td>
	<td>'.$rowsvalues['floor_name'].'</td>
	<td>'.$rowsvalues['room_name'].'</td>
	<!-- <td class="center" width=100>'.number_format($rowsvalues['monthly_fee']).'</td> -->
	<td class="center">'.get_regStataus($rowsvalues['status']).'</td>
	<td class="center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '32', 'edit' => '1'))){ 
		echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/hostel/users/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '32', 'delete' => '1'))){ 
		echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'hostelUsers.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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