<?php
if(isset($_GET['std'])){
echo '
<!-- start: sidebar -->
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

			<!-- DASHBOARD -->
			<li class=" ">
				<a href="dashboard.php">
					<i class="fa fa-arrow-left"></i>
					<span>Main Dashboard</span>
				</a>
			</li>
			
			<!-- DASHBOARD -->
			<li class=" ">
				<a href="dashboard.php?std='.$_GET['std'].'">
					<i class="fa fa-tachometer"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<!-- TEACHER -->
			<li class="nav-parent  ">
				<a href="teacher.php?std='.$_GET['std'].'">
					<i class="fa fa-users" aria-hidden="true"></i>
					<span>Teachers</span>
				</a>
			</li>
			<!-- TEACHER END-->

			<!-- LECTURE SCHEDULE -->
			<li class="nav-parent  ">
				<a href="timetable.php?std='.$_GET['std'].'">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<span>Lecture Schedule</span>
				</a>
			</li>
			<!-- LECTURE SCHEDULE END-->

			<!-- FEE HISTORY -->
			<li class="nav-parent  ">
				<a href="fee_challans.php?std='.$_GET['std'].'">
					<i class="fa fa-cc-visa" aria-hidden="true"></i>
					<span>Fee List / History</span>
				</a>
			</li>
			<!-- FEE HISTORY END-->
		</ul>
	</nav>

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

	</div>
</aside>
<!-- end: sidebar -->
';
}
else{
	echo '
<!-- start: sidebar -->
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

			<!-- DASHBOARD -->
			<li class=" ">
				<a href="dashboard.php">
					<i class="fa fa-tachometer"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<!-- Academic Calender -->
			<li class=" ">
				<a href="academic-calender.php">
					<i class="fa fa-calendar"></i>
					<span>Academic Calendar</span>
				</a>
			</li>
			
			<!-- USER PROFILE START -->
				<li class=" ">
					<a href="profile.php"><i class="fa fa-lock"></i><span>My Profile</span></a>
				</li>
			<!-- USER PROFILE END -->

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
</aside>
	
	';
	}
?>