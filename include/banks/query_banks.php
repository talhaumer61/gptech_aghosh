<?php 
//----------------Bank insert record----------------------
if(isset($_POST['submit_bank'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT hostel_name  
										FROM ".BANKS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND bank_name = '".cleanvars($_POST['bank_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: banks.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".BANKS."(
														bank_status						, 
														bank_name						, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['bank_status'])."'		, 
														'".cleanvars($_POST['bank_name'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Bank: "'.cleanvars($_POST['bankl_name']).'" detail';
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
		header("Location: banks.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Bank update reocrd----------------------
if(isset($_POST['changes_bank'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".BANKS." SET  
													bank_status		= '".cleanvars($_POST['bank_status'])."'
												  , bank_name		= '".cleanvars($_POST['bank_name'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE bank_id			= '".cleanvars($_POST['bank_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Bank: "'.cleanvars($_POST['bank_name']).'" details';
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
			header("Location: banks.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
