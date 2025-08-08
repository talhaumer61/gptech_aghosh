<?php
// require_once("../include/dbsetting/lms_vars_config.php");
// require_once("../include/dbsetting/classdbconection.php");
// require_once("../include/functions/functions.php");
// $dblms = new dblms();

// //Query Donors
// $sqllmsDonors	= $dblms->querylms("SELECT donor_id, donor_name, donor_phone, id_campus
// 										FROM ".DONORS."
// 										WHERE donor_status = '1' AND is_deleted != '1'
// 										ORDER BY donor_id ASC");
// if(mysqli_num_rows($sqllmsDonors)> 0){

// 	//Dates
// 	$challandate 	= substr(date('Y'),2,4);
// 	$issue_date 	= date('Y-m-d');
// 	$due_date 		= date('Y-m-d' , strtotime($issue_date. ' + 10 day'));
// 	$month			= date('m');

// 	//While Loop Donors Start
// 	while($rowDonor = mysqli_fetch_array($sqllmsDonors)){

// 		$sqllmsStudents	= $dblms->querylms("SELECT s.std_id, s.std_name, d.amount, d.duration
// 												FROM ".STUDENTS." s
// 												INNER JOIN ".DONATIONS_STUDENTS." d ON d.id_std = s.std_id
// 												WHERE s.std_status = '1' AND s.is_deleted != '1' 
// 												AND d.status = '1' AND d.is_deleted != '1' 
// 												AND d.id_donor = '".$rowDonor['donor_id']."' ORDER BY s.std_name");
// 		if(mysqli_num_rows($sqllmsStudents)> 0){

// 			$studentsArray = array();
// 			$countStudents = 0;
// 			$grandTotal = 0;

// 			while($rowStudent = mysqli_fetch_array($sqllmsStudents)){
						
// 				$studentsArray[] = array (
// 					"std_id"		=> $rowStudent['std_id'],
// 					"std_name"		=> $rowStudent['std_name'],
// 					"amount"	=> ($rowStudent['amount'] * $rowStudent['duration'])
// 				);
// 				$countStudents++;

// 				$grandTotal = ($grandTotal + ($rowStudent['amount'] * $rowStudent['duration']));
// 			}

// 			//Generate Challan Number
			
// 		//----------------------Challan Number-------------------------
// 		$sqllmschallan 	= $dblms->querylms("SELECT challan_no 
// 												FROM ".FEES." 
// 												WHERE challan_no LIKE '9930".$challandate."%'  
// 												ORDER by challan_no DESC LIMIT 1 ");
// 		$rowchallan 	= mysqli_fetch_array($sqllmschallan);
// 		if(mysqli_num_rows($sqllmschallan) < 1) {
// 			$challano	= '9930'.$challandate.'00001';
// 		} else  {
// 			$challano = ($rowchallan['challan_no'] +1);
// 		}

// 			//Current Session
// 			$sqllms_setting	= $dblms->querylms("SELECT acd_session
// 												FROM ".SETTINGS."  
// 												WHERE status ='1' AND is_deleted != '1' LIMIT 1");
// 			$values_setting = mysqli_fetch_array($sqllms_setting);
// 			$session = $values_setting['acd_session'];
		
// 			//Insert Challan
// 			$sqllmsInsert = $dblms->querylms("INSERT INTO ".FEES."(
// 																status						,
// 																id_type						,
// 																challan_no					, 
// 																id_session					, 
// 																id_month					,
// 																id_donor					,
// 																issue_date					,
// 																due_date					,
// 																total_amount				,
// 																id_campus 					,
// 																id_added					,
// 																date_added
// 															)
// 														VALUES(
// 																'2'																,
// 																'3'																,
// 																'".cleanvars($challano)."'										,
// 																'".cleanvars($session)."'										, 
// 																'".cleanvars($month)."'											,
// 																'".cleanvars($rowDonor['donor_id'])."'							,
// 																'".cleanvars($issue_date)."'									, 
// 																'".cleanvars($due_date)."'										,
// 																'".cleanvars($grandTotal)."'									,
// 																'".cleanvars($rowDonor['id_campus'])."'							,
// 																'4'																,
// 																Now()	
// 															)"
// 													);

// 			//If Record Inserted
// 			if($sqllmsInsert) { 

				
// 				//Last Inseted ID
// 				$idsetup = $dblms->lastestid();	

// 				//Iterate over Students Array
// 				foreach($studentsArray as $student){

// 					//Insert in Detail Table
// 					$sqllms  = $dblms->querylms("INSERT INTO ".DONATION_DETAILS."(
// 																id_donation  	,
// 																id_std			,
// 																amount				
// 																)
// 															VALUES(
// 																'".cleanvars($idsetup)."'				,
// 																'".cleanvars($student['std_id'])."'		,
// 																'".cleanvars($student['amount'])."'				
// 																)
// 														");
// 				}

// 				//Insert Remarks
// 				$remarks = 'Auto Donation Challan #"'.cleanvars($challano).'" created';
// 				$sqllmsLog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." ( 
// 															id_user 				,  
// 															action					,
// 															challan_no 				,
// 															dated					,
// 															ip						,
// 															remarks					, 
// 															id_campus				
// 														)

// 													VALUES(
// 															'4'																	,
// 															'1'																	, 
// 															'".cleanvars($challano)."'											,
// 															NOW()																,
// 															'".cleanvars($ip)."'												,
// 															'".cleanvars($remarks)."'											,
// 															'".cleanvars($rowDonor['id_campus'])."'							
// 														)
// 											");
				
				

// 				$phone = str_replace("-","",$rowDonor['donor_phone']);

// 				//End of Check If Record Inserted

// 				// Set Credentials, Cell and MSG in Data Objects
// 				// $data['username'] = 'demoumer';
// 				// $data['password'] = '786786';
// 				// $data['mask'] = 'AGS';
// 				// $data['mobile'] = $phone;
// 				// $data['message'] = 'Dear '.$rowDonor['donor_name'].',\n\nJust a soft reminder, your blessed Sponsor Child Donation Challan #'.cleanvars($challano).' for Month '.get_monthtypes(ltrim($month, "0")).' of Rs.'.number_format($grandTotal).' bearing due date '.date('d-m-Y', strtotime($due_date)).' is generated.\nKindly do the needful to pay your donation through Finja (IBFT) by entering your Challan number through the mobile banking App.\n\nOr Click to pay via Credit/Debit Card.\nhttps://aghosh.gptech.pk/payProPayment.php?challan_no='.$challano.'\n\nThanks,\nAGHOSH COMPLEX';
			
// 				// $curl = curl_init();
			
// 				// curl_setopt_array($curl, array(
// 				// CURLOPT_URL => "https://brandyourtext.com/sms/api/send",
// 				// CURLOPT_RETURNTRANSFER => true,
// 				// CURLOPT_ENCODING => "",
// 				// CURLOPT_MAXREDIRS => 10,
// 				// CURLOPT_TIMEOUT => 0,
// 				// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 				// CURLOPT_CUSTOMREQUEST => "POST",
// 				// CURLOPT_POSTFIELDS => $data,
// 				// ));
			
// 				// $response = curl_exec($curl);
// 				// $err = curl_error($curl);
			
// 				// curl_close($curl);
// 			}
// 		}
// 	}
// 	//While Loop Donors End
// }
?>