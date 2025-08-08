<?php 
//----------------Hostel insert record----------------------
if(isset($_POST['submit_route'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT route_name  
										FROM ".ROUTES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND  route_name  = '".cleanvars($_POST['route_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: transport_routes.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ROUTES."(
														route_status						, 
														route_name							, 
														route_startplace					,
														route_endplace 						,
														route_fare							, 
														route_detail					    ,
														id_campus 							
													  )
	   											VALUES(
														'".cleanvars($_POST['route_status'])."'		    , 
														'".cleanvars($_POST['route_name'])."'			,
														'".cleanvars($_POST['route_startplace'])."'		,
														'".cleanvars($_POST['route_endplace'])."'		,
														'".cleanvars($_POST['route_fare'])."'		    ,
														'".cleanvars($_POST['route_detail'])."'		    ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add routes: "'.cleanvars($_POST['route_name']).'" detail';
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
		header("Location: transport_routes.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------- route update reocrd----------------------
if(isset($_POST['changes_route'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ROUTES." SET  
													route_status		= '".cleanvars($_POST['route_status'])."'
												  , route_name			= '".cleanvars($_POST['route_name'])."' 
												  , route_startplace				= '".cleanvars($_POST['route_startplace'])."' 
												  , 
												  route_endplace		= '".cleanvars($_POST['route_endplace'])."'
												  , route_fare			= '".cleanvars($_POST['route_fare'])."' 
												  , route_detail				= '".cleanvars($_POST['route_detail'])."' 
												  ,
												  id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE route_id			= '".cleanvars($_POST['route_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Route : "'.cleanvars($_POST['route_name']).'" details';
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
			header("Location: transport_routes.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


