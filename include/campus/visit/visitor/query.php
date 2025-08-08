<?php 
//----------------expense insert record----------------------
if(isset($_POST['submit_visitor'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT card_no  
										FROM ".VISITOR." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND card_no = '".cleanvars($_POST['card_no'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//-----------------if already exist---------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: visitors.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".VISITOR."(
														status						, 
														id_purpose					, 
														card_no	                    , 
														name					    , 
														phone				      	, 
														email	                    ,
														cnic				        ,
														num_of_person	            , 
														dated				      	, 
														time_in				      	, 
														time_out	                ,
														note	                    , 
														id_campus                   ,
														id_added					, 
														date_added	                
														 	
													  )
	   											VALUES(
														'".cleanvars($_POST['status'])."'		    , 
														'".cleanvars($_POST['id_purpose'])."'	    ,
														'".cleanvars($_POST['card_no'])."'			,
														'".cleanvars($_POST['name'])."'				, 
														'".cleanvars($_POST['phone'])."'	        ,
														'".cleanvars($_POST['email'])."'	  	    ,
														'".cleanvars($_POST['cnic'])."'     	    , 
														'".cleanvars($_POST['num_of_person'])."'    ,
														'".cleanvars($dated)."'			,
														'".cleanvars($_POST['time_in'])."'			, 
														'".cleanvars($_POST['time_out'])."'	  	    ,
														'".cleanvars($_POST['note'])."'	            ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' ,
														NOW()
													  )"
							);
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Add visitor : "'.cleanvars($_POST['card_no']).'" detail';
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
		header("Location: visitors.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------visitor update reocrd----------------------
if(isset($_POST['changes_visitor'])) { 
//------------------------------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".VISITOR." SET  
												, status	 	= '".cleanvars($_POST['status'])."' 
												, id_purpose 	= '".cleanvars($_POST['id_purpose'])."' 	   
												, card_no	 	= '".cleanvars($_POST['card_no'])."'    
												, name 		 	= '".cleanvars($_POST['name'])."'  	
												, phone	 	 	= '".cleanvars($_POST['phone'])."' 			  
												, email			= '".cleanvars($_POST['email'])."'              
												, cnic		 	= '".cleanvars($_POST['cnic'])."'              
												, num_of_person = '".cleanvars($_POST['num_of_person'])."'     
												, dated 		= '".cleanvars($dated)."'              
												, time_in		= '".cleanvars($_POST['time_in'])."'        
												, time_out 		= '".cleanvars($_POST['time_out'])."'          
												, note 			= '".cleanvars($_POST['note'])."'              
												, id_campus 	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'                             
												, id_modify 	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'  
												, date_modify	= NOW()
   											    WHERE id		= '".cleanvars($_POST['id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update visitor: "'.cleanvars($_POST['card_no']).'" details';
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
			header("Location: visitors.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


