<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'added' => '1'))){
	echo'
	<a href="#make_session" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Session
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Session List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Session Name</th>
		<th>Start Date</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.session_id, s.session_name, s.session_startdate, s.session_status  
								   FROM ".SESSIONS." s  
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY s.session_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['session_startdate'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['session_status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'updated' => '1'))){
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/session/modal_session_update.php?id='.$rowsvalues['session_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'deleted' => '1'))){
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'sessions.php?deleteid='.$rowsvalues['session_id'].'\');"><i class="el el-trash"></i></a>
		';
	}
	echo'
	<br>

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