<?php
echo '
<!-- start sidebar -->
<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">

			<li class=" ">
				<a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
			</li>

			<li class="">
				<a href="donationChallans.php"><i class="fa fa-cc-visa"></i><span>Donation History</span></a>
			</li>
			
			<li class="">
				<a href="profile.php"><i class="fa fa-lock"></i><span>My Profile</span></a>
			</li>
			</nav>
		</div>
	</div>
	<script>
// Maintain Scroll Position
	if (typeof localStorage !== "undefined") {
		if (localStorage.getItem("sidebar-left-position") !== null) {
			var initialPosition = localStorage.getItem("sidebar-left-position"),
			sidebarLeft = document.querySelector("#sidebar-left .nano-content");
			sidebarLeft.scrollTop = initialPosition;
		}
	}
</script>
</aside>';
?>