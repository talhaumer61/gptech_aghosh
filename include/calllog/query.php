<?php 
//----------------call insert record----------------------
if(isset($_POST['submit_call'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT phone  
										FROM ".CALLLOG." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND phone = '".cleanvars($_POST['phone'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: call_log.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
$next_date= date('Y-m-d' , strtotime(cleanvars($_POST['next_followupdate'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".CALLLOG."(
														status						, 
														name						, 
														phone	                    , 
														dated					    , 
														detail				       	, 
														next_followupdate	        ,
														duration				    ,
														note                        ,
														call_type	                ,
														id_campus                   ,
														id_added					, 
														date_added	                
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'		        , 
														'".cleanvars($_POST['name'])."'	     			,
														'".cleanvars($_POST['phone'])."'	        	, 
														'".cleanvars($dated)."'	     		,
														'".cleanvars($_POST['detail'])."'				,
														'".cleanvars($next_date)."'	, 
														'".cleanvars($_POST['duration'])."'			    ,
														'".cleanvars($_POST['note'])."'				    ,
														'".cleanvars($_POST['call_type'])."'			,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'                             ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'                                ,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add call: "'.cleanvars($_POST['phone']).'" detail';
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
		header("Location: call_log.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------cal log update reocrd----------------------
if(isset($_POST['changes_call'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
$next_date= date('Y-m-d' , strtotime(cleanvars($_POST['next_followupdate'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".CALLLOG." SET  
											       status				= '".cleanvars($_POST['status'])."'   						,
												   name		    		= '".cleanvars($_POST['name'])."'     						,
												   phone				= '".cleanvars($_POST['phone'])."'    						,
												   dated				= '".cleanvars($dated)."'    		  						,
												   detail				= '".cleanvars($_POST['detail'])."'   						, 
												   next_followupdate  	= '".cleanvars($next_date)."' 	      						,
												   duration	  			= '".cleanvars($_POST['duration'])."'                       ,
												   note		  			= '".cleanvars($_POST['note'])."'       					,  	
												   call_type  			= '".cleanvars($_POST['call_type'])."' 						,
												   id_campus	  		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."',
												   id_modify  			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 	,
												   date_modify			= NOW()
   											  WHERE id	= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update call: "'.cleanvars($_POST['phone']).'" details';
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
			header("Location: call_log.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


