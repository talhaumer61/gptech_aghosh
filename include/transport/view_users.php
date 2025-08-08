<?php
error_reporting(0);
$route_name = $_POST['route'];
$vehicle_no = $_POST['vehicle'];		
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="transport_users.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<a href="#make_subject" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add User</a>
		<h2 class="panel-title fa fa-list">
			Transport Users		
		</h2>
	</header>
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Route Name <span class="required">*</span></label>
								<select id="route"  name="route" data-plugin-selectTwo data-width="100%" required title="Must Be Required" class="form-control populate">
                            	<option value="">Select</option>';
                                $sqllms	= $dblms->querylms("SELECT r.route_id, r.route_name
								   FROM ".ROUTES." r  
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY r.route_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									   if($rowsvalues['route_id'] == $route_name){
										  echo'<option value="'.$rowsvalues['route_id'].'" selected>'.$rowsvalues['route_name'].'</option>';
										}else{
										  echo'<option value="'.$rowsvalues['route_id'].'">'.$rowsvalues['route_name'].'</option>';
										}
								   }
								echo'
								</select>
							</div>
						</div>
			 <div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Vehicle Number <span class="required">*</span></label>
								<select id="vehicle"  name="vehicle" data-plugin-selectTwo data-width="100%" required title="Must Be Required" class="form-control populate">
                            		<option value="">Select</option>';
                                $sqllms	= $dblms->querylms("SELECT v.vehicle_id, v.vehicle_no
								   FROM ".VEHICLES." v 
								   WHERE v.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY vehicle_no ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									   if($rowsvalues['vehicle_id'] == $vehicle_no){
										   echo'<option value="'.$rowsvalues['vehicle_id'].'" selected>'.$rowsvalues['vehicle_no'].'</option>';
										   }else{
											   echo'<option value="'.$rowsvalues['vehicle_id'].'">'.$rowsvalues['vehicle_no'].'</option>';
											   }
								   }
								   echo'
									</select>
							</div>
						</div>
                        
		</div>
		<center>
			<button type="submit" name="view_users" id="view_users" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form></section>
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	';
    if(isset($_POST['view_users'])){
	echo'
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-users"></i> 
			Transport Users List
		</h2>
	</header>
    
	<div class="panel-body">
				<div class="table-responsive mt-sm mb-md">
					<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
						<thead>';
	

  //-----------------------------------------
  echo'

							<tr>
								<th width:"40">#</th>
								<th>Route</th>
								<th>Vehicle</th>
								<th>User Reg no</th>
								<th>User Name</th>
								<th>User Type</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Fare</th>
								<th width="40">Status </th>
								<th width="90">Options </th>
							</tr>
						</thead>
						<tbody>';

    //-----------------------------------------
  $sqllmss	= $dblms->querylms("SELECT 
										t.id, t.status, t.id_route, t.id_vehcile, t.user_type, t.id_user,
										t.date_start, t.date_end, t.fare, t.id_campus,
										r.route_id, r.route_status, r.route_name,
										v.vehicle_id, v.vehicle_status, v.vehicle_no,
										e.emply_id, e.emply_status, e.emply_regno, e.emply_name 
	 									
										FROM ".TRANSPORT_TRANSACTION." t
										
										INNER JOIN ".ROUTES." 	 r ON r.route_id   = t.id_route
										INNER JOIN ".VEHICLES."	 v ON v.vehicle_id = t.id_vehcile
										INNER JOIN ".EMPLOYEES." e ON e.emply_id   = t.id_user
										WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
	 									AND t.status = '1'
										AND r.route_status = '1'
										AND v.vehicle_status = '1'
										AND e.emply_status = '1' 
										ORDER BY r.route_name ASC ");
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
								<td>'.$rowsvalues['route_name'].'</td>
								<td>'.$rowsvalues['vehicle_no'].'</td>
								<td>'.$rowsvalues['emply_regno'].'</td>
                                <td>
									 '.$rowsvalues['std_firstname'].' '.$rooowsvalues['std_lastname'].'
									 '.$rowsvalues['emply_name'].'
								</td>
								<td>'.get_usertype($rowsvalues['user_type']).'</td>
								<td>'.$rowsvalues['date_start'].'</td>
								<td>'.$rowsvalues['date_end'].'</td>
								<td>'.$rowsvalues['fare'].'</td>
								<td>'.get_payments($rowsvalues['status']).'</td>
								<td>
									<a href="include/marks/marks_sheetprint.php" class="btn btn-primary btn-xs" target="include/marks/marks_sheetprint.php"><i class="fa fa-print"></i></a>
									<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/class/modal_classsubjects_update.php?id='.$rowsvalues['subject_id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>
									<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'classsubjects.php?deleteid='.$rowsvalues['subject_id'].'\');"><i class="el el-trash"></i></a>
	
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
		<div class="text-right">
			<a href="include/marks/marks_sheetprint.php" class="btn btn-sm btn-primary " target="include/marks/marks_sheetprint.php">
				<i class="glyphicon glyphicon-print"></i> Print
			</a>
		</div>
	</div>

</section>';
?>