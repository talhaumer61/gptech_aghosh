<?php 
// ADD ADMISSION INQUIRY
if(isset($_POST['submit_inquiry'])) {	
	// GET NEW FORM Number
	$sqllmscampus  = $dblms->querylms("SELECT campus_code
										FROM ".CAMPUS." 
										WHERE campus_status = '1' 
										AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										LIMIT 1
									");
	$value_campus = mysqli_fetch_array($sqllmscampus);

	$sqllms	= $dblms->querylms("SELECT MAX(id) as form
									FROM ".ADMISSIONS_INQUIRY." 
									WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ");
	$rowsvalues = mysqli_fetch_array($sqllms);
	$form_no = $value_campus['campus_code'].'-'.($rowsvalues['form'] + 1);
	
	$sqllmscheck  = $dblms->querylms("SELECT form_no, id_class
										FROM ".ADMISSIONS_INQUIRY." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND form_no = '".cleanvars($form_no)."' 
										LIMIT 1
									");
	if(mysqli_num_rows($sqllmscheck)) {
		// if(false) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: admission_inquiry.php", true, 301);
		exit();
	} else {  
		// DATE CONVERSION
		$dated = date('Y-m-d');
		$dob = date('Y-m-d' , strtotime(cleanvars($_POST['dob'])));

		// ADD INQUIRY
		$sqllms  = $dblms->querylms("INSERT INTO ".ADMISSIONS_INQUIRY."(
															status							, 
															form_no							,
															name							,
															fathername						,
															gender							,
															cell_no							, 
															cnicno							, 
															emailaddress					, 
															address							,    
															dated							, 
															source							,  
															note							, 
															id_previousclass				, 
															school							,   
															id_class						,
															id_session						,
															is_orphan						,  
															is_hostelized					,
															id_campus 						,
															id_added 						,
															date_added				
														)
													VALUES(
															'".cleanvars($_POST['status'])."'							,	 
															'".cleanvars($form_no)."'							,	 
															'".cleanvars($_POST['name'])."'								,
															'".cleanvars($_POST['fathername'])."'						,
															'".cleanvars($_POST['gender'])."'							,
															'".cleanvars($_POST['cell_no'])."'							,
															'".cleanvars($_POST['cnicno'])."'							,
															'".cleanvars($_POST['emailaddress'])."'						,
															'".cleanvars($_POST['address'])."'							,
															'".cleanvars($dated)."'										,
															'1'															,
															'".cleanvars($_POST['note'])."'								,
															'".cleanvars($_POST['id_previousclass'])."'					,
															'".cleanvars($_POST['school'])."'							,
															'".cleanvars($_POST['id_class'])."'							,
															'".cleanvars($_POST['id_session'])."'							,
															'".cleanvars($_POST['is_orphan'])."'						,
															'".cleanvars($_POST['is_hostelized'])."'					,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'		,
															NOW()
														)"
								);
		if($sqllms) { 

			// GENERATE CHALLAN
			if($_POST['is_orphan'] != '1' && $_POST['genrateChallan'] == '1'){

				// GET FEE STRUCTURE 
			
				// FOR HOSTELIZED
				if($_POST['is_hostelized'] == 1){
					$sql2 = "";
				} else {		
					$sql2 = "AND d.id_cat NOT IN(6,7,8)";
				}
				$sqllmsfeesetup	= $dblms->querylms("SELECT f.id, d.id_cat, d.amount
														FROM ".FEESETUP." f 
														INNER JOIN ".FEESETUPDETAIL." d ON d.id_setup = f.id 	
														WHERE f.status 		= '1'
														AND f.id_class 		= '".cleanvars($_POST['id_class'])."' $sql2
														AND f.id_session 	= '".cleanvars($_POST['id_session'])."'
														AND f.id_campus 	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
														AND f.is_deleted 	!= '1'
														ORDER BY f.id DESC
													");
				$totalAmount = 0;
				while($value_feesetup = mysqli_fetch_array($sqllmsfeesetup)){
			
					$totalAmount = $totalAmount + $value_feesetup['amount'];
					$feeDetail[] = array('id_cat'=>$value_feesetup['id_cat'], 'amount'=>$value_feesetup['amount']);
			
				}
			
				// Make Challans
				$challandate= substr(date('Y'),2,4);
				$issue_date	= date('Y-m-d');
				$due_date 	= date('Y-m-d' , strtotime($issue_date. ' + 15 days'));
				$yearmonth 	= date('Y-m', strtotime(cleanvars($_POST['yearmonth'])));
				$year 		= date('y', strtotime(cleanvars($_POST['yearmonth'])));
				$idmonth 	= date('n', strtotime(cleanvars($_POST['yearmonth'])));
				
				// challan no
				do {
					$challano = '9930'.$year.mt_rand(10000,99999);
					$sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
					$sqlCheck	= $dblms->querylms($sqlChallan);
				} while (mysqli_num_rows($sqlCheck) > 0);

				// Chllans
				$sqllmsFee  = $dblms->querylms("INSERT INTO ".FEES."(
																	status						, 
																	id_type 					,
																	challan_no					, 
																	id_session					, 
																	id_class					, 
																	inquiry_formno				,
																	id_month					,
																	yearmonth					,
																	issue_date					,
																	due_date					,
																	total_amount				,
																	id_campus 					,
																	id_added					,
																	date_added
																)
															VALUES(
																	'2'																,
																	'1'																,
																	'".cleanvars($challano)."'										,
																	'".cleanvars($_POST['id_session'])."'	, 
																	'".cleanvars($_POST['id_class'])."'								,
																	'".cleanvars($form_no)."'								,
																	'".cleanvars($idmonth)."'										,
																	'".cleanvars($yearmonth)."'										,
																	'".cleanvars($issue_date)."'									, 
																	'".cleanvars($due_date)."'										,
																	'".cleanvars($totalAmount)."'									,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
																	Now()	
																)");
			
				// Chllans Details
				if($sqllmsFee) { 
					// Get latest ID
					$challan_id = $dblms->lastestid();
		
					foreach($feeDetail as $det){
						if($det['amount'] > 0) {
							$sqllms  = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																			id_fee			,
																			id_cat			,
																			amount						
																		)
																	VALUES(
																			'".cleanvars($challan_id)."'			,
																			'".cleanvars($det['id_cat'])."'			,
																			'".cleanvars($det['amount'])."'			
																		)");
						}
					}
					// Make Log
					$remarks = 'Admission Challan genrate at the inquiry.';
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
																		'".cleanvars($challano)."'									,
																		NOW()																,
																		'".cleanvars($ip)."'												,
																		'".cleanvars($remarks)."'											,
																		'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
																	)");
									
					
					//Send Message				
					$phone = str_replace("-","",$_POST['cell_no']);
					$message = 'Dear Parents,'.PHP_EOL.''.PHP_EOL.'Your child admission challan # '.cleanvars($challano).'  of amount '.number_format($totalAmount).' with due date '.date('d-m-Y' , strtotime(cleanvars($due_date))).' has been issued.'.PHP_EOL.''.PHP_EOL.'Thanks,'.PHP_EOL.'Aghosh Grammar School';
					sendMessage($phone, $message);
				}

				// Redirection
				$headerLoc = 'feechallanprint.php?id='.$challano;
				// Remakrs For Log
				$remarks = 'Add Admission Inquiry Form #"'.cleanvars($_POST['form_no']).'", with Challan.';

			} else {
				// Redirection
				$headerLoc = 'admission_inquiry.php';
				// Remakrs For Log
				$remarks = 'Add Admission Inquiry Form #"'.cleanvars($_POST['form_no']).'"';
			}

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
																'1'																, 
																NOW()															,
																'".cleanvars($ip)."'											,
																'".cleanvars($remarks)."'										,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: $headerLoc", true, 301);
			exit();
		}
	}
} 

// Inquiry update reocrd
if(isset($_POST['changes_inquiry'])) { 
	$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
	$dob = date('Y-m-d' , strtotime(cleanvars($_POST['dob'])));
	//Update
	$sqllms  = $dblms->querylms("UPDATE ".ADMISSIONS_INQUIRY." SET  
													  status			= '".cleanvars($_POST['status'])."'
													, name				= '".cleanvars($_POST['name'])."' 
													, fathername		= '".cleanvars($_POST['fathername'])."' 
													, gender			= '".cleanvars($_POST['gender'])."' 
													, dob				= '".cleanvars($dob)."' 
													, nic				= '".cleanvars($_POST['nic'])."' 
													, guardian			= '".cleanvars($_POST['guardian'])."' 
													, cell_no			= '".cleanvars($_POST['cell_no'])."' 
													, cnicno			= '".cleanvars($_POST['cnicno'])."' 
													, emailaddress		= '".cleanvars($_POST['emailaddress'])."' 
													, address			= '".cleanvars($_POST['address'])."' 
													, dated				= '".cleanvars($dated)."' 
													, source			= '".cleanvars($_POST['source'])."' 
													, note				= '".cleanvars($_POST['note'])."'
													, id_previousclass	= '".cleanvars($_POST['id_previousclass'])."'
													, school			= '".cleanvars($_POST['school'])."'
													, id_class			= '".cleanvars($_POST['id_class'])."'  
													, id_session		= '".cleanvars($_POST['id_session'])."'  
													, is_orphan			= '".cleanvars($_POST['is_orphan'])."'
													, is_hostelized		= '".cleanvars($_POST['is_hostelized'])."'
													, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
													, date_modify		= NOW() 
												WHERE id				= '".cleanvars($_POST['id'])."'");
	if($sqllms) { 
		$remarks = 'Update Admission Inquiry ID #"'.cleanvars($_POST['id']).'"';
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
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: admission_inquiry.php", true, 301);
		exit();
	}
}

// Delete Reocrd
if(isset($_GET['deleteid'])) { 
	$sqllms  = $dblms->querylms("UPDATE ".ADMISSIONS_INQUIRY." SET  
														  is_deleted			= '1'
														, id_deleted			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, ip_deleted			= '".$ip."'
														, date_deleted			= NOW()
													 WHERE id 			= '".cleanvars($_GET['deleteid'])."'");
	if($sqllms) { 
		$remarks = 'Admission Inquiry Deleted ID: "'.cleanvars($_GET['id']).'" details';
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
															'3'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)
									");
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: admission_inquiry.php", true, 301);
		exit();
	}
}
?>