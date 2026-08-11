<?php 
//----------------Message insert record----------------------
if(isset($_POST['submit_message'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT subject  
										FROM ".MESSAGES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND subject = '".cleanvars($_POST['subject'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: message.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
$date = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".MESSAGES."(
														status						, 
														subject						, 
														message						, 
														dated						,
														recipient					,
														id_session					, 
														id_campus 					,
														id_added					,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							, 
														'".cleanvars($_POST['subject'])."'							,
														'".cleanvars($_POST['message'])."'							,
														'".cleanvars($date)."'										,
														'".cleanvars($_POST['recipient'])."'						,
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														Now()														
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Message: "'.cleanvars($_POST['subject']).'" detail';
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
		header("Location: message.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Message Update reocrd----------------------
if(isset($_POST['changes_message'])) { 
//------------------------------------------------
$date = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".MESSAGES." SET  
													status			= '".cleanvars($_POST['status'])."'
												  , subject			= '".cleanvars($_POST['subject'])."' 
												  , message			= '".cleanvars($_POST['message'])."' 
												  , dated			= '".cleanvars($date)."' 
												  , recipient		= '".cleanvars($_POST['recipient'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE id = '".cleanvars($_POST['hostel_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Message: "'.cleanvars($_POST['subject']).'" details';
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
			header("Location: message.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
