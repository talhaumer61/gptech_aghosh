<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'add' => '1'))){ 	
error_reporting(0);	
//-----------------------------------------------
if(isset($_POST['id_class'])){$class = $_POST['id_class'];}else{$class = "";}
if(isset($_POST['id_section'])){$section = $_POST['id_section'];}else{$section = "";}
//-----------------------------------------------
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">
		<header class="panel-heading">
			<h2 class="panel-title">
				<i class="fa fa-list"></i> <span class="hidden-xs">Students Attendance			
			</h2>
		</header>
		<div class="panel-body">
			<div class="row mb-lg">

				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label">Date <span class="required">*</span></label>
						<input type="text" class="form-control" name="dated" id="dated" required title="Must Be Required" data-plugin-datepicker name="dated" value="'.$_POST['dated'].'" >
					</div>
				</div>
				<div class="col-md-4">
					<label class="control-label">Class <span class="required">*</span></label>
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" onchange="get_classsection(this.value)">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
												FROM ".CLASSES."
												WHERE class_status = '1' 
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
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section" required>
								<option value="">Select</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-offset-5">';
				if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'add' => '1'))){ 	
				echo'
				<button type="submit" class="btn btn-primary ml-lg" id="mark_attendance" name="mark_attendance">
					<i class="fa fa-check-square-o"></i> Mark Attendance
				</button>';
				}
				if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '56', 'edit' => '1'))){ 	
				echo'
					<button type="submit" class="btn btn-primary" id="edit_attendance" name="edit_attendance">
						<i class="glyphicon glyphicon-edit"></i> Edit Attendance
					</button>
				';
				}
				echo'
			</div>
		</div>
	</form>
</section>
';

 if(isset($_POST['mark_attendance'])){
echo'
<div id="" class="" style=" overflow: auto;">
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<form action="attendance_students.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title">
					<i class="fa fa-users"></i> <span class="hidden-xs">Students List			
				</h2>
			</header>
			<div class="panel-body">';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.std_id, s.std_status,  s.std_name, s.std_fathername, s.std_photo,
								   s.id_class, s.id_section, s.std_regno, s.id_session, s.id_campus	
								   FROM ".STUDENTS." s
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND s.std_status = '1' AND s.id_session = '1'
								   AND s.id_class = '".$class."' AND s.id_section = '".$section."'
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
								<th width="40">#</th>
								<th width="40">Photo</th>
								<th>Name </th>
								<th>Regno </th>
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
								<td>'.$srno.'</td>
								<td class="center"> <img src="uploads/images/students/'.$rowsvalues['std_photo'].'" width="35" height="35"</td>  
                                 <input type="hidden" name="std_ID['.$srno.']" id="std_ID['.$srno.']" value="'.$rowsvalues['std_id'].'">
                                
                                <td>'.$rowsvalues['std_name'].' '.$rowsvalues['std_fathername'].'</td>
								<td>'.$rowsvalues['std_regno'].'</td>
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
							<input type="hidden" name="students" value="'.$srno.'">	
							<input type="hidden" name="class" value="'.$_POST['id_class'].'">	
							<input type="hidden" name="section" value="'.$_POST['id_section'].'">	
							<input type="hidden" name="dated" value="'.$_POST['dated'].'">				
						</tbody>
					</table>
				</div>
			</div>

			<div class="panel-footer">
				<center>
					<button type="submit" class="btn btn-primary" id="submit_attendance" name="submit_attendance">
						<i class="fa fa-save"></i> Mark Attendance</button>
				</center>
			</div>';
	}else{
	echo '<h2 class="center">No Student Found!</h2>';
	}
	echo'
            </form>
			</section>
        </div>
';
 }
else if(isset($_POST['edit_attendance'])){
echo'
<div id="" class="" style=" overflow: auto;">
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<form action="attendance_students.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title">
					<i class="fa fa-users"></i> <span class="hidden-xs">Students List</h2>
			</header>
			<div class="panel-body">';
//-----------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//-----------------------------------------------------
  $sqllms	= $dblms->querylms("SELECT a.id, a.status, a.dated, a.id_class, a.id_section,
  									   a.id_session, a.id_campus, 
									   d.id_setup, d.id_std, d.status,
									   s.std_id, s.std_status, s.std_name,
									   s.std_fathername, s.std_regno, s.std_photo
								   FROM ".STUDENT_ATTENDANCE." a
								   INNER JOIN ".STUDENT_ATTENDANCE_DETAIL." d ON d.id_setup = a.id 
								   INNER JOIN ".STUDENTS." s ON s.std_id = d.id_std
								   
								   WHERE a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND a.id_session = '1' AND s.id_class = '".$_POST['id_class']."' 
								   AND s.id_section = '".$_POST['id_section']."' AND a.dated = '".$dated."' 
								   
								   ");
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
echo'
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed mb-none ">
						<thead>
							<tr>
								<th width="40"># </th>
								<th width="80">Photo</th>
								<th>Full Name </th>
								<th>Regno </th>
								<th width="40%">Status </th>
							</tr>
						</thead>
						<tbody>';
//-----------------------------------------------------
$srno = 0;
// ($rowsvalues = mysqli_fetch_array($sqllms));
// echo'';
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------

$srno++;
							echo'
							<input type="hidden" name="id" value="'.$rowsvalues['id'].'">
							<tr>
								<td>'.$srno.'</td>
								<td class="center"> <img src="uploads/images/students/'.$rowsvalues['std_photo'].'" width="35" height="35"</td> 
                                 <input type="hidden" name="std_ID['.$srno.']" id="std_ID['.$srno.']" value="'.$rowsvalues['id_std'].'">
                                
                                <td>'.$rowsvalues['std_name'].' '.$rowsvalues['std_fathername'].'</td>
								<td>'.$rowsvalues['std_regno'].'</td>
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
							</tr>
							';
							
}
							echo'
							<input type="hidden" name="class" value="'.$_POST['id_class'].'">	
							<input type="hidden" name="section" value="'.$_POST['id_section'].'">	
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
	echo '<h2 class="center">No Record Found!</h2>';
	}
	echo'
            </form>
			</section>
        </div>
		';
 }else{}
}
else{
	header("Location: dashboard.php");
}
 ?>