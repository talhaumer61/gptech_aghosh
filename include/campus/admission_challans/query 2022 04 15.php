<?php
//---------------- Update Admission Challan ----------------------
if(isset($_POST['changes_admission_challan'])) { 
	//------------------------------------
	if($_POST['status'] == 1){
		$paidAmount = $_POST['payable'];
		$paidDate = date('Y-m-d');
	}
	else{
		$paidAmount = 0;
		$paidDate = "0000-00-00";
	}
	//------------------------------------
	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
	//------------------------------------
	if($_POST['status'] == 1){

		//----------------- Update Chllan as Paid ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
												status					= '".cleanvars($_POST['status'])."'
											,	due_date				= '".cleanvars($due_date)."'
											,	pay_mode				= '".cleanvars($_POST['pay_mode'])."'
											,	paid_date				= '".cleanvars($paidDate)."'
											,	total_amount			= '".cleanvars($_POST['payable'])."'
											,	paid_amount				= '".cleanvars($paidAmount)."'
											,	note					= '".cleanvars($_POST['note'])."'
											,	id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify				= NOW()
										WHERE   id						= '".cleanvars($_POST['id_fee'])."'
											");
		if($sqllms) 
		{	
			//----------------- Update Chllan Details ---------------------
			for($i=0; $i< count($_POST['id']); $i++){
				$sqllmsPart  = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
														amount	= '".cleanvars($_POST['amount'][$i])."'
												WHERE   id		= '".cleanvars($_POST['id'][$i])."'
												AND   id_fee	= '".cleanvars($_POST['id_fee'])."' ");
			}

			$phone = str_replace("-","",$_POST['std_phone']);

			// Set Credentials, Cell and MSG in Data Objects
			// $data['username'] = 'demoumer';
			// $data['password'] = '786786';
			// $data['mask'] = 'AGS';
			// $data['mobile'] = $phone;
			// $data['message'] = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($_POST['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
		
			// $curl = curl_init();
		
			// curl_setopt_array($curl, array(
			// CURLOPT_URL => "https://brandyourtext.com/sms/api/send",
			// CURLOPT_RETURNTRANSFER => true,
			// CURLOPT_ENCODING => "",
			// CURLOPT_MAXREDIRS => 10,
			// CURLOPT_TIMEOUT => 0,
			// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// CURLOPT_CUSTOMREQUEST => "POST",
			// CURLOPT_POSTFIELDS => $data,
			// ));
		
			// $response = curl_exec($curl);
			// $err = curl_error($curl);
		
			// curl_close($curl);

			//-------------------- ADD IN EARNING -------------------------------

			//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
			$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
			$values_trans_head = mysqli_fetch_array($sqllms_head);

			//------------------- Add INCOME ----------------------
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
																'1'		                                    				,	 
																'".cleanvars($_POST['challan_no'])."'						,
																'".cleanvars($_POST['pay_mode'])."'            				,
																'".cleanvars($paidAmount)."'								,
																'".cleanvars($_POST['challan_no'])."'						,
																'1'															,
																'".cleanvars($_POST['note'])."'								,				
																'".cleanvars($paidDate)."' 									,
																'".cleanvars($values_trans_head['head_id'])."'   			,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
																NOW()	
															)"
									);
			//--------------------------------------
			
			//-------------------- Make Log ------------------------
			$remarks = 'Admission Challan Paid';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																id_user 				, 
																filename				, 
																action					,
																challan_no 				,
																dated					,
																ip						,
																remarks					, 
																id_campus				
															)
			
														VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'3'																	, 
																'".cleanvars($_POST['challan_no'])."'								,
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'											,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
										");

			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: $requestedPage", true, 301);
			exit();
		}
	}
	else{

		//----------------- Update Chllan as Paid ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
												due_date				= '".cleanvars($due_date)."'
											,	total_amount			= '".cleanvars($_POST['payable'])."'
											,	note					= '".cleanvars($_POST['note'])."'
											,	id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify				= NOW()
										WHERE   id						= '".cleanvars($_POST['id_fee'])."'
											");
		//------------------------------------
		if($sqllms) 
		{	
			//----------------- Update Chllan Details ---------------------
			for($i=0; $i< count($_POST['id']); $i++){
				$sqllmsPart  = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
														amount	= '".cleanvars($_POST['amount'][$i])."'
												WHERE   id		= '".cleanvars($_POST['id'][$i])."'
												AND   id_fee	= '".cleanvars($_POST['id_fee'])."' ");
			}
			//-------------------- Make Log ------------------------
			$remarks = 'Admission Challan update';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																id_user 				, 
																filename				, 
																action					,
																challan_no 				,
																dated					,
																ip						,
																remarks					, 
																id_campus				
															)
			
														VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'3'																	, 
																'".cleanvars($_POST['challan_no'])."'								,
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'											,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
										");
			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: $requestedPage", true, 301);
			exit();
		}
	}
} 

//---------------- Make Admission Partial Payment ----------------------
if(isset($_POST['admission_partialPayment'])) { 

	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));

	//----------------- Update Challan ---------------------
	$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
											total_amount		= '".cleanvars($_POST['partial_amount'])."'
										,	remaining_amount	= '".cleanvars($_POST['remaining_amount'])."'
										,	due_date			= '".cleanvars($due_date)."'
										,	note				= '".cleanvars($_POST['note'])."'
										,	id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										, 	date_modify			= NOW()
									  WHERE id					= '".cleanvars($_POST['id_fee'])."'
										");
	//----------------------------------
	$remainingFromPrev = $_POST['remaining_amount'];

	//---------- Get All Values -------------
    $sqllmsFeePart  = $dblms->querylms("SELECT p.id, p.id_cat, p.amount, c.cat_name
											FROM ".FEE_PARTICULARS." p
											INNER JOIN ".FEE_CATEGORY." c ON c.cat_id = p.id_cat
											WHERE p.id_fee = '".cleanvars($_POST['id_fee'])."'
											AND cat_id != '17'
											ORDER BY c.cat_partialpay_ordering ASC");
    while($valFeePart  = mysqli_fetch_array($sqllmsFeePart)) {  

		if($remainingFromPrev > 0) {
			if($valFeePart['amount'] > $remainingFromPrev){
				$addAmount = $valFeePart['amount'] - $remainingFromPrev;
				// echo "checl rem".$addAmount;
				$remainingFromPrev = 0;
				// echo "<br> Update" .$valFeePart['cat_name'].": ".$addAmount;
				// echo"<br>";
				
				$sqllmsUpdateTut = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET  
														amount      = '".cleanvars($addAmount)."'                        
													WHERE id_fee	= '".cleanvars($_POST['id_fee'])."'
													AND id_cat      = '".cleanvars($valFeePart['id_cat'])."'
													AND id          = '".cleanvars($valFeePart['id'])."' ");

			}else{

				$remainingFromPrev = $remainingFromPrev - $valFeePart['amount'];
				// echo "<br> Del, ".$valFeePart['cat_name'].": ".$remainingFromPrev;
				

				$sqllmsDelTut = $dblms->querylms("DELETE FROM ".FEE_PARTICULARS."                        
													WHERE id_fee	= '".cleanvars($_POST['id_fee'])."'
													AND id_cat      = '".cleanvars($valFeePart['id_cat'])."'
													AND id          = '".cleanvars($valFeePart['id'])."' ");
			}
		}

    } // end while loop

	if($sqllms) {
		//-------------------- Make Log ------------------------
		$remarks = 'Admission Partial Payment Added of Amount: '.cleanvars($_POST['partial_amount']).' and Remainigs : '.cleanvars($_POST['remaining_amount']).'';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
															id_user 				, 
															filename				, 
															action					,
															challan_no 				,
															dated					,
															ip						,
															remarks					, 
															id_campus				
														)
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
															'3'																	, 
															'".cleanvars($_POST['challan_no'])."'								,
															NOW()																,
															'".cleanvars($ip)."'												,
															'".cleanvars($remarks)."'											,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														) ");
														
		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: $requestedPage", true, 301);
		exit();
	}

}

?>