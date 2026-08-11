<?php 	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){ 
	if (empty(LMS_VIEW) && empty($_GET['edit_id'])){		
		$id_session = (!empty($_POST['id_session']))? $_POST['id_session']: '';
		// SESSION
		$condition = array ( 
								 'select' 	    =>  'session_id, session_name'
								,'where' 	    =>  array( 'is_deleted' => 0 )
								,'order_by'     =>  'session_id DESC'
								,'return_type'  =>  'all' 
							); 
		$SESSIONS    = $dblms->getRows(SESSIONS, $condition);
		// CAMPUSES
		$condition = array ( 
								 'select' 	    =>  'campus_id, campus_name'
								,'where' 	    =>  array( 'is_deleted' => 0 )
								,'order_by'     =>  'campus_id DESC'
								,'return_type'  =>  'all' 
							); 
		$CAMPUS    = $dblms->getRows(CAMPUS, $condition);
		// CLASSES
		$condition = array ( 
								 'select' 	    =>  'class_id, class_name'
								,'where' 	    =>  array( 'is_deleted' => 0 )
								,'order_by'     =>  'class_id DESC'
								,'return_type'  =>  'all' 
							); 
		$CLASSES    = $dblms->getRows(CLASSES, $condition);
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Registration Report </h2>
		</header>
		<div class="panel-body">
			<form action="exam_registration_students_report.php" method="POST">
				<div class="row mt-sm">
					<div class="col-md-6 col-md-offset-3">
						<label class="control-label">Session</label>
						<select data-plugin-selectTwo data-width="100%" name="id_session" id="id_class" class="form-control populate">
							<option value="">Select</option>';
							foreach($SESSIONS as $key => $val):						
								echo'<option value="'.$val['session_id'].'" '.(($val['session_id'] == $id_session) ? 'selected': '').'>'.$val['session_name'].'</option>';
							endforeach;
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
	</section>';
		if (isset($_POST['search_registration'])) {
			echo '
			<section class="panel panel-featured panel-featured-primary">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Registration Report</h2>
				</header>
				<div class="panel-body">
					<table class="table table-bordered ">
						<thead>
							<tr>
								<th width="10" class="center">Sr.</th>
								<th>Campus</th>';
								foreach($CLASSES as $key => $val):						
									echo '
									<th width="100" class="center">'.ucwords(strtolower($val['class_name'])).'</th>';
								endforeach;
								echo '
							</tr>
						</thead>
						<tbody>';
							$srno = 0;
							foreach($CAMPUS as $key => $valC):						
								echo'
								<tr>
									<td class="center">'.++$srno.'</td>
									<td>'.$valC['campus_name'].'</td>';
									foreach($CLASSES as $key => $val):		
										$sqllmsCountStd	= $dblms->querylms("SELECT erd.id_std
																			FROM ".EXAM_REGISTRATION." er
																			LEFT JOIN ".EXAM_REGISTRATION_DETAIL." erd ON er.reg_id = erd.id_reg
																			WHERE er.id_session 	= ".cleanvars($id_session)."
																			AND er.id_campus		= ".cleanvars($valC['campus_id'])."
																			AND er.id_class			= ".cleanvars($val['class_id'])."
																			AND er.is_deleted 		= '0'");		
										echo '
										<th class="center">'.mysqli_num_rows($sqllmsCountStd).'</th>';
									endforeach;
									echo '
								</tr>';
							endforeach;
							echo '
						</tbody>
					</table>
				</div>
			</section>';
		}
	}
}else{
	header("Location: dashboard.php");
}
?>