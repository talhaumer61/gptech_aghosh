<?php 
echo '
<div class="col-md-8">
<div class="tabs tabs-primary">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#edit" data-toggle="tab"><i class="fa fa-user"></i> <span class="hidden-xs">Parents Profile</span></a>
		</li>
		<li>
			<a href="#childs" data-toggle="tab"><i class="fa fa-users"></i> <span class="hidden-xs">Childs</span></a>
		</li>
		<li>
			<a href="#resetpass" data-toggle="tab"><i class="fa fa-lock"></i> <span class="hidden-xs">Reset Password</span></a>
		</li>
	</ul>			
	<div class="tab-content">';
//-----------------------------------------------
	include_once("tabs/edit_info.php");
	include_once("tabs/childs.php");
	include_once("tabs/change_password.php");
//-----------------------------------------------
echo '
	</div>
</div>
</div>';