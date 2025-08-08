<?php 
//error_reporting(0);
//session_start();
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";

if(isset($_POST['iddept'])){
	// COLLECTIONS
	if($_POST['iddept'] == '1'){
		$sql	= "SELECT SUM(f.total_amount) as allpaid
						FROM ".FEES_COLLECTION." f
						INNER JOIN ".FEES." fe ON fe.challan_no = f.challan_no
						INNER JOIN ".CLASSES." c ON c.class_id = fe.id_class					   
						WHERE	f.is_deleted 	!= '1' 
						AND  	f.pay_mode 		= '1'
						AND 	f.dated 		>='2024-05-01'
						AND 	c.id_classgroup != '3'
						AND 	f.id_campus 	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'";
		
	}else{
		$sql	= "SELECT SUM(f.total_amount) as allpaid
						FROM ".FEES_COLLECTION." f
						INNER JOIN ".FEES." fe ON fe.challan_no = f.challan_no
						INNER JOIN ".CLASSES." c ON c.class_id = fe.id_class					   
						WHERE	f.is_deleted	!= '1' 
						AND  	f.pay_mode 		= '1'
						AND 	f.dated 		>='2024-05-01'
						AND  	c.id_classgroup = '3'
						AND 	f.id_campus 	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'";
	}

	$sqllmspaid	= $dblms->querylms($sql);
	$value_paid = mysqli_fetch_array($sqllmspaid);

	// DEPOSITED
	$queryBankDeposits  = $dblms->querylms("SELECT SUM(fcc.amount) AS totalDeposited 
											FROM ".FEES_COLLECTION_BANK_DEPOSIT." fcc
											WHERE fcc.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
											AND fcc.is_deleted != 1
											AND fcc.id_dept = '".$_POST['iddept']."'
										");
	$valueBankDeposit = mysqli_fetch_array($queryBankDeposits);

	$balance = ($value_paid['allpaid'] - $valueBankDeposit['totalDeposited']);

	$data['balancenumber']  = $balance;
	$data['balancestring'] = number_format($balance);
	echo json_encode($data);
}
