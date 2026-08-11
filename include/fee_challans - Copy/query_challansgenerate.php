<?php 
//----------------Fee Challan insert record----------------------
if(isset($_POST['challans_generate'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_session, id_class, id_section
										FROM ".FEES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_session 	= '".cleanvars($_POST['id_session'])."'
										AND id_class 	= '".cleanvars($_POST['id_class'])."'
										AND id_section 	= '".cleanvars($_POST['id_section'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: fee_challansgenerate.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------Reformat Date------------------------
$issue_date = date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".FEES."(
														status						, 
														challan_no					,
														id_session					, 
														id_class					, 
														id_section					,
														id_std						,
														issue_date					,
														due_date					,
														total_amount				,
														note						, 
														id_campus 					,
														id_added					,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'								,
														'".cleanvars($_POST['challan_no'])."'							,
														'".cleanvars($_POST['id_session'])."'							, 
														'".cleanvars($_POST['id_class'])."'								,
														'".cleanvars($_POST['id_section'])."'							,
														'".cleanvars($_POST['id_std'])."'							,
														'".cleanvars($issue_date)."'									, 
														'".cleanvars($due_date)."'										,
														'".cleanvars($_POST['total_amount'])."'							,
														'".cleanvars($_POST['note'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														 Now()	
													  )"
													  );
						  
//-------------------------Get latest Id----------------------- 
$idsetup = $dblms->lastestid();	
//-------------------------Fee Particulars Detail-----------------------
	
	for($i=1; $i<= count($_POST['id_cat']); $i++){
	$sqllms  = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
														id_fee			,
														id_cat			,
														amount						
													  )
	   											VALUES(
														'".cleanvars($idsetup)."'						,
														'".cleanvars($_POST['id_cat'][$i])."'			,
														'".cleanvars($_POST['amount'][$i])."'			
													  )"
													  );

												}
	}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Bulk Fee Challans: "'.cleanvars($_POST['id_section']).'" detail';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
															'1'																	, 
															NOW()																,
															'".cleanvars($ip)."'												,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: fee_challansgenerate.php", true, 301);
		exit();
//--------------------------------------

//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------update Feeetup reocrd----------------------
if(isset($_POST['changes_feesetup'])) {
	
//------------------------Reformat Date------------------------
$date = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".FEESETUP." SET  
													status			= '".cleanvars($_POST['status'])."'
												  , dated			= '".cleanvars($date)."' 
												  , id_class		= '".cleanvars($_POST['id_class'])."' 
												  , id_section		= '".cleanvars($_POST['id_section'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."'
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  ,	date_modify		= Now()
   											  WHERE id				= '".cleanvars($_GET['id'])."'");
											  
//----------------update Feeetup detail reocrd----------------------
for($i=1; $i<= count($_POST['id_cat']); $i++){
//---------------------------------------------
											  
$sqllmss  = $dblms->querylms("UPDATE ".FEESETUPDETAIL." SET  
														amount			= '".cleanvars($_POST['amount'][$i])."'
												 	 , duration			= '".cleanvars($_POST['duration'][$i])."' 
												 	 , type				= '".cleanvars($_POST['type'][$i])."'
   											 	 WHERE id				= '".cleanvars($_POST['id_edit'][$i])."'");
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Feesetup: "'.cleanvars($_POST['type']).'" details';
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
			header("Location: feesetup.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
