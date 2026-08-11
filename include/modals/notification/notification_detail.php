<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  not_id, not_status, id_type, not_title, dated, not_description, id_session, to_campus, to_staff, to_parent, to_student
									FROM ".NOTIFICATIONS." 
									WHERE is_deleted != '1' AND not_id = '".cleanvars($_GET['id'])."' 
									ORDER BY dated ASC LIMIT 1 
									");
									
$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
$dated = date('d M Y' , strtotime(cleanvars($rowsvalues['dated'])));
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="notifications.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Notification Detail</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
                <div class="col-md-12">
				    <label class="control-label">Title <span class="required">*</span></label>
					<input type="text" class="form-control" name="not_title" id="not_title" required title="Must Be Required" value="'.$rowsvalues['not_title'].'" readonly/>
				</div>
			</div>
			<div class="form-group mb-sm">
				<div class="col-md-12">
				    <label class="control-label">Dated <span class="required">*</span></label>
					<input type="text" class="form-control" name="dated" id="dated" value="'.$dated.'" required title="Must Be Required" readonly/>
				</div>
            </div>';
            if($rowsvalues['not_description'])
            {
                echo'
                <div class="form-group mb-md">
                    <div class="col-md-12">
                        <label class="control-label">Details</label>
                        <textarea class="form-control" rows="2" name="not_description" id="not_description" readonly>'.$rowsvalues['not_description'].'</textarea>
                    </div>
                </div>';
            }
            echo'
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
?>