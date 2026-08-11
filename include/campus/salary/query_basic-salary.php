<?php
//----------------Update Single Fee Chalaln----------------------
if(isset($_POST['update_salary'])) { 

	for($i=1; $i<= count($_POST['emply_id']); $i++){
					   
		$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES." SET  
														emply_basicsalary			= '".cleanvars($_POST['salary'][$i])."'
														WHERE emply_id	= '".cleanvars($_POST['emply_id'][$i])."'");

		if($sqllms) { 

			$remarks = 'Updated Basic Salary Employee ID: "'.cleanvars($_POST['emply_id'][$i]).'"';
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
																'2'																	, 
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'						,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
										");
		}
	}

	if($sqllms) {
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: salarycontrol.php", true, 301);
		exit();
		//--------------------------------------
	}

}