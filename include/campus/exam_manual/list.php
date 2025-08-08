<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){ 
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i>  Assessment Manuals List</h2>
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center" width="70">#</th>
						<th>Session</th>
						<th>Note</th>
						<th width="100" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					$sqllms	= $dblms->querylms("SELECT s.id, s.status, s.id_type, s.file, s.note, se.session_name
													FROM ".EXAM_DOWNLOADS." s 	
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
													WHERE s.id != '' AND s.is_deleted != '1' AND s.id_type = '1' AND s.status = 1
													AND s.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
													ORDER BY s.id DESC");
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$rowsvalues['note'].'</td>
							<td width="100" class="center">
								<a href="uploads/assessment_downloads/'.$rowsvalues['file'].'" download="'.$rowsvalues['session_name'].'-'.get_assessment($rowsvalues['id_type']).'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
								<a href="uploads/assessment_downloads/'.$rowsvalues['file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>
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