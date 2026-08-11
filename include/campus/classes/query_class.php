<?php
// CLASS INSERT
if(isset($_POST['submit_class'])){
	$sqllmscheck  = $dblms->querylms("SELECT class_name  
										FROM ".CLASSES." 
										WHERE id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND class_name	= '".cleanvars($_POST['class_name'])."'
										AND is_deleted	= '0' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)){
		//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: class.php", true, 301);
		exit();
		//------------if not exist--------------------------
	}else{
		$sqllms  = $dblms->querylms("INSERT INTO ".CLASSES."(
															  class_status
															, class_code
															, class_name
															, id_classgroup
															, id_campus 	
														)
													VALUES(
															  '".cleanvars($_POST['class_status'])."'
															, '".cleanvars($_POST['class_code'])."'
															, '".cleanvars($_POST['class_name'])."'
															, '".cleanvars($_POST['id_classgroup'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														)"
								);
		if($sqllms){
			$remarks = 'Add Class: "'.cleanvars($_POST['class_name']).'" detail';
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
			header("Location: class.php", true, 301);
			exit();
		}
	} // end checker
}

// CLASS UPDATE
if(isset($_POST['changes_class'])){
	$sqllmscheck  = $dblms->querylms("SELECT class_name  
										FROM ".CLASSES." 
										WHERE id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND class_name	= '".cleanvars($_POST['class_name'])."'
										AND is_deleted	= '0'
										AND class_id   != '".cleanvars($_POST['class_id'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)){
		//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: class.php", true, 301);
		exit();
		//------------if not exist--------------------------
	}else{
		$sqllms  = $dblms->querylms("UPDATE ".CLASSES." SET  
												  class_status		= '".cleanvars($_POST['class_status'])."'
												, class_code		= '".cleanvars($_POST['class_code'])."'
												, class_name		= '".cleanvars($_POST['class_name'])."'
												, id_classgroup		= '".cleanvars($_POST['id_classgroup'])."'
												, id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  	  WHERE class_id	= '".cleanvars($_POST['class_id'])."'");
		if($sqllms){
			$remarks = 'Update Class: "'.cleanvars($_POST['class_name']).'" details';
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
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: class.php", true, 301);
			exit();
		}
	}
}

// DELETE RECORD
if(isset($_GET['deleteid'])){
	$sqllms  = $dblms->querylms("UPDATE ".CLASSES." SET  
												  is_deleted		= '1'
												, id_deleted		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												, ip_deleted		= '".$ip."'
												, date_deleted		= NOW()
												  WHERE class_id	= '".cleanvars($_GET['deleteid'])."'");
	if($sqllms){ 
		//-------------------- Make Log ------------------------
		$remarks = 'Class Deleted #: "'.cleanvars($_GET['deleteid']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
															  id_user 
															, filename 
															, action
															, class_id
															, dated
															, ip
															, remarks 
															, id_campus				
														)
		
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
															, '3' 
															, '".cleanvars($_GET['deleteid'])."'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														)
									");

		
		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: $requestedPage", true, 301);
		exit();
	}
}