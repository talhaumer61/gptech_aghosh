<?php 
//----------------Room insert record----------------------
if(isset($_POST['make_registration'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT type  
										FROM ".HOSTEL_REG." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_std = '".cleanvars($_POST['id_std'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostelUsers.php", true, 301);
		exit();
		//--------------------------------------
	} else { 
		//------------------------------------------------
		$joining_date = date('Y-m-d' , strtotime(cleanvars($_POST['joining_date'])));
		
		if(!empty($_POST['leaving_date'])) {
			$leaving_date = date('Y-m-d' , strtotime(cleanvars($_POST['leaving_date'])));
		} else{
			$leaving_date = "0000-00-00";
		}
		//------------------------------------------------
		$sqllms  = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
														status							, 
														id_std							,
														id_hostel						,
														id_floor						,
														id_room							,  
														joining_date					, 
														leaving_date					,
														id_campus 						,
														id_added						,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							, 
														'".cleanvars($_POST['id_std'])."'							,
														'".cleanvars($_POST['id_hostel'])."'						,
														'".cleanvars($_POST['id_floor'])."'							,
														'".cleanvars($_POST['id_room'])."'							,
														'".cleanvars($joining_date)."'								,
														'".cleanvars($leaving_date)."'								,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
                                                        '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
                                                        Now()

													  )"
							);
		//-------- Get latest Id --------------- 
		$idsetup = $dblms->lastestid();	
		//------------- Update Std Taable --------------
		$updateStd  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													is_hostelized	= '1'
											  WHERE std_id			= '".cleanvars($_POST['id_std'])."'");
											  
		//------------------------------------------------
		if($sqllms) { 
			$remarks = 'New Hostel Registration, ID: '.$idsetup.' detail';
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
			header("Location: hostelUsers.php", true, 301);
			exit();
			//--------------------------------------
		}
	} // end checker
//--------------------------------------
} 
//----------------update reocrd----------------------
if(isset($_POST['chnages_registration'])) { 

	//------------------------------------------------
	$joining_date = date('Y-m-d' , strtotime(cleanvars($_POST['joining_date'])));
	if(!empty($_POST['leaving_date'])) {
		$leaving_date = date('Y-m-d' , strtotime(cleanvars($_POST['leaving_date'])));
	} else{
		$leaving_date = "0000-00-00";
	}
	//------------------------------------------------
	// , monthly_fee	= '".cleanvars($_POST['monthly_fee'])."'
	$sqllms  = $dblms->querylms("UPDATE ".HOSTEL_REG." SET  
													  status		= '".cleanvars($_POST['status'])."'
													, id_hostel 	= '".cleanvars($_POST['id_hostel'])."' 
													, id_floor		= '".cleanvars($_POST['id_floor'])."' 
													, id_room		= '".cleanvars($_POST['id_room'])."'  
													, joining_date	= '".cleanvars($joining_date)."' 
													, leaving_date	= '".cleanvars($leaving_date)."' 
													, id_modify     = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													, date_modify   = Now()
												WHERE id			= '".cleanvars($_POST['id'])."'");
	if($_POST['status'] == '1'){
		//---- If Status IS Active Then Hostelized ------
		$updateStd  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													is_hostelized	= '1'
											  WHERE std_id			= '".cleanvars($_POST['id_std'])."'");
	}
	else{
		//---- If Status Other than Active Then Change Non Hostelized ------
		$updateStd  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													is_hostelized	= '2'
											  WHERE std_id			= '".cleanvars($_POST['id_std'])."'");
	}
	//--------------------------------------
	if($sqllms) { 
		//--------------------------------------
		$remarks = 'Update Hostel Registration, ID: '.cleanvars($_POST['id']).' details';
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
		header("Location: hostelUsers.php", true, 301);
		exit();
		//--------------------------------------
	}
//--------------------------------------
}
