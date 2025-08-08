<?php 
//---------------- insert record ----------------------
if(isset($_POST['submit_datesheet'])){
	$sqllmscheck  = $dblms->querylms("SELECT id_session, id_exam, id_class, id_section 
										FROM ".DATESHEET." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['EXAM_SESSION'])."'
										AND id_exam = '".cleanvars($_POST['exam'])."'
										AND id_class = '".cleanvars($_POST['class'])."' 
										AND id_section = '".cleanvars($_POST['section'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck) > 0) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_datesheet.php", true, 301);
		exit();
	}else{ 
		$sqllms  = $dblms->querylms("INSERT INTO ".DATESHEET."(
														  status 
														, id_exam
														, id_session 
														, id_class 
														, id_campus
														, id_added
														, date_added						
													  )
	   											VALUES(
														  '".cleanvars($_POST['status'])."' 
														, '".cleanvars($_POST['exam'])."'
														, '".cleanvars($_SESSION['userlogininfo']['EXAM_SESSION'])."'
														, '".cleanvars($_POST['class'])."'	
														, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, NOW()				
													  )"
							);
		$idsetup = $dblms->lastestid();
		for($i=1; $i<=sizeof($_POST['id_subject']); $i++){
			if(!empty($_POST['id_subject'][$i]) && !empty($_POST['id_teacher'][$i]) && !empty($_POST['id_room'][$i]) && !empty($_POST['dated'][$i]) && !empty($_POST['start_time'][$i]) && !empty($_POST['end_time'][$i])){

			$dated = date("Y-m-d", strtotime($_POST['dated'][$i]));
			$sqllmsdetail  = $dblms->querylms("INSERT INTO ".DATESHEET_DETAIL."(
																  id_setup 
																, paper_no
																, id_subject 
																, id_room
																, id_teacher
																, total_marks
																, passing_marks
																, dated
																, start_time
																, end_time
															)
														VALUES(
																  '".cleanvars($idsetup)."' 
																, '".cleanvars($_POST['paper_no'][$i])."'
																, '".cleanvars($_POST['id_subject'][$i])."'
																, '".cleanvars($_POST['id_room'][$i])."'
																, '".cleanvars($_POST['id_teacher'][$i])."'
																, '".cleanvars($_POST['total_marks'][$i])."'
																, '".cleanvars($_POST['passing_marks'][$i])."'
																, '".cleanvars($dated)."'
																, '".cleanvars($_POST['start_time'][$i])."'
																, '".cleanvars($_POST['end_time'][$i])."'			
															)"
											);
			}
		}
		if($sqllms){ 

			$remarks = 'Add Datesheet ID: "'.cleanvars($idsetup).' detail';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks 
																, id_campus				
															)
			
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '1'
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
															)
										");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: exam_datesheet.php", true, 301);
			exit();
		}
	} // end checker
}

//---------------- Update Record ----------------------
if(isset($_POST['change_datesheet'])) { 
	$sqllms  = $dblms->querylms("UPDATE ".DATESHEET." SET  
													  status			= '".cleanvars($_POST['status'])."'
													, id_exam			= '".cleanvars($_POST['id_exam'])."' 
													, id_class			= '".cleanvars($_POST['id_class'])."' 
													, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													, date_modify		=  NOW()
													WHERE id			= '".cleanvars($_POST['id'])."'");
	if($sqllms){	
		$sqllmsdelte  = $dblms->querylms("DELETE FROM ".DATESHEET_DETAIL." WHERE id_setup = '".$_POST['id']."'");

		for($i=1; $i<=sizeof($_POST['id_subject']); $i++){	
			if(!empty($_POST['id_subject'][$i]) && !empty($_POST['id_teacher'][$i]) && !empty($_POST['id_room'][$i]) && !empty($_POST['dated'][$i]) && !empty($_POST['start_time'][$i]) && !empty($_POST['end_time'][$i]) ){	
				$dated = date("Y-m-d", strtotime($_POST['dated'][$i]));
				$sqllmsdetail  = $dblms->querylms("INSERT INTO ".DATESHEET_DETAIL."(
																	  id_setup 
																	, paper_no
																	, id_subject 
																	, id_room
																	, id_teacher
																	, total_marks
																	, passing_marks
																	, dated
																	, start_time
																	, end_time
																)
															VALUES(
																	  '".cleanvars($_POST['id'])."' 
																	, '".cleanvars($_POST['paper_no'][$i])."'
																	, '".cleanvars($_POST['id_subject'][$i])."'
																	, '".cleanvars($_POST['id_room'][$i])."'
																	, '".cleanvars($_POST['id_teacher'][$i])."'
																	, '".cleanvars($_POST['total_marks'][$i])."'
																	, '".cleanvars($_POST['passing_marks'][$i])."'
																	, '".cleanvars($dated)."'
																	, '".cleanvars($_POST['start_time'][$i])."'
																	, '".cleanvars($_POST['end_time'][$i])."'			
																)"
										);
			}
		}

		$remarks = 'Update Datesheet ID: "'.cleanvars($_POST['id']).' details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															  id_user 
															, filename 
															, action
															, dated
															, ip
															, remarks 
															, id_campus				
															)
		
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
															, '2'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															)
									");
									
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: exam_datesheet.php", true, 301);
		exit();
	}
}

// INSERT EXAM INSTRUCTIONS
if(isset($_POST['submit_inst'])){
	$sqllmscheck  = $dblms->querylms("SELECT id_examtype, id_class, id_campus 
										FROM ".EXAM_INSTRUCTIONS." 
										WHERE id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_examtype	= '".cleanvars($_POST['id_examtype'])."'
										AND id_class	= '".cleanvars($_POST['id_class'])."' 
										AND is_deleted	= '0' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck) > 0) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_datesheet.php?view=instructions", true, 301);
		exit();
	}else{

		// Array
		$values = array(
						  'status'			=> cleanvars($_POST['status'])
						, 'id_examtype'		=> cleanvars($_POST['id_examtype'])
						, 'id_class'		=> cleanvars($_POST['id_class'])
						, 'instructions'	=> cleanvars($_POST['instructions'])
						, 'id_campus'		=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
						, 'id_added'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						, 'date_added'		=> date('Y-m-d H:i:s')
					);
		$sqlInsert = $dblms->Insert(EXAM_INSTRUCTIONS , $values); 
		
		// LATEST ID
		$idsetup = $dblms->lastestid();

		// REMARKS
		if($sqlInsert){
			$remarks = 'Add Exam Instructions ID: "'.cleanvars($idsetup).'" ';
			// Array
			$values = array(
							  'id_user'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							, 'filename'	=> strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
							, 'action'		=> '1'
							, 'dated'		=> date('Y-m-d H:i:s')
							, 'ip'			=> cleanvars($ip)
							, 'remarks'		=> cleanvars($remarks)
							, 'id_campus'	=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
						);
			$sqlLogs = $dblms->Insert(LOGS , $values);

			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: exam_datesheet.php?view=instructions", true, 301);
			exit();
		}
	}
}

// UPDATE EXAM INSTRUCTIONS
if(isset($_POST['update_inst'])){
	$sqllmscheck  = $dblms->querylms("SELECT id_examtype, id_class, id_campus 
										FROM ".EXAM_INSTRUCTIONS." 
										WHERE id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_examtype	= '".cleanvars($_POST['id_examtype'])."'
										AND id_class	= '".cleanvars($_POST['id_class'])."' 
										AND is_deleted	= '0'
										AND id		   != '".cleanvars($_POST['id'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck) > 0) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_datesheet.php?view=instructions", true, 301);
		exit();
	}else{

		// Array
		$values = array(
						  'status'			=> cleanvars($_POST['status'])
						, 'id_examtype'		=> cleanvars($_POST['id_examtype'])
						, 'id_class'		=> cleanvars($_POST['id_class'])
						, 'instructions'	=> cleanvars($_POST['instructions'])
						, 'id_campus'		=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
						, 'id_modify'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						, 'date_modify'		=> date('Y-m-d H:i:s')
					);
		$sqlUpdate = $dblms->Update(EXAM_INSTRUCTIONS , $values, "WHERE id = '".cleanvars($_POST['id'])."'");
		
		// LATEST ID
		$idsetup = $_POST['id'];

		// REMARKS
		if($sqlUpdate){
			$remarks = 'Update Exam Instructions ID: "'.cleanvars($idsetup).'" ';
			// Array
			$values = array(
							  'id_user'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							, 'filename'	=> strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
							, 'action'		=> '2'
							, 'dated'		=> date('Y-m-d H:i:s')
							, 'ip'			=> cleanvars($ip)
							, 'remarks'		=> cleanvars($remarks)
							, 'id_campus'	=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
						);
			$sqlLogs = $dblms->Insert(LOGS , $values);

			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: exam_datesheet.php?view=instructions", true, 301);
			exit();
		}
	}
} 

// DELETE RECORD
if(isset($_GET['deleteid'])){
	$values = array(
					  'is_deleted'		=> '1'
					, 'id_deleted'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
					, 'ip_deleted'		=> cleanvars($ip)
					, 'date_deleted'	=> date('Y-m-d H:i:s')
				);
	$sqlDel = $dblms->Update(EXAM_INSTRUCTIONS , $values, "WHERE id = '".cleanvars($_GET['deleteid'])."'");

	// LATEST ID
	$idsetup = $_GET['deleteid'];

	// REMARKS
	if($sqllms){ 
		$remarks = 'Exam Instructions Deleted "'.cleanvars($idsetup).'" ';
		// Array
		$values = array(
						  'id_user'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						, 'filename'	=> strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
						, 'action'		=> '3'
						, 'dated'		=> date('Y-m-d H:i:s')
						, 'ip'			=> cleanvars($ip)
						, 'remarks'		=> cleanvars($remarks)
						, 'id_campus'	=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
					);
		$sqlLogs = $dblms->Insert(LOGS , $values);

		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: exam_datesheet.php?view=instructions", true, 301);
		exit();
	}
}
if(isset($_GET['deleteid_datesheet'])){
	$values = array(
					  'is_deleted'		=> '1'
					, 'id_deleted'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
					, 'ip_deleted'		=> cleanvars($ip)
					, 'date_deleted'	=> date('Y-m-d H:i:s')
				);
	$sqlDel = $dblms->Update(DATESHEET , $values, "WHERE id = '".cleanvars($_GET['deleteid_datesheet'])."'");

	// LATEST ID
	$idsetup = $_GET['deleteid_datesheet'];

	// REMARKS
	if($sqllms){ 
		$remarks = 'Exam Datesheet Deleted "'.cleanvars($idsetup).'" ';
		// Array
		$values = array(
						  'id_user'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						, 'filename'	=> strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
						, 'action'		=> '3'
						, 'dated'		=> date('Y-m-d H:i:s')
						, 'ip'			=> cleanvars($ip)
						, 'remarks'		=> cleanvars($remarks)
						, 'id_campus'	=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
					);
		$sqlLogs = $dblms->Insert(LOGS , $values);

		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: exam_datesheet.php?view=instructions", true, 301);
		exit();
	}
}