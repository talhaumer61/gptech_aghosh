<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'add' => '1'))){ 
		echo'
		<a href="stationary_purchase.php?view=add" class="btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Stationary Purchase</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Stationary Purchase</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="text-center">#</th>
		<th>Receipt no</th>
		<th>Date</th>
		<th>Total Amount</th>
		<th>Paid Amount</th>
		<th>Payable Amount</th>
		<th>Supplier</th>
		<th width="70px;" class="text-center">Payment</th>
		<th width="70px;" class="text-center">Status</th>
		<th width="100" class="text-center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT pur_id, pur_status, pur_pay_status, pur_receipt_no, dated, pur_total_amount, pur_paid_amount, pur_payable, id_supplier	 
								   FROM ".INVENTORY_PURCHASE." 
								   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY dated DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="text-center">'.$srno.'</td>
	<td>'.$rowsvalues['pur_receipt_no'].'</td>
	<td>'.date("d M Y", strtotime($rowsvalues['dated'])).'</td>
	<td>'.number_format($rowsvalues['pur_total_amount']).'</td>
	<td>'.number_format($rowsvalues['pur_paid_amount']).'</td>
	<td>'.number_format($rowsvalues['pur_payable']).'</td>
	<td>LHS Head Office</td>
	<td class="text-center">'.get_payments($rowsvalues['pur_pay_status']).'</td>
	<td class="text-center">'.get_delivery($rowsvalues['pur_status']).'</td>
	<td class="text-center">
		<a href="stationary_purchase.php?pr='.$rowsvalues['pur_id'].'" class="btn btn-success btn-xs");"><i class="fa fa-file-text-o"></i> </a>';
	
	if($rowsvalues['pur_status'] == '1' || $rowsvalues['pur_status'] == '6'){
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'edit' => '1'))){ 
			echo'<a href="stationary_purchase.php?id='.$rowsvalues['pur_id'].'" class="btn btn-primary btn-xs ml-xs");"><i class="glyphicon glyphicon-edit"></i> </a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'delete' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'stationary.php?deleteid='.$rowsvalues['store_id'].'\');"><i class="el el-trash"></i></a>';
		}
	}
	else if($rowsvalues['pur_status'] !== '1' || $rowsvalues['pur_status'] !== '6'){
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'edit' => '1'))){ 
			echo'<a href="stationary_purchase.php?id='.$rowsvalues['pur_id'].'" class="btn btn-info btn-xs ml-xs");"><i class="glyphicon glyphicon-upload"></i> </a>';
		}
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