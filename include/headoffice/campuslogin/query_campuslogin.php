<?php 
//----------------Asdmin insert record----------------------
if(isset($_POST['submit_campuslogin'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT adm_username 
										FROM ".ADMINS." 
										WHERE adm_username = '".cleanvars($_POST['adm_username'])."' 
										AND adm_logintype = '2' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: campuslogin.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//-------------------------- Admin Information ----------------------

//------------hashing---------------

	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	$pass = $_POST['adm_userpass'];
	$password = hash('sha256', $pass . $salt);
	for ($round = 0; $round < 65536; $round++) {
		$password = hash('sha256', $password . $salt);
	}
//------------hashing---------------

	$sqllms  = $dblms->querylms("INSERT INTO ".ADMINS."(
														adm_status						,  
														adm_type						, 
														adm_logintype					, 
														adm_username					, 
														adm_salt						,
														adm_userpass					,
														adm_fullname					,
														adm_email						, 
														adm_phone						,
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['adm_status'])."'		, 
														'1'											,
														'2'											,
														'".cleanvars($_POST['adm_username'])."'		,
														'".cleanvars($salt)."'						,
														'".cleanvars($password)."'					,
														'".cleanvars($_POST['adm_fullname'])."'		,
														'".cleanvars($_POST['adm_email'])."'		,
														'".cleanvars($_POST['adm_phone'])."'		,
														'".cleanvars($_POST['id_campus'])."'	
													  )"
							);
	//--------------------------------------
	if($sqllms) { 
		$adm_id = $dblms->lastestid();	
	//--------------------------------------
		$remarks = 'Add Campus Login: "'.cleanvars($_POST['adm_username']).'"';
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
															'".cleanvars($remarks)."'					,			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: campuslogin.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Admin update reocrd----------------------
if(isset($_POST['changes_campuslogin'])) { 

	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	$pass = $_POST['adm_userpass'];
	$password = hash('sha256', $pass . $salt);
	for ($round = 0; $round < 65536; $round++) {
		$password = hash('sha256', $password . $salt);
	}
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET  
													adm_status			= '".cleanvars($_POST['adm_status'])."' 
												  , adm_username		= '".cleanvars($_POST['adm_username'])."' 
												  , adm_salt			= '".cleanvars($salt)."' 
												  , adm_userpass		= '".cleanvars($password)."' 
												  , adm_fullname		= '".cleanvars($_POST['adm_fullname'])."' 
												  , adm_email			= '".cleanvars($_POST['adm_email'])."'  
												  , adm_phone			= '".cleanvars($_POST['adm_phone'])."'
   											  WHERE adm_id			= '".cleanvars($_POST['adm_id'])."'");
											  

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Update Campus Login: "'.cleanvars($_POST['adm_username']).'"';
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
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: campuslogin.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
}
?>