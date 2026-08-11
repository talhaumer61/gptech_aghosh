<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'added' => '1'))){   
  echo '
  <div class="col-md-12">
	  <section class="panel  panel-featured panel-featured-primary">
	  
			  <form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
				  <header class="panel-heading">
					  <h2 class="panel-title"><i class="fa fa-plus-square"></i>	Make Fee Challan</h2>
				  </header>
				<div class="panel-body">
				
					  
					  <div class="form-group mt-sm">
						  <label class="col-md-1 control-label">Reg no <span class="required">*</span></label>
						  <div class="col-md-3">
							  <input type="text" class="form-control" name="" id="" required title="Must Be Required"/>
						  </div>
						  <label class="col-md-1 control-label">Session <span class="required">*</span></label>
						  <div class="col-md-3">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
															FROM ".SESSIONS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															ORDER BY session_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
								}
							echo '
							</select>
						</div>
						  <label class="col-md-1 control-label">Dated <span class="required">*</span></label>
						  <div class="col-md-3">
							  <input type="text" class="form-control" name="due_date" id="due_date" data-plugin-datepicker required title="Must Be Required"/>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="col-md-1 control-label">Class <span class="required">*</span></label>
							<div class="col-md-3">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
															FROM ".CLASSES."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															ORDER BY class_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
								}
							echo '
							</select>
						</div>
						<label class="col-md-1 control-label">Section <span class="required">*</span></label>
							<div class="col-md-3">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
															FROM ".CLASS_SECTIONS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															ORDER BY section_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
								}
							echo '
							</select>
						</div>
					<label class="col-md-1 control-label">Student <span class="required">*</span></label>
					<div class="col-md-3">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT std_id, std_firstname, std_lastname
													FROM ".STUDENTS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY std_firstname ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['std_id'].'">'.$valuecls['std_firstname'].' '.$valuecls['std_lastname'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>  
					  <div class="form-group">
						  <label class="col-sm-1 control-label">Status <span class="required">*</span></label>
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
					  
					  <br>
					  
					  <table class="table table-hover table-striped table-condensed mb-none">
						  <thead>
							  <tr>
								  <th class="text-center">Category</th>
								  <th class="text-center">Amount</th>
							  </tr>
						  </thead>
						  <tbody>';
  //-----------------------------------------------------
  $sqllms	= $dblms->querylms("SELECT c.cat_id, c.cat_name
									 FROM ".FEE_CATEGORY." c
																									 
									 WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
									 ORDER BY c.cat_name ASC");
  $srno = 0;
  //-----------------------------------------------------
  while($rowsvalues = mysqli_fetch_array($sqllms)) {
  //-----------------------------------------------------
  echo '
  
 						 <input type="hidden" name="id_cat['.$srno.']" id="id_cat['.$srno.']" value="'.$rowsvalues['cat_id'].'">
							  <tr>
								  <td class="ml-lg">'.$rowsvalues['cat_name'].'</td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <input type="number" class="form-control" name="amount['.$srno.']" id="amount['.$srno.']" required title="Must Be Required"/>
										  </div>
									  </div>
								  </td>
							  </tr>
							  ';
  //-----------------------------------------------------
  }
  //-----------------------------------------------------
  echo '
					  </tbody>
			  </table>
					  
				  </div>
		  
				  <footer class="panel-footer">
					  <div class="row">
						  <div class="col-md-12 text-right">
							  <button type="submit" class="btn btn-primary" id="submit_challan" name="submit_challan">Save</button>
							  <button class="btn btn-default modal-dismiss">Cancel</button>
						  </div>
					  </div>
				  </footer>
		  		</div>
			</form>
	  </section>
  </div>';
}
else{
	header("Location: dashboard.php");
}
?>
