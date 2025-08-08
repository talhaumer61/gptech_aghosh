<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Datesheets List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
				<thead>
					<tr>
						<th class="center" width="70">#</th>
						<th>Exam</th>
						<th>Class</th>
						<th>Campus</th>
						<th width="70px;" class="center">Publish</th>
						<th width="120" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT d.id, d.status, t.type_name, c.class_name, ca.campus_name
													FROM ".DATESHEET." 	d
													INNER JOIN ".EXAM_TYPES."  	 t	ON 	t.type_id 		= d.id_exam
													INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= d.id_class
													INNER JOIN ".CAMPUS."  	 	 ca	ON 	ca.campus_id    = d.id_campus
													WHERE d.is_deleted != '1'
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
							<td>'.$rowsvalues['campus_name'].'</td>
							<td class="center">'.get_notification($rowsvalues['status']).'</td>
							<td class="center">
								<a href="exam_datesheet.php?routine='.$rowsvalues['id'].'" target="_blank" class="btn btn-info btn-xs" onclick=""><i class="glyphicon glyphicon-eye-open"></i></a>
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