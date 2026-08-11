<?php 
//----------------insert record----------------------
if(isset($_POST['submit_assessment'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_session, id_class, id_subject, id_month 
										FROM ".SYLLABUS." 
										WHERE syllabus_type = '4' AND  id_session = '".cleanvars($_POST['id_session'])."' AND id_month = '".cleanvars($_POST['id_month'])."'
										AND id_class = '".cleanvars($_POST['id_class'])."' AND id_subject = '".cleanvars($_POST['id_subject'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: monthly_assessment.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SYLLABUS."(
														syllabus_status						, 
														syllabus_type						, 
														id_session							, 
														id_month							, 
														id_class							, 
														id_subject							,
														note								,
														id_added							, 
														date_added 	
			 
													  )
	   											VALUES(
													   	'".cleanvars($_POST['ass_status'])."'						, 
														'4'															, 
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_POST['id_month'])."'							,
														'".cleanvars($_POST['id_class'])."'							,
														'".cleanvars($_POST['id_subject'])."'						,
														'".cleanvars($_POST['ass_note'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
							
	$ass_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['ass_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["ass_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/monthly_assessments/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_session'].'-'.get_monthtypes($_POST['id_month']).'-'.$_POST['id_class'])).'_'.$ass_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.get_monthtypes($_POST['id_month']).'-'.$_POST['id_class'])).'_'.$ass_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".SYLLABUS."
															SET syllabus_file = '".$img_fileName."'
														 WHERE  syllabus_id	 = '".cleanvars($ass_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['ass_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Monthly Assessment: "'.cleanvars($_POST['id_class']).'" "'.cleanvars($_POST['id_subject']).'" "'.cleanvars($_POST['id_month']).'"   detail';
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
		header("Location: monthly_assessment.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Update reocrd----------------------
if(isset($_POST['changes_assessment'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".SYLLABUS." SET 
													syllabus_status		= '".cleanvars($_POST['ass_status'])."'
												  , id_session			= '".cleanvars($_POST['id_session'])."'
												  , id_month			= '".cleanvars($_POST['id_month'])."' 
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
												  , id_subject			= '".cleanvars($_POST['id_subject'])."' 
												  , note				= '".cleanvars($_POST['ass_note'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
												 WHERE syllabus_id			= '".cleanvars($_POST['ass_id'])."'");

		$ass_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['ass_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["ass_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/monthly_assessments/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_session'].'-'.get_monthtypes($_POST['id_month']).'-'.$_POST['id_class'])).'_'.$ass_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.get_monthtypes($_POST['id_month']).'-'.$_POST['id_class'])).'_'.$ass_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".SYLLABUS."
															SET syllabus_file = '".$img_fileName."'
														 WHERE  syllabus_id	 = '".cleanvars($ass_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['ass_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Monthky Assessment: "'.cleanvars($_POST['id_class']).'"  "'.cleanvars($_POST['id_subject']).'" "'.cleanvars($_POST['id_month']).'" details';
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
			header("Location: monthly_assessment.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
