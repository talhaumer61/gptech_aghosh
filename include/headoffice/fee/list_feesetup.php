<?php 
// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'view' => '1'))){ 

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
	
	//-----------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT f.id, f.dated, f.id_class, f.id_section, f.id_session,
									c.class_name, cs.section_name, s.session_name
									FROM ".FEESETUP." f				   
									INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
									INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
									INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
									WHERE f.id != '' AND f.status = '1' AND f.is_deleted != '1'
									AND f.id_campus = '".$campus."'
									ORDER BY c.class_name");
	$srno = 0;
	//-----------------------------------------------------
	if(mysqli_num_rows($sqllms) > 0)
	{
		echo'
		<section class="panel panel-featured panel-featured-primary">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-list"></i>  Feesetup List</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
				<thead>
					<tr>
						<th class="center" width="70">#</th>
						<th>Session</th>
						<th>Class</th>
						<th>Section</th>
						<th>Fee</th>
					</tr>
				</thead>
				<tbody>';
					while($rowsvalues = mysqli_fetch_array($sqllms)) {

						//-----------------------------------------------------
						$srno++;
						$sqllmstotal	= $dblms->querylms("SELECT SUM(amount) as total_fee
														FROM ".FEESETUPDETAIL."   
														WHERE id_setup = '".$rowsvalues['id']."'  ");
						$value_total = mysqli_fetch_array($sqllmstotal);
						//-----------------------------------------------------
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['session_name'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td>'.$rowsvalues['section_name'].'</td>
							<td>'.$value_total['total_fee'].'</td>
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
	else
	{
		echo'
		<section class="panel panel-featured panel-featured-primary">
			<div class="panel-body">
				<h3 class="center text-danger">No Record Found!</h3>
			</div>
		</div>
		';
	}

}
// }
// else
//{
// 	header("Location: dashboard.php");
// }
?>