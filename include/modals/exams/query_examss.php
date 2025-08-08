<?php 
//----------------Exams insert record----------------------
//---- make hostel check if already exist---
if(isset($_POST['submit_exam'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT exam_name  
										FROM ".EXAMS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND exam_name = '".cleanvars($_POST['exam_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: examss.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
$exam_startdate = date('Y-m-d' , strtotime(cleanvars($_POST['exam_startdate'])));
$exam_enddate = date('Y-m-d' , strtotime(cleanvars($_POST['exam_enddate'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EXAMS."(
														exam_status						, 
														exam_name						, 
														exam_startdate						, 
														exam_enddate						, 
														exam_comment							, 
														id_term							,  
														id_session							,  														
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['exam_status'])."'		,
														'".cleanvars($_POST['exam_name'])."'		, 
														'".cleanvars($exam_startdate)."'		, 														
														'".cleanvars($exam_enddate)."'			,
														'".cleanvars($_POST['exam_comment'])."'				,
														'".cleanvars($_POST['id_term'])."'				,
														'".cleanvars($_POST['id_session'])."'				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Exam: "'.cleanvars($_POST['exam_name']).'" detail';
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
		header("Location: examss.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Exams update reocrd----------------------
if(isset($_POST['changes_exam'])) { 
//------------------------------------------------
$exam_startdate = date('Y-m-d' , strtotime(cleanvars($_POST['exam_startdate'])));
$exam_enddate = date('Y-m-d' , strtotime(cleanvars($_POST['exam_enddate'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EXAMS." SET  
													exam_status		= '".cleanvars($_POST['exam_status'])."'
												  , exam_name		= '".cleanvars($_POST['exam_name'])."' 
												  , exam_startdate	= '".cleanvars($exam_startdate)."' 
												  , exam_enddate	= '".cleanvars($exam_enddate)."' 
												  , exam_comment	= '".cleanvars($_POST['exam_comment'])."' 
												  , id_term			= '".cleanvars($_POST['id_term'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE exam_id			= '".cleanvars($_POST['exam_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Exam: "'.cleanvars($_POST['exam_name']).'" details';
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
			header("Location: examss.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

