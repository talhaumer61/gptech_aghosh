<?php 
//-----------------------CATEGORY-----------------------------

//----------------Cat insert record----------------------
if(isset($_POST['submit_cat'])) { 
//--------------------------------------
	$sqllmscheck  = $dblms->querylms("SELECT cat_name, cat_type, id_campus  
										FROM ".SCHOLARSHIP_CAT." 
										WHERE cat_name = '".cleanvars($_POST['cat_name'])."' AND cat_type  = '3' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: fine_category.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SCHOLARSHIP_CAT."(
														cat_status					, 
														cat_type					,
														cat_name					,
														cat_detail					, 
														id_campus						 	
													  )
	   											VALUES(
														'".cleanvars($_POST['cat_status'])."'						, 
														'3'															, 
														'".cleanvars($_POST['cat_name'])."'							, 
														'".cleanvars($_POST['cat_detail'])."'						, 
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Scholarship Category: "'.cleanvars($_POST['cat_name']).'" detail';
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
		header("Location: fine_category.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------Cat Update reocrd----------------------
if(isset($_POST['changes_cat'])) { 
//--------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".SCHOLARSHIP_CAT." SET  
													cat_status		= '".cleanvars($_POST['cat_status'])."'
												  , cat_name		= '".cleanvars($_POST['cat_name'])."'	
												  , cat_detail		= '".cleanvars($_POST['cat_detail'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
   											  WHERE cat_id		= '".cleanvars($_POST['cat_id'])."'");

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Scholarship Category: "'.cleanvars($_POST['cat_name']).'" details';
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
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: fine_category.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}



//----------------------Fine-------------------------------------

//----------------Fine insert record----------------------
if(isset($_POST['submit_fine'])) { 
//--------------------------------------
$date = date('Y-m-d' , strtotime(cleanvars($_POST['date'])));
//--------------------------------------
	$sqllmscheck  = $dblms->querylms("SELECT id_std, id_cat, date, id_session, id_campus
										FROM ".SCHOLARSHIP." 
										WHERE id_std = '".cleanvars($_POST['id_std'])."' AND id_cat = '".cleanvars($_POST['id_cat'])."'AND date = '".cleanvars($date)."'
										AND id_session = '".cleanvars($_POST['id_session'])."' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: scholarship.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".SCHOLARSHIP."(
														status					, 
														id_type					, 
														amount					,
														date					,
														id_cat					, 
														id_class				, 
														id_std					,
														id_session				, 
														note					,
														id_campus				,
														id_added				,
														date_added			 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'								, 
														'3'																,
														'".cleanvars($_POST['amount'])."'								, 
														'".cleanvars($date)."'											, 
														'".cleanvars($_POST['id_cat'])."'								, 
														'".cleanvars($_POST['id_class'])."'								, 
														'".cleanvars($_POST['id_std'])."'								, 
														'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,
														'".cleanvars($_POST['note'])."'									,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Fine: "'.cleanvars($_POST['id_std']).'" detail';
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
		header("Location: fine.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Fine Update reocrd----------------------
if(isset($_POST['changes_fine'])) { 
//--------------------------------------
$date = date('Y-m-d' , strtotime(cleanvars($_POST['date'])));
//--------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".SCHOLARSHIP." SET  
													status		= '".cleanvars($_POST['status'])."'
												  ,	amount		= '".cleanvars($_POST['amount'])."' 
												  ,	date		= '".cleanvars($date)."' 
												  , id_cat		= '".cleanvars($_POST['id_cat'])."'	
												  , id_class	= '".cleanvars($_POST['id_class'])."'
												  , id_std		= '".cleanvars($_POST['id_std'])."' 
												  , id_session	= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
												  , note		= '".cleanvars($_POST['note'])."' 
												  , id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												  , id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify	= NOW()
   											  WHERE id		= '".cleanvars($_POST['id'])."'");

	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Fine: "'.cleanvars($_POST['id_std']).'" details';
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
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: fine.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>