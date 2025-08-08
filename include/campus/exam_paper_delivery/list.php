<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i> Dispatch Papers List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center" width="70">#</th>
						<th>Exam Type</th>
						<th>Term</th>
						<th class="center" width="100">Received</th>
						<th width="100" class="center">Option</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT d.delivery_id , d.receive_status, d.comment, d.id_term, t.type_name
													FROM ".EXAM_DELIVERY." d
													INNER JOIN ".EXAM_TYPES." t ON t.type_id = d.id_type
													WHERE d.delivery_id != '' 
													AND d.is_deleted != '1'
													AND d.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."' 
													AND d.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													ORDER BY d.delivery_id DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.get_term($rowsvalues['id_term']).'</td>
							<td class="center" width="100">'.get_notification($rowsvalues['receive_status']).'</td>
							<td class="center" width="100">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'edit' => '1'))){ 
									if ($rowsvalues['receive_status'] != 1) {
										echo'
										<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_paper_delivery/update.php?id='.$rowsvalues['delivery_id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
									}
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