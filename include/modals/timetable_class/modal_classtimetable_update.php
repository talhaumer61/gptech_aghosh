<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
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
								   AND e.id_type = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="#" class="" id="form" method="post" accept-charset="utf-8">
<input type="hidden" name="exm_tbl_id" value="'.$rowsvalues['id'].'">
			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Class Timetable				</h4>
			</div>

			<div class="panel-body">
		
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Session <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_session" id="id_session" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
                                ';
								$sqllms	= $dblms->querylms("SELECT s.session_id, s.session_status, s.session_name
								   FROM ".SESSIONS." s  
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND s.session_status = '1'
								   ORDER BY s.session_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['session_id'] == $rowsvalues['id_session']) { 
							  				echo '<option value="'.$rowsvalues['session_id'].'" selected>'.$rowsvalues['session_name'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['session_id'].'">'.$rowsvalues['session_name'].'</option>';
						 				 }
					 				 }
								   echo'
							</select>
						</div>
					</div>
					<div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Class <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_class" id="id_class" required title="Must Be Required" class="form-control populate">
                            
							<option value="">Select</option>
							';
                                $sqllms	= $dblms->querylms("SELECT c.class_id, c.class_status, c.class_name
								   FROM ".CLASSES." c  
								   WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND  c.class_status = '1'
								   ORDER BY c.class_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['class_id'] == $rowsvalues['id_class']) { 
							  				echo '<option value="'.$rowsvalues['class_id'].'" selected>'.$rowsvalues['class_name'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['class_id'].'">'.$rowsvalues['class_name'].'</option>';
						 				 }
					 				 }
								   echo'
							</select>
						</div>
					</div>
					
				</div>
				
				
				
				<div class="row">
					<div class="col-sm-6 mt-sm" >
						<div class="form-group">
							<label class="control-label">Section <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_section" id="id_section" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
                                ';
								$sqllms	= $dblms->querylms("SELECT s.section_id, s.section_status, s.section_name
								   FROM ".CLASS_SECTIONS." s  
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND s.section_status = '1'  
								   ORDER BY s.section_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['section_id'] == $rowsvalues['id_section']) { 
							  				echo '<option value="'.$rowsvalues['section_id'].'" selected>'.$rowsvalues['section_name'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['section_id'].'">'.$rowsvalues['section_name'].'</option>';
						 				 }
					 				 }
								   echo'
							</select>
						</div>
					</div>
                    <div class="col-sm-6 mt-sm" >
						<div class="form-group">
							<label class="control-label">Day <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="day" id="day" required title="Must Be Required" class="form-control populate">
								
								
								<option value="'.$rowsvalues['day'].'">'.$rowsvalues['day'].'</option>
								<option value="Monday">Monday</option>
								<option value="Tuesday">Tuesday</option>
								<option value="Wednesday">Wednesday</option>
								<option value="Thrusday">Thrusday</option>
								<option value="Friday">Friday</option>
								<option value="Saturday">Saturday</option>
								<option value="Sunday">Sunday</option>
							</select>
						</div>
					</div>
                    
				</div>
				<div class="row">
					
					<div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Subject <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_subject" id="id_subject" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT cs.subject_id, cs.subject_status, cs.subject_name
								   FROM ".CLASS_SUBJECTS." cs  
								   WHERE cs.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND cs.subject_status = '1'
								   ORDER BY cs.subject_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['subject_id'] == $rowsvalues['id_subject']) { 
							  				echo '<option value="'.$rowsvalues['subject_id'].'" selected>'.$rowsvalues['subject_name'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['subject_id'].'">'.$rowsvalues['subject_name'].'</option>';
						 				 }
					 				 }
								   echo'
                             </select>
						</div>
					</div>
                    <div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Teacher <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_teacher" id="id_teacher" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_status, e.id_type, e.emply_name
								   FROM ".EMPLOYEES." e 
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND e.id_type = '1' 
								   ORDER BY e.emply_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['emply_id'] == $rowsvalues['id_teacher']) { 
							  				echo '<option value="'.$rowsvalues['emply_id'].'" selected>'.$rowsvalues['emply_name'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['emply_id'].'">'.$rowsvalues['emply_name'].'</option>';
						 				 }
					 				 }
								   echo'
                             </select>
						</div>
					</div>
                    
				</div>
				
				<div class="row">
                    <div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Room <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_room" id="id_room" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT r.room_id, r.room_status, r.room_no
								   FROM ".CLASS_ROOMS." r
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND r.room_status = '1'
								   ORDER BY r.room_no ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['room_id'] == $rowsvalues['id_room']) { 
							  				echo '<option value="'.$rowsvalues['room_id'].'" selected>'.$rowsvalues['room_no'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['room_id'].'">'.$rowsvalues['room_no'].'</option>';
						 				 }
					 				 }
								   echo'
                             </select>
						</div>
					</div>
                    <div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Period <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_period" id="id_period" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT p.period_id, p.period_status, p.period_name
								   FROM ".PERIODS." p
								   WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND period_status = '1'
								   ORDER BY p.period_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
						  		   		if($valuecls['period_id'] == $rowsvalues['id_period']) { 
							  				echo '<option value="'.$rowsvalues['period_id'].'" selected>'.$rowsvalues['period_name'].'</option>';
						  				} else { 
							  				echo '<option value="'.$rowsvalues['period_id'].'">'.$rowsvalues['period_name'].'</option>';
						 				 }
					 				 }
								   echo'
                             </select>
						</div>
					</div>
				</div>
                
			</div>
				
				
				
				
				
            <div class="col-md-12">
		   <div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					}
			echo '
				</div>
			</div>
            
            </div>
		
	</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" name="update_timetable" class="btn btn-primary" id="update_timetable">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
			</form>		</section>
	</div>
</div>';
?>