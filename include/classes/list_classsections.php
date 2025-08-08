<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'added' => '1'))){ 
	echo'
	<a href="#make_section" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Section
	</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Section List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Section Name</th>
		<th>Section Strength</th>
		<th>Class Name</th>
		<th width="70px;" style="text-align:center;">Status</th>';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'updated' => '1'))){ 
	echo'
		<th width="100" style="text-align:center;">Options</th>';
}
echo '
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$campus_id = '';

if($_SESSION['userlogininfo']['LOGINTYPE'] != 1){
	$campus_id .= "AND sec.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'";
}
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sec.section_id, sec.section_name, sec.section_strength, sec.id_class, sec.section_status,
									c.class_id, c.class_name
								FROM ".CLASS_SECTIONS." sec
								INNER JOIN ".CLASSES." c ON c.class_id = sec.id_class
								WHERE sec.section_id != '' $campus_id  
								ORDER BY sec.section_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['section_strength'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['section_status']).'</td>';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'updated' => '1'))){ 
	echo'
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'updated' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/class/modal_classsections_update.php?id='.$rowsvalues['section_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'classsections.php?deleteid='.$rowsvalues['section_id'].'\');"><i class="el el-trash"></i></a>';
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