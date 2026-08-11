<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'view' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  id, status, title, facebook_code, youtube_code, id_class, id_subject, id_session
								   FROM ".VIDEO_LECTURE."
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
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> '.$rowsvalues['title'].'</h2>
		</header>
		<div class="panel-body">';
			if($rowsvalues['youtube_code']){
				echo '<iframe width="100%" height="320" src="https://www.youtube.com/embed/'.$rowsvalues['youtube_code'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			}
			elseif($rowsvalues['facebook_code']){
				echo '  <!-- Load Facebook SDK for JavaScript -->
				<div id="fb-root"></div>
				<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
			  
				<!-- Your embedded video player code -->
				<div class="fb-video" data-href="https://www.facebook.com/facebook/videos/'.$rowsvalues['facebook_code'].'/" data-width="600" data-show-text="false">
				  <div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/facebook/videos/'.$rowsvalues['facebook_code'].'/">
					  <a href="https://www.facebook.com/facebook/videos/'.$rowsvalues['facebook_code'].'/">'.$rowsvalues['title'].'</a>
					  <p>'.$rowsvalues['title'].'</p>
					</blockquote>
				  </div>
				</div>';
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