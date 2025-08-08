<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="#make_timetable" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Class Timetable</a>
	<a href="timetable_periodsmake.php" class="btn btn-primary btn-xs pull-right mr-sm">
	<i class="fa fa-plus-square"></i> Make  Timetable</a>
	<h2 class="panel-title"><i class="fa fa-list"></i>  Class Timetabel List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Day</th>
		<th>Period</th>
		<th>Room</th>
		<th>Session</th>
		<th>Class</th>
		<th>Section</th>
		<th>Subject</th>
		<th>Teacher</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------

$sqllms	= $dblms->querylms("SELECT d.id, d.day, d.id_subject, d.id_room, d.id_period, d.id_teacher, d.id_setup,
								   t.id, t.status, t.id_session, t.id_class, t.id_section, t.id_campus,
								   ss.session_id, ss.session_status, ss.session_name,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name, 
								   s.subject_id, s.subject_status, s.subject_name,
								   r.room_id, r.room_status, r.room_no, r.room_capacity,
								   p.period_id, p.period_status, p.period_name, p.period_timestart, p.period_timeend,
								   e.emply_id, e.emply_status, e.emply_name, e.id_type
								     
								   FROM ".TIMETABEL_DETAIL." 	 d 
								   INNER JOIN ".TIMETABLE."  	 t 	ON 	t.id 			= d.id_setup
								   INNER JOIN ".SESSIONS."  	 ss	ON 	ss.session_id 	= t.id_session
								   INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
								   INNER JOIN ".CLASS_SECTIONS." se	ON 	se.section_id 	= t.id_section
								   INNER JOIN ".CLASS_SUBJECTS." s 	ON 	s.subject_id 	= d.id_subject
								   INNER JOIN ".CLASS_ROOMS."    r 	ON 	r.room_id 		= d.id_room
								   INNER JOIN ".PERIODS."        p 	ON 	p.period_id 	= d.id_period
								   INNER JOIN ".EMPLOYEES." 	 e 	ON 	e.emply_id 		= d.id_teacher
								   
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND e.id_type = '1'
								   ORDER BY d.day ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.get_daytypes($rowsvalues['day']).'</td>
	<td>'.$rowsvalues['period_name'].'</td>
	<td>'.$rowsvalues['room_no'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['emply_name'].'</td>
	<td>'.$rowsvalues['period_timestart'].'</td>
	<td>'.$rowsvalues['period_timeend'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/timetable_class/modal_classtimetable_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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