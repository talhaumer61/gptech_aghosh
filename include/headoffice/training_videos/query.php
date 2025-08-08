<?php 
//----------------Insert record----------------------
if(isset($_POST['submit_video'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id
										FROM ".TRAINING_VIDEOS." 
										WHERE title = '".cleanvars($_POST['title'])."' 
										AND youtube_url = '".cleanvars($_POST['youtube_url'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: training_videos.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".TRAINING_VIDEOS."(
														status								,
														title								, 
														thumbnail							, 
														youtube_url							,
														details								,
														id_session							, 
														id_added							, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							, 
														'".cleanvars($_POST['title'])."'							,
														'".cleanvars($_POST['thumbnail'])."'						,
														'".cleanvars($_POST['youtube_url'])."'						,
														'".cleanvars($_POST['details'])."'							,
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
							
	$latest_id = $dblms->lastestid();
//-----------------------end---------------

//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Training Video Added ID: "'.cleanvars($latest_id).'" detail';
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
		header("Location: training_videos.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Update reocrd----------------------
if(isset($_POST['changes_video'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".TRAINING_VIDEOS." SET  
													status			= '".cleanvars($_POST['status'])."'
												  ,	title			= '".cleanvars($_POST['title'])."'
												  , thumbnail		= '".cleanvars($_POST['thumbnail'])."'
												  , youtube_url		= '".cleanvars($_POST['youtube_url'])."' 
												  , details			= '".cleanvars($_POST['details'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."' 
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify		= NOW()
   											  WHERE id				= '".cleanvars($_POST['id'])."'");
//-----------------------end---------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Training Video Updated ID: "'.cleanvars($_POST['id']).'" details';
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
			header("Location: training_videos.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
