<?php
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
			
			<!-- STUDENT START -->
			<li class="nav-parent  ">
				<a href="students.php"><i class="fa fa-slideshare"></i><span>Students</span></a>
			</li>
			<!-- STUDENT END -->

			<!-- STUDENT PROMOTION 
			<li class=" ">
				<a href="#">
					 <i class="fa fa-random"></i>
					<span>Student Transfer</span>
				</a>
			</li>
			-->

			<!-- ACADEMIC -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-university" aria-hidden="true"></i>
					<span>Academic</span>
				</a>

				<ul class="nav nav-children">

					<!-- CLASS -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-tasks" aria-hidden="true"></i>
							<span>Academic Calender</span>
						</a>
						<ul class="nav nav-children">
							<li class=" "><a href="academic-calender.php"><span>Academic Calender</span></a></li>
							<li class=" "><a href="academiccalender_particulars.php"><span>Academic Calender Particular</span></a></li>
						</ul>
					</li>
					
					<!-- CLASS -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-tasks" aria-hidden="true"></i>
							<span>Class</span>
						</a>
						<ul class="nav nav-children">
							<li class=" "><a href="class.php"><span>Control Classes</span></a></li>
							<li class=" "><a href="classsections.php"><span>Control Sections</span></a></li>
						</ul>
					</li>

					<!-- TIMETABLE -->
					<li class="nav-parent  ">
						<a><i class="fa fa-clock-o" aria-hidden="true"></i> Timetable</a>
						<ul class="nav nav-children">
							<li class="">
								<a href="timetable.php">
									<span>Daily Class Routine</span>
								</a>
							</li>
							
							<li class="">
								<a href="timetable_classrooms.php">
									<span>Class Rooms</span>
								</a>
							</li>
							
							<li class="">
								<a href="timetable_period.php">
									<span>Periods</span>
								</a>
							</li>
						</ul>
					</li>

				   <!-- SUBJECT -->
					<li class=" ">
						 <a href="classsubjects.php">
							  <i class="fa fa-book"></i>
							 <span>Subject</span>
						 </a>
					</li>

				</ul>
			</li>
			<!-- ACADEMIC END-->

			<!-- FINANCE CONTROL -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-cc-visa"></i>
					<span>Finance Control</span>
				</a>
				<ul class="nav nav-children">
					<li class="nav-parent  ">
						<a><i class="fa fa-genderless" aria-hidden="true"></i> Fees</a>
						<ul class="nav nav-children">
							<li class=" "><a href="#">Make Payments Invoice</a></li>
							<li class=" "><a href="feesetup.php">Fees Structure</a></li>
							<li class=" "><a href="fee-category.php"></i>Fee Category</a></li>
						</ul>
					</li>

					<!--
					<li class="nav-parent  ">
						<a><i class="fa fa-genderless" aria-hidden="true"></i> Balance Sheet</a>
						<ul class="nav nav-children">
							<li class=" "><a href="#">Costing Sheet</a></li>
							<li class=" "><a href="#">Costing Category</a></li>
							<li class=" "><a href="#">Earning Sheet</a></li>
							<li class=" "><a href="#">Earning Category</a></li>
						</ul>
					</li>
					-->

				</ul>
			</li>
			<!-- FINANCE CONTROL END-->

			<!-- TEACHERS START -->
			<li class="nav-parent  ">
				<a href="employee.php"><i class="fa fa-users"></i><span>Employees</span></a>
			</li>
			<!-- TEACHERS END -->

			<!-- SYLLABUS START -->
			<li class="nav-parent  ">
				<a href="syllabus_breakdown.php"><i class="fa fa-book"></i><span>Syllabus Break-Down</span></a>
			</li>
			<!-- SYLLABUS END -->

			<!--
 			USER START
			<li class="nav-parent  ">
				<a><i class="fa fa-user-circle"></i><span>Users</span></a>
				<ul class="nav nav-children">
					<li class=" ">
						<a href="guardians.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Parents</span></a>
					</li>
					<li class=" ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> Librarian</span></a>
					</li>
					<li class=" ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> Accountant</span></a>
					</li>
				</ul>
			</li>
			USER END -->
			
			<!-- HRM
			<li class="nav-parent  ">
				<a>
					<i class="glyphicon glyphicon-retweet"></i>
					<span>HRM / Payroll</span>
				</a>
				<ul class="nav nav-children">
					
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-usd" aria-hidden="true"></i>
							<span>Payroll</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
<a href="#">
	<span>Salary Control</span>
</a>
							</li>
							<li class=" ">
<a href="#">
	<span>Employee Salary</span>
</a>
							</li>
							<li class=" ">
<a href="#">
	<span>Generate Payslip</span>
</a>
							</li>
						</ul>
					</li>
					
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-hotel" aria-hidden="true"></i>
							<span>Leave Control</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
<a href="leave-cat.php">
	<span>Categories</span>
</a>
							</li>
							<li class=" ">
<a href="leave.php">
	<span>Applications</span>
</a>
							</li>
							
						</ul>
					</li>
					
				</ul>
			</li>
			-->

			<!-- ADMINISTRATION
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-bar-chart-o" aria-hidden="true"></i>
					<span>Administration</span>
				</a>
				<ul class="nav nav-children">
					<!-- EXAM
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-graduation-cap"></i>
							<span>Exam</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
<a href="examss.php">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Exam List</span>
</a>
							</li>
							<li class=" ">
<a href="exam_term.php">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Set Exam Term</span>
</a>
							</li>
							<li class=" ">
<a href="#">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Exam Attendance</span>
</a>
							</li>
							<li class=" ">
<a href="#">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Set Attendance</span>
</a>
							</li>
						</ul>
					</li>


					<li class="nav-parent  ">
						<a>
							<i class="glyphicon glyphicon-pushpin"></i>
							<span>Marks</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
<a href="#">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Marks Register</span>
</a>
							</li>
							<li class=" ">
<a href="examgradingsystem.php">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Grades Range</span>
</a>
							</li>
							<li class=" ">
<a href="exam_marks.php">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Marks Sheet</span>
</a>
							</li>
						</ul>
					</li>

					<li class="nav-parent  ">
						<a>
							<i class="fa fa-line-chart"></i>
							<span> Attendance</span>
						</a>

						<ul class="nav nav-children">

							<li class="">
<a href="#">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Student</span>
</a>
							</li>

							<li class="">
<a href="#">
	<span><i class="fa fa-genderless" aria-hidden="true"></i> Employees</span>
</a>
							</li>

						</ul>
					</li>
				</ul>
			</li>
			-->
			
			<!-- Statianory -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-paperclip"></i>
					<span>Statianory</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="stationary-supplier.php">
							<span><i class="fa fa-user"></i> Supplier</span>
						</a>
					</li>
					
					<li class="">
						<a href="stationary-category.php">
							<span><i class="fa fa-list-alt"></i> Statianory Categories</span>
						</a>
					</li>
					<li class="">
						<a href="stationary-item.php">
							<span><i class="fa fa-list-alt"></i> Statianory Items</span>
						</a>
					</li>
					<li class="">
						<a href="stationary-store.php">
							<span><i class="fa fa-building"></i> Statianory Store</span>
						</a>
					</li>
					
				</ul>
			</li>
			
			<!-- GALLERY
			<li class=" ">
				<a href="#">
					<i class="fa fa-file-picture-o"></i>
					<span>Media Gallery</span>
				</a>
			</li>
			-->

			<!-- EVENTS -->
			<li class=" ">
				<a href="event.php">
					<i class="fa fa-file-text-o"></i>
					<span>Events</span>
				</a>
			</li>
			
			<!-- AWARDS -->
			<li class=" ">
				<a href="awards.php">
					<i class="fa fa-trophy"></i>
					<span>Awards</span>
				</a>
			</li>
			
			<!-- BULK MESSAGE -->
			<li class="nav-parent">
				<a>
					<i class="glyphicon glyphicon-comment"></i>
					<span>Bulk Email / SMS</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="#">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Template</span>
						</a>
					</li>

					<li class="">
						<a href="#">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Message</span>
						</a>
					</li>
					<li class="">
						<a href="#">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Alert SMS</span>
						</a>
					</li>
				</ul>
			</li>

			
			<!-- VISITORS -->
			<!-- <li class="nav-parent  ">
				<a>
					<i class="fa fa-users"></i>
					<span>Visitors</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="visitor_purposes.php">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Purposes</span>
						</a>
					</li>

					<li class="">
						<a href="visitors.php">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Visitors</span>
						</a>
					</li>

				</ul>
			</li> -->

			<!-- REPORT -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-pie-chart"></i>
					<span>Report</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="#">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Student Attendance</span>
						</a>
					</li>

					<li class="">
						<a href="#">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Employees Attendance</span>
						</a>
					</li>
					
					<li class="">
						<a href="#">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Balance Fee By Date</span>
						</a>
					</li>

				</ul>
			</li>

			<!-- ACADEMIC -->
			<li class="nav-parent ">
				<a href="campuses.php">
					<i class="fa fa-university" aria-hidden="true"></i>
					<span>Campuses</span>
				</a>
			</li>
			<!-- ACADEMIC END-->

<!-- SETTINGS START -->
			<li class="nav-parent nav-expanded nav-active ">
				<a><i class="fa fa-suitcase"></i><span>Settings</span></a>
				<ul class="nav nav-children">
					<li class="nav-active ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> System Settings</span></a>
					</li>
					<li class=" ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> Payment Settings</span></a>
					</li>
					<li class=" ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> SMS Settings</span></a>
					</li>
					<li class=" ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> Session Settings</span></a>
					</li>
					<li class=" ">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> Database Backup</span></a>
					</li>
				</ul>
			</li>
<!-- SETTINGS END -->

<!-- USER PROFILE START -->
			<li class=" ">
				<a href="profile.php"><i class="fa fa-lock"></i><span>My Profile</span></a>
			</li>
<!-- USER PROFILE END -->
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
<!-- end: sidebar -->';