<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){ 

//-----------------------------------------------
if(isset($_POST['id_class'])){$class = $_POST['id_class'];}else{$class = "";}
if(isset($_POST['id_section'])){$section = $_POST['id_section'];}else{$section = "";}
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="panel-heading">
			<h4 class="panel-title"><i class="fa fa-plus-square"></i> View Class Routine</h4>
		</div>
		<div class="panel-body">
			<div class="row mt-sm">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<label class="control-label">Class <span class="required">*</span></label>
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" onchange="get_classsection(this.value)">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
												FROM ".CLASSES."
												WHERE class_status = '1' 
												ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								if($valuecls['class_id'] == $class){
									echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
								}else{
									echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
								}
						}
					echo '
					</select>
				</div>
				<div id="getclasssection">
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">Section <span class="required">*</span></label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section" required>
								<option value="">Select</option>
							</select>
						</div>
					</div>
				</div>
			</div>		
		</div>
		<footer class="panel-footer mt-sm">
			<div class="row">
				<div class="col-md-12 text-center">
					<button type="submit" id="view_timetable" name="view_timetable" class="mr-xs btn btn-primary">Get Details</button>
				</div>
			</div>
		</footer>
	</form>
</section>';


//---------------------VIEW TIMETABLE DETAILS--------------------------------
if(isset($_POST['view_timetable'])){
//-----------------------------------------------------
echo'<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_session, t.id_class, t.id_section, t.id_campus,
								   ss.session_id, ss.session_status, ss.session_name,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name
								   FROM ".TIMETABLE." t
								   INNER JOIN ".SESSIONS."  	 ss	ON 	ss.session_id 	= t.id_session
								   INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
								   INNER JOIN ".CLASS_SECTIONS." se	ON 	se.section_id 	= t.id_section
								   WHERE t.id_class = '".$class."'
								   AND t.id_section = '".$section."' AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
	echo '
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-clock-o"></i> ';
		echo'
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
																	period_id, period_name, period_timestart, period_timeend
	 																FROM ".PERIODS."
																	WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ");
  								//-----------------------------------------------------
								$periods = array();
 								while($rowsub = mysqli_fetch_array($sqllmssub)){ 
								$periods[] = $rowsub;
								echo'
								<th style="text-align: center;">'.$rowsub['period_name'].'</th>';}
								echo'
								
							
						</tr>
						<tr>
						';
						for($i=1; $i<=7; $i++){
						echo'<td>'. get_daytypes($i).'</td>';
//-----------------------------------------------------
foreach($periods as $itemperiod) { 
//----------------------------------------------------- 
$day = get_daytypes($i);
$loop = $i;

//----------------------------------------------------- 
$sqllmsdetail	= $dblms->querylms("SELECT d.id, d.day, d.id_subject, d.id_room, d.id_period, d.id_teacher, d.id_setup,
								   t.id, t.status, t.id_session, t.id_class, t.id_section, t.id_campus,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name, 
								   s.subject_id, s.subject_status, s.subject_name,
								   r.room_id, r.room_status, r.room_no, r.room_capacity,
								   e.emply_id, e.emply_status, e.emply_name, e.id_type
								   FROM ".TIMETABEL_DETAIL." 	 d 
								   INNER JOIN ".TIMETABLE."  	 t 	ON 	t.id 			= d.id_setup
								   INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
								   INNER JOIN ".CLASS_SECTIONS." se	ON 	se.section_id 	= t.id_section
								   INNER JOIN ".CLASS_SUBJECTS." s 	ON 	s.subject_id 	= d.id_subject
								   INNER JOIN ".CLASS_ROOMS."    r 	ON 	r.room_id 		= d.id_room
								   INNER JOIN ".EMPLOYEES." 	 e 	ON 	e.emply_id 		= d.id_teacher
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND d.id_period = '".$itemperiod['period_id']."'AND d.day = ".$i."
								   AND d.id_setup = ".$rowsvalues['id']." LIMIT 1");
$rowsdetail = mysqli_fetch_array($sqllmsdetail);
//----------------------------------------------------- 
echo '					
					<td style="text-align:center;">
							<div class="btn-group">';
							if(mysqli_num_rows($sqllmsdetail) > 0){
								echo'
								<button class="mb-xs mt-xs mr-xs btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
									'.$rowsdetail['subject_name'].'
									('.$itemperiod['period_timestart'].' - '.$itemperiod['period_timeend'].')
									<br>Teacher : '.$rowsdetail['emply_name'].'
									<br>Class Room : '.$rowsdetail['room_no'].'
									<br>Class : '.$rowsdetail['class_name'].'
									<br>Section : '.$rowsdetail['section_name'].'
									<br>Day : '.get_daytypes($rowsdetail['day']).'
								</button>
								<!-- <ul class="dropdown-menu">
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
								</ul> -->';
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
}
echo '
</section>';
}
else{
	header("location: dashboard.php");
}
?>