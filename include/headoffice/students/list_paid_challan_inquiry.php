<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'view' => '1')))
{ 
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i> Admission Challan Paid Students</h2>
	</header>
	<form action="paid_challan_inquiry.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
			<thead>
				<tr>
					<th class="center">No.</th>
					<th>Form no.</th>
					<th>Name</th>
					<th>Father Name</th>
					<th>Cell No.</th>
					<th>Dated</th>
					<th>Source</th>
					<th>Class</th>
					<th width="70px;" class="center">Status</th>
				</tr>
			</thead>
			<tbody>';
				$sqllms	= $dblms->querylms("SELECT q.id, q.form_no, q.status, q.name, q.fathername, q.gender, q.dob, q.nic, q.guardian, q.cell_no, q.email, q.address, q.id_class, q.is_hostelized, q.is_orphan, q.id_campus, q.dated, q.date_added, q.source, q.id_class, c.class_name
												FROM ".ADMISSIONS_INQUIRY." q  
												INNER JOIN ".CLASSES." c ON c.class_id = q.id_class
												INNER JOIN ".FEES." f ON f.inquiry_formno = q.form_no
												LEFT JOIN ".STUDENTS." s on s.admission_formno = q.form_no
												WHERE f.status = '1' AND f.paid_date != '0000-00-00' AND f.id_type = '1'
												AND s.admission_formno IS NULL 
												ORDER BY q.id DESC");
				$srno = 0;
				
				while($rowsvalues = mysqli_fetch_array($sqllms)) {
					$srno++;
					
					echo'
					<tr>
						<td class="center">'.$srno.'
							<input type="hidden" value="'.$rowsvalues['form_no'].'" name="form_no[]" />
							<input type="hidden" value="'.$rowsvalues['name'].'" name="std_name[]" />
							<input type="hidden" value="'.$rowsvalues['fathername'].'" name="std_fathername[]" />
							<input type="hidden" value="'.$rowsvalues['gender'].'" name="std_gender[]" />
							<input type="hidden" value="'.$rowsvalues['guardian'].'" name="id_guardian[]" />
							<input type="hidden" value="'.$rowsvalues['dob'].'" name="dob[]" />
							<input type="hidden" value="'.$rowsvalues['nic'].'" name="std_nic[]" />
							<input type="hidden" value="'.$rowsvalues['cell_no'].'" name="std_phone[]" />
							<input type="hidden" value="'.$rowsvalues['std_email'].'" name="email[]" />
							<input type="hidden" value="'.$rowsvalues['address'].'" name="std_address[]" />
							<input type="hidden" value="'.$rowsvalues['dated'].'" name="std_admissiondate[]" />
							<input type="hidden" value="'.$rowsvalues['is_orphan'].'" name="is_orphan[]" />
							<input type="hidden" value="'.$rowsvalues['is_hostelized'].'" name="is_hostelized[]" />
							<input type="hidden" value="'.$rowsvalues['id_class'].'" name="id_class[]" />
							<input type="hidden" value="'.$rowsvalues['id_campus'].'" name="id_campus[]" />
						</td>
						<td>'.$rowsvalues['form_no'].'</td>
						<td>'.$rowsvalues['name'].'</td>
						<td>'.$rowsvalues['fathername'].'</td>
						<td>'.$rowsvalues['cell_no'].'</td>
						<td>'.date("d M Y", strtotime($rowsvalues['date_added'])).'</td>
						<td>'.get_inquirysrc($rowsvalues['source']).'</td>
						<td>'.$rowsvalues['class_name'].'</td>
						<td class="center">'.get_status($rowsvalues['status']).'</td>
						<td class="center">
						</td>
					</tr>';
				}
				echo'
			</tbody>
		</table>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-12 text-right">
				<button type="submit" id="submit_student" name="submit_student" class="mr-xs btn btn-primary">Add Students</button>
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