<?php
//----------------Attendance insert record----------------------
if(isset($_POST['submit_attendance']))
 {
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllmscheck  = $dblms->querylms("SELECT dated, id_session, id_campus
										FROM ".STUDENT_ATTENDANCE." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND dated =  '".$dated."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------

		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: attendance_students.php", true, 301);
		exit();
//--------------------------------------
	} else {
	$sqllms  = $dblms->querylms("INSERT INTO ".STUDENT_ATTENDANCE."
					(
						status							,
						dated							,
						id_class						,
						id_section						,								 
						id_session						,
						id_campus 						,	
						id_added						,		
						date_added
					  )
				VALUES(	
						'1'																,	
						'".cleanvars($dated)."'											, 
						'".cleanvars($_POST['class'])."'								,
						'".cleanvars($_POST['section'])."'								,							
						'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,		
						'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  	,
						'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 		,
						NOW()	
					  )
					  	");
//----------------------------------------------
$idsetup = $dblms->lastestid();
//----------------------------------------------
for($i=1; $i<=COUNT($_POST['std_ID']); $i++){
$sqllms  = $dblms->querylms("INSERT INTO ".STUDENT_ATTENDANCE_DETAIL."
					(
														 
						id_setup			,
						id_std				,
						status		
					  )
				VALUES(	
						'".cleanvars($idsetup)."'					,
						'".cleanvars($_POST['std_ID'][$i])."'		,
						'".cleanvars($_POST['arr'][$i])."'
					  )
					  	");
}
	}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Student attendance add: "'.cleanvars($dated).'" detail';
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
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: attendance_students.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------


//----------------Attendance update reocrd----------------------
if(isset($_POST['update_attendance'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".STUDENT_ATTENDANCE." SET  
										    id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										  , date_modify	= NOW() 
										  , id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
									 WHERE  id			= '".cleanvars($_POST['id'])."'
									 ");
//----------------------------------------------
$idsetup = $dblms->lastestid();
//----------------------------------------------
for($i=1; $i<=COUNT($_POST['std_ID']); $i++){
$sqllms  = $dblms->querylms("UPDATE ".STUDENT_ATTENDANCE_DETAIL." SET  
										  status			= '".cleanvars($_POST['arr'][$i])."' 
										  WHERE id_std 		= '".cleanvars($_POST['std_ID'][$i])."'
										  AND id_setup 		= '".cleanvars($_POST['id'])."'
									");
}
if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Students Attendance: "'.cleanvars($dated).'" details';
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
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: attendance_students.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

?>