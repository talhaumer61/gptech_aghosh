<?php
// Details

$sqllms_std	= $dblms->querylms("SELECT std_id, id_class, id_section
								   FROM ".STUDENTS." 
								   WHERE id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
								   AND   id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$values_std = mysqli_fetch_array($sqllms_std);	

echo'
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
		Students Progress Report </h2>
	</header>
	<div class="panel-body">
		<div class="table-responsive mt-sm mb-md">
			<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
				<thead>
					<tr>
						<th class="center" width:"40">#</th>
						<th>
							Students <i class="fa fa-hand-o-down"></i> |
							Subjects <i class="fa fa-hand-o-right"></i>
						</th>';
						//-----------------------------------------
						$sqllmsSub	= $dblms->querylms("SELECT subject_id, subject_name, subject_totalmarks, subject_passmarks
															FROM ".CLASS_SUBJECTS."
															WHERE id_class = '".$values_std['id_class']."' AND subject_status = '1' AND is_deleted != '1' ");
						//-----------------------------------------------------
						$subjectarray = array();
						while($rowSub = mysqli_fetch_array($sqllmsSub)){ 
							$subjectarray[] = $rowSub;
							echo'<th>'.$rowSub['subject_name'].'</th>';
						}
						echo'
						<th>Total Marks</th>
						<th>Obtained Marks</th>	
						<th>Percentage</th>
						<!-- <th>Status </th>
						<th width="40">Options </th> -->
					</tr>
				</thead>
				<tbody>';	
					// Students 
					$sqllmsExm = $dblms->querylms("SELECT type_id, type_name
														FROM ".EXAM_TYPES."
														WHERE type_status = '1' AND is_deleted != '1' ");
					$srno = 0;
					while($valueExm = mysqli_fetch_array($sqllmsExm)){	
						$srno++;	
						$totalmarks = 0;
						$obtmarks = 0;
						$permarks = 0;
						echo'
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$valueExm['type_name'].'</td>';
							foreach($subjectarray as $listsub) {
								$sqllmsmarks = $dblms->querylms("SELECT *
																	FROM ".EXAM_MARKS_DETAILS." ed 
																	INNER JOIN ".EXAM_MARKS." e ON e.id = ed.id_setup 
																	WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																	AND e.id_class = '".$values_std['id_class']."' AND e.id_section = '".$values_std['id_section']."'
																	AND e.id_subject = '".$listsub['subject_id']."' AND e.id_exam = '".$valueExm['type_id']."' 
																	AND e.status = '1' AND ed.id_std = '".$values_std['std_id']."'");
								if(mysqli_num_rows($sqllmsmarks) > 0) {
									$rowmarks = mysqli_fetch_array($sqllmsmarks);
									echo '<td>'.$rowmarks['obtain_marks'].'</td>';

									$totalmarks = ($totalmarks + $rowmarks['total_marks']);
									$obtmarks = ($obtmarks + $rowmarks['obtain_marks']);
								} else {
									$totalmarks = $totalmarks;
									$obtmarks = $obtmarks;
									echo '<td></td>';
								}
							}

							$permarks = round((($obtmarks/$totalmarks) * 100), 2);
							
							echo '
							<td>'.$totalmarks.'</td>
							<td>'.$obtmarks.'</td>
							<td class="hidden-xs hidden-sm center">
								<div class="progress progress-lg progress-squared light" style="margin: 6px;">
									<div class="progress-bar" role="progressbar" aria-valuenow="'.$permarks.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$permarks.'%;">
											'.$permarks.' %
									</div>
								</div>
							</td>
							<!-- <td>Pass/Fail</td>
							<td>
								<a href="include/marks/marks_sheetprint.php" class="btn btn-primary btn-xs" target="include/marks/marks_sheetprint.php">
									<i class="fa fa-print"></i>
								</a>
							</td> -->
						</tr>';
					}
					echo'	
				</tbody>
			</table>
		</div>
	</div>
	<!-- <div class="panel-footer">
		<div class="text-right">
			<a href="include/marks/marks_sheetprint.php" class="btn btn-sm btn-primary " target="include/marks/marks_sheetprint.php">
				<i class="glyphicon glyphicon-print"></i> Print
			</a>
		</div>
	</div> -->
</section>';
?>