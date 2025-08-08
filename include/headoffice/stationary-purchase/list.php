<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'add' => '1'))){ 
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
		<th>Supplier</th>
		<th width="70px;" class="text-center">Status</th>
		<th width="100" class="text-center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT p.pur_id, p.pur_status, p.pur_receipt_no, p.pur_total_amount, p.dated, s.supplier_name	 
								   FROM ".INVENTORY_PURCHASE." p
								   INNER JOIN ".INVENTORY_SUPPLIERS." s ON s.supplier_id = p.id_supplier
								   WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY p.dated DESC");
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
	<td>'.$rowsvalues['pur_total_amount'].'</td>
	<td>'.$rowsvalues['supplier_name'].'</td>
	<td class="text-center">'.get_delivery($rowsvalues['pur_status']).'</td>
	<td class="text-center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'edit' => '1'))){ 
	echo'
		<a href="stationary_purchase.php?id='.$rowsvalues['pur_id'].'" class="btn btn-primary btn-xs" "><i class="glyphicon glyphicon-edit"></i> </a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'delete' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'stationary_purchase.php?deleteid='.$rowsvalues['store_id'].'\');"><i class="el el-trash"></i></a>
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