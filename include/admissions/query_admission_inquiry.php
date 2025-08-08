<?php 
//----------------Inquiry insert record----------------------
if(isset($_POST['submit_inquiry'])) {	
	$sqllmscheck  = $dblms->querylms("SELECT form_no, id_class 
										FROM ".ADMISSIONS_INQUIRY." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND form_no = '".cleanvars($_POST['form_no'])."'
										AND id_class = '".cleanvars($_POST['id_class'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: admission_inquiry.php", true, 301);
		exit();
//--------------------------------------
	} else {  
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
$date_follow = date('Y-m-d' , strtotime(cleanvars($_POST['datefollowup'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ADMISSIONS_INQUIRY."(
														status							, 
														form_no							,
														name							,
														cell_no							,  
														email							,  
														address							,  
														description						,  
														note							,  
														dated							,  
														datefollowup					,  
														assigned						,  
														reference						,  
														source							,  
														id_class						,  
														num_of_child					,  
														id_campus 						,
														id_added 						,
														date_added 						
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'				, 
														'".cleanvars($_POST['form_no'])."'				, 
														'".cleanvars($_POST['name'])."'					,
														'".cleanvars($_POST['cell_no'])."'				,
														'".cleanvars($_POST['email'])."'				,
														'".cleanvars($_POST['address'])."'				,
														'".cleanvars($_POST['description'])."'			,
														'".cleanvars($_POST['note'])."'					,
														'".cleanvars($dated)."'							,
														'".cleanvars($date_follow)."'					,
														'".cleanvars($_POST['assigned'])."'				,
														'".cleanvars($_POST['reference'])."'			,
														'".cleanvars($_POST['source'])."'				,
														'".cleanvars($_POST['id_class'])."'			,
														'".cleanvars($_POST['num_of_child'])."'			,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Inquiry: "'.cleanvars($_POST['name']).'" detail';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'1'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'										,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: admission_inquiry.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
}
 // end checker
//--------------------------------------
} 
//----------------Ibquiry update reocrd----------------------
if(isset($_POST['changes_inquiry'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
$date_follow = date('Y-m-d' , strtotime(cleanvars($_POST['datefollowup'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ADMISSIONS_INQUIRY." SET  
													status		= '".cleanvars($_POST['status'])."'
												  , name			= '".cleanvars($_POST['name'])."' 
												  , cell_no				= '".cleanvars($_POST['cell_no'])."' 
												  , email				= '".cleanvars($_POST['email'])."' 
												  , address				= '".cleanvars($_POST['address'])."' 
												  , description			= '".cleanvars($_POST['description'])."' 
												  , note				= '".cleanvars($_POST['note'])."' 
												  , dated				= '".cleanvars($dated)."' 
												  , datefollowup		= '".cleanvars($date_follow)."' 
												  , assigned			= '".cleanvars($_POST['assigned'])."' 
												  , reference			= '".cleanvars($_POST['reference'])."' 
												  , source				= '".cleanvars($_POST['source'])."' 
												  , id_class			= '".cleanvars($_POST['id_class'])."' 
												  , num_of_child		= '".cleanvars($_POST['num_of_child'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  , date_modify			= NOW() 
   											  WHERE id			= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Inquiry: "'.cleanvars($_POST['name']).'" details';
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
			header("Location: admission_inquiry.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

