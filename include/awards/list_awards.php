<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_award" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Award</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Award List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Award Name</th>
		<th>Gift Item</th>
		<th>Cash Price</th>
		<th>Award Reason</th>
		<th>Session</th>
		<th>Class</th>
		<th>Student</th>
		<th>Given Date</th>
		<th>Given By</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT a.id, a.status, a.award_name, a.gift_item, a.cash_price, a.award_reason,
								   a.id_class, a.id_std, a.given_date, a.given_by, a.id_session,
								   se.session_id, se.session_name,
								   c.class_id, c.class_name,
								   s.std_id, s.std_firstname, s.std_lastname,
								   e.emply_id, e.emply_name
								   FROM ".STUDENT_AWARDS." 	a 
								   INNER JOIN ".SESSIONS." 	se 	ON se.session_id	= a.id_session
								   INNER JOIN ".CLASSES." 	c 	ON c.class_id 		= a.id_class
								   INNER JOIN ".STUDENTS." 	s 	ON s.std_id 		= a.id_std
								   INNER JOIN ".EMPLOYEES." e	ON e.emply_id 		= a.given_by
								   WHERE a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY a.award_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['award_name'].'</td>
	<td>'.$rowsvalues['gift_item'].'</td>
	<td>'.$rowsvalues['cash_price'].'</td>
	<td>'.$rowsvalues['award_reason'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['std_firstname'].' '.$rowsvalues['std_lastname'].'</td>
	<td>'.$rowsvalues['given_date'].'</td>
	<td>'.$rowsvalues['emply_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/awards/modal_award_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
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
?>