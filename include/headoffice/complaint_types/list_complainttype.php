<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '23', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '23', 'add' => '1'))){ 
		echo'<a href="#make_class" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Add Complaint Type</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Complaint List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center" width="70">#</th>
		<th>Type Name</th>
		<th>Type Detail</th>
		<th width="70px;" class="center" width="70">Status</th>
		<th width="100" class="center" width="70">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT cot.type_id, cot.type_name, cot.type_detail, cot.type_status  
								   FROM ".COMPLAINT_TYPE." cot  
								   WHERE cot.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY cot.type_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center" width="70">'.$srno.'</td>
	<td>'.$rowsvalues['type_name'].'</td>
	<td>'.$rowsvalues['type_detail'].'</td>
	<td class="center" width="70">'.get_status($rowsvalues['type_status']).'</td>
	<td>';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '23', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/complaint_type/modal_complainttype_update.php?id='.$rowsvalues['type_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '23', 'delete' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'complainttype.php?deleteid='.$rowsvalues['type_id'].'\');"><i class="el el-trash"></i></a>';
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