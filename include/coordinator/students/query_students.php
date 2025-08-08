<?php
if(isset($_POST['changes_student'])){ 
	//------------Date variable--------------------------
	$dob = date('Y-m-d' , strtotime(cleanvars($_POST['std_dob'])));
	$admissiondate = date('Y-m-d' , strtotime(cleanvars($_POST['std_admissiondate'])));
	$admission_year = date('Y' , strtotime(cleanvars($_POST['std_admissiondate'])));

	// ----------- Class -------------------
	//------------- Seprate The Values ----------------
	$values = explode("|",$_POST['id_class']);
	$class_id   = $values[0];
	$class_code = $values[1];

	// Check if class change
	$sqlCheck  = $dblms->querylms("SELECT std_id, id_class
									FROM ".STUDENTS."
									WHERE  std_id = '".cleanvars($_POST['std_id'])."'
									AND id_class = '".cleanvars($class_id)."' LIMIT 1
									");
	if(mysqli_num_rows($sqlCheck)==0){
		//--------------- Roll No -----------------
		$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
										FROM ".STUDENTS."
										WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
										AND id_class = '".$class_id."'");
		if(mysqli_num_rows($sqllmsRoll) > 0 ){
			$valueRoll = mysqli_fetch_array($sqllmsRoll);
			(int)$valueRoll['rollno'];
			$newRollno = (int)$valueRoll['rollno'] + 1;
		}
		else{
			$newRollno = 1;
		}
		$sqlRoll = ", std_rollno = '".cleanvars($newRollno)."' ";
	}else{
		$sqlRoll = "";
	}
	
	//--------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".STUDENTS." SET  
													std_status				= '".cleanvars($_POST['std_status'])."'
												  , std_name				= '".cleanvars($_POST['std_name'])."' 
												  , std_fathername			= '".cleanvars($_POST['std_fathername'])."' 
												  , std_gender				= '".cleanvars($_POST['std_gender'])."' 
												  , id_guardian				= '".cleanvars($_POST['id_guardian'])."' 
												  , std_dob					= '".$dob."' 
												  , std_bloodgroup			= '".cleanvars($_POST['std_bloodgroup'])."' 
												  , std_city				= '".cleanvars($_POST['std_city'])."' 
												  , std_nic					= '".cleanvars($_POST['std_nic'])."' 
												  , std_religion			= '".cleanvars($_POST['std_religion'])."' 
												  , std_phone				= '".cleanvars($_POST['std_phone'])."' 
												  , std_whatsapp			= '".cleanvars($_POST['std_whatsapp'])."' 
												  , std_address				= '".cleanvars($_POST['std_address'])."' 
												  , is_orphan				= '".cleanvars($_POST['is_orphan'])."' 
												  , is_hostelized			= '".cleanvars($_POST['is_hostelized'])."' 
												  , id_class				= '".cleanvars($class_id)."' 
												  , id_section				= '".cleanvars($_POST['id_section'])."' 
												  $sqlRoll
												  , id_group				= '".cleanvars($_POST['id_group'])."' 
												  , std_admissiondate		= '".$admissiondate."'   
												  , transport_fee			= '".cleanvars($_POST['transport_fee'])."' 
												  , id_campus				= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify				= NOW()
											  		WHERE std_id			= '".cleanvars($_POST['std_id'])."'");
									
											  
	if(!empty($_FILES['std_photo']['name'])) { 
		
		$path_parts 	= pathinfo($_FILES["std_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 		= 'uploads/images/students/';
		
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['std_name'])).'_'.$_POST['std_id'].".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['std_name'])).'_'.$_POST['std_id'].".".($extension);
		
		if(in_array($extension , array('jpg','jpeg', 'gif', 'png'))) { 
			
			$sqllmsupload  = $dblms->querylms("UPDATE ".STUDENTS."
															SET std_photo = '".$img_fileName."'
														WHERE  std_id		  = '".cleanvars($_POST['std_id'])."'");
			unset($sqllmsupload);
			$mode = '0644'; 
				
			move_uploaded_file($_FILES['std_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
			
		}
		
	}
	
	if($sqllms) { 
		
		$remarks = 'Updated Student ID: "'.cleanvars($_POST['std_id']).'" details';
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
									
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: students.php", true, 301);
		exit();	
	}
}
?>