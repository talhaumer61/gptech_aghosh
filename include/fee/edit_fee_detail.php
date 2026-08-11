<?php
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'updated' => '1'))){   
//-----------------------------------------------------
$sqllmsfeesetup	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
								   c.class_name, cs.section_name, s.session_name
								   FROM ".FEESETUP." f						   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session	
								   WHERE f.id = '".cleanvars($_GET['id'])."' AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY f.dated ASC");
$value_setup = mysqli_fetch_array($sqllmsfeesetup);
//-----------------------------------------------------
    echo '
	  <section class="panel">
	  
			  <form action="feesetup.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
                  <input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">    
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
								echo '<option value="'.$valuecls['session_id'].'"'; if($valuecls['session_id'] == $value_setup['id_session']){ echo' selected';}echo'>'.$valuecls['session_name'].'</option>';
								}
							echo '
							</select>
						</div>
					  </div>
					  <div class="form-group mt-sm">
						  <label class="col-md-2 control-label">Dated <span class="required">*</span></label>
						  <div class="col-md-9">
							  <input type="text" class="form-control" name="dated" id="dated" value="'.$value_setup['dated'].'"autocomplete="off" data-plugin-datepicker required title="Must Be Required"/>
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
								echo '<option value="'.$valuecls['class_id'].'"'; if($valuecls['class_id'] == $value_setup['id_class']){ echo' selected';}echo'>'.$valuecls['class_name'].'</option>';
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
								echo '<option value="'.$valuecls['section_id'].'"'; if($valuecls['section_id'] == $value_setup['id_session']){ echo' selected';}echo'>'.$valuecls['section_name'].'</option>';
								}
							echo '
							</select>
						</div>
					  </div>
					  <div class="form-group">
						  <label class="col-sm-2 control-label">Status <span class="required">*</span></label>
						  <div class="col-md-9">
							  <div class="radio-custom radio-inline">
								  <input type="radio" id="status" name="status" value="1"'; if($value_setup['status'] == 1){ echo' checked';}echo'>
								  <label for="radioExample1">Active</label>
							  </div>
							  <div class="radio-custom radio-inline">
								  <input type="radio" id="status" name="status" value="2" '; if($value_setup['status'] == 2){ echo' checked';}echo'>
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
$sqllmsfeedetail	= $dblms->querylms("SELECT c.cat_id, c.cat_name, fsd.id, fsd.duration, fsd.amount, fsd.type
                                FROM ".FEE_CATEGORY." c
                                INNER JOIN ".FEESETUPDETAIL." fsd ON fsd.id_cat = c.cat_id 													 
                                WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
                                AND fsd.id_setup = '".cleanvars($_GET['id'])."' AND fsd.id_cat = '".$rowsvalues['cat_id']."'
                                LIMIT 1");
$value_detail = mysqli_fetch_array($sqllmsfeedetail);
//-----------------------------------------------------
  echo '
  <input type="hidden" name="id_cat['.$srno.']" id="id_cat['.$srno.']" value="'.$rowsvalues['cat_id'].'">
  <input type="hidden" name="id_edit['.$srno.']" id="id_edit['.$srno.']" value="'.$value_detail['id'].'">
							  <tr>
								  <td >'.$rowsvalues['cat_name'].'</td>
								 <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <select class="form-control" name="duration['.$srno.']" id="duration['.$srno.']" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
											  	<option vlaue="Yearly"'; if($value_detail['duration'] == 'Yearly'){echo' selected';} echo'>Yearly</option>
											  	<option vlaue="Half"'; if($value_detail['duration'] == 'Half'){echo' selected';} echo'>Half</option>
											  	<option vlaue="Quatar"'; if($value_detail['duration'] == 'Quatar'){echo' selected';} echo'>Quatar</option>
											  	<option vlaue="Monthly"'; if($value_detail['duration'] == 'Monthly'){echo' selected';} echo'>Monthly</option>
											  </select>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <input type="number" class="form-control" name="amount['.$srno.']" id="amount['.$srno.']" value="'.$value_detail['amount'].'" required title="Must Be Required"/>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
											  <select class="form-control" name="type['.$srno.']" id="type['.$srno.']" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
											  	<option vlaue="Refundable"'; if($value_detail['type'] == 'Refundable'){echo' selected';} echo'>Refundable</option>
											  	<option vlaue="Non-Refundable"'; if($value_detail['type'] == 'Non-Refundable'){echo' selected';} echo'>Non-Refundable</option>
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
					  
				  </div>';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'updated' => '1'))){   
echo '	  
				  <footer class="panel-footer">
					  <div class="row">
						  <div class="col-md-12 text-right">
							  <button type="submit" class="btn btn-primary" id="changes_feesetup" name="changes_feesetup">Save</button>
							  <button class="btn btn-default modal-dismiss">Cancel</button>
						  </div>
					  </div>
				  </footer>';
}
echo '
		  		</div>
			</form>
	  </section>';
}
else{
	header("Location: dashboard.php");
}
?>
