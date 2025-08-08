<?php
//----------------STATIONARY STATUS UPDATE----------------------
if(isset($_POST['change_sale'])) { 

	if($_POST['payable'] > 0)
	{
		//--------------------------------------
		$sqllms_payable  = $dblms->querylms("INSERT INTO ".INVENTORY_SALE_PAYABLE."(
														id_purchase			,
														id_sale				,
														total_amount		, 
														payable								
														)
												VALUES(
														'".cleanvars($_POST['pur_id'])."'			,
														'".cleanvars($_POST['sal_id'])."' 			,
														'".cleanvars($_POST['total_amount'])."'		,
														'".cleanvars($_POST['payable'])."'				
														)"
							);
		//-------------------------------
		$id_payable = $dblms->lastestid();	
		//------------------------IN PURCHASE--------------------
		$sqllms_pur  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
														pur_status		= '".cleanvars($_POST['sal_status'])."'
													,	pur_payable		= '".cleanvars($_POST['payable'])."'
													WHERE pur_id 		= '".cleanvars($_POST['pur_id'])."'");
		//------------------------ IN SALE --------------------
		$sqllms_sale  = $dblms->querylms("UPDATE ".INVENTORY_SALE." SET  
														sal_status		= '".cleanvars($_POST['sal_status'])."'
													WHERE sal_id 		= '".cleanvars($_POST['sal_id'])."'");
		//--------------------------------------
	}
	else if($_POST['now_pay_amount'] > 0)
	{
		//--------------------------------------
		$sqllms_payable  = $dblms->querylms("UPDATE ".INVENTORY_SALE_PAYABLE." SET 
														paid_amount		= '".cleanvars($_POST['now_pay_amount'])."'
													WHERE id 		= '".cleanvars($_POST['id'])."'");
		//-------------------------------
		$id_payable = $dblms->lastestid();
		//-------------------------------
		
		if($_POST['now_pay_amount'] == $_POST['total_amount'])
		{
			//------------------------IN PURCHASE--------------------
			$sqllms_pur  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
															pur_status		= '".cleanvars($_POST['sal_status'])."'
														,   pur_pay_status	= '1'
														,	pur_paid_amount = '".cleanvars($_POST['now_pay_amount'])."'
														WHERE pur_id 		= '".cleanvars($_POST['pur_id'])."'");
			//------------------------ IN SALE --------------------
			$sqllms_sale  = $dblms->querylms("UPDATE ".INVENTORY_SALE." SET  
															sal_status		= '".cleanvars($_POST['sal_status'])."'
														,	sal_pay_status  = '1'
														WHERE sal_id 		= '".cleanvars($_POST['sal_id'])."'");
			//--------------------------------------
		}
		else
		{
			//------------------------IN PURCHASE--------------------
			$sqllms_pur  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
															pur_status		= '".cleanvars($_POST['sal_status'])."'
														,	pur_paid_amount = '".cleanvars($_POST['now_pay_amount'])."'
														WHERE pur_id 		= '".cleanvars($_POST['pur_id'])."'");
			//------------------------ IN SALE --------------------
			$sqllms_sale  = $dblms->querylms("UPDATE ".INVENTORY_SALE." SET  
															sal_status		= '".cleanvars($_POST['sal_status'])."'
														WHERE sal_id 		= '".cleanvars($_POST['sal_id'])."'");
			//--------------------------------------
		}
	}
	else{
		//------------------------IN PURCHASE--------------------
		$sqllms_pur  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
														pur_status		= '".cleanvars($_POST['sal_status'])."'
													WHERE pur_id 			= '".cleanvars($_POST['pur_id'])."'");
		//------------------------ IN SALE --------------------
		$sqllms_sale  = $dblms->querylms("UPDATE ".INVENTORY_SALE." SET  
														sal_status		= '".cleanvars($_POST['sal_status'])."'
													WHERE sal_id 		= '".cleanvars($_POST['sal_id'])."'");
		//-------------------------------------
	}
	if($sqllms_sale) { 
//--------------------------------------
	$remarks = 'Add new Payable ID: "'.cleanvars($id_payable).'" details';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'2'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'										,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: stationary_sale.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>