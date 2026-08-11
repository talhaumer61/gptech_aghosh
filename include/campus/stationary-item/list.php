<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Stationary Items List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="text-center">#</th>
		<th>Item</th>
		<th>Code</th>
		<th>Category</th>
		<th>School Price</th>
		<th>Student Price</th>
		<th>Detail</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.item_id, i.item_status, i.id_cat, i.item_name, i.item_code, i.school_price,
								   i.std_price, i.item_detail, c.cat_name
								   FROM ".INVENTORY_ITEMS." i  
								   INNER JOIN ".INVENTORY_CATEGORY." c ON c.cat_id = i.id_cat 
								   WHERE i.item_status = '1' ORDER BY i.item_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="text-center">'.$srno.'</td>
	<td>'.$rowsvalues['item_name'].'</td>
	<td>'.$rowsvalues['item_code'].'</td>
	<td>'.$rowsvalues['cat_name'].'</td>
	<td>'.$rowsvalues['school_price'].'</td>
	<td>'.$rowsvalues['std_price'].'</td>
	<td>'.$rowsvalues['item_detail'].'</td>
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