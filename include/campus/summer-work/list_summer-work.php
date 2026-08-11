<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '62', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i> Vacational Engagement Tasks List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">#</th>
		<th>Type</th>
		<th>Month</th>
		<th>Class</th>
		<th>Note</th>
		<th width="100" class="center">Download</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.summer_id, s.summer_status, s.summer_file, s.id_type, s.id_month, s.id_class, s.note, s.id_session,
								   se.session_name, c.class_name
								   FROM ".SUMMER_WORK." s 
								   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								   WHERE s.summer_status = '1' AND s.is_deleted != '1' 
								   AND s.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
								   ORDER BY s.summer_id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
if($rowsvalues['id_type'] == '1'){
	$type = "Summer";
}elseif($rowsvalues['id_type'] == '2'){
	$type = "Winter";
}else{
	$type="";
}
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td>'.$type.'</td>
	<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td class="center">
		<a href="uploads/summer-work/'.$rowsvalues['summer_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['class_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
		<a href="uploads/summer-work/'.$rowsvalues['summer_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>
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