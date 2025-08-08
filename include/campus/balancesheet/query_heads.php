<?php 
//----------------Earning Head Insert--------------------
if(isset($_POST['submit_earning_head'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT head_name  
										FROM ".ACCOUNT_HEADS." 
										WHERE head_name = '".cleanvars($_POST['head_name'])."' AND head_type = '1'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: earninghead.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_HEADS."(
														head_status							, 
														head_name							,
														head_type							,  
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['head_status'])."'		, 
														'".cleanvars($_POST['head_name'])."'		,
														'1'											,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//-----------------------end---------------
		if($sqllms) { 
//--------------------------------------
			$remarks = 'Add Earning Head: "'.cleanvars($_POST['head_name']).'"';
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
			header("Location: earninghead.php", true, 301);
			exit();
//--------------------------------------
		}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------Earning Head Update-------------
if(isset($_POST['changes_earning_head'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ACCOUNT_HEADS." SET  
													head_status		= '".cleanvars($_POST['head_status'])."'
												  , head_name		= '".cleanvars($_POST['head_name'])."' 
   											  WHERE head_id			= '".cleanvars($_POST['head_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Update Income Head: "'.cleanvars($_POST['head_name']).'"';
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
			header("Location: earninghead.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//----------------Costing Head Insert--------------------
if(isset($_POST['submit_costing_head'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT head_name  
										FROM ".ACCOUNT_HEADS." 
										WHERE head_name = '".cleanvars($_POST['head_name'])."'  AND head_type = '2'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: costinghead.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_HEADS."(
														head_status							, 
														head_name							,
														head_type							,  
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['head_status'])."'		, 
														'".cleanvars($_POST['head_name'])."'		,
														'2'											,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//-----------------------end---------------
		if($sqllms) { 
//--------------------------------------
			$remarks = 'Add Costing Head: "'.cleanvars($_POST['head_name']).'"';
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
			header("Location: costinghead.php", true, 301);
			exit();
//--------------------------------------
		}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------Costing Head Update-------------
if(isset($_POST['changes_costing_head'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ACCOUNT_HEADS." SET  
													head_status		= '".cleanvars($_POST['head_status'])."'
													, head_name		= '".cleanvars($_POST['head_name'])."' 
													WHERE head_id			= '".cleanvars($_POST['head_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Update Costing Head: "'.cleanvars($_POST['head_name']).'"';
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
			header("Location: costinghead.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}