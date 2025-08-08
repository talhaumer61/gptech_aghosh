<?php 
//----------------expense insert record----------------------
if(isset($_POST['submit_expense'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT voucher_no  
										FROM ".EXPENSES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND voucher_no = '".cleanvars($_POST['voucher_no'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: expenses.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EXPENSES."(
														status						, 
														id_cat						, 
														name	                    , 
														voucher_no					, 
														dated				      	, 
														amount	                    ,
														detail				        ,
														id_campus                   ,
														id_added					, 
														date_added	                
														 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'		, 
														'".cleanvars($_POST['id_cat'])."'	    ,
														'".cleanvars($_POST['name'])."'			,
														'".cleanvars($_POST['voucher_no'])."'	, 
														'".cleanvars($dated)."'	    ,
														'".cleanvars($_POST['amount'])."'	    ,
														'".cleanvars($_POST['detail'])."'     	, 
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' ,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add expense : "'.cleanvars($_POST['voucher_no']).'" detail';
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
		header("Location: expenses.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------expense update reocrd----------------------
if(isset($_POST['changes_expense'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EXPENSES." SET  
													status      = '".cleanvars($_POST['status'])."'  ,
												    id_cat		= '".cleanvars($_POST['id_cat'])."'  , 
												    name		= '".cleanvars($_POST['name'])."'    , 
												    voucher_no	= '".cleanvars($_POST['voucher_no'])."'  ,
												    dated		= '".cleanvars($dated)."'   ,
												    amount		= '".cleanvars($_POST['amount'])."'  , 
												    detail		= '".cleanvars($_POST['detail'])."'  , 
												    id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' ,
												   id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' ,
												    date_modify		= NOW()
   											        WHERE id		= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update expense: "'.cleanvars($_POST['voucher_no']).'" details';
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
			header("Location: expenses.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


