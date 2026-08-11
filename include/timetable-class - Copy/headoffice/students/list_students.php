<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'view' => '1'))){
//-----------------------------------------------
if(isset($_POST['campus'])){$campus = $_POST['campus'];}	
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Select Campus</h2>
	</header>
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			 <div class="col-md-offset-3 col-md-6">
				<div class="form-group">
					<label class="control-label">Campus <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" name="campus" id="campus" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
					$sqllmscampus	= $dblms->querylms("SELECT c.campus_id, c.campus_name
															FROM ".CAMPUS." c  
															WHERE c.campus_id != '' AND campus_status = '1'
															ORDER BY c.campus_name ASC");
						while($value_campus = mysqli_fetch_array($sqllmscampus)){
							if($value_campus['campus_id'] == $campus){
								echo'<option value="'.$value_campus['campus_id'].'" selected>'.$value_campus['campus_name'].'</option>';
								}else{
									echo'<option value="'.$value_campus['campus_id'].'">'.$value_campus['campus_name'].'</option>';
									}
						}
						echo'
						</select>
				</div>
			</div>
		</div>
		<center>
			<button type="submit" name="view_students" id="view_students" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_students'])){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Students List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
<tr>
	<th>#</th>
	<th width= 40>Photo</th>
	<th>Regestration Number</th>
	<th>Full Name</th>
	<th>Roll no</th>
	<th>Class</th>
	<th>Section</th>
	<th>Group</th>
	<th>Phone</th>
	<th>CNIC</th>
	<th>Gurdian</th>
	<th width="70px;" style="text-align:center;">Status</th>
	<th width="100px;" style="text-align:center;">Options</th>
</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_firstname, s.std_lastname, s.std_gender, 
								   s.id_guardian, s.std_nic, s.std_phone, s.id_class, s.id_section, s.id_group, s.id_session,
								   s.std_rollno, s.std_regno, s.std_photo,
								   g.guardian_id, g.guardian_status, g.guardian_name,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name, 
								   gr.group_id, gr.group_status, gr.group_name 
								   FROM ".STUDENTS." s
								   INNER JOIN ".GUARDIANS."		  g  ON g.guardian_id 	= s.id_guardian
								   INNER JOIN ".CLASSES."         c  ON c.class_id 	   	= s.id_class
								   INNER JOIN ".CLASS_SECTIONS."  se ON se.section_id   = s.id_section
								   INNER JOIN ".GROUPS."  		  gr ON gr.group_id   	= s.id_group
								   WHERE s.std_id != '' AND s.id_campus = '".$campus."'
								   ORDER BY s.std_regno ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>';
    	if($rowsvalues['std_photo']) { 
    		echo'
    			<img src="uploads/images/students/'.$rowsvalues['std_photo'].'" style="width:40px; height:40px;">' ;
    		} else {
				 echo "No Image";
			}
    echo'
    </td>
	<td>'.$rowsvalues['std_regno'].'</td>
	<td>'.$rowsvalues['std_firstname'].' '.$rowsvalues['std_lastname'].'</td>
	<td>'.$rowsvalues['std_rollno'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['group_name'].'</td>
	<td>'.$rowsvalues['std_phone'].'</td>
	<td>'.$rowsvalues['std_nic'].'</td>
	<td>'.$rowsvalues['guardian_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['std_status']).'</td>
	<td style="text-align:center;">
		<a class="btn btn-success btn-xs" href="students.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-user-circle-o"></i></a>
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
//-----------------------------------------------
}
else{
	header("Location: dashboard.php");
}
?>