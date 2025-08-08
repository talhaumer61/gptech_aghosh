<?php 
//---------------- Update reocrd ----------------------
if(isset($_POST['changes_paperReceive'])) { 
//------------------------------------------------
if($_POST['receive_status'] == 1)
{
$sqllms  = $dblms->querylms("UPDATE ".EXAM_DELIVERY." SET  
													delivery_status		= '5'
												  ,	receive_status		= '".cleanvars($_POST['receive_status'])."' 
												  , id_modify			= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
												  , date_modify			= NOW()
   											  WHERE delivery_id 		= '".cleanvars($_POST['delivery_id'])."'");

}

	//--------------------------------------										  
	if($sqllms) { 
	//--------------------------------------
		$remarks = 'Campus Updated Exam Paper Delivery ID: "'.cleanvars($_POST['delivery_id']).'" details';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks			
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 	, 
															'2'																, 
															NOW()															,
															'".cleanvars($ip)."'											,
															'".cleanvars($remarks)."'		
														  )
									");
//--------------------------------------
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: exam_paper_delivery.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
