
	
<!doctype html>
<html class=" sidebar-light sidebar-left-big-icons">
	
	<head>
		<!-- BASIC -->
		<meta charset="UTF-8">
		<title>Fees Collect / History | Rudras School</title>
		<meta name="keywords" content="School Management Software" />
		<meta name="description" content="Rudras School Management System (ERP)">
		<meta name="author" content="PVSSystemsIT">
				<!-- MOBILE METAS -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- WEB FONTS  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- VENDOR CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-switch/css/bootstrap-switch.min.css" />

		<!-- SPECIFIC PAGE VENDOR CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="assets/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/elusive-icons/css/elusive-icons.min.css" />

		<!-- SWEETALERT JS/CSS -->
		<link rel="stylesheet" href="assets/sweetalert/sweetalert_custom.css">
		<script src="assets/sweetalert/sweetalert.min.js"></script>

        <!-- PNOTIFY NOTIFICATIONS CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

        <!-- DATATABLES PAGE CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
        
        <!-- FILEUPLOAD PAGE CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
		
		<!-- FULLCALENDAR CSS -->
		<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.css" />

		<!-- THEME CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- SKIN CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- THEME CUSTOM CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		
		<!-- PVS SYSTEMS CSS -->
		<link rel="stylesheet" href="assets/stylesheets/pvs-systems.css">

		<!-- HEAD LIBS -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
        
        <!-- JQUERY LIBS -->
		<script src="assets/vendor/jquery/jquery.js"></script>
	
        <!--WEB ICON-->
	    <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- DISABLE SQUARE BORDERS -->
        
        <!--HIGHCHARTS-->
        <script src="assets/vendor/highcharts/-highcharts.js" type="text/javascript"></script>
		
		<!-- NUMBER SPINNERS DISABLE -->
		<style>
			input[type="number"]::-webkit-outer-spin-button,
			input[type="number"]::-webkit-inner-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}
			input[type="number"] {
				-moz-appearance: textfield;
			}
		</style>	</head>
	
	<body class="loading-overlay-showing" data-loading-overlay>
	    <!-- PAGE LOADING OVERLAY -->
		<div class="loading-overlay">
			<div class="bounce-loader">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
		</div>
		
		<section class="body">
			<!-- INCLUDEING HEADER -->
            <!-- START: HEADER -->
<header class="header">
	<div class="logo-container">
		<a href="dashboard" class="logo">
			<img src="uploads/logo.png" height="40" />
		</a>
		<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<!-- SEARCH & USER BOX -->
	<div class="header-right">
	    			<!-- SEARCH BAR -->
			<form action="student/search" class="search nav-form" method="post" accept-charset="utf-8">
				<div class="input-group input-search">
					<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Student Search...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
	    		
		<span class="separator"></span>

		<ul class="notifications">
		
			<!-- SESSION CHANGER -->
							<li>
					<a href="#modalAnim" class="modal-with-move-anim notification-icon" >
						<i class="fa fa-calendar"></i>
					</a>

					<div id="modalAnim" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
						
						<section class="panel panel-featured panel-featured-primary">
						<form action="settings/change_session" class="validate" method="post" accept-charset="utf-8">
							<header class="panel-heading">
								<h4 class="panel-title">Running Session : 2018-2019</h4>
							</header>
							<div class="panel-body">
								<div class="modal-wrapper">
									<div class="form-group">
										<label>Academic Session</label>
										<select name="year_id" class="form-control" data-plugin-selectTwo data-width="100%" data-plugin-options='{ "minimumResultsForSearch": -1 }'
										required title="Must Be Required">
											<option value="">Select Academic Session</option>
																						<option value="1"selected>2018-2019</option>
																						<option value="3">2019-2020</option>
																						<option value="4">2020-2021</option>
																						<option value="5">2021-2022</option>
																						<option value="6">2022-2023</option>
																						<option value="7">2023-2024</option>
																						<option value="8">2024-2025</option>
																						<option value="9">2025-2026</option>
																					</select>
									</div>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-12 text-right">
										<button type="submit" class="btn btn-primary">Change Session</button>
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
				<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
					<i class="fa fa-envelope"></i>
									</a>

				<div class="dropdown-menu notification-menu" style="min-width: 290px;">
					<div class="notification-title">
						Messages
					</div>
					<div class="content">
						<ul>
						
							<li>
								<a href="message/read/24" class="clearfix">
									<!-- PREVIEW OF SENDER IMAGE -->
									<figure class="image">
										<img src="uploads/parent_image/1.jpg" height="30" class="img-box-boder" />
									</figure>

									<!-- PREVIEW OF SENDER NAME AND DATE -->
									<span class="title line"><strong>Krishna Ray</strong>
									<small>- 03 May, 2018</small>  </span>

									 <!-- PREVIEW OF THE LAST UNREAD MESSAGE SUB-STRING -->
									<span class="message">hello</span>
								</a>
							</li>
													</ul>
                        						<div class="text-right">
							<a href="message" class="view-more">View All</a>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<span class="separator"></span>
		<div id="userbox" class="userbox">
			<a href="#" data-toggle="dropdown">
				<figure class="profile-picture">
					<img src="uploads/admin_image/1.jpg" alt="user-image" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
				</figure>
				<div class="profile-info" data-lock-name="Admin" data-lock-email="info@pvssystem.com">
					<span class="name">Admin</span>
					<span class="role">Admin</span>
				</div>
				<i class="fa custom-caret"></i>
			</a>

			<div class="dropdown-menu">
				<ul class="list-unstyled">
					<li class="divider"></li>
										<li>
						<a role="menuitem" tabindex="-1" href="settings"><i class="fa fa-wrench"></i> Settings</a>
					</li>
										<li>
						<a role="menuitem" tabindex="-1" href="profile"><i class="fa fa-user"></i> Edit Profile</a>
					</li>
					<li>
						<a role="menuitem" tabindex="-1" href="signin/logout"><i class="fa fa-power-off"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>
<!-- END: HEADER -->			
			<div class="inner-wrapper">
				<!-- INCLUDEING NAVIGATION -->
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
				<a href="dashboard">
					<i class="fa fa-tachometer"></i>
					<span>Dashboard</span>
				</a>
			</li>
			
			<!-- STUDENT -->
			<li class="nav-parent  ">
				<a>
					 <i class="fa fa-slideshare"></i>
					<span>Student</span>
				</a>
				<ul class="nav nav-children">
					<li class=" ">
						<a href="student">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Student Details</span>
						</a>
					</li>
					<li class=" ">
						<a href="student/add">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Make Admission</span>
						</a>
					</li>
					<li class=" ">
						<a href="admission/view">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Online Admission</span>
						</a>
					</li>
					<li class=" ">
						<a href="student/category">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Make Category</span>
						</a>
					</li>
				</ul>
			</li>

			<!-- STUDENT PROMOTION -->
			<li class=" ">
				<a href="student/promotion">
					 <i class="fa fa-random"></i>
					<span>Student Transfer</span>
				</a>
			</li>
			
			<!-- USER -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-user-circle"></i>
					<span>Users</span>
				</a>
				<ul class="nav nav-children">
					<li class=" ">
						<a href="parents">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Parents</span>
						</a>
					</li>
					<li class=" ">
						<a href="librarian">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Librarian</span>
						</a>
					</li>
					<li class=" ">
						<a href="accountant">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Accountant</span>
						</a>
					</li>
				</ul>
			</li>

			<!-- TEACHER -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-users"></i>
					<span>Teacher</span>
				</a>
				<ul class="nav nav-children">
					<li class=" ">
						<a href="teacher">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Teacher List</span>
						</a>
					</li>
					<li class=" ">
						<a href="teacher/designation">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Add Designation</span>
						</a>
					</li>
					<li class=" ">
						<a href="teacher/add">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Add New Teacher</span>
						</a>
					</li>
				</ul>
			</li>
			
			<!-- HRM -->
			<li class="nav-parent  ">
				<a>
					<i class="glyphicon glyphicon-retweet"></i>
					<span>HRM / Payroll</span>
				</a>
				<ul class="nav nav-children">
					
					<!-- PAYROLL -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-usd" aria-hidden="true"></i>
							<span>Payroll</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="payroll/salary_control">
									<span>Salary Control</span>
								</a>
							</li>
							<li class=" ">
								<a href="payroll/salary">
									<span>Employee Salary</span>
								</a>
							</li>
							<li class=" ">
								<a href="payroll/payslip">
									<span>Generate Payslip</span>
								</a>
							</li>
						</ul>
					</li>
					
					<!-- LEAVE MANAGEMENTS -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-hotel" aria-hidden="true"></i>
							<span>Leave Control</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="leave/category">
									<span>Category</span>
								</a>
							</li>
							<li class=" ">
								<a href="leave">
									<span>Application</span>
								</a>
							</li>
							
						</ul>
					</li>
					
				</ul>
			</li>

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
							<span>Class</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="classes">
									<span>Control Classes</span>
								</a>
							</li>
							<li class=" ">
								<a href="classes/sections">
									<span>Control Sections</span>
								</a>
							</li>
						</ul>
					</li>

					<!-- TIMETABLE -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-clock-o" aria-hidden="true"></i> Timetable						</a>
						<ul class="nav nav-children">
							<li class="">
								<a href="timetable">
									<span>Daily Class Routine</span>
								</a>
							</li>

							<li class="">
								<a href="timetable/make_class">
									<span>Set Class Routine</span>
								</a>
							</li>

							<li class="">
								<a href="timetable/exam_view">
									<span>Exam Timetable</span>
								</a>
							</li>

							<li class="">
								<a href="timetable/make_exam">
									<span>Set Exam Timetable</span>
								</a>
							</li>
						</ul>
					</li>

				   <!-- SUBJECT -->
					<li class=" ">
						 <a href="subject">
							  <i class="fa fa-book"></i>
							 <span>Subject</span>
						 </a>
					</li>

					<!-- TEACHER ASSIGNMENT -->
					<li class=" ">
						 <a href="suggestion">
							 <i class="fa fa-download"></i>
							 <span>Set Assignment</span>
						 </a>
					</li>
					
					<!-- STUDENT AWARD -->
					<li class=" ">
						 <a href="student/award">
							 <i class="fa fa-trophy"></i>
							 <span>Award</span>
						 </a>
					</li>

				</ul>
			</li>

			<!-- ADMINISTRATION -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-bar-chart-o" aria-hidden="true"></i>
					<span>Administration</span>
				</a>
				<ul class="nav nav-children">
					<!-- EXAM -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-graduation-cap"></i>
							<span>Exam</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="exam">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Exam List</span>
								</a>
							</li>
							<li class=" ">
								<a href="exam/term">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Set Exam Term</span>
								</a>
							</li>
							<li class=" ">
								<a href="exam/attendance_report_view">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Exam Attendance</span>
								</a>
							</li>
							<li class=" ">
								<a href="exam/attendance">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Set Attendance</span>
								</a>
							</li>
						</ul>
					</li>

					<!-- MARKS -->
					<li class="nav-parent  ">
						<a>
							<i class="glyphicon glyphicon-pushpin"></i>
							<span>Marks</span>
						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="exam/marks">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Marks Register</span>
								</a>
							</li>
							<li class=" ">
								<a href="exam/grade">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Grades Range</span>
								</a>
							</li>
							<li class=" ">
								<a href="exam/marks_sheet">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Marks Sheet</span>
								</a>
							</li>
						</ul>
					</li>
					
					<!-- ATTENDANCE CONTROL -->
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-line-chart"></i>
							<span> Attendance</span>
						</a>

						<ul class="nav nav-children">

							<li class="">
								<a href="attendance">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Student</span>
								</a>
							</li>

							<li class="">
								<a href="attendance/employees">
									<span><i class="fa fa-genderless" aria-hidden="true"></i> Employees</span>
								</a>
							</li>

						</ul>
					</li>
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
						<a href="library">
							<span><i class="fa fa-circle-o"></i> Books Stock</span>
						</a>
					</li>
					
					<li class="">
						<a href="library/book_category">
							<span><i class="fa fa-circle-o"></i> Books Category</span>
						</a>
					</li>
					
					<li class="">
						<a href="library/book_maintain">
							<span><i class="fa fa-circle-o"></i> Books Maintain</span>
						</a>
					</li>
					
				</ul>
			</li>
			
			<!-- GALLERY -->
			<li class=" ">
				<a href="gallery">
					<i class="fa fa-file-picture-o"></i>
					<span>Media Gallery</span>
				</a>
			</li>
			
			<!-- TRANSPORT -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-bus"></i>
					<span>Transport</span>
				</a>
				<ul class="nav nav-children">
				
					
					<li class="">
						<a href="transport">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Route Control</span>
						</a>
					</li>

					<li class="">
						<a href="transport/vehicle">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Vehicle Control</span>
						</a>
					</li>

					<li class="">
						<a href="transport/user">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Transport Allocation</span>
						</a>
					</li>

				</ul>
			</li>
			
			<!-- HOSTELS -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-sitemap"></i>
					<span>Hostel</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="hostels">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Hostel Control</span>
						</a>
					</li>

					<li class="">
						<a href="hostels/room">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Room Control</span>
						</a>
					</li>
					
					<li class="">
						<a href="hostels/type">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Hostel Type</span>
						</a>
					</li>
					
					<li class="">
						<a href="hostels/user">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Hostel Users</span>
						</a>
					</li>

				</ul>
			</li>
			
			<!-- EVENTS -->
			<li class=" ">
				<a href="event">
					<i class="fa fa-file-text-o"></i>
					<span>Events</span>
				</a>
			</li>
			
		   <!-- FINANCE CONTROL -->
			<li class="nav-parent nav-expanded nav-active ">
				<a>
					<i class="fa fa-cc-visa"></i>
					<span>Finance Control</span>
				</a>
				<ul class="nav nav-children">
					<li class="nav-parent nav-expanded ">
						<a>
							<i class="fa fa-genderless" aria-hidden="true"></i> Fees						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="accounting/payment">
									Make Payments Invoice								</a>
							</li>
							<li class="nav-active ">
								<a href="accounting/invoice_history">
									Fees Collect / History								</a>
							</li>
							<li class=" ">
								<a href="accounting/fee_category">
									</i>Fee Category								</a>
							</li>
						</ul>
					</li>

					<li class="nav-parent  ">
						<a>
							<i class="fa fa-genderless" aria-hidden="true"></i> Balance Sheet						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="accounting/costing">
									Costing Sheet								</a>
							</li>
							<li class=" ">
								<a href="accounting/costing_category">
									Costing Category								</a>
							</li>
							<li class=" ">
								<a href="accounting/earning">
									Earning Sheet								</a>
							</li>
							<li class=" ">
								<a href="accounting/earning_category">
									Earning Category								</a>
							</li>
						</ul>
					</li>

				</ul>
			</li>
			
			<!-- BULK MESSAGE -->
			<li class="nav-parent  ">
				<a>
					<i class="glyphicon glyphicon-comment"></i>
					<span>Bulk Email / SMS</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="bulksms/templates">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Template</span>
						</a>
					</li>

					<li class="">
						<a href="bulksms">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Message</span>
						</a>
					</li>
					<li class="">
						<a href="bulksms/alert">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Alert SMS</span>
						</a>
					</li>
				</ul>
			</li>

			<!-- MESSAGE -->
			<li class=" ">
				<a href="message">
					<i class="fa fa-envelope-o"></i>
					<span>Message</span>
				</a>
			</li>

			<!-- REPORT -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-pie-chart"></i>
					<span>Report</span>
				</a>
				<ul class="nav nav-children">

					<li class="">
						<a href="attendance/student_report">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Student Attendance</span>
						</a>
					</li>

					<li class="">
						<a href="attendance/employees_report">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Employees Attendance</span>
						</a>
					</li>
					
					<li class="">
						<a href="accounting/fees_report">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Balance Fee By Date</span>
						</a>
					</li>

				</ul>
			</li>

			<!-- SETTINGS -->
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-suitcase"></i>
					<span>Settings</span>
				</a>
				<ul class="nav nav-children">
					<li class=" ">
						<a href="settings">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> System Settings</span>
						</a>
					</li>
					<li class=" ">
						<a href="payment/settings">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Payment Settings</span>
						</a>
					</li>
					<li class=" ">
						<a href="smssettings">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> SMS Settings</span>
						</a>
					</li>
					<li class=" ">
						<a href="sessions">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Session Settings</span>
						</a>
					</li>
					<li class=" ">
						<a href="database_backup">
							<span><i class="fa fa-genderless" aria-hidden="true"></i> Database Backup</span>
						</a>
					</li>
				</ul>
			</li>

			<!-- USER PROFILE -->
			<li class=" ">
				<a href="profile">
					<i class="fa fa-lock"></i>
					<span>My Profile</span>
				</a>
			</li>
		</ul>
	 </nav>

	</div>

		<script>
			// Maintain Scroll Position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');
					sidebarLeft.scrollTop = initialPosition;
				}
			}
		</script>

	</div>
</aside>
<!-- end: sidebar -->
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Fees Collect / History</h2>
					</header>

					<!-- INCLUDEING PAGE -->
					<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<header class="panel-heading">
				<h2 class="panel-title">Select Field</h2>
			</header>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<form role="form" action="accounting/invoice_history/search" method="post" class="form-horizontal" , id = "form">
							<div class="form-group">
								<div class="col-sm-6">
									<label class="control-label">
										Class <span class="required">*</span>
									</label>
									<select name="class_id" id="class_id" class="form-control" data-plugin-selectTwo data-width="100%" required data-plugin-options='{ "minimumResultsForSearch": -1 }' 
									onchange="get_sections(this.value)">
										<option value=""> Select Class </option>
																				<option value="1" selected> One</option>
																			</select>
								</div>

								<div class="col-sm-6">
									<label class="control-label"> Section <span class="required">*</span></label>
									<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id ="section_id" required name="section_id">
										<option value=""> Select Class </option>
																				<option value="1"  selected="selected">A</option>
																			</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> Search</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<form role="form" action="accounting/invoice_history/search" method="post" class="form-horizontal">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="control-label">Search by Keyword</label>
									<input name="search_text" class="form-control" placeholder="Search by Name, Roll No, Email Account, Phone No, Address etc.." type="text">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
				<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-credit-card-alt"></i> Invoice List</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
					<thead>
						<tr>
							<th>#</th>
							<th>Student</th>
							<th>Title</th>
							<th>Fee Category</th>
							<th>Total</th>
							<th>Paid</th>
							<th>Due</th>
							<th>Status</th>
							<th>Date</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
												<tr>
							<td>1</td>
							<td>
							Cherri Portnoy							</td>
							<td>fgdff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 200</td>
							<td>$ 4790</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/317" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/317" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/317');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>2</td>
							<td>
							Cherri Portnoy							</td>
							<td>surender</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 350</td>
							<td>$ 1125</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>29/Dec/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/316" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/316" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/316');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>3</td>
							<td>
							Cherri Portnoy							</td>
							<td>School fees</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>12/Nov/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/313" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/313" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/313');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>4</td>
							<td>
							Cherri Portnoy							</td>
							<td>paid</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>30/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/311" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/311" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/311');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>5</td>
							<td>
							Cherri Portnoy							</td>
							<td>1</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 5000</td>
							<td>$ 3500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/303" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/303" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/303');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>6</td>
							<td>
							Cherri Portnoy							</td>
							<td>Zttuu</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>04/Jun/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/299" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/299" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/299');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>7</td>
							<td>
							Cherri Portnoy							</td>
							<td>aa</td>
							<td>Academic Fees</td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>03/Jun/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/297" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/297" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/297');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>8</td>
							<td>
							Cherri Portnoy							</td>
							<td>hhhh</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>31/May/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/296" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/296" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/296');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>9</td>
							<td>
							Cherri Portnoy							</td>
							<td>fee</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>12/May/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/293" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/293" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/293');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>10</td>
							<td>
							Cherri Portnoy							</td>
							<td>Fee</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>04/May/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/290" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/290" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/290');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>11</td>
							<td>
							Cherri Portnoy							</td>
							<td>Class 1 total fees</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 500</td>
							<td>$ 4500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>04/May/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/291" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/291" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/291');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>12</td>
							<td>
							Cherri Portnoy							</td>
							<td>Abc</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/280" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/280" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/280');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>13</td>
							<td>
							Cherri Portnoy							</td>
							<td>Iniform Sales</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/282" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/282" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/282');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>14</td>
							<td>
							Cherri Portnoy							</td>
							<td>Iniform Sales</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 0</td>
							<td>$ 600</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/288" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/288" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/288');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>15</td>
							<td>
							Cherri Portnoy							</td>
							<td>fee</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 8000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>21/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/278" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/278" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/278');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>16</td>
							<td>
							Cherri Portnoy							</td>
							<td>test</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 440</td>
							<td>$ 60</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>20/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/271" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/271" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/271');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>17</td>
							<td>
							Cherri Portnoy							</td>
							<td>Hairspray Invoice</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 500</td>
							<td>$ 4500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>12/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/258" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/258" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/258');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>18</td>
							<td>
							Cherri Portnoy							</td>
							<td>class one fees</td>
							<td>Academic Fees</td>
							<td>$ 13500</td>
							<td>$ 13500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>11/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/265" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/265" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/265');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>19</td>
							<td>
							Cherri Portnoy							</td>
							<td>Summer Trip</td>
							<td>Admission fee</td>
							<td>$ 20000</td>
							<td>$ 20000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/252" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/252" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/252');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>20</td>
							<td>
							Cherri Portnoy							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/245" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/245" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/245');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>21</td>
							<td>
							Cherri Portnoy							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 2000</td>
							<td>$ 3000</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/239" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/239" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/239');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>22</td>
							<td>
							Cherri Portnoy							</td>
							<td>-</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4050</td>
							<td>$ 950</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>13/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/233" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/233" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/233');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>23</td>
							<td>
							Cherri Portnoy							</td>
							<td>PARTIAL FEE COLLECTION</td>
							<td>Admission</td>
							<td>$ 500</td>
							<td>$ 150</td>
							<td>$ 300</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/232" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/232" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/232');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>24</td>
							<td>
							Cherri Portnoy							</td>
							<td>1ST TERM FEE</td>
							<td>Admission</td>
							<td>$ 500</td>
							<td>$ 100</td>
							<td>$ 300</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/231" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/231" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/231');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>25</td>
							<td>
							Cherri Portnoy							</td>
							<td>abc</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4534</td>
							<td>$ 466</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>28/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/230" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/230" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/230');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>26</td>
							<td>
							Cherri Portnoy							</td>
							<td>abc</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4000</td>
							<td>$ 1000</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/229" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/229" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/229');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>27</td>
							<td>
							Cherri Portnoy							</td>
							<td>Annual Examination Fee</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 200</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>01/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/222" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/222" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/222');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>28</td>
							<td>
							Cherri Portnoy							</td>
							<td>Voucher Jan-2018</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>25/Jan/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/215" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/215" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/215');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>29</td>
							<td>
							Cherri Portnoy							</td>
							<td>Exam Fee</td>
							<td></td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/208" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/208" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/208');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>30</td>
							<td>
							Cherri Portnoy							</td>
							<td>facturas octubre</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/185" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/185" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/185');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>31</td>
							<td>
							Cherri Portnoy							</td>
							<td>Indian Rupees</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>01/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/206" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/206" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/206');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>32</td>
							<td>
							Cherri Portnoy							</td>
							<td>About Us</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 600</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>01/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/205" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/205" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/205');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>33</td>
							<td>
							Cherri Portnoy							</td>
							<td>Cash </td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>01/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/204" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/204" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/204');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>34</td>
							<td>
							Cherri Portnoy							</td>
							<td>Prelim</td>
							<td></td>
							<td>$ 1000</td>
							<td>$ 1000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>29/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/200" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/200" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/200');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>35</td>
							<td>
							Cherri Portnoy							</td>
							<td>asdf</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>27/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/195" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/195" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/195');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>36</td>
							<td>
							Cherri Portnoy							</td>
							<td>multi payment</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>26/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/194" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/194" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/194');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>37</td>
							<td>
							Cherri Portnoy							</td>
							<td>Class I fees</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4990</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>26/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/192" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/192" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/192');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>38</td>
							<td>
							Cherri Portnoy							</td>
							<td>derrrr</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>26/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/191" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/191" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/191');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>39</td>
							<td>
							Cherri Portnoy							</td>
							<td>juan</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>25/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/184" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/184" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/184');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>40</td>
							<td>
							Cherri Portnoy							</td>
							<td>Example 1</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4900</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>23/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/182" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/182" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/182');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>41</td>
							<td>
							Rudyard Maddox							</td>
							<td>fgdff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 200</td>
							<td>$ 4790</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/318" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/318" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/318');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>42</td>
							<td>
							Rudyard Maddox							</td>
							<td>asa</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>03/Dec/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/315" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/315" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/315');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>43</td>
							<td>
							Rudyard Maddox							</td>
							<td>kjh</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 555</td>
							<td>$ 4445</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>22/Nov/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/314" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/314" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/314');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>44</td>
							<td>
							Rudyard Maddox							</td>
							<td>mr.</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>12/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/309" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/309" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/309');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>45</td>
							<td>
							Rudyard Maddox							</td>
							<td>1</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 5000</td>
							<td>$ 3500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/304" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/304" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/304');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>46</td>
							<td>
							Rudyard Maddox							</td>
							<td>aa</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4000</td>
							<td>$ 1000</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>03/Jun/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/298" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/298" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/298');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>47</td>
							<td>
							Rudyard Maddox							</td>
							<td>mr</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>29/May/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/295" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/295" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/295');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>48</td>
							<td>
							Rudyard Maddox							</td>
							<td>Abc</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/281" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/281" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/281');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>49</td>
							<td>
							Rudyard Maddox							</td>
							<td>Iniform Sales</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/283" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/283" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/283');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>50</td>
							<td>
							Rudyard Maddox							</td>
							<td>test</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 300</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>20/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/272" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/272" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/272');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>51</td>
							<td>
							Rudyard Maddox							</td>
							<td>Hairspray Invoice</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>12/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/259" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/259" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/259');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>52</td>
							<td>
							Rudyard Maddox							</td>
							<td>class one fees</td>
							<td>Academic Fees</td>
							<td>$ 13500</td>
							<td>$ 13500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>11/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/266" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/266" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/266');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>53</td>
							<td>
							Rudyard Maddox							</td>
							<td>Jjj</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 3000</td>
							<td>$ 1990</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>08/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/264" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/264" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/264');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>54</td>
							<td>
							Rudyard Maddox							</td>
							<td>Summer Trip</td>
							<td>Admission fee</td>
							<td>$ 20000</td>
							<td>$ 20000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/253" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/253" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/253');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>55</td>
							<td>
							Rudyard Maddox							</td>
							<td>hjjjj</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 2100</td>
							<td>$ 2880</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>19/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/251" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/251" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/251');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>56</td>
							<td>
							Rudyard Maddox							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/246" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/246" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/246');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>57</td>
							<td>
							Rudyard Maddox							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/240" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/240" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/240');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>58</td>
							<td>
							Rudyard Maddox							</td>
							<td>-</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>13/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/234" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/234" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/234');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>59</td>
							<td>
							Rudyard Maddox							</td>
							<td>asdasd</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>07/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/228" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/228" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/228');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>60</td>
							<td>
							Rudyard Maddox							</td>
							<td>Annual Examination Fee</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 0</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>01/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/223" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/223" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/223');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>61</td>
							<td>
							Rudyard Maddox							</td>
							<td>Voucher Jan-2018</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>25/Jan/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/216" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/216" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/216');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>62</td>
							<td>
							Rudyard Maddox							</td>
							<td>well</td>
							<td></td>
							<td>$ 20000</td>
							<td>$ 15220</td>
							<td>$ 4780</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>03/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/214" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/214" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/214');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>63</td>
							<td>
							Rudyard Maddox							</td>
							<td>Exam Fee</td>
							<td></td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/209" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/209" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/209');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>64</td>
							<td>
							Rudyard Maddox							</td>
							<td>facturas octubre</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/186" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/186" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/186');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>65</td>
							<td>
							Rudyard Maddox							</td>
							<td>Prelim</td>
							<td></td>
							<td>$ 1000</td>
							<td>$ 1000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>29/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/201" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/201" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/201');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>66</td>
							<td>
							Rudyard Maddox							</td>
							<td>dffdbdf</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 1000</td>
							<td>$ 4000</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>29/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/199" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/199" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/199');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>67</td>
							<td>
							Rudyard Maddox							</td>
							<td>ass</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4444</td>
							<td>$ 556</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>28/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/198" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/198" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/198');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>68</td>
							<td>
							Rudyard Maddox							</td>
							<td>Class I fees</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4990</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>26/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/193" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/193" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/193');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>69</td>
							<td>
							Rudyard Maddox							</td>
							<td>Multistep</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>24/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/183" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/183" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/183');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>70</td>
							<td>
							Sweet Mondal							</td>
							<td>Mr</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 2500</td>
							<td>$ 2500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>16/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/323" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/323" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/323');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>71</td>
							<td>
							Sweet Mondal							</td>
							<td>fgdff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 200</td>
							<td>$ 4790</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/319" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/319" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/319');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>72</td>
							<td>
							Sweet Mondal							</td>
							<td>May 2019</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1200</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>15/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/310" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/310" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/310');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>73</td>
							<td>
							Sweet Mondal							</td>
							<td>1</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 5000</td>
							<td>$ 3500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/305" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/305" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/305');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>74</td>
							<td>
							Sweet Mondal							</td>
							<td>Iniform Sales</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/284" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/284" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/284');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>75</td>
							<td>
							Sweet Mondal							</td>
							<td>test</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 300</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>20/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/273" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/273" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/273');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>76</td>
							<td>
							Sweet Mondal							</td>
							<td>Hairspray Invoice</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>12/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/260" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/260" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/260');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>77</td>
							<td>
							Sweet Mondal							</td>
							<td>class one fees</td>
							<td>Academic Fees</td>
							<td>$ 13500</td>
							<td>$ 13500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>11/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/267" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/267" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/267');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>78</td>
							<td>
							Sweet Mondal							</td>
							<td>Summer Trip</td>
							<td>Admission fee</td>
							<td>$ 20000</td>
							<td>$ 20000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/254" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/254" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/254');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>79</td>
							<td>
							Sweet Mondal							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/247" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/247" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/247');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>80</td>
							<td>
							Sweet Mondal							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/241" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/241" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/241');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>81</td>
							<td>
							Sweet Mondal							</td>
							<td>-</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>13/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/235" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/235" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/235');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>82</td>
							<td>
							Sweet Mondal							</td>
							<td>Annual Examination Fee</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 0</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>01/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/224" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/224" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/224');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>83</td>
							<td>
							Sweet Mondal							</td>
							<td>Voucher Jan-2018</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>25/Jan/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/217" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/217" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/217');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>84</td>
							<td>
							Sweet Mondal							</td>
							<td>Exam Fee</td>
							<td></td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/210" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/210" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/210');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>85</td>
							<td>
							Sweet Mondal							</td>
							<td>Ff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 5</td>
							<td>$ 4995</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/207" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/207" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/207');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>86</td>
							<td>
							Sweet Mondal							</td>
							<td>facturas octubre</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/187" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/187" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/187');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>87</td>
							<td>
							Sweet Mondal							</td>
							<td>Prelim</td>
							<td></td>
							<td>$ 1000</td>
							<td>$ 1000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>29/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/202" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/202" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/202');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>88</td>
							<td>
							Blake Estes							</td>
							<td>fgdff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 200</td>
							<td>$ 4790</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/320" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/320" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/320');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>89</td>
							<td>
							Blake Estes							</td>
							<td>1</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 5000</td>
							<td>$ 3500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/306" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/306" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/306');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>90</td>
							<td>
							Blake Estes							</td>
							<td>zssg</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 200</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>09/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/302" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/302" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/302');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>91</td>
							<td>
							Blake Estes							</td>
							<td>Testing</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 1000</td>
							<td>$ 4000</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>12/May/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/292" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/292" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/292');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>92</td>
							<td>
							Blake Estes							</td>
							<td>mr</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4500</td>
							<td>$ 500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>30/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/289" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/289" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/289');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>93</td>
							<td>
							Blake Estes							</td>
							<td>factura</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/279" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/279" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/279');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>94</td>
							<td>
							Blake Estes							</td>
							<td>Iniform Sales</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/285" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/285" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/285');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>95</td>
							<td>
							Blake Estes							</td>
							<td>test</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 300</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>20/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/274" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/274" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/274');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>96</td>
							<td>
							Blake Estes							</td>
							<td>Hairspray Invoice</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>12/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/261" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/261" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/261');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>97</td>
							<td>
							Blake Estes							</td>
							<td>class one fees</td>
							<td>Academic Fees</td>
							<td>$ 13500</td>
							<td>$ 13500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>11/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/268" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/268" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/268');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>98</td>
							<td>
							Blake Estes							</td>
							<td>Summer Trip</td>
							<td>Admission fee</td>
							<td>$ 20000</td>
							<td>$ 20000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/255" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/255" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/255');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>99</td>
							<td>
							Blake Estes							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/248" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/248" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/248');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>100</td>
							<td>
							Blake Estes							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/242" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/242" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/242');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>101</td>
							<td>
							Blake Estes							</td>
							<td>-</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>13/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/236" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/236" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/236');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>102</td>
							<td>
							Blake Estes							</td>
							<td>Annual Examination Fee</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 0</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>01/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/225" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/225" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/225');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>103</td>
							<td>
							Blake Estes							</td>
							<td>Voucher Jan-2018</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>25/Jan/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/218" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/218" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/218');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>104</td>
							<td>
							Blake Estes							</td>
							<td>Exam Fee</td>
							<td></td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/211" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/211" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/211');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>105</td>
							<td>
							Blake Estes							</td>
							<td>01</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4900</td>
							<td>$ 90</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>29/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/203" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/203" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/203');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>106</td>
							<td>
							Carter Bradford							</td>
							<td>fgdff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 200</td>
							<td>$ 4790</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/321" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/321" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/321');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>107</td>
							<td>
							Carter Bradford							</td>
							<td>ฟหกดฟหกดฟห</td>
							<td>sample route, bus001</td>
							<td>$ 6000</td>
							<td>$ 5000</td>
							<td>$ 1000</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>05/Nov/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/312" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/312" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/312');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>108</td>
							<td>
							Carter Bradford							</td>
							<td>1</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 5000</td>
							<td>$ 3500</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/307" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/307" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/307');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>109</td>
							<td>
							Carter Bradford							</td>
							<td>Iniform Sales</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/286" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/286" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/286');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>110</td>
							<td>
							Carter Bradford							</td>
							<td>test</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 300</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>20/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/275" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/275" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/275');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>111</td>
							<td>
							Carter Bradford							</td>
							<td>Hairspray Invoice</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>12/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/262" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/262" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/262');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>112</td>
							<td>
							Carter Bradford							</td>
							<td>class one fees</td>
							<td>Academic Fees</td>
							<td>$ 13500</td>
							<td>$ 13500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>11/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/269" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/269" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/269');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>113</td>
							<td>
							Carter Bradford							</td>
							<td>Summer Trip</td>
							<td>Admission fee</td>
							<td>$ 20000</td>
							<td>$ 20000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/256" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/256" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/256');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>114</td>
							<td>
							Carter Bradford							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/249" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/249" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/249');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>115</td>
							<td>
							Carter Bradford							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/243" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/243" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/243');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>116</td>
							<td>
							Carter Bradford							</td>
							<td>-</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>13/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/237" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/237" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/237');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>117</td>
							<td>
							Carter Bradford							</td>
							<td>Annual Examination Fee</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 0</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>01/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/226" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/226" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/226');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>118</td>
							<td>
							Carter Bradford							</td>
							<td>Voucher Jan-2018</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>25/Jan/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/219" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/219" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/219');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>119</td>
							<td>
							Carter Bradford							</td>
							<td>Exam Fee</td>
							<td></td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/212" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/212" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/212');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>120</td>
							<td>
							Carter Bradford							</td>
							<td>A student</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 4950</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/196" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/196" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/196');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>121</td>
							<td>
							Shimul Roy							</td>
							<td>fgdff</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 200</td>
							<td>$ 4790</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>07/Jan/2019</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/322" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/322" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/322');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>122</td>
							<td>
							Shimul Roy							</td>
							<td>1</td>
							<td>First Term Fees</td>
							<td>$ 8500</td>
							<td>$ 5799</td>
							<td>$ 2701</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>11/Oct/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/308" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/308" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/308');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>123</td>
							<td>
							Shimul Roy							</td>
							<td>Iniform Sales</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>23/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/287" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/287" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/287');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>124</td>
							<td>
							Shimul Roy							</td>
							<td>test</td>
							<td>books1</td>
							<td>$ 600</td>
							<td>$ 300</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-info'>Partly Paid</span>							</td>

							<td>20/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/276" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/276" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/276');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>125</td>
							<td>
							Shimul Roy							</td>
							<td>Hairspray Invoice</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>12/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/263" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/263" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/263');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>126</td>
							<td>
							Shimul Roy							</td>
							<td>class one fees</td>
							<td>Academic Fees</td>
							<td>$ 13500</td>
							<td>$ 13500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>11/Apr/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/270" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/270" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/270');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>127</td>
							<td>
							Shimul Roy							</td>
							<td>Summer Trip</td>
							<td>Admission fee</td>
							<td>$ 20000</td>
							<td>$ 20000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/257" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/257" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/257');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>128</td>
							<td>
							Shimul Roy							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/250" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/250" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/250');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>129</td>
							<td>
							Shimul Roy							</td>
							<td>ad</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>18/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/244" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/244" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/244');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>130</td>
							<td>
							Shimul Roy							</td>
							<td>-</td>
							<td>Academic Fees</td>
							<td>$ 5000</td>
							<td>$ 0</td>
							<td>$ 5000</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>13/Mar/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/238" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/238" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/238');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>131</td>
							<td>
							Shimul Roy							</td>
							<td>Annual Examination Fee</td>
							<td>transapr</td>
							<td>$ 200</td>
							<td>$ 0</td>
							<td>$ 200</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>01/Feb/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/227" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/227" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/227');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>132</td>
							<td>
							Shimul Roy							</td>
							<td>Voucher Jan-2018</td>
							<td>Monthly Fees</td>
							<td>$ 1500</td>
							<td>$ 0</td>
							<td>$ 1500</td>
							
							<td>
							<span class='label label-danger'>Unpaid</span>							</td>

							<td>25/Jan/2018</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/220" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/220" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/220');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>133</td>
							<td>
							Shimul Roy							</td>
							<td>Exam Fee</td>
							<td></td>
							<td>$ 2000</td>
							<td>$ 2000</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>02/Oct/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/213" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/213" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/213');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
												<tr>
							<td>134</td>
							<td>
							Shimul Roy							</td>
							<td>test</td>
							<td>Monthly Fees</td>
							<td>$ 5000</td>
							<td>$ 2500</td>
							<td>$ 0</td>
							
							<td>
							<span class='label label-success'>Total Paid</span>							</td>

							<td>28/Sep/2017</td>
							<td >
								<!-- PAYMENT LINK  -->
								<a href="accounting/collect_payment/197" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Collect Payment">
								<i class="fa fa-money"></i>
								</a>

								<!-- EDITING LINK -->
								<a href="accounting/invoice_update/197" class="btn btn-primary btn-xs" data-toggle="tooltip"
								data-original-title="Edit" >
								<i class="glyphicon glyphicon-edit"></i>
								</a>

								<!-- STUDENT DELETE LINK -->
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('accounting/maintain/delete/197');">
								<i class="el el-trash"></i>
								</a>
								</a>
							</td>
						</tr>
											</tbody>
				</table>
			</div>
		</section>
			</div>
</div>

<script type="text/javascript">
	function get_sections(class_id) {
		$.ajax( {
			url: 'accounting/get_class_section/' + class_id,
			success: function ( response ) {
				jQuery( '#section_id' ).html( response );
			}
		} );
	}
	
	jQuery(document).ready(function($)
	{
		var datatable = $('#table_export').dataTable({
			bAutoWidth : false,
			ordering: false,
			sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
			oTableTools: {
				sSwfPath: 'assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf',
				aButtons: [
					{
						sExtends: 'pdf',
						sButtonText: 'PDF',
						mColumns: [1,2,3,4,5,6,7,8]
					},
					{
						sExtends: 'csv',
						sButtonText: 'CSV',
						mColumns: [1,2,3,4,5,6,7,8]
					},
					{
						sExtends: 'xls',
						sButtonText: 'Excel',
						mColumns: [1,2,3,4,5,6,7,8]
					},
					{
						sExtends: 'print',
						sButtonText: 'Print',
						sInfo: '',
						fnClick: function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(9, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								if (e.which == 27) {
									datatable.fnSetColumnVis(0, true);
									datatable.fnSetColumnVis(9, true);
								}
							});
						}
						
					}
				]
			}
		});
	});
</script>
				</section>
			</div>
		</section>
		
        <!-- INCLUDES MODAL -->
         	<script type="text/javascript">
		function showAjaxModalZoom( url ) {
			// PRELODER SHOW ENABLE / DISABLE
			jQuery( '#show_modal' ).html( '<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>' );

			// SHOW AJAX RESPONSE ON REQUEST SUCCESS
			$.ajax( {
				url: url,
				success: function ( response ) {
					jQuery( '#show_modal' ).html( response );
				}
			} );
		}
	</script>

	<!-- (STYLE AJAX MODAL)-->
	<div id="show_modal" class="mfp-with-anim modal-block modal-block-primary mfp-hide"></div>

	<script type="text/javascript">
		function confirm_modal( delete_url ) {
			swal( {
				title: "Are you sure?",
				text: "Are you sure that you want to delete this information?",
				type: "warning",
				showCancelButton: true,
				showLoaderOnConfirm: true,
				closeOnConfirm: false,
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "Cancel",
				confirmButtonColor: "#ec6c62"
			}, function () {
				$.ajax( {
					url: delete_url,
					type: "POST"
				} )
				.done( function ( data ) {
					swal( {
						title: "Deleted",
						text: "Information has been successfully deleted",
						type: "success"
					}, function () {
						location.reload();
					} );
				} )
				.error( function ( data ) {
					swal( "Oops", "We couldn't connect to the server!", "error" );
				} );
			} );
		}
	</script>    
		<!-- INCLUDES BOTTOM -->
				<!-- VENDOR -->
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		<script src="assets/vendor/bootstrap-switch/js/bootstrap-switch.min.js"></script>
		<script src="assets/vendor/jquery-ui/jquery-ui.js"></script>
		<script src="assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
		<script src="assets/vendor/select2/js/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>

		<!-- DATATABLES PAGE VENDOR -->
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
        
        <!-- FILEINPUT JS -->
		<script src="assets/javascripts/fileinput.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        	
		<!-- PNOTIFY NOTIFICATIONS JS -->
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- ANIMATIONS APPEAR JS -->
		<script src="assets/vendor/jquery-appear/jquery-appear.js"></script>

        <!-- FORM VALIDATION -->
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- THEME CUSTOM -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- THEME INITIALIZATION FILES -->
		<script src="assets/javascripts/theme.init.js"></script>

        <!-- CALENDAR FILES -->
        <script src="assets/vendor/moment/moment.js"></script>
		<script src="assets/vendor/fullcalendar/fullcalendar.js"></script>

        <!-- CHART FILES -->
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="assets/vendor/snap.svg/snap.svg.js"></script>
		<script src="assets/vendor/snap.svg/snap.svg.js"></script>
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
	
		<!-- USER JS -->
		<script src="assets/javascripts/user_config/dashboard.js"></script>
		<script src="assets/javascripts/user_config/forms_validation.js"></script>
		<script src="assets/javascripts/modals.js"></script>
		
		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$('.table_default').dataTable( {
					bAutoWidth : false,
					ordering: false
				});
			});
		</script>

		<!-- SHOW PNOTIFIVATION -->
		
		
		<script type="text/javascript">
			$('.popup-youtube').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,

				fixedContentPos: false
			});

			$('.thumbnail .mg-toggle').parent()
				.on('show.bs.dropdown', function( ev ) {
					$(this).closest('.mg-thumb-options').css('overflow', 'visible');
				})
				.on('hidden.bs.dropdown', function( ev ) {
					$(this).closest('.mg-thumb-options').css('overflow', '');
				});

			$('.thumbnail').on('mouseenter', function() {
				var toggle = $(this).find('.mg-toggle');
				if ( toggle.parent().hasClass('open') ) {
					toggle.dropdown('toggle');
				}
			});
		</script>	</body>
</html>