<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'add' => '1'))){ 
	echo'
	<a href="#make_item" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Stationary Item</a>';
	}
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
		<th width="70px;" class="text-center">Status</th>
		<th width="100" class="text-center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.item_id, i.item_status, i.id_cat, i.item_name, i.item_code, i.school_price,
								   i.std_price, i.item_detail, c.cat_name
								   FROM ".INVENTORY_ITEMS." i  
								   INNER JOIN ".INVENTORY_CATEGORY." c ON c.cat_id = i.id_cat 
								   ORDER BY i.item_name ASC");
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
	<td class="text-center">'.get_status($rowsvalues['item_status']).'</td>
	<td class="text-center">';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/stationary-item/update.php?id='.$rowsvalues['item_id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'delete' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\stationary_item.php?deleteid='.$rowsvalues['item_id'].'\');"><i class="el el-trash"></i></a>';
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