<?php 
//----------------insert record----------------------
if(isset($_POST['submit_assignment'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT assig_title
										FROM ".ASSIGNMENT." 
										WHERE assig_title = '".cleanvars($_POST['assig_title'])."' 
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND id_class = '".cleanvars($_GET['class'])."'
										AND id_section = '".cleanvars($_GET['section'])."'
										AND id_subject = '".cleanvars($_GET['id'])."'
										AND id_teacher = '".cleanvars($value_emp['emply_id'])."'
										AND id_campus  = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$ref = '?id='.$_GET['id'].'&section='.$_GET['section'].'&class='.$_GET['class'].'&view=assignment';
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: subject.php$ref", true, 301);
		exit();
//--------------------------------------
	} else { 

	$open_date = date('Y-m-d' , strtotime(cleanvars($_POST['open_date'])));
	$close_date = date('Y-m-d' , strtotime(cleanvars($_POST['close_date'])));

	$sqllms  = $dblms->querylms("INSERT INTO ".ASSIGNMENT."(
														assig_status						, 
														assig_title							, 
														assig_note							,  
														open_date							,  
														close_date							,  
														id_session							,
														id_class 							,
														id_section							, 
														id_subject							,
														id_teacher							,
														id_campus							,
														id_added							, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['assig_status'])."'							,  
														'".cleanvars($_POST['assig_title'])."'							,	 
														'".cleanvars($_POST['assig_note'])."'							,
														'".cleanvars($open_date)."'										,
														'".cleanvars($close_date)."'									,
														'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,	
														'".cleanvars($_GET['class'])."'									,	
														'".cleanvars($_GET['section'])."'								,	
														'".cleanvars($_GET['id'])."'									,
														'".cleanvars($value_emp['emply_id'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														NOW()
													  )"
							);
							
	$assig_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['assig_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["assig_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/assignments/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['assig_title'])).'_'.$assig_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['assig_title'])).'_'.$assig_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".ASSIGNMENT."
															SET assig_file  = '".$img_fileName."'
														 WHERE  assig_id  = '".cleanvars($assig_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['assig_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Add Assignment ID: "'.cleanvars($_POST['assig_title']).'"';
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
		$ref = '?id='.$_GET['id'].'&section='.$_GET['section'].'&class='.$_GET['class'].'&view=assignment';
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: subject.php$ref", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Update reocrd----------------------
if(isset($_POST['changes_assignment'])) { 
//------------------------------------------------
	$open_date = date('Y-m-d' , strtotime(cleanvars($_POST['open_date'])));
	$close_date = date('Y-m-d' , strtotime(cleanvars($_POST['close_date'])));

	$sqllms  = $dblms->querylms("UPDATE ".ASSIGNMENT." SET  
													assig_status		= '".cleanvars($_POST['assig_status'])."'
												  ,	assig_title			= '".cleanvars($_POST['assig_title'])."'
												  , assig_note			= '".cleanvars($_POST['assig_note'])."' 
												  , open_date			= '".cleanvars($open_date)."' 
												  , close_date			= '".cleanvars($close_date)."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE assig_id			= '".cleanvars($_POST['assig_id'])."'");
	//--------------------------------------
	if(!empty($_FILES['assig_file']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["assig_file"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/assignments/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['assig_title'])).'_'.$_POST['assig_id'].".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['assig_title'])).'_'.$_POST['assig_id'].".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".ASSIGNMENT."
															SET assig_file  = '".$img_fileName."'
														 WHERE  assig_id  = '".cleanvars($_POST['assig_id'])."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['assig_file']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
		$remarks = 'Updated Assignment ID: "'.cleanvars($_POST['assig_id']).'"';
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
			$ref = '?id='.$_GET['id'].'&section='.$_GET['section'].'&class='.$_GET['class'].'&view=assignment';
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: subject.php$ref", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
