<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'view' => '1'))){ 
echo'
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'added' => '1'))){ 
	echo'
	<a href="#make_supplier" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Supplier</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Stationary Supplier</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Supplier Name</th>
		<th>Supplier Phone</th>
		<th>Supplier Email</th>
		<th>Supplier Address</th>
		<th>Supplier Company</th>
		<th>Contact Name</th>
		<th>Contact Phone</th>
		<th>Contact Email</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="70" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.supplier_id, s.supplier_status, s.supplier_name, s.supplier_phone, s.supplier_email,
								   s.supplier_address, s.supplier_company, s.supplier_contactname, s.supplier_contactphone,
								   s.supplier_contactemail
								   FROM ".INVENTORY_SUPPLIERS." s 
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY s.supplier_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['supplier_name'].'</td>
	<td>'.$rowsvalues['supplier_phone'].'</td>
	<td>'.$rowsvalues['supplier_email'].'</td>
	<td>'.$rowsvalues['supplier_address'].'</td>
	<td>'.$rowsvalues['supplier_company'].'</td>
	<td>'.$rowsvalues['supplier_contactname'].'</td>
	<td>'.$rowsvalues['supplier_contactphone'].'</td>
	<td>'.$rowsvalues['supplier_contactemail'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['supplier_status']).'</td>
	<td style="text-align:center;">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'updated' => '1'))){ 
	echo'
		<a class="btn btn-success btn-xs" href="stationary-supplier.php?id='.$rowsvalues['supplier_id'].'"> <i class="fa fa-user-circle-o"></i></a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'stationary.php?deleteid='.$rowsvalues['supplier_id'].'\');"><i class="el el-trash"></i></a>
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