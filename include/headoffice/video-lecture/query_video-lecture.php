<?php 
//----------------Syllabus insert record----------------------
if(isset($_POST['submit_video'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id  
										FROM ".VIDEO_LECTURE." 
										WHERE title = '".cleanvars($_POST['title'])."' 
										AND id_class = '".cleanvars($_POST['id_class'])."'
										AND id_subject = '".cleanvars($_POST['id_subject'])."' 
										AND id_session = '".cleanvars($_POST['id_session'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: video-lecture.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".VIDEO_LECTURE."(
														status													, 
														title													, 
														facebook_code											, 
														youtube_code											, 
														id_class												, 
														id_subject												,
														id_session												,
														id_added												, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'						, 
														'".cleanvars($_POST['title'])."'						, 
														'".cleanvars($_POST['facebook_code'])."'				, 
														'".cleanvars($_POST['youtube_code'])."'					, 
														'".cleanvars($_POST['id_class'])."'						,
														'".cleanvars($_POST['id_subject'])."'					,
														'".cleanvars($_POST['id_session'])."'					,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()
													  )"
							);
							
	$video_id = $dblms->lastestid();
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Video Lesson #: '.$video_id.' "'.cleanvars($_POST['id_class']).'" "'.cleanvars($_POST['id_subject']).'" detail';
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
		header("Location: video-lecture.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Syllabs Update reocrd----------------------
if(isset($_POST['change_video'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".VIDEO_LECTURE." SET  
													status			= '".cleanvars($_POST['status'])."'
												  ,	title			= '".cleanvars($_POST['title'])."'
												  ,	facebook_code	= '".cleanvars($_POST['facebook_code'])."' 
												  ,	youtube_code	= '".cleanvars($_POST['youtube_code'])."' 
												  , id_class		= '".cleanvars($_POST['id_class'])."' 
												  , id_subject		= '".cleanvars($_POST['id_subject'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."' 
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify		= NOW()
   											  WHERE id		= '".cleanvars($_POST['video_id'])."'");

//--------------------------------------										  
$video_id = $_POST['video_id'];

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Video Lesson #: '.$video_id.' "'.cleanvars($_POST['id_class']).'" "'.cleanvars($_POST['id_subject']).'"details';
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
			header("Location: video-lecture.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
