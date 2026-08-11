<?php 
//----------------Asdmin insert record----------------------
if(isset($_POST['submitDonor'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT adm_username 
										FROM ".ADMINS." 
										WHERE adm_username = '".cleanvars($_POST['adm_username'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: donorLogin.php", true, 301);
		exit();
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
														adm_logintype					, 
														adm_username					, 
														adm_salt						,
														adm_userpass					,
														adm_fullname					,
														adm_email						, 
														adm_phone						,
														id_campus 						,
														id_added						,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['adm_status'])."'						, 
														'6'															,
														'".cleanvars($_POST['adm_username'])."'						,
														'".cleanvars($salt)."'										,
														'".cleanvars($password)."'									,
														'".cleanvars($_POST['adm_fullname'])."'						,
														'".cleanvars($_POST['adm_email'])."'						,
														'".cleanvars($_POST['adm_phone'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														Now()	
													)");

		//--------------------------------------
		$adm_id = $dblms->lastestid();	
		//--------------------------------------


		//--------------------------------------
		if($sqllms) { 
			$sqllmsStd  = $dblms->querylms("UPDATE ".DONORS." SET id_loginid = '".(cleanvars($adm_id))."' 
												WHERE donor_id = '".cleanvars($_POST['id_donor'])."'");
			unset($sqllmsStd);
			//--------------------------------------
			$remarks = 'Add Donor Login ID:"'.cleanvars($_POST['id_donor']).'"';
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
			header("Location: donorLogin.php", true, 301);
			exit();
			//--------------------------------------
		}
	} // end checker
	//--------------------------------------
} 
//----------------Admin update reocrd----------------------
if(isset($_POST['updateDonor'])) { 
	
	//------------hashing---------------
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	$pass = $_POST['adm_userpass'];
	$password = hash('sha256', $pass . $salt);
	for ($round = 0; $round < 65536; $round++) {
		$password = hash('sha256', $password . $salt);
	}
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET  
												  adm_status	= '".cleanvars($_POST['adm_status'])."'
												, adm_salt		= '".cleanvars($salt)."'
												, adm_userpass	= '".cleanvars($password)."'
												, id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												, date_modify	= Now()
											WHERE adm_id		= '".cleanvars($_POST['adm_id'])."'");

	//--------------------------------------
	if($sqllms) { 
		//Update Donor
		$sqllms  = $dblms->querylms("UPDATE ".DONORS." SET  
													    donor_status	= '".cleanvars($_POST['adm_status'])."'
													  , id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													  , date_modify	= Now()
												WHERE id_loginid	= '".cleanvars($_POST['adm_id'])."'");
		// Make Log
		$remarks = 'Update Donor: "'.cleanvars($_POST['adm_id']).'"';
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
														  )");
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: donorLogin.php", true, 301);
		exit();
	}
}
?>