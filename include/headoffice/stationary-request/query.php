<?php

//----------------STATIONARY PURCHASE UPDATE----------------------
if(isset($_POST['changes_request'])) {

	if($_POST['pur_status'] == '6'){
		//------------------------------------------------
		$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
														  pur_status			= '".cleanvars($_POST['pur_status'])."' 
														, id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, date_modify			= NOW()
														WHERE pur_id 			= '".cleanvars($_POST['pur_id'])."'");
		//--------------------------------------
		if($sqllms) { 
			//--------------------------------------
				$remarks = 'Reject Requested Stationary, Recipiet no: "'.cleanvars($_POST['pur_receipt_no']).'" details';
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
						header("Location: stationary_request.php", true, 301);
						exit();
			//--------------------------------------
		}
	} 
	else
	{
		//------------------------------------------------
		$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
														   pur_status			= '".cleanvars($_POST['pur_status'])."' 
														, id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, date_modify			= NOW()
														WHERE pur_id 			= '".cleanvars($_POST['pur_id'])."'");
		//--------------------------------------
		$dated = date("Y-m-d");
		//--------------------------------------
		$sqllms  = $dblms->querylms("INSERT INTO ".INVENTORY_SALE."(
															sal_status						, 
															sal_pay_status					, 
															id_purchase						, 
															receipt_no						, 
															dated							,
															id_customers					,
															note							,
															id_campus 						,
															id_added						,
															date_added	
														)
													VALUES(
															'".cleanvars($_POST['pur_status'])."'						,
															'2'															, 
															'".cleanvars($_POST['pur_id'])."'							,
															'".cleanvars($_POST['pur_receipt_no'])."'					,
															'".cleanvars($dated)."'										,
															'".cleanvars($_POST['id_campus'])."' 						,
															'".cleanvars($_POST['pur_note'])."'							,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
															NOW()
														)"
								);
		//--------------------------------------
		$id_setup = $dblms->lastestid();	
		//--------------------------------------
		$sqllms_payable  = $dblms->querylms("INSERT INTO ".INVENTORY_SALE_PAYABLE."(
														id_purchase			,
														id_sale				,
														total_amount		, 
														payable							
														)
												VALUES(
														'".cleanvars($_POST['pur_id'])."'			,
														'".cleanvars($id_setup)."' 					,
														'".cleanvars($_POST['pur_total_amount'])."'	,
														'".cleanvars($_POST['pur_total_amount'])."'				
														)"
							);
		//-----------------SALE DETAILS---------------------
		for($j=0; $j<= count($_POST['id_item']); $j++){

			if($_POST['qty'][$j] != 0){
		
			$sqllmsdeduction  = $dblms->querylms("INSERT INTO ".INVENTORY_SALE_DETAIL." (
																				id_setup				, 
																				id_item				    , 
																				qty						,
																				unit_price				
																			)
		
																		VALUES(
																				'".cleanvars($id_setup)."' 						,
																				'".cleanvars($_POST['id_item'][$j])."'			,
																				'".cleanvars($_POST['qty'][$j])."'				,
																				'".cleanvars($_POST['unit_price'][$j])."'			
																			)
																	");
			}
		}
		//--------------------------------------
	}
		
		if($sqllms) { 
		//--------------------------------------
			$remarks = 'Accept requested stationary and add into sale, Recipiet no: "'.cleanvars($_POST['pur_receipt_no']).'" details';
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
					header("Location: stationary_request.php", true, 301);
					exit();
		//--------------------------------------
		}
	}
?>