<?php 
//----------------Hostel insert record----------------------
if(isset($_POST['submit_group'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT group_name  
										FROM ".GROUPS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND group_name = '".cleanvars($_POST['group_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: class-groups.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".GROUPS."(
														group_status					, 
														group_code						, 
														group_name						,
														id_campus
																
													  )
	   											VALUES(
														'".cleanvars($_POST['group_status'])."'		, 
														'".cleanvars($_POST['group_code'])."'		,
														'".cleanvars($_POST['group_name'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Class Group: "'.cleanvars($_POST['group_name']).'" detail';
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
		header("Location: class-groups.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Class Group update reocrd----------------------
if(isset($_POST['change_group'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".GROUPS." SET  
													group_status		= '".cleanvars($_POST['group_status'])."'
												  , group_code			= '".cleanvars($_POST['group_code'])."' 
												  , group_name			= '".cleanvars($_POST['group_name'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											 		WHERE group_id		= '".cleanvars($_POST['group_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Class Group: "'.cleanvars($_POST['group_name']).'" details';
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
			header("Location: class-groups.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
