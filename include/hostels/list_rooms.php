<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '39', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '39', 'added' => '1'))){ 
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
	<th>#</th>
	<th>Room Name</th>
	<th>Hostel Name</th>
	<th>Hostel Type</th>
	<th style="text-align:center;">No Of Beds</th>
	<th style="text-align:center;">Bed Fee</th>
	<th width="70px;" style="text-align:center;">Status</th>
	<th width="100px;" style="text-align:center;">Options</th>
</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT r.room_id, r.room_status, r.room_beds, r.room_name, r.room_bedfee, 
								   r.id_hostel, r.room_detail, h.hostel_name, h.id_type   
								   FROM ".HOSTEL_ROOMS." r  
								   INNER JOIN ".HOSTELS." h ON h.hostel_id = r.id_hostel    
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY r.room_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['room_name'].'</td>
	<td>'.$rowsvalues['hostel_name'].'</td>
	<td>'.get_hostelype($rowsvalues['id_type']).'</td>
	<td style="text-align:center; width:100px;">'.$rowsvalues['room_beds'].'</td>
	<td style="text-align:right; width:80px;">'.number_format($rowsvalues['room_bedfee']).'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['room_status']).'</td>
	<td style="text-align:center;">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '39', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/hostel/modal_room_update.php?id='.$rowsvalues['room_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '39', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostelrooms.php?deleteid='.$rowsvalues['room_id'].'\');"><i class="el el-trash"></i></a>
	';
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