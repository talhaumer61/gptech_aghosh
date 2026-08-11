<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<a href="timetable.php?view=add" class="btn btn-primary btn-xs pull-right mr-sm">
		<i class="fa fa-plus-square"></i> Make Class Timetable</a>
		<h2 class="panel-title"><i class="fa fa-list"></i>  Class Timetabel List</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
			<thead>
				<tr>
					<th style="text-align:center; width:40px">#</th>
					<th>Session</th>
					<th>Class</th>
					<th>Section</th>
					<th width="70px;" style="text-align:center;">Status</th>
					<th width="100" style="text-align:center;">Options</th>
				</tr>
			</thead>
			<tbody>';
				$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_session, t.id_class, t.id_section, t.id_campus,
												ss.session_id, ss.session_status, ss.session_name,
												c.class_id, c.class_status, c.class_name,
												se.section_id, se.section_status, se.section_name
												FROM ".TIMETABLE." 	t 
												INNER JOIN ".SESSIONS."  	 ss	ON 	ss.session_id 	= t.id_session
												INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
												INNER JOIN ".CLASS_SECTIONS." se	ON 	se.section_id 	= t.id_section
												WHERE t.id != '' AND t.is_deleted != '1'
												AND c.class_id IN (".$allottedClasses.") 
												AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
												ORDER BY c.class_name ASC");
				$srno = 0;
				while($rowsvalues = mysqli_fetch_array($sqllms)) {
					$srno++;
					echo '
					<tr>
						<td style="text-align:center;">'.$srno.'</td>
						<td>'.$rowsvalues['session_name'].'</td>
						<td>'.$rowsvalues['class_name'].'</td>
						<td>'.$rowsvalues['section_name'].'</td>
						<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
						<td class="center">
							<a href="timetable.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs" onclick=""><i class="glyphicon glyphicon-edit"></i></a>
						</td>
					</tr>';
				}
				echo '
			</tbody>
		</table>
	</div>
</section>';
?>