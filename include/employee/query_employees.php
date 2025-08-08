<?php 
//----------------Employee record----------------------
if(isset($_POST['submit_emply'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT emply_regno
										FROM ".EMPLOYEES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND emply_regno = '".cleanvars($_POST['emply_regno'])."'  LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: employee.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------Reformat Date------------------------
$dob = date('Y-m-d' , strtotime(cleanvars($_POST['emply_dob'])));
$join_date = date('Y-m-d' , strtotime(cleanvars($_POST['emply_joindate'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EMPLOYEES."(
														emply_status					, 
														emply_regno						, 
														emply_name						, 
														id_dept							, 
														id_designation					,
														id_type							,
														emply_gender					,
														emply_dob						, 
														emply_joindate					, 
														emply_education					, 
														emply_experence					,
														emply_religion					,
														emply_bloodgroup				,  
														emply_address					, 
														emply_phone						, 
														emply_email						,
														id_campus 						,
														id_added						,
														date_added
													  )
	   											VALUES(
														'".cleanvars($_POST['emply_status'])."'							,	 
														'".cleanvars($_POST['emply_regno'])."'							,
														'".cleanvars($_POST['emply_name'])."'							,
														'".cleanvars($_POST['id_dept'])."'								,	
														'".cleanvars($_POST['id_designation'])."'						,
														'".cleanvars($_POST['id_type'])."'								,
														'".cleanvars($_POST['emply_gender'])."'							,
														'".cleanvars($dob)."'											,
														'".cleanvars($join_date)."'										,	
														'".cleanvars($_POST['emply_education'])."'						,
														'".cleanvars($_POST['emply_experence'])."'						,
														'".cleanvars($_POST['emply_religion'])."'						,
														'".cleanvars($_POST['emply_bloodgroup'])."'						,	
														'".cleanvars($_POST['emply_address'])."'						,
														'".cleanvars($_POST['emply_phone'])."'							,
														'".cleanvars($_POST['emply_email'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														 Now()
														
													  )"
							);

//--------------------------------------
$idsetup = $dblms->lastestid();	
//--------------------------------------

//------------------ Insert Image By updating ---------------------------
//------------------Img Validation--------------------
if(!empty($_FILES['emply_photo']['name'])) { 
//--------------------------------------
	$img_dir		= "uploads/images/employees/";
//	$filesize		= formatSizeUnits($_FILES["dwnl_file"]["size"]);
	$path_parts 	= pathinfo($_FILES["emply_photo"]["name"]);
	$extension 		= strtolower($path_parts['extension']);

if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 

if (($_FILES["emply_photo"]["size"] > 200000)) {
	$_SESSION['msg']['status'] = '<div role="alert" class="alert alert-danger fade in"> <strong>Error!</strong> Uploaded image size should be less than <b>"200 KB"</b>.</div>';
} else {
	$originalImage	= $img_dir.to_seo_url($_POST['emply_regno']).".".strtolower($extension);
	$img_fileName	= to_seo_url($_POST['emply_regno']).".".strtolower($extension);

//--------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES." SET  
													emply_photo		= '".cleanvars($img_fileName)."'
											  WHERE emply_id		= '".cleanvars($idsetup)."'
											  ");
//--------------------------------------		
		//unset($sqllmsupload);
		$mode = '0644'; 
//--------------------------------------	
		move_uploaded_file($_FILES['emply_photo']['tmp_name'],$originalImage);
		chmod ($originalImage, octdec($mode));
		$_SESSION['msg']['status'] = '<div role="alert" class="alert alert-success"> <strong>Success!</strong> Record update successfully. </div>';
}

	} else { 
		$_SESSION['msg']['status'] = '<div role="alert" class="alert alert-danger fade in"> <strong>Error!</strong> Upload valid Image. Only PNG, GIF, JPG and JPEG are allowed. </div>';
	}
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Employee: "'.cleanvars($_POST['emply_name']).'" Detail';
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
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: employee.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	}}
//	} // end checker
//--------------------------------------	


//----------------Update reocrd----------------------
if(isset($_POST['changes_employee'])) { 
//------------------------Reformat Date------------------------
$dob = date('Y-m-d' , strtotime(cleanvars($_POST['emply_dob'])));
$join_date = date('Y-m-d' , strtotime(cleanvars($_POST['emply_joindate'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES." SET  
													emply_status		= '".cleanvars($_POST['emply_status'])."'
												  , emply_regno			= '".cleanvars($_POST['emply_regno'])."' 
												  , emply_name			= '".cleanvars($_POST['emply_name'])."' 
												  , id_dept				= '".cleanvars($_POST['id_dept'])."' 
												  , id_designation		= '".cleanvars($_POST['id_designation'])."' 
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , emply_gender		= '".cleanvars($_POST['emply_gender'])."' 
												  , emply_dob			= '".cleanvars($dob)."' 
												  , emply_joindate		= '".cleanvars($join_date)."' 
												  , emply_education		= '".cleanvars($_POST['emply_education'])."' 
												  , emply_experence		= '".cleanvars($_POST['emply_experence'])."' 
												  , emply_religion		= '".cleanvars($_POST['emply_religion'])."' 
												  , emply_bloodgroup	= '".cleanvars($_POST['emply_bloodgroup'])."' 
												  , emply_address		= '".cleanvars($_POST['emply_address'])."' 
												  , emply_phone			= '".cleanvars($_POST['emply_phone'])."' 
												  , emply_email			= '".cleanvars($_POST['emply_email'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  ,	date_modify			= Now() 
   											  WHERE emply_id			= '".cleanvars($_POST['emply_id'])."'");
//--------------------------------------
	if($sqllms) { 
	//------------------Update Image--------------------
	if(!empty($_FILES['emply_photo']['name'])) { 
	//--------------------------------------
		$img_dir		= "uploads/images/employees/";
	//	$filesize		= formatSizeUnits($_FILES["dwnl_file"]["size"]);
		$path_parts 	= pathinfo($_FILES["emply_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
	
		if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 
	
			if (($_FILES["emply_photo"]["size"] > 200000)) {
				$_SESSION['msg']['status'] = '<div role="alert" class="alert alert-danger fade in"> <strong>Error!</strong> Uploaded image size should be less than <b>"200 KB"</b>.</div>';
			} else {
				$originalImage	= $img_dir.to_seo_url($_POST['emply_regno']).".".strtolower($extension);
				$img_fileName	= to_seo_url($_POST['emply_regno']).".".strtolower($extension);
			
			//--------------------------------------
				$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES." SET  
																emply_photo		= '".cleanvars($img_fileName)."'
														WHERE emply_id		= '".cleanvars($_POST['emply_id'])."'
														");
			//--------------------------------------		
					//unset($sqllmsupload);
					$mode = '0644'; 
			//--------------------------------------	
					move_uploaded_file($_FILES['emply_photo']['tmp_name'],$originalImage);
					chmod ($originalImage, octdec($mode));
					$_SESSION['msg']['status'] = '<div role="alert" class="alert alert-success"> <strong>Success!</strong> Record update successfully. </div>';
			}
	
		} else { 
			$_SESSION['msg']['status'] = '<div role="alert" class="alert alert-danger fade in"> <strong>Error!</strong> Upload valid Image. Only PNG, GIF, JPG and JPEG are allowed. </div>';
		}
	}
	//--------------------------------------
	$remarks = 'Update Employee: "'.cleanvars($_POST['employee_name']).'" Detail';
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
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: employee.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


//----------------Bank Deatils insert record----------------------
if(isset($_POST['submit_account'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT account_name  
										FROM ".EMPLOYEES_BANKACCOUNTS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND account_no = '".cleanvars($_POST['account_no'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: employee.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EMPLOYEES_BANKACCOUNTS."(
																		status						, 
																		id_emply					,
																		id_bank						, 
																		branch						, 
																		account_name				,
																		account_no					,
																		account_type				, 
																		id_campus 	
													 					 )
	   															VALUES(
																		'".cleanvars($_POST['status'])."'							, 
																		'".cleanvars($_POST['id_emply'])."'							,
																		'".cleanvars($_POST['id_bank'])."'							,
																		'".cleanvars($_POST['branch'])."'							,
																		'".cleanvars($_POST['account_name'])."'						,
																		'".cleanvars($_POST['account_no'])."'						,
																		'".cleanvars($_POST['account_type'])."'						,
																		'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													 				 )"
																	);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Employee Bank Account: "'.cleanvars($_POST['account_no']).'" detail';
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
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: employee.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 

//----------------Employee Bank Account update reocrd----------------------
if(isset($_POST['changes_account'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES_BANKACCOUNTS." SET  
																	status				= '".cleanvars($_POST['status'])."'
												  				  , id_emply			= '".cleanvars($_POST['id_emply'])."' 
												 				  , id_bank				= '".cleanvars($_POST['id_bank'])."' 
												  				  , branch				= '".cleanvars($_POST['branch'])."' 
												  				  , account_name		= '".cleanvars($_POST['account_name'])."' 
												  				  , account_no			= '".cleanvars($_POST['account_no'])."' 
												  				  , account_type		= '".cleanvars($_POST['account_type'])."' 
												 				  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											 				  WHERE id					= '".cleanvars($_POST['id'])."'  LIMIT 1");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Employee Bank Account: "'.cleanvars($_POST['account_no']).'" details';
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
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."'	, 
															'2'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'										,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: employee.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

?>
