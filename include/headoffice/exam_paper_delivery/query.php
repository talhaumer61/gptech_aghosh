<?php 
//---------------- insert record ----------------------
if(isset($_POST['submit_paperDelivery'])) { 

	$sqllmscheck  = $dblms->querylms("SELECT delivery_id
										FROM ".EXAM_DELIVERY." 
										WHERE id_type = '".cleanvars($_POST['id_type'])."' AND id_term = '".cleanvars($_POST['id_term'])."' 
										AND id_session = '".cleanvars($_POST['id_session'])."' AND id_campus = '".cleanvars($_POST['id_campus'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: exam_paper_delivery.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_DELIVERY."(
														delivery_status					,
														receive_status					,  
														comment							,
														id_type							, 
														id_term							,
														id_session						,
														id_campus						,
														id_added						, 
														date_added 	
													  )
	   											VALUES(
														'1'														, 
														'2'														, 
														'".cleanvars($_POST['comment'])."'						, 
														'".cleanvars($_POST['id_type'])."'						,
														'".cleanvars($_POST['id_term'])."'						,
														'".cleanvars($_POST['id_session'])."'					,
														'".cleanvars($_POST['id_campus'])."'					,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()
													  )"
							);
							
	//--------------------------------------
	$latest_id = $dblms->lastestid();
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Exam Paper Delivery Added ID: "'.cleanvars($latest_id).'", detail';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: exam_paper_delivery.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------- Update reocrd ----------------------
if(isset($_POST['changes_paperDelivery'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EXAM_DELIVERY." SET  
													delivery_status		= '".cleanvars($_POST['delivery_status'])."'
												  ,	comment				= '".cleanvars($_POST['comment'])."'
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , id_term				= '".cleanvars($_POST['id_term'])."' 
												  , id_session			= '".cleanvars($_POST['id_session'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE delivery_id 		= '".cleanvars($_POST['delivery_id'])."'");

//--------------------------------------										  
	if($sqllms) { 
	//--------------------------------------
		$remarks = 'Headoffice Updated Exam Paper Delivery ID: "'.cleanvars($_POST['delivery_id']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks			
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'2'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: exam_paper_delivery.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
