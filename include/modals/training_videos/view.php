<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'view' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  title, youtube_url
								   FROM ".TRAINING_VIDEOS."
								   WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="video-lecture.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-play"></i> '.$rowsvalues['title'].'</h2>
		</header>
		<div class="panel-body">';
			if($rowsvalues['youtube_url'])
			{
				echo '<iframe width="100%" height="320" src="https://www.youtube.com/embed/'.$rowsvalues['youtube_url'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			}
		echo '
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
}
?>