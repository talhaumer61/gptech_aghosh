<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'view' => '1')))
{ 
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i> Active Students</h2>
	</header>
	<form action="active_student_portal.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
			<thead>
				<tr>
					<th class="center">No.</th>
					<th>Reg no.</th>
					<th>Name</th>
					<th>Father Name</th>
					<th>Phone</th>
					<th>campus</th>
					<th>Dated</th>
					<th width="70px;" class="center">Status</th>
				</tr>
			</thead>
			<tbody>';
				// $sqllms	= $dblms->querylms("SELECT s.std_id, s.std_status, s.std_regno, s.std_name, s.std_fathername, s.std_gender, s.std_phone, s.std_admissiondate, s.id_class, s.id_campus, cls.class_name, c.campus_name, c.campus_code
				// 								FROM ".STUDENTS." s
				// 								INNER JOIN ".CLASSES." cls ON cls.class_id = s.id_class
				// 								INNER JOIN ".CAMPUS." c ON c.campus_id = s.id_campus
				// 								WHERE s.update_status = '0'
				// 								ORDER BY s.std_id ASC");
				$sqllms	= $dblms->querylms("SELECT s.std_id, s.std_status, s.std_regno, s.std_name, s.std_fathername, s.std_gender, s.std_phone, s.std_admissiondate, s.id_class, s.id_campus, cls.class_name, c.campus_name, c.campus_code
												FROM ".STUDENTS." s
												INNER JOIN ".CLASSES." cls ON cls.class_id = s.id_class
												INNER JOIN ".CAMPUS." c ON c.campus_id = s.id_campus
												WHERE	s.std_status = '1'
												AND		s.is_deleted = '0'
												AND		s.id_loginid = '0'
												ORDER BY s.std_id ASC");
				$srno = 0;
				
				while($rowsvalues = mysqli_fetch_array($sqllms)) {
					$srno++;
					echo'
					<tr>
						<td class="center">'.$srno.'
							<input type="hidden" value="'.$rowsvalues['std_id'].'" name="std_id[]" />
							<input type="hidden" value="'.$rowsvalues['std_admissiondate'].'" name="std_admissiondate[]" />
							<input type="hidden" value="'.$rowsvalues['std_regno'].'" name="std_regno[]" />
							<input type="hidden" value="'.$rowsvalues['std_name'].'" name="std_name[]" />
							<input type="hidden" value="'.$rowsvalues['std_phone'].'" name="adm_phone[]" />
							<input type="hidden" value="'.$rowsvalues['id_campus'].'" name="id_campus[]" />
							<input type="hidden" value="'.$rowsvalues['campus_code'].'" name="campus_code[]" />
						</td>
						<td>'.$rowsvalues['std_regno'].'</td>
						<td>'.$rowsvalues['std_name'].'</td>
						<td>'.$rowsvalues['std_fathername'].'</td>
						<td>'.$rowsvalues['std_phone'].'</td>
						<td>'.$rowsvalues['campus_name'].'</td>
						<td>'.date("d M Y", strtotime($rowsvalues['date_added'])).'</td>
						<td class="center">'.get_status($rowsvalues['std_status']).'</td>
					</tr>';
				}
				echo'
			</tbody>
		</table>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-12 text-center">
				<button type="submit" id="student_portal" name="student_portal" class="mr-xs btn btn-primary">Create Portal Login</button>
				<button type="submit" id="update_regno" name="update_regno" class="mr-xs btn btn-primary">Update Reg Number</button>
			</div>
		</div>
	</footer>
	</form>
</section>';
}
else{
	header("Location: dashboard.php");
}
?>