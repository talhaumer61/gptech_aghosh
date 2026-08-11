<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_status, e.emply_regno, e.emply_name, e.id_dept, 
								   e.id_designation, e.id_type, e.emply_gender, e.emply_dob, e.emply_joindate,
								   e.emply_education, e.emply_experence, e.emply_religion, e.emply_bloodgroup,
								   e.emply_address, e.emply_phone, e.emply_email, e.emply_photo,
								   d.dept_name, dp.designation_name 
								   FROM ".EMPLOYEES." e 
								   INNER JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
								   INNER JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND e.emply_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div class="col-md-4">
	<section class="panel">
		<div class="panel-body">
			<div class="thumb-info mb-md">';
			if($rowsvalues['emply_photo']) { 
    		echo'
				<img src="uploads/images/employees/'.$rowsvalues['emply_photo'].'" class="rounded img-responsive">' ;
    		} else {
				 echo "No Image";
			}
   			 echo'
				<div class="thumb-info-title">
					<span class="thumb-info-inner">'.$rowsvalues['emply_name'].'</span>
					<span>'.get_status($rowsvalues['emply_status']).'</span>
				</div>
			</div>	
			<div class="widget-toggle-expand mb-xs">
				<div class="widget-content-expanded">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td>Name</td>
							<td align="right">'.$rowsvalues['emply_name'].'</td>
						</tr>
						<tr>
							<td>Registration Number</td>
							<td align="right">'.$rowsvalues['emply_regno'].'</td>
						</tr>
						<tr>
							<td>Type</td>
							<td align="right">'.get_emplytype($rowsvalues['id_type']).'</td>
						</tr>
						<tr>
							<td>Department</td>
							<td align="right">'.$rowsvalues['dept_name'].'</td>
						</tr>
						<tr>
							<td>Designation</td>
							<td align="right">'.$rowsvalues['designation_name'].'</td>
						</tr>
						<tr>
							<td>Education</td>
							<td align="right">'.$rowsvalues['emply_education'].'</td>
						</tr>
						<tr>
							<td>Experience</td>
							<td align="right">'.$rowsvalues['emply_experence'].'</td>
						</tr>
						<tr>
							<td>Birthday</td>
							<td align="right">'.$rowsvalues['emply_dob'].'</td>
						</tr>
						<tr>
							<td>Joining Date</td>
							<td align="right">'.$rowsvalues['emply_joindate'].'</td>
						</tr>
						<tr>
							<td>Gender</td>
							<td align="right">'.$rowsvalues['emply_gender'].'</td>
						</tr>
						<tr>
							<td>Religion</td>
							<td align="right">'.$rowsvalues['emply_religion'].'</td>
						</tr>
						<tr>
							<td>Blood group</td>
							<td align="right">'.$rowsvalues['emply_bloodgroup'].'</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td align="right">'.$rowsvalues['emply_phone'].'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td align="right">'.$rowsvalues['emply_email'].'</td>
						</tr>
						<tr>
							<td>Address</td>
							<td align="right">'.$rowsvalues['emply_address'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
