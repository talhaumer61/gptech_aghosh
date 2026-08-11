<?php
  //---------------------------------------------------------
	  include "../../dbsetting/lms_vars_config.php";
	  include "../../dbsetting/classdbconection.php";
	  $dblms = new dblms();
	  include "../../functions/login_func.php";
	  include "../../functions/functions.php";
	  checkCpanelLMSALogin();
//-----------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'view' => '1'))){ 
//-----------------------------------------------------
$sqllmspro	= $dblms->querylms("SELECT l.id, l.id_emply, l.reason, l.applied_date, l.id_cat, l.id_session,
								   l.from_date, l.to_date, l.approved_by, l.remarks, l.status,
								   c.cat_name,
								   e.emply_name, emply_regno,
								   s.session_name,
								   d.designation_name
								   FROM ".LEAVE." l
								   
								   INNER JOIN ".LEAVE_CATEGORY." c ON c.cat_id = l.id_cat
								   INNER JOIN ".EMPLOYEES." e ON e.emply_id = l.id_emply
								   INNER JOIN ".SESSIONS." s ON s.session_id = l.id_session
								   INNER JOIN ".DESIGNATIONS." d ON d.designation_id = l.approved_by
								   WHERE l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								  AND 	 l.id = '".cleanvars($_GET['id'])."' LIMIT 1");

//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllmspro);
//-----------------------------------------------------
  echo'
  <div class="mfp-wrap mfp-auto-cursor my-mfp-zoom-in mfp-ready" tabindex="-1" style="top: 0px; position: absolute; height: 568px; width: 750px; margin-top: -900px;">
  <div class="mfp-container mfp-inline-holder">
  <div class="mfp-content">
  <div id="show_modal" class="zoom-anim-dialog modal-block modal-block-lg">
	  <section class="panel panel-featured panel-featured-primary">
		  <form action="#" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
		  <input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		  <header class="panel-heading">
			  <h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Leaves information of <b>'.$rowsvalues['emply_name'].' </b></h2>
		  </header>
		  <div class="panel-body">
			  <div class="row mt-md">';
//-----------------------------------------------------
			  //while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
				echo'
				  <div class="col-md-6">
					  <section class="panel mb-lg" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
						  <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
							  <h2 class="panel-title">Leave Statistics</h2>
						  </header>';
						  
						  echo '
						  <div class="panel-body">';
						  
						  
						  $sqllmsleave = $dblms->querylms("SELECT lc.cat_id, lc.cat_name, COUNT(l.id_cat) AS total
																		
													FROM ".LEAVE." l
	 												INNER JOIN ".LEAVE_CATEGORY." lc ON lc.cat_id = l.id_cat
													WHERE l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND l.id = '".cleanvars($_GET['id'])."'
													AND l.id_cat = lc.cat_id LIMIT 1");
								$value_leave = mysqli_fetch_array($sqllmsleave);
								//-----------------------------------------------------
								//$leave_count = $leave_count + 1;
								//-----------------------------------------------------
							echo '
							<option value="'.$value_leave['cat_id'].'">
								'.$value_leave['cat_name'].' ('.$value_leave['total'].')
							</option>
							';
						  
						  
													  
						  //------------------Leave Names-----------------------------------
							$sqllms	= $dblms->querylms("SELECT l.cat_id, l.cat_status, l.cat_name, l.cat_days, l.id_campus
								   FROM ".LEAVE_CATEGORY." l
								   
								   WHERE l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY l.cat_name ASC");
							//-----------------------------------------------------
							while($leavenames = mysqli_fetch_array($sqllms)) {
							//------------------------------Days coun start-----------------------
							$sqllmsleave = $dblms->querylms("SELECT lc.cat_id, lc.cat_name, COUNT(l.id_cat) AS total
																		
													FROM ".LEAVE." l
	 												INNER JOIN ".LEAVE_CATEGORY." lc ON lc.cat_id = l.id_cat
													WHERE l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND l.id = '".cleanvars($_GET['id'])."'
													AND l.id_cat = lc.cat_id");
								$value_leave = mysqli_fetch_array($sqllmsleave);
								
							//-------------------------------days count end----------------------
							echo'
								<b>'.$leavenames['cat_name'].' ('.$value_leave['total'].'/'.$leavenames['cat_days'].')</b> <br>
								<div class="progress progress-lg progress-squared light prog-pvs" style="margin-top: 2px; margin-bottom: 8px;">
								  <div class="progress-bar" role="progressbar" aria-valuenow="9" aria-valuemin="0" aria-valuemax="15" style="width: 60.0%;">
									  60.0 %
								  </div>
							  </div>
							';
							//-----------------------------------------------------
							}
	
						  
							
							//-----------------------static------------------------------						  
						  $a= (40/100)*100;
						  echo'
						  
							<label class="control-label">Sample (0/10)</label>    
							  <div class="progress progress-lg progress-squared light prog-pvs" style="margin-top: 2px; margin-bottom: 8px;">
								  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="10" style="width: 40%;">
									 '; 
									 echo $a; 
									 echo' %
								  </div>
							  </div>
							  <label class="control-label">Sample 2 (9/15)</label>    
							  <div class="progress progress-lg progress-squared light prog-pvs" style="margin-top: 2px; margin-bottom: 8px;">
								  <div class="progress-bar" role="progressbar" aria-valuenow="9" aria-valuemin="0" aria-valuemax="15" style="width: 60.0%;">
									  60.0 %
								  </div>
							  </div>
														  <label class="control-label">Sample 3 (0/20)</label>    
							  <div class="progress progress-lg progress-squared light prog-pvs" style="margin-top: 2px; margin-bottom: 8px;">
								  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="20" style="width: 20.0%;">
									  20.0 %
								  </div>
							  </div>
							</div>
					  </section>
				  </div>';
			 // }
			  echo'
				  <div class="col-md-6">
					  <section class="panel mb-lg" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
						  <div class="panel-body">
							  <div class="table-responsive mt-sm">
								  <table class="table">
										  <tbody>
											  <tr>
											  <th> Name : </th>
											  <td>'.$rowsvalues['emply_name'].'</td>
										  </tr>
										  <tr>
											  <th> Reg. No : </th>
											  <td>'.$rowsvalues['emply_regno'].'</td>
										  </tr>
										  <tr>
											  <th> Leave Type : </th>
											  <td>'.$rowsvalues['cat_name'].'</td>
										  </tr>
										  <tr>
											  <th> Applied On : </th>
											  <td>'.$rowsvalues['applied_date'].'</td>
										  </tr>
										  <tr>
											  <th> Start Date : </th>
											  <td>'.$rowsvalues['from_date'].'</td>
										  </tr>
										  <tr>
											  <th> End Date : </th>
											  <td>'.$rowsvalues['to_date'].'</td>
										  </tr>
										  <tr>
											  <th> Reason : </th>
											  <td>'.$rowsvalues['reason'].'</td>
										  </tr>
										  <tr>
											  <th colspan="2" class="center">
												  <select name="status" class="form-control populate" required data-plugin-selecttwo="" data-width="100%" data-minimum-results-for-search="Infinity" aria-required="true" tabindex="-1" aria-hidden="true">
  													<option value="">Select</option>
													<option value="1">Pending</option>
  													<option value="2">Approved</option>
 													<option value="3">Reject</option>
  												  </select>
											  </th>
										  </tr>
									  </tbody>
								  </table>
							  </div>
						  </div>
					  </section>
				  </div>
			  </div>
		  </div>
		  
		  
		  
		  
		  <footer class="panel-footer">
			  <div class="row">
				  <div class="col-md-12 text-right">
					 <button type="submit" class="btn btn-primary">Update</button>
					  <button class="btn btn-default modal-dismiss">
						  Close					</button>
				  </div>
			  </div>
		  </footer>
		  </form>
	  </section>
  </div></div></div></div>
  ';
}
  ?>