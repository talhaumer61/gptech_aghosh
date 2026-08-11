<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.inv_id, i.inv_status,
								   v.school_name, v.no_of_students, v.fee_structure
									
								   FROM ".INVESTOR_VICINITY." v
								   INNER JOIN ".INVESTORS." i ON i.inv_id = v.id_inv
								   WHERE i.inv_id = '".cleanvars($_GET['id'])."'
								   AND v.id_inv = i.inv_id  LIMIT 1");

	$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div id="others" class="tab-pane">
	<form action="#" class="form-horizontal validate" method="post" accept-charset="utf-8">
		<fieldset class="mb-md mt-md">
				 
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
			  		<input type="text" class="form-control" name="school_name['.$i.']" id="school_name['.$i.']"  value="'.$rowsvalues['school_name'].'" required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="no_of_students['.$i.']" id="no_of_students['.$i.']" value="'.$rowsvalues['no_of_students'].'"  required title="Must Be Required"/>
				</div>
		  	</div>
		  </td>
		  <td>
		  	<div class="form-group mt-sm">
				<div class="col-md-12">
			  		<input type="text" class="form-control" name="fee_structure['.$i.']" id="fee_structure['.$i.']" value="'.$rowsvalues['fee_structure'].'"  required title="Must Be Required"/>
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
		</fieldset>
	<div class="panel-footer">
			<div class="row">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" name="vicinity_info" id="vicinity_info" class="btn btn-primary">Update Informatuon</button>
				</div>
			</div>
		</div>
	</form>
</div>';
?>