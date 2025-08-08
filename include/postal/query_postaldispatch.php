<?php 
//----------------Hostel insert record----------------------
//---- make hostel check if already exist---
if(isset($_POST['submit_postaldispatch'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT reference_no  
										FROM ".POSTAL_DISPATCH." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND reference_no = '".cleanvars($_POST['reference_no'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: postaldispatch.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".POSTAL_DISPATCH."(
														status									, 
														to_title								,
														to_phone								,
														to_email								,														
														reference_no							,														
														address									,														
														note									,														
														from_title								,														
														dated									,																											
														id_campus 								,
														id_added 								,
														date_added 								
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'				, 
														'".cleanvars($_POST['to_title'])."'				,
														'".cleanvars($_POST['to_phone'])."'				,
														'".cleanvars($_POST['to_email'])."'				,
														'".cleanvars($_POST['reference_no'])."'			,
														'".cleanvars($_POST['address'])."'				,
														'".cleanvars($_POST['note'])."'					,
														'".cleanvars($_POST['from_title'])."'			,
														'".cleanvars($dated)."'				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														NOW()
													  )
									");
									
	$postal_id = $dblms->lastestid();
	//--------------------------------------
	if(!empty($_FILES['attachment']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["attachment"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/postaldispatch/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['reference_no'].'-'.$_POST['from_title'])).'_'.$postal_id.".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['reference_no'].'-'.$_POST['from_title'])).'_'.$postal_id.".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".POSTAL_DISPATCH."
															SET attachment = '".$img_fileName."'
														 WHERE  id 		   = '".cleanvars($postal_id)."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['attachment']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Postal Dispatch: "'.cleanvars($_POST['reference_no']).'" detail';
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
		header("Location: postaldispatch.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------class update reocrd----------------------
if(isset($_POST['changes_postaldispatch'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".POSTAL_DISPATCH." SET  
													status		        = '".cleanvars($_POST['status'])."'
												  , to_title			= '".cleanvars($_POST['to_title'])."' 
												  , to_phone			= '".cleanvars($_POST['to_phone'])."' 
												  , to_email			= '".cleanvars($_POST['to_email'])."' 
												  , reference_no		= '".cleanvars($_POST['reference_no'])."' 
												  , address				= '".cleanvars($_POST['address'])."' 
												  , note				= '".cleanvars($_POST['note'])."' 
												  , from_title			= '".cleanvars($_POST['from_title'])."' 
												  , dated				= '".cleanvars($dated)."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												   ,date_modify  = NOW()
   											        WHERE id			= '".cleanvars($_POST['id'])."'
													");
//--------------------------------------
if(!empty($_FILES['attachment']['name'])) { 
	//--------------------------------------
		$path_parts 	= pathinfo($_FILES["attachment"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		$img_dir 	= 'uploads/postaldispatch/';
	//--------------------------------------
		$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['reference_no'].'-'.$_POST['from_title'])).'_'.$_POST['id'].".".($extension);
		$img_fileName	= to_seo_url(cleanvars($_POST['reference_no'].'-'.$_POST['from_title'])).'_'.$_POST['id'].".".($extension);
	//--------------------------------------
		if(in_array($extension , array('pdf','ppt', 'docx'))) { 
	//--------------------------------------
			$sqllmsupload  = $dblms->querylms("UPDATE ".POSTAL_DISPATCH."
															SET attachment = '".$img_fileName."'
															WHERE  id 		   = '".cleanvars($_POST['id'])."'");
			unset($sqllmsupload);
			$mode = '0644'; 
	//--------------------------------------	
			move_uploaded_file($_FILES['attachment']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
	//--------------------------------------
		}
	//--------------------------------------
	}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Postal Dispatch: "'.cleanvars($_POST['reference_no']).'" details';
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
			header("Location: postaldispatch.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

