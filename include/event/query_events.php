<?php 
//----------------Event insert record----------------------
if(isset($_POST['submit_event'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT event_name, event_to  
										FROM ".EVENTS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND event_name = '".cleanvars($_POST['event_name'])."'
										AND event_to = '".cleanvars($_POST['event_to'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: event.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
$date_from = date('Y-m-d' , strtotime(cleanvars($_POST['date_from'])));
$date_to = date('Y-m-d' , strtotime(cleanvars($_POST['date_to'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EVENTS."(
														status						, 
														subject						, 
														detail						,
														date_from					,
														date_to						, 
														event_to 					,
														alert_by					,	
														id_campus 		
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'		, 
														'".cleanvars($_POST['subject'])."'		,
														'".cleanvars($_POST['detail'])."'		,
														'".cleanvars($date_from)."'				,
														'".cleanvars($date_to)."'				,
														'".cleanvars($_POST['event_to'])."'		,
														'".cleanvars($_POST['alert_by'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Event: "'.cleanvars($_POST['event_name']).'" detail';
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
		header("Location: event.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------update reocrd----------------------
if(isset($_POST['changes_event'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EVENTS." SET  
													status			= '".cleanvars($_POST['status'])."'
												  , subject			= '".cleanvars($_POST['subject'])."' 
												  , detail			= '".cleanvars($_POST['detail'])."' 
												  , date_from		= '".cleanvars($_POST['date_from'])."' 
												  , date_to			= '".cleanvars($_POST['date_to'])."' 
												  , event_to		= '".cleanvars($_POST['event_to'])."' 
												  , alert_by		= '".cleanvars($_POST['alert_by'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE id				= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update event: "'.cleanvars($_POST['event_name']).'" details';
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
			header("Location: event.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
