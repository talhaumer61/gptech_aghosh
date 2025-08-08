<?php
error_reporting(0);
$hstl_nm = $_POST['hstl_name'];
$room_nm = $_POST['room_name'];
?>
<form action="hostels-user.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<a href="hostels-student_add.php" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Add Students</a>
		<h2 class="panel-title">Select Field</h2>
	</header>
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Hostel Name <span class="required">*</span></label>
								<select name="hstl_name" data-plugin-selectTwo data-width="100%" id="hstl_name" required title="Must Be Required" class="form-control populate">
                            
							<?php echo'<option value="">Select</option>';?>
                                <?php
                                $sqllms	= $dblms->querylms("SELECT h.hostel_id, h.hostel_name
								   FROM ".HOSTELS." h  
								   WHERE h.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY h.hostel_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									  if($rowsvalues['hostel_id'] == $hstl_nm){
										  echo'<option value="'.$rowsvalues['hostel_id'].'" selected>'.$rowsvalues['hostel_name'].'</option>';
										  }
										  else{
											  echo'<option value="'.$rowsvalues['hostel_id'].'">'.$rowsvalues['hostel_name'].'</option>';
											  }
									   
								?>
																<?php
								   }
																?>
															</select>
							</div>
						</div>
			<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Room Name <span class="required">*</span></label>
								<select name="room_name" data-plugin-selectTwo data-width="100%" id="room_name" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
                                <?php
                                $sqllms	= $dblms->querylms("SELECT r.room_id, r.room_name
								   FROM ".HOSTEL_ROOMS." r  
								   WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY r.room_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									   if($rowsvalues['room_id'] == $room_nm){
										   echo'<option value="'.$rowsvalues['room_id'].'" selected>'.$rowsvalues['room_name'].'</option>';
										   }else{
											   echo'<option value="'.$rowsvalues['room_id'].'">'.$rowsvalues['room_name'].'</option>';
											   }
									    
								?>
																<?php
								   }
																?>
															</select>
							</div>
						</div>
		</div>
		<center>
			<button type="submit" name="srch_hstl_usr" id="srch_hstl_usr" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
		</center>
	</div>
</section>
</form>
<?php
error_reporting(0);
if(isset($_POST['srch_hstl_usr'])) {
$sqllmss	= $dblms->querylms("SELECT s.std_firstname, s.std_rollno, c.class_name, h.hostel_name, ty.type_name, r.room_name, r.room_bedfee, cs.section_name, ht.id
					   FROM ".HOSTEL_TRANSACTION." ht
					   INNER JOIN ".STUDENTS." s ON s.std_id = ht.id_user
					   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
					   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = s.id_section
					   INNER JOIN ".HOSTELS." h ON h.hostel_id = ht.id_hostel
					   INNER JOIN ".HOSTEL_TYPES." ty ON ty.type_id = h.id_type
					   INNER JOIN ".HOSTEL_ROOMS." r ON r.room_id = ht.id_room
					   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
					   AND
					   ht.id_hostel LIKE '%".$hstl_nm."%' AND ht.id_room LIKE '%".$room_nm."%'
					   ");
}
else{
$sqllmss	= $dblms->querylms("SELECT s.std_firstname, s.std_rollno, c.class_name, h.hostel_name, ty.type_name, r.room_name, r.room_bedfee, cs.section_name, ht.id
					   FROM ".HOSTEL_TRANSACTION." ht
					   INNER JOIN ".STUDENTS." s ON s.std_id = ht.id_user
					   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
					   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = s.id_section
					   INNER JOIN ".HOSTELS." h ON h.hostel_id = ht.id_hostel
					   INNER JOIN ".HOSTEL_TYPES." ty ON ty.type_id = h.id_type
					   INNER JOIN ".HOSTEL_ROOMS." r ON r.room_id = ht.id_room
					   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
				");
	}
?>
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-user-circle" aria-hidden="true"></i> Student List</h2>
</header>
<div class="panel-body">
<div class="table-responsive mt-sm mb-md">
<table class="table table-bordered table-striped table-condensed mb-none" id="multi-form">
<thead>
	<tr>
		<th width="50px">#</th>
		<th>Student Name</th>
		<th>Roll</th>
		<th>Class</th>
		<th>Hostel Name</th>
		<th>Hostel Type</th>
		<th>Room Name</th>
		<th>Hostel Fee</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
<?php
$srno = 0;
while($rowsvaluess = mysqli_fetch_array($sqllmss)){
$srno++;
?>
<tr>
	<td><?php echo $srno; ?></td>
	<td><?php echo $rowsvaluess['std_firstname']; ?></td>
	<td><?php echo $rowsvaluess['std_rollno']; ?></td>
	<td><?php echo $rowsvaluess['class_name']; ?></td>
	<td> <?php echo $rowsvaluess['hostel_name']; ?> </td>
	<td><?php echo $rowsvaluess['type_name']; ?></td>
	<td> <?php echo $rowsvaluess['room_name']; ?> </td>
	<td><?php echo $rowsvaluess['room_bedfee']; ?></td>
	<td>
<!-- HOSTEL UPDATE LINK -->
<?php echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/hostel/hostel_user/hostel_user_update.php?id='.$rowsvaluess['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		
<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels-user.php?deleteid='.$rowsvaluess['id'].'\');"><i class="el el-trash"></i></a>
	</td>
	';?>
</tr>
<?php
}
?>


</tbody>
</table>
</div>
</div>
</section>
<?php

?>