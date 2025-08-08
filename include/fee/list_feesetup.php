<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'added' => '1'))){ 
	echo'
	<a href="feesetup.php?view=add" class="btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Fee Structure</a>';
}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Feesetup List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Dated</th>
		<th>Session</th>
		<th>Class</th>
		<th>Section</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
								   c.class_name, cs.section_name, s.session_name
								   FROM ".FEESETUP." f				   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY f.dated ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td style="text-align:center;">';
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'updated' => '1'))){ 
	echo'
		<a href="feesetup.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs");"><i class="glyphicon glyphicon-edit"></i></a>';
	}
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'feesetup.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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