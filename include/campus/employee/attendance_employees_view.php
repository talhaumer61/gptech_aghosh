<?php		
echo '
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h2 class="panel-title fa fa-list">
			Employee Attendance	</h2>
	</header>
	<div class="panel-body">
		<div class="row mb-lg">
			 <div class="col-md-2"></div>
			 <div class="col-md-8">
							<div class="input-group">
							    <input type="text" class="form-control" required title="Must Be Required" data-plugin-datepicker autocomplete="off" name="dated" value="'.$_POST['dated'].'"/>
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						
			 <div class="col-md-2"></div>
		</div>
		
				<div class="col-md-6 col-sm-offset-4">
					<button type="submit" class="btn btn-primary" id="mark_attendance" name="mark_attendance">
						<i class="fa fa-search"></i> Mark Attendance
					</button>
			
					<button type="submit" class="btn btn-primary" id="edit_attendance" name="edit_attendance">
						<i class="glyphicon glyphicon-edit"></i> Edit Attendance
					</button>
                </div>
	</div>
	</form>
</section>';
if(isset($_POST['mark_attendance'])){
echo '
<div id="" class="" style="height: 0px;">
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<form action="attendance-employees_control.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title">
					<i class="fa fa-users"></i> <span class="hidden-xs">Employees List</h2>
			</header>
			</header>
			<div class="panel-body">
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
								<th width="80">Photo</th>
								<th>Name </th>
								<th>User Type </th>
								<th>Email </th>
								<th width="40%">Status </th>
							</tr>
						</thead>
						<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT e.emply_photo, e.emply_name, e.id_dept, e.emply_email, e.emply_id
								FROM ".EMPLOYEES." e
								WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
						echo '
							<tr>
								<td>'.$srno.'</td>
								<td class="center"> <img src="'.$rowsvalues['emply_photo'].'" width="35" height="35" /> </td>
								<input type="hidden" value="'.$rowsvalues['emply_id'].'" name="id_emply['.$srno.']" id="id_emply['.$srno.']">
								<input type="hidden" value="'.$rowsvalues['id_dept'].'" name="id_dept['.$srno.']" id="id_dept['.$srno.']">
                                <td>'.$rowsvalues['emply_name'].'</td>
								<td>Permanent</td>
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
							</tr>';
							
}
					echo '							
						</tbody>
					</table>
				</div>
			</div>

			<div class="panel-footer">
				<center>
					<button type="submit" class="btn btn-info" id="submit_attendance" name="submit_attendance">
						<i class="fa fa-save"></i> Mark Attendance</button>
				</center>
			</div>
            </form>
			</section>
        </div>';
 }
 else{

 }
 ?>