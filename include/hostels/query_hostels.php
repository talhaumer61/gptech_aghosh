<?php 
//----------------Hostel insert record----------------------
if(isset($_POST['submit_hostel'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT hostel_name  
										FROM ".HOSTELS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND hostel_name = '".cleanvars($_POST['hostel_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostels.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".HOSTELS."(
														hostel_status						, 
														hostel_name							, 
														id_type								, 
														hostel_address						,
														hostel_warden						,
														hostel_detail						, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['hostel_status'])."'		, 
														'".cleanvars($_POST['hostel_name'])."'			,
														'".cleanvars($_POST['id_type'])."'				,
														'".cleanvars($_POST['hostel_address'])."'		,
														'".cleanvars($_POST['hostel_warden'])."'		,
														'".cleanvars($_POST['hostel_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Hostel: "'.cleanvars($_POST['hostel_name']).'" detail';
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
		header("Location: hostels.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Hostelupdate reocrd----------------------
if(isset($_POST['changes_hostel'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".HOSTELS." SET  
													hostel_status		= '".cleanvars($_POST['hostel_status'])."'
												  , hostel_name			= '".cleanvars($_POST['hostel_name'])."' 
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , hostel_address		= '".cleanvars($_POST['hostel_address'])."' 
												  , hostel_warden		= '".cleanvars($_POST['hostel_warden'])."' 
												  , hostel_detail		= '".cleanvars($_POST['book_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE hostel_id			= '".cleanvars($_POST['hostel_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel: "'.cleanvars($_POST['hostel_name']).'" details';
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
			header("Location: hostels.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//----------------Room insert record----------------------
if(isset($_POST['submit_room'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT room_name  
										FROM ".HOSTEL_ROOMS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_hostel = '".cleanvars($_POST['id_hostel'])."' 
										AND room_name = '".cleanvars($_POST['room_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostelrooms.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".HOSTEL_ROOMS."(
														room_status						, 
														room_name						, 
														id_hostel						, 
														room_beds						,
														room_bedfee						,
														room_detail						, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['room_status'])."'		, 
														'".cleanvars($_POST['room_name'])."'		,
														'".cleanvars($_POST['id_hostel'])."'		,
														'".cleanvars($_POST['room_beds'])."'		,
														'".cleanvars($_POST['room_bedfee'])."'		,
														'".cleanvars($_POST['room_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Hostel Room: "'.cleanvars($_POST['room_name']).'" detail';
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
		header("Location: hostelrooms.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------update reocrd----------------------
if(isset($_POST['changes_room'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".HOSTEL_ROOMS." SET  
													room_status		= '".cleanvars($_POST['room_status'])."'
												  , room_name		= '".cleanvars($_POST['room_name'])."' 
												  , id_hostel		= '".cleanvars($_POST['id_hostel'])."' 
												  , room_beds		= '".cleanvars($_POST['room_beds'])."' 
												  , room_bedfee		= '".cleanvars($_POST['room_bedfee'])."' 
												  , room_detail		= '".cleanvars($_POST['room_detail'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE room_id			= '".cleanvars($_POST['room_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel Room: "'.cleanvars($_POST['room_name']).'" details';
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
			header("Location: hostelrooms.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
