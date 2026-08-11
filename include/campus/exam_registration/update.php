<?php 
if(empty(LMS_VIEW) && !empty($_GET['edit_id'])){
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();

	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){ 
		$sqllms	= $dblms->querylms("SELECT reg_status, id_class, id_session, id_campus, id_type, is_publish
								FROM ".EXAM_REGISTRATION."
								WHERE is_deleted = '0'
								AND id_campus 	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
								AND reg_id		= '".cleanvars($_GET['edit_id'])."'
								LIMIT 1
							");
		$valDemand = mysqli_fetch_array($sqllms);

		$sqllmsclasses	= $dblms->querylms("SELECT c.class_name
												FROM ".CLASSES." c  
												WHERE c.is_deleted	= '0' 
												AND c.class_status	= '1'
												AND c.class_id = '".cleanvars($valDemand['id_class'])."'
											");
		$valClassName = mysqli_fetch_array($sqllmsclasses);

		$sqllmsExamTerms	= $dblms->querylms("SELECT et.type_id, et.type_name
													FROM ".EXAM_TYPES." et
													WHERE et.is_deleted	= '0' 
													AND et.type_status	= '1'
													ORDER BY et.type_id ASC
												");
		echo'
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="exam_registration.php?edit_id='.cleanvars($_GET['edit_id']).'" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
				<input type="hidden" value="'.cleanvars($_GET['edit_id']).'" name="edit_id">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-plus-square"></i> Edit Exam Registration</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<label class="control-label">Exam Type <span class="required">*</span></label>
							<select data-plugin-selectTwo data-width="100%" name="id_term" id="id_term" required title="Must Be Required" class="form-control populate">
								<option value="">Select Any Option</option>';
								while($valueExamTerms = mysqli_fetch_array($sqllmsExamTerms)):
									if ($valDemand['id_type'] == $valueExamTerms['type_id']){
										echo '<option value="'.$valueExamTerms['type_id'].'" selected>'.$valueExamTerms['type_name'].'</option>';
									}else{
										echo'<option value="'.$valueExamTerms['type_id'].'">'.$valueExamTerms['type_name'].'</option>';
									}
								endwhile;
								echo'
							</select>
						</div>
						<div class="col-md-6">
							<input type="hidden" value="'.$_GET['edit_id'].'" id="demand_id" name="demand_id">
							<label class="control-label">Classes <span class="required">*</span></label>
							<input type="hidden" value="'.$valDemand['id_class'].'" name="id_class" id="id_class">
							<input type="text" value="'.$valClassName['class_name'].'" class="form-control populate" readonly>
						</div>
						<div class="col-sm-12">
							<label class="col-sm-1 control-label mt-sm">Status <span class="required">*</span></label>
							<div class="col-md-11 pull-left">
								<div class="radio-custom radio-inline mt-sm">
									<input type="radio" id="demand_status" name="demand_status" value="1" checked>
									<label for="radioExample1">Active</label>
								</div>
								<div class="radio-custom radio-inline">
									<input type="radio" id="demand_status" name="demand_status" value="2">
									<label for="radioExample2">Inactive</label>
								</div>
							</div>
						</div>
						<div class="col-sm-12 m-sm">
							<table class="table table-bordered table-striped table-condensed mb-none std_show" id="table_export">
							
							</table>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" id="submit_edit_exam_demand" name="submit_edit_exam_demand" class="mr-xs btn btn-primary">Edit</button>
							<a class="btn btn-default" href="exam_registration.php">Cancel</a>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>
</div>';
	}
	else{
		header("Location: create_user.php");
	}
}
?>
<script>
	$(document).ready(function() {
		var demandId         	= $('#demand_id');
		var idClass         	= $('#id_class');
		var stdShows         	= $('.std_show');
		if (idClass.val() != '')
		{
			$.ajax({
				url: "include/campus/exam_registration/ajax.php"
				, type: "POST"
				, data: {
							  idClass : idClass.val()
							, demandId : demandId.val()
						}
				, success: function(response) {
					stdShows.html(response);
				}
			});
		}
   });
</script>