<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){ 
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
			<button type="submit" name="view_classroom" id="view_classroom" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_classroom'])){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i> Classroom List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Room No</th>
		<th>Room Capacity</th>
		<th width="70px;" style="text-align:center;">Status</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT cr.room_id,  cr.room_status, cr.room_no, cr.room_capacity
								   FROM ".CLASS_ROOMS." cr  
								   WHERE cr.room_id != '' AND cr.id_campus = '".cleanvars($campus)."'
								   ORDER BY cr.room_no ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['room_no'].'</td>
	<td>'.$rowsvalues['room_capacity'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['room_status']).'</td>
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
//isset ends
}
else{
	header("Location: dashboard.php");
}
?>