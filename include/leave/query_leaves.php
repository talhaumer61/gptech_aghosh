<?php 
//----------------Leave Category insert record----------------------
if(isset($_POST['submit_leave-cat'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT cat_name 
										FROM ".LEAVE_CATEGORY." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND cat_name = '".cleanvars($_POST['cat_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: leave-cat.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".LEAVE_CATEGORY."(
														cat_status						, 
														cat_name						, 
														cat_days						, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['cat_status'])."'		, 
														'".cleanvars($_POST['cat_name'])."'			,
														'".cleanvars($_POST['cat_days'])."'			,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Leave Category: "'.cleanvars($_POST['cat_name']).'" detail';
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
		header("Location: leave-cat.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Leave Category Update reocrd----------------------
if(isset($_POST['changes_leave_cat'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".LEAVE_CATEGORY." SET  
													cat_status		= '".cleanvars($_POST['cat_status'])."'
												  , cat_name		= '".cleanvars($_POST['cat_name'])."'   
												  , cat_days		= '".cleanvars($_POST['cat_days'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE cat_id			= '".cleanvars($_POST['cat_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Leave Category: "'.cleanvars($_POST['cat_name']).'" details';
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
			header("Location: leave-cat.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//----------------Leave insert record----------------------
if(isset($_POST['submit_leave'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_emply  
										FROM ".LEAVE." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  
										AND id_empply = '".cleanvars($_POST['id_emply'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: leave.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
$applied_date = date('Y-m-d' , strtotime(cleanvars($_POST['applied_date'])));
$from_date = date('Y-m-d' , strtotime(cleanvars($_POST['from_date'])));
$to_date = date('Y-m-d' , strtotime(cleanvars($_POST['to_date'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".LEAVE."(
														status						, 
														applied_date				, 
														id_cat						, 
														reason						,
														from_date					,
														to_date						,
														id_emply					,
														id_session					,
														remarks						,
														approved_by					,
														id_campus					,
														id_added					,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'							, 
														'".cleanvars($applied_date)."'								,
														'".cleanvars($_POST['id_cat'])."'							,
														'".cleanvars($_POST['reason'])."'							,
														'".cleanvars($from_date)."'									,
														'".cleanvars($from_date)."'									,
														'".cleanvars($_POST['id_emply'])."'							,
														'".cleanvars($_POST['id_session'])."'						,
														'".cleanvars($_POST['remarks'])."'							,
														'".cleanvars($_POST['approved_by'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														Now()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Leave: "'.cleanvars($_POST['reason']).'" detail';
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
		header("Location: leave.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Leave update reocrd----------------------
if(isset($_POST['change_leave'])) { 
//------------------------------------------------
//------------------------------------------------
$applied_date = date('Y-m-d' , strtotime(cleanvars($_POST['applied_date'])));
$from_date = date('Y-m-d' , strtotime(cleanvars($_POST['from_date'])));
$to_date = date('Y-m-d' , strtotime(cleanvars($_POST['to_date'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE".LEAVE." SET  
													status			= '".cleanvars($_POST['status'])."'
												  , applied_date	= '".cleanvars($applied_date)."' 
												  , id_cat			= '".cleanvars($_POST['id_cat'])."' 
												  , reason			= '".cleanvars($_POST['reason'])."' 
												  , from_date		= '".cleanvars($from_date)."' 
												  , to_date			= '".cleanvars($to_date)."'  
												  , id_emply		= '".cleanvars($_POST['id_emply'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."'
												  , remarks			= '".cleanvars($_POST['remarks'])."'  
												  , approved_by		= '".cleanvars($_POST['approved_by'])."'  
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  ,	date_modify		= Now()
   											  WHERE id				= '".cleanvars($_POST['id'])."' ");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Leaves: "'.cleanvars($_POST['reason']).'" details';
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
			header("Location: leave.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
