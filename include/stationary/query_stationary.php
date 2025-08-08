<?php 
//----------------INVENTORY CATEGORY insert record----------------------
if(isset($_POST['submit_stationary'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT cat_name  
										FROM ".INVENTORY_CATEGORY." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND cat_name = '".cleanvars($_POST['cat_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary-category.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_CATEGORY."(
														cat_status							, 
														cat_name							, 
														cat_code							, 
														cat_detail							, 
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['cat_status'])."'		, 
														'".cleanvars($_POST['cat_name'])."'			, 
														'".cleanvars($_POST['cat_code'])."'			,
														'".cleanvars($_POST['cat_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Stationary Category: "'.cleanvars($_POST['cat_name']).'" detail';
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
		header("Location: stationary-category.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------INVENTORY CATEGORY update reocrd----------------------
if(isset($_POST['changes_stationary'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_CATEGORY." SET  
															   cat_status		= '".cleanvars($_POST['cat_status'])."'
												 			 , cat_name			= '".cleanvars($_POST['cat_name'])."'
														     , cat_detail		= '".cleanvars($_POST['cat_detail'])."' 
														     , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											 			WHERE cat_id			= '".cleanvars($_POST['cat_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Stationary Category: "'.cleanvars($_POST['cat_name']).'" details';
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
			header("Location: stationary-category.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//----------------INVENTORY ITEMS insert record----------------------
if(isset($_POST['submit_item'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT item_name  
										FROM ".INVENTORY_ITEMS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_item = '".cleanvars($_POST['id_item'])."' 
										AND item_name = '".cleanvars($_POST['item_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary-item.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_ITEMS."(
														item_status						,
														id_cat							,  
														item_name						, 
														item_code						, 
														item_detail						,
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['item_status'])."'		, 
														'".cleanvars($_POST['id_cat'])."'		, 
														'".cleanvars($_POST['item_name'])."'		,
														'".cleanvars($_POST['item_code'])."'		,
														'".cleanvars($_POST['item_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Stationary Item: "'.cleanvars($_POST['cat_name']).'" detail';
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
		header("Location: stationary-item.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------INVENTORY ITEMS update reocrd----------------------
if(isset($_POST['changes_item'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_ITEMS." SET  
													item_status		= '".cleanvars($_POST['item_status'])."'
												  , item_name		= '".cleanvars($_POST['item_name'])."' 
												  , id_cat			= '".cleanvars($_POST['id_cat'])."' 
												  , item_code		= '".cleanvars($_POST['item_code'])."' 
												  , item_detail		= '".cleanvars($_POST['item_detail'])."' 
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE item_id			= '".cleanvars($_POST['item_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Stationary Item: "'.cleanvars($_POST['item_name']).'" details';
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
			header("Location: stationary-item.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}




//----------------INVENTORY STORE insert record----------------------
if(isset($_POST['submit_store'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT store_name  
										FROM ".INVENTORY_STORES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_store = '".cleanvars($_POST['id_store'])."' 
										AND store_name = '".cleanvars($_POST['store_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary-store.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_STORES."(
														store_status					, 
														store_name						, 
														store_code						, 
														store_detail					,
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['store_status'])."'		, 
														'".cleanvars($_POST['store_name'])."'		,
														'".cleanvars($_POST['store_code'])."'		,
														'".cleanvars($_POST['store_detail'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Stationary Store: "'.cleanvars($_POST['store_name']).'" detail';
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
		header("Location: stationary-store.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------INVENTORY STORE update reocrd----------------------
if(isset($_POST['changes_store'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_STORES." SET  
													store_status		= '".cleanvars($_POST['store_status'])."'
												  , store_name			= '".cleanvars($_POST['store_name'])."' 
												  , store_code			= '".cleanvars($_POST['store_code'])."' 
												  , store_detail		= '".cleanvars($_POST['store_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE store_id			= '".cleanvars($_POST['store_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Stationary Store: "'.cleanvars($_POST['store_name']).'" details';
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
			header("Location: stationary-store.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


//----------------INVENTORY SUPPLIER insert record----------------------
if(isset($_POST['submit_supplier'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT supplier_name  
										FROM ".INVENTORY_SUPPLIERS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND supplier_name = '".cleanvars($_POST['supplier_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary-supplier.php", true, 301);
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
														supplier_contactemail				,
														id_campus 	
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
														'".cleanvars($_POST['supplier_contactemail'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
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
		header("Location: stationary-supplier.php", true, 301);
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
												  , id_campus					= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE supplier_id					= '".cleanvars($_GET['id'])."'");
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
			header("Location: stationary-supplier.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}