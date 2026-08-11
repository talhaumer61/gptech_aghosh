<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '54', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i> Stationary Sales</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="text-center">#</th>
		<th>Receipt no</th>
		<th>Date</th>
		<th>Campus</th>
		<th>Total Amount</th>
		<th>paid Amount</th>
		<th>Payable Amount</th>
		<th width="70px;" class="text-center">Status</th>
		<th width="70px;" class="text-center">Payment</th>
		<th width="100" class="text-center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.sal_id, s.sal_status, s.sal_pay_status, s.receipt_no, s.dated, p.total_amount, p.paid_amount, p.payable, c.campus_name	 
								   FROM ".INVENTORY_SALE." s
								   INNER JOIN ".INVENTORY_SALE_PAYABLE." p ON p.id_sale = s.sal_id 
								   INNER JOIN ".CAMPUS." c ON c.campus_id = s.id_customers 
								   WHERE s.sal_status != '6' ORDER BY s.receipt_no DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="text-center">'.$srno.'</td>
	<td>'.$rowsvalues['receipt_no'].'</td>
	<td>'.date("d M Y", strtotime($rowsvalues['dated'])).'</td>
	<td>'.$rowsvalues['campus_name'].'</td>
	<td>'.$rowsvalues['total_amount'].'</td>
	<td>'.$rowsvalues['paid_amount'].'</td>
	<td>'.$rowsvalues['payable'].'</td>
	<td class="text-center">'.get_delivery($rowsvalues['sal_status']).'</td>
	<td class="text-center">'.get_payments($rowsvalues['sal_pay_status']).'</td>
	<td class="text-center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '54', 'edit' => '1'))){ 
		echo'<a href="stationary_sale.php?id='.$rowsvalues['sal_id'].'" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> </a>';
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