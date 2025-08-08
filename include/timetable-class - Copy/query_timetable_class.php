<?php 
//----------------Timetable insert record----------------------
if(isset($_POST['submit_timetable'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT day, id_room, id_period  
										FROM ".TIMETABEL_DETAIL." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND day =  '".cleanvars($_POST['day'])."'
										OR id_room =  '".cleanvars($_POST['id_room'])."'
										OR id_period =  '".cleanvars($_POST['id_period'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: timetable_classroom.php", true, 301);
		exit();
//--------------------------------------
	} else { 
	//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".TIMETABLE."(
														status							, 
														id_session						, 
														id_class						, 
														id_section						,
														id_campus						,
														id_added						,
														date_added						
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							, 
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_POST['id_class'])."'							,
														'".cleanvars($_POST['id_section'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()				
													  )"
							);
//--------------------------------------
$idsetup = $dblms->lastestid();	
//--------------------------------------
for($i=0; $i<=sizeof($_POST['id_subject']); $i++){
	if(!empty($_POST['day'][$i]) && !empty($_POST['id_subject'][$i]) && !empty($_POST['id_room'][$i]) && !empty($_POST['id_period'][$i]) && !empty($_POST['id_emply'][$i])){
	
	$sqllmsdetail  = $dblms->querylms("INSERT INTO ".TIMETABEL_DETAIL."(
														id_setup						, 
														day								, 
														id_subject						, 
														id_room							,
														id_period						,
														id_teacher						
													  )
	   											VALUES(
														'".cleanvars($idsetup)."'					, 
														'".cleanvars($_POST['day'][$i])."'			,
														'".cleanvars($_POST['id_subject'][$i])."'	,
														'".cleanvars($_POST['id_room'][$i])."'		,
														'".cleanvars($_POST['id_period'][$i])."'	,
														'".cleanvars($_POST['id_emply'][$i])."'				
													  )"
							);
	}
}
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Class Room Timetable: "'.cleanvars($_POST['id_room']).' '.cleanvars($_POST['id_period']).'" detail';
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
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: timetable_classroom.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Timetable Update----------------------
if(isset($_POST['change_timetable'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".TIMETABEL." SET  
													status				= '".cleanvars($_POST['status'])."'
													, id_session			= '".cleanvars($_POST['id_session'])."' 
													, id_class			= '".cleanvars($_POST['id_class'])."' 
													, id_section			= '".cleanvars($_POST['id_section'])."' 
													, id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													, date_modify			=  NOW()
													WHERE id					= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$sqllmsdelte  = $dblms->querylms("DELETE FROM ".TIMETABEL_DETAIL." WHERE id_setup = '".$_POST['id']."'");
//--------------------------------------
	for($i=0; $i<=sizeof($_POST['id_subject']); $i++){
		if(!empty($_POST['day'][$i]) && !empty($_POST['id_subject'][$i]) && !empty($_POST['id_room'][$i]) && !empty($_POST['id_period'][$i]) && !empty($_POST['id_emply'][$i])){
		
		$sqllmsdetail  = $dblms->querylms("INSERT INTO ".TIMETABEL_DETAIL."(
															id_setup						, 
															day								, 
															id_subject						, 
															id_room							,
															id_period						,
															id_teacher						
														)
													VALUES(
															'".cleanvars($_POST['id'])."'					, 
															'".cleanvars($_POST['day'][$i])."'			,
															'".cleanvars($_POST['id_subject'][$i])."'	,
															'".cleanvars($_POST['id_room'][$i])."'		,
															'".cleanvars($_POST['id_period'][$i])."'	,
															'".cleanvars($_POST['id_emply'][$i])."'				
														)"
								);
		}
	}
//------------------------------------------------

	$remarks = 'Update Class Room Timetable: "'.cleanvars($_POST['id_room']).' '.cleanvars($_POST['id_period']).'" details';
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
			header("Location: timetable_classroom.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
//----------------Timetable update reocrd----------------------
if(isset($_POST['submit_timetable'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".TIMETABEL_DETAIL." SET  
													id_setup			= '".cleanvars($_POST['id_setup'])."'
												  , day					= '".cleanvars($_POST['day'])."' 
												  , id_subject			= '".cleanvars($_POST['id_subject'])."' 
												  , id_room				= '".cleanvars($_POST['id_room'])."' 
												  , id_period			= '".cleanvars($_POST['id_period'])."' 
												  , id_teacher			= '".cleanvars($_POST['id_teacher'])."' 
   											  WHERE id					= '".cleanvars($_POST['id'])."'");
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".TIMETABEL." SET  
													status				= '".cleanvars($_POST['status'])."'
												  , id_session			= '".cleanvars($_POST['id_session'])."' 
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
												  , id_section			= '".cleanvars($_POST['id_section'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			=  NOW()
   											  WHERE id					= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Class Room Timetable: "'.cleanvars($_POST['id_room']).' '.cleanvars($_POST['id_period']).'" details';
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
			header("Location: timetable_classroom.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}