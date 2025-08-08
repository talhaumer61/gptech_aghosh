<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'add' => '1'))){ 
    if(isset($_POST['id_from_session'])){$id_from_session = $_POST['id_from_session'];}else{$id_from_session = '';}
    if(isset($_POST['id_to_session'])){$id_to_session = $_POST['id_to_session'];}else{$id_to_session = '';}
    echo'
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Select </h2>
		</header>
		<form action="feesetup.php?view=copy" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-body">
				<div class="row mb-lg">
					<div class="col-md-6">
						<label class="control-label"> From Session <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_from_session" name="id_from_session">
							<option value="">Select</option>';
							$sqllms	= $dblms->querylms("SELECT s.session_id, s.session_name 
															FROM ".FEESETUP." f
															INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
															WHERE f.id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
															AND f.status        = '1' 
															AND f.is_deleted    = '0'
															GROUP BY f.id_session
															ORDER BY s.session_name DESC
														");
							while($value = mysqli_fetch_array($sqllms)) {
								echo '<option value="'.$value['session_id'].'" '.($id_from_session == $value['session_id'] ? 'selected' : '').'>'.$value['session_name'].'</option>';
							}
						echo '
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label"> To Session <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_to_session" name="id_to_session">
							<option value="">Select</option>';
							$sqllms	= $dblms->querylms("SELECT session_id, session_name 
															FROM ".SESSIONS."
															WHERE session_id   != ''
															AND is_deleted      = '0'
															ORDER BY session_id DESC");
							while($value = mysqli_fetch_array($sqllms)) {
								echo '<option value="'.$value['session_id'].'" '.($id_to_session == $value['session_id'] ? 'selected' : '').'>'.$value['session_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<center>
					<button type="submit" name="show_result" id="show_result" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
				</center>
			</div>
		</form>
	</section>';

	if(isset($_POST['show_result'])){
		$sqlFeeSetup = $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
											c.class_name, s.session_name
											FROM ".FEESETUP." f				   
											INNER JOIN ".CLASSES." c ON c.class_id = f.id_class					 
											INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
											WHERE f.is_deleted  = '0'
											AND f.id_campus     = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
											AND f.id_session    = '".cleanvars($id_from_session)."'
											AND NOT EXISTS (
												SELECT 1 
												FROM ".FEESETUP." f2
												WHERE f2.id_class   = f.id_class 
												AND f2.id_session   = '".cleanvars($id_to_session)."'
												AND f2.is_deleted   = '0'
											)
											ORDER BY f.dated ASC
										");										
		if(mysqli_num_rows($sqlFeeSetup) > 0){
			echo'
			<section class="panel panel-featured panel-featured-primary">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-list"></i> Fee Structure List</h2>
				</header>
				<form action="feesetup.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<div class="panel-body">
						<div id="printResult">
							<table class="table table-bordered table-striped table-condensed mb-none">
								<thead>
									<tr>
										<th width="40" class="center"><input type="checkbox" id="main-checkbox"/></th>
										<th width="40" class="center">Sr.</th>
										<th>Dated</th>
										<th>Session</th>
										<th>Class</th>
									</tr>
								</thead>
								<tbody>';
									$sr = 0;
									while($valFeeSetup = mysqli_fetch_array($sqlFeeSetup)) {
										$sr++;
										echo'
										<tr>
											<td class="center">
												<input type="checkbox" class="sub-checkbox" id="sub-checkbox-'.$sr.'" name="sub-checkbox['.$sr.']" value="1" />
												<input type="hidden" id="id" name="id['.$sr.']" value="'.$valFeeSetup['id'].'"/>
											</td>
											<td class="center">'.$sr.'</td>
											<td>'.$valFeeSetup['dated'].'</td>
											<td>'.$valFeeSetup['session_name'].'</td>
											<td>'.$valFeeSetup['class_name'].'</td>
										</tr>';
									}
									echo'
									<input type="hidden" id="id_from_session" name="id_from_session" value="'.$id_from_session.'"/>
									<input type="hidden" id="id_to_session" name="id_to_session" value="'.$id_to_session.'"/>
								</tbody>
							</table>
						</div>
					</div>
					<footer class="panel-footer center">
						<button type="submit" name="copy_feesetup" id="copy_feesetup" class="btn btn-primary"><i class="fa fa-file"></i> Copy Fee Structure</button>
					</footer>
				</form>
			</section>';
		}else{
			echo'
			<section class="panel panel-featured panel-featured-primary">
				<div class="panel-body">
					<h2 class="center">No Record Found</h2>
				</div>
			</section>';
		}
	}
}else{
	header("Location: dashboard.php");
}
?>