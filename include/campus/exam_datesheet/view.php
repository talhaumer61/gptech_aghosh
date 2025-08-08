<?php
//-----------------------------------------------------
echo'<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_exam, t.id_session, t.id_class, t.id_section, t.id_campus,
									e.type_name, c.class_name
								   FROM ".DATESHEET." t
								   INNER JOIN ".EXAM_TYPES."  	 e	ON 	e.type_id 		= t.id_exam
								   INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
								   WHERE t.id = '".$_GET['routine']."' AND t.is_deleted != '1'
								   AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
	echo '
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-clock-o"></i> ';
		echo'
		'.$rowsvalues['type_name'].' Datesheet of <b>'.$rowsvalues['class_name'].'</b></h2>
	</header>
    
		<div class="panel-body">
			<div class="table-responsive mt-sm mb-md">
				<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
					<tbody>	
				
						
						<tr>
							<th class="center" width="70">Sr No. </th>
							<th>Days </th>
							<th>Date </th>
							<th>Subject  </th>
							<th>Room </th>
							<th>Invigilator </th>
							<th>Start Time </th>
							<th>End Time </th>
						</tr>';
						
						//----------------------------------------------------- 
						$sqllmsdetail	= $dblms->querylms("SELECT d.dated, d.start_time, d.end_time, e.emply_name, s.subject_name, s.subject_code, r.room_no
														FROM ".DATESHEET_DETAIL." 	 d 
														INNER JOIN ".EMPLOYEES." 	 e 	ON 	e.emply_id 		= d.id_teacher
														INNER JOIN ".CLASS_SUBJECTS." s 	ON 	s.subject_id 	= d.id_subject
														INNER JOIN ".CLASS_ROOMS."    r 	ON 	r.room_id 		= d.id_room
														WHERE d.id_setup = ".$rowsvalues['id']."
														ORDER BY d.dated
														");
						$srno = 0;
						while($rowsdetail = mysqli_fetch_array($sqllmsdetail))
						{
							$srno++;
							
							//--------------------------------------
							$dated = date("d F Y", strtotime($rowsdetail['dated']));
							$day = date("l", strtotime($rowsdetail['dated']));
							//--------------------------------------
							echo '					
							<tr>
								<td class="center">'.$srno.'</td>
								<td>'.$day.'</td>
								<td>'.$dated.'</td>
								<td>'.$rowsdetail['subject_name'].' ('.$rowsdetail['subject_code'].')</td>
								<td>'.$rowsdetail['room_no'].'</td>
								<td>'.$rowsdetail['emply_name'].'</td>
								<td>'.$rowsdetail['start_time'].'</td>
								<td>'.$rowsdetail['end_time'].'</td>
							</tr>';
						}
						echo'			
					</tbody>
				</table>
			</div>	
		</div>
	<!-- <div class="panel-footer">
		<div class="text-right">
			<a href="timetable-documents_print.php" class="btn btn-sm btn-primary " target="include/marks/marks_sheetprint.php">
				<i class="glyphicon glyphicon-print"></i> Print
			</a>
		</div>
	</div> --> ';
	}
	else{
		echo'
		<div class="panel-body">
			<h2 class="text-center text-danger">No Result Found!</h2>
		</div>';
	}
	echo'
	</div>';
// }
echo '
</section>';
?>