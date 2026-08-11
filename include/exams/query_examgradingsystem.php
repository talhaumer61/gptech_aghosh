<?php 
//----------------Grade insert record----------------------
//---- make Grade check if already exist---
if(isset($_POST['submit_grade'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT grade_name  
										FROM ".GRADESYSTEM." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND grade_name = '".cleanvars($_POST['grade_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: examgradingsystem.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".GRADESYSTEM."(
														grade_status						, 
														grade_name							,
														grade_point							,
														grade_lowermark							,
														grade_uppermark							,  
														grade_comment							,  														
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['grade_status'])."'		, 
														'".cleanvars($_POST['grade_name'])."'			,
														'".cleanvars($_POST['grade_point'])."'			,
														'".cleanvars($_POST['grade_lowermark'])."'			,
														'".cleanvars($_POST['grade_uppermark'])."'			,
														'".cleanvars($_POST['grade_comment'])."'				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Grade: "'.cleanvars($_POST['grade_name']).'" detail';
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
		header("Location: examgradingsystem.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Grade update reocrd----------------------
if(isset($_POST['changes_grade'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".GRADESYSTEM." SET  
													grade_status		= '".cleanvars($_POST['grade_status'])."'
												  , grade_name			= '".cleanvars($_POST['grade_name'])."' 
												  , grade_point				= '".cleanvars($_POST['grade_point'])."' 
												  , grade_lowermark				= '".cleanvars($_POST['grade_lowermark'])."' 
												  , grade_uppermark				= '".cleanvars($_POST['grade_uppermark'])."' 
												  , grade_comment				= '".cleanvars($_POST['grade_comment'])."' 												  
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE grade_id			= '".cleanvars($_POST['grade_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Grade: "'.cleanvars($_POST['grade_name']).'" details';
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
			header("Location: examgradingsystem.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

