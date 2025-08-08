<?php 
// Current Session
$sqllmsSession	= $dblms->querylms("SELECT ses.session_name
								   FROM ".SESSIONS." ses
								   INNER JOIN ".SETTINGS." sett ON sett.acd_session = ses.session_id
								   WHERE sett.status = '1'
								   ORDER BY sett.id DESC LIMIT 1");
$valSession = mysqli_fetch_array($sqllmsSession);

echo '
<!-- START: HEADER -->
<header class="header">
<div class="logo-container">
<h3 href="dashboard.php" class="logo"><img src="uploads/logo.png" height="40"/><span style="color: #cb3f44; margin-left: 5px;">'.SCHOOL_NAME.'</span></h3>
	<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
		<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
	</div>
</div>

<!-- SEARCH & USER BOX -->
<div class="header-right">
<!-- SEARCH BAR -->
<!-- <form action="student/search" class="search nav-form" method="post" accept-charset="utf-8">
	<div class="input-group input-search">
		<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Student Search...">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form> -->

<span class="separator"></span>
<ul class="notifications">
<!-- SESSION CHANGER -->
<li>
	<a href="#modalAnim" class="modal-with-move-anim notification-icon" ><i class="fa fa-calendar"></i></a>
<div id="modalAnim" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">

<section class="panel panel-featured panel-featured-primary">
<form action="#" class="validate" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h4 class="panel-title">Academic Session : '.$valSession['session_name'].'</h4>
	</header>
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
</li>
<!-- MESSAGE NOTIFICATIONS -->

<li>
      <!--                         
<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
	<i class="fa fa-bell"></i>
	<span class="badge badge-danger badge-pill">3</span>
</a> -->

<div class="dropdown-menu notification-menu" style="min-width: 290px;">
	<div class="notification-title">
		Notifications
	</div>
	<div class="content">
		<ul>';
		//-----------------------------------------------------
		$sqllms	= $dblms->querylms("SELECT not_id, not_title, dated, not_description
                                            FROM ".NOTIFICATIONS." 
                                            WHERE not_status = '1' AND id_type = '2' AND to_campus = '1' AND is_deleted != '1'
											AND id_campus IN (0, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."')
                                            ORDER BY dated ASC LIMIT 6");
		//-----------------------------------------------------
		$count = 0;
		while($rowsvalues = mysqli_fetch_array($sqllms)) {
			$count++;
			echo'	
			<li>
				<a href="#" class="clearfix">
					<!-- PREVIEW OF SENDER IMAGE -->
					<figure class="image">
						<!-- <img src="uploads/parent_image/1.jpg" height="30" class="img-box-boder" /> -->
						<i class="fa fa-check"></i>
					</figure>
					<span class="title line"><strong>'.$rowsvalues['not_title'].'</strong>
					<small>'.date("d M Y", strtotime($rowsvalues['dated'])).'</small>  </span>
					<span class="message">'.$rowsvalues['not_description'].'</span>
				</a>
			</li>';
			}
			echo'
		</ul>
		<!-- <div class="text-right">
			<a href="notifications.php" class="view-more">View All</a>
		</div> -->
	</div>
</div>                  
<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
	<i class="fa fa-bell"></i>
	<span class="badge badge-danger badge-pill">'.$count++.'</span>
</a>
</li>
</ul>

	<span class="separator"></span>';

	if($_SESSION['userlogininfo']['LOGINNAME']){
		//-----------------------------------------------
		// if($_SESSION['userlogininfo']['LOGINTYPE'] == 1){
		// 	$login_type = "Principal";
		// }else{
		$login_type = get_admtypes($_SESSION['userlogininfo']['LOGINTYPE']);
		// }
		//-----------------------------------------------
	echo '
	<div id="userbox" class="userbox">
		<a href="#" data-toggle="dropdown">
			<figure class="profile-picture">
				<img src="uploads/admin_image/default.jpg" alt="user-image" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
			</figure>
			<div class="profile-info" data-lock-name="Admin" data-lock-email="info@ags.edu.pk">
				<span class="name">'.$_SESSION['userlogininfo']['LOGINNAME'].'</span>
				<span class="role">'.$login_type.'</span>
			</div>
			<i class="fa custom-caret"></i>
		</a>
		<div class="dropdown-menu">
			<ul class="list-unstyled">
				<li class="divider"></li>
				<li><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-wrench"></i> Settings</a></li>
				<li><a role="menuitem" tabindex="-1" href="profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
				<li><a role="menuitem" tabindex="-1" href="index.php?logout"><i class="fa fa-power-off"></i> Logout</a></li>
			</ul>
		</div>
	</div>';
}
echo '
</div>
</header>
<!-- END: HEADER -->';