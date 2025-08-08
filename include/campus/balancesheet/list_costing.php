<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'add' => '1'))){ 
	echo'
	<a href="#make_costing" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Expense Voucher
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Expense List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">No.</th>
		<th>Title</th>
		<th>Amount</th>
		<th class="center">Method</th>
		<th>Head</th>
		<th>Voucher ID</th>
		<th>Date</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT t.trans_id, t.trans_title, t.trans_amount, t.voucher_no, t.trans_method, t.dated,
                                h.head_name
                                FROM ".ACCOUNT_TRANS." t
                                INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
								WHERE t.trans_id != '' AND t.trans_type = '2' AND t.is_deleted !='1'
								AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								ORDER BY t.trans_id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['trans_title'].'</td>
	<td>Rs. '.$rowsvalues['trans_amount'].'</td>
	<td class="center">'.get_paymethod($rowsvalues['trans_method']).'</td>
	<td>'.$rowsvalues['head_name'].'</td>
	<td>'.$rowsvalues['voucher_no'].'</td>
	<td>'.date('d M, Y' , strtotime(cleanvars($rowsvalues['dated']))).'</td>
	<td class="center">';
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/balancesheet/costing_update.php?id='.$rowsvalues['trans_id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'delete' => '1'))){ 
		echo'
			<a href="#" class="btn btn-danger btn-xs");"><i class="el el-trash"></i></a>';
		}
		echo'
	</td>';
echo '
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