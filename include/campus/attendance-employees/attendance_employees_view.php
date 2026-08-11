<?php	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56'))){ 	
error_reporting(0);	
//-------------------------------
 $today = date("Y-m-d");
//-------------------------------
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" autocomplete="off"  method="post" accept-charset="utf-8">
		<header class="panel-heading">
			<h2 class="panel-title">
				<i class="fa fa-list"></i> <span class="hidden-xs">Employees Attendance			
			</h2>
		</header>
		<div class="panel-body">
			<div class="row mb-lg">
				<div class="col-md-5 col-sm-offset-3">
					<div class="input-group">
						<input type="text"  name="dated" class="form-control" required title="Must Be Required" data-plugin-datepicker name="dated" value="'.$_POST['dated'].'"/>
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-offset-3 text-center">';
				//----------- TEXT FOR EDIT ATTENADNCE ----------------
				if(isset($_POST['dated']) && isset($_POST['edit_attendance']) && date("Y-m-d", strtotime($_POST['dated'])) != $today)
					{echo'<p class="text text-danger">You\'re not allowed to edit attendance</p>';}
				//----------- ADD ATTENADNCE ----------------
				if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'add' => '1'))){ 	
				echo'
					<button type="submit" class="btn btn-primary" id="mark_attendance" name="mark_attendance">
						<i class="fa fa-check-square-o"></i> Mark Attendance
					</button>';
				}
				//----------- EDIT ATTENADNCE ----------------
				if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'edit' => '1'))){ 	
				echo'
					<button type="submit" class="btn btn-primary" id="edit_attendance" name="edit_attendance">
						<i class="glyphicon glyphicon-edit"></i> Edit Attendance
					</button>';
				}
				echo'
			</div>
		</div>
	</form>
</section>
';

//------------------ ADD ATTENADNCE ------------------------
if(isset($_POST['mark_attendance'])){
	
echo'
<div id="" class="" style=" overflow: auto;">
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<form action="attendance_employees.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title">
					<i class="fa fa-users"></i> <span class="hidden-xs">Employees List				</h2>
			</header>
			<div class="panel-body">';
//-----------------------------------------------------
                        $sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_status, e.emply_photo, e.emply_name, e.id_designation,
														   e.emply_email, e.id_dept, e.id_campus,
														   d.designation_id, d.designation_status, d.designation_name
								   FROM ".EMPLOYEES." e
								   	INNER JOIN ".DESIGNATIONS." d ON d.designation_id = e.id_designation
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND e.emply_status = '1'
								   ");
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
echo'
				<div class="text-right mb-md">
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_present()"><i class="fa fa-check"></i><span class="hidden-xs"> Set All Present</span></button>
						
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_absent()"><i class="fa fa-close"></i><span class="hidden-xs"> Set All Absent</span></button>
						
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_holiday()"><i class="fa fa-power-off"></i><span class="hidden-xs"> Set All Holiday</span></button>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed mb-none ">
						<thead>
							<tr>
								<th style="width:40px; text-align: center;">#</th>
								<th width="80">Photo</th>
								<th>Name </th>
								<th>Designatiopn </th>
								<th>Email </th>
								<th width="40%">Status </th>
							</tr>
						</thead>
						<tbody>';
							//-----------------------------------------------------
							$srno = 0;
							//-----------------------------------------------------
							while($rowsvalues = mysqli_fetch_array($sqllms)) {
							//-----------------------------------------------------
							$srno++;
							echo'
							<tr>
								<td style="width:40px; text-align: center;">'.$srno.'</td>
								<td class="center"> <img src="uploads/images/employees/'.$rowsvalues['emply_photo'].'" width="35" height="35"</td>                                 
                                 <input type="hidden" name="dept_ID['.$srno.']" id="dept_ID['.$srno.']" value="'.$rowsvalues['id_dept'].'">
                                 <input type="hidden" name="emply_ID['.$srno.']" id="emply_ID['.$srno.']" value="'.$rowsvalues['emply_id'].'">
                                
                                <td>'.$rowsvalues['emply_name'].'</td>
								<td>'.$rowsvalues['designation_name'].'</td>
								<td>'.$rowsvalues['emply_email'].'</td>
								<td>
                                   <div class="radio-custom radio-success radio-inline">
										<input type="radio" value="1" name="arr['.$srno.']" id="pstatus_'.$srno.'">
										<label for="pstatus_'.$srno.'">Present</label>
									</div>
									<div class="radio-custom radio-danger radio-inline">
										<input type="radio" value="2"  name="arr['.$srno.']" id="astatus_'.$srno.'">
										<label for="astatus_'.$srno.'">Absent</label>
                                   	</div>
									<div class="radio-custom radio-info radio-inline">
										<input type="radio" value="3"  name="arr['.$srno.']" id="hstatus_'.$srno.'">
										<label for="hstatus_'.$srno.'">Holiday</label>
                                    </div>
									<div class="radio-custom radio-inline">
										<input type="radio" value="4"  name="arr['.$srno.']" id="lstatus_'.$srno.'">
										<label for="lstatus_'.$srno.'">Late</label>
                                    </div>	
								</td>
							</tr>
							';
							
}
							echo'
							<input type="hidden" name="employees" value="'.$srno.'">
							<input type="hidden" name="dated" value="'.$_POST['dated'].'">					
						</tbody>
					</table>
					</div>
			</div>
			<div class="panel-footer">
				<center>
					<button type="submit" class="btn btn-primary" id="submit_attendance" name="submit_attendance">
						<i class="fa fa-save"></i> Add Attendance</button>
				</center>
			</div>';
	}else{
	echo '<h2 class="center">No Employee Found!</h2>';
	}
	echo'
            </form>
			</section>
        </div>
';
 }

//------------------- EDIT ATTENDANCE ---------------------------
if(isset($_POST['edit_attendance'])){
	if(date("Y-m-d", strtotime($_POST['dated'])) == $today){
echo'
<div id="" class="" style=" overflow: auto;">
	<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
		<form action="attendance_employees.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">';
			//-----------------------------------------------------
			$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
			//-----------------------------------------------------
			$sqllms	= $dblms->querylms("SELECT e.id, e.status, e.dated, e.id_session, e.id_campus,
												d.id_setup, d.id_emply, d.status,
												em.emply_id, em.emply_name, em.emply_photo, em.emply_email
											FROM ".EMPLOYEES_ATTENDCE." e
											INNER JOIN ".EMPLOYEES_ATTENDCE_DETAIL." d ON d.id_setup = e.id 
											INNER JOIN ".EMPLOYEES." em ON em.emply_id = d.id_emply
											
											WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
											AND e.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."' 
											AND e.dated = '".$dated."'
											");
			//-----------------------------------------------------
			if(mysqli_num_rows($sqllms) > 0){
				echo'
				<header class="panel-heading">
					<h2 class="panel-title">
						<i class="fa fa-users"></i> <span class="hidden-xs">Employees List				</h2>
				</header>
				<div class="panel-body">
					<div class="table-responsive mt-sm">
						<table class="table table-bordered table-striped table-condensed mb-none ">
							<thead>
								<tr>
									<th style="width:40px; text-align: center;">#</th>
									<th width="60">Photo</th>
									<th>Name </th>
									<th>User Type </th>
									<th>Email </th>
									<th width="40%">Status </th>
								</tr>
							</thead>
							<tbody>';
							//-----------------------------------------------------
							$srno = 0;
							//-----------------------------------------------------
							while($rowsvalues = mysqli_fetch_array($sqllms)) {
							//-----------------------------------------------------
							$srno++;
								echo'
								<input type="hidden" name="id" value="'.$rowsvalues['id'].'">
								<tr>
									<td style="width:40px; text-align: center;">'.$srno.'</td>
									<td class="center"> <img src="uploads/images/employees/'.$rowsvalues['emply_photo'].'" width="35" height="35"</td>    
									<input type="hidden" name="emply_ID['.$srno.']" id="emply_ID['.$srno.']" value="'.$rowsvalues['id_emply'].'">
									
									<td>'.$rowsvalues['emply_name'].'</td>
									<td>Permanent</td>
									<td>'.$rowsvalues['emply_email'].'</td>
									<td>
										<div class="radio-custom radio-success radio-inline">
											<input type="radio" id="arr['.$srno.']" name="arr['.$srno.']" value="1"'; if($rowsvalues['status'] == 1) {echo' checked';}echo'>
											<label for="pstatus_'.$srno.'">Present</label>
										</div>
										<div class="radio-custom radio-danger radio-inline">
											<input type="radio" id="arr['.$srno.']" name="arr['.$srno.']" value="2"'; if($rowsvalues['status'] == 2) {echo' checked';}echo'>
											<label for="astatus_'.$srno.'">Absent</label>
										</div>
										<div class="radio-custom radio-info radio-inline">
											<input type="radio" id="arr['.$srno.']" name="arr['.$srno.']" value="3"'; if($rowsvalues['status'] == 3) {echo' checked';}echo'>
											<label for="hstatus_'.$srno.'">Holiday</label>
										</div>
										<div class="radio-custom radio-inline">
											<input type="radio" id="arr['.$srno.']" name="arr['.$srno.']" value="4"'; if($rowsvalues['status'] == 4) {echo' checked';}echo'>
											<label for="lstatus_'.$srno.'">Late</label>
										</div>
									</td>
								</tr>';
							}
								echo'
								<input type="hidden" name="employees" value="'.$srno.'">
								<input type="hidden" name="dated" value="'.$_POST['dated'].'">					
							</tbody>
						</table>
					</div>
				</div>

				<div class="panel-footer">
					<center>
						<button type="submit" class="btn btn-primary" id="update_attendance" name="update_attendance">
							<i class="fa fa-save"></i> Update Attendance</button>
					</center>
				</div>';
			}else{
			echo '
				<div class="panel-body">
					<h2 class="center">No Record Found!</h2>
				</div>';
			}
			echo'
        </form>
	</section>
</div>
		';
		
 }}
//---------------- EDIT END ------------------------
}else{
	header("Location: dashboard.php");
}
 ?>