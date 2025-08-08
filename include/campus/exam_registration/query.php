<?php
// INSERT RECORD
if (isset($_POST['submit_demand'])){
	$sqllms  = $dblms->querylms("SELECT is_publish
									FROM ".EXAM_REGISTRATION." 
									WHERE is_deleted	= '0'
									AND id_class 		= '".cleanvars($_POST['id_class'])."'
									AND id_type 		= '".cleanvars($_POST['id_term'])."'
									AND id_campus 		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
									AND id_session 		= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									ORDER BY reg_id LIMIT 1
								");
	if (!mysqli_num_rows($sqllms)){
		$sqllms  = $dblms->querylms("SELECT reg_id
									FROM ".EXAM_REGISTRATION." 
									WHERE is_deleted	= '0'
									AND is_publish		= '1'
									AND id_type 		= '".cleanvars($_POST['id_term'])."'
									AND id_campus 		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
									AND id_session 		= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									ORDER BY reg_id LIMIT 1
								");
		if (!mysqli_num_rows($sqllms)){
			$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_REGISTRATION." (
																		  id_class
																		, reg_status
																		, id_campus
																		, id_session
																		, id_type
																		, is_publish
																		, id_added
																		, date_added
																	)
																VALUES
																	(
																		  '".cleanvars($_POST['id_class'])."'
																		, '".cleanvars($_POST['demand_status'])."'
																		, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																		, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
																		, '".cleanvars($_POST['id_term'])."'
																		, '0'
																		, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																		, NOW()
																	)
										");
			// LATEST ID
			$id_reg  = $dblms->lastestid();

			for ($i = 1 ; $i <= sizeof($_POST['students_id']) ; $i++):
				$sub_ids = array();
				$sub_ids_sep_comma = '';
				for ($j = 0 ; $j < sizeof($_POST['subjects_id']) ; $j++):
					if (isset($_POST['subjects'.$_POST['students_id'][$i]][$i.$j])):
						array_push($sub_ids, $_POST['subjects_id'][$i.$j]);
						$sub_ids_sep_comma = implode(",", $sub_ids);
					endif;
				endfor;
				if (!empty($sub_ids_sep_comma)):
					$sqllms  = $dblms->querylms("INSERT INTO ".EXAM_REGISTRATION_DETAIL." (
																							  id_reg
																							, id_std
																							, id_subjects
																						)
																				VALUES (
																							  '".cleanvars($id_reg)."'
																							, '".cleanvars($_POST['students_id'][$i])."'
																							, '".cleanvars($sub_ids_sep_comma)."'
																						)
												");
				endif;
			endfor;

			// REMARKS
			if ($sqllms){
				$remarks = 'Exam Registration Added ID: "'.cleanvars($id_reg).'" details';
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
																	, '1' 
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
												");
				errorMsg('Successfully', 'Record Successfully Added.', 'success');
				header("Location: exam_registration.php", true, 301);
				exit();
			}else{
				errorMsg('Unsuccessfully', 'Record Unsuccessfully Added.', 'error');
				header("Location: exam_registration.php?view=add", true, 301);
				exit();
			}
		}else{
			errorMsg('Unsuccessfully', 'You Cannot Add More Record In Published Term.', 'error');
			header("Location: exam_registration.php?view=add", true, 301);
			exit();
		}
	}else{
		if (mysqli_fetch_array($sqllms)['is_publish'] == 1){
			errorMsg('Unsuccessfully', 'Record Already Published.', 'error');
			header("Location: exam_registration.php?view=add", true, 301);
			exit();
		}else{
			errorMsg('Unsuccessfully', 'Record Already Exist.', 'error');
			header("Location: exam_registration.php?view=add", true, 301);
			exit();
		}
	}
}

// UPDATE RECORD
if (isset($_POST['submit_edit_exam_demand'])){
	$sqllms  = $dblms->querylms("SELECT is_publish
									FROM ".EXAM_REGISTRATION." 
									WHERE is_deleted	= '0'
									AND reg_id			!=	'".cleanvars($_POST['edit_id'])."'
									AND id_type 		= '".cleanvars($_POST['id_term'])."'
									AND id_class 		= '".cleanvars($_POST['id_class'])."'
									AND id_campus 		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
									AND id_session 		= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									ORDER BY reg_id
								");
	if (!mysqli_num_rows($sqllms)){ 
		$sqllms  = $dblms->querylms("SELECT reg_id
										FROM ".EXAM_REGISTRATION." 
										WHERE is_deleted	= '0'
										AND is_publish 		= '1'
										AND id_type 		= '".cleanvars($_POST['id_term'])."'
										AND id_campus 		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_session 		= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										ORDER BY reg_id LIMIT 1
									");
		if (!mysqli_num_rows($sqllms)){
			$sqllms  = $dblms->querylms("UPDATE ".EXAM_REGISTRATION." SET 
																	  reg_status		=	'".cleanvars($_POST['demand_status'])."'
																	, id_type			=	'".cleanvars($_POST['id_term'])."'
																	, is_publish		=	'".cleanvars($_POST['is_publish'])."'
																	, id_modify			=	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, date_modify		=	NOW()
																	  WHERE reg_id		=	'".cleanvars($_POST['edit_id'])."'

										");
			// LATEST ID
			$id_reg = $_POST['edit_id'];

			// DELETE OLD RECORD
			$sqllms  = $dblms->querylms("DELETE FROM ".EXAM_REGISTRATION_DETAIL." WHERE  id_reg = ".cleanvars($id_reg)." ");
			
			// INSERT DETAIL AND REMARKS
			if ($sqllms):
				for ($i = 1 ; $i <= count($_POST['students_id']) ; $i++):
					$sub_ids = array();
					$sub_ids_sep_comma = '';
					for ($j = 0 ; $j < count($_POST['subjects_id']) ; $j++):
						if (isset($_POST['subjects'.$_POST['students_id'][$i]][$i.$j])):
							if (!empty($_POST['subjects_id'][$i.$j])):
								array_push($sub_ids, $_POST['subjects_id'][$i.$j]);
								$sub_ids_sep_comma = implode(",", $sub_ids);
							endif;
						endif;
					endfor;
					if (!empty($sub_ids_sep_comma)):
					$dblms->querylms("INSERT INTO ".EXAM_REGISTRATION_DETAIL." (
																				  id_reg
																				, id_std
																				, id_subjects
																			)
																	VALUES (
																				  '".cleanvars($id_reg)."'
																				, '".cleanvars($_POST['students_id'][$i])."'
																				, '".cleanvars($sub_ids_sep_comma)."'
																			)
									");
					endif;
				endfor;
			endif;
			// REMARKS
			if ($sqllms){
				$remarks = 'Exam Registration Updated ID: "'.cleanvars($id_reg).'" details';
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
																	, '2' 
																	, NOW()
																	, '".cleanvars($ip)."'
																	, '".cleanvars($remarks)."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																)
												");
				errorMsg('Successfully', 'Record Successfully Edit.', 'success');
				header("Location: exam_registration.php", true, 301);
				exit();
			}else{
				errorMsg('Unsuccessfully', 'Record Unsuccessfully Edit.', 'error');
				header("Location: exam_registration.php?edit_id=".cleanvars($id_reg)."", true, 301);
				exit();
			}
		}else{
			errorMsg('Unsuccessfully', 'You Cannot Add More Record In Published Term.', 'error');
			header("Location: exam_registration.php?edit_id=".cleanvars($id_reg)."", true, 301);
			exit();
		}
	}else{
		if (mysqli_fetch_array($sqllms)['is_publish'] == 1){
			errorMsg('Unsuccessfully', 'Record Already Published.', 'info');
			header("Location: exam_registration.php?edit_id=".cleanvars($id_reg)."", true, 301);
			exit();
		}else{
			errorMsg('Unsuccessfully', 'Record Already Exist.', 'error');
			header("Location: exam_registration.php?edit_id=".cleanvars($id_reg)."", true, 301);
			exit();
		}
	}
}

// DELETE RECORD
if (isset($_GET['deleteid'])){
	$sqllms  = $dblms->querylms("UPDATE ".EXAM_REGISTRATION." SET  
															  is_deleted		= '1'
															, id_deleted		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, ip_deleted		= '".$ip."'
															, date_deleted		= NOW()
															  WHERE  reg_id		= '".cleanvars($_GET['deleteid'])."'
								");
	if ($sqllms){
		$remarks = 'Exam Registration Deleted ID: "'.cleanvars($_GET['deleteid']).'" details';
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
		errorMsg('Deleted', 'Record Deleted.', 'success');
		header("Location: exam_registration.php", true, 301);
		exit();
	}else{
		errorMsg('Deleted', 'Record Not Deleted.', 'error');
		header("Location: exam_registration.php", true, 301);
		exit();
	}
}

// PUBLISH RECORD
if (isset($_POST['publish_it'])){
	$sqllms  = $dblms->querylms("SELECT reg_status
									FROM ".EXAM_REGISTRATION." 
									WHERE is_deleted	= '0'
									AND id_campus 		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
									AND id_session 		= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									ORDER BY reg_id
								");
	if (mysqli_fetch_array($sqllms)['reg_status']){
		$sqllms  = $dblms->querylms("UPDATE  ".EXAM_REGISTRATION." SET  
																  is_publish		= '1'
																, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																, date_modify		= NOW()
																  WHERE id_session	= '".cleanvars($_POST['id_session'])."'
																  AND id_type		= '".cleanvars($_POST['id_type'])."'
																  AND id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
									");
		if ($sqllms){
			$remarks = 'Exam Registration Published id_session: "'.cleanvars($_POST['id_session']).'" , id_type: "'.cleanvars($_POST['id_type']).'" id_campus: "'.cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS']).'" details';
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
																, '2' 
																, NOW()
																, '".cleanvars($ip)."'
																, '".cleanvars($remarks)."'
																, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
															)
											");
			errorMsg('Publish', 'Record Published And You Can\'t Edit It.', 'success');
			header("Location: exam_registration.php", true, 301);
			exit();
		}else{
			errorMsg('Publish', 'Record Not Published.', 'error');
			header("Location: exam_registration.php", true, 301);
			exit();
		}
	}
}
?>