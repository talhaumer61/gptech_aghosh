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
			</li>';
			
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '1'))){
			echo'
			<!-- STUDENT START -->
			<li class="nav-parent  ">
				<a><i class="fa fa-slideshare"></i><span>Admission</span></a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'view' => '1'))){ 
						echo'<li><a href="admission_inquiry.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Admission Inquiry</span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'add' => '1'))){ 
							echo'<li><a href="students.php?view=add"><span><i class="fa fa-genderless" aria-hidden="true"></i> Make Admission</span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){ 
						echo'<li><a href="students.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Student Details</span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){ 
						echo'<li><a href="admission_report.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Report</span></a></li>';
					}
				echo'
				</ul>
			</li>
			<!-- STUDENT END -->';
			}
			
			echo'
			<!-- STUDENT PROMOTION 
			<li class=" ">
				<a href="#">
					 <i class="fa fa-random"></i>
					<span>Student Transfer</span>
				</a>
			</li>
			-->

			<!-- ACADEMIC -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '2'))){ 
				echo'
				<li class="nav-parent  ">
					<a>
						<i class="fa fa-university" aria-hidden="true"></i>
						<span>Academic</span>
					</a>

					<ul class="nav nav-children">


						<!-- Work Sheet -->
						<li class=" ">
							<a href="academic-calender.php">
								<i class="fa fa-tasks"></i>
								<span>Academic Calendar</span>
							</a>
						</li>
						
						<!-- CLASS -->
						<li class="nav-parent  ">
							<a>
								<i class="fa fa-tasks" aria-hidden="true"></i>
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
						</li>

						<!-- TIMETABLE -->
						<li class="nav-parent  ">
							<a><i class="fa fa-clock-o" aria-hidden="true"></i> Timetable</a>
							<ul class="nav nav-children">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){ 
								echo'
									<li class="">
										<a href="timetable.php"><span>Set Class Routine</span></a>
									</li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){ 
								echo'
									<li class="">
										<a href="timetable.php?view=routine"><span>Daily Class Routine</span></a>
									</li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){ 
								echo'
									
									<li class="">
										<a href="timetable_classrooms.php"><span>Class Rooms</span></a>
									</li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'view' => '1'))){ 
								echo'							
									<li class="">
										<a href="timetable_period.php"><span>Periods</span></a>
									</li>';
								}
								echo'
							</ul>
						</li>

					<!-- SUBJECT -->';
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
				</li>';
			}
			echo'
			<!-- ACADEMIC END-->

			<!-- FINANCE CONTROL -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '8'))){ 
				echo'
				<li class="nav-parent  ">
					<a>
						<i class="fa fa-cc-visa"></i>
						<span>Finance Control</span>
					</a>
					<ul class="nav nav-children">';

						if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
						echo'
						<li class="nav-parent  ">
							<a><i class="fa fa-genderless" aria-hidden="true"></i> Fees</a>
							<ul class="nav nav-children">';
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'add' => '1'))){ 
								echo'<li><a href="fee_challans.php?view=bulk">Make Fee Challans</a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
								echo'<li><a href="fee_challans.php">Fee Challans List</a></li>
								<li><a href="admission_challans.php">Admission Challans</a></li>
								<li><a href="feedefaulterlist.php">Fee Defaulter List</a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '70', 'view' => '1'))){ 
								echo'<li><a href="feesetup.php">Fees Structure</a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
								echo'<li><a href="feestatusreport.php">Fee Staus Report</a></li>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'view' => '1'))){ 
								echo'<li><a href="fee-category.php"></i>Fee Category</a></li>';
							}
							echo'
							</ul>
						</li>';
						}

						if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '27', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'view' => '1'))){
						echo'
						<li class="nav-parent  ">
							<a><i class="fa fa-genderless" aria-hidden="true"></i> Balance Sheet</a>
							<ul class="nav nav-children">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '27', 'view' => '1'))){ 
									echo'<li><a href="earning.php">Income Sheet</a></li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'view' => '1'))){ 
									echo'<li><a href="earninghead.php">Income Head</a></li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'view' => '1'))){ 
									echo'<li><a href="costing.php">Expense Sheet</a></li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'view' => '1'))){ 
									echo'<li><a href="costinghead.php">Expense Head</a></li>';
								}
									echo'<li><a href="incomeexpense_report.php">Income & Expense</a></li>
									<li><a href="comp_trialbalance.php">Trial Balance Sheet</a></li>
							</ul>
						</li>';
						}

						if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '72', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'view' => '1'))){ 
						echo'
						<li class="nav-parent  ">
							<a><i class="fa fa-genderless" aria-hidden="true"></i> Scholarship</a>
							<ul class="nav nav-children">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '72', 'view' => '1'))){ 
									echo'<li><a href="scholarship.php">Scholarships</a></li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'view' => '1'))){ 
									echo'<li><a href="scholarship_category.php">Scholarship Categories</a></li>';
								}
								echo'
							</ul>
						</li>';
						}

						if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '74', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'view' => '1'))){ 
						echo'
						<li class="nav-parent  ">
							<a><i class="fa fa-genderless" aria-hidden="true"></i> Concession</a>
							<ul class="nav nav-children">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '74', 'view' => '1'))){ 
									echo'<li><a href="feeconcession.php"> Fee Concessions</a></li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'view' => '1'))){ 
										echo'<li><a href="feeconcession_cat.php">Fee Concessions Categories</a></li>';
								}
								echo'
							</ul>
						</li>';
						}

						if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '76', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'view' => '1'))){ 
						echo'
						<li class="nav-parent  ">
							<a><i class="fa fa-genderless" aria-hidden="true"></i> Fine</a>
							<ul class="nav nav-children">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'view' => '1'))){ 
									echo'<li><a href="fine.php">Fines</a></li>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '76', 'view' => '1'))){ 
									echo'<li><a href="fine_category.php">Fine Categories</a></li>';
								}
								echo'
							</ul>
						</li>';
						}
						echo'
						<li><a href="studentsorphan.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Orphan Students</span></a></li>
					</ul>
					
				</li>';
			}
			echo'
			<!-- FINANCE CONTROL END -->

			<!-- ADMINISTRATION START -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-bar-chart-o" aria-hidden="true"></i>
					<span>Administration</span>
				</a>
				<ul class="nav nav-children">
				
					<!-- EXAM -->
					<!--
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
					-->

					<!--
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
					-->

					<!-- ATTENDANCE CONTROL -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-line-chart"></i>
							<span> Attendance</span>
						</a>

						<ul class="nav nav-children">

							<!-- <li class="">
								<a href="attendance_students.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i>Mark Student Attendance</span>
								</a>
							</li> -->

							<li class="">
								<a href="attendance_studentsreport.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i>Student Attendance</span>
								</a>
							</li>

							<li class="">
								<a href="attendance_employees.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i>Mark Employees Attendance</span>
								</a>
							</li>

							<li class="">
								<a href="attendance_employeesreport.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i>View Employees Attendance</span>
								</a>
							</li>

						</ul>
					</li>

					
					
					<!-- LEAVE CONTROL
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-snowflake-o"></i>
							<span> Leave</span>
						</a>

						<ul class="nav nav-children">

							<li class="">
								<a href="attendance_students.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Students Leave</span>
								</a>
							</li>
							<li class="">
								<a href="employee_leave.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Employees Leave</span>
								</a>
							</li>
							<li class="">
								<a href="leave_category.php">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Leave Category</span>
								</a>
							</li>
						</ul>
					</li> -->
				</ul>
			</li>
			<!-- ADMINISTRATION END -->

			<!-- HRM START -->
			<li class="nav-parent">
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
							<li><a href="salarycontrol.php"><span>Salary Control</span></a></li>
							<li><a href="salary.php"><span>Employee Salary</span></a></li>
							<li><a href="salarycreated.php"><span>Generated Payslips</span></a></li>
							<li><a href="salary_report.php"><span>Salaries Report</span></a></li>
						</ul>
					</li>
					
				</ul>
			</li>
			<!-- HRM END -->
			
			<!--COMPLAINT & SUIGGESTIONS START -->';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'view' => '1'))){ 
				echo'
				<li class=" ">
					<a href="complaint_suggestion.php"><i class="fa fa-lightbulb-o"></i><span>Complaint/Suggestion</span></a>
				</li>';
			}
			echo'
			<!--COMPLAINT & SUIGGESTIONS END -->';

			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => ' 5'))){ 
			echo'
			<!-- EMPLOYEE START -->
			<li class="nav-parent  ">
				<a><i class="fa fa-users"></i><span>Employees </span></a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '16', 'add' => '1'))){ 
						echo'<li class=" "><a href="employee.php?view=add"><span><i class="fa fa-genderless" aria-hidden="true"></i> Add Employee </span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '16', 'view' => '1'))){ 
						echo'<li class=" "><a href="employee.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Employees List</span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '15', 'view' => '1'))){ 
						echo'<li class=" "><a href="designation.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Designation List</span></a></li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'view' => '1'))){ 
						echo'<li class=" "><a href="department.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Department List</span></a></li>';
					}
					echo'
				</ul>
			</li>
			<!-- EMPLOYEE END -->';
			}

			// <!-- EXAM -->
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('type' => '4'))){ 
			echo'
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-graduation-cap" aria-hidden="true"></i>
					<span>Exam</span>
				</a>

				<ul class="nav nav-children">';

					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '11', 'view' => '1'))){ 
					echo'
					<!-- Calender -->
					<li class="">
						<a href="exam_calender.php">
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<span>Exam Calender</span>
						</a>
					</li>';
					}

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
			// <!-- EXAM END-->

			echo'
			<!-- FRONT-OFFICE START -->
			<li class="nav-parent  ">
				<a><i class="fa fa-building-o"></i><span>Front Office</span></a>
				<ul class="nav nav-children">
					<!-- Visitors -->
					<li class="nav-parent  ">
						<a><i class="fa fa-tasks" aria-hidden="true"></i><span>Visitors</span></a>
						<ul class="nav nav-children">
							<li class=" "><a href="visitors.php"><span>Control Visitors</span></a></li>
							<li class=" "><a href="visitor_purposes.php"><span> Purposes</span></a></li>
						</ul>
					</li>
					<li class=" ">
						<a href="call_log.php"><span><i class="fa fa-phone" aria-hidden="true"></i> Calls</span></a>
					</li>
					<li class=" ">
						<a href="message.php?view=dd"><span><i class="fa fa-envelope-o" aria-hidden="true"></i> Messages</span></a>
					</li>
					</li>
				</ul>
			</li>
			<!-- FRONT-OFFICE END -->

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
			<!-- Donation -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-dollar"></i>
					<span>Donation</span>
				</a>
				<ul class="nav nav-children">
					<li class="">
						<a href="donors.php">
							<span><i class="fa fa-genderless"></i> Donors</span>
						</a>
					</li>
					<li class="">
						<a href="donations.php">
							<span><i class="fa fa-genderless"></i> Students</span>
						</a>
					</li>
					<li class="">
						<a href="donationChallans.php">
							<span><i class="fa fa-genderless"></i> Donation Challans</span>
						</a>
					</li>
				</ul>
			</li>

			
			<!-- Statianory -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-paperclip"></i>
					<span>Statianory</span>
				</a>
				<ul class="nav nav-children">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_item.php">
								<span><i class="fa fa-genderless"></i> Statianory Items</span>
							</a>
						</li>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'view' => '1'))){ 
					echo'
						<li class="">
							<a href="stationary_purchase.php">
								<span><i class="fa fa-genderless"></i> Statianory Purchase</span>
							</a>
						</li>';
					}
					echo'
				</ul>
			</li>

			<!-- LIBRARY -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-fax"></i>
					<span>Library</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="lms_books.php">
							<span><i class="fa fa-circle-o"></i> Books Stock</span>
						</a>
					</li>
					
					<li class="">
						<a href="lms_bookcategory.php">
							<span><i class="fa fa-circle-o"></i> Books Category</span>
						</a>
					</li>
					
					<li class="">
						<a href="#">
							<span><i class="fa fa-circle-o"></i> Books Maintain</span>
						</a>
					</li>
					
				</ul>
			</li>
			
			<!-- Statianory
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
			-->
			
			<!-- GALLERY
			<li class=" ">
				<a href="#">
					<i class="fa fa-file-picture-o"></i>
					<span>Media Gallery</span>
				</a>
			</li>
			-->
			
			<!-- TRANSPORT START
			<li class="nav-parent">
				<a><i class="fa fa-bus"></i><span>Transport</span></a>
				<ul class="nav nav-children">
					<li class="">
						<a href="transportroute.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Route Control</span></a>
					</li>
					<li class="">
						<a href="transportvehicle.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Vehicle Control</span></a>
					</li>
					<li class="">
						<a href="#"><span><i class="fa fa-genderless" aria-hidden="true"></i> Transport Allocation</span></a>
					</li>
				</ul>
			</li>
			-->
		
			<!-- HOSTELS START -->
			<li class="nav-parent">
				<a><i class="fa fa-sitemap"></i><span>Hostel</span></a>
				<ul class="nav nav-children">
					<li class="">
						<a href="hostelUsers.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Hostel Users</span></a>
					</li>
					<li class="">
						<a href="hostels.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Hostel Control</span></a>
					</li>
					<li class="">
						<a href="hostelRooms.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Room Control</span></a>
					</li>				
					<li class="">
						<a href="hostelFloors.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Floor Control</span></a>
					</li>
				</ul>
			</li>
			<!-- HOSTELS END -->

			<!-- EVENTS
			<li class=" ">
				<a href="event.php">
					<i class="fa fa-file-text-o"></i>
					<span>Events</span>
				</a>
			</li>
			-->
			
			<!-- AWARDS
			<li class=" ">
				<a href="awards.php">
					<i class="fa fa-trophy"></i>
					<span>Awards</span>
				</a>
			</li>
			-->
			
			<!-- BULK MESSAGE
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
			-->

			
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

			<!-- REPORT
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
			-->
			
			<!-- NOTIFICATIONS START -->
			<li class=" ">
				<a href="notifications.php"><i class="fa fa-bell"></i><span>Notifications</span></a>
			</li>
			<!-- NOTIFICATIONS END -->

			<!-- SETTINGS START-->
			<li class="nav-parent nav-expanded">
				<a><i class="fa fa-user"></i><span>User Login</span></a>
				<ul class="nav nav-children">
					<li><a href="teacherlogin.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Teacher Login</span></a></li>
					<li><a href="parentlogin.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Parent Login</span></a></li>
					<li><a href="admins.php"><span><i class="fa fa-genderless" aria-hidden="true"></i> Admin Login</span></a></li>
				</ul>
			</li>

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