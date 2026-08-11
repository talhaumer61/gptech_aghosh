<?php 
//----------------Syllabus insert record----------------------
if(isset($_POST['submit_summer_work'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT summer_id
										FROM ".SUMMER_WORK." 
										WHERE id_month = '".cleanvars($_POST['id_month'])."' AND id_class = '".cleanvars($_POST['id_class'])."'
										AND id_session = '".cleanvars($_POST['id_session'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: summer-work.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SUMMER_WORK."(
														summer_status						, 
														id_type								, 
														id_month							,  
														id_class							, 
														note								,
														id_session							,
														id_added							, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['summer_status'])."'						, 
														'".cleanvars($_POST['id_type'])."'								,
														'".cleanvars($_POST['id_month'])."'								,
														'".cleanvars($_POST['id_class'])."'								,
														'".cleanvars($_POST['note'])."'									,
														'".cleanvars($_POST['id_session'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														NOW()
													  )"
							);
							
	$summer_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['summer_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["summer_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/summer-work/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_class'])).'_'.$summer_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_class'])).'_'.$summer_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".SUMMER_WORK."
															SET summer_file = '".$img_fileName."'
														 WHERE  summer_id	  = '".cleanvars($summer_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['summer_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Summer Work #: '.$summer_id.' "'.cleanvars($_POST['id_class']).'" "'.cleanvars($_POST['id_subject']).'" detail';
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
		header("Location: summer-work.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Syllabs Update reocrd----------------------
if(isset($_POST['changes_summer_work'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".SUMMER_WORK." SET  
													summer_status		= '".cleanvars($_POST['summer_status'])."'
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , id_month			= '".cleanvars($_POST['id_month'])."' 
												  , id_class			= '".cleanvars($_POST['id_class'])."'  
												  , note				= '".cleanvars($_POST['note'])."' 
												  , id_session			= '".cleanvars($_POST['id_session'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE summer_id			= '".cleanvars($_POST['summer_id'])."'");

//--------------------------------------										  
	$summer_id = $_POST['summer_id'];
	//--------------------------------------
	if(!empty($_FILES['summer_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["summer_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/summer-work/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_class'])).'_'.$summer_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_class'])).'_'.$summer_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".SUMMER_WORK."
															SET summer_file = '".$img_fileName."'
													 WHERE  summer_id		  = '".cleanvars($summer_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['summer_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Syllabus: "'.cleanvars($_POST['id_class']).'" "'.cleanvars($_POST['id_subject']).'"details';
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
			header("Location: summer-work.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
