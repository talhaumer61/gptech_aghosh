<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_firstname, s.std_lastname, s.std_gender, s.id_guardian,
								   s.std_nic, s.std_phone, s.id_class, s.id_section, s.id_group, s.id_session,  s.std_rollno,
								   s.std_regno, s.std_photo, s.std_gender, s.std_dob, s.std_bloodgroup, s.id_country,
								   s.std_city, s.std_religion, s.std_address, s.std_admissiondate,
								   g.guardian_id, g.guardian_status, g.guardian_name,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name, 
								   gr.group_id, gr.group_status, gr.group_name 
								   FROM ".STUDENTS." s
								   INNER JOIN ".GUARDIANS."		  g  ON g.guardian_id 	= s.id_guardian
								   INNER JOIN ".CLASSES."         c  ON c.class_id 	   	= s.id_class
								   INNER JOIN ".CLASS_SECTIONS."  se ON se.section_id   = s.id_section
								   INNER JOIN ".GROUPS."  		  gr ON gr.group_id   	= s.id_group
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND s.std_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div class="col-md-4">
	<section class="panel">
		<div class="panel-body">
			<div class="thumb-info mb-md">';
			if($rowsvalues['std_photo']) { 
    		echo'
				<img src="uploads/images/students/'.$rowsvalues['std_photo'].'" class="rounded img-responsive">' ;
    		} else {
				 echo "No Image";
			}
   			 echo'
				<div class="thumb-info-title">
					<span class="thumb-info-inner">'.$rowsvalues['std_firstname'].' '.$rowsvalues['std_lastname'].'</span>
					<span>'.get_status($rowsvalues['std_status']).'</span>
				</div>
			</div>	
			<div class="widget-toggle-expand mb-xs">
				<div class="widget-content-expanded">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td>First Name</td>
							<td align="right">'.$rowsvalues['std_firstname'].'</td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td align="right">'.$rowsvalues['std_lastname'].'</td>
						</tr>
						<tr>
							<td>Roll No</td>
							<td align="right">'.$rowsvalues['std_rollno'].'</td>
						</tr>
						<tr>
							<td>Registration Number</td>
							<td align="right">'.$rowsvalues['std_regno'].'</td>
						</tr>
						<tr>
							<td>Class</td>
							<td align="right">'.$rowsvalues['class_name'].'</td>
						</tr>
						<tr>
							<td>Section</td>
							<td align="right">'.$rowsvalues['section_name'].'</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td align="right">'.$rowsvalues['std_phone'].'</td>
						</tr>
						<tr>
							<td>Gender</td>
							<td align="right">'.$rowsvalues['std_gender'].'</td>
						</tr>
						<tr>
							<td>Blood Group</td>
							<td align="right">'.$rowsvalues['std_bloodgroup'].'</td>
						</tr>
						<tr>
							<td>Birthday</td>
							<td align="right">'.$rowsvalues['std_dob'].'</td>
						</tr>
						<tr>
							<td>NIC</td>
							<td align="right">'.$rowsvalues['std_nic'].'</td>
						</tr>
						<tr>
							<td>Religion</td>
							<td align="right">'.$rowsvalues['std_religion'].'</td>
						</tr>
						<tr>
							<td>Admission Date</td>
							<td align="right">'.$rowsvalues['std_admissiondate'].'</td>
						</tr>
						<tr>
							<td>Guardian</td>
							<td align="right">'.$rowsvalues['guardian_name'].'</td>
						</tr>
						<tr>
							<td>Country </td>
							<td align="right">'.$rowsvalues['id_country'].'</td>
						</tr>
						<tr>
							<td>City</td>
							<td align="right">'.$rowsvalues['std_city'].'</td>
						</tr>
						<tr>
							<td>Address</td>
							<td align="right">'.$rowsvalues['std_address'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
