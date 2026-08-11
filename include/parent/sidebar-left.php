<?php
// if(isset($_GET['std'])){
// 	echo '
// 	<!-- start: sidebar -->
// 	<aside id="sidebar-left" class="sidebar-left">
// 		<div class="sidebar-header">
// 			<div class="sidebar-title">
// 				Navigation
// 			</div>
// 			<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
// 				<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
// 			</div>
// 		</div>

// 		<div class="nano">
// 			<div class="nano-content">
// 				<nav id="menu" class="nav-main" role="navigation">
// 					<ul class="nav nav-main">

// 				<!-- DASHBOARD -->
// 				<li class=" ">
// 					<a href="dashboard.php">
// 						<i class="fa fa-arrow-left"></i>
// 						<span>Main Dashboard</span>
// 					</a>
// 				</li>';
// 				/*
// 				echo'
// 				<!-- DASHBOARD -->
// 				<li class=" ">
// 					<a href="dashboard.php?std='.$_GET['std'].'">
// 						<i class="fa fa-tachometer"></i>
// 						<span>Dashboard</span>
// 					</a>
// 				</li>

// 				<!-- TEACHER -->
// 				<li class="nav-parent  ">
// 					<a href="teacher.php?std='.$_GET['std'].'">
// 						<i class="fa fa-users" aria-hidden="true"></i>
// 						<span>Teachers</span>
// 					</a>
// 				</li>
// 				<!-- TEACHER END-->

// 				<!-- LECTURE SCHEDULE -->
// 				<li class="nav-parent  ">
// 					<a href="timetable.php?std='.$_GET['std'].'">
// 						<i class="fa fa-clock-o" aria-hidden="true"></i>
// 						<span>Lecture Schedule</span>
// 					</a>
// 				</li>
// 				<!-- LECTURE SCHEDULE END-->

// 				<!-- FEE HISTORY -->
// 				<li class="nav-parent  ">
// 					<a href="fee_challans.php?std='.$_GET['std'].'">
// 						<i class="fa fa-cc-visa" aria-hidden="true"></i>
// 						<span>Fee List / History</span>
// 					</a>
// 				</li>
// 				<!-- FEE HISTORY END-->
// 				';
// 				*/
// 				echo'
// 			</ul>
// 		</nav>

// 		</div>

// 	<script>
// 	// Maintain Scroll Position
// 		if (typeof localStorage !== "undefined") {
// 			if (localStorage.getItem("sidebar-left-position") !== null) {
// 				var initialPosition = localStorage.getItem("sidebar-left-position"),
// 				sidebarLeft = document.querySelector("#sidebar-left .nano-content");
// 				sidebarLeft.scrollTop = initialPosition;
// 			}
// 		}
// 	</script>

// 		</div>
// 	</aside>
// 	<!-- end: sidebar -->
// ';
// }
// else{
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
			<li class="nav-parent  ">
				<a><i class="fa fa-cc-visa" aria-hidden="true"></i><span>Fee List / History</span></a>
				<ul class="nav nav-children">';
					$sqllmstudent = $dblms->querylms("
						SELECT std_id, std_name, c.class_name
						FROM ".STUDENTS." s
						INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
						LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = s.id_section
						WHERE s.id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
						AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
					");

					while ($student = mysqli_fetch_array($sqllmstudent)) {
					echo'
					<li>
						<a href="fee_challans.php?std='.$student['std_id'].'">
							'.$student['std_name'].' ( '.$student['class_name'].' )
						</a>
					</li>';
					}
				echo'
				</ul>
			</li>';
			/*
			echo'
			<!-- Academic Calender -->
			<li class=" ">
				<a href="academic-calender.php">
					<i class="fa fa-calendar"></i>
					<span>Academic Calendar</span>
				</a>
			</li>';
			*/
			echo'
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
	// }
?>