<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'add' => '1'))){ 
		echo'<a href="#make_message" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
			<i class="fa fa-plus-square"></i> Make Message
		</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Message List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Subject</th>
		<th>Recipient</th>
		<th>Session</th>
		<th>Dated</th>
		<th>message</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT m.id, m.status, m.subject, m.message, m.dated, m.recipient, m.id_session,
									s.session_id, s.session_name
								   FROM ".MESSAGES." m  
								   
								   INNER JOIN ".SESSIONS." s ON s.session_id = m.id_session
								   WHERE m.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY m.dated ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['subject'].'</td>
	<td>'.$rowsvalues['recipient'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['message'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'edit' => '1'))){ 
		echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/message/modal_message_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'delete' => '1'))){ 
		echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'message.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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
else {
	header("location: dashboard.php");
}
?>