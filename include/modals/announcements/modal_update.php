<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//----------------------------------------------------- 
$sqllmsdetail	= $dblms->querylms("SELECT ann_id, ann_status, ann_title, ann_detail, ann_dated
										FROM ".ANNOUNCEMENT."
										WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND ann_id = '".$_GET['edit_id']."'");
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllmsdetail);
//-----------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
		<input type="hidden" name="ann_id" id="ann_id" value="'.cleanvars($_GET['edit_id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Announcement</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-md-3 control-label">Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input class="form-control" name="ann_title" id="ann_title" value="'.$rowsvalues['ann_title'].'" required title="Must Be Required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
				<div class="col-md-9">
					<input class="form-control" name="ann_dated" id="ann_dated" value="'.date('m/d/Y', strtotime($rowsvalues['ann_dated'])).'" required title="Must Be Required" data-plugin-datepicker>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Detail </label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="ann_detail" id="ann_detail">'.$rowsvalues['ann_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['ann_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="ann_status" name="ann_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="ann_status" name="ann_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['ann_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="ann_status" name="ann_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="ann_status" name="ann_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_announcement" name="changes_announcement">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
?>