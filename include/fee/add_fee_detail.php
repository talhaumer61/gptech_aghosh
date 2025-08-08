<?php
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'added' => '1'))){   
  echo '
	  <section class="panel">
	  
			  <form action="feesetup.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
				  <header class="panel-heading">
					  <h2 class="panel-title"><i class="fa fa-plus-square"></i>	Make Fee Structure</h2>
				  </header>
				<div class="panel-body">
					  <div class="form-group">
						<label class="col-md-2 control-label">Session <span class="required">*</span></label>
							<div class="col-md-9">
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
					  </div>
					  <div class="form-group mt-sm">
						  <label class="col-md-2 control-label">Dated <span class="required">*</span></label>
						  <div class="col-md-9">
							  <input type="text" class="form-control" name="dated" id="dated" autocomplete="off" data-plugin-datepicker required title="Must Be Required"/>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="col-md-2 control-label">Class <span class="required">*</span></label>
							<div class="col-md-9">
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
					  </div>
					  <div class="form-group">
						<label class="col-md-2 control-label">Section <span class="required">*</span></label>
							<div class="col-md-9">
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
					  </div>
					  <div class="form-group">
						  <label class="col-sm-2 control-label">Status <span class="required">*</span></label>
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
								  <th class="text-center">Duration</th>
								  <th class="text-center">Amount</th>
								  <th class="text-center">Type</th>
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
  $srno++;
  //-----------------------------------------------------
  echo '
  <input type="hidden" name="id_cat['.$srno.']" id="id_cat['.$srno.']" value="'.$rowsvalues['cat_id'].'">
							  <tr>
								  <td >'.$rowsvalues['cat_name'].'</td>
								 <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <select class="form-control" name="duration['.$srno.']" id="duration['.$srno.']" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
											  	<option vlaue="">Select</option>
											  	<option vlaue="Yearly">Yearly</option>
											  	<option vlaue="Half">Half</option>
											  	<option vlaue="Quatar">Quatar</option>
											  	<option vlaue="Monthly">Monthly</option>
											  </select>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <input type="number" class="form-control" name="amount['.$srno.']" id="amount['.$srno.']" required title="Must Be Required"/>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <select class="form-control" name="type['.$srno.']" id="type['.$srno.']" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
											  	<option vlaue="">Select</option>
											  	<option vlaue="Refundable">Refundable</option>
											  	<option vlaue="Non-Refundable">Non-Refundable</option>
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
		  
				  <footer class="panel-footer">
					  <div class="row">
						  <div class="col-md-12 text-right">
							  <button type="submit" class="btn btn-primary" id="submit_feesetup" name="submit_feesetup">Save</button>
							  <button class="btn btn-default modal-dismiss">Cancel</button>
						  </div>
					  </div>
				  </footer>
		  		</div>
			</form>
	  </section>';
}
else{
	header("Location: dashboard.php");
}
?>
