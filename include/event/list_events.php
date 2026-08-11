<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_event" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make event</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Event List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Subject </th>
		<th>Detail</th>
		<th>Date From Date</th>
		<th>Date To</th>
		<th>Event To</th>
		<th>Alert By</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT e.id, e.status, e.subject, e.detail, e.date_from, 
								   e.date_to, e.event_to, e.alert_by, 
								   em.emply_id, em.emply_name 
								   FROM ".EVENTS." e  
								   INNER JOIN ".EMPLOYEES." em ON em.emply_id = e.alert_by
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY e.date_from ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['subject'].'</td>
	<td>'.$rowsvalues['detail'].'</td>
	<td>'.$rowsvalues['date_from'].'</td>
	<td>'.$rowsvalues['date_to'].'</td>
	<td>'.$rowsvalues['event_to'].'</td>
	<td>'.$rowsvalues['emply_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/event/modal_event_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
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
?>