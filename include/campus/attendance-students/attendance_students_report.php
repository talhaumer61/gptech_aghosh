<?php	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'view' => '1'))){ 

	$class = 0;
	$section = 0;
	$month = 0;
	$sql2 = "";
    $std_gender = "";
	
	if(isset($_POST['view_attendance'])){
		$class = $_POST['id_class'];
		$section = $_POST['id_section'];
		$month = $_POST['month'];
		
        //  gender
        if($_POST['std_gender']){
            $sql2 = "AND s.std_gender = '".$_POST['std_gender']."'";
            $std_gender = $_POST['std_gender'];
        }
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
					<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<header class="panel-heading">
						<h2 class="panel-title">
							<i class="fa fa-list"></i> <span class="hidden-xs">Students Attendance Report			
						</h2>
					</header>
					<div class="panel-body">
						<div class="row mb-lg">
							<div class="col-md-4">
								<label class="control-label">Class <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" name="id_class" onchange="get_classsection(this.value)">
									<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
														FROM ".CLASSES."
														WHERE class_status = '1' AND is_deleted != '1'
														ORDER BY class_id ASC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
										if($valuecls['class_id'] == $class){
											echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
										}else{
											echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
										}
									}
								echo '
								</select>
							</div>
							<div id="getclasssection">
								<div class="col-sm-4">
									<div class="form-group">
										<label class="control-label">Section <span class="required">*</span></label>
										<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
											<option value="">Select</option>';
											$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
																FROM ".CLASS_SECTIONS."
																WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																AND section_status = '1' AND id_class = '".$class."' AND is_deleted != '1'
																ORDER BY section_name ASC");
											while($valuecls = mysqli_fetch_array($sqllmscls)) {
												if($valuecls['section_id'] == $section){
													echo '<option value="'.$valuecls['section_id'].'" selected>'.$valuecls['section_name'].'</option>';
												} else{
													echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
												}
		
											}
											echo '
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group"> 
									<label class="control-label">Month <span class="required">*</span></label>
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
							<div class="col-md-2">
								<label class="control-label">Gender </label>
								<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
									<option value="">Select</option>';
									foreach($gender as $gndr){
										echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
									}
									echo'
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-offset-5">
							<button type="submit" class="btn btn-primary" id="view_attendance" name="view_attendance">
								<i class="fa fa-check-square-o"></i> View Attendance
							</button>
						</div>
					</div>
					</form>
				</section>';
	
				if(isset($_POST['view_attendance'])){
					echo'
					<div id="" class="" style=" overflow: auto;">
						<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
							<form action="attendance_employees.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
								<header class="panel-heading">
									<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
										Students Attendance Report Of <b> '.get_monthtypes($month).' </b>
									</h2>
								</header>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-condensed mb-none ">
											<thead>
												<tr>
													<th style="width:40px; text-align: center;">#</th>
													<th width="40">Photo</th>
													<th style="text-align: center;">
														Students <i class="fa fa-hand-o-down"></i> |
														Date <i class="fa fa-hand-o-right"></i>
													</th>';
													$year = date('Y');
													// $days =  cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $year);
														for($i = 1; $i<=31; $i++) { 
															$datearray[] = $i;
														echo '<th style="text-align: center;">'.$i.'</th>';
													}
													echo'
												</tr>
											</thead>
											<tbody>';

												if($section != 0) { $sectionSQL = "AND s.id_section  = '".$section."'"; } else { $sectionSQL = ''; }
												$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_name, s.std_photo
																					FROM ".STUDENTS." s
																					WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  AND s.std_status  = '1'
																					AND s.id_class	  = '".$class."' $sectionSQL $sql2
																					AND s.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'");

												$srno = 0;
												while($rowsvalues = mysqli_fetch_array($sqllms)) {
													$srno++;
												
													if($rowsvalues['std_photo']) {
														$photo = 'uploads/images/students/'.$rowsvalues['std_photo'].'';
													} else {
														$photo = 'uploads/admin_image/default.jpg';
													}
													echo'
													<tr>
														<td style="width:40px; text-align: center;">'.$srno.'</td>
														<td class="center"> <img src="'.$photo.'" width="35" height="35"</td>
														<td>
															<b>'.$rowsvalues['std_name'].'</b>
														</td>';
														foreach($datearray as $date) {
															$sqlatten	= $dblms->querylms("SELECT a.dated, d.id_std, d.status 
																								FROM ".STUDENT_ATTENDANCE." a
																								INNER JOIN ".STUDENT_ATTENDANCE_DETAIL." d ON d.id_setup = a.id
																								WHERE a.id_campus 	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																								AND   a.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
																								AND   a.id_class	= '".$class."' AND   a.id_section = '".$section."' 
																								AND MONTH(a.dated) = '".$month."' AND DAY(a.dated) = '".$date."'
																								AND   d.id_std 	= '".$rowsvalues['std_id']."'
																							");
															if(mysqli_num_rows($sqlatten)) {
																$rowsatten = mysqli_fetch_array($sqlatten);
																$attStatus = get_attendtype($rowsatten['status']);
															} else {
																$attStatus = '';
															}
															echo'<td style="text-align: center;"> '.$attStatus.'  </td>';	
														}
														echo'
													</tr>';
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
			echo'
			</div>
		</div>
	</section>';
} else {
	header("Location: dashboard.php");
}
 ?>
<script type="text/javascript">
 function get_classsection(id_class) {  
	 $("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
	 $.ajax({  
		 type: "POST",  
		 url: "include/ajax/get_classsection.php",  
		 data: "id_class="+id_class,  
		 success: function(msg){  
			 $("#getclasssection").html(msg); 
			 $("#loading").html(''); 
		 }
	 });  
 }
 </script>