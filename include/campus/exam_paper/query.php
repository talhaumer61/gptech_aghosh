<?php 
//---------------- insert record ----------------------
if(isset($_POST['submit_questionpaper'])) { 

	if(isset($_POST['id_month'])){
		$sql2 = "AND id_month = '".cleanvars($_POST['id_month'])."' ";
	}
	else{
		$sql2 = "";
	}

	$sqllmscheck  = $dblms->querylms("SELECT exam_id
										FROM ".EXAMS." 
										WHERE id_type = '".cleanvars($_POST['id_type'])."' AND id_term = '".cleanvars($_POST['id_term'])."' 
										AND id_session = '".cleanvars($_POST['id_session'])."' AND id_class = '".cleanvars($_POST['id_class'])."'
										AND id_subject = '".cleanvars($_POST['id_subject'])."' $sql2 LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_paper.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EXAMS."(
														exam_status						,  
														exam_comment					,
														id_month						,
														id_class						, 
														id_subject						, 
														id_type							, 
														id_term							,
														id_session						,
														id_added						, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['exam_status'])."'					, 
														'".cleanvars($_POST['exam_comment'])."'					, 
														'".cleanvars($_POST['id_month'])."'						, 
														'".cleanvars($_POST['id_class'])."'						,
														'".cleanvars($_POST['id_subject'])."'					,
														'".cleanvars($_POST['id_type'])."'						,
														'".cleanvars($_POST['id_term'])."'						,
														'".cleanvars($_POST['id_session'])."'					,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()
													  )"
							);
							
	$exam_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['exam_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["exam_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/question_papers/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'].'-'.$_POST['id_subject'])).'_'.$exam_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'].'-'.$_POST['id_subject'])).'_'.$exam_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".EXAMS."
															SET exam_file = '".$img_fileName."'
														 WHERE  exam_id	  = '".cleanvars($exam_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['exam_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Exam Paper Added ID: "'.cleanvars($exam_id).'", detail';
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
		header("Location: exam_paper.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------- Update reocrd ----------------------
if(isset($_POST['changes_questionpaper'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EXAMS." SET  
													exam_status			= '".cleanvars($_POST['exam_status'])."'
												  ,	exam_comment		= '".cleanvars($_POST['exam_comment'])."'
												  , id_month			= '".cleanvars($_POST['id_month'])."'
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
												  , id_subject			= '".cleanvars($_POST['id_subject'])."' 
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , id_term				= '".cleanvars($_POST['id_term'])."' 
												  , id_session			= '".cleanvars($_POST['id_session'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE exam_id 			= '".cleanvars($_POST['exam_id'])."'");

//--------------------------------------										  
$exam_id = cleanvars($_POST['exam_id']);
	//--------------------------------------
	if(!empty($_FILES['exam_file']['name'])) { 
		//--------------------------------------
			$path_parts 	= pathinfo($_FILES["exam_file"]["name"]);
			$extension 		= strtolower($path_parts['extension']);
			$img_dir 	= 'uploads/question_papers/';
		//--------------------------------------
			$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'].'-'.$_POST['id_subject'])).'_'.$exam_id.".".($extension);
			$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'].'-'.$_POST['id_subject'])).'_'.$exam_id.".".($extension);
		//--------------------------------------
			if(in_array($extension , array('pdf','ppt', 'docx'))) { 
		//--------------------------------------
				$sqllmsupload  = $dblms->querylms("UPDATE ".EXAMS."
																SET exam_file = '".$img_fileName."'
															 WHERE  exam_id	  = '".cleanvars($exam_id)."'");
				unset($sqllmsupload);
				$mode = '0644'; 
		//--------------------------------------	
				move_uploaded_file($_FILES['exam_file']['tmp_name'],$originalImage);
				chmod ($originalImage, octdec($mode));
		//--------------------------------------
			}
		//--------------------------------------
		}
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Exam Paper Updated ID: "'.cleanvars($exam_id).'" details';
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
															'2'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: exam_paper.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
