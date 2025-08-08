<?php 
//----------------Hostel insert record----------------------
//---- make hostel check if already exist---
if(isset($_POST['submit_roles'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT role_name  
										FROM ".ROLES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND role_name = '".cleanvars($_POST['role_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: roles.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ROLES."(
														role_status	, 
														role_name							,
														role_type						
													  )
	   											VALUES(
														'".cleanvars($_POST['role_status'])."'		, 
														'".cleanvars($_POST['role_name'])."'			,
														'".cleanvars($_POST['role_type'])."'			
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Role: "'.cleanvars($_POST['role_name']).'" detail';
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
		header("Location: roles.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------class update reocrd----------------------
if(isset($_POST['changes_roles'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ROLES." SET  
													role_status		= '".cleanvars($_POST['role_status'])."'
												  , role_name			= '".cleanvars($_POST['role_name'])."' 
												  , role_type				= '".cleanvars($_POST['role_type'])."' 
   											  WHERE role_id			= '".cleanvars($_POST['role_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Roles: "'.cleanvars($_POST['role_name']).'" details';
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
			header("Location: roles.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

