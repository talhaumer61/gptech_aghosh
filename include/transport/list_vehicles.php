<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_hostel" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Add Transport</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Transport List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Id Route</th>
		<th>Vehicle No</th>
		<th>Vehicle Capacity</th>
		<th>Vehicle Driver</th>
		<th>Vehicle Driverphone</th>
		<th>Vehicle Driverlicense</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT v.vehicle_id, v.vehicle_status, v.id_route, v.vehicle_no, v.vehicle_capacity, v.vehicle_driver, v.vehicle_driverphone, v.vehicle_driverlicense 
								 
								   FROM ".VEHICLES." v  
								   WHERE v.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY d.vehicle_no ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['id_route'].'</td>
	<td>'.$rowsvalues['vehicle_no'].'</td>
	<td>'.$rowsvalues['vehicle_capacity'].'</td>
	<td>'.$rowsvalues['vehicle_driver'].'</td>
	<td>'.$rowsvalues['vehicle_driverphone'].'</td>
	<td>'.$rowsvalues['vehicle_driverlicense'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['vehicle_status']).$rowsvalues['vehicle_status'].'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/designation/modal_designation_update.php?id='.$rowsvalues['vehicle_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'transport_vehicles.php?deleteid='.$rowsvalues['vehicle_id'].'\');"><i class="el el-trash"></i></a>
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