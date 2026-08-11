<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'added' => '1'))){ 
	echo'
	<a href="#make_leave" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Leave </a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Leaves List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Employee</th>
		<th>Leave For</th>
		<th>Applied Date</th>
		<th>Category</th>
		<th>Session</th>
		<th>From Date</th>
		<th>To Date</th>
		<th>Approved By</th>
		<th>Remarks</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT l.id, l.id_emply, l.reason, l.applied_date, l.id_cat, l.id_session,
								   l.from_date, l.to_date, l.approved_by, l.remarks, l.status,
								   c.cat_name,
								   e.emply_name,
								   s.session_name,
								   d.designation_name
								   FROM ".LEAVE." l
								   
								   INNER JOIN ".LEAVE_CATEGORY." c ON c.cat_id = l.id_cat
								   INNER JOIN ".EMPLOYEES." e ON e.emply_id = l.id_emply
								   INNER JOIN ".SESSIONS." s ON s.session_id = l.id_session
								   INNER JOIN ".DESIGNATIONS." d ON d.designation_id = l.approved_by
								   WHERE l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY l.applied_date ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['emply_name'].'</td>
	<td>'.$rowsvalues['reason'].'</td>
	<td>'.$rowsvalues['applied_date'].'</td>
	<td>'.$rowsvalues['cat_name'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['from_date'].'</td>
	<td>'.$rowsvalues['to_date'].'</td>
	<td>'.$rowsvalues['designation_name'].'</td>
	<td>'.$rowsvalues['remarks'].'</td>
	<td style="text-align:center;">'.get_leave($rowsvalues['status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/leave/modal_leave_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'view' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-success btn-xs" onclick="showAjaxModalZoom(\'include/modals/leave/profile.php?id='.$rowsvalues['id'].'\');"><i class="fa fa-user-circle-o"></i></a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'leave.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
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