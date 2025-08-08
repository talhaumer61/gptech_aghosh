	<?php 
//----------------Inquiry insert record----------------------
if(isset($_POST['submit_inquiryfollowup'])) {	
	$sqllmscheck  = $dblms->querylms("SELECT id_inquiry ,next_followupdae
										FROM ".ADMISSIONS_INQUIRYFOLLOWUP." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_inquiry = '".cleanvars($_POST['id_inquiry'])."'
										AND next_followupdae = '".cleanvars($_POST['next_followdate'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: admission_inquiryfollowup.php", true, 301);
		exit();
//--------------------------------------
	} else {    
//------------------------------------------------
$dated_followup = date('Y-m-d' , strtotime(cleanvars($_POST['datefollowup'])));
$date_nextfollow = date('Y-m-d' , strtotime(cleanvars($_POST['next_followupdae'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ADMISSIONS_INQUIRYFOLLOWUP."(
														id_inquiry								, 
														datefollowup							,
														next_followupdae						,  
														response 								,
														note									,  
														id_added								,  
														date_added							 													  
													  )
	   											VALUES(
														'".cleanvars($_POST['id_inquiry'])."'					, 
														'".cleanvars($dated_followup)."'						,
														'".cleanvars($date_nextfollow)."'						,
														'".cleanvars($_POST['response'])."'						,
														'".cleanvars($_POST['note'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()				
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Inquiry FollowUp: "'.cleanvars($_POST['id_inquiry']).'" detail';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			 ,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'	 , 
															'1'																 , 
															NOW()															 ,
															'".cleanvars($ip)."'						 				     ,
															'".cleanvars($remarks)."'										 ,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: admission_inquiryfollowup.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
}
// end checker
//--------------------------------------
} 
//----------------InquiryFollowup update reocrd----------------------
if(isset($_POST['changes_inquiryfollowup'])) { 
//------------------------------------------------
$dated_followup = date('Y-m-d' , strtotime(cleanvars($_POST['datefollowup'])));
$date_nextfollow = date('Y-m-d' , strtotime(cleanvars($_POST['next_followupdae'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ADMISSIONS_INQUIRYFOLLOWUP." SET  
													id_inquiry			= '".cleanvars($_POST['id_inquiry'])."'
												  , datefollowup		= '".cleanvars($dated_followup)."' 
												  , next_followupdae	= '".cleanvars($date_nextfollow)."' 
												  , response			= '".cleanvars($_POST['response'])."'
												  , note				= '".cleanvars($_POST['note'])."'
   											  WHERE id					= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Inquiry: "'.cleanvars($_POST['id_inquiry']).'" details';
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
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: admission_inquiryfollowup.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

