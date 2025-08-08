<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_exams" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Add Exam</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Exam List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Exam Name</th>
		<th>Exam Start Date</th>
		<th>Exam End Date</th>
		<th>Exam Comment</th>
		<th>Term Name</th>
		<th>Session</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT e.exam_id, e.exam_name, e.exam_startdate, e.exam_enddate, e.exam_comment,
									e.id_term, e.id_session, e.exam_status,
									t.term_id, t. term_name,
									s.session_id, s.session_name
								   FROM ".EXAMS." e  
								   
								   INNER JOIN ".EXAM_TERMS." t ON t.term_id = e.id_term
								   INNER JOIN ".SESSIONS." s ON s.session_id = e.id_session
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY e.exam_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['exam_name'].'</td>
	<td>'.$rowsvalues['exam_startdate'].'</td>
	<td>'.$rowsvalues['exam_enddate'].'</td>
	<td>'.$rowsvalues['exam_comment'].'</td>
	<td>'.$rowsvalues['term_name'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['exam_status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exams/modal_examss_update.php?id='.$rowsvalues['exam_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'examss.php?deleteid='.$rowsvalues['exam_id'].'\');"><i class="el el-trash"></i></a>
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