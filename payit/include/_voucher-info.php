<?php 
	if(isset($dataArray['ReferenceNumber']) && isset($dataArray['BankAccountCode']) && isset($dataArray['X_API_KEY'])){

		$challanNumber = $challanprefix.substr($dataArray['ReferenceNumber'], -7);

		$queryChallan = $dblms->querylms("SELECT f.status, f.id_type, f.challan_no, f.due_date, f.total_amount, f.paid_amount, f.id_std, f.id_campus, f.id_month, f.inquiry_formno, f.issue_date,
																cls.class_name, cm.campus_customercode, std.*, q.name, q.form_no, don.donor_name, cs.section_name, s.session_name
																FROM ".FEES." f
																LEFT JOIN ".CLASSES."  cls ON cls.class_id 	= f.id_class 
																LEFT JOIN ".STUDENTS." std ON std.std_id 	= f.id_std 
																LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no	= f.inquiry_formno 
																LEFT JOIN ".DONORS."   don ON don.donor_id 	= f.id_donor
																LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section
																INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
																INNER JOIN ".CAMPUS."  cm  ON cm.campus_id 	= f.id_campus  
																WHERE f.challan_no = '".cleanvars($challanNumber)."' 
																AND f.is_deleted != '1' AND (f.status = '2' OR f.status = '4')
																LIMIT 1");
		if(mysqli_num_rows($queryChallan) == 1) {

			$valueChallan = mysqli_fetch_array($queryChallan);
			//Grand Total with Previous Month
			
				$grandTotal = 0;
			
			
						
						foreach($monthtypes as $month):
							if($rowchallan['id_month']==$month['id']){
								if($valueChallan['due_date'] < date('Y-m-d')){ 
									$amount = (($rowchallan['total_amount'] + $latefee) - $rowchallan['paid_amount']);
								} else {
									$amount = ($rowchallan['total_amount'] - $rowchallan['paid_amount']);	
								}
								

							}else{
								$sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.challan_no, f.id_std,
																	f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																	FROM ".FEES." f
																	WHERE f.id_month	= '".cleanvars($month['id'])."'
																	AND f.id_std		= '".cleanvars($valueChallan['id_std'])."'
																	AND (f.status = '2' OR f.status = '4')
																	AND f.id_type IN('2', '1')
																	AND f.is_deleted	= '0' LIMIT 1");
								if(mysqli_num_rows($sqlnarration)>0){
									$valnarration = mysqli_fetch_array($sqlnarration);

									$amount = ($valnarration['total_amount'] - $valnarration['paid_amount']);

									if($valnarration['due_date'] < date('Y-m-d')){
										$amount = ($amount);
									}
								}else{
									$amount = 0;
								}
							}
							$grandTotal = ($grandTotal + $amount);
						endforeach;

			if($valueChallan['id_campus'] == 1) { 
				$numOfDays = 5; 
			} else { 
				$numOfDays = 15;
			}
			$lastDate	= date ("Y-m-t",  strtotime($valueChallan['due_date']));

			if($valueChallan['inquiry_formno'] != '') { 
				$studentRN = $valueChallan['inquiry_formno']; 
			} elseif($valueChallan['std_regno'] != '') { 
				$studentRN = $valueChallan['std_regno'];
			} else {
				$studentRN = $valueChallan['challan_no'];
			}
			if($valueChallan['section_name'] != '') { 
				$studentSection = $valueChallan['section_name']; 
			} else { 
				$studentSection = 'A';
			}
		
			$studentCNIC = '00000-0000000-0';
			
			if($valueChallan['std_phone'] != '') { 
				$studentMobile = $valueChallan['std_phone']; 
			} else { 
				$studentMobile = '0300-0000000';
			}
			if($valueChallan['std_email'] != '') { 
				$studentEmail = $valueChallan['std_email']; 
			} else { 
				$studentEmail = 'info@aghosh.net';
			}

			$responseReturnValue = '1';
			if($valueChallan['status'] == '2' && ($lastDate >= date('Y-m-d'))){
				$responseReturnValue = '0';
			}
			
			

			$data['Amount'] 					= ($grandTotal+$bankCharges);
			$data['LateAmount'] 				= ($grandTotal+$bankCharges+$latefee);
			$data['YearMonthFrom'] 				= date('Y-m', strtotime($valueChallan['issue_date']));
			$data['YearMonthTo'] 				= date('Y-m', strtotime($valueChallan['due_date']));
			$data['Description'] 				= 'Fee for '.date('Y-m', strtotime($valueChallan['due_date']));
			$data['DueDate'] 					= date('Y-m-d', strtotime($valueChallan['due_date']));
			$data['VoucherValidTillDate'] 		= $lastDate;
			$data['StudentIdentificationNumber'] = $studentRN;
			$data['ClassName'] 					= $valueChallan['class_name'];
			$data['SectionName'] 				= $studentSection;
			$data['InstituteName'] 				= $valueChallan['campus_customercode'];
			$data['SessionName'] 				= $valueChallan['session_name'];
			$data['BankAccountCode'] 			= $dataArray['BankAccountCode'];
			$data['CNIC'] 						= $studentCNIC;
			$data['StudentName'] 				= $valueChallan['std_name'];
			$data['MobileNumber'] 				= $studentMobile;
			$data['Email'] 						= $studentEmail;
			$data['X_API_KEY'] 					= $apiKey;
			$data['ReferenceNumber'] 			= cleanvars($dataArray['ReferenceNumber']);
			$data['ReturnValue'] 				= $responseReturnValue;

		} else {

			$data['ReturnValue'] = '1';
		}

	} else {

		$data['ReturnValue'] = '1';

	}

	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();