<?php

require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

$count = 0;
//Variefy Total adn Particulars Amount
$sqllmsChallan = $dblms->querylms("SELECT id, status, challan_no, total_amount, remaining_amount
                                        FROM ".FEES."			   
                                        WHERE is_deleted != '1'
                                        AND id_campus = '4' AND id_type IN (1,2) 
                                        AND issue_date >= '2021-09-29'
                                        ORDER BY id ASC");
                                        $count = 0;
while($rowMain = mysqli_fetch_array($sqllmsChallan)) {

    //All Part
    $sqllmsDetail	= $dblms->querylms("SELECT SUM(amount) as total
													FROM ".FEE_PARTICULARS."
													WHERE id_fee = '".cleanvars($rowMain['id'])."' ");
    $rowPart = mysqli_fetch_array($sqllmsDetail);

    //Concession
    $sqllmsDetailConcess	= $dblms->querylms("SELECT amount
													FROM ".FEE_PARTICULARS."
													WHERE id_fee = '".cleanvars($rowMain['id'])."'
                                                    AND id_cat = '17' ");
    $rowConcession = mysqli_fetch_array($sqllmsDetailConcess);

    // $partAmount = $rowPart['total'] - (2 * $rowConcession['amount']);
    $partAmount = $rowPart['total'] - ($rowConcession['amount']);

    if($rowMain['total_amount'] != $partAmount) {
        $count ++;
        echo $count."::: stat: ".$rowMain['status']."TotalMain: ".$rowMain['total_amount']." Total Part: ".$partAmount." Concession : ".$rowConcession['amount']."  == ChallanNo: ".$rowMain['challan_no']."<br><br>";
    } else {
        continue;
    }

}
?>