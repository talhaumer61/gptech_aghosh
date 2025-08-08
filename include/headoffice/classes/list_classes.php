<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '47', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '47', 'add' => '1'))){
	echo'
	<a href="#make_class" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Class
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Class List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Class Name</th>
		<th>Class Numeric</th>
		<th>Class Group</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT c.class_id, c.class_name, c.class_code, c.id_classgroup, c.class_status  
								   FROM ".CLASSES." c  
								   WHERE c.class_id != '' AND c.is_deleted = '0'
								   ORDER BY c.class_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['class_code'].'</td>
	<td>'.get_classgroup($rowsvalues['id_classgroup']).'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['class_status']).'</td>
	<td class="center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '47', 'edit' => '1'))){
		echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/class/modal_class_update.php?id='.$rowsvalues['class_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '47', 'delete' => '1'))){
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'class.php?deleteid='.$rowsvalues['class_id'].'\');"><i class="el el-trash"></i></a>';
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