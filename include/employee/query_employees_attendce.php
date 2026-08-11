<?php 
//----------------employees attendce insert----------------------
if(isset($_POST['submit_attendance'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT dated  
										FROM ".EMPLOYEES_ATTENDCE." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND dated = '2020-02-28' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck) == 0) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: attendance-employees_control.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".EMPLOYEES_ATTENDCE."(						 
										dated							, 
										id_campus 						,	
										id_added						,		
										date_added
									)
								VALUES(
										'2020-02-28'							,
										'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'  ,
										'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 	,
										NOW()	
									)"
								);
	$idsetup = $dblms->lastestid();
//----------------------------------------------
	for($i=0;$i<=sizeof($_POST['id_emply']);$i++){
		$sqllmsdetail  = $dblms->querylms("INSERT INTO ".EMPLOYEES_ATTENDCE_DETAIL."(				 
											id_setup					, 
											id_dept						,
											id_emply 					,	
											status		
											
										)
									VALUES(
											'".cleanvars($idsetup)."'  				 ,
											'".cleanvars($_POST['id_dept'][$i])."'  ,
											'".cleanvars($_POST['id_emply'][$i])."'  ,
											'".cleanvars($_POST['arr'][$i])."'  
										)"
								);
	}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Employees attendce insert: "'.cleanvars($idsetup).'" detail';
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
		header("Location: attendance-employees_control.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Employees Attendance update reocrd----------------------
if(isset($_POST['update_attendance'])) { 
$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES_ATTENDCE." SET  
											dated		= '".cleanvars($_POST['timestamp'])."'
										  , id_modify				= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
										  , date_modify		= NOW() 
										  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
									 WHERE id			= '".cleanvars($_POST['iddd'])."'");

//----------------------------------------------
$empyi=$_POST['arrr'];
$empyi=$_POST['empliy_id'];

for($i=1;$i<=sizeof($empyi);$i++){
$sqllms  = $dblms->querylms("UPDATE ".EMPLOYEES_ATTENDCE_DETAIL." SET  
											
										  status				= '".cleanvars($_POST['arrr'][$i])."' 
										  WHERE id_emply = '".cleanvars($_POST['empliy_id'][$i])."'
										  AND id_setup = '".cleanvars($_POST['iddd'])."'");


}
if($sqllms) { 
//--------------------------------------
	$remarks = 'Attendance Employees Update: "'.cleanvars($_POST['empliy_id']).'" details';
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
			header("Location: attendance-employees_control.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}



?>