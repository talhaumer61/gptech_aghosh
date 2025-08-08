<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'view' => '1')))
{
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'added' => '1')))
{
echo'<a href="#inquiry_followup" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Add Inquiry Followup</a>';
}
echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Inquiry Followup List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Inquiry </th>
		<th>Date Followup </th>
		<th>Next Followup Date </th>
		<th>Response </th>
		<th>Notes </th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.id_inquiry, f.datefollowup, f.next_followupdae, f.response, f.note,
								   q.id, q.name 
								   FROM ".ADMISSIONS_INQUIRYFOLLOWUP." f  
								   
								   INNER JOIN ".ADMISSIONS_INQUIRY." q ON q.id = f.id_inquiry
								   ORDER BY f.id_inquiry ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['name'].'</td>
	<td>'.$rowsvalues['datefollowup'].'</td>
	<td>'.$rowsvalues['next_followupdae'].'</td>
	<td>'.$rowsvalues['response'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td>
	';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'updated' => '1')))
{
echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/admissions/modal_admission_inquiryfollowup_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	';
}
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'deleted' => '1')))
{
echo'

		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'admission_inquiryfollowup.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
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