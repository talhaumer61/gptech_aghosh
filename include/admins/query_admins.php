<?php 
//----------------Asdmin insert record----------------------
if(isset($_POST['submit_admin'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT adm_username, id_campus 
										FROM ".ADMINS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND adm_username = '".cleanvars($_POST['adm_fullname'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: admins.php", true, 301);
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
														adm_username					, 
														adm_salt						,
														adm_userpass					,
														adm_fullname					,
														adm_email						, 
														adm_phone						,
														adm_photo						, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['adm_status'])."'		, 
														'".cleanvars($_POST['adm_type'])."'			,
														'".cleanvars($_POST['adm_username'])."'		,
														'".cleanvars($salt)."'						,
														'".cleanvars($password)."'					,
														'".cleanvars($_POST['adm_fullname'])."'		,
														'".cleanvars($_POST['adm_email'])."'		,
														'".cleanvars($_POST['adm_phone'])."'		,
														'".cleanvars($_POST['adm_photo'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);

//-------------------------Get latest Id------------------
$idsetup = $dblms->lastestid();	
//-------------------------- Add Roles ----------------------
$arraychecked = $_POST['right_name'];
//--------------------------------------
//	 foreach($_POST['right_name'] as $key => $value){
	for($ichk=0; $ichk<=sizeof($_POST['right_name']); $ichk++) {
//--------------------------------------
		if(((!empty($_POST['delete'][$ichk])) || (!empty($_POST['edit'][$ichk])) || (!empty($_POST['view'][$ichk])) || (!empty($_POST['add'][$ichk])))) {		
//--------------------------------------		
	$sqllms  = $dblms->querylms("INSERT INTO ".ADMIN_ROLES."(
														right_name				, 
														added					, 
														updated					, 
														deleted					,
														reporting				,
														view					, 
														right_type				,
														id_adm					
													  )
	   											VALUES(
														'".cleanvars($_POST['right_name'][$ichk])."'		, 
														'".cleanvars($_POST['added'][$ichk])."'				,
														'".cleanvars($_POST['updated'][$ichk])."'			,
														'".cleanvars($_POST['deleted'][$ichk])."'			,
														'".cleanvars($_POST['reporting'][$ichk])."'			,
														'".cleanvars($_POST['view'][$ichk])."'				,
														'".cleanvars($_POST['right_type'][$ichk])."'		,
														'".cleanvars($idsetup)."'				
													  )"
							);
//--------------------------------------
		}
	}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Admin: "'.cleanvars($_POST['adm_username']).'" detail';
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
		header("Location: admins.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Admin update reocrd----------------------
if(isset($_POST['changes_admin'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET  
													adm_status			= '".cleanvars($_POST['adm_status'])."'
												  , adm_type			= '".cleanvars($_POST['adm_type'])."' 
												  , adm_username		= '".cleanvars($_POST['adm_username'])."' 
												  , adm_userpass		= '".cleanvars($_POST['adm_userpass'])."' 
												  , adm_fullname		= '".cleanvars($_POST['adm_fullname'])."' 
												  , adm_email			= '".cleanvars($_POST['adm_email'])."'  
												  , adm_phone			= '".cleanvars($_POST['adm_phone'])."'
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE adm_id			= '".cleanvars($_POST['adm_id'])."'");
//-------------------------Get latest Id------------------
$idsetup = $dblms->lastestid();	
//-------------------------- Add Roles ----------------------
$arraychecked = $_POST['right_name'];
//--------------------------------------
//	 foreach($_POST['right_name'] as $key => $value){
	for($ichk=0; $ichk<=sizeof($_POST['right_name']); $ichk++) {
//--------------------------------------
		if(((!empty($_POST['delete'][$ichk])) || (!empty($_POST['edit'][$ichk])) || (!empty($_POST['view'][$ichk])) || (!empty($_POST['add'][$ichk])))) {		
//--------------------------------------		
	$sqllms  = $dblms->querylms("UPDATE ".ADMIN_ROLES." SET  
													right_name			= '".cleanvars($_POST['right_name'][$ichk])."'
												  , added				= '".cleanvars($_POST['added'][$ichk])."' 
												  , updated				= '".cleanvars($_POST['updated'][$ichk])."' 
												  , deleted				= '".cleanvars($_POST['deleted'][$ichk])."' 
												  , reporting			= '".cleanvars($_POST['reporting'][$ichk])."' 
												  , view				= '".cleanvars($_POST['view'][$ichk])."'  
												  , right_type			= '".cleanvars($_POST['right_type'][$ichk])."' 
												  , id_adm				= '".cleanvars($idsetup)."' 
   											  WHERE adm_id				= '".cleanvars($_POST['adm_id'])."'");
//--------------------------------------
		}
	}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Admin: "'.cleanvars($_POST['adm_username']).'" details';
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
			header("Location: admins.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

?>
