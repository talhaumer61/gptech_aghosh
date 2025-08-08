<?php 
//----------------insert record----------------------
if(isset($_POST['submit_scheme'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id 
										FROM ".SCHEME_OF_STUDY." 
										WHERE term = '".cleanvars($_POST['term'])."' 
										AND id_session = '".cleanvars($_POST['id_session'])."' 
										AND id_class = '".cleanvars($_POST['id_class'])."'
										AND id_subject = '".cleanvars($_POST['id_subject'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: scheme_of_study.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SCHEME_OF_STUDY."(
														status								, 
														title								, 
														term								, 
														id_session							,
														id_class							, 
														id_subject							,
														note								,
														id_added							, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							,  
														'".cleanvars($_POST['title'])."'							,  
														'".cleanvars($_POST['term'])."'								, 
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_POST['id_class'])."'							,
														'".cleanvars($_POST['id_subject'])."'						,
														'".cleanvars($_POST['note'])."'								,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
							
	$id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/scheme_of_study/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'])).'_'.$id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'])).'_'.$id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".SCHEME_OF_STUDY."
															SET file = '".$img_fileName."'
														 WHERE  id	 = '".cleanvars($id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Scheme of Study Added ID: "'.cleanvars($id).'" detail';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'1'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: scheme_of_study.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Update reocrd----------------------
if(isset($_POST['changes_scheme'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".SCHEME_OF_STUDY." SET  
													status				= '".cleanvars($_POST['status'])."'
												  ,	title				= '".cleanvars($_POST['title'])."'
												  ,	term				= '".cleanvars($_POST['term'])."'
												  , id_session			= '".cleanvars($_POST['id_session'])."'
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
												  , id_subject			= '".cleanvars($_POST['id_subject'])."' 
												  , note				= '".cleanvars($_POST['note'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE id			= '".cleanvars($_POST['id'])."'");

//--------------------------------------										  
$id = $_POST['id'];
	//--------------------------------------
	if(!empty($_FILES['file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/scheme_of_study/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'])).'_'.$id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'])).'_'.$id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".SCHEME_OF_STUDY."
															SET file = '".$img_fileName."'
													 WHERE  id		  = '".cleanvars($id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Scheme of Study UPdated ID: "'.cleanvars($id).'" details';
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
			header("Location: scheme_of_study.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
