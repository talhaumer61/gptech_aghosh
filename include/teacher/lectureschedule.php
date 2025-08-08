<?php 
//-----------------------------------------------
echo '
<title> Timetable Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Class Timetable Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
//-----------------------------------------------------
$sqllmsemp  = $dblms->querylms("SELECT emply_id  
										FROM ".EMPLOYEES." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
$value_emp = mysqli_fetch_array($sqllmsemp);
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_session, t.id_class, t.id_section
								   FROM ".TIMETABEL_DETAIL." d
								   INNER JOIN ".TIMETABLE." t ON t.id = d.id_setup
								   WHERE d.id_teacher 	= '".cleanvars($value_emp['emply_id'])."' AND t.status = '1' 
								   AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
	echo '
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-clock-o"></i> Weekly Lecture Schedule</h2>
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
																	period_id, period_name, period_timestart, period_timeend
	 																FROM ".PERIODS."
																	WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ");
  								//-----------------------------------------------------
								$periods = array();
 								while($rowsub = mysqli_fetch_array($sqllmssub)){ 
									$periods[] = $rowsub;
									echo'<th style="text-align: center;">'.$rowsub['period_name'].'</th>';
								}
						echo '</tr><tr>';
						for($i=1; $i<=7; $i++){
						echo'<td>'. get_daytypes($i).'</td>';
//-----------------------------------------------------
foreach($periods as $itemperiod) { 
//----------------------------------------------------- 
$day = get_daytypes($i);
$loop = $i;
//----------------------------------------------------- 
$sqllmsdetail	= $dblms->querylms("SELECT d.id, d.day, t.id, t.id_session, c.class_name, se.section_name, subject_name, r.room_no
								   FROM ".TIMETABEL_DETAIL." 	 d 
								   INNER JOIN ".TIMETABLE."  	 t 	ON 	t.id 			= d.id_setup
								   INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
								   INNER JOIN ".CLASS_SECTIONS." se	ON 	se.section_id 	= t.id_section
								   INNER JOIN ".CLASS_SUBJECTS." s 	ON 	s.subject_id 	= d.id_subject
								   INNER JOIN ".CLASS_ROOMS."    r 	ON 	r.room_id 		= d.id_room
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND t.status = '1' 
								   AND d.id_teacher = '".$value_emp['emply_id']."' 
								   AND d.id_period = '".$itemperiod['period_id']."'AND d.day = ".$i."
								   AND d.id_setup = ".$rowsvalues['id']." LIMIT 1");
$rowsdetail = mysqli_fetch_array($sqllmsdetail);
//----------------------------------------------------- 
echo '					
					<td style="text-align:center;">
							<div class="btn-group">';
							if(mysqli_num_rows($sqllmsdetail) > 0){
								echo'
								<button class="mb-xs mt-xs mr-xs btn btn-primary btn-sm">
									'.$rowsdetail['subject_name'].'
									('.$itemperiod['period_timestart'].' - '.$itemperiod['period_timeend'].')
									<br>Class Room : '.$rowsdetail['room_no'].'
									<br>Class : '.$rowsdetail['class_name'].'
									<br>Section : '.$rowsdetail['section_name'].'
								</button>';
							}
							echo '
							</div>
						</td>';
}
echo'
				</tr>';
						}
echo'			
				</tbody>

			</table>
		</div>';
	}
	echo'
	</div>
</section>';
//-----------------------------------------------
echo '
</div>
</div>
</section>
</div>
</section>';
//-----------------------------------------------
?>