<?php 
//---------------- Donation Challans Genrate ----------------------
if(isset($_POST['single_challans_generate'])) { 
	//------------------------Reformat Date------------------------
	$challandate = substr(date('Y'),2,4);
	$issue_date = date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
	//------------------------------------------------	

	//-------- If Challan Not Exsist Then Genrate ---------
	$sqllmscheck  = $dblms->querylms("SELECT id_donor
										FROM ".FEES." 
										WHERE id_donor = '".cleanvars ($_POST['id_donor'])."'
										AND id_month = '".cleanvars($_POST['id_month'])."'
										AND to_month = '".cleanvars($_POST['to_month'])."'
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND is_deleted != '1'
									");	
	if(mysqli_num_rows($sqllmscheck) > 0) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: donationChallans.php", true, 301);
		exit();
	} else {
		//----------------------Challan Number-------------------------
		$sqllmschallan 	= $dblms->querylms("SELECT challan_no 
												FROM ".FEES." 
												WHERE challan_no LIKE '9930".$challandate."%'  
												ORDER by challan_no DESC LIMIT 1 ");
		$rowchallan 	= mysqli_fetch_array($sqllmschallan);
		if(mysqli_num_rows($sqllmschallan) < 1) {
			$challano	= '9930'.$challandate.'00001';
		} else  {
			$challano = ($rowchallan['challan_no'] +1);
		}

		//---------------------- Make Challan -------------------------
		$sqllms  = $dblms->querylms("INSERT INTO ".FEES."(
															status						,
															id_type						,
															challan_no					, 
															id_session					, 
															id_month					,
															to_month					,
															message_send				,
															id_donor					,
															issue_date					,
															due_date					,
															total_amount				,
															note						, 
															id_campus 					,
															id_added					,
															date_added
														)
													VALUES(
															'2'																,
															'3'																,
															'".cleanvars($challano)."'										,
															'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	, 
															'".cleanvars($_POST['id_month'])."'								,
															'".cleanvars($_POST['to_month'])."'								,
															'".cleanvars($_POST['message_send'])."'							,
															'".cleanvars($_POST['id_donor'])."'								,
															'".cleanvars($issue_date)."'									, 
															'".cleanvars($due_date)."'										,
															'".cleanvars($_POST['grand_total'])."'							,
															'".cleanvars($_POST['note'])."'									,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															Now()	
														)");
		//-------------------------Fee Particulars Detail-----------------------
		if($sqllms) { 
			//-------- Get latest Id --------- 
			$idsetup = $dblms->lastestid();	
			//--------------------------------
			
			for($i=0; $i< count($_POST['id_std']); $i++){
				$sqllmsInsert = $dblms->querylms("INSERT INTO ".DONATION_DETAILS."(
														id_donation 	,
														id_std			,
														amount				
														)
													VALUES(
														'".cleanvars($idsetup)."'						,
														'".cleanvars($_POST['id_std'][$i])."'			,
														'".cleanvars($_POST['amount'][$i] * $_POST['months'])."'				
														)");
			}

			//-------------------- Make Log ------------------------
			$remarks = 'Donation Created For Month '.get_monthtypes($_POST['id_month']).'.';
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
														'1'																	, 
														'".cleanvars($challano)."'											,
														NOW()																,
														'".cleanvars($ip)."'												,
														'".cleanvars($remarks)."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
													)");
			if($_POST['message_send'] == '1') {
				//Donor Details
				$sqllmsDonors	= $dblms->querylms("SELECT donor_id, donor_name, donor_phone
															FROM ".DONORS."
															WHERE donor_id != ''
															AND  donor_id = '".cleanvars($_POST['id_donor'])."' LIMIT 1");
				$rowDonor = mysqli_fetch_array($sqllmsDonors);

				$phone = str_replace("-","",$rowDonor['donor_phone']);
				
				if($_POST['months'] > 1) {
					$msgMonth = 'from Month '.get_monthtypes(ltrim(cleanvars($_POST['id_month'], "0"))).' to '.get_monthtypes(ltrim(cleanvars($_POST['to_month'], "0"))).'';
				} else {
					$msgMonth = 'for Month '.get_monthtypes(ltrim(cleanvars($_POST['id_month'], "0"))).'';
				}

				// Set Credentials, Cell and MSG in Data Objects
				$data['username'] = 'demoumer';
				$data['password'] = '786786';
				$data['mask'] = 'AGS';
				$data['mobile'] = $phone;
				$data['message'] = 'Dear '.$rowDonor['donor_name'].',\n\nJust a soft reminder, your blessed Sponsor Child Donation Challan #'.cleanvars($challano).' '.$msgMonth.' of Rs.'.number_format(cleanvars($_POST['grand_total'])).' bearing due date '.date('d-m-Y', strtotime($due_date)).' is generated.\nKindly do the needful to pay your donation through Finja (IBFT) by entering your Challan number through the mobile banking App.\n\nOr Click to pay via Credit/Debit Card.\nhttps://aghosh.gptech.pk/payProPayment.php?challan_no='.$challano.'\n\nThanks,\nAGHOSH COMPLEX';
			
				$curl = curl_init();
			
				curl_setopt_array($curl, array(
				CURLOPT_URL => "https://brandyourtext.com/sms/api/send",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data,
				));
			
				$response = curl_exec($curl);
				$err = curl_error($curl);
			
				curl_close($curl);

			}
			
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: donationchallanprint.php?id=".$challano."", true, 301);
			exit();
			//--------------------------------------
		}
	}

}

//Update Donor Challan
if(isset($_POST['update_donor_challan'])) { 

	if($_POST['status'] == 1){

		$paidAmount = cleanvars($_POST['payable']);
		$paidDate = date('Y-m-d');
		$logRemarks = 'Paid Donor Challan manually';
		$dueDateColumn = "";

	} else{

		$paidAmount = 0;
		$paidDate = "0000-00-00";
		$logRemarks = 'Updated Donor Challan';
		$dueDateColumn = ",	due_date				= '".date('Y-m-d', strtotime(cleanvars($_POST['due_date'])))."'";
	}

	//Update Donor Challan
	$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET 
												status					= '".cleanvars($_POST['status'])."'
												$dueDateColumn
											,	paid_date				= '".cleanvars($paidDate)."'
											,	total_amount			= '".cleanvars($_POST['payable'])."'
											,	paid_amount				= '".cleanvars($paidAmount)."'
											,	note					= '".cleanvars($_POST['note'])."'
											,	id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify				= NOW()
										WHERE   challan_no				= '".cleanvars($_POST['challan_no'])."'");

	if($sqllmsUpdate){	

		//Log Details
		$sqllmsLog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
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
															'".cleanvars($logRemarks)."'											,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														)
									");

		//Set Success MSG in Session and redirect
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: donationChallans.php", true, 301);
		exit();
	}
	
}

//Delete Donation Challan
if(isset($_GET['deleteid'])) { 

	//Update challan as deleted
	$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET  
												  is_deleted			= '1'
												, id_deleted			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												, ip_deleted			= '".$ip."'
												, date_deleted			= NOW()
											WHERE challan_no 			= '".cleanvars($_GET['deleteid'])."'");
	//If Challan is set to deleted
	if($sqllmsUpdate){ 

		//Log Details
		$remarks = 'Donor Challan Deleted ID: "'.cleanvars($_GET['deleteid']);
		$sqllmsLog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
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
															'".cleanvars($_GET['deleteid'])."'									,
															NOW()																,
															'".cleanvars($ip)."'												,
															'".cleanvars($remarks)."'											,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														)
									");

		//Set Success MSG in Session and redirect
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: donationChallans.php", true, 301);
		exit();
	}
}
?>