<?php

require_once("../include/dbsetting/lms_vars_config.php");
ini_set('memory_limit', '-1');
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");
$dblms = new dblms();
    $conditions = array (
                                     'select' 		=> '*'
                                   , 'where' 		=> array (
                                                                    'status' => 0
                                                            )
                                   , 'search_by' 	=> " AND message_type IN (1,3)"
                                   , 'order_by' 	=> " dated ASC"
                                   , 'limit' 		=> 30
                                   , 'return_type'  => 'all'
                        );
    $Adminslist 	= $dblms->getRows(WHATSAPP_MESSAGES,  $conditions);
    foreach ($Adminslist as $listwa) :

        $waResult = sendWhatsAppMessage(WA_URL, WA_APPKEY, WA_SENDER, $listwa['cellno'], $listwa['message']);

        if ($waResult['error']) {
            $status = 3;
        } else {
            $status = 1;
        }

        $data = array (
                            'status' =>  $status
                      );

        $qryUpdate = $dblms->Update(WHATSAPP_MESSAGES, $data, "id = '".($listwa['id'])."'");

    endforeach;