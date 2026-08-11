<?php 
//----------------Complaint update reocrd----------------------
if(isset($_POST['changes_complaint'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".COMPLAINTS." SET  
													status			= '".cleanvars($_POST['status'])."'
												, id_complaint_type	= '".cleanvars($_POST['id_complaint_type'])."'
												  , remarks			= '".cleanvars($_POST['remarks'])."'												  
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  , date_modify		= NOW() 
   											  WHERE id				= '".cleanvars($_POST['id'])."'");
	//--------------------------------------
	if($sqllms) { 
		//--------------------------------------
		$remarks = 'Update Complaint: "'.cleanvars($_POST['id']).'" details';
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
		header("Location: complaint_suggestion.php", true, 301);
		exit();
		//--------------------------------------
	}
	//--------------------------------------
}

