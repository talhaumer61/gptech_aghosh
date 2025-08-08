<?php
error_reporting(0);
		if(isset($_POST['show_attendce_report'])){ 
$emplye = $_POST['emply_nm'];
$atndce = $_POST['attendance_type'];
$mnth = $_POST['month'];

$sqllmss	= $dblms->querylms("SELECT v.status, w.dated
   FROM ".EMPLOYEES_ATTENDCE_DETAIL." v 
   INNER JOIN ".EMPLOYEES_ATTENDCE." w ON w.id = v.id_setup
   WHERE w.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
	AND v.status LIKE '%".$atndce."%' AND w.dated LIKE '%".$mnth."%'
   
	 
");
//---------------------------
$sqllms	= $dblms->querylms("SELECT x.emply_name, d.designation_name
   FROM ".EMPLOYEES." x 
   INNER JOIN ".DESIGNATIONS." d ON d.designation_id = x.id_designation
WHERE x.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
AND x.emply_name LIKE '%".$emplye."%'
");
}
?>
<section class="panel panel-featured panel-featured-primary">
	<form action="attendance-employees_report_view.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h2 class="panel-title">
			Select Field		</h2>
	</header>
	<div class="panel-body">
		<div class="row mb-lg">

			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Employee Name <span class="required">*</span>
					</label>
					<input type="text" name="emply_nm" value="<?php echo $emplye;?>" class="form-control floating" />
				</div>
			</div>
            <div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Attendance Type <span class="required">*</span>
					</label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="attendance_type">
						<?php
                        echo'<option value="">Select</option>';
						foreach($attendtype as $listtype) { 
							echo '<option value="'.$listtype['id'].'">'.$listtype['name'].'</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Month <span class="required">*</span>
					</label>
					<select name="month" class="form-control"  data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required>
												<?php echo'
                                                <option value="'.$mnth.'">'.get_monthtypes($mnth).'</option>';
						foreach($monthtypes as $listtype) { 
							echo '<option value="'.$listtype['id'].'">'.$listtype['name'].'</option>';
						}
												?>
											</select>
				</div>
			</div>
		</div>
		<center>
			<button type="submit" name="show_attendce_report" id="show_attendce_report" class="btn btn-primary"><i class="fa fa-search"></i> Show Report</button>
		</center>
	</div>
	</form></section>
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
		Employees  Attendance Report Of <?php echo get_monthtypes($mnth) ?> Month</h2>
	</header>
	<div class="panel-body">
		<div class="table-responsive mt-sm mb-md">
			<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
				<thead>
					<tr>
						<td style="text-align: center;">
							Employees <i class="fa fa-hand-o-down"></i> |
							Date <i class="fa fa-hand-o-right"></i>
						</td>
                        
                       <?php 
$days =  cal_days_in_month(CAL_GREGORIAN, $_POST['month'], 2019);
for($i = 1; $i<=$days; $i++) { 
	echo '<td style="text-align: center;" width="60" nowrap>'.$i.'-'.$_POST['month'].'-'.date("Y").'</td>';
}
?>
												
												
											</tr>
				</thead>

				<tbody>
									
					
	
<?php


//-----------------------------------------


while($rowsvalues = mysqli_fetch_array($sqllms)) {
?>
        <tr>
<td style="text-align: center;" nowrap>
<?php echo $rowsvalues['emply_name']; ?><span class="ml-sm label label-primary"><?php echo $rowsvalues['designation_name']; ?></span>						</td>
<?php

//-----------------------------------------------------
while($rowsvallues = mysqli_fetch_array($sqllmss)) {
//-----------------------------------------------------

?>		

<td class="center">
<?php echo get_attendtype($rowsvallues['status']) ?>
                    </td>
                    <?php
}
//--------------------------------
}
?>

                
            </tr>
            
				</tbody>
			</table>
		</div>
	</div>

	<div class="panel-footer">
		<div class="text-right">
			<a href="attendance/employees_report_print/1/b" class="btn btn-sm btn-primary " target="_blank">
				<i class="glyphicon glyphicon-print"></i> Print			</a>
		</div>
	</div>

</section>