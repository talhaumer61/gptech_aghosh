
	
<!doctype html>
<html class=" sidebar-light sidebar-left-big-icons">
	
	<head>
		<!-- BASIC -->
		<meta charset="UTF-8">
		<title>Books Maintain | Rudras School</title>
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
			<li class="nav-parent nav-expanded nav-active ">
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
					
					<li class="nav-active">
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
			<li class="nav-parent  ">
				<a>
					<i class="fa fa-cc-visa"></i>
					<span>Finance Control</span>
				</a>
				<ul class="nav nav-children">
					<li class="nav-parent  ">
						<a>
							<i class="fa fa-genderless" aria-hidden="true"></i> Fees						</a>
						<ul class="nav nav-children">
							<li class=" ">
								<a href="accounting/payment">
									Make Payments Invoice								</a>
							</li>
							<li class=" ">
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
						<h2>Books Maintain</h2>
					</header>

					<!-- INCLUDEING PAGE -->
					<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<header class="panel-heading">
				<a href="#book_issue" class="btn btn-primary btn-xs modal-with-move-anim pull-right">
				   <i class="fa fa-plus-square"></i> Book Issue				</a>
				<h2 class="panel-title"><i class="fa fa-list"></i> Books List</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
					<thead>
						<tr>
							<th style="width: 50px;">#</th>
							<th>Book Name</th>
							<th>User Type</th>
							<th>User</th>
							<th>Issue Starting Date</th>
							<th>Issue Due Date</th>
							<th>Fine</th>
							<th>Status</th>
							<th>Options</th>
						</tr>
					</thead>
					
					<tbody>
												<tr>
							<td>1</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/11/2018</td>
							<td>31/10/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view252" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view252" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/252" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook252" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook252" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/252" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/31/2018')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>2</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							 							</td>
							<td>24/07/2018</td>
							<td>31/07/2018</td>
							<td>$ 5</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view251" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view251" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/251" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/9.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		  (Roll-)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td>  </td>
																		<th> Section </th>
																		<td>  </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 24/07/2018 </td>
																		<th> Fine </th>
																		<td> $ 5 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/251');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>3</td>
							<td>Pride and Prejudice</td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>30/04/2018</td>
							<td>30/04/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view250" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view250" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/250" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 30/04/2018 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/250');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>4</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>27/04/2018</td>
							<td>27/04/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view249" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view249" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/249" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 30/04/2018 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/249');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>5</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>08/04/2018</td>
							<td>08/04/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view247" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view247" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/247" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook247" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook247" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/247" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('04/08/2018')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>6</td>
							<td>Kair</td>
							<td>Teacher</td>
							<td>
														</td>
							<td>06/04/2018</td>
							<td>13/04/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view246" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view246" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/246" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/4.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																																				</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Kair </td>
																		<th> Author </th>
																		<td> Thakazhy </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> D C Books </td>
																		<th> Book ISBN No </th>
																		<td> N9876  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook246" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook246" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/246" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('04/13/2018')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>7</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>14/03/2018</td>
							<td>20/03/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view245" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view245" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/245" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 22/12/2018 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/245');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>8</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>25/02/2018</td>
							<td>28/02/2018</td>
							<td>$ 25</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view244" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view244" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/244" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 27/02/2018 </td>
																		<th> Fine </th>
																		<td> $ 25 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/244');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>9</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view243" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view243" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/243" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook243" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook243" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/243" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('01/01/1970')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>10</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view242" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view242" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/242" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook242" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook242" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/242" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('01/01/1970')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>11</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view241" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view241" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/241" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/241" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/241" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>12</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view240" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view240" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/240" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/240" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/240" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>13</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view239" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view239" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/239" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/239" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/239" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>14</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view238" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view238" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/238" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/238" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/238" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>15</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view237" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view237" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/237" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/237" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/237" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>16</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view236" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view236" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/236" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/236" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/236" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>17</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view235" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view235" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/235" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/235" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/235" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>18</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view234" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view234" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/234" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/234" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/234" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>19</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view233" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view233" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/233" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/233" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/233" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>20</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view232" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view232" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/232" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/232" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/232" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>21</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view231" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view231" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/231" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/231" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/231" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>22</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view230" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view230" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/230" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/230" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/230" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>23</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view229" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view229" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/229" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/229" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/229" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>24</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view228" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view228" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/228" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/228" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/228" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>25</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view227" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view227" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/227" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/227" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/227" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>26</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view226" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view226" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/226" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/226" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/226" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>27</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view225" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view225" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/225" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/225" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/225" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>28</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view224" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view224" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/224" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/224" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/224" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>29</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view223" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view223" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/223" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/223" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/223" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>30</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view222" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view222" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/222" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/222" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/222" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>31</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view221" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view221" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/221" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook221" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook221" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/221" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('01/01/1970')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>32</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view220" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view220" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/220" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/220" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/220" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>33</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view219" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view219" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/219" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/219" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/219" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>34</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view218" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view218" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/218" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/218" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/218" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>35</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view217" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view217" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/217" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/217" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/217" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>36</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view216" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view216" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/216" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/216" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/216" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>37</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view215" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view215" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/215" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/215" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/215" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>38</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view214" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view214" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/214" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/214" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/214" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>39</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view213" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view213" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/213" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/213" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/213" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>40</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view212" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view212" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/212" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/212" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/212" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>41</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view211" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view211" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/211" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/211" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/211" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>42</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view210" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view210" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/210" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/210" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/210" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>43</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view209" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view209" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/209" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/209" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/209" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>44</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view208" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view208" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/208" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/208" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/208" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>45</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view207" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view207" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/207" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/207" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/207" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>46</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view206" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view206" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/206" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/206" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/206" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>47</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view205" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view205" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/205" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/205" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/205" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>48</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view204" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view204" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/204" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/204" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/204" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>49</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view203" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view203" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/203" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook203" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook203" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/203" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('01/01/1970')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>50</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view202" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view202" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/202" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/202" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/202" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>51</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view201" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view201" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/201" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/201" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/201" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>52</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view200" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view200" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/200" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/200" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/200" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>53</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view199" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view199" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/199" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/199" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/199" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>54</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view198" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view198" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/198" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/198" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/198" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>55</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view197" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view197" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/197" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/197" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/197" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>56</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view196" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view196" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/196" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/196" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/196" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>57</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view195" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view195" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/195" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/195" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/195" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>58</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view194" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view194" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/194" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/194" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/194" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>59</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view193" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view193" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/193" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/193" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/193" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>60</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view192" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view192" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/192" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/192" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/192" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>61</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view191" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view191" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/191" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/191" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/191" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>62</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view190" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view190" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/190" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/190" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/190" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>63</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view189" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view189" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/189" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/189" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/189" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>64</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view188" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view188" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/188" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/188" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/188" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>65</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view187" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view187" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/187" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/187" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/187" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>66</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view186" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view186" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/186" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/186" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/186" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>67</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view185" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view185" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/185" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/185" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/185" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>68</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view184" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view184" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/184" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/184" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/184" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>69</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view183" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view183" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/183" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/183" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/183" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>70</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view182" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view182" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/182" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/182" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/182" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>71</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view181" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view181" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/181" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/181" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/181" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>72</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view180" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view180" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/180" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/180" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/180" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>73</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view179" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view179" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/179" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/179" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/179" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>74</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view178" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view178" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/178" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/178" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/178" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>75</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view177" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view177" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/177" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/177" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/177" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>76</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view176" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view176" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/176" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/176" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/176" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>77</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view175" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view175" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/175" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/175" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/175" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>78</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view174" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view174" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/174" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/174" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/174" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>79</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view173" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view173" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/173" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/173" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/173" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>80</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view172" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view172" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/172" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/172" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/172" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>81</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view171" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view171" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/171" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/171" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/171" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>82</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view170" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view170" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/170" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/170" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/170" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>83</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view169" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view169" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/169" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/169" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/169" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>84</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view168" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view168" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/168" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/168" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/168" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>85</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view167" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view167" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/167" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/167" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/167" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>86</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view166" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view166" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/166" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/166" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/166" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>87</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view165" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view165" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/165" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/165" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/165" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>88</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view164" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view164" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/164" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/164" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/164" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>89</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view163" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view163" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/163" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/163" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/163" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>90</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view162" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view162" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/162" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/162" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/162" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>91</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view161" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view161" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/161" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/161" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/161" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>92</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view160" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view160" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/160" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/160" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/160" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>93</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view159" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view159" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/159" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/159" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/159" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>94</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view158" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view158" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/158" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/158" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/158" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>95</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view157" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view157" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/157" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/157" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/157" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>96</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view156" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view156" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/156" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/156" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/156" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>97</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view155" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view155" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/155" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/155" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/155" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>98</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view154" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view154" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/154" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/154" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/154" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>99</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view153" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view153" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/153" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/153" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/153" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>100</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view152" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view152" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/152" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/152" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/152" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>101</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view151" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view151" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/151" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/151" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/151" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>102</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view150" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view150" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/150" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/150" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/150" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>103</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view149" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view149" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/149" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/149" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/149" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>104</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>01/01/1970</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view148" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view148" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/148" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/148" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/148" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>105</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view147" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view147" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/147" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/147" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/147" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>106</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view146" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view146" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/146" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/146" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/146" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>107</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view145" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view145" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/145" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/145" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/145" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>108</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view144" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view144" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/144" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/144" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/144" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>109</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view143" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view143" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/143" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/143" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/143" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>110</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view142" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view142" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/142" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/142" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/142" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>111</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view141" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view141" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/141" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/141" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/141" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>112</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view140" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view140" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/140" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/140" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/140" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>113</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view139" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view139" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/139" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/139" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/139" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>114</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view138" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view138" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/138" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/138" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/138" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>115</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view137" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view137" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/137" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/137" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/137" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>116</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view136" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view136" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/136" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/136" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/136" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>117</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view135" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view135" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/135" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/135" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/135" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>118</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view134" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view134" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/134" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/134" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/134" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>119</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view133" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view133" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/133" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/133" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/133" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>120</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view132" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view132" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/132" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/132" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/132" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>121</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view131" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view131" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/131" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/131" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/131" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>122</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view130" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view130" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/130" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/130" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/130" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>123</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view129" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view129" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/129" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/129" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/129" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>124</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view128" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view128" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/128" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/128" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/128" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>125</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view127" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view127" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/127" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/127" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/127" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>126</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view126" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view126" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/126" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/126" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/126" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>127</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view125" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view125" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/125" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/125" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/125" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>128</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view124" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view124" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/124" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/124" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/124" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>129</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view123" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view123" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/123" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/123" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/123" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>130</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view122" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view122" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/122" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/122" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/122" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>131</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view121" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view121" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/121" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/121" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/121" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>132</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view120" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view120" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/120" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/120" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/120" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>133</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view119" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view119" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/119" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/119" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/119" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>134</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view118" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view118" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/118" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/118" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/118" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>135</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view117" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view117" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/117" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/117" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/117" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>136</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view116" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view116" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/116" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/116" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/116" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>137</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view115" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view115" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/115" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/115" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/115" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>138</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view114" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view114" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/114" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/114" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/114" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>139</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view113" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view113" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/113" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/113" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/113" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>140</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view112" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view112" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/112" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/112" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/112" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>141</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view111" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view111" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/111" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/111" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/111" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>142</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view110" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view110" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/110" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/110" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/110" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>143</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view109" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view109" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/109" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/109" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/109" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>144</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view108" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view108" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/108" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/108" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/108" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>145</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view107" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view107" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/107" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/107" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/107" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>146</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view106" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view106" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/106" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/106" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/106" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>147</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view105" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view105" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/105" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/105" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/105" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>148</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view104" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view104" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/104" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/104" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/104" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>149</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view103" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view103" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/103" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/103" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/103" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>150</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view102" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view102" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/102" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/102" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/102" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>151</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view101" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view101" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/101" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/101" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/101" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>152</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view100" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view100" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/100" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/100" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/100" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>153</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view99" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view99" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/99" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/99" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/99" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>154</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view98" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view98" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/98" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/98" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/98" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>155</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view97" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view97" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/97" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/97" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/97" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>156</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view96" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view96" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/96" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/96" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/96" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>157</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view95" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view95" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/95" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/95" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/95" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>158</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view94" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view94" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/94" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/94" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/94" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>159</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view93" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view93" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/93" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/93" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/93" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>160</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view92" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view92" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/92" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/92" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/92" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>161</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view91" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view91" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/91" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/91" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/91" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>162</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view90" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view90" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/90" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/90" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/90" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>163</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view89" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view89" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/89" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/89" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/89" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>164</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view88" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view88" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/88" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/88" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/88" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>165</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view87" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view87" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/87" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/87" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/87" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>166</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view86" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view86" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/86" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/86" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/86" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>167</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view85" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view85" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/85" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/85" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/85" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>168</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view84" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view84" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/84" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/84" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/84" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>169</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view83" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view83" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/83" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/83" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/83" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>170</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view82" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view82" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/82" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/82" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/82" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>171</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view81" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view81" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/81" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/81" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/81" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>172</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view80" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view80" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/80" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/80" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/80" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>173</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view79" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view79" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/79" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/79" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/79" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>174</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view78" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view78" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/78" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/78" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/78" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>175</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view77" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view77" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/77" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/77" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/77" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>176</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view76" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view76" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/76" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/76" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/76" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>177</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view75" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view75" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/75" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/75" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/75" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>178</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view74" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view74" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/74" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/74" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/74" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>179</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view73" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view73" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/73" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/73" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/73" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>180</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view72" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view72" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/72" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/72" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/72" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>181</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view71" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view71" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/71" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/71" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/71" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>182</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view70" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view70" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/70" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/70" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/70" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>183</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view69" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view69" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/69" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/69" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/69" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>184</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view68" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view68" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/68" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/68" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/68" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>185</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view67" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view67" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/67" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/67" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/67" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>186</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view66" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view66" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/66" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/66" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/66" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>187</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view65" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view65" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/65" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/65" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/65" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>188</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view64" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view64" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/64" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/64" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/64" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>189</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view63" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view63" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/63" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/63" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/63" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>190</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view62" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view62" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/62" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/62" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/62" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>191</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view61" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view61" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/61" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/61" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/61" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>192</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view60" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view60" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/60" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/60" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/60" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>193</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view59" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view59" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/59" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/59" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/59" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>194</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view58" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view58" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/58" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/58" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/58" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>195</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view57" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view57" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/57" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/57" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/57" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>196</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view56" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view56" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/56" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/56" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/56" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>197</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view55" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view55" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/55" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/55" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/55" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>198</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view54" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view54" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/54" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/54" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/54" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>199</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view53" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view53" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/53" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/53" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/53" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>200</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view52" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view52" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/52" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/52" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/52" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>201</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view51" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view51" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/51" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/51" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/51" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>202</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view50" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view50" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/50" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/50" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/50" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>203</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view49" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view49" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/49" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/49" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/49" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>204</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view48" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view48" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/48" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/48" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/48" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>205</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view47" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view47" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/47" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/47" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/47" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>206</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view46" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view46" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/46" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/46" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/46" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>207</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view45" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view45" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/45" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/45" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/45" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>208</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/01/1970</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view44" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view44" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/44" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/44" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/44" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>209</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view43" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view43" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/43" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/43" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/43" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>210</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view42" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view42" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/42" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/42" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/42" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>211</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/01/2018</td>
							<td>27/01/2018</td>
							<td>$ 0</td>
							<td>
								<span class="label label-warning" style="font-size: 10px;">Pending</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view41" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view41" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/41" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-primary btn-xs" style = "width: 65px" href = "library/book_maintain/accept/41" >
								<i class = "fa fa-check" ></i> Accept </a>
								<a class = "btn btn-danger btn-xs" style = "width: 60px" href = "library/book_maintain/reject/41" >
								<i class = "fa fa-close" ></i> Reject </a>

								<!-- RETURN MODAL DIALOGBOX -->
															</td>
						</tr>
												<tr>
							<td>212</td>
							<td>Poetry</td>
							<td>Student</td>
							<td>
							Sweet Mondal							</td>
							<td>18/10/2017</td>
							<td>18/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view40" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view40" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/40" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/3.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Sweet Mondal (Roll-103)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Poetry </td>
																		<th> Author </th>
																		<td> Ather Abass </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Johan </td>
																		<th> Book ISBN No </th>
																		<td> 21212  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook40" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook40" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/40" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/18/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>213</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>25/10/2017</td>
							<td>31/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view39" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view39" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/39" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook39" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook39" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/39" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/31/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>214</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Blake Estes							</td>
							<td>18/10/2017</td>
							<td>27/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view38" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view38" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/38" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/4.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Blake Estes (Roll-104)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook38" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook38" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/38" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/27/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>215</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>03/10/2017</td>
							<td>03/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view37" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view37" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/37" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook37" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook37" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/37" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/03/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>216</td>
							<td>Poetry</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>01/10/2017</td>
							<td>10/10/2017</td>
							<td>$ 5</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view36" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view36" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/36" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Poetry </td>
																		<th> Author </th>
																		<td> Ather Abass </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 10/10/2017 </td>
																		<th> Fine </th>
																		<td> $ 5 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Johan </td>
																		<th> Book ISBN No </th>
																		<td> 21212  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/36');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>217</td>
							<td>To Kill a Mockingbird </td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>30/09/2017</td>
							<td>30/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-danger" >Rejected</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view35" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view35" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/35" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/35');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>218</td>
							<td>To Kill a Mockingbird </td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>30/09/2017</td>
							<td>30/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view34" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view34" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/34" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook34" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook34" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/34" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/30/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>219</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/09/2017</td>
							<td>05/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view33" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view33" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/33" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook33" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook33" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/33" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/05/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>220</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>29/09/2017</td>
							<td>02/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view32" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view32" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/32" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook32" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook32" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/32" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('10/02/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>221</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Blake Estes							</td>
							<td>29/09/2017</td>
							<td>13/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view31" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view31" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/31" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/4.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Blake Estes (Roll-104)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 29/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/31');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>222</td>
							<td>Pride and Prejudice</td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>27/09/2017</td>
							<td>28/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view30" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view30" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/30" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook30" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook30" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/30" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/28/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>223</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>28/09/2017</td>
							<td>30/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view29" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view29" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/29" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 29/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/29');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>224</td>
							<td>Pride and Prejudice</td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>26/09/2017</td>
							<td>26/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view28" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view28" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/28" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook28" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook28" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/28" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/26/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>225</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Blake Estes							</td>
							<td>25/09/2017</td>
							<td>30/09/2017</td>
							<td>$ 10</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view27" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view27" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/27" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/4.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Blake Estes (Roll-104)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 01/10/2017 </td>
																		<th> Fine </th>
																		<td> $ 10 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/27');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>226</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>24/09/2017</td>
							<td>27/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view26" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view26" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/26" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 28/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/26');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>227</td>
							<td>Pride and Prejudice</td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>25/09/2017</td>
							<td>25/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view25" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view25" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/25" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook25" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook25" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/25" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/25/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>228</td>
							<td>Pride and Prejudice</td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>25/09/2017</td>
							<td>28/09/2017</td>
							<td>$ 60</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view24" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view24" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/24" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 27/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 60 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/24');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>229</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>14/09/2017</td>
							<td>21/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view23" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view23" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/23" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 24/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/23');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>230</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>22/09/2017</td>
							<td>30/09/2017</td>
							<td>$ 2</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view22" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view22" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/22" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 30/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 2 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/22');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>231</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>07/09/2017</td>
							<td>10/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view20" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view20" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/20" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook20" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook20" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/20" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/10/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>232</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>17/09/2017</td>
							<td>26/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view19" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view19" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/19" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 18/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/19');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>233</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>17/09/2017</td>
							<td>25/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view18" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view18" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/18" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 26/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/18');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>234</td>
							<td>To Kill a Mockingbird </td>
							<td>Teacher</td>
							<td>
							Anzo Perez							</td>
							<td>17/09/2017</td>
							<td>28/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view17" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view17" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/17" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/teacher_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Teacher </td>
																		<th> Name </th>
																		<td>
																		Anzo Perez																		</td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook17" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook17" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/17" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/28/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>235</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>26/09/2017</td>
							<td>29/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view16" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view16" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/16" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 27/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/16');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>236</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>14/09/2017</td>
							<td>14/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view15" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view15" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/15" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook15" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook15" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/15" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/14/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>237</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>13/09/2017</td>
							<td>20/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view14" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view14" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/14" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 14/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/14');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>238</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>13/09/2017</td>
							<td>15/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view13" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view13" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/13" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook13" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook13" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/13" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/15/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>239</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Carter Bradford							</td>
							<td>11/09/2017</td>
							<td>21/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view12" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view12" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/12" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/5.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Carter Bradford (Roll-105)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook12" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook12" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/12" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/21/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>240</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>10/09/2017</td>
							<td>10/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view11" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view11" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/11" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook11" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook11" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/11" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/10/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>241</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>20/09/2017</td>
							<td>06/10/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-danger" >Rejected</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view10" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view10" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/10" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/10');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>242</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>05/09/2017</td>
							<td>20/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-danger" >Rejected</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view9" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view9" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/9" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/9');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>243</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>20/09/2017</td>
							<td>20/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view8" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view8" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/8" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook8" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook8" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/8" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/20/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>244</td>
							<td>Pride and Prejudice</td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>02/09/2017</td>
							<td>02/09/2017</td>
							<td>$ 5</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view6" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view6" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/6" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> Pride and Prejudice </td>
																		<th> Author </th>
																		<td> Jane Austen </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 13/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 5 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Modern Library </td>
																		<th> Book ISBN No </th>
																		<td>  0679783261  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/6');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>245</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>06/09/2017</td>
							<td>29/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view5" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view5" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/5" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook5" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook5" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/5" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/29/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>246</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>04/08/2017</td>
							<td>08/09/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-success" style="font-size: 10px;">Issued</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view4" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view4" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/4" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td>  -- / -- / ---- </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a class = "btn btn-default btn-xs modal-with-move-anim" style = "width: 65px" href = "#addbook4" > <i class = "fa fa-history" ></i> 
								Return</a>
								<div id="addbook4" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/4" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-history"></i> Return</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">

												<div class="form-group">
													<label class="col-md-3 control-label">
														Type <span class="required">*</span>
													</label>
													<div class="col-sm-9">
													<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="returntype" required 
													title="Must Be Required" id="returnID" onchange="ReturnType('09/08/2017')" 
													class="form-control populate">
														<option value="">Select</option>
														<option value="return" selected >Return</option>
														<option value="renewal" >Renewal</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" id="returntext">
														Return Date <span class="required">*</span>
													</label>
													<div class="col-sm-9"><input type="text" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
													class="form-control" name="return_date" id="return_date" required title="Must Be Required"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">
														Fine Amount													</label>
													<div class="col-sm-9"><input type="text" class="form-control" value="" name="fine_amount"/>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Create													</button>
													<button class="btn btn-default modal-dismiss">
														Cancel													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>

								<!-- DELETE LINK -->
															</td>
						</tr>
												<tr>
							<td>247</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>10/08/2017</td>
							<td>11/08/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view3" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view3" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/3" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 05/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/3');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
												<tr>
							<td>248</td>
							<td>To Kill a Mockingbird </td>
							<td>Student</td>
							<td>
							Cherri Portnoy							</td>
							<td>09/08/2017</td>
							<td>16/08/2017</td>
							<td>$ 0</td>
							<td>
								<span class="label label-primary" style="font-size: 10px;">Returned</span>							</td>
							<td>
							
							    <!-- DETAILS MODAL DIALOGBOX -->
								<a class = "btn btn-primary btn-xs modal-sizes modal-with-zoom-anim" href = "#view2" > <i class = "fa fa-user-circle-o" ></i></a>
								<div id="view2" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
									<section class="panel panel-featured panel-featured-primary">
										<form action="library/book_maintain/return/2" class="form-horizontal validate" method="post" accept-charset="utf-8">
										<header class="panel-heading">
											<h2 class="panel-title"><i class="fa fa-user-circle-o"></i> Book Details</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="row">
													<div class="col-md-2 mb-xs">
														<img class="img-thumbnail" width="110" height="110" src="uploads/student_image/1.jpg">
													</div>
													<div class="col-md-10">
														<div class="table-responsive">
															<table class="table table-striped table-condensed mb-none">
																<tbody>
																	<tr>
																		<th> User Type </th>
																		<td> Student </td>
																		<th> Name </th>
																		<td>
																		Cherri Portnoy (Roll-101)																		</td>
																	</tr>
																																		<tr>
																		<th> Class </th>
																		<td> One </td>
																		<th> Section </th>
																		<td> A </td>
																	</tr>
																																		<tr>
																		<th> Book Name </th>
																		<td> To Kill a Mockingbird  </td>
																		<th> Author </th>
																		<td> Harper Lee </td>
																	</tr>
																	<tr>
																		<th> Return Date </th>
																		<td> 05/09/2017 </td>
																		<th> Fine </th>
																		<td> $ 0 </td>
																	</tr>
																	<tr>
																		<th> Publisher </th>
																		<td> Harper Perennial Modern Classics  </td>
																		<th> Book ISBN No </th>
																		<td>  0061120081  </td>
																	</tr>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">
														Done													</button>
												</div>
											</div>
										</footer>
										</form>
									</section>
								</div>
						
																<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('library/book_maintain/delete/2');"> 
								<i class="el el-trash"></i>  Delete</a>
															</td>
						</tr>
											</tbody>
				</table>
			</div>
		</section>
		
		<!-- BOOK ISSUE MODAL BOX -->
		<div id="book_issue" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
			<section class="panel panel-featured panel-featured-primary">
			<form action="library/maintain/book_issue/" class="form-horizontal validate" method="post" accept-charset="utf-8">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-plus-square"></i> Book Issue</h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
						<div class="form-group">
							<label class="col-md-3 control-label">Book Category <span class="required">*</span></label>
							<div class="col-sm-9">
								<select data-plugin-selectTwo data-plugin-selectTwo data-width="100%" name="book_category" onchange="return get_books_categorys(this.value)" required
								title="Must Be Required" class="form-control populate">
                                    	<option value="">Select</option>
                                    	                                    	<option value="check">check</option>
                                                                            	<option value="Novel">Novel</option>
                                                                            	<option value="Shahzad Ahmad">Shahzad Ahmad</option>
                                        								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Book Name <span class="required">*</span></label>
							<div class="col-md-9">
								<select data-plugin-selectTwo data-plugin-selectTwo data-width="100%" name="book_name" id="book_name_holder" required title="Must Be Required" class="form-control populate">
                                    	<option value="">Select</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">User Type <span class="required">*</span></label>
							<div class="col-md-9">
								<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" onchange="return get_user_name(this.value)" name="user_type"
								required title="Must Be Required" class="form-control populate">
									<option value="">Select</option>
									<option value="student" >Student</option>
									<option value="teacher" >Teacher</option>
								</select>
							</div>
						</div>
						 
						<div id="hidden_class_section" style = 'display: none;' >
							<div class="form-group">
								<label class="col-md-3 control-label">Class <span class="required">*</span></label>
								<div class="col-md-9">
									<select name="class_id" id="class_id" class="form-control mb-sm" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%"
									required title="Must Be Required" onchange="select_section(this.value)">
										<option value="">Select Class</option>
																				<option value="1">One</option>
																			</select>
								</div>
							</div>

							<div class="form-group mb-md">
								<label class="control-label col-md-3">Section <span class="required">*</span></label>
								<div class="col-md-9">
									<select class="form-control mb-md" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" name="section_id" 
									onchange="get_student(this.value)" id="section_holder">
										<option value="">Select Class First</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">User Name <span class="required">*</span></label>
							<div class="col-md-9">
								<select data-plugin-selectTwo data-plugin-selectTwo data-width="100%" name="user_id" id="user_name_holder" required
								title="Must Be Required" class="form-control populate">
                                    	<option value="">Select</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">
								Date <span class="required">*</span>
							</label>
							<div class="col-md-9">
								<div class="input-daterange input-group" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' >
									<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								
									<input type="text" class="form-control" name="issue_start_date" required title="Must Be Required">
									<span class="input-group-addon">to</span>
									<input type="text" class="form-control" name="issue_end_date">
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary">Save</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
			</form>
			</section>
		</div>
	</div>
</div>

<script type="text/javascript">

	function select_section( class_id ) {
		$.ajax( {
			url: 'library/get_class_section/' + class_id,
			success: function ( response ) {
				jQuery( '#section_holder' ).html( response );
			}
		} );
	}
	
	function get_books_categorys( category ) {
		$.ajax( {
			url: 'library/get_books/' + category,
			success: function ( response ) {
				jQuery( '#book_name_holder' ).html( response );
			}
		} );
	}
	
	function get_student( section_id ) {
		var class_id = document.getElementById("class_id").value;
		$.ajax( {
			url: 'library/get_students/' + class_id + '/' + section_id,
			success: function ( response ) {
				jQuery( '#user_name_holder' ).html( response );
			}
		} );
	}
	
	function get_user_name( type ) {
		if(type == 'student'){
			$("#hidden_class_section").show(400);
		} else {
			$("#hidden_class_section").hide(400);
		}
		$.ajax( {
			url: 'library/get_user_name/' + type,
			success: function ( response ) {
				jQuery( '#user_name_holder' ).html( response );
			}
		});
	}	
	
	function ReturnType( date ) {
		var x = document.getElementById("returnID").value;
		if(x == 'return') {
			document.getElementById("returntext").innerHTML = "Return Date <span class='required'>*</span>";
			document.getElementById("return_date").value    =   "";
		} else if(x == 'renewal') {
			document.getElementById("returntext").innerHTML = "Issue Due Date <span class='required'>*</span>";
			document.getElementById("return_date").value    =   date;
		}
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
						mColumns: [1,2,3,4,5,6,7]
					},
					{
						sExtends: 'csv',
						sButtonText: 'CSV',
						mColumns: [1,2,3,4,5,6,7]
					},
					{
						sExtends: 'xls',
						sButtonText: 'Excel',
						mColumns: [1,2,3,4,5,6,7]
					},
					{
						sExtends: 'print',
						sButtonText: 'Print',
						sInfo: '',
						fnClick: function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(8, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								if (e.which == 27) {
									datatable.fnSetColumnVis(0, true);
									datatable.fnSetColumnVis(8, true);
								}
							});
						}
					}
				]
			}
		});
	});
</script>				</section>
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