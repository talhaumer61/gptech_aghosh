<?php
//----------------Insert record----------------------
if(isset($_POST['submit_attendance']))
{ 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllmscheck  = $dblms->querylms("SELECT dated, id_session, id_campus
										FROM ".EMPLOYEES_ATTENDCE." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND dated =  '".$dated."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------

		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: attendance_employees.php", true, 301);
		exit();
//--------------------------------------
	} else {
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EMPLOYEES_ATTENDCE."
					(								 
						status							,
						dated							,								 
						id_session						,
						id_campus 						,	
						id_added						,		
						date_added
					  )
				VALUES(	
						'1'																,	
						'".cleanvars($dated)."'											, 	
						'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,		
						'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  	,
						'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 		,
						NOW()	
					  )
					  	");
//----------------------------------------------
$idsetup = $dblms->lastestid();
//----------------------------------------------
for($i=1; $i<=COUNT($_POST['emply_ID']); $i++){
$sqllms  = $dblms->querylms("INSERT INTO ".EMPLOYEES_ATTENDCE_DETAIL."
					(								 
						id_setup			,
						id_dept				,
						id_emply			,
						status		
					  )
				VALUES(	
						'".cleanvars($idsetup)."'					,
						'".cleanvars($_POST['dept_ID'][$i])."'		,
						'".cleanvars($_POST['emply_ID'][$i])."'		,
						'".cleanvars($_POST['arr'][$i])."'
					  )
					  	");
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Employee attendance add: "'.cleanvars($dated).'" detail';
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
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: attendance_employees.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
}



//----------------Employees Attendance update reocrd----------------------
if(isset($_POST['update_attendance'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES_ATTENDCE." SET  
										    id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										  , date_modify	= NOW() 
										  , id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
									 WHERE  id			= '".cleanvars($_POST['id'])."' 
									 ");
//----------------------------------------------
$idsetup = $dblms->lastestid();
//----------------------------------------------
$employees = $_POST['employees'];
for($i=1; $i<=$employees; $i++){
$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES_ATTENDCE_DETAIL." SET  
										  status	= '".cleanvars($_POST['arr'][$i])."' 
									WHERE id_emply  = '".cleanvars($_POST['emply_ID'][$i])."'
									  AND id_setup 	= '".cleanvars($_POST['id'])."' 
									");
}
if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Employee Attendance: "'.cleanvars($dated).'" details';
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
			header("Location: attendance_employees.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

?>