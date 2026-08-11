<?php 	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){ 
	if (empty(LMS_VIEW) && empty($_GET['edit_id'])){		
		$sql1 			= "AND D.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'";
		$sql2 			= '';
		$sql3 			= '';
		$id_session 	= "";
		$id_campus 		= "";
		$id_type 		= "";

		// SESSION
		$sqllmsSession	= $dblms->querylms("SELECT s.session_id, s.session_name
												FROM ".SESSIONS." s
												WHERE s.is_deleted	= '0' 
												ORDER BY s.session_name DESC
											");
		// CAMPUS
		$sqllmsCampus	= $dblms->querylms("SELECT c.campus_id , c.campus_name
												FROM ".CAMPUS." c
												WHERE c.is_deleted	= '0' 
												ORDER BY c.campus_name ASC
											");
		// EXAM TYPES
		$sqllmsExamType	= $dblms->querylms("SELECT t.type_id, t.type_name
												FROM ".EXAM_TYPES." t
												WHERE  t.is_deleted	= '0' 
												ORDER BY t.type_name ASC
											");
		// FILTERS
		if (isset($_POST['search_registration'])):
			if (!empty($_POST['id_session'])):
				$sql1 			= "AND D.id_session = '".cleanvars($_POST['id_session'])."'";
				$id_session 	= cleanvars($_POST['id_session']);
			endif;
			if (!empty($_POST['id_campus'])):
				$sql2 			= "AND D.id_campus = '".cleanvars($_POST['id_campus'])."'";
				$id_campus 		= cleanvars($_POST['id_campus']);
			endif;
			if (!empty($_POST['id_type'])):
				$sql3 			= "AND D.id_type = '".cleanvars($_POST['id_type'])."'";
				$id_type 		= cleanvars($_POST['id_type']);
			endif;
		endif;

		$sqllms	= $dblms->querylms("SELECT GROUP_CONCAT(D.reg_id) idCommaDemand, D.reg_status, D.id_session, D.id_campus, D.id_class, D.is_publish, D.date_added, D.id_type, GROUP_CONCAT(CS.class_name) commaClass, GROUP_CONCAT(D.id_class) commaIdClass, S.session_name, et.type_name, c.campus_name
										FROM ".EXAM_REGISTRATION." D
										INNER JOIN ".CLASSES." CS ON CS.class_id = D.id_class
										INNER JOIN ".SESSIONS." S ON S.session_id = D.id_session
										INNER JOIN ".EXAM_TYPES." et ON et.type_id = D.id_type
										INNER JOIN ".CAMPUS." c ON c.campus_id = D.id_campus
										WHERE D.is_publish 		= '1'
										AND D.is_deleted 		= '0'
										AND CS.is_deleted 		= '0'
										AND et.is_deleted 		= '0'
										AND S.session_status 	= '1'
										".$sql1."
										".$sql2."
										".$sql3."
										GROUP BY D.id_type, S.session_id, D.id_campus
										ORDER BY reg_id DESC
									");
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Search Registration\'s </h2>
		</header>
		<div class="panel-body">
			<form action="exam_registration.php" method="POST">
				<div class="row mt-sm">
					<div class="col-md-4">
						<label class="control-label">Session</label>
						<select data-plugin-selectTwo data-width="100%" name="id_session" id="id_class" class="form-control populate">
							<option value="">Select</option>';
							while($val = mysqli_fetch_array($sqllmsSession)):
								echo'<option value="'.$val['session_id'].'" '.(($val['session_id'] == $id_session) ? 'selected': '').'>'.$val['session_name'].'</option>';
							endwhile;
							echo'
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label">Campus</label>
						<select data-plugin-selectTwo data-width="100%" name="id_campus" id="id_class" class="form-control populate">
							<option value="">Select</option>';
							
							while($val = mysqli_fetch_array($sqllmsCampus)):
								echo'<option value="'.$val['campus_id'].'" '.(($val['campus_id'] == $id_campus) ? 'selected': '').'>'.$val['campus_name'].'</option>';
							endwhile;
							echo '
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label">Exam Term </label>
						<select data-plugin-selectTwo data-width="100%" name="id_type" id="id_class" class="form-control populate">
							<option value="">Select</option>';
							
							while($val = mysqli_fetch_array($sqllmsExamType)):
								echo'<option value="'.$val['type_id'].'" '.(($val['type_id'] == $id_type) ? 'selected': '').'>'.$val['type_name'].'</option>';
							endwhile;
							echo'
						</select>
					</div>
					<div class="col-md-12">
						<center style="padding-top: 2rem;">
							<input type="submit" name="search_registration" class="btn btn-primary" value="Search">
						</center>
					</div>
				</div>
			</form>
		</div>
	</section>

	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Registration\'s List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th width="10" class="center">Sr.</th>
						<th width="80" class="center">Session</th>
						<th width="80" class="center">Campus</th>
						<th width="350">Exam Term</th>
						<th >Class</th>
						<th width="50" class="center">Students</th>
						<th width="70" class="center">Publish</th>
						<th width="70" class="center">Status</th>
						<th width="90" class="center">Option</th>
					</tr>
				</thead>
				<tbody>';
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)):						
						$srno++;
						$sqllmsCountStd	= $dblms->querylms("SELECT edd.id_std
															FROM ".EXAM_REGISTRATION." ed
															INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON ED.reg_id = edd.id_reg
															WHERE ed.id_session 		= ".cleanvars($rowsvalues['id_session'])."
															AND ed.id_campus		= '".cleanvars($rowsvalues['id_campus'])."'
															AND ed.id_type 			= ".cleanvars($rowsvalues['id_type'])."
															AND ed.is_deleted 		= '0'");
						echo'
						<tr>
							<td class="center">'.$srno.'</td>
							<td class="center"><b>'.$rowsvalues['session_name'].'</b></td>
							<td class="center"><b>'.$rowsvalues['campus_name'].'</b></td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>';
								$idCommaDemand = explode(',', $rowsvalues['idCommaDemand']);
								$class_ids = explode(',', $rowsvalues['commaIdClass']);
								$class_names = explode(',', $rowsvalues['commaClass']);

								foreach($idCommaDemand as $key => $val):
									echo '<a href="#show_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoom(\'include/modals/exam_registration/view.php?demand_id='.$val.'&id_class='.$class_ids[$key].'&id_type='.$rowsvalues['id_type'].'\');">['.$class_names[$key].'] </a>';
								endforeach;
								echo '
							</td>
							<td class="center">'.mysqli_num_rows($sqllmsCountStd).'</td>
							<td class="center">'.get_publish($rowsvalues['is_publish']).'</td>
							<td class="center">'.get_status($rowsvalues['reg_status']).'</td>
							<td class="center">
								'.(($rowsvalues['is_publish'] == 0)? '
									<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs pull-right" onclick="showAjaxModalZoom(\'include/modals/exam_registration/publish_it.php?id_session='.$rowsvalues['id_session'].'&id_type='.$rowsvalues['id_type'].'\');"> Publish </a>
								': '').'
								';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))):
									echo '<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs pull-right" onclick="showAjaxModalZoom(\'include/modals/exam_registration/publish_it.php?id_session='.$rowsvalues['id_session'].'&id_type='.$rowsvalues['id_type'].'&id_campus='.$rowsvalues['id_campus'].'\');"> Un Publish </a>';
								endif;
								echo '
							</td>
						</tr>';
					endwhile;
					echo '
				</tbody>
			</table>
		</div>
	</section>';
	}
}else{
	header("Location: dashboard.php");
}
?>