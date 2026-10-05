<?php

if(isset($_POST['changes_msg'])) { 
    //--------------------------------------
    $sqllms = $dblms->querylms("UPDATE ".WHATSAPP_MESSAGES." SET  
                                        status   = '0'
                                      , cellno   = '".cleanvars($_POST['cellno'])."'   
                                      , message  = '".cleanvars($_POST['message'])."' 
                                  WHERE id       = '".cleanvars($_POST['id'])."'");

    if($sqllms) { 
        //--------------------------------------
        $remarks = 'Update WhatsApp Message: Cell No. "'.cleanvars($_POST['cellno']).'" details';
        $sqllmslog = $dblms->querylms("INSERT INTO ".LOGS." (
                                                                id_user                                     , 
                                                                filename                                    , 
                                                                action                                      ,
                                                                dated                                       ,
                                                                ip                                          ,
                                                                remarks                                        
                                                              )
                                                       VALUES(
                                                                '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' ,
                                                                '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
                                                                '2'                                         , 
                                                                NOW()                                       ,
                                                                '".cleanvars($ip)."'                        ,
                                                                '".cleanvars($remarks)."'       
                                                              )
                                    ");
        //--------------------------------------
        $_SESSION['msg']['title']   = 'Successfully';
        $_SESSION['msg']['text']    = 'Record Successfully Updated.';
        $_SESSION['msg']['type']    = 'success';
        header("Location: whatsapp_log.php", true, 301);
        exit();
        //--------------------------------------
    }
    //--------------------------------------
}