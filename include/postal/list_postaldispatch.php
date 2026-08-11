 <?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'view' => '1')))
{
echo'
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'updated' => '1')))
{
echo'
	<a href="#make_class" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Dispatch
	</a>';
}
echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Dispatch List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>To Title</th>
		<th>To Phone</th>
		<th>To Email</th>
		<th>Reference No</th>
		<th>Address</th>
		<th>Note</th>
		<th>From Title</th>
		<th>Dated</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT * 
								   FROM ".POSTAL_DISPATCH."   
								   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY reference_no ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['to_title'].'</td>
	<td>'.$rowsvalues['to_phone'].'</td>
	<td>'.$rowsvalues['to_email'].'</td>
	<td>'.$rowsvalues['reference_no'].'</td>
	<td>'.$rowsvalues['address'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td>'.$rowsvalues['from_title'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>
<a href="uploads/postaldispatch/'.$rowsvalues['attachment'].'" download="'.$rowsvalues['reference_no'].'-'.$rowsvalues['from_title'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
	';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'updated' => '1')))
{
echo'	<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/postal/modal_postaldispatch_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
}
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'deleted' => '1')))
{
echo'	<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'postaldispatch.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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