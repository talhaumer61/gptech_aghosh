<?php 
//---------------add investor's info----------------------
if(isset($_POST['submit_investor'])) { 
	$sqllmscheck  = $dblms->querylms("SELECT inv_cnic  
										FROM ".INVESTORS." 
										WHERE inv_cnic = '".cleanvars($_POST['inv_cnic'])."' LIMIT 1");
	if(mysqli_num_rows($sqllmscheck)) {
//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: investors.php", true, 301);
		exit();
//--------------------------------------
	} else { 
//-----------------------Refromat the Date------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//----------------------------------------------------------------
	$sqllms  = $dblms->querylms("INSERT INTO ".INVESTORS."(
														inv_status							,
														inv_name							, 
														inv_cnic							, 
														inv_email							, 
														inv_phone							, 
														inv_add								,
														id_type								,
														dated								,
														purposeful_building					,
														rooms								,
														school_building						,
														building_type						,
														covered_area						,
														uncovered_area						,
														existing_school_name				,
														existing_school_add					,
														existing_school_type				,
														existing_school_medium				,
														male_students						,
														female_students						,
														male_teachers						,
														female_teachers						,
														fee_structure						,
														planned_investment					,
														financing_type						,
														additional_info						,
														id_added							,
														date_added
															
													  )
	   											VALUES(		 
														'".cleanvars($_POST['inv_status'])."'					,
														'".cleanvars($_POST['inv_name'])."'						,
														'".cleanvars($_POST['inv_cnic'])."'						,
														'".cleanvars($_POST['inv_email'])."'					, 
														'".cleanvars($_POST['inv_phone'])."'					,
														'".cleanvars($_POST['inv_add'])."'						,
														'".cleanvars($_POST['id_type'])."'						,
														'".cleanvars($_POST['dated'])."'						,
														'".cleanvars($_POST['purposeful_building'])."'			,
														'".cleanvars($_POST['rooms'])."'						,
														'".cleanvars($_POST['school_building'])."'				, 
														'".cleanvars($_POST['building_type'])."'				,
														'".cleanvars($_POST['covered_area'])."'					,
														'".cleanvars($_POST['uncovered_area'])."'				, 
														'".cleanvars($_POST['existing_school_name'])."'			,
														'".cleanvars($_POST['existing_school_add'])."'			,
														'".cleanvars($_POST['existing_school_type'])."'			, 
														'".cleanvars($_POST['existing_school_medium'])."'		,		
														'".cleanvars($_POST['male_students'])."'				,
														'".cleanvars($_POST['female_students'])."'				,	 
														'".cleanvars($_POST['male_teachers'])."'				,
														'".cleanvars($_POST['female_teachers'])."'				,
														'".cleanvars($_POST['fee_structure'])."'				, 
														'".cleanvars($_POST['planned_investment'])."'			,			
														'".cleanvars($_POST['financing_type'])."'				,	
														'".cleanvars($_POST['additional_info'])."'				,
														'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
														 Now()	
													  )"
							);
//-----------------getting last id-----------------
$id_inv = $dblms->lastestid();	

//-----------------------add investor's educations------------------------
for($i=1; $i<= 4; $i++){
	$sqllms  = $dblms->querylms("INSERT INTO ".INVESTOR_EDUCATION."(
														qualification	,
														institution		,
														passing_year	,
														id_inv							
															
													  )
	   											VALUES(		 
														'".cleanvars($_POST['qualification'][$i])."'	,
														'".cleanvars($_POST['institution'][$i])."'		,
														'".cleanvars($_POST['passing_year'][$i])."'		,
														'".cleanvars($id_inv)."'				
													  )"
							);
}
//-----------------------add investor's experience------------------------
for($i=1; $i<= 3; $i++){
	$sqllms  = $dblms->querylms("INSERT INTO ".INVESTOR_EXPERIENCE."(
														institution_or_firm		,
														years_of_experience		,
														id_inv							
															
													  )
	   											VALUES(		 
														'".cleanvars($_POST['institution_or_firm'][$i])."'		,
														'".cleanvars($_POST['years_of_experience'][$i])."'		,
														'".cleanvars($id_inv)."'
													  )"
							);
}
//-----------------------add investor's franchies locations------------------------
for($i=1; $i<= 3; $i++){
	$sqllms  = $dblms->querylms("INSERT INTO ".INVESTOR_FRANCHISE."(
														city			,
														location		,
														id_inv							
															
													  )
	   											VALUES(		 
														'".cleanvars($_POST['city'][$i])."'			,
														'".cleanvars($_POST['location'][$i])."'		,
														'".cleanvars($id_inv)."'
													  )"
							);
}
//-----------------------add investor's same vicinity------------------------
for($i=1; $i<= 3; $i++){
	$sqllms  = $dblms->querylms("INSERT INTO ".INVESTOR_VICINITY."(
														school_name			,
														no_of_students		,
														fee_structure		,
														id_inv							
															
													  )
	   											VALUES(		 
														'".cleanvars($_POST['school_name'][$i])."'			,
														'".cleanvars($_POST['no_of_students'][$i])."'		,
														'".cleanvars($_POST['fee_structure'][$i])."'		,
														'".cleanvars($id_inv)."'
													  )"
							);
}
//--------------------------------------


	if($sqllms) { 
//------------------ log record --------------------
	$remarks = 'Add Investor: "'.cleanvars($_POST['cnic']).'" detail';
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
		header("Location: investors.php", true, 301);
		exit();
//--------------------------------------
	}
//--------------------------------------
	} // end checker
//--------------------------------------
} 
//---------------- Investor Personal Info Update ----------------------
if(isset($_POST['changes_personal_info'])) { 
//-----------------------Refromat the Date------------------------
$dated = date('Y-m-d' , strtotime(cleanvars($_POST['dated'])));
//----------------------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVESTORS." SET  
													inv_status			= '".cleanvars($_POST['inv_status'])."'
												  ,	inv_name			= '".cleanvars($_POST['inv_name'])."'
												  , inv_cnic			= '".cleanvars($_POST['inv_cnic'])."' 
												  , inv_email			= '".cleanvars($_POST['inv_email'])."'
												  , inv_phone			= '".cleanvars($_POST['inv_phone'])."' 
												  , dated				= '".cleanvars($dated)."'
   											  WHERE inv_id				= '".cleanvars($_POST['inv_id'])."'
											  ");
//------------------------------------------------
for($i=1; $i<= 4; $i++){
$sqllms  = $dblms->querylms("UPDATE ".INVESTOR_EDUCATION." SET  
													qualification		= '".cleanvars($_POST['qualification'][$i])."'
												  , institution			= '".cleanvars($_POST['institution'][$i])."' 
												  , passing_year		= '".cleanvars($_POST['passing_year'][$i])."'
   											  	WHERE id_inv			= '".cleanvars($_POST['inv_id'])."'
											  ");
}
//----------------------------------------------
for($i=1; $i<= 3; $i++){
$sqllms  = $dblms->querylms("UPDATE ".INVESTOR_EXPERIENCE." SET  
													institution_or_firm		= '".cleanvars($_POST['institution_or_firm'][$i])."'
												  , years_of_experience		= '".cleanvars($_POST['years_of_experience'][$i])."' 
   											 	WHERE id_inv				= '".cleanvars($_POST['inv_id'])."'
											  ");
}
//--------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Investor Personal Info: "'.cleanvars($_POST['inv_cnic']).'" details';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
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
			header("Location: investors.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}

//---------------- Investor Franchies Update ----------------------
if(isset($_POST['franchise_info'])) { 
for($i=1; $i<= 3; $i++){
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVESTOR_FRANCHISE." SET  
														city			= '".cleanvars($_POST['city'][$i])."'
												  	,	location			= '".cleanvars($_POST['location'][$i])."'
   											  	  WHERE id_inv				= '".cleanvars($_POST['id'])."'
											  ");
}
//------------------------------------------------
$sqllms  = $dblms->querylms("UPDATE ".INVESTORS." SET  
													id_type					= '".cleanvars($_POST['id_type'])."'
												,	purposeful_building		= '".cleanvars($_POST['purposeful_building'])."'
												,	rooms					= '".cleanvars($_POST['rooms'])."'
												,	school_building			= '".cleanvars($_POST['school_building'])."'
												,	building_type			= '".cleanvars($_POST['building_type'])."'
												,	covered_area			= '".cleanvars($_POST['covered_area'])."'
												,	uncovered_area			= '".cleanvars($_POST['uncovered_area'])."'
												,	existing_school_name	= '".cleanvars($_POST['existing_school_name'])."'
												,	existing_school_add		= '".cleanvars($_POST['existing_school_add'])."'
												,	existing_school_type	= '".cleanvars($_POST['existing_school_type'])."'
												,	existing_school_medium	= '".cleanvars($_POST['existing_school_medium'])."'
												,	female_students			= '".cleanvars($_POST['female_students'])."'
												,	male_students			= '".cleanvars($_POST['male_students'])."'
												,	female_teachers			= '".cleanvars($_POST['female_teachers'])."'
												,	male_teachers			= '".cleanvars($_POST['male_teachers'])."'
												,	fee_structure			= '".cleanvars($_POST['fee_structure'])."'
												,	planned_investment		= '".cleanvars($_POST['planned_investment'])."'
												,	financing_type			= '".cleanvars($_POST['financing_type'])."'
												,	additional_info			= '".cleanvars($_POST['additional_info'])."'
   											  	WHERE inv_id				= '".cleanvars($_POST['id'])."'
											  ");
//----------------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Investor, Franchies Info: "'.cleanvars($_POST['planned_investment']).'" details';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
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
			header("Location: investors.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}


//---------------- Investor, School in same Vicinity Update ----------------------
if(isset($_POST['vicinity_info'])) { 
//------------------------------------------------
for($i=1; $i<= 3; $i++){
$sqllms  = $dblms->querylms("UPDATE ".INVESTOR_VICINITY." SET  
														school_name			= '".cleanvars($_POST['school_name'][$i])."'
												  	,	no_of_students		= '".cleanvars($_POST['no_of_students'][$i])."'
												  	,	fee_structure		= '".cleanvars($_POST['fee_structure'][$i])."'
   											  	  WHERE id_inv				= '".cleanvars($_POST['id'])."'
											  ");
}
//------------------------------------------------
	if($sqllms) { 
//--------------------------------------
	$remarks = 'Update Investor, Same Vicinity Info: "'.cleanvars($_POST['planned_investment']).'" details';
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
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
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
			header("Location: investors.php", true, 301);
			exit();
//--------------------------------------
	}
//--------------------------------------
}