<?php
//----------------Attendance insert record----------------------
if(isset($_POST['mark_attendance'])){
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
	//----------------------------------------------------- 
	$sqllmsattendance	= $dblms->querylms("SELECT id
										FROM ".STUDENT_ATTENDANCE."
										WHERE status = '1' AND dated = '".$dated."' AND id_subject = '".$_POST['id_subject']."' 
										AND id_section = '".$_POST['id_section']."' AND id_class = '".$_POST['id_class']."' 
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND id_teacher = '".$_POST['id_teacher']."'
										AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
	//-------------if already exist -------------------------
	if (mysqli_num_rows($sqllmsattendance)) {

		$ref = '?id='.$_POST['id_subject'].'&section='.$_POST['id_section'].'&class='.$_POST['id_class'].'&view=attendance';
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: subject.php.$ref", true, 301);
		exit();
	}
	else{
	//-----------------if not exist--------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".STUDENT_ATTENDANCE."
																(						 
																	status							,
																	dated							,
																	id_subject						,
																	id_class						,
																	id_section						,								 
																	id_teacher						,								 
																	id_session						,
																	id_campus 						,	
																	id_added						,		
																	date_added
																)
															VALUES(	
																	'1'																,	
																	'".cleanvars($dated)."'											, 
																	'".cleanvars($_POST['id_subject'])."'							,
																	'".cleanvars($_POST['id_class'])."'								,
																	'".cleanvars($_POST['id_section'])."'							,							
																	'".cleanvars($_POST['id_teacher'])."'							,							
																	'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,		
																	'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  	,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 		,
																	NOW()	
																)
					  				");
	//----------------------------------------------
	$idsetup = $dblms->lastestid();
	//----------------------------------------------
	for($i=1; $i<= count($_POST['std_id']); $i++){
	$sqllms  = $dblms->querylms("INSERT INTO ".STUDENT_ATTENDANCE_DETAIL."
						(						
							id_setup			,
							id_std				,
							status		
						)
					VALUES(	
							'".cleanvars($idsetup)."'					,
							'".cleanvars($_POST['std_id'][$i])."'		,
							'".cleanvars($_POST['status'][$i])."'
						)
							");
	}
	//--------------------------------------
		if($sqllms) { 
	//--------------------------------------
		$remarks = 'Added Student Attendance ID: "'.cleanvars($idsetup).'"';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																id_user										, 
																filename									, 
																action										,
																dated										,
																ip											,
																remarks										, 
																id_campus				
															)
			
														VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'1'																	, 
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'						,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
										");
			$ref = '?id='.$_POST['id_subject'].'&section='.$_POST['id_section'].'&class='.$_POST['id_class'].'&view=attendance';
	//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: subject.php.$ref", true, 301);
			exit();
	//--------------------------------------
		}
	//--------------------------------------
	}
}



//----------------Attendance update reocrd----------------------
if(isset($_POST['update_attendance'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".STUDENT_ATTENDANCE." SET  
										    id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										  , date_modify	= NOW() 
										  , id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
									 WHERE  id			= '".cleanvars($_POST['id'])."'");
//----------------------------------------------
for($i=1; $i<=count($_POST['std_id']); $i++){
$sqllms  = $dblms->querylms("UPDATE ".STUDENT_ATTENDANCE_DETAIL." SET  
										  status			= '".cleanvars($_POST['status'][$i])."' 
										  WHERE id_std 		= '".cleanvars($_POST['std_id'][$i])."'
										  AND id_setup 		= '".cleanvars($_POST['id'])."'
									");
}
if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Student Attendance ID: "'.cleanvars($_POST['id']).'"';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks										, 
															id_campus				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
			$ref = '?id='.$_POST['id_subject'].'&section='.$_POST['id_section'].'&class='.$_POST['id_class'].'&view=attendance';
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: subject.php.$ref", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

?>