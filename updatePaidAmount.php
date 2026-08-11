<?php

require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

$count = 0;
 
$sqllmsPaid = $dblms->querylms("SELECT id, total_amount, remaining_amount
                                        FROM ".FEES."			   
                                        WHERE status = '1' AND paid_amount = '0' AND is_deleted != '1'
                                        AND id_campus = '4'
                                        ORDER BY id ASC");
while($rowPaid = mysqli_fetch_array($sqllmsPaid)) {

    $count++;

    $amount = $rowPaid['total_amount'] - $rowPaid['remaining_amount'];

    $sqllms  = $dblms->querylms("UPDATE ".FEES." SET 
                                            paid_amount	   = '".cleanvars($amount)."'
                                    WHERE   id			   = '".cleanvars($rowPaid['id'])."'
                                      AND   is_deleted    != '1' ");

    if($sqllms){
        echo"Updated Id: ".$rowPaid['id']." COUNT is : ".$count." <br> ";
    }
}
?>