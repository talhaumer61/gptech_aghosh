<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'added' => '1'))){
//-----------------------------------------------
	
if(isset($_GET['id']) && ($view !='delete') )
{
	
echo '
<section role="main" class="content-body">

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
			<a href="#edit" data-toggle="tab"><i class="fa fa-user"></i> <span class="hidden-xs"> Profile</span></a>
		</li>
		<li>
			<a href="#resetpass" data-toggle="tab"><i class="fa fa-lock"></i> <span class="hidden-xs"> Change Password</span></a>
		</li>
	</ul>
	<div class="tab-content">';
//-----------------------------------------------
	include_once("profile/edit_profile.php");
	include_once("profile/bank_details.php");
	include_once("profile/change_password.php");
//-----------------------------------------------
echo '
	</div>
</div>
</div>
</div>
</section>';
//-----------------------------------------------
}
}
else{
	header("Location: dashboard.php");
}
?>