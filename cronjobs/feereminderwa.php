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
                                                                    , 'message_type' => 2
                                                            )
                                   , 'order_by' 	=> " dated ASC"
                                   , 'return_type'  => 'all'
                        );
    $Adminslist 	= $dblms->getRows(WHATSAPP_MESSAGES,  $conditions);
    foreach ($Adminslist as $listwa) :

        $curl = curl_init();
        curl_setopt_array($curl, array(
                                           CURLOPT_URL              => 'https://whatsapp.metasquad.uk/api/create-message',
                                           CURLOPT_RETURNTRANSFER   => true,
                                           CURLOPT_ENCODING         => '',
                                           CURLOPT_MAXREDIRS        => 10,
                                           CURLOPT_TIMEOUT          => 0,
                                           CURLOPT_FOLLOWLOCATION   => true,
                                           CURLOPT_HTTP_VERSION     => CURL_HTTP_VERSION_1_1,
                                           CURLOPT_CUSTOMREQUEST    => 'POST',
                                           CURLOPT_POSTFIELDS       => array('appkey' => WA_APPKEY,'authkey' => WA_AUTHKEY,'to' => $listwa['cellno'],'message' => $listwa['message'],'file' => ''),
                                     ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responseArray = json_decode($response, true);
        if($responseArray['data']['status_code'] == 200) {
            $status = 1;
        } else {
            $status = 3;
        }
            $data = array (
                                  'status' =>  $status
                           );

            $qryUpdate = $dblms->Update(WHATSAPP_MESSAGES, $data, "id = '".($listwa['id'])."'");


    endforeach;