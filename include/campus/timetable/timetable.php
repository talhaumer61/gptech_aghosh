<?php
error_reporting(0);		
echo'
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<input type="hidden" name="id_setup" id="id_setup" value="'.cleanvars($_GET['id']).'">';
//-----------------------------------------------------


$sqllms	= $dblms->querylms("SELECT d.id, d.id_setup, d.day, d.id_subject, d.id_room, d.id_period, d.id_teacher, d.id_setup,
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
								   AND d.id_setup = '".cleanvars($_GET['id'])."'
								   AND is_deleted != '1' ");
$srno = 0;
//-----------------------------------------------------

	echo'
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-clock-o"></i> ';
		$rowsvalues = mysqli_fetch_array($sqllms);		echo'
		Daily Class Routiene of <b>'.$rowsvalues['class_name'].'</b> (<b> '.$rowsvalues['section_name'].' </b>)</h2>
	</header>
    
	<div class="panel-body">
				<div class="table-responsive mt-sm mb-md">
					<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
						<tbody>	
				
						
						<tr>
								<th>
                                	Days <i class="fa fa-hand-o-down"></i> |
									Periods <i class="fa fa-hand-o-right"></i>
                                </th>';
								//-----------------------------------------
   								$sqllmssub	= $dblms->querylms("SELECT 
																	period_id, period_name
	 																FROM ".PERIODS."
																	WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ");
  								//-----------------------------------------------------
								$subjectarray = array();
 								while($rowsub = mysqli_fetch_array($sqllmssub)){ 
								$subjectarray[] = $rowsub;
								echo'
								<th style="text-align: center;">'.$rowsub['period_name'].'</th>';}
								echo'
								
							
						</tr>
						<tr>
						';
						for($i=1; $i<=7; $i++){
						echo'<td>';
							echo get_daytypes($i);
							
							echo $i;
						echo '</td>';
						
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//----------------------------------------------------- 
$day = $rowsvalues['day'];
$loop = $i;
echo'					
					<td style="text-align:center;">
							<div class="btn-group">

								<button class="mb-xs mt-xs mr-xs btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
									'.$rowsvalues['subject_name'].'
									('.$rowsvalues['period_timestart'].' - '.$rowsvalues['period_timeend'].')
									<br>Teacher : '.$rowsvalues['emply_name'].'
									<br>Class Room : '.$rowsvalues['room_no'].'
									<br>Period : '.$rowsvalues['id_period'].'
									<br>class : '.$rowsvalues['class_name'].'
									<br>section : '.$rowsvalues['section_name'].'
									<br>Day : '.get_daytypes($rowsvalues['day']).'<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="timetable/class_update/4">
											<i class="glyphicon glyphicon-edit"></i>
											Edit
										</a>
									</li>
									<li>
										<a href="#" onclick="confirm_modal("timetable/maintain/delete/4");">
											<i class="el el-trash"></i> Delete										</a>
									</li>
								</ul>
							</div>
						</td>
						
';
}
echo'
				</tr>';
						}
echo'			
				</tbody>

			</table>
		</div>	

	<div class="panel-footer">
		<div class="text-right">
			<a href="timetable-documents_print.php" class="btn btn-sm btn-primary " target="include/marks/marks_sheetprint.php">
				<i class="glyphicon glyphicon-print"></i> Print
			</a>
		</div>
	</div>';
	echo'
</section>
';
?>