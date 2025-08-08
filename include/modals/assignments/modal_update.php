<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
$sqlassig	= $dblms->querylms("SELECT assig_id, assig_status, assig_title, assig_note, assig_file, open_date, close_date
								   FROM ".ASSIGNMENT."
								   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND assig_id = '".$_GET['edit_id']."'");
$rowsvalues = mysqli_fetch_array($sqlassig);
//------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="assig_id" id="assig_id" value="'.cleanvars($_GET['edit_id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Assignment</h2>
		</header>
		<div class="panel-body">
		
			<div class="form-group">
				<label class="col-md-3 control-label">Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="assig_title" id="assig_title" value="'.$rowsvalues['assig_title'].'" required title="Must Be Required">
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Open <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="input-daterange input-group" data-plugin-datepicker>
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<input type="text" class="form-control valid" name="open_date" id="open_date" value="'.date('m/d/Y', strtotime($rowsvalues['open_date'])).'" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
						<span class="input-group-addon">Due </span>
						<input type="text" class="form-control" name = "close_date" id="close_date" value="'.date('m/d/Y', strtotime($rowsvalues['close_date'])).'" required="" title="Must Be Required"  aria-required="true">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">File </label>
				<div class="col-md-9">
					<input type="file" class="form-control" name="assig_file" id="assig_file" value="'.$rowsvalues['assig_file'].'"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Note</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="assig_note" id="assig_note">'.$rowsvalues['assig_note'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['assig_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="assig_status" name="assig_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="assig_status" name="assig_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['assig_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="assig_status" name="assig_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="assig_status" name="assig_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_syllabus" name="changes_assignment">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
?>