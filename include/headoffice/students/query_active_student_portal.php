<?php 
// Update Registration Number
if(isset($_POST['update_regno'])) {
	
	for($i=0; $i <sizeof($_POST['std_id']); $i++){
		$admission_year = date('Y' , strtotime(cleanvars($_POST['std_admissiondate'][$i])));
		$campus_code = str_replace(" ","", $_POST['campus_code'][$i]);
		$chkregno = $admission_year.'-'.$campus_code.'-0';

		$sqllmsCheck	= $dblms->querylms("SELECT std_id, std_regno
												FROM ".STUDENTS."
												WHERE std_regno LIKE '".$chkregno."%'
												ORDER BY std_regno DESC LIMIT 1");
		if(mysqli_num_rows($sqllmsCheck)>0){
			$valueCheck = mysqli_fetch_array($sqllmsCheck);
			$regno = $valueCheck['std_regno'];
			$regno++;
		}else{
			$regno = $admission_year.'-'.$campus_code.'-000001';
		}

		$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
											  std_regno		= '".$regno."'  
											, update_status	= '1'  
											  WHERE std_id	= '".$_POST['std_id'][$i]."' ");
	}
	if($sqllmsLoginID){
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: active_student_portal.php", true, 301);
		exit();
	}
}

// Create Student Portal
if(isset($_POST['student_portal'])) {

	for ($i=0; $i < sizeof($_POST['std_id']); $i++){
		
		// password salt
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

		// Password
		$pass = 'ags786';

		// hash password
		$password = hash('sha256', $pass . $salt);
		for($round = 0; $round < 65536; $round++) {
			$password = hash('sha256', $password . $salt);
		}

		$sqllmsCheck	= $dblms->querylms("SELECT adm_id
											FROM ".ADMINS."
											WHERE adm_status = '1' 
											AND adm_username = '".cleanvars($_POST['std_regno'][$i])."'
											AND is_deleted = '0'
											ORDER BY adm_id ASC LIMIT 1");
		if(mysqli_num_rows($sqllmsCheck) > 0){
			$resultCheck = mysqli_fetch_array($sqllmsCheck);
			$sqllmsLogin = $dblms->querylms("UPDATE ".ADMINS." SET  
														  adm_status	=	'1'
														, adm_type		=	'0'
														, adm_logintype	=	'5'
														, adm_username	=	'".cleanvars($_POST['std_regno'][$i])."'
														, adm_salt		=	'".cleanvars($salt)."'
														, adm_userpass	=	'".cleanvars($password)."'
														, adm_fullname	=	'".cleanvars($_POST['std_name'][$i])."'
														, adm_phone		=	'".cleanvars($_POST['std_phone'][$i])."'
														, id_campus		=	'".cleanvars($_POST['id_campus'][$i])."'
														, id_modify		=	'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
														, date_modify	=	Now()	
														WHERE adm_id	=	'".cleanvars($resultCheck['adm_id'])."' ");
			if($sqllmsLogin){
				// Update LogoinID
				$adm_id = cleanvars($resultCheck['adm_id']);

				$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
																id_loginid		= '".cleanvars($adm_id)."'  
																WHERE std_id	= '".cleanvars($_POST['std_id'][$i])."' ");
			}
		}else{
			// Insert
			$sqllmsLogin  = $dblms->querylms("INSERT INTO ".ADMINS."(
																	  adm_status  
																	, adm_type
																	, adm_logintype 
																	, adm_username 
																	, adm_salt
																	, adm_userpass
																	, adm_fullname
																	, adm_phone
																	, id_campus
																	, id_added
																	, date_added
																)
															VALUES(
																	  '1'
																	, '0'
																	, '5'
																	, '".cleanvars($_POST['std_regno'][$i])."'
																	, '".cleanvars($salt)."'
																	, '".cleanvars($password)."'
																	, '".cleanvars($_POST['std_name'][$i])."'
																	, '".cleanvars($_POST['std_phone'][$i])."'
																	, '".cleanvars($_POST['id_campus'][$i])."'
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
																	, Now()	
																)");

			if($sqllmsLogin){
			// Update LogoinID
			$adm_id = $dblms->lastestid();

			$sqllmsLoginID = $dblms->querylms("UPDATE ".STUDENTS." SET  
															id_loginid		= '".cleanvars($adm_id)."'  
															WHERE std_id	= '".cleanvars($_POST['std_id'][$i])."' ");
			}
		}
	}
		
	$_SESSION['msg']['title'] 	= 'Successfully';
	$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
	$_SESSION['msg']['type'] 	= 'success';
	header("Location: active_student_portal.php", true, 301);
	exit();
}
?>
