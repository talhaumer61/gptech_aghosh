<?php

require_once("../include/dbsetting/lms_vars_config.php");
ini_set('memory_limit', '-1');
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");
$dblms = new dblms();

echo (date ("Y-m-d", strtotime("+8 day")));
    $conditions = array (
                                     'select' 		=> 'f.id,  f.status, f.id_month, f.challan_no, f.issue_date, f.due_date, f.paid_date, f.total_amount, 
                                                        f.yearmonth, f.remaining_amount, f.paid_amount, f.narration, c.class_name, f.id_std,
                                                        st.std_whatsapp, st.std_id, st.std_name, st.std_fathername, st.std_regno, st.std_gender, st.is_hostelized,
                                                        c.id_classgroup'
                                   , 'join' 		=> "INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 
                                                        INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std 
                                                        INNER JOIN (
                                                                    SELECT
                                                                        id_std,
                                                                        MAX(id) AS max_id
                                                                    FROM
                                                                        ".FEES."
                                                                    WHERE
                                                                        status = '2' AND is_deleted = '0' AND id_type = '2'
                                                                    GROUP BY
                                                                        id_std
                                                                ) subquery ON
                                                                    f.id_std = subquery.id_std AND f.id = subquery.max_id"
                                   , 'where' 		=> array (
                                                                      'f.status'      => 2
                                                                    , 'f.is_deleted'  => 0
                                                                    , 'f.id_type'     => 2
                                                                    , 'st.std_status' => 1
                                                                    , 'st.id_deleted' => 0
                                                            )
                                   , 'search_by' 	=> " AND f.due_date = '".(date ("Y-m-d", strtotime("+3 day")))."'"
                                   , 'order_by' 	=> " id DESC"
                                   //, 'limit' 	    => 10
                                   , 'return_type'  => 'all'
                       );
    $Adminslist = $dblms->getRows(FEES." f",  $conditions);

    foreach ($Adminslist as $listwa) :

        if($listwa['std_whatsapp']) {
            $mobilenum1 = '92'.str_replace('-', '', ltrim($listwa['std_whatsapp'], '0'));
        }  else {
            $mobilenum1 = '';
        }
        if($listwa['id_classgroup'] == 3) {
            $challanprefix 	= 1000014000;
        } else {
            $challanprefix 	= 1000014011;
        }

        if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {


            $grandTotal = 0;
            foreach ($monthtypes as $month):
                // CURRENT MONTH
                if ($listwa['id_month'] == $month['id']) {

                    $year = date('Y', strtotime(cleanvars($listwa['yearmonth'])));
                    if ($listwa['status'] == 1) {
                        $amount = $listwa['paid_amount'];
                    } else {
                        $amount = $listwa['total_amount'] - $listwa['paid_amount'];
                    }

                    if ($listwa['due_date'] < date('Y-m-d') && $listwa['status'] != '1') {
                        $amount = $amount;
                    }

                } // PREVIOUS MONTHS
                else {
                    $sqlnarration = $dblms->querylms("SELECT f.id, f.id_month, f.yearmonth, f.challan_no, f.id_std,
																		f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																		FROM " . FEES . " f
																		WHERE f.id_month		= '" . cleanvars($month['id']) . "'
																		AND f.id_std		= '" . cleanvars($listwa['id_std']) . "'
																		AND (f.status = '2' OR f.status = '4')
																		AND f.is_deleted != '1' LIMIT 1");
                    if (mysqli_num_rows($sqlnarration) > 0) {
                        $valnarration = mysqli_fetch_array($sqlnarration);

                        $year = date('Y', strtotime(cleanvars($valnarration['yearmonth'])));
                        $amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

                        if ($valnarration['due_date'] < date('Y-m-d')) {
                            $amount = $amount + LATEFEE;
                        }

                        if (($listwa['status'] == 1 && $listwa['id_month'] == $month['id']) || ($listwa['status'] == 2 || $listwa['status'] == 4)) {
                            $amount = $amount;
                        } else {
                            $amount = 0;
                        }


                    } else {
                        $amount = 0;
                    }
                }
                $grandTotal = $grandTotal + $amount;
            endforeach;


            $challanNumber = $challanprefix . substr($listwa['challan_no'], -7);


            $msgs = '
Reminder for Fee Payment
Dear Parents
Please make sure to submit your child ('.$listwa['std_name'].') school fee payment for the month of '.get_monthtypes($listwa['id_month']).'-'.date('Y' , strtotime($listwa['issue_date'])).' before '.date('d-m-Y' , strtotime($listwa['due_date'])).' to avoid any inconvenience in case of non-payment of the school fee fine of Rs 500 will be imposed with the monthly fee.

All Mobile Banking Payments 
Challan Amount Rs. '.number_format($grandTotal).'/-
1 Bill Invoice ID: '. $challanNumber.'

https://aghosh.gptech.pk/feechallanprintwa.php?id='.$listwa['challan_no'].'

Your cooperation is highly appreciated.
Regards 
Accounts Department 
Aghosh Complex';
            // whatsapp message
            $datawa = array(
                                      'status'          => 0
                                    , 'dated'           => date("Y-m-d")
                                    , 'challanno'       =>  $listwa['challan_no']
                                    , 'amount'          => $grandTotal
                                    , 'cellno'          => ($mobilenum1)
                                    , 'message_type'    => 2
                                    , 'message'         => $msgs
                            );
            $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);
            //echo '<br>' . $mobilenum1 . '-' . $listwa['std_name'] . '-' . $listwa['challan_no'] . '-' . $grandTotal . '<br>';
        }

    endforeach;