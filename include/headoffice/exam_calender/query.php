<?php 
//---------------- Insert record ----------------------
if(isset($_POST['submit_calendar'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_session
										FROM ".EXAM_CALENDER." 
										WHERE id_session = '".cleanvars($_POST['id_session'])."' 
										AND is_deleted != '1'
										LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_calender.php", true, 301);
		exit();
//--------------------------------------
	} else { 
	$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_CALENDER."(
														status		,
														published	,
														id_session	,
														term		,
														term_start	,
														term_end	,
														id_added	,
														date_added													
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							,
														'".cleanvars($_POST['published'])."'						,
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_POST['term'])."'								,
														'".cleanvars(date('Y-m-d' , strtotime($_POST['term_start'])))."',
														'".cleanvars(date('Y-m-d' , strtotime($_POST['term_end'])))."',
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														 Now()																						
													  )
								");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
//-------------------Get latest Id---------------- 
$idsetup = $dblms->lastestid();	
//------------------------------------------------
	for($i=1; $i<= count($_POST['id_type']); $i++){
		if((!empty($_POST['id_type'][$i])) && (!empty($_POST['date_start'][$i]))){
		$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_CALENDER_DETAIL."(
															id_setup		,
															id_type			,
															date_start		,
															date_end		,
															remarks															
														)
													VALUES(
															'".cleanvars($idsetup)."'											,
															'".cleanvars($_POST['id_type'][$i])."'								,
															'".cleanvars(date('Y-m-d' , strtotime($_POST['date_start'][$i])))."',
															'".cleanvars(date('Y-m-d' , strtotime($_POST['date_end'][$i])))."'	,
															'".cleanvars($_POST['remarks'][$i])."'														
														)
									");
		}
	}
//------------------------------------------------
	$remarks = 'Add Exam Calender ID: "'.cleanvars($idsetup).'" detail';
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
		header("Location: exam_calender.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------Academic Calendar Update reocrd----------------------
if(isset($_POST['changes_calendar'])) { 
	$sqllms  = $dblms->querylms("UPDATE ".EXAM_CALENDER." SET  
													  status				= '".cleanvars($_POST['status'])."'
													, published				= '".cleanvars($_POST['published'])."'
													, id_session			= '".cleanvars($_POST['id_session'])."' 
													, term					= '".cleanvars($_POST['term'])."' 
													, term_start			= '".cleanvars(date('Y-m-d' , strtotime($_POST['term_start'])))."' 
													, term_end				= '".cleanvars(date('Y-m-d' , strtotime($_POST['term_end'])))."' 
													, id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													, date_modify			= NOW()   
												WHERE id					= '".cleanvars($_POST['id'])."'");
//------------------------------------------------
for($i=1; $i<= count($_POST['id_type']); $i++){
	if((!empty($_POST['id_type'][$i])) && (!empty($_POST['id_edit'][$i])) && (!empty($_POST['date_start'][$i]))){

		$sqllms  = $dblms->querylms("UPDATE ".EXAM_CALENDER_DETAIL." SET  
															id_type		= '".cleanvars($_POST['id_type'][$i])."'  
														, date_start	= '".cleanvars(date('Y-m-d' , strtotime($_POST['date_start'][$i])))."' 
														, date_end		= '".cleanvars(date('Y-m-d' , strtotime($_POST['date_end'][$i])))."' 
														, remarks		= '".cleanvars($_POST['remarks'][$i])."' 
														WHERE id		= '".cleanvars($_POST['id_edit'][$i])."'");

	}
	elseif((!empty($_POST['id_type'][$i])) && (!empty($_POST['date_start'][$i]))){

		$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_CALENDER_DETAIL."(
																		id_setup		,
																		id_type			,
																		date_start		,
																		date_end		,
																		remarks															
																	)
																VALUES(
																		'".cleanvars($_POST['id'])."'					,
																		'".cleanvars($_POST['id_type'][$i])."'			,
																		'".cleanvars(date('Y-m-d' , strtotime($_POST['date_start'][$i])))."',
																		'".cleanvars(date('Y-m-d' , strtotime($_POST['date_end'][$i])))."'	,
																		'".cleanvars($_POST['remarks'][$i])."'														
																	)
															");

	}
}
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
			header("Location: exam_calender.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>