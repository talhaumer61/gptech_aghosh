<?php 
//----------------Hostel insert record----------------------
//---- make hostel check if already exist---
if(isset($_POST['submit_complaint'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".COMPLAINTS."(
														status									, 
														id_type									,
														complaint_by							,  
														phone									,
														dated									,
														detail									,
														action_taken							,
														assigned								,
														note									,
														attachment								,
														id_campus 								,
														id_added								,
													  	date_added								
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'			, 
														'".cleanvars($_POST['id_type'])."'			,
														'".cleanvars($_POST['complaint_by'])."'		,
														'".cleanvars($_POST['phone'])."'			,
														'".cleanvars($dated)."'			,
														'".cleanvars($_POST['detail'])."'			,
														'".cleanvars($_POST['action_taken'])."'			,
														'".cleanvars($_POST['assigned'])."'			,
														'".cleanvars($_POST['note'])."'			,
														'".cleanvars($_POST['attachment'])."'			,														
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,		
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."',
														NOW()
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Complaint: "'.cleanvars($_POST['id_type']).'" detail';
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
		header("Location: complaints.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	 // end checker
//--------------------------------------
} 
//----------------class update reocrd----------------------
if(isset($_POST['changes_complaint'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".COMPLAINTS." SET  
													status		= '".cleanvars($_POST['status'])."'
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , complaint_by				= '".cleanvars($_POST['complaint_by'])."'
												  , phone				= '".cleanvars($_POST['phone'])."'
												  , dated				= '".cleanvars($_POST['dated'])."'
												  , detail				= '".cleanvars($_POST['detail'])."'
												  , action_taken				= '".cleanvars($_POST['action_taken'])."'
												  , assigned				= '".cleanvars($_POST['assigned'])."'
												  , note				= '".cleanvars($_POST['note'])."'
												  , attachment				= '".cleanvars($_POST['attachment'])."'												  
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  , date_modify			= NOW() 
   											  WHERE id_type			= '".cleanvars($_POST['id_type'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Complaint: "'.cleanvars($_POST['id_type']).'" details';
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
			header("Location: complaints.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

