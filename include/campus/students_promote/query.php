<?php 
//-------------------------------------------
if(isset($_POST['promote_students'])) { 

	//If Section 
	if(isset($_POST['id_section'])){
		$sectionCheck = "AND id_section = '".cleanvars($_POST['id_section'])."'";
		$sectionUpdate = "".cleanvars($_POST['id_section'])."";
	} else{
		$sectionCheck = "AND id_section = '0'";
		$sectionUpdate = "0";
	}
	
	// All Students
	for($i=1; $i <= (COUNT($_POST['id_std'])); $i++){
		//--------------------------------------
		if(isset($_POST['is_promote'][$i])){

			//Check rollno if already exist then increment
			$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
									FROM ".STUDENTS."
									WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
									AND id_class = '".cleanvars($_POST['id_class'])."'
									$sectionCheck  ");

			if(mysqli_num_rows($sqllmsRoll) > 0 ){
				$valueRoll = mysqli_fetch_array($sqllmsRoll);
				(int)$valueRoll['rollno'];
				$rollno = (int)$valueRoll['rollno'] + 1;
			}
			else{
				$rollno = 1;
			}

			//--------------------------------------
			$sqllms  = $dblms->querylms("UPDATE ".STUDENTS." SET  
															  id_class			= '".cleanvars($_POST['id_class'])."' 
															, id_section		= '".cleanvars($sectionUpdate)."'
															, std_rollno		= '".cleanvars($rollno)."'
															, id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
															, id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
															, date_modify		= NOW()
														WHERE std_id			= '".cleanvars($_POST['id_std'][$i])."'");	
			//--------------------------------------
			if($sqllms){ 
				//--------------------------------------
				$sqllmslog  = $dblms->querylms("INSERT INTO ".STD_PROMOTE_LOG." (
																	  id_std 
																	, class_from
																	, class_to
																	, id_session
																	, dated
																	, id_campus
																	, id_added
																	, date_added

																)
				
															VALUES(
																	  '".cleanvars($_POST['id_std'][$i])."'
																	, '".cleanvars($_POST['class_from'])."'
																	, '".cleanvars($_POST['id_class'])."'
																	, '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
																	, NOW()
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
																	, '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	
																	, NOW()
																)
															");
				
			}
		}
	}

	//--------------------------------------
	if($sqllms) { 
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: students_promote.php", true, 301);
		exit();
	}
}
?>