<?php
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../functions/login_func.php";
include "../../functions/functions.php";
include "../../functions/send_message.php";

// ADMISSION CHALLAN GENRATE
if(isset($_GET['form_no']) && isset($_GET['id_class']) && isset($_GET['is_hostelized']) && isset($_GET['is_orphan']) && isset($_GET['id_session'])) {

    if($_GET['is_orphan'] != '1'){
        // GET Fee Structure
    
        // For Hostelized 
        if($_GET['is_hostelized'] == 1){
            $sql2 = "";
        } else {		
            $sql2 = "AND d.id_cat NOT IN(6,7,8)";
        }

        $sqllmsfeesetup	= $dblms->querylms("SELECT f.id, d.id_cat, d.amount
                                                    FROM ".FEESETUP." f 
                                                    INNER JOIN ".FEESETUPDETAIL." d ON d.id_setup = f.id 	
                                                    WHERE f.status = '1'
                                                    AND f.id_class = '".cleanvars($_GET['id_class'])."' $sql2
                                                    AND f.id_session = '".cleanvars($_GET['id_session'])."'
                                                    AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                    AND f.is_deleted != '1'
                                                    ORDER BY f.id DESC");
        $totalAmount = 0;
        while($value_feesetup = mysqli_fetch_array($sqllmsfeesetup)){
    
            $totalAmount = $totalAmount + $value_feesetup['amount'];
            $feeDetail[] = array('id_cat'=>$value_feesetup['id_cat'], 'amount'=>$value_feesetup['amount']);
    
        }
    
        // Make Challans
        $challandate= substr(date('Y'),2,4);
        $issue_date = date('Y-m-d');
        $due_date   = date('Y-m-d' , strtotime($issue_date. ' + 15 days'));
        $yearmonth 	= date('Y-m', strtotime(cleanvars($issue_date)));
        $year 		= date('y', strtotime(cleanvars($issue_date)));
        $idmonth 	= date('n', strtotime(cleanvars($issue_date)));

        // challan no
        do {
            $challano = '9930'.$year.mt_rand(10000,99999);
            $sqlChallan	= "SELECT challan_no FROM sms_fees WHERE challan_no = '$challano'";
            $sqlCheck	= $dblms->querylms($sqlChallan);
        } while (mysqli_num_rows($sqlCheck) > 0);

        // Challans
        $sqllmsFee  = $dblms->querylms("INSERT INTO ".FEES."(
                                                            status						, 
                                                            id_type 					,
                                                            challan_no					, 
                                                            id_session					, 
                                                            id_class					, 
                                                            inquiry_formno				,
                                                            id_month					,
                                                            yearmonth					,
                                                            issue_date					,
                                                            due_date					,
                                                            total_amount				,
                                                            id_campus 					,
                                                            id_added					,
                                                            date_added
                                                        )
                                                    VALUES(
                                                            '2'																,
                                                            '1'																,
                                                            '".cleanvars($challano)."'										,
                                                            '".cleanvars($_GET['id_session'])."'	, 
                                                            '".cleanvars($_GET['id_class'])."'								,
                                                            '".cleanvars($_GET['form_no'])."'								,
                                                            '".cleanvars($idmonth)."'									    ,
                                                            '".cleanvars($yearmonth)."'									    ,
                                                            '".cleanvars($issue_date)."'									, 
                                                            '".cleanvars($due_date)."'										,
                                                            '".cleanvars($totalAmount)."'									,
                                                            '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'		,
                                                            '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'			,
                                                            Now()	
                                                        )");
    
        // Chllans Details 
        if($sqllmsFee) { 
            // Get latest ID
            $challan_id = $dblms->lastestid();

            foreach($feeDetail as $det){
                if($det['amount'] > 0) {
                    $sqllms  = $dblms->querylms("INSERT INTO ".FEE_PARTICULARS."(
                                                                    id_fee			,
                                                                    id_cat			,
                                                                    amount						
                                                                )
                                                            VALUES(
                                                                    '".cleanvars($challan_id)."'			,
                                                                    '".cleanvars($det['id_cat'])."'			,
                                                                    '".cleanvars($det['amount'])."'			
                                                                )");
                }
            }
            // Make Log
            $remarks = 'Admission Challan Genrate after inquiry.';
            $sqllmslog  = $dblms->querylms("INSERT INTO ".ACCOUNTS_LOGS." (
                                                                id_user 				, 
                                                                filename				, 
                                                                action					,
                                                                challan_no 				,
                                                                dated					,
                                                                ip						,
                                                                remarks					, 
                                                                id_campus				
                                                            )
            
                                                        VALUES(
                                                                '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
                                                                '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
                                                                '1'																	, 
                                                                '".cleanvars($challano)."'									,
                                                                NOW()																,
                                                                '".cleanvars($ip)."'												,
                                                                '".cleanvars($remarks)."'											,
                                                                '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
                                                            )");
                            
            
			//Send Message		
			$phone = str_replace("-","",$_GET['phone']);
			$message = 'Dear Parents,\n\nYour child admission challan # '.cleanvars($challano).'  of amount '.number_format($totalAmount).' with due date '.date('d-m-Y' , strtotime(cleanvars($due_date))).' has been issued.\n\nThanks,\nAghosh Grammar School';
            sendMessage($phone, $message);

			header("Location: ".SITE_URL."feechallanprint.php?id=$challano", true, 301);
			exit();
        }
    } else {
        header("Location: ".SITE_URL."admission_inquiry.php", true, 301);
    }
} else {
    echo "First Step";
}
?>