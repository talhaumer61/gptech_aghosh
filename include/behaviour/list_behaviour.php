<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_behaviour" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Behaviour</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Behaviours List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Student</th>
		<th>Roles</th>
		<th>Report</th>
		<th>Dated</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT b.id, b.status, b.id_std, b.id_role, b.report, b.dated,
								   s.std_id, s.std_status, s.std_firstname, s.std_lastname,
								   r.role_id, r.role_status, r.role_name
								   FROM ".BEHAVIOURS." b
								   
								   INNER JOIN ".STUDENTS." s ON s.std_id = b.id_std
								   INNER JOIN ".BEHAVIOUR_ROLES." r ON r.role_id = b.id_role
								   WHERE b.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND   s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND 	 s.std_status = '1'
								   AND 	 r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND   r.role_status= '1'
								   ORDER BY b.dated ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['std_firstname'].' '.$rowsvalues['std_lastname'].'</td>
	<td>'.$rowsvalues['role_name'].'</td>
	<td>'.$rowsvalues['report'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/behaviour/modal_behaviour_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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