<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'added' => '1'))){
	echo'
	<a href="#make_subject" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Subject
	</a>';
	}
	echo'
	<a href="#print_subjects" class="modal-with-move-anim btn btn-primary btn-xs pull-right mr-xs">
		<i class="fa fa-print"></i> Print
	</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Subject List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">No.</th>
		<th>Subject Code</th>
		<th>Subject Name</th>
		<th class="center">Subject Type</th>
		<th>Class Name</th>
		<th width="70px;" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sub.subject_id, sub.subject_code, sub.subject_name, sub.subject_totalmarks, sub.subject_passmarks,
									sub.subject_type, sub.id_class, sub.subject_status,
									c.class_id, c.class_name
								   FROM ".CLASS_SUBJECTS." sub 
								   INNER JOIN ".CLASSES." c ON c.class_id = sub.id_class
								   WHERE sub.subject_id != ''  
								   ORDER BY c.class_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['subject_code'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td class="center">'.get_subjecttype($rowsvalues['subject_type']).'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td class="center">'.get_status($rowsvalues['subject_status']).'</td>
	<td class="center">';
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '5', 'edit' => '1'))){
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/class/modal_classsubjects_update.php?id='.$rowsvalues['subject_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '5', 'delete' => '1'))){
			echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'classsubjects.php?deleteid='.$rowsvalues['subject_id'].'\');"><i class="el el-trash"></i></a>';
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
