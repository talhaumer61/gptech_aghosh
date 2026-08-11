<?php 
//-------------------Earning Insert----------------------
if(isset($_POST['submit_earning'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT trans_title  
										FROM ".ACCOUNT_TRANS." 
										WHERE voucher_no = '".cleanvars($_POST['voucher_no'])."' AND trans_type = '1'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: earning.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
                                                        trans_status							, 
														trans_title							    ,
														trans_type							    ,
														trans_amount							,
														voucher_no							    ,
														trans_method							,
														trans_note							    ,
														dated							        ,
														id_head							        ,
														id_campus							    ,  
														id_added							    ,  
														date_added 	
													  )
	   											VALUES(
														'1'		                                    , 
														'".cleanvars($_POST['trans_title'])."'		,
														'1'		                                    ,
														'".cleanvars($_POST['trans_amount'])."'		,
														'".cleanvars($_POST['voucher_no'])."'		,
														'".cleanvars($_POST['trans_method'])."'		,
														'".cleanvars($_POST['trans_note'])."'		,
														'".cleanvars($_POST['dated'])."'		    ,
														'".cleanvars($_POST['id_head'])."'		    ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."',
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."',
														NOW()	
													  )"
                            );
        $id_tran = $dblms->lastestid();
//-----------------------end---------------
		if($sqllms) { 
//--------------------------------------
			$remarks = 'Added Earning Transaction # "'.cleanvars($id_tran).'"';
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
			header("Location: earning.php", true, 301);
			exit();
//--------------------------------------
		}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//------------------Earning Update----------------
if(isset($_POST['changes_earning'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ACCOUNT_TRANS." SET  
                                                    trans_title		= '".cleanvars($_POST['trans_title'])."'
												  , trans_amount	= '".cleanvars($_POST['trans_amount'])."' 
												  , voucher_no	    = '".cleanvars($_POST['voucher_no'])."' 
												  , trans_method	= '".cleanvars($_POST['trans_method'])."' 
												  , trans_note	    = '".cleanvars($_POST['trans_note'])."' 
												  , dated	        = '".cleanvars($_POST['dated'])."' 
												  , id_head	        = '".cleanvars($_POST['id_head'])."' 
												  , id_modify	    = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  , date_modify	    = NOW() 
   											  WHERE trans_id		= '".cleanvars($_POST['trans_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Updated Earning Transaction # "'.cleanvars($_POST['trans_id']).'"';
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
			header("Location: earning.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//-------------------Costing Insert----------------------
if(isset($_POST['submit_costing'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT trans_title  
										FROM ".ACCOUNT_TRANS." 
										WHERE voucher_no = '".cleanvars($_POST['voucher_no'])."' AND trans_type = '2'
										AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: costing.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
                                                        trans_status							, 
														trans_title							    ,
														trans_type							    ,
														trans_amount							,
														voucher_no							    ,
														trans_method							,
														trans_note							    ,
														dated							        ,
														id_head							        ,
														id_campus							    ,  
														id_added							    ,  
														date_added 	
													  )
	   											VALUES(
														'1'		                                    , 
														'".cleanvars($_POST['trans_title'])."'		,
														'2'		                                    ,
														'".cleanvars($_POST['trans_amount'])."'		,
														'".cleanvars($_POST['voucher_no'])."'		,
														'".cleanvars($_POST['trans_method'])."'		,
														'".cleanvars($_POST['trans_note'])."'		,
														'".cleanvars($_POST['dated'])."'		    ,
														'".cleanvars($_POST['id_head'])."'		    ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."',
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."',
														NOW()	
													  )"
                            );
        $id_tran = $dblms->lastestid();
//-----------------------end---------------
		if($sqllms) { 
//--------------------------------------
			$remarks = 'Added Costing Transaction # "'.cleanvars($id_tran).'"';
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
			header("Location: costing.php", true, 301);
			exit();
//--------------------------------------
		}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//------------------Earning Update----------------
if(isset($_POST['changes_costing'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".ACCOUNT_TRANS." SET  
                                                    trans_title		= '".cleanvars($_POST['trans_title'])."'
												  , trans_amount	= '".cleanvars($_POST['trans_amount'])."' 
												  , voucher_no	    = '".cleanvars($_POST['voucher_no'])."' 
												  , trans_method	= '".cleanvars($_POST['trans_method'])."' 
												  , trans_note	    = '".cleanvars($_POST['trans_note'])."' 
												  , dated	        = '".cleanvars($_POST['dated'])."' 
												  , id_head	        = '".cleanvars($_POST['id_head'])."' 
												  , id_modify	    = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  , date_modify	    = NOW() 
   											  WHERE trans_id		= '".cleanvars($_POST['trans_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Updated Costing Transaction # "'.cleanvars($_POST['trans_id']).'"';
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
			header("Location: costing.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}