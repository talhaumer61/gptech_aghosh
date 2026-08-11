<?php 
//---------------- visitor purpose insert record----------------------
if(isset($_POST['submit_purpose'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT purpose_name  
										FROM ".VISITOR_PURPOSES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND purpose_name = '".cleanvars($_POST['purpose_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: visitor_purposes.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".VISITOR_PURPOSES."(
														purpose_status						, 
														purpose_name						,
														purpose_detail						,
														id_campus 						
													  )
	   											VALUES(
														'".cleanvars($_POST['purpose_status'])."'		, 
														'".cleanvars($_POST['purpose_name'])."'			,
														'".cleanvars($_POST['purpose_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add purpose: "'.cleanvars($_POST['purpose_name']).'" detail';
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
		header("Location: visitor_purposes.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------visitor purpose update reocrd------------------						
																				
if(isset($_POST['changes_purpose'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".VISITOR_PURPOSES." SET  
													purpose_status   ='".cleanvars($_POST['purpose_status'])."' ,
												    purpose_name     ='".cleanvars($_POST['purpose_name'])."'   ,
													purpose_detail   ='".cleanvars($_POST['purpose_detail'])."' ,
												    id_campus
													= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE purpose_id	=     '".cleanvars($_POST['purpose_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update purpose: "'.cleanvars($_POST['purpose_name']).'" details';
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
			header("Location: visitor_purposes.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


