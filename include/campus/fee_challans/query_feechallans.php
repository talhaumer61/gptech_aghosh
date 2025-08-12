<?php 
//	Bulk Fee Challans Genrate
if(isset($_POST['challans_generate'])){
	
	$srno 	 	 = 0;
	$tuitionFee  = 0;
	//------------------------Reformat Date------------------------
	$challandate = substr(date('Y'),2,4);
	$issue_date  = date('Y-m-d');
	$due_date 	 = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
	$yearmonth 	 = date('Y-m', strtotime(cleanvars($_POST['yearmonth'])));
	$year 		 = date('y', strtotime(cleanvars($_POST['yearmonth'])));
	$idyear 		 = date('Y', strtotime(cleanvars($_POST['yearmonth'])));
	$idmonth 	 = date('n', strtotime(cleanvars($_POST['yearmonth'])));
    $classarry =  explode(',', $_POST['id_class']);
	//------------ Check Students & No Challan -------------	
		$sqllmsstudent	= $dblms->querylms("SELECT s.std_id, s.std_name, s.id_session, s.is_hostelized, s.std_phone, 
													s.std_whatsapp, s.transport_fee, s.admission_formno, fs.id
												FROM ".STUDENTS." s
												INNER JOIN ".FEESETUP." fs ON s.id_class = fs.id_class AND fs.id_session = s.id_session 
												WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
												AND s.id_class = '".cleanvars($classarry[0])."'
												AND fs.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
												AND s.is_orphan != '1' AND s.is_orphan_approved != '1'
												AND s.std_status = '1' AND s.is_deleted != '1'
												AND fs.is_deleted != '1' AND fs.status = '1' 
											");
		$no = 0;
		
		if(mysqli_num_rows($sqllmsstudent) > 0) {
			while($value_std = mysqli_fetch_array($sqllmsstudent)) {
                if($value_std['std_whatsapp']) {
                    $mobilenum1 = '92'.str_replace('-', '', ltrim($value_std['std_whatsapp'], '0'));
                } else {
                    $mobilenum1 = '';
                }
									
				//------------ Check Challan Already Genrated -------------
				$sqllmsPrevChallan = $dblms->querylms("SELECT f.id
														FROM ".FEES." f
														WHERE f.yearmonth	= '".cleanvars($yearmonth)."'
														AND ((f.id_std		= '".cleanvars($value_std['std_id'])."' AND f.id_type = '2') 
															OR (f.inquiry_formno = '".cleanvars($value_std['admission_formno'])."' AND f.id_type = '1'))
														AND f.id_session	= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
														AND f.id_campus		= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
														AND f.is_deleted	= '0'
													");
				if(mysqli_num_rows($sqllmsPrevChallan) == 0){
					
			//Check Student Hostel Registration
					$sqllmHostelRegistration	= $dblms->querylms("SELECT id 
																	FROM ".HOSTEL_REG."
																	WHERE status    = '1' 
																	AND id_std      = '".$value_std['std_id']."'
																	AND id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																	LIMIT 1");
					//If Hostelized Add Fee Cats
					if (mysqli_num_rows($sqllmHostelRegistration) == 1) {
						$hostel_cats = ""; 
					} else {
						$hostel_cats = ",6,7,8"; 
					}
					
					 
					 $cat_amount 	= 0;
					 $total_amount 	= 0;
					$catDetails = array();
					     
                //----------------- Remaining Amount ------------------
                $sqllms_rem = $dblms->querylms("SELECT remaining_amount, challan_no
                                                    FROM ".FEES." 
                                                    WHERE id_std = '".cleanvars($value_std['std_id'])."'
                                                    AND is_deleted != '1'
                                                    ORDER BY id DESC LIMIT 1");
                if(mysqli_num_rows($sqllms_rem) > 0){
                    $row_rem        = mysqli_fetch_array($sqllms_rem);
                    if($row_rem['remaining_amount']>0){
                        $rem_challan    = $row_rem['challan_no'];
                        $rem_amount     = $row_rem['remaining_amount'];
                        $rem_fine       = 300;
                        $allowEdit      = ""; 
						//$catDetails[] 	= array(13, $rem_amount, 0);
                    }else{
                        $rem_amount     = 0;
                        $rem_fine       = 0;
                        $rem_challan    = "";
                        $allowEdit      = "";
                    }
                }
			
					$prev_challans  =   0;
					 
					$concession = 0;
					
					$sqllmsCats	= $dblms->querylms("SELECT c.cat_id, c.cat_name
                                                    FROM ".FEE_CATEGORY." c
                                                    WHERE c.cat_status = '1' 
                                                    AND c.cat_id NOT IN(1,4,5$hostel_cats)
                                                    AND c.is_deleted != '1'
                                                    ORDER BY c.cat_ordering ASC");
                	while($valCat = mysqli_fetch_array($sqllmsCats)){

						$sqllmsDet	= $dblms->querylms("SELECT 	d.id, d.id_setup, d.id_cat, d.amount, d.duration
															FROM ".FEESETUPDETAIL." d											 
															WHERE d.id_setup = '".$value_std['id']."'
															AND d.id_cat = '".$valCat['cat_id']."'
															AND d.duration = 'Monthly' LIMIT 1");
						//-----------------------------------------------------
						$valDet = mysqli_fetch_array($sqllmsDet);
						                         //-------- GET TUITION FEE -------------
                                // if($valCat['cat_id'] == 2){
                                //     $tuitionFee = $valDet['amount'];
                                // }
                                // cat_id = 13 is for arrears
                            if($valCat['cat_id'] == 13){
                                    // previous balance
								 $cat_amount = $rem_amount;
								 $total_amount = $total_amount + $cat_amount;
                            } else if($valCat['cat_id'] == 14){
                                    //----------------------------Fine-------------------------
                                    $month = $idmonth - 1;
                                    $sql_fine	= $dblms->querylms("SELECT SUM(amount) as fine
                                                                        FROM ".SCHOLARSHIP." 
                                                                        WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
                                                                        AND  id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
                                                                        AND  id_type = '3' AND status = '1' AND is_deleted != '1'
                                                                        AND  id_std = '".$value_std['std_id']."'
                                                                        AND  YEAR(date) = '".$idyear."'
                                                                        AND  MONTH(date) = '".$idmonth."'
																		 ");
                                                                        // AND  MONTH(date) IN ('".$month."', '".$idmonth."') ");
                                    //---------------- Fine Amount ------------------------
                                    $values_fine = 	mysqli_fetch_array($sql_fine);
                                    //-----------------------------------------------------

                                    // Fine
                                    $cat_amount 	= $values_fine['fine'] + $rem_fine;
                                    $total_amount 	= ($total_amount + $cat_amount);
                                } elseif($valCat['cat_id'] == 16){
                                    //Transport Fee
                                    $cat_amount = $value_stu['transport_fee'];
                                    $total_amount = $total_amount + $cat_amount;
                                }else{
                                    // Get Concession On each Head from Concessions
                                    $sqllmsConcession = $dblms->querylms("SELECT SUM(amount) as amount
                                                                            FROM ".SCHOLARSHIP." 
                                                                            WHERE id_std = '".cleanvars($value_std['std_id'])."'
																			AND is_deleted = '0' 
																			AND status = '1' 
																			AND id_type = '2'
																			AND id_session  = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                                                            AND id_feecat = '".cleanvars($valCat['cat_id'])."' ");
                                    $valuesConcess = mysqli_fetch_array($sqllmsConcession);

                                    $cat_amount = ($valDet['amount'] - $valuesConcess['amount']);
                                    $concession = ($valuesConcess['amount']);
                                    // echo "amount: ".$valDet['amount'];
                                    // echo "after Concession: ".$cat_amount;
                                    if($cat_amount > 0){
                                        $total_amount = $total_amount + $cat_amount;
                                    }
                                    else{
                                        $total_amount = $total_amount + 0;
                                    }
                                    
                                }
                             $catDetails[] = array($valCat['cat_id'],  $cat_amount, $concession);   
                        //}
                }

					
            		//unset($valueDetail);
            		//unset($sqllmsChallanCheck);
					//---------- Total Amount after substracting Concession & Scholarship ---------------
					$tot_amount = array_sum(array_column($catDetails, 1));
					$payable = $tot_amount;

					if($payable > 0){
						
						// challan no
						do {
							$challano 	= '9930'.$year.mt_rand(10000,99999);
							$sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
							$sqlCheck	= $dblms->querylms($sqlChallan);
						} while (mysqli_num_rows($sqlCheck) > 0);

						//--------------------- Challan Genrate ------------------------
						$sqllmsChallan = $dblms->querylms("INSERT INTO ".FEES."(
																			  status 
																			, id_type
																			, challan_no 
																			, id_session 
																			, id_month
																			, yearmonth
																			, id_class 
																			, id_std
																			, issue_date
																			, due_date
																			, total_amount
																			, note
																			, id_campus
																			, id_added
																			, date_added		
																		)
																	VALUES(
																			  '2'
																			, '2'
																			, '".cleanvars($challano)."'
																			, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
																			, '".cleanvars($idmonth)."'
																			, '".cleanvars($yearmonth)."'
																			, '".cleanvars($_POST['id_class'])."'
																			, '".cleanvars($value_std['std_id'])."'
																			, '".cleanvars($issue_date)."' 
																			, '".cleanvars($due_date)."'
																			, '".cleanvars($payable)."'
																			, ''
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																			, Now()	
																		)"
																);

						//$genratedChallans++;
						//-------------------------Fee Particulars Detail-----------------------
						if($sqllmsChallan) { 
							//-------------------------Get latest Id----------------------- 
							$idsetup = $dblms->lastestid();	

							foreach($catDetails as $cats){
								if($cats[1] > 0){	
									$sqllmsPart = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																								  id_fee
																								, id_cat
																								, amount
																								, concession							
																							)
																						VALUES(
																								  '".cleanvars($idsetup)."'
																								, '".cleanvars($cats[0])."'
																								, '".cleanvars($cats[1])."'
																								, '".cleanvars($cats[2])."'
																							)
																					");
								}
								else{
									continue;
								}
							}
							//------------ Fine Added in Challan ----------------
							$sqllmsUpdate  = $dblms->querylms("UPDATE ".SCHOLARSHIP." SET  
																	challan_no	= '".cleanvars($challano)."'
																	WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
																	AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
																	AND id_type = '3' AND status = '1' AND is_deleted != '1' 
																	AND id_std = '".cleanvars($value_std['std_id'])."' AND challan_no = ''
																	AND  YEAR(date) = '".$idyear."'
																	AND  MONTH(date) = '".$idmonth."' ");

							//-------------------- Make Log ------------------------
							$remarks = "Challan Created from Bulk Challans";
							$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																		  id_user 
																		, filename 
																		, action
																		, challan_no
																		, dated
																		, ip
																		, remarks 
																		, id_campus			
																	)

																VALUES(
																		  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																		, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																		, '1'
																		, '".cleanvars($challano)."'
																		, NOW()
																		, '".cleanvars($ip)."'
																		, '".cleanvars($remarks)."'
																		, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																	)
															");

							//$phone = str_replace("-","",$val_std['std_phone']);
							//$sent++;

							// Send Message
							//$data['mobile'] = $phone;
							//$message = 'Dear Parents,'.PHP_EOL.''.PHP_EOL.'Your child fee challan # '.cleanvars($challano).' for the month '.get_monthtypes($idmonth).' of amount '.number_format($payable).' with due date '.date('d-m-Y' , strtotime(cleanvars($_POST['due_date']))).' has been issued.'.PHP_EOL.''.PHP_EOL.'Thanks,'.PHP_EOL.'Aghosh Grammar School';
							//sendMessage($phone, $message);

                            if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {

                                if($classarry[1] == 3) {
                                    $challanprefix 	= 1000014000;
                                } else {
                                    $challanprefix 	= 1000014011;
                                }
                                $challanNumber = $challanprefix.substr($challano, -7);
                                $msgs = 'Dear Parents
Kindly ensure to submit your child ('.($value_std['std_name']).') school fee payment month of '.get_monthtypes($idmonth).'-'.date('Y' , strtotime($issue_date)).' before due date to avoid any inconvenience In case of non payment of school fee by due date '.date('d-m-Y' , strtotime($due_date)).' fine Rs 300 will be imposed with monthly fee.

All Mobile Banking Payments 
Challan Amount Rs. '.number_format($payable).'/-
1 Bill Invoice ID: '. $challanNumber.'

https://aghosh.gptech.pk/feechallanprintwa.php?id='.$challano.'

Your cooperation is highly appreciated.


Regards:
Accounts Department
Aghosh Complex';
                                // whatsapp message
                                $datawa = array(
                                                      'status'          => 0
                                                    , 'dated'           => date("Y-m-d")
                                                    , 'challanno'       => $challano
                                                    , 'amount'          => $payable
                                                    , 'cellno'          => ($mobilenum1)
                                                    , 'message_type'    => 1
                                                    , 'message'         => $msgs
                                            );
                                $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);

                            }

						}

						//------------ Update Previous partial Challans as paid ----------------
						// $sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
						// 											status	= '1'
						// 											WHERE challan_no IN ($prev_challans)
						// 											AND status = '4'
						// 									");

						//------------ Update Previous pending Challans as UNPAID ----------------
						// $sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
						// 											status	= '3'
						// 											WHERE challan_no IN ($prev_challans)
						// 											AND status = '2'
						// 									");
					}
				}
			}
			if($sqllmsChallan){ 
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
				$_SESSION['msg']['type'] 	= 'success';
				header("Location: bulkChallanDetailPrint.php?yearmonth=".$yearmonth."&id_class=".$_POST['id_class']."&class=".$value_feesetup['class_name']."", true, 301);
				exit();
			}else{
				$_SESSION['msg']['title'] 	= 'Error';
				$_SESSION['msg']['text'] 	= 'Class Challans Already Generated';
				$_SESSION['msg']['type'] 	= 'error';
				header("Location: fee_challans.php?view=bulk", true, 301);
				exit();
			}
		}
		else{	
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'No Challan Generated';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: fee_challans.php", true, 301);
			exit();
		}

	
} 

//	Single Fee Challans Genrate
if(isset($_POST['one_challan_generate'])){ 
	// echo '<pre>';
	// print_r($_POST);exit;
	
	if($_POST['is_orphan'] != 1 && $_POST['is_orphan_approved'] != 1 && $_POST['total_amount'] > 0){			   
		//------------------------Reformat Date------------------------
		$challandate= substr(date('Y'),2,4);
		$issue_date	= date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
		$due_date 	= date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
		$yearmonth 	= date('Y-m', strtotime(cleanvars($_POST['yearmonth'])));
		$year 		= date('y', strtotime(cleanvars($_POST['yearmonth'])));
		$idyear 		 = date('Y', strtotime(cleanvars($_POST['yearmonth'])));
		$idmonth 	= date('n', strtotime(cleanvars($_POST['yearmonth'])));
		//------------------------------------------------	

		//-------- If Challan Not Exsist Then Genrate ---------
		$sqllmscheck  = $dblms->querylms("SELECT id_std
											FROM ".FEES." 
											WHERE	id_std	=	'".cleanvars($_POST['id_std'])."'
											AND	yearmonth	=	'".cleanvars($yearmonth)."'
											AND id_session	=	'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
											AND is_deleted	=	'0'
										");	
		if(mysqli_num_rows($sqllmscheck) == 0){

			// challan no
			do {
				$challano = '9930'.$year.mt_rand(10000,99999);
				$sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
				$sqlCheck	= $dblms->querylms($sqlChallan);
			} while (mysqli_num_rows($sqlCheck) > 0);

			//----------------------------Fine-------------------------
			$month = ($idmonth - 1);
			$sql_fine	= $dblms->querylms("SELECT SUM(amount) as fine
												FROM ".SCHOLARSHIP." 
												WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												AND id_type = '3' AND status = '1' AND is_deleted != '1'
												AND id_std = '".cleanvars($_POST['id_std'])."' AND challan_no = ''
												AND  YEAR(date) = '".$idyear."'
												AND  MONTH(date) = '".$idmonth."' ");
			$values_fine = 	mysqli_fetch_array($sql_fine);

			//---------------------- Make -------------------------
			$sqllms  = $dblms->querylms("INSERT INTO ".FEES."(
																  status
																, id_type
																, challan_no 
																, id_session 
																, id_month
																, yearmonth
																, id_class 
																, id_section
																, id_std
																, issue_date
																, due_date
																, note 
																, id_campus
																, id_added
																, date_added
															)
														VALUES(
																  '2'
																, '2'
																, '".cleanvars($challano)."'
																, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
																, '".cleanvars($idmonth)."'
																, '".cleanvars($yearmonth)."'
																, '".cleanvars($_POST['id_class'])."'
																, '".cleanvars($_POST['id_section'])."'
																, '".cleanvars($_POST['id_std'])."'
																, '".cleanvars($issue_date)."' 
																, '".cleanvars($due_date)."'
																, '".cleanvars($_POST['note'])."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, Now()	
															)"
													);

			//-------------------------Fee Particulars Detail-----------------------
			if($sqllms) { 
				//----------------- Get latest Id -------------------- 
				$idsetup = $dblms->lastestid();	
				//--------------------------------
				$concession = 0;
				$totalAmount = 0;
				// $payable = 0;
				//--------------------------------------
				for($i=1; $i<= count($_POST['id_cat']); $i++){
					if($_POST['amount'][$i] > 0) {
						$sqllmsPart = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																		  id_fee
																		, id_cat
																		, amount						
																	)
																VALUES(
																		  '".cleanvars($idsetup)."'
																		, '".cleanvars($_POST['id_cat'][$i])."'
																		, '".cleanvars($_POST['amount'][$i])."'			
																	)
															");
						if($_POST['id_cat'][$i] == 13 || $_POST['id_cat'][$i] == 14){
							$totalAmount += 0;
						}								
						elseif($_POST['id_cat'][$i] == 17){
							$totalAmount = $totalAmount - $_POST['amount'][$i];
						}else{
							$totalAmount = $totalAmount + $_POST['amount'][$i];
						}	
					}
				}
				// echo $totalAmount;exit;
				//	PREVIOUS CHALLANS AMOUNT AND FINE
				// $rem_challan = cleanvars($_POST['rem_challan']);
				// $prev_challans = cleanvars($_POST['prev_challans']);
				// $narration = $prev_challans.','.$rem_challan;
				// $prev_remaining_amount = cleanvars($_POST['prev_total']);

				//------------ Update Total Amount ----------------

                if($_POST['whatsappno']) {

                    if($_POST['idclassgroup'] == 3) {
                        $challanprefix 	= 1000014000;
                    } else {
                        $challanprefix 	= 1000014011;
                    }
                    $challanNumber = $challanprefix.substr($challano, -7);
                    $msgs = 'Dear Parents
								Kindly ensure to submit your child ('.($_POST['stdname']).') school fee payment month of '.$_POST['monthname'].'-'.date('Y' , strtotime($issue_date)).' before due date to avoid any inconvenience In case of non payment of school fee by due date '.date('d-m-Y' , strtotime($due_date)).' fine Rs 300 will be imposed with monthly fee.

								All Mobile Banking Payments 
								Challan Amount Rs. '.number_format($totalAmount).'/-
								1 Bill Invoice ID: '. $challanNumber.'

								https://aghosh.gptech.pk/feechallanprintwa.php?id='.$challano.'

								Your cooperation is highly appreciated.


							Regards:
							Accounts Department
							Aghosh Complex';
                    // whatsapp message
                    $datawa = array(
                                          'status'         => 0
                                        , 'dated'           => date("Y-m-d")
                                        , 'challanno'       => $challano
                                        , 'amount'          => $totalAmount
                                        , 'cellno'          => ($_POST['whatsappno'])
                                        , 'message_type'    => 1
                                        , 'message'         => $msgs
                                    );
                    $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);

                }

				$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET  
															total_amount	= '".cleanvars($totalAmount)."'
															WHERE id		= '".$idsetup."'
													");

				//------------ Update Previous partial Challans as Paid ----------------
				// $sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
				// 											status		= '1'
				// 											WHERE challan_no IN ($prev_challans)
				// 											AND status = '4'
				// 									");

				//------------ Update Previous pending Challans as UNPAID ----------------
				// $sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
				// 											status		= '3'
				// 											WHERE challan_no IN ($prev_challans)
				// 											AND status = '2'
				// 									");

				//------------ Scholarship Added in Challan ----------------
				$sqllmsUpdate  = $dblms->querylms("UPDATE ".SCHOLARSHIP." SET  
														challan_no	= '".cleanvars($challano)."'
														WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
														AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
														AND id_type = '3' AND status = '1' AND is_deleted != '1'
														AND id_std = '".cleanvars($_POST['id_std'])."' AND challan_no = ''
														AND  YEAR(date) = '".$idyear."'
														AND  MONTH(date) = '".$idmonth."' ");

				//-------------------- Make Log ------------------------
				$remarks = "Single Fee Challan Genrated";
				$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
															  id_user 
															, filename 
															, action
															, challan_no
															, dated
															, ip
															, remarks 
															, id_campus				
														)

													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
															, '1'
															, '".cleanvars($challano)."'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														)
												");
			}
		}
		else{
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: fee_challans.php", true, 301);
			exit();
		}
		//--------------------------------------

		if($sqllms) { 
			
			// Send Message
			$phone = str_replace("-","",$_POST['std_phone']);
			$message = 'Dear Parents,'.PHP_EOL.''.PHP_EOL.'Your child fee challan # '.cleanvars($challano).' for the month '.get_monthtypes($idmonth).' of amount '.number_format($totalAmount).' with due date '.date('d-m-Y' , strtotime(cleanvars($_POST['due_date']))).' has been issued.'.PHP_EOL.''.PHP_EOL.'Thanks,'.PHP_EOL.'Aghosh Grammar School';
			//sendMessage($phone, $message);		

			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: feechallanprint.php?id=".$challano."", true, 301);
			exit();
			//--------------------------------------
		}
	}
	else{
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Challan not genrated.';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: fee_challans.php", true, 301);
		exit();
	}	
}

//	Update Single Fee Challan
if(isset($_POST['changes_challan'])){ 

	//------------------------------------
	if($_POST['status'] == 1){
		$paidAmount = $_POST['payable'];
		if(!empty($_POST['paid_date'])){
			$paidDate = date('Y-m-d' , strtotime($_POST['paid_date']));
		}else{
			$paidDate = date('Y-m-d');
		}
	}else{
		$paidAmount = 0;
		$paidDate = "0000-00-00";
	}
	//------------------------------------
	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
			//----------------- Update Chllan ---------------------
		$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET 
											  total_amount	= '".cleanvars($_POST['total_amount'])."'
											, due_date		= '".cleanvars($due_date)."'
											, note			= '".cleanvars($_POST['note'])."'
											, id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, date_modify	= NOW()
										  	  WHERE id		= '".cleanvars($_POST['id_fee'])."'
											");

		//------------ If Remaining Amount ---------------
		
		//----------- FINE --------------------
		$sql_remaining	= $dblms->querylms("SELECT amount
												FROM ".FEE_PARTICULARS."
												WHERE id_fee = '".cleanvars($_POST['id_fee'])."' 
												AND id_cat = '14' LIMIT 1");
		if(mysqli_num_rows($sql_remaining) > 0){
			//---------- Update The Remaining Fee -------------
			$sqllmsRemUpdate = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
															amount	= '".cleanvars($_POST['fine'])."'
															WHERE id_fee	= '".cleanvars($_POST['id_fee'])."'
															AND id_cat	= '14'
														");
			//----------- Log Remarks ---------------
			$remarks = 'Fee Challan Paid, update FINE: '.cleanvars($_POST['fine']).'';
		}
		
		//----------- Reamining Fee --------------------
		$sql_remaining	= $dblms->querylms("SELECT amount
												FROM ".FEE_PARTICULARS."
												WHERE id_fee = '".cleanvars($_POST['id_fee'])."' 
													AND id_cat = '13' LIMIT 1");
		if(mysqli_num_rows($sql_remaining) > 0){
			//---------- Update The Remaining Fee -------------
			$sqllmsRemUpdate = $dblms->querylms("UPDATE ".FEE_PARTICULARS." SET 
																amount	= '".cleanvars($_POST['remaining_amount'])."'
														WHERE id_fee	= '".cleanvars($_POST['id_fee'])."'
															AND id_cat	= '13'
														");
			//----------- Log Remarks ---------------
			$remarks = 'Fee Challan update with Remaining Amount: '.cleanvars($_POST['remaining_amount']).'';

		} else if($_POST['remaining_amount'] > 0) {
			//---------- Insert The Remaining Fee -------------
			$sqllmsRemInsert = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																id_fee		,
																id_cat		, 
																amount		

															)
														VALUES(
																'".cleanvars($_POST['id_fee'])."'			,
																'13'										,
																'".cleanvars($_POST['remaining_amount'])."'
															)" );
			//----------- Log Remarks ---------------
			$remarks = 'Fee Challan update, Add Remaining Amount: '.cleanvars($_POST['remaining_amount']).'';

		} else{
			//----------- Log Remarks ---------------
			$remarks = 'Fee Challan update with Amount '.cleanvars($_POST['total_amount']).'.';
		}

		if($sqllmsUpdate) 
		{
			//-------------------- Make Log ------------------------
			$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																id_user 				, 
																filename				, 
																action					,
																challan_no 				,
																dated					,
																ip						,
																remarks					, 
																id_campus				
															)VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																'3'																	, 
																'".cleanvars($_POST['challan_no'])."'									,
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'											,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
															)");
			
			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: $requestedPage", true, 301);
			exit();
		}
	
}

//	Add Payment Fee Challan
if(isset($_POST['add_payment'])){
	//------------------------------------
	if(!empty($_POST['totaltransamount'])){
		if(!empty($_POST['paid_date'])){
			$paidDate = date('Y-m-d' , strtotime($_POST['paid_date']));
		}else{
			$paidDate = date('Y-m-d');
		}
	}else{
		$paidDate = "0000-00-00";
	}
	//------------------------------------
	$due_date = date('Y-m-d' , strtotime($_POST['due_date']));
	$grandTotal = $_POST['grandTotal'];

	// FULL PAYMENT
	if($_POST['totaltransamount'] >= $grandTotal){
		$totaltransamount = $_POST['totaltransamount'];
		
		// UPDATE PREVIOUS MONTH CHALLAN
		$sqlnar  = $dblms->querylms("SELECT f.id, f.challan_no, f.total_amount, f.paid_amount, f.due_date
										FROM ".FEES." f
										WHERE f.due_date   <= '".cleanvars($due_date)."'
										AND f.id_month	   != '".cleanvars($idmonth)."'
										AND f.id_std		= '".cleanvars($_POST['id_std'])."'
										AND (f.status = '2' OR f.status = '4')
										AND f.is_deleted	= '0'
										AND f.id_type		= '2'
										ORDER BY f.id ASC
									");
		if(mysqli_num_rows($sqlnar)>0){
			while($rownar = mysqli_fetch_array($sqlnar)){
				$payable = ($rownar['total_amount'] - $rownar['paid_amount']);

				if($rownar['due_date']<date('Y-m-d')){
					$payable = $payable + LATEFEE;
				}
				
				$final_paid = ($payable + $rownar['paid_amount']);

				//------------ Update Previous pending Challans as Paid ----------------
				$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
															  status			= '1'
															, paid_amount		= '".cleanvars($final_paid)."'
															, paid_date			= '".cleanvars($paidDate)."'
															, pay_mode			= '".cleanvars($_POST['pay_mode'])."'
															, note				= '".cleanvars($_POST['note'])."'
															, date_modify		= NOW()
															  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
													");
				if($sqllmsUpdatePrev){
					// UPDATE REMAINING BALANCE
					$totaltransamount = ($totaltransamount - $payable);
					
					//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
					$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
					$values_trans_head = mysqli_fetch_array($sqllms_head);

					$remarks = 'Fee Challan Paid';

					//------------------- Add INCOME ----------------------
					$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																		  trans_status 
																		, trans_title
																		, trans_type
																		, trans_amount
																		, voucher_no
																		, trans_method
																		, trans_note
																		, receipt_no
																		, book_no
																		, dated
																		, id_head
																		, id_campus  
																		, id_added  
																		, date_added 	
																	)
																VALUES(
																		  '1'	 
																		, '".cleanvars($rownar['challan_no'])."'
																		, '".cleanvars($_POST['pay_mode'])."'
																		, '".cleanvars($payable)."'
																		, '".cleanvars($rownar['challan_no'])."'
																		, '1'
																		, '".cleanvars($_POST['note'])."'
																		, '".cleanvars($_POST['receipt_no'])."'
																		, '".cleanvars($_POST['book_no'])."'
																		, '".cleanvars($paidDate)."'
																		, '".cleanvars($values_trans_head['head_id'])."'
																		, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																		, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																		, NOW()	
																	)"
											);
					
					//-------------------- Make Log ------------------------
					$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																		  id_user 
																		, filename 
																		, action
																		, challan_no
																		, dated
																		, ip
																		, remarks 
																		, id_campus				
																	)
					
																VALUES(
																		  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																		, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																		, '3'
																		, '".cleanvars($rownar['challan_no'])."'
																		, NOW()
																		, '".cleanvars($ip)."'
																		, '".cleanvars($remarks)."'
																		, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																	)
												");
				}
			}
		}
		
		// UPDATE CURRENT MONTH CHALLAN
		if($totaltransamount>0){
			$final_paid = ($totaltransamount + $_POST['paid_amount']);

			$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
														  status    	    = '1'
														, paid_date		    = '".cleanvars($paidDate)."'
														, paid_amount	    = '".cleanvars($final_paid)."'
														, pay_mode			= '".cleanvars($_POST['pay_mode'])."' 
														, note				= '".cleanvars($_POST['note'])."'
														, date_modify	    = NOW()
														  WHERE challan_no	= '".cleanvars($_POST['challan_no'])."' "
											);
			if($sqllmsupdate){

				// Send Message
				$phone = str_replace("-","",$_POST['std_phone']);
				$message = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($_POST['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
				//sendMessage($phone, $message);
				
				//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
				$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
				$values_trans_head = mysqli_fetch_array($sqllms_head);

				$remarks = 'Fee Challan Paid';

				//------------------- Add INCOME ----------------------
				$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																	trans_status 
																	, trans_title
																	, trans_type
																	, trans_amount
																	, voucher_no
																	, trans_method
																	, trans_note
																	, receipt_no
																	, book_no
																	, dated
																	, id_head
																	, id_campus  
																	, id_added  
																	, date_added 	
																)
															VALUES(
																	'1'	 
																	, '".cleanvars($_POST['challan_no'])."'
																	, '".cleanvars($_POST['pay_mode'])."'
																	, '".cleanvars($totaltransamount)."'
																	, '".cleanvars($_POST['challan_no'])."'
																	, '1'
																	, '".cleanvars($_POST['note'])."'	
																	, '".cleanvars($_POST['receipt_no'])."'	
																	, '".cleanvars($_POST['book_no'])."'				
																	, '".cleanvars($paidDate)."'
																	, '".cleanvars($values_trans_head['head_id'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, NOW()	
																)"
										);
				
				//-------------------- Make Log ------------------------
				$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																	id_user 
																	, filename 
																	, action
																	, challan_no
																	, dated
																	, ip
																	, remarks 
																	, id_campus				
																)
				
															VALUES(
																	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																	, '3'
																	, '".cleanvars($_POST['challan_no'])."'
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
											");
											
				$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
				//--------------------------------------
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Payment Successfully Added.';
				$_SESSION['msg']['type'] 	= 'success';
				// header("Location: feedepositslip.php?receipt_no=".$_POST['receipt_no']."&&book_no=".$_POST['book_no']."&&grandTotal=".$grandTotal."", true, 301);
				header("Location: $requestedPage", true, 301);
				exit();
				//--------------------------------------
			}
		}
	}

	// PARTIAL PAYMENT
	elseif($_POST['totaltransamount'] > 0){
		$totaltransamount = $_POST['totaltransamount'];

		// Update Previous pending Challans as Paid or Partial Paid
		$sqlnar  = $dblms->querylms("SELECT f.id, f.challan_no, f.total_amount, f.paid_amount, f.due_date
										FROM ".FEES." f
										WHERE f.due_date   <= '".cleanvars($due_date)."'
										AND f.id_month	   != '".cleanvars($idmonth)."'
										AND f.id_std		= '".cleanvars($_POST['id_std'])."'
										AND (f.status = '2' OR f.status = '4')
										AND f.is_deleted    = '0'
										AND f.id_type		= '2'
										ORDER BY f.id ASC
									");
		if(mysqli_num_rows($sqlnar)>0){
			while($rownar = mysqli_fetch_array($sqlnar)){

				$payable = $rownar['total_amount'] - $rownar['paid_amount'];

				if($rownar['due_date']<date('Y-m-d')){
					$payable = $payable+LATEFEE;
				}

				// FULL PAID
				if($totaltransamount>=$payable){
					$final_paid = $payable + $rownar['paid_amount'];
					//Update pending as Paid
					$sqllmsUpdatePrev  = $dblms->querylms("UPDATE ".FEES." SET
															  status			= '1'
															, paid_amount		= '".cleanvars($final_paid)."'
															, paid_date			= '".cleanvars($paidDate)."'
															, pay_mode			= '".cleanvars($_POST['pay_mode'])."' 
															, note				= '".cleanvars($_POST['note'])."'
															, date_modify		= NOW()
															  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
													");
					if($sqllmsUpdatePrev){
						$totaltransamount = $totaltransamount - $payable;

						//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
						$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
						$values_trans_head = mysqli_fetch_array($sqllms_head);

						$remarks = 'Fee Challan Paid';

						//------------------- Add INCOME ----------------------
						$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																			trans_status 
																			, trans_title
																			, trans_type
																			, trans_amount
																			, voucher_no
																			, trans_method
																			, trans_note
																			, receipt_no
																			, book_no
																			, dated
																			, id_head
																			, id_campus  
																			, id_added  
																			, date_added 	
																		)
																	VALUES(
																			'1'	 
																			, '".cleanvars($rownar['challan_no'])."'
																			, '".cleanvars($_POST['pay_mode'])."'
																			, '".cleanvars($payable)."'
																			, '".cleanvars($rownar['challan_no'])."'
																			, '1'
																			, '".cleanvars($_POST['note'])."'
																			, '".cleanvars($_POST['receipt_no'])."'
																			, '".cleanvars($_POST['book_no'])."'				
																			, '".cleanvars($paidDate)."'
																			, '".cleanvars($values_trans_head['head_id'])."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																			, NOW()	
																		)"
												);
						
						//-------------------- Make Log ------------------------
						$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																			id_user 
																			, filename 
																			, action
																			, challan_no
																			, dated
																			, ip
																			, remarks 
																			, id_campus				
																		)
						
																	VALUES(
																			'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																			, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																			, '3'
																			, '".cleanvars($rownar['challan_no'])."'
																			, NOW()
																			, '".cleanvars($ip)."'
																			, '".cleanvars($remarks)."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																		)
													");
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
															, paid_date			= '".cleanvars($paidDate)."'
															, pay_mode			= '".cleanvars($_POST['pay_mode'])."' 
															, note				= '".cleanvars($_POST['note'])."' 
															, date_modify		= NOW()
															  WHERE challan_no	= '".cleanvars($rownar['challan_no'])."'
													");
					if($sqllmsUpdatePrev){
						$totaltransamount = $totaltransamount - $payable;

						//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
						$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
						$values_trans_head = mysqli_fetch_array($sqllms_head);

						$remarks = 'Fee Challan Paid';

						//------------------- Add INCOME ----------------------
						$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																			trans_status 
																			, trans_title
																			, trans_type
																			, trans_amount
																			, voucher_no
																			, trans_method
																			, trans_note
																			, receipt_no
																			, book_no
																			, dated
																			, id_head
																			, id_campus  
																			, id_added  
																			, date_added 	
																		)
																	VALUES(
																			'1'	 
																			, '".cleanvars($rownar['challan_no'])."'
																			, '".cleanvars($_POST['pay_mode'])."'
																			, '".cleanvars($payable)."'
																			, '".cleanvars($rownar['challan_no'])."'
																			, '1'
																			, '".cleanvars($_POST['note'])."'
																			, '".cleanvars($_POST['receipt_no'])."'
																			, '".cleanvars($_POST['book_no'])."'				
																			, '".cleanvars($paidDate)."'
																			, '".cleanvars($values_trans_head['head_id'])."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																			, NOW()	
																		)"
												);
						
						//-------------------- Make Log ------------------------
						$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																			id_user 
																			, filename 
																			, action
																			, challan_no
																			, dated
																			, ip
																			, remarks 
																			, id_campus				
																		)
						
																	VALUES(
																			'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																			, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																			, '3'
																			, '".cleanvars($rownar['challan_no'])."'
																			, NOW()
																			, '".cleanvars($ip)."'
																			, '".cleanvars($remarks)."'
																			, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																		)
													");
					}
				}
			}
		}

		// Update Current pending Challans as Paid or Partial Paid
		$payable = $_POST['total_amount'] - $_POST['paid_amount'];

		if($_POST['dueDate']<date('Y-m-d')){
			$payable = $payable + LATEFEE;
		}

		// FULL PAID
		if($totaltransamount>=$payable){
			$payable = $totaltransamount;
			$final_paid = $payable + $_POST['paid_amount'];
			// Update Pending as Paid
			$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
													  status    	    = '1'
													, paid_date		    = '".cleanvars($paidDate)."'
													, paid_amount	    = '".cleanvars($final_paid)."'
													, pay_mode			= '".cleanvars($_POST['pay_mode'])."' 
													, note				= '".cleanvars($_POST['note'])."' 
													, date_modify	    = NOW()
													  WHERE challan_no	= '".$_POST['challan_no']."' "
										);
			if($sqllmsupdate){
				// Send Message
				$phone = str_replace("-","",$_POST['std_phone']);
				$message = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($_POST['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
			//	sendMessage($phone, $message);
				
				//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
				$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
				$values_trans_head = mysqli_fetch_array($sqllms_head);
	
				$remarks = 'Fee Challan Paid';
	
				//------------------- Add INCOME ----------------------
				$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																		trans_status 
																	, trans_title
																	, trans_type
																	, trans_amount
																	, voucher_no
																	, trans_method
																	, trans_note
																	, receipt_no
																	, book_no
																	, dated
																	, id_head
																	, id_campus  
																	, id_added  
																	, date_added 	
																)
															VALUES(
																		'1'	 
																	, '".cleanvars($_POST['challan_no'])."'
																	, '".cleanvars($_POST['pay_mode'])."'
																	, '".cleanvars($payable)."'
																	, '".cleanvars($_POST['challan_no'])."'
																	, '1'
																	, '".cleanvars($_POST['note'])."'
																	, '".cleanvars($_POST['receipt_no'])."'
																	, '".cleanvars($_POST['book_no'])."'				
																	, '".cleanvars($paidDate)."'
																	, '".cleanvars($values_trans_head['head_id'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, NOW()	
																)"
										);
				
				//-------------------- Make Log ------------------------
				$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																		id_user 
																	, filename 
																	, action
																	, challan_no
																	, dated
																	, ip
																	, remarks 
																	, id_campus				
																)
				
															VALUES(
																		'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																	, '3'
																	, '".cleanvars($_POST['challan_no'])."'
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
											");
											
				$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
				//--------------------------------------
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Payment Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: feedepositslip.php?receipt_no=".$_POST['receipt_no']."&&book_no=".$_POST['book_no']."&&grandTotal=".$grandTotal."", true, 301);
				// header("Location: $requestedPage", true, 301);
				exit();
				//--------------------------------------
			}
		}
		
		// PARTIAL PAID
		elseif($totaltransamount>0){
			$payable = $totaltransamount;
			$final_paid = $payable + $_POST['paid_amount'];
			// Update Pending as Partial Paid
			$sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
													  status    	    = '4'
													, paid_date		    = '".cleanvars($paidDate)."'
													, paid_amount	    = '".cleanvars($final_paid)."'
													, pay_mode			= '".cleanvars($_POST['pay_mode'])."' 
													, note				= '".cleanvars($_POST['note'])."'
													, date_modify	    = NOW()
													  WHERE challan_no	= '".$_POST['challan_no']."' "
										);
			if($sqllmsupdate){
				// Send Message
				$phone = str_replace("-","",$_POST['std_phone']);
				$message = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($_POST['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
				//sendMessage($phone, $message);
				
				//-------------------GET FEE HEAD FROM ACCOUNT HEADS------------------------
				$sqllms_head	= $dblms->querylms("SELECT head_id FROM ".ACCOUNT_HEADS." WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND head_name LIKE '%fee%'");
				$values_trans_head = mysqli_fetch_array($sqllms_head);
	
				$remarks = 'Fee Challan Paid';
	
				//------------------- Add INCOME ----------------------
				$sqllms  = $dblms->querylms("INSERT INTO ".ACCOUNT_TRANS."(
																	  trans_status 
																	, trans_title
																	, trans_type
																	, trans_amount
																	, voucher_no
																	, trans_method
																	, trans_note
																	, receipt_no
																	, book_no
																	, dated
																	, id_head
																	, id_campus  
																	, id_added  
																	, date_added 	
																)
															VALUES(
																	  '1'	 
																	, '".cleanvars($_POST['challan_no'])."'
																	, '".cleanvars($_POST['pay_mode'])."'
																	, '".cleanvars($payable)."'
																	, '".cleanvars($_POST['challan_no'])."'
																	, '1'
																	, '".cleanvars($_POST['note'])."'	
																	, '".cleanvars($_POST['receipt_no'])."'	
																	, '".cleanvars($_POST['book_no'])."'				
																	, '".cleanvars($paidDate)."'
																	, '".cleanvars($values_trans_head['head_id'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, NOW()	
																)"
										);
				
				//-------------------- Make Log ------------------------
				$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																	  id_user 
																	, filename 
																	, action
																	, challan_no
																	, dated
																	, ip
																	, remarks 
																	, id_campus				
																)
				
															VALUES(
																	  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																	, '3'
																	, '".cleanvars($_POST['challan_no'])."'
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
											");
											
				$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
				//--------------------------------------
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Payment Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: feedepositslip.php?receipt_no=".$_POST['receipt_no']."&&book_no=".$_POST['book_no']."&&grandTotal=".$grandTotal."", true, 301);
				// header("Location: $requestedPage", true, 301);
				exit();
				//--------------------------------------
			}
		}

		// STILL PENDING
		else{
			$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
			//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Payment Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: feedepositslip.php?receipt_no=".$_POST['receipt_no']."&&book_no=".$_POST['book_no']."&&grandTotal=".$grandTotal."", true, 301);
			// header("Location: $requestedPage", true, 301);
			exit();
		}
	}
}

//	Update Partial Payment
if(isset($_POST['changes_partialPayment'])){ 

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

	// echo "Partial Amount".$_POST['partial_amount']."Rem Amount: ".$_POST['remaining_amount'];
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
		$remarks = 'Fee Challan Partial Payment Added of Amount: '.cleanvars($_POST['partial_amount']).' and Remainings: '.cleanvars($_POST['remaining_amount']).'';
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

//	Delete record
if(isset($_GET['deleteid'])){ 
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".FEES." SET  
												  is_deleted		= '1'
												, id_deleted		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												, ip_deleted		= '".$ip."'
												, date_deleted		= NOW()
												  WHERE challan_no	= '".cleanvars($_GET['deleteid'])."'");
	//--------------------------------------
	if($sqllms){ 
		//-------------------- Make Log ------------------------
		$remarks = 'Fee Challan Deleted #: "'.cleanvars($_GET['deleteid']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
																id_user 
															, filename 
															, action
															, challan_no
															, dated
															, ip
															, remarks 
															, id_campus				
														)
		
													VALUES(
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
															, '3' 
															, '".cleanvars($_GET['deleteid'])."'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														)
									");

		
		$requestedPage = strstr(basename($_SERVER['REQUEST_URI']), '.php', true).'.php';
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: $requestedPage", true, 301);
		exit();
	}
	//--------------------------------------
}

//	Update Due Date In Bulk
if(isset($_POST['update_duedate'])){ 

	$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));

	//----------------- Update Challans ---------------------
	$sqllms  = $dblms->querylms("UPDATE ".FEES." SET  
											due_date	= '".cleanvars($due_date)."'
										,	id_modify	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										, 	date_modify	= NOW()
									  WHERE status		= '2'
									  	AND	paid_date	= '0000-00-00' 
										AND id_type     IN (1,2)");

	if($sqllms) {
		// Make Log
		$remarks = 'All Pending Challans Due Date Update';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
															id_user 				, 
															filename				, 
															action					,
															challan_no 				,
															dated					,
															ip						,
															remarks					, 
															id_campus				
														) VALUES (
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
															'3'																	, 
															'All Pending Challans'												,
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