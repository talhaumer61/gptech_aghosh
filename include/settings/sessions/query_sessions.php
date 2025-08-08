<?php 
//----------------insert record----------------------
if(isset($_POST['submit_session'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT session_name  
										FROM ".SESSIONS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND session_name = '".cleanvars($_POST['session_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: sessions.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 

//------------------------------------------------
$start_date = date("Y-m-d", strtotime($_POST['session_startdate']));
//------------------------------------------------

	$sqllms  = $dblms->querylms("INSERT INTO ".SESSIONS."(
														session_status			, 
														session_name			,
														session_startdate		,  
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['session_status'])."'					, 
														'".cleanvars($_POST['session_name'])."'						,
														'".cleanvars($start_date)."'								,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Session: "'.cleanvars($_POST['session_name']).'" detail';
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
		header("Location: sessions.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------update reocrd----------------------
if(isset($_POST['changes_session'])) { 

//------------------------------------------------
$start_date = date("Y-m-d", strtotime($_POST['session_startdate']));
//------------------------------------------------

$sqllms  = $dblms->querylms("UPDATE ".SESSIONS." SET  
													session_status		= '".cleanvars($_POST['session_status'])."'
												  , session_name		= '".cleanvars($_POST['session_name'])."' 
												  , session_startdate	= '".cleanvars($start_date)."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE session_id			= '".cleanvars($_POST['session_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Session: "'.cleanvars($_POST['session_name']).'" details';
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
			header("Location: sessions.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

