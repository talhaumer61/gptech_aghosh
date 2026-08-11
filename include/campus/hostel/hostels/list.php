<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'add' => '1'))){ 
	echo'
	<a href="#make_hostel" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Hostel
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Hostels List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">#</th>
		<th>Hostel</th>
		<th>Phone</th>
		<th>Warden</th>
		<th>Hostel Type</th>
		<th width="70px;" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT h.hostel_id, h.hostel_status, h.hostel_name, h.hostel_phone, h.hostel_warden, 
								   h.id_type, h.hostel_detail  
								   FROM ".HOSTELS." h  
								   WHERE h.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND is_deleted != '1'
								   ORDER BY h.hostel_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['hostel_name'].'</td>
	<td>'.$rowsvalues['hostel_phone'].'</td>
	<td>'.$rowsvalues['hostel_warden'].'</td>
	<td>'.get_hostelype($rowsvalues['id_type']).'</td>
	<td class="center">'.get_status($rowsvalues['hostel_status']).'</td>
	<td class="center">';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/hostel/hostels/update.php?id='.$rowsvalues['hostel_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'delete' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'hostels.php?deleteid='.$rowsvalues['hostel_id'].'\');"><i class="el el-trash"></i></a>';
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
</section>
';
}
else{
	header("Location: dashboard.php");
}
?>