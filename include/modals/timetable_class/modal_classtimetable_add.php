<!-- Add Modal Box -->
<?php
echo'
<div id="make_timetable" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Class Timetable</h2>
			</header>
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
									echo'
									   <option value="'.$rowsvalues['session_id'].'">'.$rowsvalues['session_name'].'</option>
								   ';
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
									 echo'
									  <option value="'.$rowsvalues['class_id'].'">'.$rowsvalues['class_name'].'</option>
									  ';
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
									echo'
									   <option value="'.$rowsvalues['section_id'].'">'.$rowsvalues['section_name'].'</option>
								   ';
								   }
								   echo'
							</select>
						</div>
					</div>
                    <div class="col-sm-6 mt-sm" >
						<div class="form-group">
							<label class="control-label">Day <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="day" id="day" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								<option value="1">Monday</option>
								<option value="2">Tuesday</option>
								<option value="3">Wednesday</option>
								<option value="4">Thrusday</option>
								<option value="5">Friday</option>
								<option value="6">Saturday</option>
								<option value="7">Sunday</option>
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
									echo'
									   <option value="'.$rowsvalues['subject_id'].'">'.$rowsvalues['subject_name'].'</option>
								   ';
								   }
								   echo'
                             </select>
						</div>
					</div>
                    <div class="col-sm-6 mt-sm">
						<div class="form-group">
							<label class="control-label">Teacher <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_emply" id="id_emply" required title="Must Be Required" class="form-control populate">
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_status, e.id_type, e.emply_name
								   FROM ".EMPLOYEES." e 
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND e.id_type = '1' 
								   ORDER BY e.emply_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									echo'
									   <option value="'.$rowsvalues['emply_id'].'">'.$rowsvalues['emply_name'].'</option>
								   ';
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
									echo'
									   <option value="'.$rowsvalues['room_id'].'">'.$rowsvalues['room_no'].'</option>
								   ';
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
									echo'
									   <option value="'.$rowsvalues['period_id'].'">'.$rowsvalues['period_name'].'</option>
								   ';
								   }
								   echo'
                             </select>
						</div>
					</div>
				</div>
                
			</div>
            <div class="col-md-12 form-horizontal">
            <div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
            </div>
		
	</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_timetable" name="submit_timetable">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>
';?>
