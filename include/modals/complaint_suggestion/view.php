<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'updated' => '1'))){ 
//---------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  id, status, id_type, assign_to, dated, title, detail, remarks
									FROM ".COMPLAINTS." WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
if($rowsvalues['id_type'] == 1){
	$type = "Complaint";
}else if($rowsvalues['id_type'] == 2){
	$type = "Suggestion";
}
//-----------------------------------------------------
if($rowsvalues['assign_to'] == 1){
    $assign_to = "Head Office";
}else if($rowsvalues['assign_to'] == 2){
    $assign_to = "Campus";
}
//-----------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="complaint_suggestion.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> View My Complaint or Suggestion </h2>
		</header>
		<div class="panel-body">

			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Type </label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="id_type" id="id_type" readonly value="'.$type.'"/>
				</div>
			</div>

			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Title </label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="title" id="title" readonly value="'.$rowsvalues['title'].'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Date </label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dated" id="dated" readonly value="'.date("d M Y", strtotime($rowsvalues['dated'])).'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Assign To </label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="phone" id="phone" readonly value="'.$assign_to.'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Detail </label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="remarks" id="remarks" readonly>'.$rowsvalues['detail'].'</textarea>
				</div>
			</div>';
			
			if($rowsvalues['remarks']){
			echo'
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Remarks </label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="remarks" id="remarks" readonly>'.$rowsvalues['remarks'].'</textarea>
				</div>
			</div>';
			}
			
			echo'
			<div class="form-group">
				<label class="col-sm-3 control-label">Status </label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						'.get_complaint($rowsvalues['status']).'
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
// }
?>