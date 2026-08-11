<?php
// Add
if(isset($_POST['add_marks'])){

	$sqllmsattendance	= $dblms->querylms("SELECT id
										FROM ".EXAM_MARKS."
										WHERE id_class = '".$_POST['id_class']."' AND id_section = '".$_POST['id_section']."'
										AND id_subject = '".$_POST['id_subject']."' AND id_exam = '".$_POST['id_exam']."'
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['EXAM_SESSION'])."'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	//-------------if already exist -------------------------
	if (mysqli_num_rows($sqllmsattendance)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_marks.php?view=add", true, 301);
		exit();
	} else{
		//-----------------if not exist--------------------------
		$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_MARKS."
															(						 
																status			,
																total_marks		,
																id_exam			,
																id_class		,
																id_section		,								 
																id_subject		,								 
																id_session		,
																id_campus 		,	
																id_added		,		
																date_added
															) VALUES (	
																'2'																,	
																'".cleanvars($_POST['total_marks'])."'							,
																'".cleanvars($_POST['id_exam'])."'								,
																'".cleanvars($_POST['id_class'])."'								,
																'".cleanvars($_POST['id_section'])."'							,							
																'".cleanvars($_POST['id_subject'])."'							,							
																'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,		
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  	,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 		,
																NOW()	
															)");
		
		if($sqllms) { 
			
			$idsetup = $dblms->lastestid();

			for($i=1; $i<= count($_POST['id_std']); $i++) {
				
				if($_POST['obtained_marks'][$i] >= $_POST['passing_marks']){$status = 1;} else{$status = 2;}
				
				$sqllmsDetail = $dblms->querylms("INSERT INTO ".EXAM_MARKS_DETAILS."
																(						
																	id_setup			,
																	id_std				,
																	obtain_marks		,
																	status
																) VALUES (	
																	'".cleanvars($idsetup)."'						,
																	'".cleanvars($_POST['id_std'][$i])."'			,
																	'".cleanvars($_POST['obtained_marks'][$i])."'	,	
																	'".$status."'
																)");
			}

			$remarks = 'Added Subject Marks ID#"'.cleanvars($idsetup).'"';
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
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'1'																	, 
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'						,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
										");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: exam_marks.php", true, 301);
			exit();
		}
	}
}

// UPdate
if(isset($_POST['update_marks'])){

	$sqllms  = $dblms->querylms("UPDATE ".EXAM_MARKS." SET  
										status		= '".cleanvars($_POST['status'])."'
									,	id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
									, 	date_modify	= NOW()  
								 WHERE  id			= '".cleanvars($_POST['id'])."'");
	
	if($sqllms) { 
		
		$idsetup = cleanvars($_POST['id']);

		for($i=1; $i<= count($_POST['id_std']); $i++) {
			
			if($_POST['obtained_marks'][$i] >= $_POST['passing_marks']){$status = 1;} else{$status = 2;}
			
			$sqllmsDetail = $dblms->querylms("UPDATE ".EXAM_MARKS_DETAILS." SET
														obtain_marks	= '".cleanvars($_POST['obtained_marks'][$i])."'
													,	status			= '".$status."'
												WHERE   id_setup		= '".cleanvars($idsetup)."'
												AND 	id_std			= '".cleanvars($_POST['id_std'][$i])."'");
		}

		$remarks = 'Update Subject Marks ID#"'.cleanvars($idsetup).'"';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
															'1'																	, 
															NOW()																,
															'".cleanvars($ip)."'												,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														)
									");
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: exam_marks.php", true, 301);
		exit();
	}
}

