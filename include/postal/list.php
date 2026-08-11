<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'view' => '1')))
{
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'view' => '1'))){
echo'
	<a href="#make_postal" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Postal
	</a>';
}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Postal List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>From Title</th>
		<th>From Phone</th>
		<th>From_email</th>
		<th>Reference_no</th>
		<th>Address</th>
		<th>Note</th>
		<th>To Title</th>
		<th>Dated</th>
		<th>Attachment</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-------------------------------------------------				
														
$sqllms	= $dblms->querylms("SELECT p.id, p.status, p.from_title, p.from_phone, p.from_email, p.reference_no, p.address, p.note, p.to_title, p.dated, p.attachment
								   FROM ".POSTAL_RECEIVED." p 
								   WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY p.from_title ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['from_title'].'</td>
	<td>'.$rowsvalues['from_phone'].'</td>
	<td>'.$rowsvalues['from_email'].'</td>
	<td>'.$rowsvalues['reference_no'].'</td>
	<td>'.$rowsvalues['address'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td>'.$rowsvalues['to_title'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['attachment'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'updated' => '1')))
{
echo'	<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/postal/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
}
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'deleted' => '1')))
{
echo'	<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'postal_receive.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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