<?php 
//----------------Hostel insert record----------------------
if(isset($_POST['submit_hostel'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT guardian_phone  
										FROM ".GUARDIANS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND guardian_phone = '".cleanvars($_POST['guardian_phone'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: guardians.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".GUARDIANS."(
														guardian_status				,
														guardian_name				,
														guardian_relation			, 
														guardian_phone				, 
														guardian_email				,
														guardian_address			,
														id_loginid					, 
														id_campus 					,
														id_added					,
														date_added					
													  )
	   											VALUES(
														'".cleanvars($_POST['guardian_status'])."'					, 
														'".cleanvars($_POST['guardian_name'])."'					,
														'".cleanvars($_POST['guardian_relation'])."'				,
														'".cleanvars($_POST['guardian_phone'])."'					,
														'".cleanvars($_POST['guardian_email'])."'					,
														'".cleanvars($_POST['guardian_address'])."'					,
														'".cleanvars($_POST['id_loginid'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Guardian: "'.cleanvars($_POST['guardian_name']).'" detail';
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
		header("Location: guardians.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Hostelupdate reocrd----------------------
if(isset($_POST['changes_guardian'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".GUARDIANS." SET  
													guardian_status		= '".cleanvars($_POST['guardian_status'])."'
												  , guardian_name		= '".cleanvars($_POST['guardian_name'])."' 
												  , guardian_relation	= '".cleanvars($_POST['guardian_relation'])."' 
												  ,	guardian_email		= '".cleanvars($_POST['guardian_email'])."' 
												  , guardian_phone 		= '".cleanvars($_POST['guardian_phone'])."' 
												  , guardian_address	= '".cleanvars($_POST['guardian_address'])."' 
												  , id_loginid 			= '".cleanvars($_POST['id_loginid'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify 		= NOW()
   											  WHERE guardian_id			= '".cleanvars($_POST['guardian_id'])."'");
											  
																
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update gUARDIAN: "'.cleanvars($_POST['guardian_name']).'" details';
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
			header("Location: guardians.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>