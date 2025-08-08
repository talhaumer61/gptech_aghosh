<?php 
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../functions/login_func.php";
include "../../functions/functions.php";
checkCpanelLMSALogin();

if($_GET['id_campus']){ 
	echo '
	<script src="assets/javascripts/user_config/forms_validation.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form action="exam_registration.php" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<header class="panel-heading">
						<h2 class="panel-title"><i class="fa fa-eye"></i>  Exam Registration Un Publish</h2>
					</header>
					<div class="panel-body">
						<div class="col-md-12" style="font-size: 30px;">
							<center>
								<h4 class="mb-lg">
									<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Are your sure want to Un Publish This Term?
								</h4>
								<input type="hidden" name="id_session" value="'.cleanvars($_GET['id_session']).'">
								<input type="hidden" name="id_type" value="'.cleanvars($_GET['id_type']).'">
								<input type="hidden" name="id_campus" value="'.cleanvars($_GET['id_campus']).'">
								<button class="btn btn-success" type="submit" name="un_publish_it">Yes</button>
								<button class="btn btn-warning btn-default modal-dismiss">No</button>
							</center>
						</div>
					</div>
				</form>
			</section>
		</div>
	</div>';
}else{
	echo'
	<script src="assets/javascripts/user_config/forms_validation.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form action="exam_registration.php" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<header class="panel-heading">
						<h2 class="panel-title"><i class="fa fa-eye"></i>  Exam Registration Publish</h2>
					</header>
					<div class="panel-body">
						<div class="col-md-12" style="text-align: justify; font-size: 20px; padding-top: 10px;">
							<h4 class="mb-lg">
								<b>
									Notice : 
								</b>
								<span class="text-danger">
									After you publish it then you don\'t have the <b>edit</b> right\'s
								</span>
							</h4>
						</div>
						<div class="col-md-12" style="font-size: 30px; padding-top: 20px;">
							<center>
								<h4 class="mb-lg">
									<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Are your sure want to publish it?
								</h4>
								<input type="hidden" name="id_session" value="'.cleanvars($_GET['id_session']).'">
								<input type="hidden" name="id_type" value="'.cleanvars($_GET['id_type']).'">
								<button class="btn btn-success" type="submit" name="publish_it">Yes</button>
								<button class="btn btn-warning btn-default modal-dismiss">No</button>
							</center>
						</div>
					</div>
				</form>
			</section>
		</div>
	</div>';
}
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".selectTwo2").select2({
			  dropdownParent: $("#show_modal")
			, minimumResultsForSearch: 0
			, width: "100%"
		});
	});
</script>