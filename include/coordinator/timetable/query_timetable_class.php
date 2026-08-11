<?php 
//----------------Timetable insert record----------------------
if(isset($_POST['submit_timetable'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_session, id_class, id_section 
										FROM ".TIMETABLE." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND id_class = '".cleanvars($_POST['class'])."' 
										AND id_section = '".cleanvars($_POST['section'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: timetable.php", true, 301);
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
														'".cleanvars($_POST['status'])."'								, 
														'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,
														'".cleanvars($_POST['class'])."'								,
														'".cleanvars($_POST['section'])."'								,	
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
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
	$remarks = 'Add Timetable of class: "'.cleanvars($_POST['class']).' and section: "'.cleanvars($_POST['section']).'" detail';
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
		header("Location: timetable.php", true, 301);
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
$sqllms  = $dblms->querylms("UPDATE ".TIMETABLE." SET  
													  status			= '".cleanvars($_POST['status'])."'
													, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													, date_modify		=  NOW()
													WHERE id			= '".cleanvars($_POST['id'])."'");
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

	$remarks = 'Update Timetable of class: "'.cleanvars($_POST['id_class']).' and section: '.cleanvars($_POST['id_period']).'" details';
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
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: timetable.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


//---------------- Delete reocrd----------------------
if(isset($_GET['deleteid'])) { 
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".TIMETABLE." SET  
														  is_deleted				= '1'
														, id_deleted				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, ip_deleted				= '".$ip."'
														, date_deleted			= NOW()
													WHERE id 			= '".cleanvars($_GET['deleteid'])."'");
	//--------------------------------------
		if($sqllms) { 
	//--------------------------------------
		$remarks = 'Timetable Deleted ID: "'.cleanvars($_GET['id']).'" details';
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
																'3'											, 
																NOW()										,
																'".cleanvars($ip)."'						,
																'".cleanvars($remarks)."'						,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															  )
										");
	//--------------------------------------
				$_SESSION['msg']['title'] 	= 'Warning';
				$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
				$_SESSION['msg']['type'] 	= 'warning';
				header("Location: timetable.php", true, 301);
				exit();
	//--------------------------------------
		}
	//--------------------------------------
	}

?>