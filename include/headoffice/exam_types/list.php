<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'add' => '1'))){
				echo'
				<a href="#make_examtype" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
					<i class="fa fa-plus-square"></i> Make Exam Type
				</a>';
			}
			echo'
			<h2 class="panel-title"><i class="fa fa-list"></i>  Exam Types List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center" width="70">No.</th>
						<th>Type Name</th>
						<th>Total Marks</th>
						<th>Pass Marks</th>
						<th>Type Detail</th>
						<th width="70px;" class="center">Status</th>
						<th width="100" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					//-----------------------------------------------------
					$sqllms	= $dblms->querylms("SELECT type_id, type_status, type_name, total_marks, pass_marks, type_details
													FROM ".EXAM_TYPES." 
													WHERE type_id != '' AND is_deleted != '1' 
													ORDER BY type_id ASC");
					$srno = 0;
					//-----------------------------------------------------
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
					//-----------------------------------------------------
					$srno++;
					//-----------------------------------------------------
					echo '
					<tr>
						<td class="center">'.$srno.'</td>
						<td>'.$rowsvalues['type_name'].'</td>
						<td>'.$rowsvalues['total_marks'].'</td>
						<td>'.$rowsvalues['pass_marks'].'</td>
						<td>'.$rowsvalues['type_details'].'</td>
						<td class="center">'.get_status($rowsvalues['type_status']).'</td>
						<td class="center">';
						if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'edit' => '1'))){
							echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_types/update.php?id='.$rowsvalues['type_id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
						}
						if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'delete' => '1'))){
							echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'class.php?deleteid='.$rowsvalues['type_id'].'\');"><i class="el el-trash"></i></a>';
						}
						echo'
						</td>
					</tr>';
					//-----------------------------------------------------
				}
				//-----------------------------------------------------
				echo '
				</tbody>
			</table>
		</div>
	</section>';
}
else{
	header("Location: dashboard.php");
}
?>