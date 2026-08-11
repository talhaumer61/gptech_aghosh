<?php 
if($view == 'copy'){ 
	
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'add' => '1'))){ 
    if(isset($_POST['id_from_session'])){$id_from_session = $_POST['id_from_session'];}else{$id_from_session = '';}
    if(isset($_POST['id_to_session'])){$id_to_session = $_POST['id_to_session'];}else{$id_to_session = '';}
    echo'
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Select Session</h2>
		</header>
		<form action="feeconcession.php?view=copy" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-body">
				<div class="row mb-lg">
					<div class="col-md-6">
						<label class="control-label"> From Session <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_from_session" name="id_from_session">
							<option value="">Select</option>';
							$sqllms	= $dblms->querylms("SELECT s.session_id, s.session_name 
															FROM ".SCHOLARSHIP." f
															INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
															WHERE f.id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
															AND f.status        = '1' 
															AND f.is_deleted    = '0'
															GROUP BY f.id_session
															ORDER BY s.session_name DESC
														");
							while($value = mysqli_fetch_array($sqllms)) {
								echo'<option value="'.$value['session_id'].'" '.($id_from_session == $value['session_id'] ? 'selected' : '').'>'.$value['session_name'].'</option>';
							}
							echo'
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
								echo'<option value="'.$value['session_id'].'" '.($id_to_session == $value['session_id'] ? 'selected' : '').'>'.$value['session_name'].'</option>';
							}
							echo'
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
		$sqlConcession = $dblms->querylms("SELECT s.id, s.status, s.consession_on, s.percent, s.amount, s.note,
											c.cat_id, c.cat_name, c.cat_type,
											st.std_id, st.std_name, st.std_fathername, st.std_regno, st.id_class as std_class,
											cl.class_name
											FROM ".SCHOLARSHIP." s
											INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std
											INNER JOIN ".SCHOLARSHIP_CAT." c ON c.cat_id = s.id_cat
											LEFT  JOIN ".CLASSES."  cl ON cl.class_id 	= s.id_class
											WHERE s.id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
											AND s.id_session    = '".cleanvars($id_from_session)."'
											AND s.is_deleted	= '0'
											AND s.id_type		= '2'
											AND c.cat_type		= '2'
											AND NOT EXISTS (
												SELECT 1 
												FROM ".SCHOLARSHIP." s2
												WHERE s2.id_std		= s.id_std 
												AND s.id_type		= '2'
												AND c.cat_type		= '2'
												AND s2.id_session   = '".cleanvars($id_to_session)."'
												AND s2.is_deleted   = '0'
											)
											ORDER BY s.id_class ASC");
		if(mysqli_num_rows($sqlConcession) > 0){
			echo'
			<section class="panel panel-featured panel-featured-primary">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-list"></i> Fee Concession List</h2>
				</header>
				<form action="feeconcession.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<div class="panel-body">
						<div id="printResult">
							<table class="table table-bordered table-striped table-condensed mb-none">
								<thead>
									<tr>
										<th width="40" class="center"><input type="checkbox" id="main-checkbox"/></th>
										<th width="40" class="center">Sr.</th>
										<th>Student Regno.</th>
										<th>Student</th>
										<th>From Class </th>
										<th>To Class </th>
									</tr>
								</thead>
								<tbody>';
									while($valConcession = mysqli_fetch_array($sqlConcession)) {
										$sr++;
										echo'
										<tr>
											<td class="center">
												<input type="checkbox" class="sub-checkbox" id="sub-checkbox-'.$sr.'" name="sub-checkbox['.$sr.']" value="1" />
												<input type="hidden" id="id" name="id['.$sr.']" value="'.$valConcession['id'].'"/>
											</td>
											<td width="40" class="center">'.$sr.'</td>
											<td>'.$valConcession['std_regno'].'</td>
											<td>'.$valConcession['std_name'].' '.$valConcession['std_fathername'].'</td>
											<td>'.$valConcession['class_name'].'</td>
											<td>
												<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_to_class" name="id_to_class['.$sr.']">
													<option value="">Select</option>';
													$sqllms	= $dblms->querylms("SELECT class_id, class_name 
																				FROM ".CLASSES."
																				WHERE is_deleted	= '0'
																				AND class_status	= '1'
																				ORDER BY class_id DESC");
													while($value = mysqli_fetch_array($sqllms)) {
														echo'<option value="'.$value['class_id'].'" '.($valConcession['std_class'] == $value['class_id'] ? 'selected' : '').'>'.$value['class_name'].'</option>';
													}
													echo'
												</select>
											</td>
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
						<button type="submit" name="copy_feeconcession" id="copy_feeconcession" class="btn btn-primary"><i class="fa fa-file"></i> Copy Fee Concession</button>
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
}
