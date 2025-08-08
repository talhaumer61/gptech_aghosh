<?php 
if(isset($_POST['submit_settings'])) {  
	
//----------------------DEL ALL RECORDS--------------------------
$sqllms  = $dblms->querylms("UPDATE ".SETTINGS." SET  
												status		= '2'
											,	is_deleted	= '1'
											,	date_modify	= NOW()
											,	id_modify   = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	
								");

//-----------------------ADD NEW ONE----------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SETTINGS."(
														status			, 
														adm_session		,
														acd_session		, 
														exam_session	,
														date_added		,
														id_added					
													  )
	   											VALUES(
													   	'1'														,
														'".cleanvars($_POST['adm_session'])."'					, 
														'".cleanvars($_POST['acd_session'])."'					, 
														'".cleanvars($_POST['exam_session'])."'					, 
														NOW()													,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'					
													  )
									");
//-----------------------end---------------

//--------------------------------------
$latest_id = $dblms->lastestid();	
//--------------------------------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'New Setting Added ID: "'.cleanvars($latest_id).'" detail';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'1'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'										,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
											");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: settings.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
?>
