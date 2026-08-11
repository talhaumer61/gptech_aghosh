<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Assessment Schemes List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center" width="70">#</th>
						<th>Session</th>
						<th>Exam</th>
						<th>Class</th>
						<th>Note</th>
						<th width="100" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT s.id , s.status, s.id_type, s.id_exam, s.file, s.id_class, s.note, s.id_session,
													e.type_name, se.session_name, c.class_name
													FROM ".EXAM_DOWNLOADS." s 
													INNER JOIN ".EXAM_TYPES." e ON e.type_id = s.id_exam
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
													INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
													WHERE s.id  != '' AND s.is_deleted != '1' AND s.id_type = '3' AND s.status = 1
													AND s.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
													ORDER BY s.id DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
					$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td>'.$rowsvalues['note'].'</td>
							<td width="100" class="center">
								<a href="uploads/assessment_downloads/'.$rowsvalues['file'].'" download="'.$rowsvalues['session_name'].'-'.get_assessment($rowsvalues['id_type']).'-'.$rowsvalues['type_name'].'-'.$rowsvalues['class_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
								<a href="uploads/assessment_downloads/'.$rowsvalues['file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>
							</td>
						</tr>';
					}
					echo '
				</tbody>
			</table>
		</div>
	</section>';
} else {
	header("Location: dashboard.php");
}
?>