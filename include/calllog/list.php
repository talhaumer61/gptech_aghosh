<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '37', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '37', 'add' => '1'))){ 
		echo'<a href="#make_call" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
			<i class="fa fa-plus-square"></i> Add Call
		</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Call List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Name</th>
		<th>Phone</th>
		<th>Dated</th>
		<th>Detail</th>
		<th>Next Followupdate</th>
		<th>Duration</th>
		<th>Note</th>
		<th>Call Type</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT * 
									FROM ".CALLLOG." c
									WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								    ORDER BY c.name ASC ");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['name'].'</td>
	<td>'.$rowsvalues['phone'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['detail'].'</td>
	<td>'.$rowsvalues['next_followupdate'].'</td>
	<td>'.$rowsvalues['duration'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td>'.get_calltypes($rowsvalues['call_type']).'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>';
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '37', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/calllog/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '37', 'update' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'call_log.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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
else {
	header("location: dashboard.php");
}
?>