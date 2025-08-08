<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'view' => '1'))){ 
echo'
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'added' => '1'))){ 
	echo'
	<a href="#make_campus" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Campus </a>';
}
echo'
	<h2 class="panel-title"><i class="fa fa-list"></i> Campus List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Code</th>
		<th>Name</th>
		<th>Head</th>
		<th>E-mail</th>
		<th>Phone</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT c.campus_id, c.campus_status, c.campus_regno, c.campus_code, c.campus_name, 
								   c.campus_address, c.campus_email, c.campus_phone, c.campus_head, c.campus_fax, c.campus_website, c.campus_logo  
								   FROM ".CAMPUS." c  
								   ORDER BY c.campus_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['campus_code'].'</td>
	<td>'.$rowsvalues['campus_name'].'</td>
	<td>'.$rowsvalues['campus_head'].'</td>
	<td>'.$rowsvalues['campus_email'].'</td>
	<td>'.$rowsvalues['campus_phone'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['campus_status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/campuses/modal_campus_update.php?campus_id='.$rowsvalues['campus_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels.php?delete campus_id='.$rowsvalues['campus_id'].'\');"><i class="el el-trash"></i></a>
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