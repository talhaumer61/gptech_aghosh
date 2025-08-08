<?php 
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="investors.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Investor </h4>
</div>

<div class="panel-body">

<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="inline">
			<h4 style="color: white;">
				<span style="background-color: black; padding: 5px 10px;"><b>Part A</b></span> 
				<span style="background-color: #800000; padding: 5px 10px;"><b>Personal Information</b></span>
			</h4>
		</div>
	</div>
</div>


<div class="col-md-5"></div>   
<div class="col-md-2">
<label class="control-label">Photo</label>
<div class="row">
	<div class="col-md-6">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 130px; height: 130px;" data-trigger="fileinput">
				<img src="uploads/default-student.jpg" alt="...">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 130px"></div>
			<div>
				<span class="btn btn-xs btn-default btn-file">
					<span class="fileinput-new">Select image</span>
					<span class="fileinput-exists">Change</span>
					<input type="file" name="std_photo" accept="image/*">
				</span>
				<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
	</div>
</div>
</div>
<div class="col-md-5"></div> 
 
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Applicant Name <span class="required">*</span></label>
			<input type="text" class="form-control" name="inv_name" id="inv_name" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">CNIC <span class="required">*</span></label>
			<input type="text" class="form-control" name="inv_cnic" id="inv_cnic" required title="Must Be Required"/>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Email <span class="required">*</span></label>
			<input type="text" class="form-control" name="inv_email" id="inv_email" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Phone <span class="required">*</span></label>
			<input type="text" class="form-control" name="inv_phone" id="inv_phone" required title="Must Be Required"/>
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label">Address <span class="required">*</span></label>
			<textarea class="form-control" rows="3" name="inv_add" id="inv_add" required title="Must Be Required"></textarea>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="inline">
			<h4 style="color: white;">
				<span style="background-color: black; padding: 5px 10px;"><b>Part A-1</b></span> 
				<span style="background-color: #800000; padding: 5px 10px;"><b>Educational Background</b></span>
			</h4>
		</div>
	</div>
</div>

<table class="table table-hover table-striped table-condensed mb-none">
	<thead>
	  <tr>
		 <th class="text-center">Qualfication</th>
		 <th class="text-center">Institution</th>
		 <th class="text-center">Passing Year</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		  <th class="text-center">Bachelor</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Master</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Doctrate</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Others</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	</tbody>
</table>

<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="inline">
			<h4 style="color: white;">
				<span style="background-color: black; padding: 5px 10px;"><b>Part A-2</b></span> 
				<span style="background-color: #800000; padding: 5px 10px;"><b>Professional Experience</b></span>
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
	<tbody>
	  <tr>
		  <th class="text-center">Work 1</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Work 2</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Work 3</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	</tbody>
</table>

<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="inline">
			<h4 style="color: white;">
				<span style="background-color: black; padding: 5px 10px;"><b>Part B</b></span> 
				<span style="background-color: #800000; padding: 5px 10px;"><b>Franchies Location</b></span>
			</h4>
		</div>
	</div>
</div>

<table class="table table-hover table-striped table-condensed mb-none">
	<thead>
	  <tr>
		 <th class="text-center">City</th>
		 <th class="text-center">Local areas locations within the city</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
					<label class="col-md-3 control-label"><b>City #1</b></label>
					<div class="col-md-9">
						<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
					</div>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<label class="col-md-3 control-label"><b>Location #1</b></label>
					<div class="col-md-9">
						<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
					</div>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Work 2</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	   <tr>
		  <th class="text-center">Work 3</th>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="number" class="form-control" name="" id="" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>
	</tbody>
</table>

			<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="std_status" name="std_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="std_status" name="std_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>

</div>
<footer class="panel-footer">
	<div class="row">
		<div class="col-md-12 text-right">
			<button type="submit" class="mr-xs btn btn-primary" id="submit_student" name="submit_student">Add Student</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</footer>
</form>
</section>
</div>
</div>';