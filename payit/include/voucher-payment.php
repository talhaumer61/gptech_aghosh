<?php 
	if(isset($dataArray['ReferenceNumber']) && isset($dataArray['BankAccountCode']) && isset($dataArray['X_API_KEY']) && isset($dataArray['TransactionId']) && isset($dataArray['TransactionAmount']) && isset($dataArray['TransactionDate']) && isset($dataArray['isSetteled']) && isset($dataArray['ReturnValue'])){

		if(($dataArray['BankAccountCode'] == 4000 || $dataArray['BankAccountCode'] == 4011) && $dataArray['X_API_KEY'] == $apiKey){
		
			$challanNumber = $challanprefix.substr($dataArray['ReferenceNumber'], -7);

			$queryChallan = $dblms->querylms("SELECT f.id, f.status, f.id_type, f.challan_no, f.due_date, f.total_amount, f.paid_amount, f.id_std, f.id_campus, f.id_month, f.inquiry_formno, f.issue_date,
																cls.class_name, cm.campus_customercode, std.*, q.name, q.form_no, don.donor_name, cs.section_name, s.session_name, q.cell_no 
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
				
				if($valueChallan['id_campus'] == 1) { 
					$numOfDays = 5; 
				} else { 
					$numOfDays = 15;
				}
				$lastDate	= date ("Y-m-t", strtotime($valueChallan['due_date']));

				if($valueChallan['due_date'] >= date("Y-m-d")) {		
					$dueAmount = ($valueChallan['total_amount'] + $bankCharges);
				} else {
					$dueAmount = ($valueChallan['total_amount'] + $bankCharges + $latefee);
				}

				if($valueChallan['status'] == '2' && $lastDate >= date("Y-m-d") && $dataArray['TransactionAmount'] >= $dueAmount) {

                    if($valueChallan['std_whatsapp']) {
                        $mobilenum1 = '92'.str_replace('-', '', ltrim($valueChallan['std_whatsapp'], '0'));
                    } else  if($valueChallan['cell_no']) {
                        $mobilenum1 = '92'.str_replace('-', '', ltrim($valueChallan['cell_no'], '0'));
                    } else {
                        $mobilenum1 = '';
                    }
                    if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {
                        if($valueChallan['std_name']){ $stdName = $valueChallan['std_name'];} else {$stdName = $valueChallan['name'];}

                        $msgs = 'Dear '.($stdName).'
Your Fee Challan No '.$challanNumber.' Rs. '.number_format($dataArray['TransactionAmount']).'/ Month of '.get_monthtypes($valueChallan['id_month']).'-'.date('Y' , strtotime($dataArray['TransactionDate'])).' has been paid Dated '.date('d-m-Y' , strtotime($dataArray['TransactionDate'])).'.

https://aghosh.gptech.pk/feechallanprintwa.php?id='.$challanNumber.'

Thanks for your Payment

Regards:
Accounts Department
Aghosh Complex';
                        // whatsapp message
                        $datawa = array(
                                               'status'         => 0
                                            , 'dated'           => date('Y-m-d', strtotime(cleanvars($dataArray['TransactionDate'])))
                                            , 'challanno'       => ($challanNumber)
                                            , 'amount'          => $dataArray['TransactionAmount']
                                            , 'cellno'          => ($mobilenum1)
                                            , 'message_type'    => 3
                                            , 'message'         => $msgs
                                    );
                        $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);

                    }
					
					//------------------- Add API Trans ----------------------
				

					$queryInsertTransaction = $dblms->querylms("INSERT INTO ".PAY_API_TRAN." (
																			status						    ,
																			id_api						    ,
																			customer_code					,
																			branch_code					    ,
																			challan_no						,
																			refrence_no						,
																			trans_id						,
																			trans_amount					,
																			trans_currency					,
																			trans_date						,
																			date_added				        ,
																			ip	
																		)
																VALUES (
																			'1'   											,
																			'6'   											,
																			'".cleanvars($valueChallan['campus_customercode'])."',
																			'PayIt'											,
																			'".cleanvars($challanNumber)."'					,
																			'".cleanvars($dataArray['ReferenceNumber'])."'	,
																			'".cleanvars($dataArray['TransactionId'])."'	,
																			'".cleanvars($dataArray['TransactionAmount'])."',
																			'PKR'											,
																			'".date('Y-m-d', strtotime(cleanvars($dataArray['TransactionDate'])))."'	,
																			NOW()                							,
																			'".$ip."'
																		)
													");
					// UPDATE CURRENT MONTH CHALLAN
	

					$queryUpdateFee  = $dblms->querylms("UPDATE ".FEES." SET 
																		  status    	= '1'
																		, paid_date		= '".date('Y-m-d', strtotime(cleanvars($dataArray['TransactionDate'])))."'
																		, paid_amount	= '".cleanvars($valueChallan['total_amount'])."'
																		, pay_mode		= '6' 
																		, date_modify	= NOW()
																	WHERE id	= '".$valueChallan['id']."'");
					
						foreach($monthtypes as $month):
							if($valueChallan['id_month']!=$month['id']){
								
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

									$queryUpdateFeeinst  = $dblms->querylms("UPDATE ".FEES." SET 
																		  status    	= '1'
																		, paid_date		= '".date('Y-m-d', strtotime(cleanvars($dataArray['TransactionDate'])))."'
																		, paid_amount	= '".cleanvars($valnarration['total_amount'])."'
																		, pay_mode		= '6' 
																		, date_modify	= NOW()
																	WHERE id			= '".$valnarration['id']."'");
								}
							}
							
						endforeach;

	
					$responseReturnValue = '1';
					if($queryUpdateFee){
						$responseReturnValue = '0';
					}
		
					$data['ReturnValue'] = $responseReturnValue;

				} else {

					$data['ReturnValue'] = '1';
				}

			} else {

				$data['ReturnValue'] = '1';
			}

		} else {

			$data['ReturnValue'] = '1';
		}

	} else {

		$data['ReturnValue'] = '1';

	}

	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();