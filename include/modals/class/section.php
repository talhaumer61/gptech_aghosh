//----------------section insert record----------------------
if(isset($_POST['submit_room'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT section_name  
										FROM ".CLASS_SECTIONS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_class = '".cleanvars($_POST['id_class'])."' 
										AND section_name = '".cleanvars($_POST['section_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostelrooms.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".CLASS_SECTIONS."(
														section_status						, 
														section_name						, 
														section_strength						, 
														id_class						,
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['section_status'])."'		, 
														'".cleanvars($_POST['section_name'])."'		,
														'".cleanvars($_POST['section_strength'])."'		,
														'".cleanvars($_POST['id_class'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Class section: "'.cleanvars($_POST['section_name']).'" detail';
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
		header("Location: hostelrooms.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------update reocrd----------------------
if(isset($_POST['changes_room'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".CLASS_SECTIONS." SET  
													section_status		= '".cleanvars($_POST['section_status'])."'
												  , section_name		= '".cleanvars($_POST['section_name'])."' 
												  , section_strength		= '".cleanvars($_POST['section_strength'])."' 
												  , id_class		= '".cleanvars($_POST['id_class'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE section_id			= '".cleanvars($_POST['section_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update section: "'.cleanvars($_POST['section_name']).'" details';
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
			header("Location: hostelrooms.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
