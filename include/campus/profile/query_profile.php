<?php 
// Update Profile
if(isset($_POST['changes_profile'])) { 
	$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET  
												    adm_fullname		= '".cleanvars($_POST['adm_fullname'])."' 
												  , adm_email			= '".cleanvars($_POST['adm_email'])."'  
												  , adm_phone			= '".cleanvars($_POST['adm_phone'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE adm_id				= '".cleanvars($_POST['adm_id'])."'");
								
	$adm_id = cleanvars($_POST['adm_id']);			  

	//------------------Image Rename and Storing--------------------
	if(!empty($_FILES['adm_photo']['name'])) { 
		$path_parts 	= pathinfo($_FILES["adm_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/images/admins/';
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['adm_fullname'])).'_'.$adm_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['adm_fullname'])).'_'.$adm_id.".".($extension);
		if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 
			$sqllmsupload  = $dblms->querylms("UPDATE ".ADMINS."
															SET adm_photo = '".$img_fileName."'
													 WHERE  adm_id		  = '".cleanvars($adm_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
			move_uploaded_file($_FILES['adm_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
		}
	}

	if($sqllms) { 
		$remarks = 'Update Profile: "'.cleanvars($_POST['adm_username']).'" details';
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
														  ) ");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: profile.php", true, 301);
			exit();
	}
}

// Change Password
if(isset($_POST['chnage_pass'])){
	//------------hashing---------------
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	$pass = $_POST['cnfrm_pass'];
	$password = hash('sha256', $pass . $salt);
	for ($round = 0; $round < 65536; $round++){
		$password = hash('sha256', $password . $salt);
	}
	//------------hashing---------------
	$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET 
										  adm_salt		= '".cleanvars($salt)."'
										, adm_userpass	= '".cleanvars($password)."'
										, id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
										, date_modify	= NOW()
										  WHERE adm_id	= '".$_SESSION['userlogininfo']['LOGINIDA']."' ");

	if($sqllms){ 
		$remarks = 'Update Password: user id = '.cleanvars($_SESSION['userlogininfo']['LOGINIDA']).' and password = '.cleanvars($_POST['cnfrm_pass']).' details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															  id_user 
															, filename 
															, action
															, dated
															, ip
															, remarks 
															, id_campus				
														  )
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
															, '2'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														  )
									");
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: profile.php", true, 301);
		exit();
	}
}

// Update Doation Target
if(isset($_POST['update_target'])) { 

	$target_date = date('Y-m-d' , strtotime(cleanvars($_POST['target_date'])));

	$sqllms  = $dblms->querylms("UPDATE ".CAMPUS." SET 
									   donation_target	= '".cleanvars($_POST['donation_target'])."' 
									,  target_date		= '".$target_date."'												
									, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
									, date_modify		= NOW() 
								WHERE campus_id			= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ");

	if($sqllms) { 
		$remarks = 'Update Donation Target';
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
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: profile.php", true, 301);
			exit();
	}
}
?>
