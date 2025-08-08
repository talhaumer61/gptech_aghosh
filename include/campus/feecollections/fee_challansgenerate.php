<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'add' => '1'))){   
//---------------------------------------------
$today = date('m/d/Y');
if(date('d')>=15){
	$DueMonth = date('m') + 1;
	$DueDate = date(''.$DueMonth.'/15/Y');
}else{
	$DueMonth = date('m');
	$DueDate = date('m/15/Y');
}
//---------------------------------------------
if(isset($_POST['id_class'])){$class = $_POST['id_class'];} else{$class = '';}
if(isset($_POST['id_month'])){$month_id = $_POST['id_month'];}	else{$month_id = '';}
if(isset($_POST['due_date'])){$due_date = $_POST['due_date'];}	else{$due_date = $DueDate;}
//---------------------------------------------

echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off" target="_blank">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fa fa-plus-square"></i> Make Class Fee Challans</h4>
		</header>
		<div class="panel-body">
			<div class="row mb-lg">
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label">For Month <span class="required">*</span></label>
						<input type="month" class="form-control" name="yearmonth" id="yearmonth" value=""  required title="Must Be Required"  onchange="get_duedate(this.value)"/>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Class <span class="required">*</span></label>
						<select data-plugin-selectTwo data-width="100%" name="id_class" id="id_class" required title="Must Be Required" class="form-control">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT class_id, class_name
																FROM ".CLASSES." 
																WHERE class_status = '1' AND is_deleted != '1' 
																ORDER BY class_id ASC");
								while($rowsvalues = mysqli_fetch_array($sqllms)){
									if($rowsvalues['class_id'] == $class){
										echo'<option value="'.$rowsvalues['class_id'].'" selected>'.$rowsvalues['class_name'].'</option>';
									}else{
										echo'<option value="'.$rowsvalues['class_id'].'">'.$rowsvalues['class_name'].'</option>';
									}
								}
							echo'
						</select>
					</div>
				</div>   
				<div class="col-sm-4" id="getduedate">
					<label class="control-label">Due Date <span class="required">*</span></label>
					<input type="text" class="form-control" name="due_date" id="due_date" value="" data-plugin-datepicker required title="Must Be Required"/>
				</div>      
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12">
					<center><button type="submit" name="challans_generate" id="challans_generate" class="btn btn-primary"><i class="fa fa-search"></i> Genrate Challans</button></center>
				</div>
			</div>
		</footer>
	</form>
</section>';
}
else{
	header("Location: fee_challans.php");
}
?>