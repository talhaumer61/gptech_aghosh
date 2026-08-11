<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'add' => '1'))){ 
	echo'
	<a href="#make_earning_head" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Income Head
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Income Head List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center" width="70">No.</th>
		<th>Head Name</th>
		<th width="70px;" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT head_id, head_status, head_name
								FROM ".ACCOUNT_HEADS."
								WHERE head_id != '' AND head_type = '1' AND is_deleted != '1'
								AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								ORDER BY head_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['head_name'].'</td>
	<td class="center">'.get_status($rowsvalues['head_status']).'</td>
	<td class="center">';
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/balancesheet/earning_head_update.php?id='.$rowsvalues['head_id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'delete' => '1'))){ 
		echo'
			<a href="#" class="btn btn-danger btn-xs"><i class="el el-trash"></i></a>';
		}
		echo'
	</td>';
}
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