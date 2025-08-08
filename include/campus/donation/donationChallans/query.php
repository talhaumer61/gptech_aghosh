<?php 
// Donation Challans Genrate
if(isset($_POST['single_challans_generate'])) { 
	
	// Reformat Date
	$challandate = substr(date('Y'),2,4);
	$issue_date = date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
	// If Challan Not Exsist Then Genrate 
	$sqllmscheck  = $dblms->querylms("SELECT id_donor
										FROM ".FEES." 
										WHERE id_donor = '".cleanvars ($_POST['id_donor'])."'
										AND ( (id_month BETWEEN '".cleanvars($_POST['id_month'])."' AND '".cleanvars($_POST['to_month'])."')
										OR (to_month BETWEEN '".cleanvars($_POST['id_month'])."' AND '".cleanvars($_POST['to_month'])."') )
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
		// Challan Number
		do {
			$challano = '9930'.$challandate.mt_rand(10000,99999);
			$sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
			$sqlCheck	= $dblms->querylms($sqlChallan);
		} while (mysqli_num_rows($sqlCheck) > 0);

		$grandTotal =  $_POST['months'] * array_sum($_POST['amount']);

		// Make Challan
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
															'".cleanvars($grandTotal)."'									,
															'".cleanvars($_POST['note'])."'									,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															Now()	
														)");
		//Fee Particulars Detail
		if($sqllms) { 
			// Get latest Id 
			$idsetup = $dblms->lastestid();	
			
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

			// Make Log
			$remarks = 'Single Donation Created ID# '.$idsetup.'';
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
														'".cleanvars($remarks)."'											,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
													)");
			if($_POST['message_send'] == '1') {
				//Donor Details
				$sqllmsDonors	= $dblms->querylms("SELECT donor_id, donor_name, donor_phone
															FROM ".DONORS."
															WHERE donor_id != ''
															AND  donor_id = '".cleanvars($_POST['id_donor'])."' LIMIT 1");
				$rowDonor = mysqli_fetch_array($sqllmsDonors);

				
				if($_POST['months'] > 1) {
					$msgMonth = 'from Month '.get_monthtypes(ltrim(cleanvars($_POST['id_month'], "0"))).' to '.get_monthtypes(ltrim(cleanvars($_POST['to_month'], "0"))).'';
				} else {
					$msgMonth = 'for Month '.get_monthtypes(ltrim(cleanvars($_POST['id_month'], "0"))).'';
				}

				// Send Messgae
				$phone = str_replace("-","",$rowDonor['donor_phone']);
				$message = 'Dear '.$rowDonor['donor_name'].','.PHP_EOL.''.PHP_EOL.'Just a soft reminder, your blessed Sponsor Child Donation Challan #'.cleanvars($challano).' '.$msgMonth.' of Rs.'.number_format(cleanvars($grandTotal)).' bearing due date '.date('d-m-Y', strtotime($due_date)).' is generated.'.PHP_EOL.'Kindly do the needful to pay your donation through Finja (IBFT) by entering your Challan number through the mobile banking App.'.PHP_EOL.''.PHP_EOL.'Or Click to pay via Credit/Debit Card.'.PHP_EOL.'https://aghosh.gptech.pk/payProPayment.php?challan_no='.$challano.''.PHP_EOL.''.PHP_EOL.'Thanks,'.PHP_EOL.'AGHOSH COMPLEX';
				sendMessage($phone, $message);

			}
			
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: donationchallanprint.php?id=".$challano."", true, 301);
			exit();
		}
	}

}

// Bulk Donation Challans Genarte
if(isset($_POST['bulk_challans_generate'])) { 

	// Reformat Date
	$challandate	=	substr(date('Y'),2,4);
	$issue_date  	=	date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
	$due_date    	=	date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));

	$genratedChallans = 0;

	for($i=1; $i<=COUNT($_POST['donor_id']); $i++) {

		if(isset($_POST['genrateChallan'][$i]) && ($_POST['total_amount'][$i] > 0)) {

			// Message Send 
			if(isset($_POST['sendMessage'][$i])) {$sendMsg = 1;} else {$sendMsg = 2;}

			// If Challan Not Exsist Then Genrate
			$sqllmscheck  = $dblms->querylms("SELECT id_donor
												FROM ".FEES." 
												WHERE id_donor = '".cleanvars ($_POST['donor_id'][$i])."'
												AND ( (id_month BETWEEN '".cleanvars($_POST['from_month'])."' AND '".cleanvars($_POST['to_month'])."')
												OR (to_month BETWEEN '".cleanvars($_POST['from_month'])."' AND '".cleanvars($_POST['to_month'])."') )
												AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
												AND is_deleted != '1' AND id_type = '3'
											");	
			if(mysqli_num_rows($sqllmscheck) == 0) {
				
				// Challan Number
				do {
					$challano = '9930'.$challandate.mt_rand(10000,99999);
					$sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
					$sqlCheck	= $dblms->querylms($sqlChallan);
				} while (mysqli_num_rows($sqlCheck) > 0);

				// Make Challan
				$sqllmsDonation = $dblms->querylms("INSERT INTO ".FEES."(
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
																	id_campus 					,
																	id_added					,
																	date_added
																)
															VALUES(
																	'2'																,
																	'3'																,
																	'".cleanvars($challano)."'										,
																	'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	, 
																	'".cleanvars($_POST['from_month'])."'							,
																	'".cleanvars($_POST['to_month'])."'								,
																	'".cleanvars($sendMsg)."'										,
																	'".cleanvars($_POST['donor_id'][$i])."'							,
																	'".cleanvars($issue_date)."'									, 
																	'".cleanvars($due_date)."'										,
																	'".cleanvars($_POST['total_amount'][$i])."'						,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
																	Now()	
																)");

				// Donation Students Detail
				if($sqllmsDonation) { 
					// Get latest ID
					$idsetup = $dblms->lastestid();	

					$sqllmsStudents	= $dblms->querylms("SELECT d.id_std, d.amount, d.duration
											FROM ".STUDENTS." s
											INNER JOIN ".DONATIONS_STUDENTS." d ON d.id_std = s.std_id
											WHERE d.status = '1' AND d.is_deleted != '1' 
											AND d.id_donor = '".$_POST['donor_id'][$i]."' ORDER BY s.std_name");
					while($valueStudents = mysqli_fetch_array($sqllmsStudents)) {
						
						$sqllmsDetails = $dblms->querylms("INSERT INTO ".DONATION_DETAILS."(
																id_donation ,
																id_std		,
																amount				
															) VALUES(
																'".cleanvars($idsetup)."'									,
																'".cleanvars($valueStudents['id_std'])."'					,
																'".cleanvars($valueStudents['amount'] * $_POST['months'])."'				
															)");
					}

					// Make Log
					$remarks = 'Donation Challan Created ID# '.$idsetup.'';
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
					if(isset($_POST['sendMessage'])) {
						
						if($_POST['months'] > 1) {
							$msgMonth = 'from Month '.get_monthtypes(ltrim(cleanvars($_POST['from_month'], "0"))).' to '.get_monthtypes(ltrim(cleanvars($_POST['to_month'], "0"))).'';
						} else {
							$msgMonth = 'for Month '.get_monthtypes(ltrim(cleanvars($_POST['from_month'], "0"))).'';
						}

						// Send Message
						$phone = str_replace("-","",$_POST['donor_phone'][$i]);
						$message = 'Dear '.$_POST['donor_name'][$i].','.PHP_EOL.''.PHP_EOL.'Just a soft reminder, your blessed Sponsor Child Donation Challan #'.cleanvars($challano).' '.$msgMonth.' of Rs.'.number_format(cleanvars($_POST['total_amount'][$i])).' bearing due date '.date('d-m-Y', strtotime($due_date)).' is generated.'.PHP_EOL.'Kindly do the needful to pay your donation through Finja (IBFT) by entering your Challan number through the mobile banking App.'.PHP_EOL.''.PHP_EOL.'Or Click to pay via Credit/Debit Card.'.PHP_EOL.'https://aghosh.gptech.pk/payProPayment.php?challan_no='.$challano.''.PHP_EOL.''.PHP_EOL.'Thanks,'.PHP_EOL.'AGHOSH COMPLEX';
						sendMessage($phone, $message);

					}
				}

				$genratedChallans ++;
			} else {
				continue;
			}
		}
	}
	// Messgae
	if($genratedChallans > 0) {
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: donationChallans.php", true, 301);
		exit();
	} else {
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'No Challan Generated.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: donationChallans.php", true, 301);
		exit();
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