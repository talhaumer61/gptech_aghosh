<?php 
//----------------Hostel insert record----------------------
//---- make hostel check if already exist---
if(isset($_POST['submit_subject'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT subject_code  
										FROM ".CLASS_SUBJECTS." 
										WHERE subject_code = '".cleanvars($_POST['subject_code'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: classsubjects.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".CLASS_SUBJECTS."(
														subject_status							, 
														subject_code							,
														subject_name							,   
														subject_type							,  
														subject_book							,  
														subject_edition							,  
														subject_publisher						,  
														id_class	
													  )
	   											VALUES(
														'".cleanvars($_POST['subject_status'])."'		, 
														'".cleanvars($_POST['subject_code'])."'			,
														'".cleanvars($_POST['subject_name'])."'			,
														'".cleanvars($_POST['subject_type'])."'			,
														'".cleanvars($_POST['subject_book'])."'			,
														'".cleanvars($_POST['subject_edition'])."'		,
														'".cleanvars($_POST['subject_publisher'])."'	,
														'".cleanvars($_POST['id_class'])."'
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Subjects: "'.cleanvars($_POST['subject_name']).'" detail';
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
		header("Location: classsubjects.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------class update reocrd----------------------
if(isset($_POST['changes_subject'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".CLASS_SUBJECTS." SET  
													subject_status		= '".cleanvars($_POST['subject_status'])."'
												  , subject_code		= '".cleanvars($_POST['subject_code'])."' 
												  , subject_name		= '".cleanvars($_POST['subject_name'])."' 
												  , subject_type		= '".cleanvars($_POST['subject_type'])."' 												  
												  , subject_book		= '".cleanvars($_POST['subject_book'])."' 												  
												  , subject_edition		= '".cleanvars($_POST['subject_edition'])."' 												  
												  , subject_publisher	= '".cleanvars($_POST['subject_publisher'])."' 												  
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
   											  WHERE subject_id			= '".cleanvars($_POST['subject_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Subjects: "'.cleanvars($_POST['subject_name']).'" details';
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
			header("Location: classsubjects.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

