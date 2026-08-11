<?php 
//----------------insert record----------------------
if(isset($_POST['submit_resources'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT res_title, id_session, id_class, id_section, id_subject, id_campus 
										FROM ".RESOURCES." 
										WHERE res_title = '".cleanvars($_POST['res_title'])."' 
										AND id_session = '1'
										AND id_class = '".cleanvars($_POST['id_class'])."'
										AND id_section = '".cleanvars($_POST['id_section'])."'
										AND id_subject = '".cleanvars($_POST['id_subject'])."'
										AND id_campus  = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: resources.php", true, 301);
		exit();
//--------------------------------------
	} else { 
	$sqllms  = $dblms->querylms("INSERT INTO ".RESOURCES."(
														res_status							, 
														res_title							, 
														res_detail							,  
														id_session							,
														id_class 							,
														id_section							, 
														id_subject							,
														id_campus							,
														id_added							, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['res_status'])."'						,  
														'".cleanvars($_POST['res_title'])."'						, 
														'".cleanvars($_POST['res_detail'])."'						,
														'1'															,	
														'".cleanvars($_POST['id_class'])."'							,	
														'".cleanvars($_POST['id_section'])."'						,	
														'".cleanvars($_POST['id_subject'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
							
	$res_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['res_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["res_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/resources/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars('1-'.$_POST['id_class'].'-'.$_POST['id_section'].'-'.$_POST['id_subject'])).'_'.res_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars('1-'.$_POST['id_class'].'-'.$_POST['id_section'].'-'.$_POST['id_subject'])).'_'.$res_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".RESOURCES."
															SET res_file  = '".$img_fileName."'
														 WHERE  res_id  = '".cleanvars($res_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['res_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Resource: "'.cleanvars($_POST['id_class']).'"("'.cleanvars($_POST['id_section']).'")-"'.cleanvars($_POST['id_subject']).'" detail';
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
															'".cleanvars($remarks)."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: resources.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Update reocrd----------------------
if(isset($_POST['changes_resources'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".RESOURCES." SET  
													res_status		= '".cleanvars($_POST['res_status'])."'
												  ,	res_title			= '".cleanvars($_POST['res_title'])."'
												  , res_detail			= '".cleanvars($_POST['res_detail'])."' 
												  , id_session			= '1' 
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
												  , id_section			= '".cleanvars($_POST['id_section'])."'
												  , id_subject			= '".cleanvars($_POST['id_subject'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE res_id			= '".cleanvars($_POST['res_id'])."'");

	$res_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['res_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["res_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/resources/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars('1-'.$_POST['id_class'].'-'.$_POST['id_section'].'-'.$_POST['id_subject'])).'_'.res_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars('1-'.$_POST['id_class'].'-'.$_POST['id_section'].'-'.$_POST['id_subject'])).'_'.$res_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".RESOURCES."
															SET res_file  = '".$img_fileName."'
														 WHERE  res_id  = '".cleanvars($res_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['res_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Resources: "'.cleanvars($_POST['id_class']).'"("'.cleanvars($_POST['id_section']).'")-"'.cleanvars($_POST['id_subject']).'"details';
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
			header("Location: resources.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
