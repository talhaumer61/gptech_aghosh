<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'add' => '1'))){ 
			echo'
			<a href="#make_paper" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
			<i class="fa fa-plus-square"></i> Make Question Paper
			</a>';
		}
		echo '
			<h2 class="panel-title"><i class="fa fa-list"></i> Assessment Question Papers List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Exam Type</th>
						<th>Term</th>
						<th>Session</th>
						<th>Class</th>
						<th>Subject</th>
						<th class="center">Publish</th>
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
													WHERE e.exam_id != '' AND e.is_deleted != '1' AND e.id_type IN(2, 3, 5)
													ORDER BY e.exam_id DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.get_term($rowsvalues['id_term']).'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td>'.$rowsvalues['subject_name'].'</td>
							<td class="center" width="50">'.get_notification($rowsvalues['exam_status']).'</td>
							<td class="center" width="130">
								<a href="uploads/question_papers/'.$rowsvalues['exam_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['type_name'].'-'.get_term($rowsvalues['id_term']).'-'.$rowsvalues['class_name'].'-'.$rowsvalues['subject_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
								<a href="uploads/question_papers/'.$rowsvalues['exam_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>';
								
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'edit' => '1'))){ 
									if ($rowsvalues['exam_status'] != 1) {
										echo'
										<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_paper/update.php?id='.$rowsvalues['exam_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
									}
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'delete' => '1'))){ 
								echo'
									<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'exam_paper.php?deleteid='.$rowsvalues['exam_id'].'\');"><i class="el el-trash"></i></a>';
								}
								echo'
							</td>
						</tr>';
					}
					echo '
				</tbody>
			</table>
		</div>
	</section>';
} else{
	header("Location: dashboard.php");
}
?>