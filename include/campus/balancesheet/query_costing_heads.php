<?php
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
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: costinghead.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


//---------------- Delete reocrd----------------------
// if(isset($_GET['deleteid'])) { 
// 	//------------------------------------------------
// 	$sqllms  = $dblms->querylms("UPDATE ".ACCOUNT_HEADS." SET  
// 														  is_deleted			= '1'
// 														, id_deleted			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
// 														, ip_deleted			= '".$ip."'
// 														, date_deleted			= NOW()
// 													 WHERE head_id 			= '".cleanvars($_GET['deleteid'])."'");
// 	//--------------------------------------
// 		if($sqllms) { 
// 	//--------------------------------------
// 		$remarks = 'Coasting Head Deleted ID: "'.cleanvars($_GET['deleteid']).'" details';
// 			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
// 																id_user										, 
// 																filename									, 
// 																action										,
// 																dated										,
// 																ip											,
// 																remarks										, 
// 																id_campus				
// 															  )
			
// 														VALUES(
// 																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
// 																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
// 																'3'											, 
// 																NOW()										,
// 																'".cleanvars($ip)."'						,
// 																'".cleanvars($remarks)."'						,
// 																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
// 															  )
// 										");
// 	//--------------------------------------
// 				$_SESSION['msg']['title'] 	= 'Warning';
// 				$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
// 				$_SESSION['msg']['type'] 	= 'warning';
// 				header("Location: costinghead.php", true, 301);
// 				exit();
// 	//--------------------------------------
// 		}
// 	//--------------------------------------
// 	}
?>