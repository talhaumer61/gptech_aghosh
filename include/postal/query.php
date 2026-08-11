<?php 
//----------------postal insert record----------------------
if(isset($_POST['submit_postal'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT from_title  
										FROM ".POSTAL_RECEIVED." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND from_title = '".cleanvars($_POST['from_title'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: postal_receive.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".POSTAL_RECEIVED."(
														status						, 
														from_title					, 
														from_phone	                , 
														from_email				    , 
														reference_no		      	, 
														address	                    ,
														note				        ,
														to_title	                , 
														dated				      	, 
														attachment			      	, 
														id_campus                   ,
														id_added					, 
														date_added	                
														 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'		    , 
														'".cleanvars($_POST['from_title'])."'	    ,
														'".cleanvars($_POST['from_phone'])."'		,
														'".cleanvars($_POST['from_email'])."'		,
														'".cleanvars($_POST['reference_no'])."'	    ,
														'".cleanvars($_POST['address'])."'	  	    ,
														'".cleanvars($_POST['note'])."'     	    , 
														'".cleanvars($_POST['to_title'])."'         ,
														'".cleanvars($_POST['dated'])."'			,
														'".cleanvars($_POST['attachment'])."'		, 
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'                         ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'                            ,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add postal : "'.cleanvars($_POST['from_title']).'" detail';
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
		header("Location: postal_receive.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------postal update reocrd--------
														
if(isset($_POST['changes_postal'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".POSTAL_RECEIVED." SET  
													status     
													= '".cleanvars($_POST['status'])."' 	 	    ,
												    from_title	
													= '".cleanvars($_POST['from_title'])."' 	    , 
												    from_phone	
													= '".cleanvars($_POST['from_phone'])."'    		, 
												    from_email	
													= '".cleanvars($_POST['from_email'])."'  		,
												    reference_no
													= '".cleanvars($_POST['reference_no'])."'        ,
												    address	
													= '".cleanvars($_POST['address'])."'              , 
												    note
													= '".cleanvars($_POST['note'])."'                 , 
													to_title
													= '".cleanvars($_POST['to_title'])."'             ,
												    dated
													= '".cleanvars($_POST['dated'])."'                , 
													attachment  
													= '".cleanvars($_POST['attachment'])."'           , 
												    id_campus
													= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'                               ,
												   id_modify	
												   = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'                                  ,
												    date_modify		= NOW()
   											        WHERE id		= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update visitor: "'.cleanvars($_POST['from_title']).'" details';
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
			header("Location: postal_receive.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


