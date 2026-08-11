<?php 

//----------------Hostel USer update reocrd----------------------
if(isset($_POST['user_hostel_update'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".HOSTEL_TRANSACTION." SET  
												id_hostel		= '".cleanvars($_POST['hstl_name'])."'  		,
												 id_room			= '".cleanvars($_POST['room_name'])."' 		,
												 date_end		= '".cleanvars($_POST['end_date'])."'          , 
												 id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE id		= '".cleanvars($_POST['hostel_transctn_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel User Update: "'.cleanvars($_POST['room_name']).'" details';
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
			header("Location: hostels-user.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>
