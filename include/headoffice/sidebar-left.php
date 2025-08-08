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
			
			<!-- STUDENT START -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){ 
			echo'
			<li class="nav-parent">
				<a>
					<i class="glyphicon glyphicon-comment"></i>
					<span>Students</span>
				</a>
				<ul class="nav nav-children">
					<li class="">
						<a href="students.php"><i class="fa fa-slideshare"></i><span> Students </span></a>
					</li>
					<li class="">
						<a href="paid_challan_inquiry.php"><i class="fa fa-slideshare"></i><span> Admission Challan Paid</span></a>
					</li>
					<!-- 
					<li class="">
						<a href="active_student_portal.php"><i class="fa fa-slideshare"></i><span> Active Student Portal</span></a>
					</li>
					-->
					
				</ul>
			</li>
			';
			}
			echo'
			<!-- STUDENT END -->

			<!-- STUDENT PROMOTION 
			<li class=" ">
				<a href="#">
					 <i class="fa fa-random"></i>
					<span>Student Transfer</span>
				</a>
			</li>
			-->

			<!-- ACADEMIC -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type	' => '2'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-university" aria-hidden="true"></i>
					<span>Academic</span>
				</a>

				<ul class="nav nav-children">

					<!-- CLASS -->';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '68', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '67', 'view' => '1'))){
					echo'
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<span>Academic Calender</span>
						</a>
						<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '68', 'view' => '1'))){ 
								echo'<li class=" "><a href="academic-calender.php"><span>Academic Calender</span></a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '67', 'view' => '1'))){ 
								echo'<li class=" "><a href="academiccalender_particulars.php"><span>Academic Calender Particular</span></a></li>';
							}
							echo'
						</ul>
					</li>';
					}
					echo'
					
					<!-- CLASS -->';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '47', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '3', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '6', 'view' => '1'))){ 
					echo'
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-group" aria-hidden="true"></i>
							<span>Class</span>
						</a>
						<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '47', 'view' => '1'))){ 
								echo'<li class=" "><a href="class.php"><span>Control Classes</span></a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '3', 'view' => '1'))){ 
								echo'<li class=" "><a href="class-groups.php"><span>Control Class Groups</span></a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '6', 'view' => '1'))){ 
								echo'<li class=" "><a href="classsections.php"><span>Control Sections</span></a></li>';
							}
							echo'
						</ul>
					</li>';
					}
					echo'

					<!-- TIMETABLE -->';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '8', 'view' => '1'))){ 
					echo'
					<li class="nav-parent  ">
						<a><i class="fa fa-clock-o" aria-hidden="true"></i> Timetable</a>
						<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){ 
							echo'
								<li class="">
									<a href="timetable.php">
										<span>Daily Class Routine</span>
									</a>
								</li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'view' => '1'))){ 
							echo'
								<li class="">
									<a href="timetable_classrooms.php">
										<span>Class Rooms</span>
									</a>
								</li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '8', 'view' => '1'))){ 
							echo'						
								<li class="">
									<a href="timetable_period.php">
										<span>Periods</span>
									</a>
								</li>';
							}
							echo'
						</ul>
					</li>';
					}

					//  <!-- SUBJECT -->
				   if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '5', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="classsubjects.php">
								<i class="fa fa-book"></i>
								<span>Subject</span>
							</a>
						</li>';
				   }
				   
					// <!-- SYLLABUS -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '57', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="syllabus_breakdown.php">
								<i class="fa fa-book"></i>
								<span>Syllabus Break-Down</span>
							</a>
						</li>';
					}

					// <!-- LEARNING RESOURCES -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '58', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="learning_resources.php">
								<i class="fa fa-tasks"></i>
								<span>Students Learning Resources</span>
							</a>
						</li>';
					}
					
					// <!-- DLP -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '59', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="syllabus_dlp.php">
								<i class="fa fa-tasks"></i>
								<span>Syllabus DLP</span>
							</a>
						</li>';
					}

					// <!-- SCHEME OF STUDY -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '66', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="scheme_of_study.php">
								<i class="fa fa-tasks"></i>
								<span>Scheme of Study</span>
							</a>
						</li>';
					}
					
					// <!-- TEACHING GUIDES -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="teaching_guide.php">
								<i class="fa fa-tasks"></i>
								<span>Teaching Guides</span>
							</a>
						</li>';
					}

					// <!-- WORK SHEET -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '60', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="syllabus_worksheet.php">
								<i class="fa fa-file-o"></i>
								<span>Syllabus Work Sheet</span>
							</a>
						</li>';
					}

					// <!-- Monthly Assessment -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'view' => '1'))){ 
					echo'
					<li class=" ">
						 <a href="monthly_assessment.php">
							  <i class="fa fa-file-o"></i>
							 <span>Monthly Assessment</span>
						 </a>
					</li>';
					}
					
					// <!-- SUMMER WORK -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '62', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="summer-work.php">
								<i class="fa fa-file-o"></i>
								<span>Vacational Engagement Tasks</span>
							</a>
						</li>';
					}

					// <!-- VIDEO LECTURES -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="video-lecture.php">
								<i class="fa fa-video-camera"></i>
								<span>Video Lectures</span>
							</a>
						</li>';
					}

					// <!-- TRAINING VIDEOS -->
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'view' => '1'))){ 
						echo'
						<li class=" ">
							<a href="training_videos.php">
								<i class="fa fa-video-camera"></i>
								<span>Training Videos</span>
							</a>
						</li>';
					}
					echo'
				</ul>
			</li>
			<!-- ACADEMIC END-->';
			}
			echo'

			<!-- FINANCE CONTROL -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '8'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-cc-visa"></i>
					<span>Finance Control</span>
				</a>
				<ul class="nav nav-children">
					<li class="nav-parent  ">
						<a><i class="fa fa-genderless" aria-hidden="true"></i> Fees</a>
						<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'view' => '1'))){ 
								echo'<li class=" "><a href="feesetup.php">Fees Structure</a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'view' => '1'))){ 
								echo'<li class=" "><a href="fee-category.php"></i>Fee Category</a></li>';
							}
							echo'
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
			</li>';
			}
			echo'
			<!-- FINANCE CONTROL END-->

			<!-- TEACHERS START -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '16', 'view' => '1'))){ 
			echo'
			<li class="nav-parent  ">
				<a href="employee.php"><i class="fa fa-users"></i><span>Employees</span></a>
			</li>';
			}
			echo'
			<!-- TEACHERS END -->



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

			
			<!-- EXAM -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '4'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-graduation-cap" aria-hidden="true"></i>
					<span>Exam</span>
				</a>

				<ul class="nav nav-children">';
					// echo'
					// <li class="">
					// 	<a href="exam_registration.php">
					// 		<i class="fa fa-graduation-cap" aria-hidden="true"></i>
					// 		<span>Exam Registration</span>
					// 	</a>
					// </li>
					// <li class="">
					// 	<a href="exam_registration_challans.php">
					// 		<i class="fa fa-dollar" aria-hidden="true"></i>
					// 		<span>Exam Registration Challans</span>
					// 	</a>
					// </li>
					// <li class="">
					// 	<a href="exam_registration_students_report.php">
					// 		<i class="fa fa-dollar" aria-hidden="true"></i>
					// 		<span>Exam Registration Students Report</span>
					// 	</a>
					// </li>';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){ 
					echo'
					<!-- Calender -->
					<li class="nav-parent">
						<a>
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<span>Exam Calender</span>
						</a>
						<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1'))){ 
								echo'<li class=" "><a href="exam_calender.php"><span>Exam Calender</span></a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){ 
								echo'<li class=" "><a href="exam_types.php"><span>Exam Types</span></a></li>';
							}
							echo'
						</ul>
					</li>';
					}
					// echo'
					// <li class="nav-parent">
					// 	<a>
					// 		<i class="fa fa-pie-chart" aria-hidden="true"></i>
					// 		<span>Exam Reports</span>
					// 	</a>
					// 	<ul class="nav nav-children">
					// 		<li><a href="exam_campus_studentslist.php"><span>Campus Wise Students List</span></a></li>
					// 		<li><a href="exam_campus_classeslist.php"><span>Class Wise Students </span></a></li>
					// 		<li><a href="exam_campus_receivables.php"><span>Campus Wise Receivables </span></a></li>
					// 		<li><a href="exam_campus_demand.php"><span>Campus Wise Demand </span></a></li>
					// 		<li><a href="exam_demand_defaulterlist.php"><span>Exam Demand Defaulters </span></a></li>
					// 	</ul>
					// </li>';
					echo'
					<li class=" ">
						<a href="exam_paper.php">
							<i class="fa fa-paste" aria-hidden="true"></i>
							<span>Assessment Papers</span>
						</a>
					</li>
					<li class=" ">
						<a href="exam_paper_delivery.php">
							<i class="fa fa-paper-plane" aria-hidden="true"></i>
							<span>Papers Delivery</span>
						</a>
					</li>';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'view' => '1'))){ 
					echo'
					<!-- Downloads -->
					<li class="nav-parent">
						<a>
							<i class="fa fa-download" aria-hidden="true"></i>
							<span>Downloads</span>
						</a>
						<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'view' => '1'))){ 
								echo'<li class=" "><a href="exam_scheme.php"><span>Exam Scheme</span></a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'view' => '1'))){ 
								echo'<li class=" "><a href="exam_policy.php"><span>Exam policy</span></a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'view' => '1'))){ 
								echo'<li class=" "><a href="exam_manual.php"><span>Exam Manual</span></a></li>';
							}
							echo'
						</ul>
					</li>';
					}
					
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'view' => '1'))){ 
						echo'<li class=" "><a href="exam_datesheet.php"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Exam Datesheet</span></a></li>';
					}
					
					echo'
					<li class=" ">
						<a href="examgradingsystem.php">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Grades Range</span>
						</a>
					</li>';
					// echo'
					// <li class=" ">
					// 	<a href="exam_marks.php?view=view">
					// 		<i class="fa fa-eye" aria-hidden="true"></i><span>Marks View</span>
					// 	</a>
					// </li>';
					// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'view' => '1'))){ 
					// 	echo'<li class=" "><a href="exam_datesheet.php?view=routine#"><span>View Datesheet</span></a></li>';
					// }
					echo'
					<!--
					<li class="nav-parent  ">
						<ul class="nav nav-parent">
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
					</li> -->
				</ul>
			</li>';
			}
			echo'
			<!-- EXAM END-->

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
			
			<!-- Statianory -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '13'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-paperclip"></i>
					<span>Statianory</span>
				</a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '36', 'view' => '1'))){ 
					echo'
					<li class="">
						<a href="stationary_supplier.php">
							<span><i class="fa fa-genderless"></i> Supplier</span>
						</a>
					</li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '33', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_category.php">
								<span><i class="fa fa-genderless"></i> Statianory Categories</span>
							</a>
						</li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_item.php">
								<span><i class="fa fa-genderless"></i> Statianory Items</span>
							</a>
						</li>';
					}
					echo'
					<li class="">
						<a href="stationary_stock.php">
							<span><i class="fa fa-genderless"></i> Statianory Stock</span>
						</a>
					</li>';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_purchase.php">
								<span><i class="fa fa-genderless"></i> Statianory Purchase</span>
							</a>
						</li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_request.php">
								<span><i class="fa fa-genderless"></i> Statianory Request</span>
							</a>
						</li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '54', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_sale.php">
								<span><i class="fa fa-genderless"></i> Statianory Sales</span>
							</a>
						</li>';
					}
					echo'					
				</ul>
			</li>';
			}
			echo'
			<!-- Statianory END -->

			
			
			<!--COMPLAINT & SUIGGESTIONS START -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-lightbulb-o"></i>
					<span>Compaint/Suggestion</span>
				</a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'view' => '1'))){ 
					echo'
					<li class="">
						<a href="complaint_suggestion.php">
							<span><i class="fa fa-genderless"></i> List</span>
						</a>
					</li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '23', 'view' => '1'))){ 
					echo'
					<li class="">
						<a href="complainttype.php">
							<span><i class="fa fa-genderless"></i> Types</span>
						</a>
					</li>';
					}
				echo'
				</ul>
			</li>';
			}
			echo'
			<!--COMPLAINT & SUIGGESTIONS END -->
			
			<!-- GALLERY
			<li class=" ">
				<a href="#">
					<i class="fa fa-file-picture-o"></i>
					<span>Media Gallery</span>
				</a>
			</li>
			-->

			<!-- EVENTS -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '42', 'view' => '1'))){ 
			echo'
			<li class=" ">
				<a href="event.php">
					<i class="fa fa-file-text-o"></i>
					<span>Events</span>
				</a>
			</li>';
			}

			echo'			
			<!-- AWARDS
			<li class=" ">
				<a href="awards.php">
					<i class="fa fa-trophy"></i>
					<span>Awards</span>
				</a>
			</li>
			-->
			
			<!-- BULK MESSAGE -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'view' => '1'))){ 
			echo'
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
			</li>';
			}
			echo'

			
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

			<!-- REPORT -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '8'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-pie-chart"></i>
					<span>Report</span>
				</a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '27', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'view' => '1'))){ 
						echo'
						<li class="">
							<a href="incomeexpense_report.php">
								<span><i class="fa fa-genderless" aria-hidden="true"></i> Income & Expense</span>
							</a>
						</li>';
					}

					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '27', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'view' => '1'))){ 
						echo'
						<li class="">
							<a href="feehead_wise_income_report.php">
								<span><i class="fa fa-genderless" aria-hidden="true"></i> Fee Head Wise Income</span>
							</a>
						</li>';
					}

					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){ 
						echo'
						<li class="">
							<a href="admission_report.php">
								<span><i class="fa fa-genderless" aria-hidden="true"></i> Admission Report</span>
							</a>
						</li>';
					}
					echo'
				</ul>
			</li>';
			}


			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'view' => '1'))){ 
			echo'
			<!-- NOTIFICATIONS START -->
			<li class=" ">
				<a href="notifications.php"><i class="fa fa-bell"></i><span>Notifications</span></a>
			</li>
			<!-- NOTIFICATIONS END -->';
			}

			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '6'))){ 
			echo'
			<li class="nav-parent">
				<a><i class="fa fa-university"></i><span>Campus</span></a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '20', 'view' => '1'))){ 
						echo'<li><a href="campuses.php"><span><i class="fa fa-university" aria-hidden="true"></i> Campus</span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '20', 'view' => '1'))){ 
						echo'<li><a href="campuslogin.php"><span><i class="fa fa-user" aria-hidden="true"></i> Campus Login</span></a></li>';
					}
					echo'
				</ul>
			</li>';
			}

			if(cleanvars($_SESSION['userlogininfo']['LOGINTYPE']) == 1){
				echo '
				<!-- SETTINGS START -->
				<li class="nav-parent">
					<a><i class="fa fa-cogs"></i><span>Setting</span></a>
					<ul class="nav nav-children">
						<li><a href="admins.php"><span><i class="fa fa-user" aria-hidden="true"></i> Head Office Login</span></a></li>
						<li><a href="settings.php"><span><i class="fa fa-cogs" aria-hidden="true"></i> Settings</span></a></li>
						<li><a href="sessions.php"><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Sessions</span></a></li>
					</ul>
				</li>
				<!-- SETTINGS END -->';
			}

			echo '
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