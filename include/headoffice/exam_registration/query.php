<?php
if (isset($_POST['un_publish_it'])){
	$sqllms  = $dblms->querylms("UPDATE ".EXAM_REGISTRATION."  SET  
											  is_publish		= '0'
											, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
											, date_modify		= NOW()
											  WHERE  id_session	= '".cleanvars($_POST['id_session'])."'
											  AND id_type		= '".cleanvars($_POST['id_type'])."'
											  AND id_campus		= '".cleanvars($_POST['id_campus'])."'
								");
	if ($sqllms){
		$remarks = 'Exam Registration Un Published id_session: "'.cleanvars($_POST['id_session']).'" , id_type: "'.cleanvars($_POST['id_type']).'" id_campus: "'.cleanvars($_POST['id_campus']).'" details';
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
		errorMsg('Successfully', 'Record Un Published.', 'success');
		header("Location: exam_registration.php", true, 301);
		exit();
	}else{
		errorMsg('Unsuccessfully', 'Record Not Un Published.', 'error');
		header("Location: exam_registration.php", true, 301);
		exit();
	}
}
?>