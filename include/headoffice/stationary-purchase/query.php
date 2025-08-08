<?php
//----------------STATIONARY PURCHASE ADD----------------------
if(isset($_POST['make_purchase'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT pur_receipt_no,   
										FROM ".INVENTORY_PURCHASE." 
										WHERE pur_receipt_no = '".cleanvars($_POST['pur_receipt_no'])."') LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: stationary_purchase.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//--------------------------------------
$dated = date("Y-m-d");
//--------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_PURCHASE."(
														pur_status						, 
														pur_receipt_no					, 
														pur_total_amount				, 
														dated							,
														id_supplier						,
														pur_note						,
														id_campus 						,
														id_added						,
														date_added	
													  )
	   											VALUES(
														'".cleanvars($_POST['pur_status'])."'						, 
														'".cleanvars($_POST['pur_receipt_no'])."'					,
														'".cleanvars($_POST['pur_total_amount'])."'					,
														'".cleanvars($dated)."'										,
														'".cleanvars($_POST['id_supplier'])."'						,
														'".cleanvars($_POST['pur_note'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
														NOW()
													  )"
							);
//--------------------------------------
$id_setup = $dblms->lastestid();	
//--------------------------------------

$id_item 		= $_POST['id_item']; 
$qty 			= $_POST['qty']; 
$unit_price 	= $_POST['unit_price']; 

// for($j=0; $j <= count(!empty($_POST['id_item'])); $j++){

foreach($id_item as $key => $item){
	// if($qty[$key] != 0){

	$sqllmsdeduction  = $dblms->querylms("INSERT INTO ".INVENTORY_PUR_DETAIL." (
																					id_setup				, 
																					id_item				    , 
																					qty						,
																					unit_price				
																				)
																VALUES(
																		'".cleanvars($id_setup)."' 				,
																		'".cleanvars($item)."'					,
																		'".cleanvars($qty[$key])."'				,
																		'".cleanvars($unit_price[$key])."'			
																	)
															");
	// }
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Headoffice Purchase, Recipiet no: "'.cleanvars($_POST['pur_receipt_no']).'" detail';
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
		header("Location: stationary_purchase.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------STATIONARY PURCHASE UPDATE----------------------
if(isset($_POST['changes_purchase'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
													pur_status			= '".cleanvars($_POST['pur_status'])."'
												  , pur_receipt_no		= '".cleanvars($_POST['pur_receipt_no'])."' 
												  , pur_total_amount	= '".cleanvars($_POST['pur_total_amount'])."' 
												  , id_supplier			= '".cleanvars($_POST['id_supplier'])."' 
												  , pur_note			= '".cleanvars($_POST['pur_note'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE pur_id 				= '".cleanvars($_POST['pur_id'])."'");
//--------------------------------------
$id_setup = $dblms->lastestid();	
//--------------------------------------
 $sqllms  = $dblms->querylms("DELETE FROM ".INVENTORY_PUR_DETAIL." where id_setup = '".cleanvars($_POST['pur_id'])."' ");
//--------------------------------------
for($j=0; $j<= count($_POST['id_item']); $j++){

	if($_POST['qty'][$j] != 0){

	$sqllmsdeduction  = $dblms->querylms("INSERT INTO ".INVENTORY_PUR_DETAIL." (
																		id_setup				, 
																		id_item				    , 
																		qty						,
																		unit_price				
																	)

																VALUES(
																		'".cleanvars(cleanvars($_POST['pur_id']))."' 	,
																		'".cleanvars($_POST['id_item'][$j])."'			,
																		'".cleanvars($_POST['qty'][$j])."'				,
																		'".cleanvars($_POST['unit_price'][$j])."'			
																	)
															");
	}
}
//--------------------------------------



	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Headoffice Purchase, Recipiet no: "'.cleanvars($_POST['pur_receipt_no']).'" details';
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
			header("Location: stationary_purchase.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>