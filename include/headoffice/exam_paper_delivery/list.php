<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'add' => '1'))){ 
				echo'
				<a href="#make_paperDelivery" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
				<i class="fa fa-plus-square"></i> Make Dispatch Paper
				</a>';
			}
			echo '
			<h2 class="panel-title"><i class="fa fa-list"></i> Dispatch Papers List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Exam Type</th>
						<th>Term</th>
						<th>Session</th>
						<th>Campus</th>
						<th class="center">Status</th>
						<th class="center">Received</th>
						<th width="100" class="center">Option</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT d.delivery_id, d.delivery_status, d.receive_status, d.comment, d.id_term,
													t.type_name, c.campus_name, se.session_name
													FROM ".EXAM_DELIVERY." d
													INNER JOIN ".EXAM_TYPES." t ON t.type_id = d.id_type
													INNER JOIN ".CAMPUS." c ON c.campus_id = d.id_campus
													INNER JOIN ".SESSIONS." se ON se.session_id = d.id_session
													WHERE d.delivery_id != '' AND d.is_deleted != '1'
													ORDER BY d.delivery_id DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.get_term($rowsvalues['id_term']).'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$rowsvalues['campus_name'].'</td>
							<td class="center" width="100">'.get_delivery($rowsvalues['delivery_status']).'</td>
							<td class="center" width="100">'.get_notification($rowsvalues['receive_status']).'</td>
							<td class="center" width="100">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'edit' => '1'))){ 
									echo'
									<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_paper_delivery/update.php?id='.$rowsvalues['delivery_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'delete' => '1'))){ 
									echo'
									<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'exam_paper_delivery.php?deleteid='.$rowsvalues['delivery_id'].'\');"><i class="el el-trash"></i></a>';
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