<?php 
//----------------Hostel Type insert record----------------------
if(isset($_POST['submit_hostel_type'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT type_name  
										FROM ".HOSTEL_TYPES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND type_name = '".cleanvars($_POST['hostel_type_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostels-type.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".HOSTEL_TYPES."(
														type_status						, 
														type_name							, 
														type_detail								, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['hostel_type_status'])."'		, 
														'".cleanvars($_POST['hostel_type_name'])."'			,
														'".cleanvars($_POST['hostel_type_detail'])."'				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Hostel_Type: "'.cleanvars($_POST['hostel_type_name']).'" detail';
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
		header("Location: hostels-type.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Hostel Type update reocrd----------------------
if(isset($_POST['changes_hostel_type'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".HOSTEL_TYPES." SET  
													type_status		= '".cleanvars($_POST['hostel_type_status'])."'
												  , type_name			= '".cleanvars($_POST['hostel_type_name'])."' 
												  , type_detail				= '".cleanvars($_POST['hostel_type_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE type_id			= '".cleanvars($_POST['hostel_type_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel_Type: "'.cleanvars($_POST['hostel_type_name']).'" details';
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
			header("Location: hostels-type.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

