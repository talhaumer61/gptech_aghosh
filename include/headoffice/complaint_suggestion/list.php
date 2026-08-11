<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Complaints & Suggestions List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">#</th>
		<th>Title</th>
		<th>Dated</th>
		<th>Type</th>
		<th>Source</th>
		<th>Compalint By</th>
		<th>Name</th>
		<th>Phone</th>
		<th width="70px;" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT id, status, id_type, complaint_by, id_complaint_by, name, phone, id_source, dated, title, detail, remarks
								   FROM ".COMPLAINTS." 	 									   
								   WHERE assign_to = '1' AND is_deleted != '1'");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
if($rowsvalues['id_type'] == 1){
	$type = "Complaint";
}else if($rowsvalues['id_type'] == 2){
	$type = "Suggestion";
}
//-----------------------------------------------------
if($rowsvalues['id_source'] == 1){
	$source = "Website";
}else if($rowsvalues['id_source'] == 2){
	$source = "Mobile App";
}
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$rowsvalues['title'].'</td>
	<td>'.date("d M Y", strtotime($rowsvalues['dated'])).'</td>
	<td>'.$type.'</td>
	<td>'.$source.'</td>
	<td>'.get_logintypes($rowsvalues['complaint_by']).'</td>
	<td>'.$rowsvalues['name'].'</td>
	<td>'.$rowsvalues['phone'].'</td>
	<td class="center">'.get_complaint($rowsvalues['status']).'</td>
	<td class="center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'edit' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/complaint_suggestion/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		';
	}
	// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'delete' => '1'))){ 
	// echo'
	// 	<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'complaints.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
	// ';
	// }
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