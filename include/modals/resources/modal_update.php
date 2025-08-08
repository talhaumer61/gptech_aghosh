<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//----------------------------------------------------- 
$sqllmsresource	= $dblms->querylms("SELECT res_id, res_status, res_title, res_detail, res_file
									FROM ".RESOURCES."
									WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND res_id = '".$_GET['edit_id']."'");
$value_res = mysqli_fetch_array($sqllmsresource);
//------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="res_id" id="res_id" value="'.cleanvars($_GET['edit_id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Resource</h2>
		</header>
		<div class="panel-body">
		
			<div class="form-group">
				<label class="col-md-3 control-label">Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="res_title" id="res_title" value="'.$value_res['res_title'].'" required title="Must Be Required">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Note</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="res_detail" id="res_detail">'.$value_res['res_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">File <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="file" class="form-control" name="res_file" id="res_file" value="'.$value_res['res_file'].'"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($value_res['res_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="res_status" name="res_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="res_status" name="res_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($value_res['res_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="res_status" name="res_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="res_status" name="res_status" value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					}
			echo '
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_resource" name="changes_resource">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
?>