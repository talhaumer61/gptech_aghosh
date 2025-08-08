<?php 
//----------------Fee Challan insert record----------------------
if(isset($_POST['challans_generate'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT id_session, id_class, id_section
										FROM ".FEES." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
										AND id_session 	= '".cleanvars($_POST['id_session'])."'
										AND id_class 	= '".cleanvars($_POST['id_class'])."'
										AND id_section 	= '".cleanvars($_POST['id_section'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: fee_challansgenerate.php", true, 301);
		exit();
//--------------------------------------
	} else { 						   
		//------------------------Reformat Date------------------------
		$challandate	= date('Ym');
		$issue_date = date('Y-m-d' , strtotime(cleanvars($_POST['issue_date'])));
		$due_date = date('Y-m-d' , strtotime(cleanvars($_POST['due_date'])));
		//------------------------------------------------	
		$stdsqllmsstudent	= $dblms->querylms("SELECT s.std_id, std_firstname, s.id_class, s.id_section, s.id_campus
											FROM ".STUDENTS." s
											WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
											AND s.id_class = '".cleanvars($_POST['id_class'])."'
											AND s.id_section = '".cleanvars($_POST['id_section'])."'
											ORDER BY s.std_id ASC");
		while($value_std = mysqli_fetch_array($stdsqllmsstudent)) {

			//----------------------Challan Number-------------------------
			$sqllmschallan 	= $dblms->querylms("SELECT challan_no FROM ".FEES." 
											WHERE challan_no LIKE '".$challandate."%'  
											ORDER by challan_no DESC LIMIT 1 ");
			$rowchallan 	= mysqli_fetch_array($sqllmschallan);
			if(mysqli_num_rows($sqllmschallan) < 1) {
				$challano	= $challandate.'00001';
			} else  {
				$challano = ($rowchallan['challan_no'] +1);
			}
			//----------------------Challan Number-------------------------
			$sqllms  = $dblms->querylms("INSERT INTO ".FEES."(
																status						, 
																challan_no					, 
																id_session					, 
																id_class					, 
																id_section					,
																id_std						,
																issue_date					,
																due_date					,
																total_amount				,
																note						, 
																id_campus 					,
																id_added					,
																date_added					,
																is_deleted
															)
														VALUES(
																'3'																,
																'".cleanvars($challano)."'									,
																'1'																, 
																'".cleanvars($_POST['id_class'])."'								,
																'".cleanvars($_POST['id_section'])."'							,
																'".cleanvars($value_std['std_id'])."'							,
																'".cleanvars($issue_date)."'									, 
																'".cleanvars($due_date)."'										,
																'".cleanvars($_POST['total_amount'])."'							,
																'".cleanvars($_POST['note'])."'									,
																'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
																'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
																Now()															,
																'1'
															)"
													);

			//-------------------------Fee Particulars Detail-----------------------
			if($sqllms) { 
				//-------------------------Get latest Id----------------------- 
				$idsetup = $dblms->lastestid();	
			//--------------------------------------
					for($i=1; $i<= count($_POST['id_cat']); $i++){
						$sqllms  = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
																		id_fee			,
																		id_cat			,
																		amount						
																	)
																VALUES(
																		'".cleanvars($idsetup)."'						,
																		'".cleanvars($_POST['id_cat'][$i])."'			,
																		'".cleanvars($_POST['amount'][$i])."'			
																	)
																	");
		
					}
		
				$remarks = 'Add Bulk Fee Challans: "'.cleanvars($_POST['id_section']).'" detail';
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
																		'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
																		'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
																		'1'																	, 
																		NOW()																,
																		'".cleanvars($ip)."'												,
																		'".cleanvars($remarks)."'						,
																		'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
																	)
												");
			//--------------------------------------
					$_SESSION['msg']['title'] 	= 'Successfully';
					$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
					$_SESSION['msg']['type'] 	= 'success';
					header("Location: fee_challansgenerate.php", true, 301);
					exit();
			//--------------------------------------
			} //
			//--------------------------------------
		}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//----------------update Feeetup reocrd----------------------
if(isset($_POST['changes_feesetup'])) {
	
//------------------------Reformat Date------------------------
$date = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".FEESETUP." SET  
													status			= '".cleanvars($_POST['status'])."'
												  , dated			= '".cleanvars($date)."' 
												  , id_class		= '".cleanvars($_POST['id_class'])."' 
												  , id_section		= '".cleanvars($_POST['id_section'])."' 
												  , id_session		= '".cleanvars($_POST['id_session'])."'
												  , id_campus		= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												  , id_modify		= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' 
												  ,	date_modify		= Now()
   											  WHERE id				= '".cleanvars($_GET['id'])."'");
											  
//----------------update Feeetup detail reocrd----------------------
for($i=1; $i<= count($_POST['id_cat']); $i++){
//---------------------------------------------
											  
$sqllmss  = $dblms->querylms("UPDATE ".FEESETUPDETAIL." SET  
														amount			= '".cleanvars($_POST['amount'][$i])."'
												 	 , duration			= '".cleanvars($_POST['duration'][$i])."' 
												 	 , type				= '".cleanvars($_POST['type'][$i])."'
   											 	 WHERE id				= '".cleanvars($_POST['id_edit'][$i])."'");
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Feesetup: "'.cleanvars($_POST['type']).'" details';
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
			header("Location: feesetup.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}
