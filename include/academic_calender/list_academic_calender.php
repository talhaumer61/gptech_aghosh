<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'added' => '1'))){ 
	echo'
	<a href="#make_calender" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make  Academic Calender 
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Academic Calender  List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Particular </th>
		<th>Session </th>
		<th>Start Date </th>
		<th>End Date </th>
		<th>Remarks </th>
		<th width="70px;">Published </th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  a.id, a.status, a.published, a.id_session, a.dated,
									d.id_setup, d.id_cat, d.date_start, d.date_end, d.remarks,
									s.session_id, s.session_status, s.session_name,
									cat_id, cat_status, cat_name
								   FROM ".ACADEMICCALENAR." a 
								   INNER JOIN ".ACADEMICCALENAR_DETAIL." 		d ON d.id_setup   = a.id
								   INNER JOIN ".SESSIONS."  					s ON s.session_id = a.id_session
								   INNER JOIN ".ACADEMICCALENAR_PARTICULARS."  	c ON c.cat_id = d.id_cat
								   ORDER BY d.date_start ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['cat_name'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['date_start'].'</td>
	<td>'.$rowsvalues['date_end'].'</td>
	<td>'.$rowsvalues['remarks'].'</td>
	<td style="text-align:center;">'.get_notification($rowsvalues['published']).'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/academic_calender/academic_calender_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'academic-calender.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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