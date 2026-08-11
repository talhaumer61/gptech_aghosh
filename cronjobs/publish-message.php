<?php

require_once("../include/dbsetting/lms_vars_config.php");
ini_set('memory_limit', '-1');
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");
$dblms = new dblms();

echo (date ("Y-m-d", strtotime("+8 day")));
    $conditions = array (
                                     'select' 		=> 's.std_whatsapp'
                                   , 'where' 		=> array (
                                                                      's.std_status'    => 1
                                                                    , 's.is_deleted'    => 0
                                                            )
                                   , 'group_by' 	=> " s.std_whatsapp"
                                   , 'order_by' 	=> " std_id DESC"
                                   , 'return_type'  => 'all'
                       );
    $Adminslist = $dblms->getRows(STUDENTS." s",  $conditions);

    foreach ($Adminslist as $listwa) :

        if($listwa['std_whatsapp']) {
            $mobilenum1 = '92'.str_replace('-', '', ltrim($listwa['std_whatsapp'], '0'));
        }  else {
            $mobilenum1 = '';
        }

        if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {


            $msgs = '
Assalamu alaikum 
Dear Parents,

We regret to inform you that the "1 Link 1 Bill" option for fee collection is currently unavailable due to technical issues.

In the meantime, please pay your fees at any branch of United Bank Limited (UBL) across Pakistan.


We will notify you via WhatsApp as soon as the "1 Bill" service resumes.

Thank you for your cooperation and understanding.

Please join Whatapp Chanel of Aghosh Complex for further information 
https://whatsapp.com/channel/0029VagSuUsKWEKl4Zod8x3d

Best regards,
Accounts Office
Aghosh Complex.';
            // whatsapp message
            $datawa = array(
                                      'status'          => 0
                                    , 'dated'           => date("Y-m-d")
                                    , 'cellno'          => ($mobilenum1)
                                    , 'message_type'    => 4
                                    , 'message'         => $msgs
                            );
            $querywhtsapp = $dblms->Insert(WHATSAPP_MESSAGES, $datawa);
            //echo '<br>' . $mobilenum1 . '-' . $listwa['std_name'] . '-' . $listwa['challan_no'] . '-' . $grandTotal . '<br>';
        }

    endforeach;