<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'add' => '1'))){ 
				echo'<a href="feesetup.php?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Fee Structure</a>';
			}
			echo'
			<a href="feestructurePrint.php" class="btn btn-primary btn-xs pull-right mr-xs" target="_blank"><i class="fa fa-print"></i> Print Fee Structure</a>
			<a href="feesetup.php?view=copy" class="btn btn-primary btn-xs pull-right mr-xs" ><i class="fa fa-file"></i> Copy Fee Structure</a>
			<!--
			<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs pull-right mr-xs" onclick="showAjaxModalZoom(\'include/modals/fee_structure/copy.php\');"><i class="fa fa-file-o"></i> Copy Fee Structure</a>
			-->
			<h2 class="panel-title"><i class="fa fa-list"></i>  Feesetup List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th width="40" class="center">Sr.</th>
						<th>Dated</th>
						<th>Session</th>
						<th>Class</th>
						<th>Section</th>
						<th width="70px;" class="center">Status</th>
						<th width="100" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
													c.class_name, cs.section_name, s.session_name
													FROM ".FEESETUP." f				   
													INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
													LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
													INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
													WHERE f.is_deleted != '1'
													AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
													ORDER BY f.dated DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['dated'].'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td>'.$rowsvalues['section_name'].'</td>
							<td class="center">'.get_status($rowsvalues['status']).'</td>
							<td class="center">
							<a class="btn btn-success btn-xs" href="feestructurePrint.php?id='.$rowsvalues['id'].'" target="_blank"> <i class="fa fa-file"></i></a>';
							if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'edit' => '1'))){ 
							echo'
								<a href="feesetup.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs");"><i class="glyphicon glyphicon-edit"></i></a>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'delete' => '1'))){ 
							echo'
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'feesetup.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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
}else{
	header("Location: dashboard.php");
}
?>