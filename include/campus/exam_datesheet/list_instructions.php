<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){
	echo'
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'add' => '1'))){
				echo'<a href="#add" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Instructions</a>';
			}
			echo'
			<h2 class="panel-title"><i class="fa fa-list"></i>  '.$title.' List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
				<thead>
					<tr>
						<th class="center" width="40">Sr.</th>
						<th>Exam</th>
						<th>Class</th>
						<th width="70px;" class="center">Status</th>
						<th width="100" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT i.id, i.id_examtype, i.id_class, i.status, t.type_name, c.class_name
													FROM ".EXAM_INSTRUCTIONS." i
													INNER JOIN ".EXAM_TYPES." t	ON t.type_id = i.id_examtype
													INNER JOIN ".CLASSES." c ON c.class_id = i.id_class
													WHERE i.is_deleted	= '0'
													AND i.id_campus		= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													ORDER BY i.id ASC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)){
						$srno++;
						echo'
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td class="center">'.get_status($rowsvalues['status']).'</td>
							<td class="center">
								<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-info btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_datesheet/instruction_details.php?id='.$rowsvalues['id'].'\');"><i class="fa fa-info-circle"></i></a>';
								if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'edit' => '1'))){
									echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs ml-xs" onclick="showAjaxModalZoom(\'include/modals/exam_datesheet/edit_instructions.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'delete' => '1'))){
									echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'exam_datesheet.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
								}
								echo'
							</td>
						</tr>';
					}
					echo'
				</tbody>
			</table>
		</div>
	</section>';
}else{
	header("Location: dashboard.php");
}
?>