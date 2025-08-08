<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'added' => '1'))){ 
	echo'
	<a href="#make_class" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Add Complaint 
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Complaint List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Id Type</th>
		<th>Complaint By</th>
		<th>Phone</th>
		<th>Dated</th>
		<th>Detail</th>
		<th>Action Taken</th>
		<th>Assigned</th>
		<th>Note</th>
		<th>Attachment</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT c.id, c.status, c.id_type, c.complaint_by, c.phone, c.dated, c.detail,
								   c.action_taken, c.assigned, c.note, c.attachment, 
								   ct.type_id, ct.type_name,
								   cs.source_id, cs.source_name
								   FROM ".COMPLAINTS." c 
								   
								   INNER JOIN ".COMPLAINT_TYPE." ct ON ct.type_id = c.id_type
								   INNER JOIN ".COMPLAINT_SOURCE." cs ON cs.source_id = c.complaint_by	 									   
								   WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY c.id_type ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['type_name'].'</td>
	<td>'.$rowsvalues['source_name'].'</td>
	<td>'.$rowsvalues['phone'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['detail'].'</td>
	<td>'.$rowsvalues['action_taken'].'</td>
	<td>'.$rowsvalues['assigned'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td>'.$rowsvalues['attachment'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/complaints/modal_complaint_update.php?id='.$rowsvalues['id_type'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'complaints.php?deleteid='.$rowsvalues['id_type'].'\');"><i class="el el-trash"></i></a>
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