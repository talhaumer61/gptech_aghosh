<?php 
	require_once ("../include/dbsetting/lms_vars_config.php");
	require_once ("../include/dbsetting/classdbconection.php");
	require_once ("../include/functions/send_message.php");
	require_once ("functions/functions.php");
	// include_once '../PHPMailer/PHPMailerAutoload.php';
	$dblms = new dblms();
 	date_default_timezone_set("Asia/Karachi");

	if(isset($_POST)){ 
		$data_arr = json_decode(file_get_contents('php://input'), true);

		if($data_arr['method']=="getChallanInfo"){
			
			$customercode = '';
			$requestedvars = "\n";
			$requestedvars .= 'User Name: '.$data_arr['username']."\n";
			$requestedvars .= 'User Pass: '.$data_arr['password']."\n";
			$requestedvars .= 'Token: '.$data_arr['token']."\n";
			$requestedvars .= 'challanNumber: '.$data_arr['challanNumber']."\n";

			if($data_arr['username'] == ''){

				$api_id 	 = '';
				$status 	 = 2;
				$response 	 = '094';
				
				$output		 = '<challanInfo>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanInfo>';
				
				header('Content-Type: application/xml');
				print ($output);
				
		
			}elseif($data_arr['password'] == ''){
		
				$api_id 	 = '';
				$status 	 = 3;
				$response 	 = '094';
							
				$output		 = '<challanInfo>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanInfo>';
				
				header('Content-Type: application/xml');
				print ($output);
				
		
			}elseif($data_arr['token'] == ''){
		
				$api_id 	 = '';
				$status 	 = 4;
				$response 	 = '093';
					
				$output		 = '<challanInfo>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanInfo>';
				
				header('Content-Type: application/xml');
				print ($output);
		
			}elseif($data_arr['challanNumber'] == ''){
		
				$api_id 	 = '';
				$status 	 = 6;
				$response 	 = '091';
		
				$output		 = '<challanInfo>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanInfo>';
				
				header('Content-Type: application/xml');
				print ($output);
		
			}else{
				//----------Checking Username, Password from DB ----------
				$sqllmsuser	= $dblms->querylms("SELECT * 
													FROM ".PAY_API."
													WHERE api_status	= '1' AND api_username = '".cleanvars($data_arr['username'])."' 
													AND api_password	= '".cleanvars($data_arr['password'])."' 
													AND api_signature	= '".cleanvars($data_arr['token'])."' 
													AND api_id			= '1'
													 LIMIT 1");
				//--------------------------------------------------------
				if(mysqli_num_rows($sqllmsuser) == 1){
					//Fetch Query Data
					$rowuser = mysqli_fetch_array($sqllmsuser);
					$jsonObj = array();	

					//-----------------------------------------------------
					$sqllmschallan	= $dblms->querylms("SELECT f.status, f.id_type, f.challan_no, f.due_date, f.total_amount, f.paid_amount, f.id_std, f.id_campus, f.id_month, 
																cls.class_name, cm.campus_customercode, std.std_name, std.std_regno,
																std.std_id, std.std_rollno, q.name, q.form_no, don.donor_name
																FROM ".FEES." f
																LEFT JOIN ".CLASSES."  cls ON cls.class_id 	= f.id_class 
																LEFT JOIN ".STUDENTS." std ON std.std_id 	= f.id_std 
																LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no	= f.inquiry_formno 
																LEFT JOIN ".DONORS."   don ON don.donor_id 	= f.id_donor
																INNER JOIN ".CAMPUS."  cm  ON cm.campus_id 	= f.id_campus  
																WHERE f.challan_no = '".cleanvars($data_arr['challanNumber'])."' 
																AND f.is_deleted != '1'
																LIMIT 1");
					//----------Check if given Challan Number Match----------
					if(mysqli_num_rows($sqllmschallan) == 1){
						//Fetch Query Data
						$rowchallan = mysqli_fetch_array($sqllmschallan);

						// CHECK CHALLAN TYPE(ADMISSION, DONATION, FEE)
						if($rowchallan['id_type'] == 2){
							// FETCH LATEST CHALLAN
							$sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
													FROM ".FEES." f						 
													INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
													WHERE f.id_type		= '2'
													AND f.is_deleted	= '0'
													AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
													AND st.is_deleted	= '0'
													ORDER BY f.id DESC LIMIT 1");
							$valuesqllmscheck = mysqli_fetch_array($sqllmscheck);
							// FETCH LATEST CHALLAN END
						}else{
							$valuesqllmscheck['challan_no'] = $rowchallan['challan_no'];
						}
						
						$customercode = $rowchallan['campus_customercode'];
						
						//Check Type of Challan
						if($rowchallan['id_type'] == 3){

							// If Donation Challan
							
							$name = $rowchallan['donor_name'];
							$class = "Null";
							$regno = "Null";
							$rollno = "Null";

						}elseif($rowchallan['id_type'] == 2){

							// If Fee Challan

							$name = $rowchallan['std_name'];
							$class = $rowchallan['class_name'];

							if($rowchallan['std_regno']){
								$regno = $rowchallan['std_regno'];
							}else{
								$regno = "Null";
							}
							if($rowchallan['std_rollno']){ 	
								$rollno = $rowchallan['std_rollno'];
							}else{
								$rollno = "Null";
							}
						}else{
							
							// If Admission Challan
							if($rowchallan['std_name']) {
								$name = $rowchallan['std_name'];
							} else {
								$name = $rowchallan['name'];
							}
							if($rowchallan['std_regno']){
								$regno = $rowchallan['std_regno'];
								
							} else if($rowchallan['form_no']) {
								$regno = $rowchallan['form_no'];
							} else {
								$regno = "Null";
							}	
							
							
							$class = $rowchallan['class_name'];
							$rollno = "Null";
						}

						//Grand Total with Previous Month
						$grandTotal = 0;
						foreach($monthtypes as $month):
							if($rowchallan['id_month']==$month['id']){

								$amount = $rowchallan['total_amount'] - $rowchallan['paid_amount'];

							}else{
								$sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.challan_no, f.id_std,
																	f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																	FROM ".FEES." f
																	WHERE f.id_month	= '".cleanvars($month['id'])."'
																	AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
																	AND (f.status = '2' OR f.status = '4')
																	AND f.id_type		= '2'
																	AND f.is_deleted	= '0' LIMIT 1");
								if(mysqli_num_rows($sqlnarration)>0){
									$valnarration = mysqli_fetch_array($sqlnarration);

									$amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

									if($valnarration['due_date'] < date('Y-m-d')){
										$amount = $amount + LATEFEE;
									}
								}else{
									$amount = 0;
								}
							}
							$grandTotal = $grandTotal + $amount;
						endforeach;

						// if($feercord['due_date']<date('Y-m-d')){
						// 	$fine = 300;
						// }
						// $grandTotal = $grandTotal + $fine;

						$refrence 	= 'Null';
						$duedate 	= date('Ymd', strtotime(cleanvars($rowchallan['due_date'])));
						$lastdate	= date ("Y-m-d", strtotime("+15 day", strtotime($rowchallan['due_date'])));

						if($valuesqllmscheck['challan_no'] != $rowchallan['challan_no']){
							$status 	= 16;
							$response 	 = '098';
							
							$output		 = '<challanInfo>'."\n";
							$output 	.= "\t".'<status>Failed</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
							$output		.= '</challanInfo>';

							header('Content-Type: application/xml');
							print ($output);
						}elseif($rowchallan['status'] == '1' && $valuesqllmscheck['challan_no'] == $rowchallan['challan_no']){

							$status 	= 15;
							$response 	 = '097';
							
							$output		= '<challanInfo>'."\n";
							$output 	.= "\t".'<status>Success</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
							$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
							$output 	.= "\t".'<dueDate>'.$duedate.'</dueDate>'."\n";
							$output 	.= "\t".'<totalPayable>'.($grandTotal + BANKCHARGES).'</totalPayable>'."\n";
							$output 	.= "\t".'<latePayment>'.strval(($grandTotal + 300 + BANKCHARGES)).'</latePayment>'."\n";
							$output 	.= "\t".'<studentRegNo>'.$regno.'</studentRegNo>'."\n";
							$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
							$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
							$output 	.= "\t".'<studentRollNo>'.$rollno.'</studentRollNo>'."\n";
							$output 	.= "\t".'<referenceNumber>'.$refrence.'</referenceNumber>'."\n";
							$output 	.= "\t".'<customerCode>'.$rowchallan['campus_customercode'].'</customerCode>'."\n";
							$output 	.= "\t".'<remarks></remarks>'."\n";
							$output		.= '</challanInfo>';

							header('Content-Type: application/xml');
							print ($output);

						}elseif($rowchallan['status'] != '1' && ($rowchallan['status'] == '2' || $rowchallan['status'] == '4')  && $valuesqllmscheck['challan_no'] == $rowchallan['challan_no']){

							// $sqllmstranamoount	= $dblms->querylms("SELECT SUM(trans_amount) AS totaltransamount  
							// 							FROM ".PAY_API_TRAN." 
							// 							WHERE challan_no = '".cleanvars($rowchallan['challan_no'])."'");
							// $rowtransamount = mysqli_fetch_array($sqllmstranamoount);
							
							// if($rowchallan['due_date']<date("Y-m-d")) {
							// 	$duedateamount = strval(($grandTotal + 300 + BANKCHARGES) - $rowtransamount['totaltransamount']);
							// } else {
							// 	$duedateamount = (($grandTotal + BANKCHARGES) - $rowtransamount['totaltransamount']);
							// }

							if($rowchallan['due_date']<date("Y-m-d")){
								$grandTotal = strval($grandTotal + LATEFEE + BANKCHARGES);
							}else{
								$grandTotal = strval($grandTotal + BANKCHARGES);
							}

							$status 	= 13;
							$response 	= '00';
							
							$output		= '<challanInfo>'."\n";
							$output 	.= "\t".'<status>Success</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
							$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
							$output 	.= "\t".'<dueDate>'.$duedate.'</dueDate>'."\n";
							$output 	.= "\t".'<totalPayable>'.($grandTotal + BANKCHARGES).'</totalPayable>'."\n";
							$output 	.= "\t".'<latePayment>'.strval(($grandTotal + LATEFEE + BANKCHARGES)).'</latePayment>'."\n";
							$output 	.= "\t".'<studentRegNo>'.$regno.'</studentRegNo>'."\n";
							$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
							$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
							$output 	.= "\t".'<studentRollNo>'.$rollno.'</studentRollNo>'."\n";
							$output 	.= "\t".'<referenceNumber>'.$refrence.'</referenceNumber>'."\n";
							$output 	.= "\t".'<customerCode>'.$rowchallan['campus_customercode'].'</customerCode>'."\n";
							$output 	.= "\t".'<remarks></remarks>'."\n";
							$output		.= '</challanInfo>';

							header('Content-Type: application/xml');
							print ($output);

						}
						// elseif($lastdate<date("Y-m-d")){

						// 	$status 	= 16;
						// 	$response 	 = '092';
							
						// 	$output		 = '<challanInfo>'."\n";
						// 	$output 	.= "\t".'<status>Failed</status>'."\n";
						// 	$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
						// 	$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
						// 	$output		.= '</challanInfo>';

						// 	header('Content-Type: application/xml');
						// 	print ($output);
						// }
					}else{
						$status 	= 14;
						$response 	 = '091';
						
						$output		 = '<challanInfo>'."\n";
						$output 	.= "\t".'<status>Success</status>'."\n";
						$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
						$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
						$output		.= '</challanInfo>';

						header('Content-Type: application/xml');
						print ($output);
					}
				}else{
					$api_id 	 = '';
					$status 	= 12;
					$response 	 = '094';

					$output		 = '<challanInfo>'."\n";
					$output 	.= "\t".'<status>Failed</status>'."\n";
					$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
					$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
					$output		.= '</challanInfo>';

					header('Content-Type: application/xml');
					print ($output);
				}
			}
		
			if(isset($rowuser['api_id'])){
				$api_id = $rowuser['api_id'];
			} else{
				$api_id = '';
			}
		
			//------------------Insert Data into Log Table------------------
			$sqllmsinsert  = $dblms->querylms("INSERT INTO ".PAY_API_LOG." (
																			  id_api
																			, customer_code
																			, branch_code
																			, challan_no
																			, refrence_no
																			, status
																			, date_added
																			, requests
																			, ip	
																		)
																		VALUES(
																			  '".$api_id."'
																			, '".cleanvars($customercode)."'
																			, '".cleanvars($data_arr['branchCode'])."'
																			, '".cleanvars($data_arr['challanNumber'])."'
																			, 'Null'
																			, '".$status."'
																			, NOW()
																			, '".$output.$requestedvars."'
																			, '".$ip."'
																		)
											");
			//----------------Insert Data into Log Table end----------------

		}elseif($data_arr['method']=="challanPayment"){
			
			$customercode = '';
			$requestedvars = "\n";
			$requestedvars .= 'User Name: '.$data_arr['username']."\n";
			$requestedvars .= 'User Pass: '.$data_arr['password']."\n";
			$requestedvars .= 'Token: '.$data_arr['token']."\n";
			$requestedvars .= 'challanNumber: '.$data_arr['challanNumber']."\n";
			$requestedvars .= 'referenceNumber: '.$data_arr['referenceNumber']."\n";
			$requestedvars .= 'branchCode: '.$data_arr['branchCode']."\n";
			$requestedvars .= 'transId: '.$data_arr['transId']."\n";
			$requestedvars .= 'transAmount: '.$data_arr['transAmount']."\n";
			$requestedvars .= 'transCurrency: '.$data_arr['transCurrency']."\n";
			$requestedvars .= 'transDate: '.$data_arr['transDate']."\n";

			if($data_arr['username'] == ''){

				$api_id 	 = '';
				$status 	 = 2;
				$response 	 = '094';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);
		
			}elseif($data_arr['password'] == ''){
		
				$api_id 	 = '';
				$status 	 = 3;
				$response 	 = '094';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);
		
			}elseif($data_arr['token'] == ''){
		
				$api_id 	 = '';
				$status 	 = 4;
				$response 	 = '093';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);
		

			}elseif($data_arr['branchCode'] == ''){
		
				$api_id 	 = '';
				$status 	 = 5;
				$response 	 = '094';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);
		
			}elseif($data_arr['challanNumber'] == ''){
		
				$api_id 	 = '';
				$status 	 = 6;
				$response 	 = '091';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);

			}elseif($data_arr['referenceNumber'] == '' || (strlen($data_arr['referenceNumber']) != 6)){
		
				$api_id 	 = '';
				$status 	 = 7;
				$response 	 = '096';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);

			}elseif($data_arr['transId'] == ''){
		
				$api_id 	 = '';
				$status 	 = 8;
				$response 	 = '096';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);

			}elseif($data_arr['transAmount'] == ''){
		
				$api_id 	 = '';
				$status 	 = 9;
				$response 	 = '096';
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);

			}elseif($data_arr['transCurrency'] == ''){
		
				$api_id 	 = '';
				$status 	 = 10;
				$response 	 = '096';
				
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);

			}elseif($data_arr['transDate'] == '' || (strlen($data_arr['transDate']) != 8)){
		
				$api_id 	 = '';
				$status 	 = 11;
				$response 	 = '096';
		
				$output		 = '<challanPayment>'."\n";
				$output 	.= "\t".'<status>Failed</status>'."\n";
				$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
				$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
				$output		.= '</challanPayment>';

				header('Content-Type: application/xml');
				print ($output);
		
			}else{
		
				//----------Checking Username, Password from DB ----------
				$sqllmsuser	= $dblms->querylms("SELECT * 
													FROM ".PAY_API."
													WHERE api_status	= '1' AND api_username = '".cleanvars($data_arr['username'])."' 
													AND api_password	= '".cleanvars($data_arr['password'])."' 
													AND api_signature	= '".cleanvars($data_arr['token'])."' 
													AND api_id			= '1'
													LIMIT 1");
				//--------------------------------------------------------
				if(mysqli_num_rows($sqllmsuser) == 1){
					//Fetch Query Data
					$rowuser = mysqli_fetch_array($sqllmsuser);
					$jsonObj = array();	

					//-----------------------------------------------------
					$sqllmschallan	= $dblms->querylms("SELECT f.status, f.id_type, f.challan_no, f.id_std, f.due_date, f.paid_date, f.total_amount, f.paid_amount, f.id_campus, f.id_month,  
															cls.class_name, cm.campus_customercode, std.std_name, std.std_regno, std.std_phone,
															std.std_rollno, q.name, q.form_no, q.cell_no, don.donor_name, donor_phone
															FROM ".FEES." f
															LEFT JOIN ".CLASSES."  cls ON cls.class_id 	= f.id_class 
															LEFT JOIN ".STUDENTS." std ON std.std_id 	= f.id_std 
															LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no	= f.inquiry_formno 
															LEFT JOIN ".DONORS."   don ON don.donor_id 	= f.id_donor
															INNER JOIN ".CAMPUS." cm ON cm.campus_id = f.id_campus  
															WHERE f.challan_no	= '".cleanvars($data_arr['challanNumber'])."' 
															AND f.is_deleted	= '0'  LIMIT 1");
					//----------Check if given Challan Number Match----------
					if(mysqli_num_rows($sqllmschallan) == 1){
						//Fetch Query Data
						$rowchallan = mysqli_fetch_array($sqllmschallan);

						// CHECK CHALLAN TYPE(ADMISSION, DONATION, FEE)
						if($rowchallan['id_type'] == 2){
							// FETCH LATEST CHALLAN
							$sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
													FROM ".FEES." f						 
													INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
													WHERE f.id_type		= '2'
													AND f.is_deleted	= '0'
													AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
													AND st.is_deleted	= '0'
													ORDER BY f.id DESC LIMIT 1");
							$valuesqllmscheck = mysqli_fetch_array($sqllmscheck);
							// FETCH LATEST CHALLAN END
						}else{
							$valuesqllmscheck['challan_no'] = $rowchallan['challan_no'];
						}
						
						$customercode = $rowchallan['campus_customercode'];

						//Check Type of Challan
						if($rowchallan['id_type'] == 3) {
							// If Donation Challan
							$name = $rowchallan['donor_name'];
							$phone = str_replace("-","",$rowchallan['donor_phone']);
							$message = 'Dear '.$name.',\n\nYour donation challan # '.cleanvars($rowchallan['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
							$class = "Null";
							$regno = "Null";
							$rollno = "Null";

						}elseif($rowchallan['id_type'] == 2){
							// If Fee Challan
							$name = $rowchallan['std_name'];
							$phone = str_replace("-","",$rowchallan['std_phone']);
							$message = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($rowchallan['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
							$class = $rowchallan['class_name'];

							if($rowchallan['std_regno']) { 
								$regno = $rowchallan['std_regno'];
							}else{
								$regno = "Null";	
							}
							
							if($rowchallan['std_rollno']){
								$rollno = $rowchallan['std_rollno'];
							}else{
								$rollno = "Null";
							}

						}else{
							// If Admission Challan
							$name = $rowchallan['name'];
							$phone = str_replace("-","",$rowchallan['cell_no']);
							$message = 'Dear Parents,\n\nYour child admission challan # '.cleanvars($rowchallan['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
							$class = $rowchallan['class_name'];
							$regno = $rowchallan['form_no'];
							$rollno = "Null";

						}

						//Grand Total with Previous Month
						$grandTotal = 0;
						foreach($monthtypes as $month):
							if($rowchallan['id_month']==$month['id']){

								$amount = $rowchallan['total_amount'] - $rowchallan['paid_amount'];

							}else{
								$sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.challan_no, f.id_std,
																	f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																	FROM ".FEES." f
																	WHERE f.id_month	= '".cleanvars($month['id'])."'
																	AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
																	AND (f.status = '2' OR f.status = '4')
																	AND f.id_type		= '2'
																	AND f.is_deleted	= '0' LIMIT 1");
								if(mysqli_num_rows($sqlnarration)>0){
									$valnarration = mysqli_fetch_array($sqlnarration);

									$amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

									if($valnarration['due_date'] < date('Y-m-d')){
										$amount = $amount + LATEFEE;
									}
								}else{
									$amount = 0;
								}
							}
							$grandTotal = $grandTotal + $amount;
						endforeach;
						
						$transamount = ($data_arr['transAmount']/100);
						//$transamount = $data_arr['transAmount'];

						$lastdate	= date ("Y-m-d", strtotime("+15 day", strtotime($rowchallan['due_date'])));

						if($rowchallan['due_date'] >= date("Y-m-d")){
							$dueamount = ($grandTotal + BANKCHARGES);
						}else{
							$dueamount = ($grandTotal + LATEFEE + BANKCHARGES);
						}

						if($rowchallan['status'] == '2' && $valuesqllmscheck['challan_no'] != $rowchallan['challan_no']){

							$status 	= 16;
							$paystatus 	= 4;
							$response 	= '098';

							$output		= '<challanPayment>'."\n";
							$output 	.= "\t".'<status>Failed</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
							$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
							$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
							$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
							$output 	.= "\t".'<studentFee>'.$dueamount.'</studentFee>'."\n";
							$output 	.= "\t".'<referenceNumber>'.$data_arr['referenceNumber'].'</referenceNumber>'."\n";
							$output 	.= "\t".'<customerCode>'.$customercode.'</customerCode>'."\n";
							$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
							$output 	.= "\t".'<remarks></remarks>'."\n";
							$output		.= '</challanPayment>';

						}elseif($rowchallan['status'] == '1' && $rowchallan['paid_date'] != '0000-00-00'){

							$status 	= 15;
							$paystatus 	= 4;
							$response 	= '097';

							$output		= '<challanPayment>'."\n";
							$output 	.= "\t".'<status>Failed</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
							$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
							$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
							$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
							$output 	.= "\t".'<studentFee>'.$dueamount.'</studentFee>'."\n";
							$output 	.= "\t".'<referenceNumber>'.$data_arr['referenceNumber'].'</referenceNumber>'."\n";
							$output 	.= "\t".'<customerCode>'.$customercode.'</customerCode>'."\n";
							$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
							$output 	.= "\t".'<remarks></remarks>'."\n";
							$output		.= '</challanPayment>';


						}elseif(($rowchallan['status'] == '2' && $rowchallan['status'] == '4') && ($dueamount != $transamount) && ($rowuser['api_allowpartial'] != 1)){

							$status 	= 17;
							$paystatus 	= 4;
							$response 	= '096';

							$output		= '<challanPayment>'."\n";
							$output 	.= "\t".'<status>Failed</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).' (Transaction Amount not correct)</responseDescription>'."\n";
							$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
							$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
							$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
							$output 	.= "\t".'<studentFee>'.$dueamount.'</studentFee>'."\n";
							$output 	.= "\t".'<referenceNumber>'.$data_arr['referenceNumber'].'</referenceNumber>'."\n";
							$output 	.= "\t".'<customerCode>'.$customercode.'</customerCode>'."\n";
							$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
							$output 	.= "\t".'<remarks></remarks>'."\n";
							$output		.= '</challanPayment>';


						}elseif($rowchallan['status'] != '1' && $valuesqllmscheck['challan_no'] == $rowchallan['challan_no']){

							$totalrecived = 0; 
							
							$sqllmstranamntcheck = $dblms->querylms("SELECT trans_amount  
																	FROM ".PAY_API_TRAN." 
																	WHERE challan_no	= '".cleanvars($rowchallan['challan_no'])."'
																	AND trans_id		= '".cleanvars($data_arr['transId'])."'
																	AND refrence_no		= '".cleanvars($data_arr['referenceNumber'])."'
																");
							$rowtransamtcheck = mysqli_fetch_array($sqllmstranamntcheck);

							$totalrecived = $rowtransamtcheck['trans_amount'];
							
							if($totalrecived >= $dueamount){
							
								$status 	= 17;
								$response 	= '096';
								$paystatus 	= 4;
								
								$output		= '<challanPayment>'."\n";
								$output 	.= "\t".'<status>Failed147</status>'."\n";
								$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
								$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
								$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
								$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
								$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
								$output 	.= "\t".'<studentFee>'.$transamount.'</studentFee>'."\n";
								$output 	.= "\t".'<referenceNumber>'.$data_arr['referenceNumber'].'</referenceNumber>'."\n";
								$output 	.= "\t".'<customerCode>'.$customercode.'</customerCode>'."\n";
								$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
								$output 	.= "\t".'<remarks></remarks>'."\n";
								$output		.= '</challanPayment>';
							
							}else{
							
								//------------------- Add API Trans ----------------------
								$sqllmstrans  = $dblms->querylms("INSERT INTO ".PAY_API_TRAN." (
																		  status
																		, id_api
																		, customer_code
																		, branch_code
																		, challan_no
																		, refrence_no
																		, trans_id
																		, trans_amount
																		, trans_currency
																		, trans_date
																		, date_added
																		, ip	
																	)
															VALUES (
																		  '1'
																		, '".$rowuser['api_id']."'
																		, '".cleanvars($customercode)."'
																		, '".cleanvars($data_arr['branchCode'])."'
																		, '".cleanvars($data_arr['challanNumber'])."'
																		, '".cleanvars($data_arr['referenceNumber'])."'
																		, '".cleanvars($data_arr['transId'])."'
																		, '".cleanvars($transamount)."'
																		, '".cleanvars($data_arr['transCurrency'])."'
																		, '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																		, NOW()
																		, '".$ip."'
																	)
													");
	
								//------------------- Add Income ----------------------
								$incomeRemarks = 'Fee Pay Through Finja';								
								$sqllmsIncome = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																					  trans_status 
																					, trans_title
																					, trans_type
																					, trans_amount
																					, voucher_no
																					, trans_method
																					, trans_note
																					, dated
																					, id_head
																					, id_campus  
																					, date_added 	
																				)
																			VALUES(
																					  '1'		                                    							 
																					, '".cleanvars($data_arr['challanNumber'])."'
																					, '1'
																					, '".cleanvars($transamount - BANKCHARGES)."'
																					, '".cleanvars($data_arr['challanNumber'])."'
																					, '4'
																					, '".cleanvars($incomeRemarks)."'
																					, '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																					, '1'
																					, '".cleanvars($rowchallan['id_campus'])."'
																					, NOW()	
																				)"
																);
								//--------------------------------------
								
								if($rowuser['api_allowpartial'] == 1){
									
									$sqllmstranamoount	= $dblms->querylms("SELECT trans_amount  
																			FROM ".PAY_API_TRAN." 
																			WHERE challan_no    = '".cleanvars($rowchallan['challan_no'])."'
																			AND trans_id        = '".cleanvars($data_arr['transId'])."'
																			AND refrence_no    = '".cleanvars($data_arr['referenceNumber'])."'
																		");
									$rowtransamount = mysqli_fetch_array($sqllmstranamoount);
									//echo $rowtransamount['trans_amount'];
									//exit();

									// FULL PAYMENT
									if($rowtransamount['trans_amount'] >= $dueamount){
										$totaltransamount = $rowtransamount['trans_amount'];
			
										// UPDATE PREVIOUS MONTH CHALLAN
										$sqlnar  = $dblms->querylms("SELECT f.id, f.challan_no, f.total_amount, f.paid_amount, f.due_date
																		FROM ".FEES." f
																		WHERE f.due_date   <= '".cleanvars($rowchallan['due_date'])."'
																		AND f.id_month	   != '".cleanvars($rowchallan['id_month'])."'
																		AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
																		AND (f.status = '2' OR f.status = '4')
																		AND f.is_deleted	= '0'
																		AND f.id_type		= '2'
																		ORDER BY f.id ASC");
										if(mysqli_num_rows($sqlnar)>0){
											while($rownar = mysqli_fetch_array($sqlnar)){
												$payable = $rownar['total_amount'] - $rownar['paid_amount'];

												if($rownar['due_date']<date('Y-m-d')){
													$payable = $payable + LATEFEE;
												}
												
												$final_paid = $payable + $rownar['paid_amount'];

												//------------ Update Previous pending Challans as Paid ----------------
												$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
																							  status			= '1'
																							, paid_amount		= '".cleanvars($final_paid)."'
																							, paid_date			= '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																							, pay_mode			= '4' 
																							, date_modify		= NOW()
																							  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
																					");
												if($sqllmsUpdatePrev){
													$totaltransamount = $totaltransamount - $payable;
												}
											}
										}

										if($totaltransamount>0){
											$final_paid = $totaltransamount + $rowchallan['paid_amount'];
											
											// UPDATE CURRENT MONTH CHALLAN
											$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
																						  status    	    = '1'
																						, paid_date		    = '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																						, paid_amount	    = '".cleanvars($final_paid)."'
																						, pay_mode		    = '4' 
																						, date_modify	    = NOW()
																						  WHERE challan_no	= '".$rowchallan['challan_no']."' "
																			);
										}
			
										if($sqllmsupdate && $rowchallan['id_type'] != 3){
											// Check If Record Not Exist
											$sqllmsCheckStd	= $dblms->querylms("SELECT std_id
																					FROM ".STUDENTS." 
																					WHERE admission_formno = '".cleanvars($rowchallan['form_no'])."'
																					AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
																					AND is_deleted != '1' LIMIT 1");
											if(mysqli_num_rows($sqllmsCheckStd) < 1){
												
												// Get Inquiry Details
												$sqllmsInquiry	= $dblms->querylms("SELECT name, fathername, gender, cell_no, address, id_class, is_hostelized, is_orphan
																						FROM ".ADMISSIONS_INQUIRY." 
																						WHERE form_no = '".cleanvars($rowchallan['form_no'])."'
																						AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
																						AND is_deleted != '1' LIMIT 1");
												$valueInquiry = mysqli_fetch_array($sqllmsInquiry);
			
												// Date Conversion
												$admissiondate = date('Y-m-d');
												$admission_year = date('Y');
												
												//For Campus Short Code
												$sqllmsCampus = $dblms->querylms("SELECT campus_code FROM ".CAMPUS." WHERE campus_id = '".cleanvars($rowchallan['id_campus'])."' LIMIT 1");
												$valueCampus = mysqli_fetch_array($sqllmsCampus);
												// For Class Code
												$sqllmsClass = $dblms->querylms("SELECT class_code FROM ".CLASSES." WHERE class_id = '".cleanvars($valueInquiry['id_class'])."' LIMIT 1");
												$valueClass = mysqli_fetch_array($sqllmsClass);
												// For Current Admission Session
												$sqllmsSession = $dblms->querylms("SELECT se.session_id, se.session_name
																						FROM ".SESSIONS." se
																						INNER JOIN ".SETTINGS." st ON st.adm_session = se.session_id
																						WHERE se.session_status = '1' AND st.status = '1' AND st.is_deleted != '1' LIMIT 1");
												$valueSession = mysqli_fetch_array($sqllmsSession);
			
			
												//--------------- Roll No -----------------
												$newRollno = 0;
												$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
																				FROM ".STUDENTS."
																				WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																				AND id_class = '".$valueInquiry['id_class']."'");
												if(mysqli_num_rows($sqllmsRoll) > 0 ){
													$valueRoll = mysqli_fetch_array($sqllmsRoll);
													(int)$valueRoll['rollno'];
													$newRollno = (int)$valueRoll['rollno'] + 1;
												}
												else{
													$newRollno = 1;
												}
			
												//---------------- Reg No -----------------
												$chkregno = $admission_year.'-'.$campus_code.'-';
												$sqllmsCheck	= $dblms->querylms("SELECT std_id, std_regno
																							FROM ".STUDENTS."
																							WHERE std_regno LIKE '".$chkregno."%'
																							ORDER BY std_regno DESC LIMIT 1");
												if(mysqli_num_rows($sqllmsCheck)>0){
													$valueCheck = mysqli_fetch_array($sqllmsCheck);
													$regno = $valueCheck['std_regno'];
													$regno++;
												}else{
													$regno = $admission_year.'-'.$campus_code.'-000001';
												}
												// Remove Spaces
												$regno = str_replace(" ","", $regno);
												//---------------- Reg No -----------------
			
												// Insert Student
												$sqllmsStd = $dblms->querylms("INSERT INTO ".STUDENTS."(
																							std_status 
																						, std_name
																						, std_fathername  
																						, std_gender  
																						, id_country
																						, std_phone 
																						, std_address
																						, is_orphan 
																						, is_hostelized 
																						, id_class  
																						, id_session  
																						, std_rollno  
																						, std_regno  
																						, admission_formno
																						, std_admissiondate
																						, id_campus
																						, id_added  
																						, date_added															
																					)
																				VALUES(
																							'1'
																						, '".cleanvars($valueInquiry['name'])."'
																						, '".cleanvars($valueInquiry['fathername'])."'
																						, '".cleanvars($valueInquiry['gender'])."' 
																						, '1'
																						, '".cleanvars($valueInquiry['cell_no'])."' 
																						, '".cleanvars($valueInquiry['address'])."' 
																						, '".cleanvars($valueInquiry['is_orphan'])."' 
																						, '".cleanvars($valueInquiry['is_hostelized'])."' 
																						, '".cleanvars($valueInquiry['id_class'])."'
																						, '".cleanvars($valueSession['session_id'])."' 
																						, '".cleanvars($newRollno)."' 
																						, '".cleanvars($regno)."' 
																						, '".cleanvars($rowchallan['form_no'])."' 
																						, '".$admissiondate."'
																						, '".cleanvars($rowchallan['id_campus'])."'
																						, '4'
																						, NOW()
																					)");
			
												$std_id = $dblms->lastestid();
			
												// Enrolled In Hostel
												if($valueInquiry['is_hostelized'] == '1'){
			
													$sqllmsHostel = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
																										status 
																									, id_std
																									, joining_date 
																									, id_campus
																									, id_added
																									, date_added
																								)
																							VALUES(
																										'1' 
																									, '".cleanvars($std_id)."'
																									, '".cleanvars($admissiondate)."'
																									, '".cleanvars($rowchallan['id_campus'])."'
																									, '4'
																									, Now()
																								)" );
												}
			
												// Make Login
												// password salt
												$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
			
												// Password
												$pass = 'ags786';
			
												// hash password
												$password = hash('sha256', $pass . $salt);
												for($round = 0; $round < 65536; $round++) {
													$password = hash('sha256', $password . $salt);
												}
			
												// Insert
												$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
																									adm_status  
																								, adm_type
																								, adm_logintype 
																								, adm_username 
																								, adm_salt
																								, adm_userpass
																								, adm_fullname
																								, adm_phone
																								, id_campus
																								, id_added
																								, date_added
																							)
																						VALUES(
																									'1'
																								, '0'
																								, '5'
																								, '".cleanvars($regno)."'
																								, '".cleanvars($salt)."'
																								, '".cleanvars($password)."'
																								, '".cleanvars($valueInquiry['name'])."'
																								, '".cleanvars($valueInquiry['cell_no'])."'
																								, '".cleanvars($rowchallan['id_campus'])."'
																								, '4'
																								, Now()	
																							)");
			
												// Update LogoinID
												$adm_id = $dblms->lastestid();
												
												$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
																									id_loginid	= '".$adm_id."'  
																								WHERE std_id	= '".$std_id."'");
			
												// Make Log
												$remarks = 'Admission Fee Paid through Finja, Record Added In Student.';
												$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																										id_user 
																									, action
																									, challan_no
																									, dated
																									, ip
																									, remarks 
																									, id_campus				
																								)
																							VALUES(
																										'4'
																									, '1' 
																									, '".cleanvars($rowchallan['challan_no'])."'
																									, NOW()
																									, '".cleanvars($ip)."'
																									, '".cleanvars($remarks)."'
																									, '".cleanvars($rowchallan['id_campus'])."'			
																								)");
											}
										}
			
										// Send Message
										sendMessage($phone, $message);
									}

									// PARTIAL PAYMENT
									elseif($rowtransamount['trans_amount'] > 0){
										$totaltransamount = $rowtransamount['trans_amount'];
			
										// Update Previous pending Challans as Paid or Partial Paid
										$sqlnar  = $dblms->querylms("SELECT f.id, f.challan_no, f.total_amount, f.paid_amount, f.due_date
																			FROM ".FEES." f
																			WHERE f.due_date   <= '".cleanvars($rowchallan['due_date'])."'
																			AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
																			AND (f.status = '2' OR f.status = '4')
																			AND f.is_deleted	= '0'
																			AND f.id_type		= '2'
																			ORDER BY f.id ASC
																	");
										if(mysqli_num_rows($sqlnar)>0){
											while($rownar = mysqli_fetch_array($sqlnar)){
			
												$payable = $rownar['total_amount'] - $rownar['paid_amount'];
			
												if($rownar['due_date']<date('Y-m-d')){
													$payable = $payable + LATEFEE;
												}
			
												// FULL PAID
												if($totaltransamount>=$payable){
													$final_paid = $payable + $rownar['paid_amount'];
													//Update pending as Paid
													$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
																							  status			= '1'
																							, paid_amount		= '".cleanvars($final_paid)."'
																							, paid_date			= '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																							, pay_mode			= '4' 
																							, date_modify		= NOW()
																							  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
																					");
													if($sqllmsUpdatePrev){
														$totaltransamount = $totaltransamount - $payable;
													}
												}
			
												// PARTIAL PAID
												elseif($totaltransamount>0){
													$payable = $totaltransamount;
													$final_paid = $payable + $rownar['paid_amount'];
													// Update pending as Partial Paid
													$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
																							  status			= '4'
																							, paid_amount		= '".cleanvars($final_paid)."'
																							, paid_date			= '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																							, pay_mode			= '4' 
																							, date_modify		= NOW()
																							  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
																					");
													if($sqllmsUpdatePrev){
														$totaltransamount = $totaltransamount - $payable;
													}
												}
											}
										}
			
										// Update Current pending Challans as Paid or Partial Paid
										$payable = $rowchallan['total_amount'] - $rowchallan['paid_amount'];
			
										if($rowchallan['due_date']<date('Y-m-d')){
											$payable = $payable + LATEFEE;
										}
			
										// FULL PAID
										if($totaltransamount>=$payable){
											$payable = $totaltransamount;
											$final_paid = $payable + $rowchallan['paid_amount'];
											// Update Pending as Paid
											$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
																					  status    	    = '1'
																					, paid_date		    = '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																					, paid_amount	    = '".cleanvars($final_paid)."'
																					, pay_mode		    = '4' 
																					, date_modify	    = NOW()
																					  WHERE challan_no	= '".$rowchallan['challan_no']."' "
																		);
										}
										
										// PARTIAL PAID
										elseif($totaltransamount>0){
											$payable = $totaltransamount;
											$final_paid = $payable + $rowchallan['paid_amount'];
											// Update Pending as Partial Paid
											$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
																					  status    	    = '4'
																					, paid_date		    = '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																					, paid_amount	    = '".cleanvars($final_paid)."'
																					, pay_mode		    = '4' 
																					, date_modify	    = NOW()
																					  WHERE challan_no	= '".$rowchallan['challan_no']."' "
																		);
										}
									}
	
									$status 	= 1;
									$response 	= '00';
									$paystatus 	= 2;
									
									$output		= '<challanPayment>'."\n";
									$output 	.= "\t".'<status>Success</status>'."\n";
									$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
									$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
									$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
									$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
									$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
									$output 	.= "\t".'<studentFee>'.$transamount.'</studentFee>'."\n";
									$output 	.= "\t".'<referenceNumber>'.$data_arr['referenceNumber'].'</referenceNumber>'."\n";
									$output 	.= "\t".'<customerCode>'.$customercode.'</customerCode>'."\n";
									$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
									$output 	.= "\t".'<remarks></remarks>'."\n";
									$output		.= '</challanPayment>';

								}elseif((($transamount-BANKCHARGES) == $grandTotal) && ($rowuser['api_allowpartial'] != 1)){

									$totaltransamount = $transamount-BANKCHARGES;
				
									$sqlnar  = $dblms->querylms("SELECT f.id, f.challan_no, f.total_amount, f.paid_amount, f.due_date
																	FROM ".FEES." f
																	WHERE f.due_date	< '".cleanvars($rowchallan['due_date'])."'
																	AND f.id_std		= '".cleanvars($rowchallan['id_std'])."'
																	AND (f.status = '2' OR f.status ='4')
																	AND f.id_type		= '2'
																	AND f.is_deleted	= '0'
																");
									if(mysqli_num_rows($sqlnar)>0){
										while($rownar = mysqli_fetch_array($sqlnar)){
											$payable = $rownar['total_amount'] - $rownar['paid_amount'];

											if($rownar['due_date']<date('Y-m-d')){
												$payable = $payable + LATEFEE;
											}
											
											$final_paid = $payable + $rownar['paid_amount'];

											//------------ Update Previous pending Challans as Paid ----------------
											$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
																						  status			= '1'
																						, paid_amount		= '".cleanvars($final_paid)."'
																						, paid_date			= '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																						, pay_mode			= '4' 
																						, date_modify		= NOW()
																						  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
																					");
											if($sqllmsUpdatePrev){
												$totaltransamount = $totaltransamount - $payable;
											}
										}
									}
				
									// Update Current Month Challan as Paid
									$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
																			  status    	= '1'
																			, paid_date		= '".date('Y-m-d', strtotime(cleanvars($data_arr['transDate'])))."'
																			, paid_amount	= '".cleanvars($totaltransamount)."'
																			, pay_mode		= '4' 
																			, date_modify	= NOW()
																			  WHERE challan_no	= '".$rowchallan['challan_no']."' "
																	);
									
									if($sqllmsupdate){
										// Check If Record Not Exist
										$sqllmsCheckStd	= $dblms->querylms("SELECT std_id
																				FROM ".STUDENTS." 
																				WHERE admission_formno = '".cleanvars($rowchallan['form_no'])."'
																				AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
																				AND is_deleted != '1' LIMIT 1");
										if(mysqli_num_rows($sqllmsCheckStd) < 1) {
											
											// Get Inquiry Details
											$sqllmsInquiry	= $dblms->querylms("SELECT name, fathername, gender, cell_no, address, id_class, is_hostelized, is_orphan
																					FROM ".ADMISSIONS_INQUIRY." 
																					WHERE form_no = '".cleanvars($rowchallan['form_no'])."'
																					AND id_campus = '".cleanvars($rowchallan['id_campus'])."'
																					AND is_deleted != '1' LIMIT 1");
											$valueInquiry = mysqli_fetch_array($sqllmsInquiry);
				
											// Date Conversion
											$admissiondate = date('Y-m-d');
											$admission_year = date('Y');
											
											//For Campus Short Code
											$sqllmsCampus = $dblms->querylms("SELECT campus_code FROM ".CAMPUS." WHERE campus_id = '".cleanvars($rowchallan['id_campus'])."' LIMIT 1");
											$valueCampus = mysqli_fetch_array($sqllmsCampus);
											// For Class Code
											$sqllmsClass = $dblms->querylms("SELECT class_code FROM ".CLASSES." WHERE class_id = '".cleanvars($valueInquiry['id_class'])."' LIMIT 1");
											$valueClass = mysqli_fetch_array($sqllmsClass);
											// For Current Admission Session
											$sqllmsSession = $dblms->querylms("SELECT se.session_id, se.session_name
																					FROM ".SESSIONS." se
																					INNER JOIN ".SETTINGS." st ON st.adm_session = se.session_id
																					WHERE se.session_status = '1' AND st.status = '1' AND st.is_deleted != '1' LIMIT 1");
											$valueSession = mysqli_fetch_array($sqllmsSession);
				
											//--------------- Roll No -----------------
											$newRollno = 0;
											$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
																			FROM ".STUDENTS."
																			WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																			AND id_class = '".$valueInquiry['id_class']."'");
											if(mysqli_num_rows($sqllmsRoll) > 0 ){
												$valueRoll = mysqli_fetch_array($sqllmsRoll);
												(int)$valueRoll['rollno'];
												$newRollno = (int)$valueRoll['rollno'] + 1;
											}
											else{
												$newRollno = 1;
											}
				
											//---------------- Reg No -----------------
											$chkregno = $admission_year.'-'.$campus_code.'-';
											$sqllmsCheck	= $dblms->querylms("SELECT std_id, std_regno
																						FROM ".STUDENTS."
																						WHERE std_regno LIKE '".$chkregno."%'
																						ORDER BY std_regno DESC LIMIT 1");
											if(mysqli_num_rows($sqllmsCheck)>0){
												$valueCheck = mysqli_fetch_array($sqllmsCheck);
												$regno = $valueCheck['std_regno'];
												$regno++;
											}else{
												$regno = $admission_year.'-'.$campus_code.'-000001';
											}
											// Remove Spaces
											$regno = str_replace(" ","", $regno);
											//---------------- Reg No -----------------
				
											// Insert Student
											$sqllmsStd = $dblms->querylms("INSERT INTO ".STUDENTS."(
																						std_status 
																					, std_name
																					, std_fathername  
																					, std_gender  
																					, id_country
																					, std_phone 
																					, std_address
																					, is_orphan 
																					, is_hostelized 
																					, id_class  
																					, id_session  
																					, std_rollno  
																					, std_regno  
																					, admission_formno
																					, std_admissiondate
																					, id_campus
																					, id_added  
																					, date_added															
																				)
																			VALUES(
																						'1' 
																					, '".cleanvars($valueInquiry['name'])."'
																					, '".cleanvars($valueInquiry['fathername'])."'
																					, '".cleanvars($valueInquiry['gender'])."' 
																					, '1'
																					, '".cleanvars($valueInquiry['cell_no'])."' 
																					, '".cleanvars($valueInquiry['address'])."' 
																					, '".cleanvars($valueInquiry['is_orphan'])."' 
																					, '".cleanvars($valueInquiry['is_hostelized'])."' 
																					, '".cleanvars($valueInquiry['id_class'])."'
																					, '".cleanvars($valueSession['session_id'])."' 
																					, '".cleanvars($newRollno)."' 
																					, '".cleanvars($regno)."' 
																					, '".cleanvars($rowchallan['form_no'])."' 
																					, '".$admissiondate."'
																					, '".cleanvars($rowchallan['id_campus'])."'
																					, '4'
																					, NOW()
																				)");
				
											$std_id = $dblms->lastestid();
				
											// Enrolled In Hostel
											if($valueInquiry['is_hostelized'] == '1'){
				
												$sqllmsHostel = $dblms->querylms("INSERT INTO ".HOSTEL_REG."(
																									status 
																								, id_std
																								, joining_date 
																								, id_campus
																								, id_added
																								, date_added
																							)
																						VALUES(
																									'1' 
																								, '".cleanvars($std_id)."'
																								, '".cleanvars($admissiondate)."'
																								, '".cleanvars($rowchallan['id_campus'])."'
																								, '4'
																								, Now()
																							)" );
											}
				
											// Make Login
											// password salt
											$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				
											// Password
											$pass = 'ags786';
				
											// hash password
											$password = hash('sha256', $pass . $salt);
											for($round = 0; $round < 65536; $round++) {
												$password = hash('sha256', $password . $salt);
											}
				
											// Insert
											$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
																								adm_status  
																							, adm_type
																							, adm_logintype 
																							, adm_username 
																							, adm_salt
																							, adm_userpass
																							, adm_fullname
																							, adm_phone
																							, id_campus
																							, id_added
																							, date_added
																						)
																					VALUES(
																								'1'
																							, '0'
																							, '5'
																							, '".cleanvars($regno)."'
																							, '".cleanvars($salt)."'
																							, '".cleanvars($password)."'
																							, '".cleanvars($valueInquiry['name'])."'
																							, '".cleanvars($valueInquiry['cell_no'])."'
																							, '".cleanvars($rowchallan['id_campus'])."'
																							, '4'
																							, Now()	
																						)");
				
											// Update LogoinID
											$adm_id = $dblms->lastestid();
											
											$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
																								id_loginid	= '".$adm_id."'  
																								WHERE std_id	= '".$std_id."'");
				
											// Make Log
											$remarks = 'Admission Fee Paid through Finja, Record Added In Student.';
											$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																									id_user 
																								, action
																								, challan_no
																								, dated
																								, ip
																								, remarks 
																								, id_campus				
																							)
																						VALUES(
																									'4'
																								, '1' 
																								, '".cleanvars($rowchallan['challan_no'])."'
																								, NOW()
																								, '".cleanvars($ip)."'
																								, '".cleanvars($remarks)."'
																								, '".cleanvars($rowchallan['id_campus'])."'			
																							)");
										}
										
				
										// Set Credentials, Cell and MSG in Data Objects
										// $data['username'] = 'demoumer';
										// $data['password'] = '786786';
										// $data['mask'] = 'AGS';
										// $data['mobile'] = $phone;
										// $data['message'] = $message;
									
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
									}
																			
									//if challan paid successfully
									if($sqllmsupdate){ 
				
										$status 	= 1;
										$response 	= '00';
										$paystatus 	= 2;
										
										$output		= '<challanPayment>'."\n";
										$output 	.= "\t".'<status>Success</status>'."\n";
										$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
										$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
										$output 	.= "\t".'<studentChallan>'.$rowchallan['challan_no'].'</studentChallan>'."\n";
										$output 	.= "\t".'<studentName>'.$name.'</studentName>'."\n";
										$output 	.= "\t".'<studentClass>'.$class.'</studentClass>'."\n";
										$output 	.= "\t".'<studentFee>'.$transamount.'</studentFee>'."\n";
										$output 	.= "\t".'<referenceNumber>'.$data_arr['referenceNumber'].'</referenceNumber>'."\n";
										$output 	.= "\t".'<customerCode>'.$customercode.'</customerCode>'."\n";
										$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
										$output 	.= "\t".'<remarks></remarks>'."\n";
										$output		.= '</challanPayment>';
										
									}
								}else{

									$status 	= 16;
									$response 	 = '096';
									
									$output		 = '<challanInfo>'."\n";
									$output 	.= "\t".'<status>Failed</status>'."\n";
									$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
									$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
									$output		.= '</challanInfo>';
		
									header('Content-Type: application/xml');
									print ($output);

								}
							}
						}else{
							$status 	= 16;
							$response 	 = '098';
							
							$output		 = '<challanInfo>'."\n";
							$output 	.= "\t".'<status>Failed</status>'."\n";
							$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
							$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
							$output		.= '</challanInfo>';

							header('Content-Type: application/xml');
							print ($output);
						}
					}
					//----------Check if given Challan Number Match end----------
					else{
						$status 	= 14;
						$response 	= '091';
						$paystatus 	 = 4;
						
						$output		 = '<challanPayment>'."\n";
						$output 	.= "\t".'<status>Success</status>'."\n";
						$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
						$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
						$output 	.= "\t".'<updateStatus>'.get_feestatus1($paystatus).'</updateStatus>'."\n";
						$output		.= '</challanPayment>';
					}

					header('Content-Type: application/xml');
					print ($output);
					
				}else{ 
		
					$api_id 	 = '';
					$status 	 = 12;
					$response 	= '094';

					
					$output		 = '<challanPayment>'."\n";
					$output 	.= "\t".'<status>Failed</status>'."\n";
					$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
					$output 	.= "\t".'<responseDescription>'.get_bank_request_status($response).'</responseDescription>'."\n";
					$output		.= '</challanPayment>';

					header('Content-Type: application/xml');
					print ($output);
				}
			}
		
			if($rowuser['api_id']){
				$api_id = $rowuser['api_id'];
			} else{
				$api_id = '';
			}
		
			//------------------Insert Data into Log Table------------------
			$sqllmsinsert  = $dblms->querylms("INSERT INTO ".PAY_API_LOG." (
																	  id_api
																	, customer_code
																	, branch_code
																	, challan_no
																	, refrence_no
																	, status
																	, date_added
																	, requests
																	, ip	
																)
														VALUES (
																	  '".$api_id."'
																	, '".cleanvars($customercode)."'
																	, '".cleanvars($data_arr['branchCode'])."'
																	, '".cleanvars($data_arr['challanNumber'])."'
																	, '".cleanvars($data_arr['referenceNumber'])."'
																	, '".$status."'
																	, NOW()
																	, '".$output.$requestedvars."'
																	, '".$ip."'
																)
												");
			//----------------Insert Data into Log Table end----------------
		}else{

			$api_id 	 = '';
			$status 	 = 21;
			$response 	 = '096';
			//------------------Insert Data into Log Table------------------
			$sqllmsinsert  = $dblms->querylms("INSERT INTO ".PAY_API_LOG." (
																	  id_api
																	, customer_code
																	, branch_code
																	, challan_no
																	, refrence_no
																	, status
																	, date_added
																	, requests
																	, ip	
																)
														VALUES (
																	  '".$api_id."'
																	, '".cleanvars($customercode)."'
																	, '".cleanvars($data_arr['branchCode'])."'
																	, '".cleanvars($data_arr['challanNumber'])."'
																	, '".cleanvars($data_arr['referenceNumber'])."'
																	, '".$status."'
																	, NOW()
																	, '".$output.$requestedvars."'
																	, '".$ip."'
																)
												");
			//----------------Insert Data into Log Table end----------------

			
			$output		 = '<challanPayment>'."\n";
			$output 	.= "\t".'<status>Failed</status>'."\n";
			$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
			$output 	.= "\t".'<responseDescription>'.get_request_status($status).'</responseDescription>'."\n";
			$output		.= '</challanPayment>';

			header('Content-Type: application/xml');
			print ($output);

		}

	}else{

		$api_id 	 = '';
		$status 	 = 21;
		$response 	 = '096';
		
		//----------------Insert Data into Log Table end----------------
		$output		 = '<Info>'."\n";
		$output 	.= "\t".'<status>Failed</status>'."\n";
		$output 	.= "\t".'<responseCode>'.strval($response).'</responseCode>'."\n";
		$output 	.= "\t".'<responseDescription>'.get_request_status($status).'</responseDescription>'."\n";
		$output		.= '</Info>';

		header('Content-Type: application/xml');
		print ($output);
	}
?>