<?php 
//----------------Award insert record----------------------
if(isset($_POST['submit_award'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT award_name  
										FROM ".STUDENT_AWARDS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND award_name = '".cleanvars($_POST['award_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: awards.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".STUDENT_AWARDS."(
														status								,
														award_name							, 
														gift_item 							,
														cash_price							,
														award_reason						,
														id_class							,
														id_std								,
														given_date							,
														given_by							,
														id_session							,
														id_campus	
													  )
	   											VALUES( 
														'".cleanvars($_POST['status'])."'				,
														'".cleanvars($_POST['award_name'])."'			,
														'".cleanvars($_POST['gift_item'])."'			,		
														'".cleanvars($_POST['cash_price'])."'			,
														'".cleanvars($_POST['award_reason'])."'			,
														'".cleanvars($_POST['id_class'])."'				,
														'".cleanvars($_POST['id_std'])."'				,
														'".cleanvars($_POST['given_date'])."'			,	
														'".cleanvars($_POST['given_by'])."'				,
														'".cleanvars($_POST['id_session'])."'			,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Award: "'.cleanvars($_POST['award_name']).'" detail';
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
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: awards.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Award update reocrd----------------------
if(isset($_POST['change_award'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".STUDENT_AWARDS." SET  
													status				= '".cleanvars($_POST['status'])."'
												  , award_name			= '".cleanvars($_POST['award_name'])."' 
												  , gift_item			= '".cleanvars($_POST['gift_item'])."'
												  , cash_price			= '".cleanvars($_POST['cash_price'])."'
												  , award_reason		= '".cleanvars($_POST['award_reason'])."'
												  , id_class			= '".cleanvars($_POST['id_class'])."'
												  , id_std				= '".cleanvars($_POST['id_std'])."'
												  , given_date			= '".cleanvars($_POST['given_date'])."'
												  , given_by			= '".cleanvars($_POST['given_by'])."'
												  , id_session			= '".cleanvars($_POST['id_session'])."'
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
   											  		WHERE id			= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Award: "'.cleanvars($_POST['award_name']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".STUDENT_AWARDS." (
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
			header("Location: awards.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>
