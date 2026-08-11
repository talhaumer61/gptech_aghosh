<?php
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../functions/login_func.php";
include "../functions/functions.php";

if(isset($_POST['challan']) ){

    $conditions = array ( 
                              'select' 		=> 'status'
                            , 'where' 		=> array( 
                                                        'challan_no' => cleanvars($_POST['challan'])
                                                    )
                            , 'return_type' => 'single' 
                        ); 
    $feechallan 	= $dblms->getRows(FEES, $conditions);
    
    $data['status']  = $feechallan['status'];
    echo json_encode($data);

}
