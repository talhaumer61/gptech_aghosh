<?php 
//-----------------------------------------------
	require_once("profile/query_profile.php");
//-----------------------------------------------
echo '

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Control Profile</h2>
	</header>

<!-- INCLUDEING PAGE -->
<div class="row appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
//-----------------------------------------------
	include_once("profile/detail.php");
//-----------------------------------------------
echo '
<div class="col-md-8">
<div class="tabs tabs-primary">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#edit" data-toggle="tab"><i class="fa fa-user"></i> <span class="hidden-xs">My Profile</span></a>
		</li>
		<li>
			<a href="#resetpass" data-toggle="tab"><i class="fa fa-lock"></i> <span class="hidden-xs">Change Password</span></a>
		</li>
	</ul>
	<div class="tab-content">';
//-----------------------------------------------
	include_once("profile/edit_profile.php");
	include_once("profile/change_password.php");
//-----------------------------------------------
echo '
	</div>
</div>
</div>
</div>';
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
<?php 
//-----------------------------------------------
if(isset($_SESSION['msg'])) { 
//-----------------------------------------------
		echo 'new PNotify({
				title	: "'.$_SESSION['msg']['title'].'"	,
				text	: "'.$_SESSION['msg']['text'].'"	,
				type	: "'.$_SESSION['msg']['type'].'"	,
				hide	: true	,
				buttons: {
					closer	: true	,
					sticker	: false
				}
			});';
//-----------------------------------------------
    unset($_SESSION['msg']);
//-----------------------------------------------
}
//-----------------------------------------------
?>	
	});
</script>
<?php 
//------------------------------------
echo '
</section>';
?>