<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'added' => '1'))){ 
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Investor </h4>
</div>

<div class="panel-body">




<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;
  color: #cb3f44;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #cb3f44;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #cb3f44;
}
</style>


<form id="inv_form" action="investors.php">
  <h1><b>Investor Bio-data Form</b></h1>
  <!-- One "tab" for each step in the form: -->

  
  <div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part A</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Personal Information</b></span>
	</h4>
	<br>
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
	<div class="col-md-6 form-group">
		<label class="control-label">Dated <span class="required">*</span></label>
		<div>
			<input type="text" class="form-control" required name="dated" id="dated"  data-plugin-datepicker/>
		</div>
	</div>
	<div class="col-md-6 form-group mt-sm">
		<label class="col-md-3 control-label">Status <span class="required">*</span></label>
		<br>
		<div class="col-md-9">
			<div class="radio-custom radio-inline">
			<input type="radio" id="inv_status" name="inv_status" value="1" checked>
				<label for="radioExample1">Active</label>
		</div>
			<div class="radio-custom radio-inline">
				<input type="radio" id="inv_status" name="inv_status" value="2">
				<label for="radioExample2">Inactive</label>
			</div>
		</div>
</div>
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
			  		<input type="text" class="form-control" name="institution" id="institution" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="passing_year['.$i.']" id="passing_year['.$i.']" required title="Must Be Required"/>
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
			  		<input type="text" class="form-control" name="institution_or_firm['.$i.']" id="institution_or_firm['.$i.']" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="years_of_experience['.$i.']" id="years_of_experience['.$i.']" required title="Must Be Required"/>
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
				<span style="background-color: black; padding: 5px 10px;"><b>Part B</b></span> 
				<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Franchies Location</b></span>
			</h4>
		</div>
	</div>
</div>
<br>
<table class="table table-hover table-striped table-condensed mb-none">
	<thead>
	  <tr>
		 <th class="text-center" colspan="2">City</th>
		 <th class="text-center" colspan="2">Local areas locations within the city</th>
	  </tr>
	</thead>
	<tbody>';
	for($i=1; $i<=3; $i++)
	{
	echo'
	  <tr>';
	  	if($i==1)
		 { 
		 echo'<th class="text-center">City #1</th>';
		 }else if($i==2)
		 { 
		 echo'<th class="text-center">City #2</th>';
		 }else
		 { 
		 echo'<th class="text-center">City #3</th>';
		 }
		 echo'
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
					<input type="text" class="form-control" name="city['.$i.']" id="city['.$i.']" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">';
	  	if($i==1)
		 { 
		 echo'<label class="col-md-3 control-label"><b>Location #1</b></label>';
		 }else if($i==2)
		 { 
		 echo'<label class="col-md-3 control-label"><b>Location #2</b></label>';
		 }else
		 { 
		 echo'<label class="col-md-3 control-label"><b>Location #3</b></label>';
		 }
		 echo'
			  		
					<div class="col-md-9">
						<input type="text" class="form-control" name="location['.$i.']" id="location['.$i.']" required title="Must Be Required"/>
					</div>
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
				<span style="background-color: black; padding: 5px 10px;"><b>Part C</b></span> 
				<span style="background-color: #cb3f44; padding: 5px 10px;"><b>School in the same vicinity</b></span>
			</h4>
		</div>
	</div>
</div>
<br>
<table class="table table-hover table-striped table-condensed mb-none">
	<thead>
	  <tr>
		 <th class="text-center">Name of School</th>
		 <th class="text-center">Students</th>
		 <th class="text-center">Fee Structure</th>
	  </tr>
	</thead>
	<tbody>';
	for($i=1; $i<=3; $i++)
	{
	echo'
	  <tr>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="school_name['.$i.']" id="school_name['.$i.']" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="no_of_students['.$i.']" id="no_of_students['.$i.']" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="fee_structure['.$i.']" id="fee_structure['.$i.']" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
	  </tr>';
	}
	echo'
	</tbody>
</table>

</div>
<br>

 <div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part D</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Preference of school type</b></span>
	</h4>
	<br>
	
	<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">School Type <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT level_id, level_status, level_name 
													FROM ".SCHOOL_LEVEL."
													WHERE level_status = '1'
													ORDER BY level_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['level_id'].'">'.$valuecls['level_name'].'</option>';
							}
						echo '
						</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Purposeful Building / Buildings <span class="required">*</span></label>
			<input type="text" class="form-control" name="purposeful_building" id="purposeful_building" required title="Must Be Required"/>
		</div>
	</div>
</div>
   <div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Total Area <span class="required">*</span></label>
			<input type="text" class="form-control" name="" id="" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Number of Rooms <span class="required">*</span></label>
			<input type="text" class="form-control" name="rooms" id="rooms" required title="Must Be Required"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3  mt-sm control-label">You intend to open <span class="required">*</span></label>
		<div class="col-md-9 mt-sm">
			<div class="radio-custom radio-inline">
				<input type="radio" id="type" name="type" value="1" checked>
				<label for="radioExample1">Single branch</label>
		</div>
		<div class="radio-custom radio-inline">
			<input type="radio" id="type" name="type" value="2">
			<label for="radioExample2">Multiple branches</label>
		</div>
	</div>
	</div>
	</div>
	</div>
<br>


 <div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part D-1</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Property Status</b></span>
	</h4>
	<br>
	
	<div class="row mt-sm">
		<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">School building <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="school_building">
							<option value="">Select</option>
							<option value="1">Owned</option>
							<option value="2">Rented</option>
							<option value="3">To be arranged</option>
						</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Building type <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="building_type">
							<option value="">Select</option>
							<option value="1">Resdential</option>
							<option value="2">Commercial</option>
						</select>
		</div>
	</div>
			
	<div class="col-sm-12">
				<div class="form-group mt-sm">
					<label class="control-label">Total Plot area (sq. ft.) <span class="required">*</span></label>
					<div class="input-group">
						<span class="input-group-addon">Covered</span>
						<input type="text" class="form-control valid" name="covered_area" id="covered_area" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
						<span class="input-group-addon">Uncovered</span>
						<input type="text" class="form-control" name="uncovered_area" id="uncovered_area" required="" title="Must Be Required"  aria-required="true">
					</div>
			   </div>
   </div>
		</div>	
</div>
<br>


  <div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part E</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Conversion of existing school </b></span>
	</h4>
	
	<div class="col-sm-12 mt-sm">
		<div class="form-group">
			<label class="control-label">Name of existing school <span class="required">*</span></label>
			<input type="text" class="form-control" name="existing_school_name" id="existing_school_name" required title="Must Be Required"/>
		</div>
	</div>
	
	<div class="col-sm-12 mt-sm">
		<div class="form-group">
			<label class="control-label">Address <span class="required">*</span></label>
			<textarea type="text" class="form-control" name="existing_school_add" id="existing_school_add" required title="Must Be Required"></textarea>
		</div>
	</div>



<div class="col-sm-12 row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">School Type <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="existing_school_type">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT level_id, level_status, level_name 
													FROM ".SCHOOL_LEVEL."
													WHERE level_status = '1'
													ORDER BY level_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['level_id'].'">'.$valuecls['level_name'].'</option>';
							}
						echo '
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Medium Instruction <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="existing_school_medium">
				<option value="">Select</option>
				<option value="">English</option>
				<option value="">Urdu</option>
			</select>
		</div>
	</div>
</div>
<div class="col-sm-12 row mt-sm">		
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Students <span class="required">*</span></label>
			<div class="input-group">
				<span class="input-group-addon">Male</span>
				<input type="text" class="form-control valid" name="male_students" id="male_students" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
				<span class="input-group-addon">Female</span>
				<input type="text" class="form-control" name="female_students" id="female_students" required="" title="Must Be Required"  aria-required="true">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Total teachers <span class="required">*</span></label>
			<div class="input-group">
				<span class="input-group-addon">Male</span>
				<input type="text" class="form-control valid" name="male_teachers" id="male_teachers" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
				<span class="input-group-addon">Female</span>
				<input type="text" class="form-control" name="female_teachers" id="female_teachers" required="" title="Must Be Required"  aria-required="true">
			</div>
		</div>
	</div>
</div>
	<div class="col-sm-12 mt-sm">
		<div class="form-group">
			<label class="control-label">Fee structure <span class="required">*</span></label>
			<input type="text" class="form-control" name="fee_structure" id="fee_structure" required title="Must Be Required"/>
		</div>
	</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part F</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Your financial commitment</b></span>
	</h4>
	<br>
<div class="col-sm-12 row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Planned Investment<span class="required">*</span></label>
			<input type="text" class="form-control" name="planned_investment" id="planned_investment" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Financing <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="financing_type">
				<option value="">Select</option>
				<option value="">Personal</option>
				<option value="">Partnership</option>
				<option value="">Bank loan</option>
			</select>
		</div>
	</div>
</div>
<br><br><br><br><br>
</div>

<div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part G</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Additional information</b></span>
	</h4>
	<br>
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label">Details <span class="required">*</span></label>
			<textarea type="text" class="form-control" name="additional_info" id="additional_info" required title="Must Be Required"></textarea>
		</div>
	</div>
		<button type="submit" class="mr-sm ml-sm btn btn-primary pull-right mt-xl" style="padding: 10px; border-radius: 0px;" id="submit_investor" name="submit_investor">Add Investor</button>
	<br><br>
	<br><br>
</div>
<br>





  
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>






			

</div> ';?>

<!------- Form JS---------->
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    //document.getElementById("nextBtn").innerHTML = "Submit";
	document.getElementById("nextBtn").style.display = "none";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("inv_form").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
<!------- Form JS---------->

<?php
echo'
</form>
</section>
</div>
</div>';
}
?>