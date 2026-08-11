<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'added' => '1'))){
	echo'
	<a href="#make_subject" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Subjects
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Subject List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Subject Code</th>
		<th>Subject Name</th>
		<th>Subject Total Marks</th>
		<th>Subject Pass Marks</th>
		<th>Subject Type</th>
		<th>Class Name</th>
		<th width="70px;" style="text-align:center;">Status</th>';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){
	echo '
		<th width="100" style="text-align:center;">Options</th>';
}
echo '
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$campus_id = '';

if($_SESSION['userlogininfo']['LOGINTYPE'] != 1){
	$campus_id .= "AND sub.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'";
}
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sub.subject_id, sub.subject_code, sub.subject_name, sub.subject_totalmarks, sub.subject_passmarks,
									sub.subject_type, sub.id_class, sub.subject_status,
									c.class_id, c.class_name
								   FROM ".CLASS_SUBJECTS." sub 
								   INNER JOIN ".CLASSES." c ON c.class_id = sub.id_class
								   WHERE sub.subject_id != '' $campus_id  
								   ORDER BY sub.subject_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['subject_code'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['subject_totalmarks'].'</td>
	<td>'.$rowsvalues['subject_passmarks'].'</td>	
	<td>'.$rowsvalues['subject_type'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['subject_status']).'</td>';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){
	echo '
	<td>';
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'updated' => '1'))){
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/class/modal_classsubjects_update.php?id='.$rowsvalues['subject_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'deleted' => '1'))){
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'classsubjects.php?deleteid='.$rowsvalues['subject_id'].'\');"><i class="el el-trash"></i></a>';
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
