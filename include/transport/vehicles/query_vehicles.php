<?php 
//----------------transport vehicles insert record----------------------
if(isset($_POST['submit_transport'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT vehicle_no  
										FROM ".VEHICLES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND vehicle_no = '".cleanvars($_POST['vehicle_no'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: transport_vehicles.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".VEHICLES."(
														vehicle_status						, 
														id_route							, 
														vehicle_no	                        , 
														vehicle_capacity					, 
														vehicle_driver				      	, 
														vehicle_driverphone	                ,
														vehicle_driverlicense				,
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['vehicle_status'])."'		, 
														'".cleanvars($_POST['id_route'])."'			    ,
														'".cleanvars($_POST['vehicle_no'])."'			,
														'".cleanvars($_POST['vehicle_capacity'])."'		, 
														'".cleanvars($_POST['vehicle_driver'])."'	    ,
														'".cleanvars($_POST['vehicle_driverphone'])."'	,
														'".cleanvars($_POST['vehicle_driverlicense'])."'	, 
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add transport : "'.cleanvars($_POST['vehicle_no']).'" detail';
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
		header("Location: transport_vehicles.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------transport update reocrd----------------------
if(isset($_POST['changes_transport'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".VEHICLES." SET  
													vehicle_status		= '".cleanvars($_POST['vehicle_status'])."'
												  , id_route			= '".cleanvars($_POST['id_route'])."' 
												  , vehicle_no			= '".cleanvars($_POST['vehicle_no'])."' 
												  , vehicle_capacity	= '".cleanvars($_POST['vehicle_capacity'])."'
												  , vehicle_driver		= '".cleanvars($_POST['vehicle_driver'])."' 
												  , vehicle_driverphone	= '".cleanvars($_POST['vehicle_driverphone'])."' 
												  , vehicle_driverlicense = '".cleanvars($_POST['vehicle_driverlicense'])."' 
												  ,
												  id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE vehicle_id	= '".cleanvars($_POST['vehicle_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update transport: "'.cleanvars($_POST['vehicle_no']).'" details';
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
			header("Location: transport_vehicles.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


