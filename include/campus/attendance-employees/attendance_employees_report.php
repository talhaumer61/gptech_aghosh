<?php	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'view' => '1'))){ 
error_reporting(0);

$month = $_POST['month'];
$dept = $_POST['dept'];
$sql2 = "";
$emply_gender = "";

if(isset($_POST['view_attendance'])){
	//  gender
	if(isset($_POST['emply_gender']) && !empty($_POST['emply_gender'])){
		$sql2 = "AND e.emply_gender = '".$_POST['emply_gender']."'";
		$emply_gender = $_POST['emply_gender'];
	}
	
	$sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_gender, e.emply_status, e.emply_photo, e.emply_name, e.id_designation,
	e.emply_email, e.id_campus,
	d.designation_id, d.designation_status, d.designation_name
								FROM ".EMPLOYEES." e
								INNER JOIN ".DESIGNATIONS." d ON d.designation_id = e.id_designation
								WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								AND  e.id_dept = '".$dept."' AND e.emply_status = '1' $sql2 ");
	$srno = 0;
}

echo'
<title> Attendance Panel | '.TITLE_HEADER.'</title>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Attendance Panel </h2>
	</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form action="attendance_employeesreport.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<header class="panel-heading">
					<h2 class="panel-title">
						<i class="fa fa-list"></i> <span class="hidden-xs">Employees Attendance	Report		
					</h2>
				</header>
				<div class="panel-body">
					<div class="row mb-lg">
						<div class="col-md-4">
							<div class="input-group"> 
								<label class="control-label">
									Department <span class="required">*</span>
								</label>
								<select name="dept" class="form-control"  data-plugin-selectTwo data-width="100%" required>
									<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT dept_id, dept_name 
																FROM ".DEPARTMENTS."
																WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																ORDER BY dept_name ASC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
										if($valuecls['dept_id'] == $dept) { 
											echo '<option value="'.$valuecls['dept_id'].'" selected>'.$valuecls['dept_name'].'</option>';
										} else { 
											echo '<option value="'.$valuecls['dept_id'].'">'.$valuecls['dept_name'].'</option>';
										}
									}
									echo '
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group"> 
								<label class="control-label">
									Month <span class="required">*</span>
								</label>
								<select name="month" class="form-control"  data-plugin-selectTwo data-width="100%" required>
								
									<option>Select Month</option>';
										foreach($monthtypes as $listtype) 
										{ 
											if($month == $listtype['id']){
												echo '<option value="'.$listtype['id'].'" selected>'.$listtype['name'].'</option>';
											}else{
												echo '<option value="'.$listtype['id'].'">'.$listtype['name'].'</option>';
											}
											
										}
									echo'
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label class="control-label">Gender </label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" name="emply_gender">
								<option value="">Select</option>';
								foreach($gender as $gndr){
									echo '<option value="'.$gndr.'"'; if($emply_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
								}
								echo'
							</select>
						</div>
					</div>
					<div class="col-md-3 col-sm-offset-5">
						<button type="submit" class="btn btn-primary" id="view_attendance" name="view_attendance">
							<i class="fa fa-check-square-o"></i> View Attendance
						</button>
					</div>
				</div>
				</form>
			</section>';

			if(mysqli_num_rows($sqllms) > 0){
				echo'
				<div id="" class="" style=" overflow: auto;">
					<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
						<form action="attendance_employees.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<header class="panel-heading">
								<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
									Employees  Attendance Report Of <b>'.get_monthtypes($month).'</b> 
								</h2>
							</header>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-condensed mb-none ">
										<thead>
											<tr>
												<th style="width:40px; text-align: center;">#</th>
												<th style="text-align: center;">Photo</th>
												<th> Employees <i class="fa fa-hand-o-down"></i> | Date <i class="fa fa-hand-o-right"></i>
												</th>';
												// $days =  cal_days_in_month(CAL_GREGORIAN, $_POST['month'], 2020);
													for($i = 1; $i<=31; $i++) { 
														$datearray[] = $i;
													echo '<th style="text-align: center;">'.$i.'</th>';
												}
												echo'
											</tr>
										</thead>
										<tbody>';
											while($rowsvalues = mysqli_fetch_array($sqllms)){
												$srno++;
												if($rowsvalues['std_photo']) {
													$photo = 'uploads/images/employees/'.$rowsvalues['emply_photo'].'';
												} else {
													$photo = 'uploads/admin_image/default.jpg';
												}
												echo'
												<tr>
													<td style="width:40px; text-align: center;">'.$srno.'</td>
													<td class="center"><img src="'.$photo.'" width="35" height="35"></td>
													<td>
														<b>'.$rowsvalues['emply_name'].'</b>
														<span class="ml-sm label label-primary"> '.$rowsvalues['designation_name'].'</span>
													</td>';
													//-----------------------------------------------------
													foreach($datearray as $date) {
													//-----------------------------------------------------
													$sqlatten	= $dblms->querylms("SELECT *
																						FROM ".EMPLOYEES_ATTENDCE." a
																						INNER JOIN ".EMPLOYEES_ATTENDCE_DETAIL." d ON d.id_setup = a.id
																						WHERE a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																						AND a.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
																						AND MONTH(a.dated) = '".$month."' AND DAY(a.dated) = '".$date."'
																						AND a.id_session = '1' AND d.id_emply = '".$rowsvalues['emply_id']."'
																					");
													//-----------------------------------------------------
													$rowsatten = mysqli_fetch_array($sqlatten);
																					echo'<td style="text-align: center;"> '. get_attendtype($rowsatten['status']).' </td>';
													//-----------------------------------------------------							
													}
													//-----------------------------------------------------
																					echo'
																				</tr>
																				';
																				
											}
											echo'				
										</tbody>
									</table>
								</div>
							</div>
							<!-- <div class="panel-footer">
								<div class="text-right">
									<a href="attendance/employees_report_print/1/b" class="btn btn-sm btn-primary " target="_blank">
									<i class="glyphicon glyphicon-print"></i> Print			</a>
								</div>
							</div> -->
						</form>
					</section>
				</div>';
			}
			else{
				echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
			}
			echo'
		</div>
	</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
 ?>