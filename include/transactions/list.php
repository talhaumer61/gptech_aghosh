<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_voucher" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Add Voucher </a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Voucher List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>			
<tr>
		<th style="text-align:center;">#</th>
		<th>Trans Name</th>
		<th>Trans Cat</th>
		<th>Trans Amount</th>
		<th>Vouchar No</th>
		<th>Dated</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-------------------------------------------------				
														
$sqllms	= $dblms->querylms("SELECT t.trans_id, t.trans_status, t.trans_name, t.trans_cat, t.trans_amount, t.voucher_no, t.trans_method, t.dated
								   FROM ".ACCOUNT_TRANSACATIONS." t
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY t.trans_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['trans_name'].'</td>
	<td>'.$rowsvalues['trans_cat'].'</td>
	<td>'.$rowsvalues['trans_amount'].'</td>
	<td>'.$rowsvalues['voucher_no'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
		<td style="text-align:center;">'.get_status($rowsvalues['trans_status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/transcations/update.php?id='.$rowsvalues['trans_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'visitors.php?deleteid='.$rowsvalues['trans_id'].'\');"><i class="el el-trash"></i></a>
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