<?php 	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){ 
	if (empty(LMS_VIEW) && empty($_GET['edit_id']))
	{
//============================================================================
		$sqllms	= $dblms->querylms("
										SELECT 
											  GROUP_CONCAT(D.reg_id) idCommaDemand
											, D.reg_status
											, D.id_session
											, D.id_class
											, D.id_campus
											, D.is_publish
											, D.date_added
											, D.id_type
											, GROUP_CONCAT(CS.class_name) commaClass
											, GROUP_CONCAT(D.id_class) commaIdClass
											, S.session_name
											, et.type_name
										FROM 
											".EXAM_REGISTRATION." D
											INNER JOIN ".CLASSES." CS ON CS.class_id = D.id_class
											INNER JOIN ".SESSIONS." S ON S.session_id = D.id_session
											INNER JOIN ".EXAM_TYPES." et ON et.type_id = D.id_type
										WHERE 
												D.is_deleted 		= '0'
											AND 
												CS.is_deleted 		= '0'
											AND 
												et.is_deleted 		= '0'
											AND 
												S.session_status 	= '1'
											AND 
												D.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
											AND 
												D.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										GROUP BY D.id_type, S.session_id
										ORDER BY reg_id DESC
									");
//============================================================================
echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			'.(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)? '
				<a href="?view=add" class="btn btn-primary btn-xs pull-right">
					<i class="fa fa-plus-square"></i> Make Exam Registration
				</a>
			': '').'
			<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Registration List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th width="10px;" class="center">Sr#</th>
						<th width="80px;" class="center">Session</th>
						<th width="350px;">Exam Term</th>
						<th >Class</th>
						<th width="50px;" class="center">Students</th>
						<th width="70px;" class="center">Publish</th>
						<th width="70px;" class="center">Status</th>
						<th width="70px;" class="center">Payment</th>
						<th width="70px;" class="center">Option</th>
					</tr>
				</thead>
				<tbody>
';
					
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)):
						
						$srno++;
						$sqllmsCountStd	= $dblms->querylms("
																SELECT edd.id_std
																FROM ".EXAM_REGISTRATION." ed
																INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON ed.reg_id = edd.id_reg
																WHERE ed.id_session 	= '".cleanvars($rowsvalues['id_session'])."'
																AND ed.id_campus		= '".cleanvars($rowsvalues['id_campus'])."'
																AND ed.id_type 			= '".cleanvars($rowsvalues['id_type'])."'
																AND ed.is_deleted 		= '0'
															");
echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td class="center"><b>'.$rowsvalues['session_name'].'</b></td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>
';
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
							';
							$sqllmsChallanCheck	= $dblms->querylms("
																	SELECT f.status, f.challan_no
																	FROM ".EXAM_FEE_CHALLANS." f
																	WHERE f.id_session 	= '".cleanvars($rowsvalues['id_session'])."'
																	AND f.id_campus		= '".cleanvars($rowsvalues['id_campus'])."'
																	AND f.id_examtype 	= '".cleanvars($rowsvalues['id_type'])."'
																	AND f.is_deleted 		= '0'
																");
							$valChallan = mysqli_fetch_array($sqllmsChallanCheck);
							echo '
							<td class="center">'.get_payments($valChallan['status']).'</td>
							<td class="center">
							'.(($rowsvalues['is_publish'] == 0)? '
								<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs pull-right" onclick="showAjaxModalZoom(\'include/modals/exam_registration/publish_it.php?id_session='.$rowsvalues['id_session'].'&id_type='.$rowsvalues['id_type'].'\');"> Publish </a>
								
							': '').'
							'.((!empty($valChallan['status']) && $valChallan['status'] == 2 || $valChallan['status'] == 1)? '
								<a class="btn btn-success btn-xs" class="center" href="examRegistrationChallanPrint.php?id='.$valChallan['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>
							': '').'
							</td>
						</tr>
';
					endwhile;
echo '
				</tbody>
			</table>
		</div>
	</section>
';
	}
}
else{
	header("Location: dashboard.php");
}

?>