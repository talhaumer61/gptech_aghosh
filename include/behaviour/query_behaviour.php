<?php 
//----------------Behaviour Roles insert record----------------------
if(isset($_POST['submit_role'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT behaviour_name  
										FROM ".BEHAVIOUR_ROLES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND behaviour_name = '".cleanvars($_POST['behaviour_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: student_behaviour_roles.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".BEHAVIOUR_ROLES."(
														role_status						, 
														role_name						, 
														role_detail						, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['role_status'])."'		, 
														'".cleanvars($_POST['role_name'])."'		,
														'".cleanvars($_POST['role_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Behaviour Role: "'.cleanvars($_POST['behaviour_name']).'" detail';
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
		header("Location: student_behaviour_roles.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Behaviour Role Update reocrd----------------------
if(isset($_POST['changes_behaviour_role'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".BEHAVIOUR_ROLES." SET  
													role_status			= '".cleanvars($_POST['role_status'])."'
												  , role_name			= '".cleanvars($_POST['role_name'])."'
												  , role_detail			= '".cleanvars($_POST['role_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE role_id				= '".cleanvars($_POST['role_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Behaviour Role: "'.cleanvars($_POST['role_name']).'" details';
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
			header("Location: student_behaviour_roles.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//----------------Behaviour insert record----------------------
if(isset($_POST['submit_behaviour'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_std, id_role
										FROM ".BEHAVIOURS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_std = '".cleanvars($_POST['id_std'])."' 
										AND id_role = '".cleanvars($_POST['id_role'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: student_behaviour.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//----------------------Date Conversion--------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".BEHAVIOURS."(
														status						, 
														id_std						, 
														id_role						, 
														report						,
														dated						,
														id_campus 					,
														id_added					,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							, 
														'".cleanvars($_POST['id_std'])."'							,
														'".cleanvars($_POST['id_role'])."'							,
														'".cleanvars($_POST['report'])."'							,
														'".cleanvars($dated)."'										,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add AStudent Behaviour: "'.cleanvars($_POST['id_std']).'" detail';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'1'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'										,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: student_behaviour.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Behaviour update reocrd----------------------
if(isset($_POST['changes_behaviour'])) { 
//----------------------Date Conversion--------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".BEHAVIOURS." SET  
													status			= '".cleanvars($_POST['status'])."'
												  , id_std			= '".cleanvars($_POST['id_std'])."' 
												  , id_role			= '".cleanvars($_POST['id_role'])."' 
												  , report			= '".cleanvars($_POST['report'])."' 
												  , dated			= '".cleanvars($dated)."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modfy		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	
												  , date_modify 	= NOW()
   											  WHERE id				= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Student Behaviour: "'.cleanvars($_POST['id_std']).'" details';
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
			header("Location: student_behaviour.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>