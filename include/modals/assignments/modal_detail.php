<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
$sqlassig	= $dblms->querylms("SELECT assig_title, assig_note
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
		<header class="panel-heading">
			<h2 class="panel-title">
                <i class="glyphicon glyphicon-eye-open"></i> '.$rowsvalues['assig_title'].'
                <a class="pull-right modal-dismiss" data-dismiss="modal"><i class="fa fa-window-close"></i></a>
            </h2>
		</header>
		<div class="panel-body">
            <p class="text-justify">'.$rowsvalues['assig_note'].'</p>
		</div>
	</form>
</section>
</div>
</div>';
?>