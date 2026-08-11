<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'added' => '1'))){
	echo'
	<a href="#make_timetable" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Period
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Periods List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>												
		<th style="text-align:center;">#</th>
		<th>Period Name</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT p.period_id, p.period_status, p.period_name, p.period_timestart, p.period_timeend 
								   FROM ".PERIODS." p  
								   WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY p.period_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['period_name'].'</td>
	<td>'.$rowsvalues['period_timestart'].'</td>
	<td>'.$rowsvalues['period_timeend'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['period_status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'updated' => '1'))){
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/timetable/period/modals_period_update.php?id='.$rowsvalues['period_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'deleted' => '1'))){
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'timetable_period.php?deleteid='.$rowsvalues['period_id'].'\');"><i class="el el-trash"></i></a>';
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
</section>
';
}
else{
	header("Location: dashboard.php");
}
?>