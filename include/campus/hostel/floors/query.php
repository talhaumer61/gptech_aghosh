<?php 
//---------------- insert record ----------------------
if(isset($_POST['submit_floor'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT floor_name  
										FROM ".HOSTEL_FLOORS." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND floor_name = '".cleanvars($_POST['floor_name'])."'
										AND id_hostel  = '".cleanvars($_POST['id_hostel'])."'  LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: hostelFloors.php", true, 301);
		exit();
//--------------------------------------
	} else { 
    //------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".HOSTEL_FLOORS."(
														floor_status						, 
														floor_name							, 
														id_hostel							, 
														id_campus                           ,
                                                        id_added                            ,
                                                        date_added	
													  )
	   											VALUES(
														'".cleanvars($_POST['floor_status'])."'		                , 
														'".cleanvars($_POST['floor_name'])."'			                ,
														'".cleanvars($_POST['id_hostel'])."'		                    ,
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
        $remarks = 'Add Hostel Floor: "'.cleanvars($_POST['floor_name']).'", ID: '.$idsetup.' detail';
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
            header("Location: hostelFloors.php", true, 301);
            exit();
        //--------------------------------------
    }
    //--------------------------------------
} // end checker
//--------------------------------------
} 
//---------------- Update reocrd ----------------------
if(isset($_POST['changes_floor'])) { 
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".HOSTEL_FLOORS." SET  
													floor_status		= '".cleanvars($_POST['floor_status'])."'
												  , floor_name			= '".cleanvars($_POST['floor_name'])."' 
												  , id_hostel			= '".cleanvars($_POST['id_hostel'])."' 
												  , id_modify           = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
                                                  , date_modify         = Now()
   											  WHERE floor_id			= '".cleanvars($_POST['floor_id'])."'");
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Hostel Floor: "'.cleanvars($_POST['floor_name']).'", ID: '.cleanvars($_POST['floor_id']).' details';
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
			header("Location: hostelFloors.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
?>