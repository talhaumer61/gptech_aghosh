<?php 
//----------------insert record----------------------
if(isset($_POST['submit_class'])) { 
	//------------------------------------------------
	$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
	//------------------------------------------------
	$sqllmscheck  = $dblms->querylms("SELECT zoom_title  
										FROM ".ONLINE_CLASSES." 
										WHERE zoom_title = '".cleanvars($_POST['zoom_title'])."'  
										AND dated  	   = '".$dated."'
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND id_class   = '".cleanvars($_POST['id_class'])."'
										AND id_section = '".cleanvars($_POST['id_section'])."'
										AND id_subject = '".cleanvars($_POST['id_subject'])."'
										AND id_teacher = '".cleanvars($value_emp['emply_id'])."'
										AND id_campus  = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$ref = '?id='.$_POST['id_subject'].'&section='.$_POST['id_section'].'&class='.$_POST['id_class'].'&view=online_classes';
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: subject.php$ref", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".ONLINE_CLASSES."(
														zoom_status							, 
														zoom_title							, 
														dated								, 
														start_time							,
														end_time							,
														zoom_link							,
														zoom_pass							,
														details								, 
														id_session							, 
														id_class							,
														id_section							, 
														id_subject							,
														id_teacher							,
														id_campus							,
														id_added							, 
														date_added 	
													  )
	   											VALUES(
														'".cleanvars($_POST['zoom_status'])."'							, 
														'".cleanvars($_POST['zoom_title'])."'							, 
														'".cleanvars($dated)."'											, 
														'".cleanvars($_POST['start_time'])."'							, 
														'".cleanvars($_POST['end_time'])."'								, 
														'".cleanvars($_POST['zoom_link'])."'							, 
														'".cleanvars($_POST['zoom_pass'])."'							, 
														'".cleanvars($_POST['details'])."'								, 
														'".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'	,
														'".cleanvars($_POST['id_class'])."'								,
														'".cleanvars($_POST['id_section'])."'							,
														'".cleanvars($_POST['id_subject'])."'							,
														'".cleanvars($value_emp['emply_id'])."'							,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
														NOW()
													  )"
							);
		$id_latest = $dblms->lastestid();
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
		$remarks = 'Add Online Class ID: "'.$id_latest.'"';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'1'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'			
														  )
									");
//--------------------------------------
		$ref = '?id='.$_POST['id_subject'].'&section='.$_POST['id_section'].'&class='.$_POST['id_class'].'&view=online_classes';
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
		$_SESSION['msg']['type'] 	= 'success';
		header("Location: subject.php$ref", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------Update reocrd----------------------
if(isset($_POST['changes_class'])) { 
	//------------------------------------------------
	$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".ONLINE_CLASSES." SET  
													zoom_status		= '".cleanvars($_POST['zoom_status'])."'
												  ,	zoom_title		= '".cleanvars($_POST['zoom_title'])."'
												  , dated			= '".cleanvars($dated)."' 
												  , start_time		= '".cleanvars($_POST['start_time'])."'
												  , end_time		= '".cleanvars($_POST['end_time'])."'
												  , zoom_link		= '".cleanvars($_POST['zoom_link'])."'
												  , zoom_pass		= '".cleanvars($_POST['zoom_pass'])."'
												  , details			= '".cleanvars($_POST['details'])."'
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify		= NOW()
   											  WHERE zoom_id 		= '".cleanvars($_POST['zoom_id'])."'");


	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Announcement ID: "'.cleanvars($_POST['ann_id']).'"';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks			
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
			$ref = '?id='.$_GET['id'].'&section='.$_GET['section'].'&class='.$_GET['class'].'&view=online_classes';
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location:  subject.php$ref", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
