<?php
//----------------INVENTORY SUPPLIER insert record----------------------
if(isset($_POST['submit_supplier'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT supplier_email  
										FROM ".INVENTORY_SUPPLIERS." 
										WHERE supplier_email = '".cleanvars($_POST['supplier_email'])."'  LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary_supplier.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_SUPPLIERS."(
														supplier_status						, 
														supplier_name						, 
														supplier_phone						, 
														supplier_email						,
														supplier_address					, 
														supplier_company					, 
														supplier_contactname				, 
														supplier_contactphone				,
														supplier_contactemail		
													  )
	   											VALUES(
														'".cleanvars($_POST['supplier_status'])."'			, 
														'".cleanvars($_POST['supplier_name'])."'			,
														'".cleanvars($_POST['supplier_phone'])."'			,
														'".cleanvars($_POST['supplier_email'])."'			,
														'".cleanvars($_POST['supplier_address'])."'			,
														'".cleanvars($_POST['supplier_company'])."'			,
														'".cleanvars($_POST['supplier_contactname'])."'		,
														'".cleanvars($_POST['supplier_contactphone'])."'	,
														'".cleanvars($_POST['supplier_contactemail'])."'		
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Stationary Supplier: "'.cleanvars($_POST['supplier_name']).'" detail';
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
		header("Location: stationary_supplier.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------INVENTORY Supplier update reocrd----------------------
if(isset($_POST['change_supplier'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_SUPPLIERS." SET  
													supplier_status				= '".cleanvars($_POST['supplier_status'])."'
												  , supplier_name				= '".cleanvars($_POST['supplier_name'])."' 
												  , supplier_phone				= '".cleanvars($_POST['supplier_phone'])."' 
												  , supplier_email				= '".cleanvars($_POST['supplier_email'])."'
												  , supplier_address			= '".cleanvars($_POST['supplier_address'])."' 
												  , supplier_company			= '".cleanvars($_POST['supplier_company'])."' 
												  , supplier_contactname		= '".cleanvars($_POST['supplier_contactname'])."' 
												  , supplier_contactphone		= '".cleanvars($_POST['supplier_contactphone'])."' 
												  , supplier_contactemail		= '".cleanvars($_POST['supplier_contactemail'])."'  
   											  WHERE supplier_id					= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Stationary Supplier: "'.cleanvars($_POST['supplier_name']).'" details';
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
			header("Location: stationary_supplier.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>