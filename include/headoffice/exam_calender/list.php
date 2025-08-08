<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'add' => '1'))){ 
				echo'
				<a href="exam_calender.php?view=add" class="btn btn-primary btn-xs pull-right"> <i class="fa fa-plus-square"></i> Make Exam Calender </a>';
			}
			echo'
			<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Calender  List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="text-center" width="70">#</th>
						<th>Session </th>
						<th>Term </th>
						<th width="70px;">Published </th>
						<th width="70px;" class="text-center">Status</th>
						<th width="100" class="text-center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT  a.id, a.status, a.published, a.id_session, a.term, a.dated,
														s.session_id, s.session_status, s.session_name
													FROM ".EXAM_CALENDER." a 
													INNER JOIN ".SESSIONS." s ON s.session_id = a.id_session
													WHERE a.is_deleted != '1'
													ORDER BY a.id_session ASC");
					$srno = 0;

					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						if($rowsvalues['term'] == 1){
							$term = 'First';
						} elseif($rowsvalues['term'] == 2){
							$term = 'Second';
						}
						$srno++;
						echo '
						<tr>
							<td class="text-center">'.$srno.'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$term.'</td>
							<td class="text-center">'.get_notification($rowsvalues['published']).'</td>
							<td class="text-center">'.get_status($rowsvalues['status']).'</td>
							<td class="text-center">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'edit' => '1'))){ 
								if ($rowsvalues['published'] != 1) {
									echo'
									<a href="exam_calender.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
								}
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'delete' => '1'))){ 
							echo'
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'exam_calender.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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
} else {
	header("Location: dashboard.php");
}
?>