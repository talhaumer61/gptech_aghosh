<?php 
//----------------insert record ----------------------
//---- make record check if already exist -----
if(isset($_POST['submit_donation'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_std, id_donor
										FROM ".DONATIONS_STUDENTS." 
										WHERE id_std = '".cleanvars($_POST['id_std'])."' 
										AND id_donor = '".cleanvars($_POST['id_donor'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: donations.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".DONATIONS_STUDENTS."(
														status				, 
														id_std				,
														id_donor			,  
														amount				,
														duration			, 
														id_campus			, 
														id_added			,
														date_added		
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'						, 
														'".cleanvars($_POST['id_std'])."'						,
														'".cleanvars($_POST['id_donor'])."'						,
														'".cleanvars($_POST['amount'])."'						,
														'".cleanvars($_POST['duration'])."'						,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()
													  )"
							);
//-------------------------Get latest Id----------------------- 
$latestId = $dblms->lastestid();	
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Student Donation , ID: "'.cleanvars($latestId).'" detail';
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
		header("Location: donations.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------- Donation UPdate ----------------------
if(isset($_POST['changes_donation'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".DONATIONS_STUDENTS." SET  
									  status	= '".cleanvars($_POST['status'])."'
									, id_donor	= '".cleanvars($_POST['id_donor'])."' 
									, amount	= '".cleanvars($_POST['amount'])."' 
									, duration	= '".cleanvars($_POST['duration'])."' 
								WHERE id 		= '".cleanvars($_POST['id'])."'
							");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Donation, ID: "'.cleanvars($_POST['id']).'" details';
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
			header("Location: donations.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

