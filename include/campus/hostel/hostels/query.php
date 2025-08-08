<?php 
//----------------Hostel insert record----------------------
if(isset($_POST['submit_hostel'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT hostel_name  
										FROM ".HOSTELS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND hostel_name = '".cleanvars($_POST['hostel_name'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostels.php", true, 301);
		exit();
//--------------------------------------
	} else { 
    //------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".HOSTELS."(
														hostel_status						, 
														hostel_name							, 
														hostel_phone						, 
														hostel_warden						,
														id_type								, 
														hostel_address						,
														hostel_detail						, 
														id_campus                           ,
                                                        id_added                            ,
                                                        id_modify	
													  )
	   											VALUES(
														'".cleanvars($_POST['hostel_status'])."'		                , 
														'".cleanvars($_POST['hostel_name'])."'			                ,
														'".cleanvars($_POST['hostel_phone'])."'		                    ,
														'".cleanvars($_POST['hostel_warden'])."'		                ,
														'".cleanvars($_POST['id_type'])."'				                ,
														'".cleanvars($_POST['hostel_address'])."'		                ,
														'".cleanvars($_POST['hostel_detail'])."'		                ,
														'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'	    ,
                                                        '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
                                                        Now()
													  )"
							);
    //-------- Get latest Id --------------- 
    $idsetup = $dblms->lastestid();	
    //--------------------------------------
    if($sqllms) { 
        //--------------------------------------
        $remarks = 'Add Hostel: "'.cleanvars($_POST['hostel_name']).'", ID: '.$idsetup.' detail';
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
            header("Location: hostels.php", true, 301);
            exit();
        //--------------------------------------
    }
    //--------------------------------------
} // end checker
//--------------------------------------
} 
//----------------Hostelupdate reocrd----------------------
if(isset($_POST['changes_hostel'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".HOSTELS." SET  
													hostel_status		= '".cleanvars($_POST['hostel_status'])."'
												  , hostel_name			= '".cleanvars($_POST['hostel_name'])."' 
												  , hostel_phone		= '".cleanvars($_POST['hostel_phone'])."' 
												  , hostel_warden		= '".cleanvars($_POST['hostel_warden'])."' 
												  , id_type				= '".cleanvars($_POST['id_type'])."' 
												  , hostel_address		= '".cleanvars($_POST['hostel_address'])."' 
												  , hostel_detail		= '".cleanvars($_POST['book_detail'])."' 
												  , id_campus			= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
                                                  , id_modify           = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
                                                  , date_modify         = Now()
   											  WHERE hostel_id			= '".cleanvars($_POST['hostel_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel: "'.cleanvars($_POST['hostel_name']).'", ID: '.cleanvars($_POST['hostel_id']).' details';
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
			header("Location: hostels.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>