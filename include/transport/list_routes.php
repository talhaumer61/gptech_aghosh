<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_route" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Route</a>
	<h2 class="panel-title"><i class="fa fa-list"> </i> Transport Route List</h2>
</header>

<div class="panel-body">
<div class="table-responsive mt-md mb-md">
<table class="table table-bordered table-striped table-condensed mb-none">
<thead>
<tr>
	<th style="text-align:center;">#</th>
	<th>Route Name </th>
	<th>Route Start Place </th>
	<th>Route Stop Place </th>
	<th  style="text-align:center;">Route Fare </th>
	<th style="text-align:center;">Status </th>
	<th style="text-align:center;">Action </th>
</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT r.route_id, r.route_status, r.route_startplace, r.route_name, r.route_endplace, 
								   r.route_fare, r.route_detail 
								   FROM ".ROUTES." r  
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY r.route_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['route_name'].' </td>
	<td>'.$rowsvalues['route_startplace'].' </td>
	<td>'.$rowsvalues['route_endplace'].' </td>
	<td width="100px" style="text-align:right;">'.number_format($rowsvalues['route_fare']).' </td>
	<td width="70px" style="text-align:center;">'.get_status($rowsvalues['route_status']).' </td>
	<td style="width:100px;text-align:center;">
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-xs btn-primary" onclick="showAjaxModalZoom(\'include/modals/transport/modal_route_update.php?id='.$rowsvalues['route_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
									
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'routes.php?deleteid='.$rowsvalues['route_id'].'\');"><i class="el el-trash"></i></a>
	</td>
</tr>';
}
echo '
</tbody>
</table>
</div>
</div>
</section>';