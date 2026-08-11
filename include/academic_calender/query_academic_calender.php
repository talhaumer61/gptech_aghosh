<?php 
//----------------Particulars Insert record----------------------
if(isset($_POST['submit_particular'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT cat_name
										FROM ".ACADEMICCALENAR_PARTICULARS." 
										WHERE particular = '".cleanvars($_POST['cat_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: academiccalender_particulars.php", true, 301);
		exit();
//--------------------------------------
	} else { 
	$sqllms  = $dblms->querylms("INSERT INTO ".ACADEMICCALENAR_PARTICULARS."(
														cat_status		,
														cat_name														
													  )
	   											VALUES(
														'".cleanvars($_POST['cat_status'])."'	,
														'".cleanvars($_POST['cat_name'])."'																	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Academic Calender Particular: "'.cleanvars($_POST['cat_name']).'" detail';
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
		header("Location: academiccalender_particulars.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Particulars Update reocrd----------------------
if(isset($_POST['changes_particular'])) { 
$sqllms  = $dblms->querylms("UPDATE ".ACADEMICCALENAR_PARTICULARS." SET  
													cat_status			= '".cleanvars($_POST['cat_status'])."'
												  , cat_name			= '".cleanvars($_POST['cat_name'])."'  
   											  WHERE cat_id				= '".cleanvars($_POST['cat_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Academic Calendar Particular: "'.cleanvars($_POST['cat_name']).'" details';
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
			header("Location: academiccalender_particulars.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}




//----------------Academic Calender Insert record----------------------
if(isset($_POST['submit_calendar'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_cat, date_start
										FROM ".ACADEMICCALENAR_DETAIL." 
										WHERE id_cat = '".cleanvars($_POST['id_cat'])."' 
										AND   date_start = '".cleanvars($_POST['date_start'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: academic-calender.php", true, 301);
		exit();
//--------------------------------------
	} else { 
	$sqllms  = $dblms->querylms("INSERT INTO ".ACADEMICCALENAR."(
														status		,
														published	,
														id_session	,
														id_added	,
														date_added													
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							,
														'".cleanvars($_POST['published'])."'						,
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														 Now()																						
													  )
								");
//-------------------Get latest Id---------------- 
$idsetup = $dblms->lastestid();		
//----------------Date Cinversion-----------------
$date_start = date('Y-m-d' , strtotime(cleanvars($_POST['date_start'])));
$date_end = date('Y-m-d' , strtotime(cleanvars($_POST['date_end'])));
//------------------------------------------------
 
	$sqllms  = $dblms->querylms("INSERT INTO ".ACADEMICCALENAR_DETAIL."(
														id_setup		,
														id_cat			,
														date_start		,
														date_end		,
														remarks															
													  )
	   											VALUES(
														'".cleanvars($idsetup)."'					,
														'".cleanvars($_POST['id_cat'])."'			,
														'".cleanvars($date_end)."'					,
														'".cleanvars($date_end)."'					,
														'".cleanvars($_POST['remarks'])."'														
													  )
								");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Academic Calender : "'.cleanvars($_POST['date_start']).'" detail';
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
		header("Location: academic-calender.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------Academic Calendar Update reocrd----------------------
if(isset($_POST['changes_calendar'])) { 
$sqllms  = $dblms->querylms("UPDATE ".ACADEMICCALENAR." SET  
													status				= '".cleanvars($_POST['status'])."'
												  , published			= '".cleanvars($_POST['cat_name'])."'
												  , id_session			= '".cleanvars($_POST['id_session'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()   
   											  WHERE id					= '".cleanvars($_POST['id'])."'");
//-------------------Get latest Id---------------- 
$idsetup = $dblms->lastestid();		
//----------------Date Cinversion-----------------
$date_start = date('Y-m-d' , strtotime(cleanvars($_POST['date_start'])));
$date_end = date('Y-m-d' , strtotime(cleanvars($_POST['date_end'])));
//------------------------------------------------
 
$sqllms  = $dblms->querylms("UPDATE ".ACADEMICCALENAR_DETAIL." SET  
												    id_cat			= '".cleanvars($_POST['id_cat'])."'  
												  , date_start		= '".cleanvars($date_start)."' 
												  , date_end		= '".cleanvars($date_end)."' 
												  , remarks			= '".cleanvars($_POST['remarks'])."' 
   											  WHERE id				= '".cleanvars($_POST['detail_id'])."'");
//--------------------------------------

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Academic Calendar : "'.cleanvars($_POST['date_start']).'" details';
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
			header("Location: academic-calender.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>