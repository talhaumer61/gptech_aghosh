<?php 
//----------------voucher insert record----------------------
if(isset($_POST['submit_transaction'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT trans_name
										FROM ".VISITOR." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND trans_name = '".cleanvars($_POST['trans_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: transaction.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".VISITOR."( 
														trans_name					, 
														trans_cat	                , 
														trans_amount			    , 
														voucher_no                  ,
														trans_method				,
														dated				      	, 
														id_campus                   ,
														id_added					,
														date_added
														 	
													  )
	   											VALUES(
														'".cleanvars($_POST['trans_name'])."'	    				,
														'".cleanvars($_POST['trans_cat'])."'						,
														'".cleanvars($_POST['trans_amount'])."'						, 
														'".cleanvars($_POST['voucher_no'])."'	    				,
														'".cleanvars($_POST['trans_method'])."'	  					,
														'".cleanvars($_POST['dated'])."'	  	    				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'     ,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add voucher : "'.cleanvars($_POST['trans_name']).'" detail';
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
		header("Location: transaction.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//--------------account update reocrd----------------------
if(isset($_POST['changes_voucher'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".VISITOR." SET  
													trans_status     
													= '".cleanvars($_POST['trans_status'])."' 	   ,
												    trans_name	
													= '".cleanvars($_POST['trans_name'])."' 	    , 
												    trans_cat	
													= '".cleanvars($_POST['trans_cat'])."'    		, 
												    trans_amount	
													= '".cleanvars($_POST['trans_amount'])."'  		,
												    vouchar_no
													= '".cleanvars($_POST['vouchar_no'])."' 	    ,
													trans_method	
													= '".cleanvars($_POST['trans_method'])."'       ,
												    dated	
													= '".cleanvars($_POST['dated'])."'              , 
												    id_campus
													= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'                             ,
												   id_modify	
												   = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'                                				,
												    date_modify		= NOW()
   											        WHERE trans_id		= '".cleanvars($_POST['trans_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update voucher: "'.cleanvars($_POST['trans_name']).'" details';
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
			header("Location: account.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


