<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'add' => '1'))){ 
	echo'';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Stationary Request</h2>
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
$sqllms	= $dblms->querylms("SELECT pur_id, pur_status, pur_receipt_no, dated, pur_total_amount, id_supplier	 
								   FROM ".INVENTORY_PURCHASE." 
								   WHERE pur_status = '1' AND id_campus != '0' ORDER BY dated DESC");
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
	<td>LHS Head Office</td>
	<td class="text-center">'.get_delivery($rowsvalues['pur_status']).'</td>
	<td class="text-center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'view' => '1'))){ 
		echo'<a href="stationary_request.php?pr='.$rowsvalues['pur_id'].'" class="btn btn-success btn-xs");"><i class="fa fa-file-text-o"></i> </a>';
	}	
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'edit' => '1'))){ 
			echo'<a href="stationary_request.php?id='.$rowsvalues['pur_id'].'" class="btn btn-primary btn-xs ml-xs");"><i class="glyphicon glyphicon-edit"></i> </a>';
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