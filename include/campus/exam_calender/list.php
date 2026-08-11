<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1'))){ 
	$sqllmsexam	= $dblms->querylms("SELECT  a.id, s.session_name
									 FROM ".EXAM_CALENDER." a 
									INNER JOIN ".SESSIONS." s ON s.session_id = a.id_session
									WHERE a.is_deleted != '1' 
									AND a.status = '1' 
									AND a.published = '1'
									AND a.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."' ");
	$value_exam = mysqli_fetch_array($sqllmsexam);
	echo '
	<section class="panel panel-featured panel-featured-primary">';
		if(mysqli_num_rows($sqllmsexam) > 0){
			echo'
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Calender for Exam Session '.$value_exam['session_name'].'</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
					<thead>
						<tr>
							<th class="center" width="70">#</th>
							<th>Exam Type </th>
							<th>Remarks </th>
							<th>Start Date </th>
							<th>End Date </th>
						</tr>
					</thead>
					<tbody>';
						$sqllms	= $dblms->querylms("SELECT  t.type_name, d.date_start, d.date_end, d.remarks
														FROM ".EXAM_CALENDER_DETAIL." d 
														INNER JOIN ".EXAM_TYPES." t ON t.type_id = d.id_type
														WHERE d.id_setup = '".$value_exam['id']."' ");
						$srno = 0;
						while($rowsvalues = mysqli_fetch_array($sqllms)) {
							$srno++;
							echo '
							<tr>
								<td class="center">'.$srno.'</td>
								<td>'.$rowsvalues['type_name'].'</td>
								<td>'.$rowsvalues['remarks'].'</td>
								<td width="120">'.date("d, F Y", strtotime($rowsvalues['date_start'])).'</td>
								<td width="120">'.date("d, F Y", strtotime($rowsvalues['date_end'])).'</td>
							</tr>';
						}
						echo '
					</tbody>
				</table>
			</div>';
		} else {
			echo'
			<div class="panel-body">
				<h3 class="text-center text-danger">No Record Found!</h3>
			</div>';
		}
		echo'
	</section>';
} else {
	header("Location: dashboard.php");
}
?>