<?php 
//----------------insert record ----------------------
//---- make record check if already exist -----
if(isset($_POST['submit_donor'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT donor_cnic  
										FROM ".DONORS." 
										WHERE donor_cnic = '".cleanvars($_POST['donor_cnic'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: donors.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".DONORS."(
														donor_status		, 
														donor_name			,
														donor_cnic			,  
														donor_phone			,  
														donor_whatsapp		,  
														donor_email			,
														donor_address		,
														city				,
														country				,
														id_campus			,
														id_added			,
														date_added		
													  )
	   											VALUES(
														'".cleanvars($_POST['donor_status'])."'						, 
														'".cleanvars($_POST['donor_name'])."'						,
														'".cleanvars($_POST['donor_cnic'])."'						,
														'".cleanvars($_POST['donor_phone'])."'						,
														'".cleanvars($_POST['donor_whatsapp'])."'					,
														'".cleanvars($_POST['donor_email'])."'						,
														'".cleanvars($_POST['donor_address'])."'					,
														'".cleanvars($_POST['city'])."'								,
														'".cleanvars($_POST['country'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
//-------------------------Get latest Id----------------------- 
$latestId = $dblms->lastestid();	
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Donors , ID: "'.cleanvars($latestId).'" detail';
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
		header("Location: donors.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------update reocrd----------------------
if(isset($_POST['changes_donor'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".DONORS." SET  
													donor_status		= '".cleanvars($_POST['donor_status'])."'
												  , donor_name			= '".cleanvars($_POST['donor_name'])."' 
												  , donor_cnic			= '".cleanvars($_POST['donor_cnic'])."' 
												  , donor_phone			= '".cleanvars($_POST['donor_phone'])."' 
												  , donor_whatsapp		= '".cleanvars($_POST['donor_whatsapp'])."' 
												  , donor_email			= '".cleanvars($_POST['donor_email'])."' 
												  , donor_address		= '".cleanvars($_POST['donor_address'])."' 
												  , city				= '".cleanvars($_POST['city'])."' 
												  , country				= '".cleanvars($_POST['country'])."' 
   											WHERE donor_id				= '".cleanvars($_POST['donor_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Donor: "'.cleanvars($_POST['donor_id']).'" details';
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
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: donors.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

