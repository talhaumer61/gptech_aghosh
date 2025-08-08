<?php 
//----------------Hostel insert record----------------------
//---- make hostel check if already exist---
if(isset($_POST['submit_books'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT book_name  
										FROM ".LMS_BOOKS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND book_name = '".cleanvars($_POST['book_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-------------if already exist -------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: lms_books.php", true, 301);
		exit();
//------------if not exist--------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".LMS_BOOKS."(
														book_status						,
														book_code						, 
														book_name						, 
														book_author						, 
														book_isbn						, 
														id_cat						, 
														book_publisher						, 
														book_price						, 
														book_rackno						, 														
														book_qty							,
														book_detail							,  
														id_campus 	
													  )
	   											VALUES(
														'".cleanvars($_POST['book_status'])."'		, 
														'".cleanvars($_POST['book_code'])."'		, 
														'".cleanvars($_POST['book_name'])."'		, 
														'".cleanvars($_POST['book_author'])."'		, 
														'".cleanvars($_POST['book_isbn'])."'		, 
														'".cleanvars($_POST['id_cat'])."'		, 
														'".cleanvars($_POST['book_publisher'])."'		, 
														'".cleanvars($_POST['book_price'])."'		, 
														'".cleanvars($_POST['book_rackno'])."'		, 
														'".cleanvars($_POST['book_qty'])."'			,
														'".cleanvars($_POST['book_detail'])."'				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	
													  )"
							);
//-----------------------end---------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add Books: "'.cleanvars($_POST['book_name']).'" detail';
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
		header("Location: lms_books.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------class update reocrd----------------------
if(isset($_POST['changes_books'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".LMS_BOOKS." SET  
													book_status		= '".cleanvars($_POST['book_status'])."'
												  , book_code			= '".cleanvars($_POST['book_code'])."' 
												  , book_name			= '".cleanvars($_POST['book_name'])."' 
												  , book_author			= '".cleanvars($_POST['book_author'])."' 
												  , book_isbn			= '".cleanvars($_POST['book_isbn'])."' 
												  , id_cat			= '".cleanvars($_POST['id_cat'])."' 
												  , book_publisher			= '".cleanvars($_POST['book_publisher'])."' 
												  , book_price			= '".cleanvars($_POST['book_price'])."' 
												  , book_rackno			= '".cleanvars($_POST['book_rackno'])."' 
												  , book_qty			= '".cleanvars($_POST['book_qty'])."' 												  
												  , book_detail				= '".cleanvars($_POST['book_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
   											  WHERE book_id			= '".cleanvars($_POST['book_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Books: "'.cleanvars($_POST['book_name']).'" details';
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
			header("Location: lms_books.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

