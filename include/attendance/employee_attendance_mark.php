<?php
error_reporting(0);
$examtype = $_POST['exm'];
$clss = $_POST['class'];	
$sction = $_POST['section'];		
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="attendance_employees.php" autocomplete="off" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h2 class="panel-title fa fa-list">
			Attendance List		</h2>
	</header>
		<div class="panel-body">
				<div class="row mb-sm">
					<div class="col-md-6 col-sm-offset-3">
						<div class="form-group">
							<center>
								<label class="control-label">
									Select Date <span class="required">*</span>
								</label>
							</center>
							<div class="input-group">
							    <input type="text" class="form-control" name="dated" id="dated" data-plugin-datepicker required title="Must Be Required"/>
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
		<center>
			<a class="accordion-toggle collapsed mb-xs mt-xs mr-xs btn btn btn-primary" data-toggle="collapse" data-parent="#emply_list" href="#emply_list" name="attendance_continue">
				<i class="fa fa-search"></i> Marking Attendance
			</a>
			<button type="submit" name="attendance_continue" id="attendance_continue" class="btn btn-primary"><i class="fa fa-search"></i> Continue</button>
		</center>
	</div>
	</form>
</section>';


    if(isset($_POST['attendance_continue'])){
echo'
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
<div id="emply_list" class="accordion-body collapse" style="height: 0px;">
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-users"></i> 
		Employee List</h2>
	</header>
    
	<div class="panel-body">
				<div class="text-right mb-md">
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_present()"><i class="fa fa-check"></i><span class="hidden-xs"> Set All Present</span></button>
						
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_absent()"><i class="fa fa-close"></i><span class="hidden-xs"> Set All Absent</span></button>
						
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_holiday()"><i class="fa fa-power-off"></i><span class="hidden-xs"> Set All Holiday						</span></button>
					</div>
				</div>
				<div class="table-responsive mt-sm mb-md">
					<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
						<thead>
							<tr>
								<th style="width:50px;">#</th>
								<th style="width:70px; text-align:center">Photo</th>
								<th>Employee Name</th>
								<th>Reg no.</th>
								<th>Department</th>
								<th>Status</th>	
							</tr>
						</thead>
						<tbody>';

    //-----------------------------------------
  $sqllmss	= $dblms->querylms("SELECT 
										e.emply_id, e.emply_status, e.emply_regno, e.emply_name, e.id_dept, e.emply_photo, e.id_campus,
										d.dept_id, d.dept_name
	 									FROM ".EMPLOYEES." e
										
								   		INNER JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept 
										WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
	 									AND e.emply_status = '1' 
										ORDER BY e.emply_name ASC");
$srno = 0;
while($rowsvalues = mysqli_fetch_array($sqllmss)){	
$srno++;	
  //-----------------------------------------				
	echo'
                              <tr>
								<td>'; 
									echo $srno;
								echo' 
								</td>
								<td>';
    								if($rowsvalues['emply_photo']) { 
    								echo'
    									<img src="uploads/images/employees/'.$rowsvalues['emply_photo'].'" style="width:40px; height:40px;">' ;
    								} else {
										echo "No Image";
									}
    							echo'
								</td>
								<td>'.$rowsvalues['emply_name'].'</td>
								<td>'.$rowsvalues['emply_regno'].'</td>
								<td>'.$rowsvalues['dept_name'].'</td>
								<td>
									<div class="radio-custom radio-success radio-inline">
										<input type="radio" value="1" name="" id="">
										<label for="">Present</label>
									</div>

									<div class="radio-custom radio-danger radio-inline">
										<input type="radio" value="2"  name="" id="">
										<label for="">Absent</label>
									</div>

									<div class="radio-custom radio-info radio-inline">
										<input type="radio" value="3"  name="" id="">
										<label for="">Holiday</label>
									</div>

									<div class="radio-custom radio-inline">
										<input type="radio" value="4"  name="" id="">
										<label for="">Late</label>
									</div>
								</td>
                              </tr>';
}				
echo'	
						</tbody>
					</table>
				</div>
			</div>
            ';
	}
echo'
	<div class="panel-footer">
		<center>
			<button type="submit" class="btn btn-primary" id="submit_attendce" name="submit_attendce">
			<i class="fa fa-save"></i> Mark Attendance</button>
		</center>
	</div>
</div>
</section>
';
?>