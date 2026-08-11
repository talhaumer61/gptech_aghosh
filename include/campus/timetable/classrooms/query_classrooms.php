<?php 
//----------------timetable class room insert record----------------------
if(isset($_POST['submit_classrooms'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT room_no  
										FROM ".CLASS_ROOMS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND room_no = '".cleanvars($_POST['room_no'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: timetable_classrooms.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".CLASS_ROOMS."(
														room_status						, 
														room_no							, 
														room_capacity					, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['room_status'])."'		, 
														'".cleanvars($_POST['room_no'])."'			,
														'".cleanvars($_POST['room_capacity'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add classrooms: "'.cleanvars($_POST['room_no']).'" detail';
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
		header("Location: timetable_classrooms.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------classrooms update reocrd----------------------
if(isset($_POST['changes_classrooms'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".CLASS_ROOMS." SET  
													room_status		= '".cleanvars($_POST['room_status'])."'
												  , room_no			= 
												  '".cleanvars($_POST['room_no'])."' 
												  , room_capacity				= '".cleanvars($_POST['room_capacity'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE room_id			= '".cleanvars($_POST['room_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update classrooms: "'.cleanvars($_POST['room_no']).'" details';
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
															'".cleanvars($remarks)."'					,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: timetable_classrooms.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}



//---------------- Delete reocrd----------------------
if(isset($_GET['deleteid'])) { 
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".CLASS_ROOMS." SET  
														  is_deleted				= '1'
														, id_deleted				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, ip_deleted				= '".$ip."'
														, date_deleted			= NOW()
													 WHERE room_id 			= '".cleanvars($_GET['deleteid'])."'");
	//--------------------------------------
		if($sqllms) { 
	//--------------------------------------
		$remarks = 'Period Deleted ID: "'.cleanvars($_GET['deleteid']).'" details';
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
																'3'											, 
																NOW()										,
																'".cleanvars($ip)."'						,
																'".cleanvars($remarks)."'						,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															  )
										");
	//--------------------------------------
				$_SESSION['msg']['title'] 	= 'Warning';
				$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
				$_SESSION['msg']['type'] 	= 'warning';
				header("Location: timetable_classrooms.php", true, 301);
				exit();
	//--------------------------------------
		}
	//--------------------------------------
	}

?>
