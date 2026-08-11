<?php 
//--------------- insert record ----------------------
if(isset($_POST['submit_type'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT type_id  
										FROM ".EXAM_TYPES." 
										WHERE type_name = '".cleanvars($_POST['type_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_types.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_TYPES."(
														type_status						, 
														type_name						,  
														type_details 	
													  )
	   											VALUES(
														'".cleanvars($_POST['type_status'])."'		, 
														'".cleanvars($_POST['type_name'])."'		,
														'".cleanvars($_POST['type_details'])."'					
													  )"
							);
							
//--------------------------------------
	$lastid = $dblms->lastestid();
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Exam Type ID: "'.cleanvars($lastid).'" detail';
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
		header("Location: exam_types.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//---------------- update reocrd ----------------------
if(isset($_POST['changes_type'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EXAM_TYPES." SET  
													type_status		= '".cleanvars($_POST['type_status'])."'
												  , type_name		= '".cleanvars($_POST['type_name'])."' 
												  , type_details	= '".cleanvars($_POST['type_details'])."' 
   											  WHERE type_id			= '".cleanvars($_POST['type_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Exam Type ID: "'.cleanvars($_POST['type_id']).'" details';
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
			header("Location: exam_types.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

