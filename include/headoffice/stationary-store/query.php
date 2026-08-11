<?php
//----------------STATIONARY STORE ADD----------------------
if(isset($_POST['submit_store'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT store_name  
										FROM ".INVENTORY_STORES." 
										WHERE store_name = '".cleanvars($_POST['store_name'])."' 
										OR store_code = '".cleanvars($_POST['store_code'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary-store.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_STORES."(
														store_status					, 
														store_name						, 
														store_code						, 
														store_detail		
													  )
	   											VALUES(
														'".cleanvars($_POST['store_status'])."'		, 
														'".cleanvars($_POST['store_name'])."'		,
														'".cleanvars($_POST['store_code'])."'		,
														'".cleanvars($_POST['store_detail'])."'			
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Stationary Store: "'.cleanvars($_POST['store_name']).'" detail';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks							
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
		header("Location: stationary-store.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------STATIONARY STORE UPDATE----------------------
if(isset($_POST['changes_store'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_STORES." SET  
													store_status		= '".cleanvars($_POST['store_status'])."'
												  , store_name			= '".cleanvars($_POST['store_name'])."' 
												  , store_code			= '".cleanvars($_POST['store_code'])."' 
												  , store_detail		= '".cleanvars($_POST['store_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE store_id			= '".cleanvars($_POST['store_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Stationary Store: "'.cleanvars($_POST['store_name']).'" details';
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
			header("Location: stationary-store.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>