<?php
//----------------STATIONARY STATUS UPDATE----------------------
if(isset($_POST['change_sale'])) { 

	if($_POST['payable'] > 0){
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
		$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
														pur_payable		= '".cleanvars($_POST['payable'])."'
													WHERE pur_id 			= '".cleanvars($_POST['pur_id'])."'");
		//--------------------------------------
	}
	else
	{
		//--------------------------------------
		$total_paid = $_POST['paid_amount'] + $_POST['total_amount'];
		//------------------IF ALL AMOUNT PAID THE CHANGE STATUS AS PAID--------------------
		if($total_paid = $_POST['paid_amount']){
			
			//--------------------------------------
			$sqllms_payable  = $dblms->querylms("UPDATE ".INVENTORY_SALE_PAYABLE." SET 
															paid_amount	= '".cleanvars($total_paid['paid_amount'])."'
														WHERE id 			= '".cleanvars($_POST['id'])."'");
			//------------------ SALE --------------------
			$sqllms_sale  = $dblms->querylms("UPDATE ".INVENTORY_SALE." SET 
																sal_pay_status	= '1'
														WHERE 	sal_id  		= '".cleanvars($_POST['sal_id'])."'");
			//------------------------IN PURCHASE--------------------
			$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
														      pur_paid_amount = '".cleanvars($_POST['paid_amount'])."'
															  pur_pay_status  = '1'
														WHERE pur_id 		  = '".cleanvars($_POST['pur_id'])."'");
			//--------------------------------------
		}
		else
		{
			//--------------------------------------
			$sqllms_payable  = $dblms->querylms("UPDATE ".INVENTORY_SALE_PAYABLE." SET 
															  paid_amount	= '".cleanvars($total_paid['paid_amount'])."'
														WHERE id 			= '".cleanvars($_POST['id'])."'");
			//------------------------IN PURCHASE--------------------
			$sqllms  = $dblms->querylms("UPDATE ".INVENTORY_PURCHASE." SET  
															  pur_paid_amount = '".cleanvars($_POST['paid_amount'])."'
														WHERE pur_id 		  = '".cleanvars($_POST['pur_id'])."'");
			//--------------------------------------
		}
	}
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add new Payable ID: "'.cleanvars($_POST['id']).'" details';
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
			header("Location: stationary-sale.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>