<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
$sql = "SELECT f.id, f.status, f.id_month, f.challan_no, f.issue_date, f.due_date, f.paid_date, 
				f.total_amount, f.remaining_amount, f.paid_amount, f.narration, c.class_name, cs.section_name, 
				s.session_name, st.std_id, st.std_name, st.std_fathername, st.std_regno, st.std_gender, st.is_hostelized, fs.id as idsetup 
				FROM ".FEES." f				   
				INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
				LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
				INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
				INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std 
				INNER JOIN ".FEESETUP." fs ON st.id_class = fs.id_class AND fs.id_session = st.id_session 
				WHERE f.id_type = '2'
				AND f.is_deleted != '1'
				AND st.is_deleted != '1' 
				AND f.paid_date = '0000-00-00'
				
				AND f.yearmonth = '2024-07' 
				AND fs.is_deleted != '1' AND fs.status = '1' 
				AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
				AND fs.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
				ORDER BY f.id DESC";

		$sqllms	= $dblms->querylms($sql);
		
		$count = mysqli_num_rows($sqllms); 
	while($value_std = mysqli_fetch_array($sqllms)) { 
		
		$sqllmsdels	= $dblms->querylms("DELETE FROM ".FEE_PARTICULARS." WHERE id_fee  = '".$value_std['id']."'");
		
		echo $value_std['id'].'- '.$value_std['idsetup'].'<br>';
		
		
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
															WHERE d.id_setup = '".$value_std['idsetup']."'
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
                                                                        AND  MONTH(date) IN ('".$month."', '".$idmonth."') ");
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
				$tot_amount = array_sum(array_column($catDetails, 1));
				$payable = $tot_amount;
		
			if($payable > 0){
				foreach($catDetails as $cats){
								if($cats[1] > 0){	
									$sqllmsPart = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																								  id_fee
																								, id_cat
																								, amount
																								, concession							
																							)
																						VALUES(
																								  '".cleanvars($value_std['id'])."'
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
				
				$sqllmsUpdate  = $dblms->querylms("UPDATE ".FEES." SET  
															total_amount	= '".cleanvars($payable)."'
															WHERE id		= '".$value_std['id']."'
													");
			}

		
		
		
	}