<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'add' => '1'))){
				echo'<a href="exam_datesheet.php?view=add" class="btn btn-primary btn-xs pull-right mr-sm"><i class="fa fa-plus-square"></i> Make Datesheet</a>
				<a href="exam_datesheet.php?view=routine" class="btn btn-primary btn-xs pull-right mr-sm"><i class="fa fa-eye"></i> View By Type</a>';
			}
			echo '
			<h2 class="panel-title"><i class="fa fa-list"></i>  Datesheets List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
				<thead>
					<tr>
						<th class="center" width="70">#</th>
						<th>Exam</th>
						<th>Class</th>
						<th width="70px;" class="center">Publish</th>
						<th width="150" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT d.id, d.status, t.type_name, c.class_name
													FROM ".DATESHEET." 	d
													INNER JOIN ".EXAM_TYPES."  	 t	ON 	t.type_id 		= d.id_exam
													INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= d.id_class
													WHERE d.is_deleted != '1'
													AND d.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													AND d.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
													ORDER BY d.id ASC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['type_name'].'</td>
							<td>'.$rowsvalues['class_name'].'</td> 
							<td class="center">'.get_notification($rowsvalues['status']).'</td>
							<td class="center">
								<a href="exam_datesheet_print.php?id='.$rowsvalues['id'].'" target="_blank" class="btn btn-dark btn-xs" onclick=""><i class="glyphicon glyphicon-print"></i></a>
								<a href="exam_datesheet.php?routine='.$rowsvalues['id'].'" target="_blank" class="btn btn-info btn-xs" onclick=""><i class="glyphicon glyphicon-eye-open"></i></a>';
								if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'edit' => '1'))){
									echo'<a href="exam_datesheet.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs ml-xs" onclick=""><i class="glyphicon glyphicon-edit"></i></a>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'delete' => '1'))){
									echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'exam_datesheet.php?deleteid_datesheet='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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