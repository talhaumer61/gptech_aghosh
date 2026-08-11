<?php 
// Student insert record
if(isset($_POST['submit_student'])) { 
	
	for ($i=0; $i < sizeof($_POST['form_no']); $i++) { 

		$admissiondate = date('Y-m-d' , strtotime(cleanvars($_POST['std_admissiondate'][$i])));
		$admission_year = date('Y' , strtotime(cleanvars($_POST['std_admissiondate'][$i])));

		//For Class Short Code
		$sqllmsclass 	= 	$dblms->querylms("SELECT class_code FROM ".CLASSES." WHERE class_id  = '".cleanvars($_POST['id_class'][$i])."' LIMIT 1");
		$value_class 	= 	mysqli_fetch_array($sqllmsclass);
		$class_code 	= 	$value_class['class_code'];

		//For Campus Short Code
		$sqllmscampus = $dblms->querylms("SELECT campus_code FROM ".CAMPUS." WHERE campus_id = '".cleanvars($_POST['id_campus'][$i])."' LIMIT 1");
		$value_campus = mysqli_fetch_array($sqllmscampus);

		//For Roll No
		$sqllmsrollno 	= 	$dblms->querylms("SELECT std_rollno FROM ".STUDENTS." WHERE id_class = '".cleanvars($_POST['id_class'][$i])."' AND id_campus = '".cleanvars($_POST['id_campus'][$i])."'  ORDER BY std_rollno DESC LIMIT 1");
		$value_rollno 	= 	mysqli_fetch_array($sqllmsrollno);

		$reg_no	= $admission_year.'-'.$value_campus['campus_code'].'-'.$class_code.'-'.$value_rollno['std_rollno'];
		$regno = str_replace(" ","", $reg_no);


		$sqllms  = $dblms->querylms("INSERT INTO ".STUDENTS."(
																std_status								, 
																std_name								,
																std_fathername							,  
																std_gender								,  
																id_guardian								,  
																std_dob									,  
																std_nic									,  
																std_phone								, 
																std_email								, 
																std_address								,
																is_orphan								, 
																is_hostelized							, 
																id_class								,  
																id_session								, 
																std_rollno								,  
																std_regno								,   
																admission_formno						,
																std_admissiondate						,
																id_campus							 	,
																id_added								,  
																date_added														
															)
														VALUES(
																'1'							, 
																'".cleanvars($_POST['std_name'][$i])."'								,
																'".cleanvars($_POST['std_fathername'][$i])."'						,
																'".cleanvars($_POST['std_gender'][$i])."'							, 
																'".cleanvars($_POST['id_guardian'][$i])."'							, 
																'".cleanvars($_POST['dob'][$i])."'									,
																'".cleanvars($_POST['std_nic'][$i])."'								, 
																'".cleanvars($_POST['std_phone'][$i])."'							, 
																'".cleanvars($_POST['std_email'][$i])."'								, 
																'".cleanvars($_POST['std_address'][$i])."'							, 
																'".cleanvars($_POST['is_orphan'][$i])."'							, 
																'".cleanvars($_POST['is_hostelized'][$i])."'						, 
																'".cleanvars($_POST['id_class'][$i])."'								,	
																'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'		, 
																'".cleanvars($value_rollno['std_rollno'])."'						, 
																'".cleanvars($regno)."'												, 
																'".cleanvars($_POST['form_no'][$i])."'								, 
																'".cleanvars($admissiondate)."'								, 
																'".cleanvars($_POST['id_campus'][$i])."'							,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																NOW()
															)"
													);
			$std_id = $dblms->lastestid();
			$sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
															id_std = '".cleanvars($std_id)."'
														WHERE   inquiry_formno  = '".cleanvars($_POST['form_no'][$i])."'
										");
		
		
	}
		
	$_SESSION['msg']['title'] 	= 'Successfully';
	$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
	$_SESSION['msg']['type'] 	= 'success';
	header("Location: paid_challan_inquiry.php", true, 301);
	exit();
}

?>
