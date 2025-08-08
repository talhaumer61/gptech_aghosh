<?php 
//-----------------------CATEGORY-----------------------------
// Cat insert record
if(isset($_POST['submit_cat'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT cat_name, cat_type, id_campus  
										FROM ".SCHOLARSHIP_CAT." 
										WHERE cat_name = '".cleanvars($_POST['cat_name'])."' 
										AND cat_type = '2' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: feeconcession_cat.php", true, 301);
		exit();
	} else { 
		$sqllms  = $dblms->querylms("INSERT INTO ".SCHOLARSHIP_CAT."(
															  cat_status 
															, cat_type
															, cat_name
															, cat_amount
															, cat_detail 
															, id_campus							 	
														)
													VALUES(
															  '".cleanvars($_POST['cat_status'])."' 
															, '2'
															, '".cleanvars($_POST['cat_name'])."' 
															, '".cleanvars($_POST['cat_amount'])."' 
															, '".cleanvars($_POST['cat_detail'])."' 
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														)"
								);
		if($sqllms) { 
			$remarks = 'Add Fee Concession Category: "'.cleanvars($_POST['cat_name']).'" detail';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks				
															)
			
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
																, '1' 
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
															)
										");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: feeconcession_cat.php", true, 301);
			exit();
		}
	}
} 

// Cat Update reocrd
if(isset($_POST['changes_cat'])) { 
	$sqllms  = $dblms->querylms("UPDATE ".SCHOLARSHIP_CAT." SET  
													  cat_status	= '".cleanvars($_POST['cat_status'])."'
													, cat_name		= '".cleanvars($_POST['cat_name'])."'	
													, cat_amount	= '".cleanvars($_POST['cat_amount'])."'	
													, cat_detail	= '".cleanvars($_POST['cat_detail'])."' 
													, id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													  WHERE cat_id	= '".cleanvars($_POST['cat_id'])."'");

	if($sqllms) { 
		$remarks = 'Update  Fee Concession Category: "'.cleanvars($_POST['cat_name']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															  id_user 
															, filename 
															, action
															, dated
															, ip
															, remarks			
														)
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
															, '2' 
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
														)
									");
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: feeconcession_cat.php", true, 301);
		exit();
	}
}



//----------------------Fee Concession------------------------
// Fee Concession insert record
if(isset($_POST['submit_concessionadd'])) { 
	
	$dated 	= date('Y-m-d',strtotime($_POST['date']));
	
	$datetime_1 	= date('Y-m',strtotime($_POST['date'])); 
	$datetime_2 	= ACADEMIC_ESTART; 
	$start_datetime = new DateTime($datetime_1); 
	$diff 			= $start_datetime->diff(new DateTime($datetime_2)); 
	
	$sqllmscheck  = $dblms->querylms("SELECT id_std, id_cat, id_session, id_campus
										FROM ".SCHOLARSHIP." 
										WHERE id_std = '".cleanvars($_POST['id_std'])."' 
										AND id_cat = '".cleanvars($_POST['id_cat'])."'
										AND id_class = '".cleanvars($_POST['id_class'])."' 
										AND date = '".cleanvars($dated)."' 
										AND id_session = '".($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									    AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: feeconcession.php", true, 301);
		exit();
	} else { 		
		$sqllms  = $dblms->querylms("INSERT INTO ".SCHOLARSHIP."(
															  status 
															, id_type 
															, id_authority
															, totalconsession 
															, amount
															, date
															, id_cat 
															, id_feecat  
															, id_class 
															, id_std
															, id_session 
															, note
															, id_campus
															, id_added
															, date_added			 	
														)
													VALUES(
															  '".cleanvars($_POST['status'])."' 
															, '2'
															, '".cleanvars($_POST['id_authority'])."' 
															, '".cleanvars($_POST['amount'] * ($diff->m + 1))."' 
															, '".cleanvars($_POST['amount'])."' 
															, '".cleanvars($dated)."' 
															, '".cleanvars($_POST['id_cat'])."' 
															, '".cleanvars($_POST['id_feecat'])."' 
															, '".cleanvars($_POST['id_class'])."' 
															, '".cleanvars($_POST['id_std'])."' 
															, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
															, '".cleanvars($_POST['note'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, NOW()
														)" );
		if($sqllms) { 
			//--------- Get latest Id -------- 
			$idsetup = $dblms->lastestid();

			$remarks = 'Add Fee Concession: "'.cleanvars($_POST['id_std']).'" detail';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks				
															)
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
																, '1' 
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
															)
										");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: feeconcession.php?view=edit&idstd=".$_POST['id_std']."", true, 301);
			exit();
		}
	}
} 


// Fee Concession insert record
if(isset($_POST['submit_feeconcession'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_std, id_cat, id_session, id_campus
										FROM ".SCHOLARSHIP." 
										WHERE id_std = '".cleanvars($_POST['id_std'])."' AND id_cat = '".cleanvars($_POST['id_cat'])."'
										AND id_class = '".cleanvars($_POST['id_class'])."' 
										AND is_deleted = '0' 
									    AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: feeconcession.php", true, 301);
		exit();
	} else { 		
		$sqllms  = $dblms->querylms("INSERT INTO ".SCHOLARSHIP."(
															  status 
															, id_type 
															, consession_on
															, percent
															, amount
															, id_cat 
															, id_class 
															, id_std
															, id_session 
															, note
															, id_campus
															, id_added
															, date_added			 	
														)
													VALUES(
															  '".cleanvars($_POST['status'])."' 
															, '2'
															, '".cleanvars($_POST['consession_on'])."' 
															, '".cleanvars($_POST['percent'])."' 
															, '".cleanvars($_POST['total_amount'])."' 
															, '".cleanvars($_POST['id_cat'])."' 
															, '".cleanvars($_POST['id_class'])."' 
															, '".cleanvars($_POST['id_std'])."' 
															, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
															, '".cleanvars($_POST['note'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, NOW()
														)" );
		if($sqllms) { 
			//--------- Get latest Id -------- 
			$idsetup = $dblms->lastestid();
			//Detail Table
			foreach($_POST['fee_cat'] as $index => $value) {
				if($_POST['cat_amount'][$index] > 0){
					$sqllmsDetail = $dblms->querylms("INSERT INTO ".SCH_CONCESS_DET."(
																	  id_setup 
																	, id_cat 
																	, amount						 	
																)
															VALUES(
																	  '".cleanvars($idsetup)."' 
																	, '".cleanvars($_POST['fee_cat'][$index])."' 
																	, '".cleanvars($_POST['cat_amount'][$index])."'
																)" );
				}
			}

			$remarks = 'Add Fee Concession: "'.cleanvars($_POST['id_std']).'" detail';
			$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																  id_user 
																, filename 
																, action
																, dated
																, ip
																, remarks				
															)
														VALUES(
																  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
																, '1' 
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
															)
										");
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: feeconcession.php", true, 301);
			exit();
		}
	}
} 

// Fee Concession Update reocrd
if(isset($_POST['changes_feeconcession'])) { 
	$dated 	= date('Y-m-d',strtotime($_POST['date']));
	
	$datetime_1 	= date('Y-m',strtotime($_POST['date'])); 
	$datetime_2 	= ACADEMIC_ESTART; 
	$start_datetime = new DateTime($datetime_1); 
	$diff 			= $start_datetime->diff(new DateTime($datetime_2)); 
	
	$sqllms  = $dblms->querylms("UPDATE ".SCHOLARSHIP." SET  
													  status			= '".cleanvars($_POST['status'])."'
													, id_authority 		= '".cleanvars($_POST['id_authority'])."' 
													, totalconsession 	= '".cleanvars($_POST['amount'] * ($diff->m + 1))."' 
													, amount			= '".cleanvars($_POST['amount'])."' 
													, date				= '".$dated."' 
													, id_cat			= '".cleanvars($_POST['id_cat'])."'	
													, id_feecat			= '".cleanvars($_POST['id_feecat'])."'	
													, note				= '".cleanvars($_POST['note'])."' 
													, id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
													, date_modify		= NOW()
													  WHERE id			= '".cleanvars($_POST['id'])."'");
	if($sqllms) { 
		$sqllmsDel  = $dblms->querylms("DELETE FROM ".SCH_CONCESS_DET." WHERE id_setup = '".cleanvars($_POST['id'])."' ");
		

		$remarks = 'Update Fee Concession: "'.cleanvars($_POST['id_std']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															  id_user 
															, filename 
															, action
															, dated
															, ip
															, remarks			
														)
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
															, '2' 
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
														)
									");
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: ".$_SERVER['HTTP_REFERER']."", true, 301);
		exit();
	}
}

// Copy Fee Concession
if(isset($_POST['copy_feeconcession'])) {
	for($i=1; $i<= sizeof($_POST['id']); $i++){
		if(isset($_POST['sub-checkbox'][$i])){
			// ID SETUP
			$setupID = $_POST['id'][$i];
			$id_to_class = $_POST['id_to_class'][$i];

			// GET SCHOLARSHIP
			$sqlConcession = $dblms->querylms("SELECT * FROM ".SCHOLARSHIP." WHERE id = '".cleanvars($setupID)."' LIMIT 1");
			$valConcession = mysqli_fetch_array($sqlConcession);

			// INSERT NEW
			$sqllmscheck = $dblms->querylms("SELECT id_std, id_cat, id_session, id_campus
												FROM ".SCHOLARSHIP." 
												WHERE id_std	= '".cleanvars($valConcession['id_std'])."'
												AND id_cat		= '".cleanvars($valConcession['id_cat'])."'
												AND id_class	= '".cleanvars($id_to_class)."'
												AND id_session 	= '".cleanvars($_POST['id_to_session'])."'
												AND id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1
											");
			if(mysqli_num_rows($sqllmscheck) == 0) {
				$sqllms  = $dblms->querylms("INSERT INTO ".SCHOLARSHIP."(
															  status 
															, id_type 
															, consession_on
															, percent
															, amount
															, id_cat 
															, id_class 
															, id_std
															, id_session 
															, note
															, id_campus
															, id_added
															, date_added			 	
														)
													VALUES(
															  '".cleanvars($valConcession['status'])."' 
															, '".cleanvars($valConcession['id_type'])."'
															, '".cleanvars($valConcession['consession_on'])."' 
															, '".cleanvars($valConcession['percent'])."' 
															, '".cleanvars($valConcession['amount'])."' 
															, '".cleanvars($valConcession['id_cat'])."' 
															, '".cleanvars($id_to_class)."'
															, '".cleanvars($valConcession['id_std'])."' 
															, '".cleanvars($_POST['id_to_session'])."'
															, '".cleanvars($valConcession['note'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, NOW()
														)" );
				if($sqllms) { 
					// LATEST ID 
					$latestID = $dblms->lastestid();

					// GET FEE SETUP DETAIL
					$sqlConceDetail = $dblms->querylms("SELECT * FROM ".SCH_CONCESS_DET." WHERE id_setup = '".cleanvars($setupID)."' ");
					while ($valConceDetail = mysqli_fetch_array($sqlConceDetail)) {
						$sqlDetail = $dblms->querylms("INSERT INTO ".SCH_CONCESS_DET."(
																						  id_setup 
																						, id_cat 
																						, amount						 	
																					)
																				VALUES(
																						  '".cleanvars($latestID)."' 
																						, '".cleanvars($valConceDetail['id_cat'])."' 
																						, '".cleanvars($valConceDetail['amount'])."'
																					)
														");
					}

					// REMARKS
					$remarks = 'Fee Concession Copied: id = '.cleanvars($latestID).' and copied from_id = '.cleanvars($setupID).' ';
					$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
																		  id_user 
																		, filename 
																		, action
																		, dated
																		, ip
																		, remarks				
																	)
																VALUES(
																		  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																		, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 
																		, '1' 
																		, NOW()
																		, '".cleanvars($ip)."'
																		, '".cleanvars($remarks)."'
																	)
												");
				}
			}
		}
	}
	$_SESSION['msg']['title'] 	= 'Successfully';
	$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
	$_SESSION['msg']['type'] 	= 'info';
	header("Location: feeconcession.php", true, 301);
	exit();
}

// Delete Reocrd
if(isset($_GET['deleteid'])) { 
	$sqllms  = $dblms->querylms("UPDATE ".SCHOLARSHIP." SET  
														  is_deleted		= '1'
														, id_deleted		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, ip_deleted		= '".$ip."'
														, date_deleted		= NOW()
													 	  WHERE id 			= '".cleanvars($_GET['deleteid'])."'
								");
	if($sqllms) { 
		$remarks = 'Fee Concession Deleted ID: "'.cleanvars($_GET['id']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															  id_user 
															, filename 
															, action
															, dated
															, ip
															, remarks 
															, id_campus				
														)		
													VALUES(
															  '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'
															, '3'
															, NOW()
															, '".cleanvars($ip)."'
															, '".cleanvars($remarks)."'
															, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														)
										");
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: feeconcession.php", true, 301);
		exit();
	}
}
?>