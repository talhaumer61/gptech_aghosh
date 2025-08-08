<?php 
//----------------Room insert record----------------------
if(isset($_POST['submit_room'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT room_name  
										FROM ".HOSTEL_ROOMS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND room_name = '".cleanvars($_POST['room_name'])."'
										AND id_hostel = '".cleanvars($_POST['id_hostel'])."' 
										AND id_floor = '".cleanvars($_POST['id_floor'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostelRooms.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".HOSTEL_ROOMS."(
														room_status						, 
														room_name						,
														room_type						,
														room_beds						,
														room_bedfee						,
														room_detail						,  
														id_hostel						, 
														id_floor						, 
														id_campus 						,
														id_added						,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['room_status'])."'						, 
														'".cleanvars($_POST['room_name'])."'						,
														'".cleanvars($_POST['room_type'])."'						,
														'".cleanvars($_POST['room_beds'])."'						,
														'".cleanvars($_POST['room_bedfee'])."'						,
														'".cleanvars($_POST['room_detail'])."'						,
														'".cleanvars($_POST['id_hostel'])."'						,
														'".cleanvars($_POST['id_floor'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
                                                        '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
                                                        Now()

													  )"
							);
//-------- Get latest Id --------------- 
$idsetup = $dblms->lastestid();	
//--------------------------------------
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Hostel Room: "'.cleanvars($_POST['room_name']).'", ID: '.$idsetup.' detail';
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
		header("Location: hostelRooms.php", true, 301);
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
												  , room_type		= '".cleanvars($_POST['room_type'])."' 
												  , room_beds		= '".cleanvars($_POST['room_beds'])."' 
												  , room_bedfee		= '".cleanvars($_POST['room_bedfee'])."' 
												  , room_detail		= '".cleanvars($_POST['room_detail'])."' 
												  , id_hostel		= '".cleanvars($_POST['id_hostel'])."' 
												  , id_floor		= '".cleanvars($_POST['id_floor'])."' 
												  , id_modify       = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
                                                  , date_modify     = Now()
   											  WHERE room_id			= '".cleanvars($_POST['room_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel Room: "'.cleanvars($_POST['room_name']).'", ID: '.cleanvars($_POST['room_id']).' details';
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
			header("Location: hostelRooms.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
