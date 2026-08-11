<?php 
echo '
<div id="leave" class="tab-pane">
	<form action="#" class="form-horizontal validate" method="post" accept-charset="utf-8">
		<fieldset class="mt-lg">
				  <div class="col-md-12">
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
							echo'
		</fieldset>
	</form>
</div>';
?>