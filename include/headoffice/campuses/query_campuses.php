<?php 
//----------------campus insert record----------------------
if(isset($_POST['submit_campus'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT campus_name  
										FROM ".CAMPUS." 
										WHERE campus_name = '".cleanvars($_POST['campus_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: campuses.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".CAMPUS."(
														campus_id										, 
														campus_status									,
														campus_regno									, 
														campus_code 									,
														campus_name										,
														campus_address									,
														campus_email									,
														campus_phone									,
														campus_head										,
														campus_fax										,
														campus_website									,
														campus_logo	
													  )
	   											VALUES(
														'".cleanvars($_POST['campus_id'])."'			, 
														'".cleanvars($_POST['campus_status'])."'		,
														'".cleanvars($_POST['campus_regno'])."'			,
														'".cleanvars($_POST['campus_code'])."'			,		
														'".cleanvars($_POST['campus_name'])."'			,
														'".cleanvars($_POST['campus_address'])."'		,
														'".cleanvars($_POST['campus_email'])."'			,
														'".cleanvars($_POST['campus_phone'])."'			,
														'".cleanvars($_POST['campus_head'])."'			,
														'".cleanvars($_POST['campus_fax'])."'			,	
														'".cleanvars($_POST['campus_website'])."'		,
														'".cleanvars($_POST['campus_logo'])."'			
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Campus: "'.cleanvars($_POST['campus_name']).'" detail';
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
		header("Location: campuses.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------School campus update reocrd----------------------
if(isset($_POST['changes_campus'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".CAMPUS." SET  
													campus_status		= '".cleanvars($_POST['campus_status'])."'
												  , campus_regno		= '".cleanvars($_POST['campus_regno'])."' 
												  , campus_code			= '".cleanvars($_POST['campus_code'])."'
												  , campus_name			= '".cleanvars($_POST['campus_name'])."'
												  , campus_address		= '".cleanvars($_POST['campus_address'])."'
												  , campus_email		= '".cleanvars($_POST['campus_email'])."'
												  , campus_phone		= '".cleanvars($_POST['campus_phone'])."'
												  , campus_head			= '".cleanvars($_POST['campus_head'])."'
												  , campus_fax			= '".cleanvars($_POST['campus_fax'])."'
												  , campus_website		= '".cleanvars($_POST['campus_website'])."'
												  , campus_logo			= '".cleanvars($_POST['campus_logo'])."'

   											  		WHERE campus_id		= '".cleanvars($_POST['campus_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Campus: "'.cleanvars($_POST['campus_name']).'" details';
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
			header("Location: campuses.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>
