<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_guardian" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Guardian</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Guardian List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Photo</th>
		<th>Full Name</th>
		<th>Relation</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Login ID</th>
		<th>Address</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT g.guardian_id, g.guardian_status, g.guardian_name, g.guardian_relation, g.guardian_email,
								   g.guardian_phone, g.guardian_address, g.guardian_photo, g.id_loginid
								   FROM ".GUARDIANS." g 
								   WHERE g.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND   g.guardian_status = '1'
								   ORDER BY g.guardian_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['guardian_photo'].'</td>
	<td>'.$rowsvalues['guardian_name'].'</td>
	<td>'.$rowsvalues['guardian_relation'].'</td>
	<td>'.$rowsvalues['guardian_phone'].'</td>
	<td>'.$rowsvalues['guardian_email'].'</td>
	<td>'.$rowsvalues['id_loginid'].'</td>
	<td>'.$rowsvalues['guardian_address'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['guardian_status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/guardians/modal_guardian_update.php?id='.$rowsvalues['guardian_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels.php?deleteid='.$rowsvalues['guardian_id'].'\');"><i class="el el-trash"></i></a>
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