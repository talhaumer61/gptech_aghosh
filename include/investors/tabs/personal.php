<?php 	
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.inv_id, i.inv_status, i.id_type, i.inv_name, i.inv_add, i.inv_email, i.inv_phone,
								   i.inv_cnic, i.dated,
								   e.id, e.qualification, e.institution, e.passing_year, e.id_inv,
								   ex.id, ex.institution_or_firm, ex.years_of_experience, ex.id_inv
									
								   FROM ".INVESTORS." i 
								   INNER JOIN ".INVESTOR_EDUCATION." e ON e.id_inv = i.inv_id
								   INNER JOIN ".INVESTOR_EXPERIENCE." ex ON ex.id_inv = i.inv_id
								   WHERE i.inv_id = '".cleanvars($_GET['id'])."'
								   AND i.inv_status = '1'
								   AND e.id_inv = i.inv_id 
								   AND ex.id_inv = i.inv_id  LIMIT 1");

	$rowsvalues = mysqli_fetch_array($sqllms);
	
//-----------------------------------------------------
echo '
<div id="personal" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 <input type="hidden" name="inv_id" id="inv_id" value="'.cleanvars($_GET['id']).'">
	<fieldset class="mb-md mt-md">
		<div class="form-group">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">';
						if($rowsvalues['emply_photo']) { 
    					echo'
							<img src="" class="rounded img-responsive">' ;
    					} else {
				 			echo "No Image";
						}
   			 			echo'
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
					<div>
						<span class="mr-xs btn btn-xs btn-default btn-file">
							<span class="fileinput-new">Select image</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="userfile" accept="image/*">
						</span>
						<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Applicant Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="inv_name" id="inv_name" value="'.$rowsvalues['inv_name'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">CNIC <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="inv_cnic" id="inv_cnic" value="'.$rowsvalues['inv_cnic'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="inv_email" id="inv_email" value="'.$rowsvalues['inv_email'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="inv_phone" id="inv_phone" value="'.$rowsvalues['inv_phone'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="dated" id="dated"  data-plugin-datepicker value="'.$rowsvalues['dated'].'"/>
			</div>
		</div>
		
		<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
				if($rowsvalues['inv_status'] == 1) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="inv_status" name="inv_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="inv_status" name="inv_status" value="1">
							<label for="radioExample1">Active</label>
						</div>';
				}
				if($rowsvalues['inv_status'] == 2) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="inv_status" name="inv_status" checked value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="inv_status" name="inv_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				}
				echo '		
					</div>
				</div>
		
  <div class="tab">
  
    <br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part A-1</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Educational Backgroound</b></span>
	</h4>
	<br>
	<table class="table table-hover table-striped table-condensed mb-none">
	<thead>
	  <tr>
		 <th class="text-center">Qualfication</th>
		 <th class="text-center">Institution</th>
		 <th class="text-center">Passing Year</th>
	  </tr>
	</thead>
	<tbody>';
	for($i=1; $i<=4; $i++)
	{
	echo'
	  <tr>';
	  	if($i==1)
		 { 
		 echo'<th class="text-center">Bachelor</th>';
		 }else if($i==2)
		 { 
		 echo'<th class="text-center">Master</th>';
		 }else if($i==3)
		 { 
		 echo'<th class="text-center">Doctrate</th>';
		 }else
		 { 
		 echo'<th class="text-center">Others</th>';
		 }
		 echo'
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="hidden" class="form-control" name="qualification['.$i.']" id="qualification['.$i.']" value="Bachelor"/>
			  		<input type="text" class="form-control" name="institution['.$i.']" id="institution['.$i.']" value="'.$rowsvalues['qualification'].'" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="passing_year['.$i.']" id="passing_year['.$i.']" value="'.$rowsvalues['passing_year'].'" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>';
	}
	  echo'
	</tbody>
</table>
</div>
  
  <div class="tab">
    
	<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="inline">
			<h4 style="color: white;">
				<span style="background-color: black; padding: 5px 10px;"><b>Part A-2</b></span> 
				<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Professional Experience</b></span>
			</h4>
		</div>
	</div>
</div>
<table class="table table-hover table-striped table-condensed mb-none">
	<thead>
	  <tr>
		 <th width= 205></th>
		 <th class="text-center">Firm / Institution</th>
		 <th class="text-center">Years of Experience</th>
	  </tr>
	</thead>
	<tbody>';
	for($i=1; $i<=3; $i++)
	{
	echo'
	  <tr>';
	  	if($i==1)
		 { 
		 echo'<th class="text-center">Work 1</th>';
		 }else if($i==2)
		 { 
		 echo'<th class="text-center">Work 2</th>';
		 }else
		 { 
		 echo'<th class="text-center">Work 3</th>';
		 }
		 echo'
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="institution_or_firm['.$i.']" id="institution_or_firm['.$i.']"  value="'.$rowsvalues['institution_or_firm'].'" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="years_of_experience['.$i.']" id="years_of_experience['.$i.']" value="'.$rowsvalues['years_of_experience'].'"  required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>';
	}
	echo'
	</tbody>
</table>

</div>
		
		
	</fieldset>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit"  name="changes_personal_info" id="changes_personal_info" class="btn btn-primary">Update Profile</button>
			</div>
		</div>
	</div>
</form>
</div>';
?>