<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

	error_reporting(0);
	//ini_set('display_errors', 1);
	ob_start();
	ob_clean();
	session_start();

	//DB Connection Credentials
	define('LMS_HOSTNAME'			, 'localhost');
	define('LMS_NAME'				, 'greenprofessiona_mulcms2019');
	define('LMS_USERNAME'			, 'greenprofessiona_cms2020');
	define('LMS_USERPASS'			, 'QoYbFmc)$s5A');

	//DB Tables
	define('ACALENDAR'				, 'cms_academiccalendar');
	define('ACALENDAR_DETAILS'		, 'cms_academiccalendar_details');
	define('ACALENDAR_PARTICULARS'	, 'cms_academiccalendar_particular');
	define('ALUMNI_REGISTRATIONS'	, 'cms_alumni_registrations');
	define('CONTACT_INQUIRY' 		, 'mul_contact_inquiry');
	define('COUNTRIES' 				, 'cms_countries');
	define('DEPARTMENTS' 			, 'cms_departments');
	define('FACULTY'				, 'cms_faculties');
	define('EMPLOYEES'				, 'cms_employees');
	define('EMPLYS_EDUCATION'		, 'cms_employee_educations');
	define('EMPLYS_PUBLICATIONS'	, 'cms_employee_publications');
	define('HRM_DEGREES'			, 'cms_hrm_degrees');
	define('DESIGNATION'			, 'cms_designtions');
	define('EVENT_INQUIRY'			, 'mul_event_inquiry');
	define('GALLERY'				, 'mul_gallery');
	define('LOGFILE' 				, 'mul_logfile');
	define('POSTS' 					, 'mul_posts');
	define('POSTS_CATS' 			, 'mul_post_category');
	define('PROGRAMS'				, 'cms_programs');
	define('STUDYSCHEME'			, 'cms_studyscheme');
	define('STUDYSCHEME_DETAILS'	, 'cms_studyscheme_details');
	define('STUDENTS'				, 'cms_students');
	define('STUDENTS_GRADUATION'	, 'cms_students_graduation');
	define('COURSES'				, 'cms_courses');
	
	define('FEES_SETUP'				, 'cms_fee_setup');
	define('FEES_SETUP_PROGRAM'		, 'cms_fee_setup_program');
	define('PROGRAM_CATS'			, 'cms_programs_categories');
	define('SLIDER' 				, 'mul_slider');
	define('TESTIMONIAL' 			, 'mul_testimonial');

	define('EVENTS' 				, 'mul_events');
	define('EVENTS_REGISTRATIONS' 	, 'mul_events_registration');
	define('PAYFAST_ORDERS' 		, 'cms_payfast_orders');

	define('CALL_ME_BACK'			, 'mul_callmeback');

	define('ADMISSION'				, '_cms_admission_online');
	define('ADMISSION_PROGRAMS'		, 'cms_admission_programs');
	define('ADMISSION_SMINQUIRY'	, 'cms_admission_sminquiries');
	define('ADMISSION_LEADS'		, 'cms_admission_leads');
	define('SETTINGS'				, 'cms_settings');

	define('DOWNLOADS_CATS'			, 'cms_downloads_category');
	define('DOWNLOADS'				, 'cms_downloads');

	//Variables
	$control = (isset($_REQUEST['control']) && $_REQUEST['control'] != '') ? $_REQUEST['control'] : '';
	$page	 = (isset($_REQUEST['page']) && $_REQUEST['page'] != '') ? $_REQUEST['page'] : '';
	$Limit 	 = (isset($_REQUEST['Limit']) && $_REQUEST['Limit'] != '') ? $_REQUEST['Limit'] : '';
	$do 	 = (isset($_REQUEST['do']) && $_REQUEST['do'] != '') ? $_REQUEST['do'] : '';
	$tid	 = (isset($_REQUEST['tid']) && $_REQUEST['tid'] != '') ? $_REQUEST['tid'] : '';
	$cid	 = (isset($_REQUEST['cid']) && $_REQUEST['cid'] != '') ? $_REQUEST['cid'] : '';
	$wrds 	 = (isset($_REQUEST['wrds']) && $_REQUEST['wrds'] != '') ? $_REQUEST['wrds'] : '';
	$zone 	 = (isset($_REQUEST['zone']) && $_REQUEST['zone'] != '') ? $_REQUEST['zone'] : '';
	$dept 	 = (isset($_REQUEST['dept']) && $_REQUEST['dept'] != '') ? $_REQUEST['dept'] : '';
	$staff   = (isset($_REQUEST['staff']) && $_REQUEST['staff'] != '') ? $_REQUEST['staff'] : '';
	$countryid	= (isset($_REQUEST['countryid']) && $_REQUEST['countryid'] != '') ? $_REQUEST['countryid'] : '';
	$city 	 = (isset($_REQUEST['city']) && $_REQUEST['city'] != '') ? $_REQUEST['city'] : '';
	$cityid  = (isset($_REQUEST['cityid']) && $_REQUEST['cityid'] != '') ? $_REQUEST['cityid'] : '';
	$MQI  	 = (isset($_REQUEST['MQI']) && $_REQUEST['MQI'] != '') ? $_REQUEST['MQI'] : '';
	$dated 	 = (isset($_REQUEST['dated']) && $_REQUEST['dated'] != '') ? $_REQUEST['dated'] : '';
	$archive = (isset($_REQUEST['archive']) && $_REQUEST['archive'] != '') ? $_REQUEST['archive'] : '';
	$oid 	 = (isset($_REQUEST['oid']) && $_REQUEST['oid'] != '') ? $_REQUEST['oid'] : '';
	$newspaper = (isset($_REQUEST['newspaper']) && $_REQUEST['newspaper'] != '') ? $_REQUEST['newspaper'] : '';
	$np		 = (isset($_REQUEST['np']) && $_REQUEST['np'] != '') ? $_REQUEST['np'] : '';
	$lkcatid = (isset($_REQUEST['lkcatid']) && $_REQUEST['lkcatid'] != '') ? $_REQUEST['lkcatid'] : '';
	$ip 	 = (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '') ? $_SERVER['REMOTE_ADDR'] : '';

	//Constants
	define('ACADEMIC_SESSION'	, 'Spring 2023');
	define('ADMISSION_SESSION'	, 'Spring 2023');
	define('ORG_IP'				, $ip);
	define('ORG_DO'				, $do);
	define('ORG_EPOCH'			, date("U"));
	define('ORG_CONTROL'		, $control);
	define('ORG_TID'			, $tid);
	define('ORG_OID'			, $oid);
	define('ORG_COUNTRYID'		, $countryid);
	define('ORG_CITYID'			, $cityid);
	define('ORG_MQI'			, $MQI);
	define('ORG_CID'			, $cid);
	define('ORG_NEWSPAPER'		, $newspaper);
	define('ORG_NP'				, $np);
	define('ORG_DATED'			, $dated);
	define('ORG_ARCHIVE'		, $archive);
	define('WEBSITE_ID'			, '21');
	define('WEBSITE_ID2'		, '22');
	define('WEBSITE_ID3'		, '11');
	define('FB_LINKS'			, '3.4M');
	define('TWITTER_FOLLOWS'	, '662K');
	define('TWITTER_ACCOUNT'	, '@OfficialMUL');
	define('FB_ACCOUNT'			, 'https://www.facebook.com/MinhajUniversityLahore');
	define('WEBSITE_NAME'		, 'Minhaj University Lahore');
	define('WEBSITE_NAMEUR'		, 'منہاج یونیورسٹی لاہور');
	define('WEBSITE_EMAIL'		, 'info@mul.edu.pk');
	define('WEBSITE_URL'		, 'https://www.mul.edu.pk');
	define('HREF_MUL'			, 'https://www.mul.edu.pk');
	define('HREF_ADMS'			, 'https://admission.mul.edu.pk');
	define('HREF_MUL_IMG'		, 'https://www.mul.edu.pk');
	define('HREF_CMS_IMG'		, 'https://cms.mul.edu.pk');
	define('TITLE_HEADER'		, "Minhaj University Lahore");
	define('TITLE_HEADERUR'		, "منہاج یونیورسٹی لاہور");
	define('CONFERENCE_ID'		, '6');
	define('CONFERENCE_URL'		, 'icwr-2022');

?>