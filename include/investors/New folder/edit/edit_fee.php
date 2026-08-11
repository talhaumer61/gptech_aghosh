  <?php 	
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
								   c.class_name, cs.section_name, s.session_name
								   FROM ".FEESETUP." f
								   								   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session	
								   
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY f.dated ASC");

	$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
	<fieldset class="mt-lg">
		<div class="form-group">
						<label class="col-md-3 control-label">Session <span class="required">*</span></label>
							<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
						<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY session_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['session_id'] == $rowsvalues['id_session']) { 
								echo '<option value="'.$valuecls['session_id'].'" selected>'.$valuecls['session_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
							}
						}
						echo '
						</select>	
						</div>
					  </div>
					  <div class="form-group mt-sm">
						  <label class="col-md-3 control-label">Dated <span class="required">*</span></label>
						  <div class="col-md-9">
							  <input type="text" class="form-control" name="dated" id="dated" value="'.$rowsvalues['dated'].'" data-plugin-datepicker required title="Must Be Required"/>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="col-md-3 control-label">Class <span class="required">*</span></label>
							<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
							<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY class_name ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								if($valuecls['class_id'] == $rowsvalues['id_class']) { 
									echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
								} else { 
									echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
								}
							}
						echo '
						</select>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-md-3 control-label">Section <span class="required">*</span></label>
							<div class="col-md-9">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
								<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
													FROM ".CLASS_SECTIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY section_name ASC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
										if($valuecls['section_id'] == $rowsvalues['id_section']) { 
											echo '<option value="'.$valuecls['section_id'].'" selected>'.$valuecls['section_name'].'</option>';
										} else { 
											echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
										}
									}
						echo '
						</select>
						</div>
					  </div>
					   <div class="form-group">
						<label class="col-md-3 control-label">Section <span class="required">*</span></label>
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
					  <br>
					  <table class="table table-hover table-striped table-condensed mb-none">
						  <thead>
							  <tr>
								  <th class="text-center">Category</th>
								  <th class="text-center">Duration</th>
								  <th class="text-center">Amount</th>
								  <th class="text-center">Type</th>
							  </tr>
						  </thead>
						  <tbody>';
						  

  //-----------------------------------------------------
  $sqllms	= $dblms->querylms("SELECT c.cat_id, c.cat_name,
  									   fsd.id, fsd.duration, fsd.amount, fsd.type
									 FROM ".FEE_CATEGORY." c
									 
									 INNER JOIN ".FEESETUPDETAIL." fsd ON fsd.id_cat = c.cat_id 													 
									 WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
									 AND fsd.id_setup = '".$rowsvalues['id']."'
									 ORDER BY c.cat_name ASC");
  $srno = 0;
  //-----------------------------------------------------
  while($rowsvalues = mysqli_fetch_array($sqllms)) {
  //-----------------------------------------------------
  $srno++;
  //-----------------------------------------------------
  echo '
  <input type="hidden" name="id_cat['.$srno.']" id="id_cat['.$srno.']" value="'.$rowsvalues['cat_id'].'">
  <input type="hidden" name="id_edit['.$srno.']" id="id_edit['.$srno.']" value="'.$rowsvalues['id'].'">
							  <tr>
							  
								  <td>'.$rowsvalues['cat_name'].'</td>
								  <td>
									  <div class="form-group mt-sm">
										   <label class="col-md-3 control-label">Period<span class="required">*</span></label>
										   <div class="col-md-9">
											  <select class="form-control" name="duration['.$srno.']" id="duration['.$srno.']" required title="Must Be Required">
												  <option  value="'.$rowsvalues['duration'].'">'.$rowsvalues['duration'].'</option>
												  <option value="Once">Once</option>
												  <option value="Monthly">Monthly</option>
												  <option value="Smester">Smester</option>
												  <option value="Early">Early</option>
											  </select>
										   </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <label class="col-md-3 control-label">Amount <span class="required">*</span></label>
										  <div class="col-md-9">
											  <input type="number" class="form-control" name="amount['.$srno.']" id="amount['.$srno.']" value="'.$rowsvalues['amount'].'"  required title="Must Be Required"/>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										   <label class="col-md-3 control-label">Type <span class="required">*</span></label>
										   <div class="col-md-9">
											  <select class="form-control" name="type['.$srno.']" id="type['.$srno.']" required title="Must Be Required">
												  <option  value="'.$rowsvalues['type'].'">'.$rowsvalues['type'].'</option>
												  <option value="refunable">Refunable</option>
												  <option value="nonrefundable">Nonrefundable</option>
											  </select>
										   </div>
									  </div>
								  </td>
							  </tr>';
  //-----------------------------------------------------
  }
  //-----------------------------------------------------
  echo '
					  </tbody>
			  </table>
					  
				  </div>
	</fieldset>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary" id="changes_feesetup" name="changes_feesetup">Update Fee</button>
			</div>
		</div>
	</div>
</form>
</div>';