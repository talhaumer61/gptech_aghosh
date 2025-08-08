<?php
 
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<a href="?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Add Exam Marks</a>
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
				$sqllms	= $dblms->querylms("SELECT m.id, m.status, t.type_name, c.class_name, s.section_name, sb.subject_name
												FROM ".EXAM_MARKS." m
												INNER JOIN ".EXAM_TYPES." 	  t  ON t.type_id    = m.id_exam 
												INNER JOIN ".CLASSES." 		  c  ON c.class_id   = m.id_class 
												INNER JOIN ".CLASS_SECTIONS." s  ON s.section_id = m.id_section 
												INNER JOIN ".CLASS_SUBJECTS." sb ON sb.subject_id= m.id_subject 
												WHERE m.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
												AND m.is_deleted != '1' ORDER BY m.id ASC");
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
						<td class="center">'.get_status($rowsvalues['status']).'</td>
						<td class="center">
							<a href="exam_marks.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>';
				}
				echo '
			</tbody>
		</table>
	</div>
</section>';
?>