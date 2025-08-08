<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.id_type, i.purposeful_building, i.rooms, i.school_building, i.building_type,
								   i.covered_area, i.uncovered_area, i.existing_school_name, i.existing_school_add,
								   i.existing_school_type, i.existing_school_medium, i.female_students, i.male_students,
								   i.female_teachers, i.male_teachers, i.fee_structure, i.planned_investment, i.financing_type,
								   i.additional_info, 
								   f.id, f.city, f.location, f.id_inv
									
									
								   FROM ".INVESTORS." i 
								   INNER JOIN ".INVESTOR_FRANCHISE." f ON f.id_inv = i.inv_id
								   WHERE i.inv_id = '".cleanvars($_GET['id'])."'
								   AND i.inv_status = '1'  LIMIT 1");

	$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div id="franchies" class="tab-pane">
	<form action="#" class="form-horizontal validate" method="post" accept-charset="utf-8">
 <input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<fieldset class="mb-md mt-md">
			
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
					<input type="text" class="form-control" name="city['.$i.']" id="city['.$i.']" value="'.$rowsvalues['city'].'" required title="Must Be Required"/>
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
						<input type="text" class="form-control" name="location['.$i.']" id="location['.$i.']" value="'.$rowsvalues['location'].'" required title="Must Be Required"/>
					</div>
				</div>
		  	</div>
		  </td>
	  </tr>';
	}
	echo'
	</tbody>
</table>
  
	
 
<div>
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part D</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Preference of school type</b></span>
	</h4>
	<br>
	
<div class="col-md-12 row mt-sm">
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
						  if($valuecls['level_id'] == $rowsvalues['id_type']) { 
							  echo '<option value="'.$valuecls['level_id'].'" selected>'.$valuecls['level_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['level_id'].'">'.$valuecls['level_name'].'</option>';
						  }
					  }
			  echo '
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Purposeful Building / Buildings <span class="required">*</span></label>
			<input type="text" class="form-control" name="purposeful_building" id="purposeful_building" value="'.$rowsvalues['purposeful_building'].'" required title="Must Be Required"/>
		</div>
	</div>
</div>
<div class="col-md-12 row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Total Area <span class="required">*</span></label>
			<input type="text" class="form-control" name="" id="" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Number of Rooms <span class="required">*</span></label>
			<input type="text" class="form-control" name="rooms" id="rooms"  value="'.$rowsvalues['rooms'].'" required title="Must Be Required"/>
		</div>
	</div>
</div>
	<div class="form-group">
		<label class="col-sm-3  mt-sm control-label">You intend to open <span class="required">*</span></label>
		<div class="col-md-9 mt-sm">';
		
		
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
<br>

 <div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part D-1</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Property Status</b></span>
	</h4>
	<br>
	
<div class="col-md-12 row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">School building <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="school_building">
							<option value="'.$rowsvalues['school_building'].'">'.get_buildings($rowsvalues['school_building']).'</option>
							<option value="1">Owned</option>
							<option value="2">Rented</option>
							<option value="3">To be arranged</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Building type <span class="required">*</span></label>
			<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="building_type">
							<option value="'.$rowsvalues['building_type'].'">'.get_buildingtypes($rowsvalues['building_type']).'</option>
							<option value="1">Resdential</option>
							<option value="2">Commercial</option>
			</select>
		</div>
	</div>
</div>

<div class="col-md-12 row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Total Plot area (sq. ft.) <span class="required">*</span></label>
			<div class="input-group">
				<span class="input-group-addon">Covered</span>
				<input type="text" class="form-control valid" name="covered_area" id="covered_area" value="'.$rowsvalues['covered_area'].'" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
				<span class="input-group-addon">Uncovered</span>
				<input type="text" class="form-control" name="uncovered_area" id="uncovered_area" value="'.$rowsvalues['uncovered_area'].'" required="" title="Must Be Required"  aria-required="true">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Number of Rooms <span class="required">*</span></label>
			<input type="text" class="form-control" name="rooms" id="rooms"  value="'.$rowsvalues['rooms'].'" required title="Must Be Required"/>
		</div>
	</div>
</div>
			
<br><br><br><br><br><br><br><br>

  <div class="tab">
  	<br>
  	<h4 style="color: white;">
		<span style="background-color: black; padding: 5px 10px;"><b>Part E</b></span> 
		<span style="background-color: #cb3f44; padding: 5px 10px;"><b>Conversion of existing school </b></span>
	</h4>
	
	<div class="col-sm-12 mt-sm">
		<div class="form-group">
			<label class="control-label">Name of existing school <span class="required">*</span></label>
			<input type="text" class="form-control" name="existing_school_name" id="existing_school_name" value="'.$rowsvalues['existing_school_name'].'" required title="Must Be Required"/>
		</div>
	</div>
	
	<div class="col-sm-12 mt-sm">
		<div class="form-group">
			<label class="control-label">Address <span class="required">*</span></label>
			<textarea type="text" class="form-control" name="existing_school_add" id="existing_school_add" required title="Must Be Required">'.$rowsvalues['existing_school_add'].'</textarea>
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
						  if($valuecls['level_id'] == $rowsvalues['existing_school_type']) { 
							  echo '<option value="'.$valuecls['level_id'].'" selected>'.$valuecls['level_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['level_id'].'">'.$valuecls['level_name'].'</option>';
						  }
					  }
						echo '
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Medium Instruction <span class="required">*</span></label>
			<select class="form-control" data-width="100%" data-minimum-results-for-search="Infinity" name="existing_school_medium">
				<option value="'.$rowsvalues['existing_school_medium'].'">'.get_mediumtypes($rowsvalues['existing_school_medium']).'</option>
				<option value="1">English</option>
				<option value="2">Urdu</option>
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
				<input type="text" class="form-control valid" name="male_students" id="male_students" required=""  value="'.$rowsvalues['male_students'].'" title="Must Be Required" aria-required="true" aria-invalid="false">
				<span class="input-group-addon">Female</span>
				<input type="text" class="form-control" name="female_students" id="female_students" required=""  value="'.$rowsvalues['female_students'].'" title="Must Be Required"  aria-required="true">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Total teachers <span class="required">*</span></label>
			<div class="input-group">
				<span class="input-group-addon">Male</span>
				<input type="text" class="form-control valid" name="male_teachers" id="male_teachers" value="'.$rowsvalues['male_teachers'].'" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
				<span class="input-group-addon">Female</span>
				<input type="text" class="form-control" name="female_teachers" id="female_teachers" value="'.$rowsvalues['female_teachers'].'" required="" title="Must Be Required"  aria-required="true">
			</div>
		</div>
	</div>
</div>
	<div class="col-sm-12 mt-sm">
		<div class="form-group">
			<label class="control-label">Fee structure <span class="required">*</span></label>
			<input type="text" class="form-control" name="fee_structure" id="fee_structure" value="'.$rowsvalues['fee_structure'].'" required title="Must Be Required"/>
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
			<input type="text" class="form-control" name="planned_investment" id="planned_investment" value="'.$rowsvalues['planned_investment'].'" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group ml-xs" style="margin-right: -45px;">
			<label class="control-label">Financing <span class="required">*</span></label>
			<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="financing_type">
				<option value="'.$rowsvalues['financing_type'].'">'.get_investypes($rowsvalues['financing_type']).'</option>
				<option value="1">Personal</option>
				<option value="2">Partnership</option>
				<option value="3">Bank loan</option>
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
			<textarea type="text" class="form-control" name="additional_info" id="additional_info" required title="Must Be Required">'.$rowsvalues['additional_info'].'</textarea>
		</div>
	</div>
		<br><br>
	<br><br>
</div>
<br>






			
		</fieldset>
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" name="franchise_info" id="franchise_info" class="btn btn-primary">Update Informatuon</button>
				</div>
			</div>
		</div>
	</form>
</div>';
?>