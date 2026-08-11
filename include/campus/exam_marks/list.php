<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '14', 'view' => '1'))){
 
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '14', 'add' => '1'))){
			echo'<a href="?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Add Exam Marks</a>';
		}
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i> Exam Mark Sheet List</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
			<thead>
				<tr>
					<th style="text-align:center">No.</th>
					<th>Subject</th>
					<th>Class</th>
					<th>Exam Type</th>
					<th width="70px;" style="text-align:center;">Status</th>
					<th width="100" style="text-align:center;">Options</th>
				</tr>
			</thead>
			<tbody>';
				//-----------------------------------------------------
				$sqllms	= $dblms->querylms("SELECT m.id, m.status, t.type_name, c.class_name, sb.subject_name
												FROM ".EXAM_MARKS." m
												INNER JOIN ".EXAM_TYPES." 	  t  ON t.type_id    = m.id_exam 
												INNER JOIN ".CLASSES." 		  c  ON c.class_id   = m.id_class 
												INNER JOIN ".CLASS_SUBJECTS." sb ON sb.subject_id= m.id_subject 
												WHERE m.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
												AND m.is_deleted = '0' ORDER BY m.id ASC");
				$srno = 0;
				//-----------------------------------------------------
				while($rowsvalues = mysqli_fetch_array($sqllms)) {
					$srno++;
					echo '
					<tr>
						<td style="width:100px; text-align:center;">'.$srno.'</td>
						<td>'.$rowsvalues['subject_name'].'</td>
						<td>'.$rowsvalues['class_name'].' ('.$rowsvalues['section_name'].')</td>
						<td>'.$rowsvalues['type_name'].'</td>
						<td class="center">'.get_notification($rowsvalues['status']).'</td>
						<td class="center">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '18', 'updated' => '1'))){ 
								// echo'<a href="exam_marks.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs mr-xs"><i class="glyphicon glyphicon-eye-open"></i> </a>';
								echo'<a href="exam_marks.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
							}
							// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '18', 'deleted' => '1'))){ 
							// 	echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'exam_term.php?deleteid='.$rowsvalues['term_id'].'\');"><i class="el el-trash"></i></a>';
							// }
							echo'
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