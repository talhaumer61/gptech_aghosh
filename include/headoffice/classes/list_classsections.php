<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '6', 'view' => '1'))){
//-----------------------------------------------
if(isset($_POST['campus'])){$campus = $_POST['campus'];}
if(isset($_POST['class'])){$clss = $_POST['class'];}
//-----------------------------------------------
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Campuses Class Sections</h2>
	</header>
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-6">
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
			 <div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Class <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" name="class" id="class" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
					$sqllms	= $dblms->querylms("SELECT c.class_id, c.class_name
						FROM ".CLASSES." c  
						WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
						ORDER BY c.class_name ASC");
						while($rowsvalues = mysqli_fetch_array($sqllms)){
							if($rowsvalues['class_id'] == $clss){
								echo'<option value="'.$rowsvalues['class_id'].'" selected>'.$rowsvalues['class_name'].'</option>';
								}else{
									echo'<option value="'.$rowsvalues['class_id'].'">'.$rowsvalues['class_name'].'</option>';
									}
						}
						echo'
						</select>
				</div>
			</div>
		</div>
		<center>
			<button type="submit" name="view_section" id="view_section" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------------
if(isset($_POST['view_section'])){
//-----------------------------------------------------	
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Section List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Section Name</th>
		<th>Section Strength</th>
		<th>Class Name</th>
		<th width="70px;" style="text-align:center;">Status</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sec.section_id, sec.section_name, sec.section_strength, sec.id_class, sec.section_status,
									c.class_id, c.class_name
								FROM ".CLASS_SECTIONS." sec
								INNER JOIN ".CLASSES." c ON c.class_id = sec.id_class
								WHERE sec.section_id != '' AND sec.id_campus = '".$campus."' AND sec.id_class = '".$clss."'
								ORDER BY sec.section_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['section_strength'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['section_status']).'</td>';
echo '
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>';
}//isset ends
}
else{
	header("Location: dashboard.php");
}
?>