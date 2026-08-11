<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i> Assessment Question Papers List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Exam Type</th>
						<th>Term</th>
						<th>Class</th>
						<th>Subject</th>
						<th width="100" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT e.exam_id, e.exam_status, e.exam_file, e.id_term,
													t.type_name, c.class_name, cs.subject_name, se.session_name
													FROM ".EXAMS." e 
													INNER JOIN ".EXAM_TYPES." t ON t.type_id = e.id_type
													INNER JOIN ".CLASSES." c ON c.class_id = e.id_class
													INNER JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = e.id_subject
													INNER JOIN ".SESSIONS." se ON se.session_id = e.id_session
													WHERE e.exam_id != '' 
													AND exam_status = '1' 
													AND e.is_deleted != '1'
													AND e.id_type IN(2, 3, 5) 
													AND id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
													ORDER BY e.exam_id DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.get_term($rowsvalues['id_term']).'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td>'.$rowsvalues['subject_name'].'</td>
							<td class="center" width="100px;">
								<a href="uploads/question_papers/'.$rowsvalues['exam_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['type_name'].'-'.get_term($rowsvalues['id_term']).'-'.$rowsvalues['class_name'].'-'.$rowsvalues['subject_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
								<a href="uploads/question_papers/'.$rowsvalues['exam_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>
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