<?php 

//---------------- Bulk Fee Challans Genrate ----------------------
if(isset($_POST['challans_generate'])) { 

	$srno = 0;
	$tuitionFee = 0;
	//------------------------Reformat Date------------------------
	$challandate = substr(date('Y'),2,4);
	$issue_date = date('Y-m-d');
	$due_date 	= date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
	//------------------------------------------------
	//---------- Check If Fee Structure Added ----------------
	$sqllmsfeesetup	= $dblms->querylms("SELECT f.id, f.dated, f.id_class, f.id_section, f.id_session, c.class_name				     
									FROM ".FEESETUP." f
									INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
									WHERE f.status = '1' AND f.id_class = '".cleanvars($_POST['id_class'])."' AND f.is_deleted != '1'
									AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
									AND f.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									ORDER BY f.id DESC LIMIT 1");
	//-----------------------------------------------------
	if(mysqli_num_rows($sqllmsfeesetup) > 0){
		//-----------------------------------------------------
		$value_feesetup = mysqli_fetch_array($sqllmsfeesetup);
		//-----------------------------------------------------
		
		//----------------------- Tuition Fee ------------------------
		$sqllmsTuit	= $dblms->querylms("SELECT 	id, amount, duration
											FROM ".FEESETUPDETAIL." d
											WHERE id_setup = '".$value_feesetup['id']."'
											AND id_cat = '2'
											LIMIT 1");
		$valTuition = mysqli_fetch_array($sqllmsTuit);
		$tuitionFee = $valTuition['amount'];
		
		//----------------------- Total Pkg ------------------------
		$sqllmsTotPkg	= $dblms->querylms("SELECT	SUM(amount) as totPkg
											FROM ".FEESETUPDETAIL." d
											WHERE d.id_setup = '".$value_feesetup['id']."'
											AND (d.duration != 'Select' OR d.duration = '') 
											AND id_cat NOT IN (1,4,5) ");
		$valTotPkg = mysqli_fetch_array($sqllmsTotPkg);
		$totPkg = $valTotPkg['totPkg'];
		// echo "Tot:".$totPkg."<br>";
		
		//-------------------- Total Pkg With Hostel ---------------------
		$sqllmsHostTotPkg	= $dblms->querylms("SELECT	SUM(amount) as totHostPkg
											FROM ".FEESETUPDETAIL." d
											WHERE d.id_setup = '".$value_feesetup['id']."'
											AND (d.duration != 'Select' OR d.duration = '') 
										");
		$valHostTotPkg = mysqli_fetch_array($sqllmsHostTotPkg);
		// echo "Host:".$valHostTotPkg['totHostPkg']."<br>";

		//------------ Check Students & No Challan -------------	
		$sqllmsstudent	= $dblms->querylms("SELECT s.std_id, s.std_name, s.is_hostelized, s.std_phone, s.transport_fee
												FROM ".STUDENTS." s
												WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
												AND s.id_class = '".cleanvars($_POST['id_class'])."'
												AND s.is_orphan != '1' AND s.is_orphan_approved != '1'
												AND s.std_status = '1' AND s.is_deleted != '1' 
											");
		$no = 0;
		
		if(mysqli_num_rows($sqllmsstudent) > 0) {
			while($value_std = mysqli_fetch_array($sqllmsstudent)) {

				// echo "<br><br>std_id".$value_std['std_id']."<br>";

				//------------ Check Challan Already Genrated -------------
				$sqllmsPrevChallan = $dblms->querylms("SELECT f.id
												FROM ".FEES." f
												WHERE f.id_std = '".cleanvars($value_std['std_id'])."'
												AND f.id_month = '".cleanvars($_POST['id_month'])."'
												AND f.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
												AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
												AND f.is_deleted != '1'
											");
				if(mysqli_num_rows($sqllmsPrevChallan) == 0) {

					$no++;
					$amount = 0;
					$payable = 0;
					$tot_concession_scholarship = 0;
					//----------------------- Scholarship -----------------------
					$sql_scholarship = $dblms->querylms("SELECT SUM(percent) as scholarship
															FROM ".SCHOLARSHIP." 
															WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
															AND   id_type = '1' AND status = '1' AND is_deleted != '1'
															AND   id_std = '".$value_std['std_id']."' ");
					$values_scholarship = mysqli_fetch_assoc($sql_scholarship);
					//-------------------- Sch Amount ---------------------
					$schAmount = ($tuitionFee * $values_scholarship['scholarship']) / 100;
					//-----------------------------------------------------

					
					// //----------------------- Tot Pkg Concession ------------------------
					// $sqlPkgConcess	= $dblms->querylms("SELECT SUM(percent) as concession, SUM(amount) as conc_amount
					// 										FROM ".SCHOLARSHIP." 
					// 										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
					// 										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
					// 										AND id_type = '2' AND consession_on = '1' AND status = '1' AND is_deleted != '1'
					// 										AND id_std = '".$value_std['std_id']."' ");
					// $valuesPkgConcess = mysqli_fetch_array($sqlPkgConcess);
					// //-------------------- Conc Amount ---------------------
					// $valuesPkgConcess['concession'];
					// $pkgConsAmount = ($totPkg * $valuesPkgConcess['concession']) / 100;
					// $totPkgConsAmount = $pkgConsAmount + $valuesPkgConcess['conc_amount'];
					// //-----------------------------------------------------

					// //----------------------- Tution Fee Concession ------------------------
					// $sqlTutConcess	= $dblms->querylms("SELECT SUM(percent) as concession, SUM(amount) as conc_amount
					// 										FROM ".SCHOLARSHIP." 
					// 										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
					// 										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
					// 										AND id_type = '2' AND consession_on = '2' AND status = '1' AND is_deleted != '1'
					// 										AND id_std = '".$value_std['std_id']."' ");
					// $valuesTutConcess = mysqli_fetch_array($sqlTutConcess);
					// //-------------------- Conc Amount ---------------------
					// $valuesTutConcess['concession'];
					// $tutConsAmount = ($tuitionFee * $valuesTutConcess['concession']) / 100;
					// $totTutConsAmount = $tutConsAmount + $valuesTutConcess['conc_amount'];
					// //-----------------------------------------------------

					// //Total Concession From Concession & Scholarship
					// $tot_concession_scholarship = $schAmount + $totPkgConsAmount + $totTutConsAmount;

					//----------------------------Fine-------------------------
					$month = $_POST['id_month'] - 1;
					$sql_fine	= $dblms->querylms("SELECT SUM(amount) as fine
														FROM ".SCHOLARSHIP." 
														WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
														AND id_type = '3' AND status = '1' AND is_deleted != '1'
														AND id_std = '".$value_std['std_id']."' AND challan_no = ''
														AND  MONTH(date) IN ('".$month."', '".$_POST['id_month']."') ");
					//---------------- Fine Amount ------------------------
					$values_fine = 	mysqli_fetch_array($sql_fine);
					//-----------------------------------------------------

					
					//----------------- Remaining Amount ------------------
					$sqllms_rem = $dblms->querylms("SELECT remaining_amount 
														FROM ".FEES." 
														WHERE id_std = '".$value_std['std_id']."'
														AND is_deleted != '1' ORDER BY id DESC LIMIT 1");
					$row_rem = mysqli_fetch_array($sqllms_rem);

					//Check Student Hostel Registration
					$sqllmHostelRegistration	= $dblms->querylms("SELECT id 
																		FROM ".HOSTEL_REG."
																		WHERE status = '1' AND id_std = '".$value_std['std_id']."'
																		AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
					//If Hostelized Add Fee Cats
					if (mysqli_num_rows($sqllmHostelRegistration) == 1) {	
						//--------------------- Get Fee Detail -------------------------
						$sqllmsCats	= $dblms->querylms("SELECT c.cat_id, c.cat_name
															FROM ".FEE_CATEGORY." c
															WHERE c.cat_status = '1'
															AND c.cat_id NOT IN (1,4,5)
															AND c.is_deleted != '1'
															ORDER BY c.cat_ordering ASC");
					}
					else{
						$sqllmsCats	= $dblms->querylms("SELECT 	c.cat_id, c.cat_name
															FROM ".FEE_CATEGORY." c 										 
															WHERE c.cat_status = '1'
															AND c.cat_id NOT IN (1,4,5,6,7,8)
															AND c.is_deleted != '1'
															ORDER BY c.cat_ordering ASC");
					}


					$catDetails = array();  
					//-------------- Fee Details -----------------
					while($valueCats = mysqli_fetch_array($sqllmsCats)) {
						// echo $valueCats['cat_id'];
						
						$sqllmsDetail	= $dblms->querylms("SELECT 	d.id, d.amount, d.duration
															FROM ".FEESETUPDETAIL." d
															WHERE d.id_setup = '".$value_feesetup['id']."'
															AND d.duration = 'Monthly'
															AND d.id_cat = '".$valueCats['cat_id']."'
															LIMIT 1");
						$valueDetail = mysqli_fetch_array($sqllmsDetail);

						//----- If Cat Is not Previous Fee --------------
						if($valueCats['cat_id']){

							/*
							//------- Check Fee Cat According to Duration ---------
							if(cleanvars($valueDetail['duration']) == "Once"){
								$checkduedate = "";
								$sql2 = "";
							}
							else if(cleanvars($valueDetail['duration']) == "Monthly"){
								$checkduedate =  date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $issue_date) ) ));
								$sql2 = "AND f.due_date BETWEEN $checkduedate AND $issue_date AND f.id_month != '".cleanvars($_POST['id_month'])."'";
							}
							else if(cleanvars($valueDetail['duration']) == "Quartar"){
								$checkduedate =  date('Y-m-d',(strtotime ( '-91 day' , strtotime ( $issue_date) ) ));
								$sql2 = "AND f.due_date BETWEEN $checkduedate AND $issue_date";
							}
							else if(cleanvars($valueDetail['duration']) == "Half"){
								$checkduedate =  date('Y-m-d',(strtotime ( '-182 day' , strtotime ( $issue_date) ) ));
								$sql2 = "AND f.due_date BETWEEN $checkduedate AND $issue_date";
							}
							else if(cleanvars($valueDetail['duration']) == "Yearly"){
								$checkduedate =  date('Y-m-d',(strtotime ( '-365 day' , strtotime ( $issue_date) ) ));
								$sql2 = "AND f.due_date BETWEEN $checkduedate AND $issue_date";
							}
							//-----------------------------------------------------
							$sqllmsChallanCheck	= $dblms->querylms("SELECT f.id
																		FROM ".FEES." f				   
																		INNER JOIN ".FEE_PARTICULARS." d ON d.id_fee = f.id
																		WHERE f.is_deleted != '1' AND f.id_std = '".cleanvars($value_std['std_id'])."'
																		AND f.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
																		AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																		$sql2
																		AND d.id_cat = '".cleanvars($valueCats['cat_id'])."'
																	");
							//-----------------------------------------------------
							if(mysqli_num_rows($sqllmsChallanCheck) == 0){

								
							}
							*/

							// if($valueCats['cat_id'] == 2){
							// 	$amount = $valueDetail['amount'];
							// 	// if concession apply onm head
							// 	// $amount = $valueDetail['amount'] - $totTutConsAmount;
							// }
							// else if($valueCats['cat_id'] == 17){
							// 	$amount = $tot_concession_scholarship;
							// }
							// else 
							if($valueCats['cat_id'] == 13){
								$amount =$row_rem['remaining_amount'];
								$concession = 0;
							}
							else if($valueCats['cat_id'] == 14){
								$amount = $values_fine['fine'];
								$concession = 0;
							}
							else if($valueCats['cat_id'] == 16 && $value_std['transport_fee'] > 0){
								$amount = $value_std['transport_fee'];
								$concession = 0;
							}
							else{

								$sqllmsConcession = $dblms->querylms("SELECT d.amount
																		FROM ".SCH_CONCESS_DET." d
																		INNER JOIN ".SCHOLARSHIP." s ON s.id = d.id_setup
																		WHERE s.id_std = '".cleanvars($value_std['std_id'])."'
																		AND d.id_cat = '".cleanvars($valueCats['cat_id'])."' LIMIT 1");
								if(mysqli_num_rows($sqllmsConcession) > 0 && $valueDetail['amount']){
									$valueConcession = mysqli_fetch_array($sqllmsConcession);
									$concession = $valueConcession['amount'];
								}
								else{
									$concession = 0;
								}

								$amount = $valueDetail['amount'] - $concession;
							}

							$catDetails[] = array($valueCats['cat_id'], $amount, $concession);
						}
					}

					// echo json_encode($catDetails) ."std: ".cleanvars($value_std['std_id']).cleanvars($value_std['std_name']);
					// echo "tot: ".$tot_amount = array_sum(array_column($catDetails, 1))."<br><br>";
			// 	}
			// }
			// exit();

					
            		unset($valueDetail);
            		unset($sqllmsChallanCheck);
					//---------- Total Amount after substracting Concession & Scholarship ---------------
					$tot_amount = array_sum(array_column($catDetails, 1)) ;
					$payable = $tot_amount + $values_fine['fine'];

					if($payable > 0){
						//------------- Genrate Challan Number ----------------
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

						//--------------------- Challan Genrate ------------------------
						$sqllms  = $dblms->querylms("INSERT INTO ".FEES."(
																			status						, 
																			id_type						,
																			challan_no					, 
																			id_session					, 
																			id_month					,
																			id_class					, 
																			id_std						,
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
																			'2'																,
																			'".cleanvars($challano)."'										,
																			'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	, 
																			'".cleanvars($_POST['id_month'])."'								,
																			'".cleanvars($_POST['id_class'])."'								,
																			'".cleanvars($value_std['std_id'])."'							,
																			'".cleanvars($issue_date)."'									, 
																			'".cleanvars($due_date)."'										,
																			'".cleanvars($payable)."'										,
																			'".cleanvars($_POST['note'])."'									,
																			'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
																			'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
																			Now()	
																		)"
																);
					
						$genratedChallans ++;
						//-------------------------Fee Particulars Detail-----------------------
						if($sqllms) { 
							//-------------------------Get latest Id----------------------- 
							$idsetup = $dblms->lastestid();	

							foreach($catDetails as $cats){
								if($cats[1] > 0){	
									$sqllmsPart = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																								id_fee			,
																								id_cat			,
																								amount			,
																								concession							
																							)
																						VALUES(
																								'".cleanvars($idsetup)."'	,
																								'".cleanvars($cats[0])."'	,
																								'".cleanvars($cats[1])."'	,
																								'".cleanvars($cats[2])."'
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
																	AND  MONTH(date) IN ('".$month."', '".$_POST['id_month']."') ");

							//-------------------- Make Log ------------------------
							$remarks = "Challan Created from Bulk Challans";
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
																	)
															");

							$phone = str_replace("-","",$val_std['std_phone']);
							$sent++;

							// Set Credentials, Cell and MSG in Data Objects
							$data['username'] = 'demoumer';
							$data['password'] = '786786';
							$data['mask'] = 'AGS';
							$data['mobile'] = $phone;
							$data['message'] = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($challano).' for the month '.get_monthtypes($_POST['id_month']).' of amount '.number_format($payable).' with due date '.date('d-m-Y' , strtotime(cleanvars($_POST['due_date']))).' has been issued.\n\nThanks,\nAghosh Grammar School';
						
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
					}
				}
			}
			if($sqllms) { 

					$_SESSION['msg']['title'] 	= 'Successfully';
					$_SESSION['msg']['text'] 	= 'Record Successfully Added.'.$sent;
					$_SESSION['msg']['type'] 	= 'success';
					header("Location: bulkChallanDetailPrint.php?id_month=".$_POST['id_month']."&id_class=".$_POST['id_class']."&class=".$value_feesetup['class_name'].".php", true, 301);
					exit();
			}
		}
		
		else{
			
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'No Challan Genrated';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: fee_challans.php", true, 301);
			exit();
		}

	}
	else{
		
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Fee Structure of '.$value_feesetup['class_name'].' in curent session Not Added.';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: fee_challans.php", true, 301);
		exit();
	}
} 

//---------------- Single Fee Challans Genrate ----------------------
if(isset($_POST['one_challan_generate'])) { 
	
	if($_POST['is_orphan'] != 1 && $_POST['is_orphan_approved'] != 1 && $_POST['total_amount'] > 0) {			   
		//------------------------Reformat Date------------------------
		$challandate = substr(date('Y'),2,4);
		$issue_date = date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
		$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
		//------------------------------------------------	

		//-------- If Challan Not Exsist Then Genrate ---------
		$sqllmscheck  = $dblms->querylms("SELECT id_std
											FROM ".FEES." 
											WHERE id_std = '".cleanvars($_POST['id_std'])."'
											AND id_month = '".cleanvars($_POST['id_month'])."'
											AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
											AND is_deleted != '1'
										");	
		if(mysqli_num_rows($sqllmscheck) == 0)
		{
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
			//----------------------------Fine-------------------------
			$month = $_POST['id_month'] - 1;
			$sql_fine	= $dblms->querylms("SELECT SUM(amount) as fine
												FROM ".SCHOLARSHIP." 
												WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												AND id_type = '3' AND status = '1' AND is_deleted != '1'
												AND id_std = '".cleanvars($_POST['id_std'])."' AND challan_no = ''
												AND  MONTH(date) IN ('".$month."', '".$_POST['id_month']."') ");
			$values_fine = 	mysqli_fetch_array($sql_fine);
			//---------------------- Make -------------------------
			$sqllms  = $dblms->querylms("INSERT INTO ".FEES."(
																status						,
																id_type						,
																challan_no					, 
																id_session					, 
																id_month					,
																id_class					, 
																id_section					,
																id_std						,
																issue_date					,
																due_date					,
																note						, 
																id_campus 					,
																id_added					,
																date_added
															)
														VALUES(
																'2'																,
																'2'																,
																'".cleanvars($challano)."'										,
																'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	, 
																'".cleanvars($_POST['id_month'])."'								,
																'".cleanvars($_POST['id_class'])."'								,
																'".cleanvars($_POST['id_section'])."'							,
																'".cleanvars($_POST['id_std'])."'								,
																'".cleanvars($issue_date)."'									, 
																'".cleanvars($due_date)."'										,
																'".cleanvars($_POST['note'])."'									,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
																Now()	
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
																		id_fee			,
																		id_cat			,
																		amount						
																	)
																VALUES(
																		'".cleanvars($idsetup)."'				,
																		'".cleanvars($_POST['id_cat'][$i])."'	,
																		'".cleanvars($_POST['amount'][$i])."'			
																	)
															");
														
						if($_POST['id_cat'][$i] == 17){
							$totalAmount = $totalAmount - $_POST['amount'][$i];
						}else{
							$totalAmount = $totalAmount + $_POST['amount'][$i];
						}	
					}
				}

				if($values_fine['fine'] > 0){
					
					$sqllmsPart = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																	id_fee			,
																	id_cat			,
																	amount						
																)
															VALUES(
																	'".cleanvars($idsetup)."'				,
																	'14'									,
																	'".cleanvars($values_fine['fine'])."'			
																)
														");
														
					$totalAmount = $totalAmount + $values_fine['fine'];
				}


				//------------ Update Total Amount ----------------
				$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET  
														total_amount	= '".cleanvars($totalAmount)."'
												  WHERE id 				= '".$idsetup."'
													");

				//------------ Scholarship Added in Challan ----------------
				$sqllmsUpdate  = $dblms->querylms("UPDATE ".SCHOLARSHIP." SET  
														challan_no	= '".cleanvars($challano)."'
														WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
														AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
														AND id_type = '3' AND status = '1' AND is_deleted != '1'
														AND id_std = '".cleanvars($_POST['id_std'])."' AND challan_no = ''
														AND  MONTH(date) IN ('".$month."', '".$_POST['id_month']."') ");

				//-------------------- Make Log ------------------------
				$remarks = "Single Fee Challan Genrated";
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
			
			$phone = str_replace("-","",$_POST['std_phone']);

			// Set Credentials, Cell and MSG in Data Objects
			$data['username'] = 'demoumer';
			$data['password'] = '786786';
			$data['mask'] = 'AGS';
			$data['mobile'] = $phone;
			$data['message'] = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($challano).' for the month '.get_monthtypes($_POST['id_month']).' of amount '.number_format($totalAmount).' with due date '.date('d-m-Y' , strtotime(cleanvars($_POST['due_date']))).' has been issued.\n\nThanks,\nAghosh Grammar School';
		
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

//----------------Update Single Fee Chalaln----------------------
if(isset($_POST['changes_challan'])) { 

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
	if($_POST['status'] == 1){

		//----------------- Update Chllan as Paid ---------------------
		$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
												status					= '".cleanvars($_POST['status'])."'
											,	pay_mode				= '".cleanvars($_POST['pay_mode'])."'
											,	paid_date				= '".cleanvars($paidDate)."'
											,	total_amount			= '".cleanvars($_POST['payable'])."'
											,	paid_amount				= '".cleanvars($paidAmount)."'
											,	note					= '".cleanvars($_POST['note'])."'
											,	id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify				= NOW()
										WHERE   id						= '".cleanvars($_POST['id_fee'])."'
											");
		//------------ If Remaining Amount ---------------
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
			$remarks = 'Fee Challan Paid, update Remaining Amount: '.cleanvars($_POST['remaining_amount']).'';

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
			$remarks = 'Fee Challan Paid, with Remaining Amount: '.cleanvars($_POST['remaining_amount']).'';

		} else{
			//----------- Log Remarks ---------------
			$remarks = 'Fee Challan Paid.';
		}

		if($sqllms) 
		{	

			$phone = str_replace("-","",$_POST['std_phone']);

			// Set Credentials, Cell and MSG in Data Objects
			$data['username'] = 'demoumer';
			$data['password'] = '786786';
			$data['mask'] = 'AGS';
			$data['mobile'] = $phone;
			$data['message'] = 'Dear Parents,\n\nYour child fee challan # '.cleanvars($_POST['challan_no']).' has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
		
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

			//--------------------IF PAID THEN ADD IN EARNING-------------------------------
		
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
			//--------------------------------------
		}
	} else{
		//----------------- Update Chllan ---------------------
		$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET 
												total_amount		= '".cleanvars($_POST['payable'])."'
											,	due_date			= '".cleanvars($due_date)."'
											,	note				= '".cleanvars($_POST['note'])."'
											,	id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
											, 	date_modify			= NOW()
										  WHERE id			= '".cleanvars($_POST['id_fee'])."'
											");

		//------------ If Remaining Amount ---------------
		
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
			$remarks = 'Fee Challan update with Amount '.cleanvars($_POST['payable']).'.';
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
}

//---------------- Update Partial Payment ----------------------
if(isset($_POST['changes_partialPayment'])) { 

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

//---------------- Delete reocrd----------------------
if(isset($_GET['deleteid'])) { 
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".FEES." SET  
												  is_deleted			= '1'
												, id_deleted			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												, ip_deleted			= '".$ip."'
												, date_deleted			= NOW()
											WHERE challan_no 			= '".cleanvars($_GET['deleteid'])."'");
	//--------------------------------------
		if($sqllms)
		{ 
			//-------------------- Make Log ------------------------
			$remarks = 'Fee Challan Deleted #: "'.cleanvars($_GET['deleteid']).'" details';
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
																'".cleanvars($_GET['deleteid'])."'									,
																NOW()																,
																'".cleanvars($ip)."'												,
																'".cleanvars($remarks)."'											,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
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

?>