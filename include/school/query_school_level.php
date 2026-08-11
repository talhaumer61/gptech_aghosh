<?php 
//----------------Hostel insert record----------------------
if(isset($_POST['submit_schoollevel'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT level_name  
										FROM ".SCHOOL_LEVEL." 
										WHERE level_name = '".cleanvars($_POST['level_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: school_level.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SCHOOL_LEVEL."(
														level_status						, 
														level_name							,
														no_of_classes						
													  )
	   											VALUES(
														'".cleanvars($_POST['level_status'])."'		, 
														'".cleanvars($_POST['level_name'])."'		,
														'".cleanvars($_POST['no_of_classes'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Level: "'.cleanvars($_POST['level_name']).'" detail';
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
		header("Location: school_level.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
}

//----------------School Leval update reocrd----------------------
if(isset($_POST['changes_schoollevel'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".SCHOOL_LEVEL." SET  
													level_status		= '".cleanvars($_POST['level_status'])."'
												  , level_name			= '".cleanvars($_POST['level_name'])."' 
												  , no_of_classes		= '".cleanvars($_POST['no_of_classes'])."' 
												  WHERE level_id			= '".cleanvars($_POST['level_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update School Level: "'.cleanvars($_POST['level_name']).'" details';
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
			header("Location: school_level.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>