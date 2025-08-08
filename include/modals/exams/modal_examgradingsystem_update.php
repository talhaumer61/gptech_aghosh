<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '20', 'updated' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  g.grade_id, g.grade_name, g.grade_point, g.grade_lowermark, g.grade_uppermark,
											g.grade_comment, g.grade_status
								   		FROM ".GRADESYSTEM." g  
										WHERE g.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND g.grade_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="examgradingsystem.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="grade_id" id="grade_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Grade</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Grade Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="grade_name" id="grade_name" required title="Must Be Required" value="'.$rowsvalues['grade_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Grade Point <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="grade_point" id="grade_point" required title="Must Be Required" value="'.$rowsvalues['grade_point'].'" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Grade Lower Mark <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="grade_lowermark" id="grade_lowermark" required title="Must Be Required" value="'.$rowsvalues['grade_lowermark'].'" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Grade Upper Mark <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="grade_uppermark" id="grade_uppermark" required title="Must Be Required" value="'.$rowsvalues['grade_uppermark'].'" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Grade Comment <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="grade_comment" id="grade_comment" required title="Must Be Required" value="'.$rowsvalues['grade_comment'].'" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['grade_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="grade_status" name="grade_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="grade_status" name="grade_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['grade_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="grade_status" name="grade_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="grade_status" name="grade_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_grade" name="changes_grade">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
?>