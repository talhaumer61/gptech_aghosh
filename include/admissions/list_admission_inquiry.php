<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '3', 'view' => '1')))
{ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#admission_inquiry" class="modal-with-move-anim btn btn-primary btn-xs pull-right">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '3', 'added' => '1')))
{ 
echo'
	<i class="fa fa-plus-square"></i> Make Inquiry</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Inquiry List</h2>';
}
echo'
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Name</th>
		<th>Cell No.</th>
		<th>Email</th>
		<th>Address</th>
		<th>Description</th>
		<th>Note</th>
		<th>Dated</th>
		<th>Date Followup</th>
		<th>Assigned</th>
		<th>Reference</th>
		<th>Source</th>
		<th>Class</th>
		<th>No of Childs</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT q.id, q.name, q.cell_no, q.email, q.address, q.description, q.note, q.dated,
									q.datefollowup, q.assigned, q.reference, q.source, q.id_class, q.num_of_child,
									q.status,
									c.class_id, c.class_name
								   FROM ".ADMISSIONS_INQUIRY." q  
								   
								   INNER JOIN ".CLASSES." c ON c.class_id = q.id_class
								   WHERE q.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY q.name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['name'].'</td>
	<td>'.$rowsvalues['cell_no'].'</td>
	<td>'.$rowsvalues['email'].'</td>
	<td>'.$rowsvalues['address'].'</td>
	<td>'.$rowsvalues['description'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['datefollowup'].'</td>
	<td>'.$rowsvalues['assigned'].'</td>
	<td>'.$rowsvalues['reference'].'</td>
	<td>'.$rowsvalues['source'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['num_of_child'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>
	';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '3', 'updated' => '1')))
{ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/admissions/modal_admission_inquiry_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	';
}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '3', 'deleted' => '1')))
{ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'admission_inquiry.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
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