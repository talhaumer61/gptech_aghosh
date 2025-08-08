<?php
//-----------------------------------------------
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
//-----------------------------------------------

//Credentails

$username = 'Aghosh_School';
$password = 'Live@aghosh21';

// $username = 'Aghosh_School';
// $password = 'Demo@school21';

// Main Redirection
if(isset($_SESSION['userlogininfo']['LOGINIDA'])){
    $redirectBasic = 'https://aghosh.gptech.pk/';
} else {
    $redirectBasic = 'http://aghosh.net/';
}
echo $_SESSION['userlogininfo']['LOGINIDA'];
exit();
// Create Order
$challan_no = $_GET['challan_no'];
if(!empty($challan_no)) {

    //Fetch Challan Details
    $sqllmsChallan	= $dblms->querylms("SELECT f.challan_no, f.issue_date, f.due_date, f.total_amount, f.id_campus, d.donor_name, d.donor_phone, d.donor_email
                                            FROM ".FEES." f			   
                                            INNER JOIN ".DONORS." d ON d.donor_id = f.id_donor 	
                                            WHERE f.id != '' AND f.status = '2' AND f.id_type = '3' 
                                            AND f.challan_no = '".$challan_no."'
                                            AND f.is_deleted != '1' ");
                                    
    if(mysqli_num_rows($sqllmsChallan) == 1){

        $callBackURL = 'https://aghosh.gptech.pk/payProPayment.php?challan_no='.$challan_no;

        $valChallan = mysqli_fetch_array($sqllmsChallan);

        //Date Conversion 
        $issue_date = date('d/m/Y' , strtotime($valChallan['issue_date']));
        $due_date   = date('d/m/Y' , strtotime($valChallan['due_date']));

        //Initialize Array
        $dataArray = array();

        //Set Credential Objects
        $data0['MerchantId']        = $username;
        $data0['MerchantPassword']  = $password;

        //Set Other Objects
        $data1['OrderNumber'] = $valChallan['challan_no'];
        $data1['OrderAmount'] = $valChallan['total_amount'];
        $data1['OrderDueDate'] = $due_date;
        $data1['OrderAmountWithinDueDate'] = $valChallan['total_amount'];
        $data1['OrderAmountAfterDueDate'] = ($valChallan['total_amount']+300);
        $data1['OrderType'] = 'Service';
        $data1['IssueDate'] = $issue_date;
        $data1['OrderExpireAfterSeconds'] = 3600;
        $data1['CustomerName'] = $valChallan['donor_name'];
        $data1['CustomerMobile'] = $valChallan['donor_phone'];
        $data1['CustomerEmail'] = $valChallan['donor_email'];
        $data1['CustomerAddress'] = '';
        
        //Push Objects to Array
        array_push($dataArray,$data0,$data1);

        //Encode Request Parameters for cURL
        $payLoad = json_encode($dataArray);

        //Create a new cURL resource
        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://demoapi.paypro.com.pk/cpay/co?oJson=',
            CURLOPT_URL => 'https://api.paypro.com.pk/cpay/co?oJson=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payLoad,
        ));

        // Execute the POST request
        $response = curl_exec($curl);

        // Close cURL resource
        curl_close($curl);

        //Decode Request Response
        $requestResponse = json_decode($response, true);

        //To Get Status Code of Response
        foreach($requestResponse[0] as $object){

            $responseStatus = $object;

        }

        //To Get URL of Response
        foreach($requestResponse[1] as $key => $object){

            if($key == 'Click2Pay'){

                $responseURL = $object;
            }

            if($key == 'ConnectPayId'){

                $payProID = $object;
            }

        }
        
        // If Response Status Code and URL Ok then redirect
        if($responseStatus == '00' && $responseURL){

            if($_SESSION['userlogininfo']['LOGINIDA']){
                $loginID = cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
            } else {
                $loginID = '0';
            }

            // Make Record
            $sqllms  = $dblms->querylms("INSERT INTO ".PAYPRO_ORDERS."(
                                                            challan_no	,
                                                            order_id	,
                                                            pay_url		, 
                                                            id_campus	, 
                                                            id_added	,
                                                            date_added	
                                                        ) VALUES (
                                                            '".cleanvars($valChallan['challan_no'])."'					,
                                                            '".cleanvars($payProID)."'									,
                                                            '".cleanvars($responseURL)."'								,
                                                            '".cleanvars($valChallan['id_campus'])."'                 	,
                                                            '".$loginID."'                                              ,
                                                            Now()	
                                                        )");
                                                        
            header("Location: $responseURL.'&callback_url=$callBackURL", true, 301);
            exit();

        } elseif($responseStatus == '01'){

            $sqllmsOrder  = $dblms->querylms("SELECT pay_url
                                                FROM ".PAYPRO_ORDERS." 
                                                WHERE challan_no = '".$valChallan['challan_no']."'
                                                AND id_campus = '".cleanvars($valChallan['id_campus'])."'
                                                ORDER BY id DESC LIMIT 1");
            if(mysqli_num_rows($sqllmsOrder) == 1){

                $valueOrder = mysqli_fetch_array($sqllmsOrder);

                $redirectURL =  $valueOrder['pay_url'];

                header("Location: $redirectURL&callback_url=$callBackURL", true, 301);
                exit();

            } else{

                header("Location: $redirectBasic", true, 301);
                exit();

            }

        } else {
            header("Location: $redirectBasic", true, 301);
            exit();
        }

    } else {
		echo'<h2 style="color: red; text-align: center;">Please Enter Valid Challan Number!</h2>';
    }

} else {
    echo'<h2 style="color: red; text-align: center;">Please Enter Challan Number!</h2>';
}

// Pay Order
if($_REQUEST['ordId']){

    $orderID = $_REQUEST['ordId'];

    $sqllmsOrder  = $dblms->querylms("SELECT po.order_id, f.challan_no, f.total_amount
                                        FROM ".PAYPRO_ORDERS." po
                                        INNER JOIN ".FEES." f ON f.challan_no = po.challan_no
                                        WHERE po.order_id = '".cleanvars($orderID)."'
                                        ORDER BY po.id DESC LIMIT 1");
    if(mysqli_num_rows($sqllmsOrder) == 1){

        $valueOrder = mysqli_fetch_array($sqllmsOrder);

        //Set Credential Objects
        $userName  = $username;
        $password  = $password;
        $cpayId    = cleanvars($orderID);

        //Create a new cURL resource
        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://demoapi.paypro.com.pk/cpay/gos?userName='.$userName.'&password='.$password.'&cpayId='.$cpayId,
            CURLOPT_URL => 'https://api.paypro.com.pk/cpay/gos?userName='.$userName.'&password='.$password.'&cpayId='.$cpayId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        // Execute the GET request
        $response = curl_exec($curl);

        // Close cURL resource
        curl_close($curl);

        //Decode Request Response
        $requestResponse = json_decode($response, true);


        print_r($requestResponse);
        exit();

        //To Get Status Code of Response
        foreach($requestResponse[0] as $object){

            $responseStatus = $object;

        }

        //To Get Order Status of Response
        foreach($requestResponse[1] as $key => $object){

            if($key == 'OrderStatus'){

                $orderStatus = $object;
            }
        }

        //If Response Status Code and Status is Paid
        if($responseStatus == '00' && $orderStatus == 'PAID'){

            //Update Fee Challan as Paid
            $sqllmsupdate  = $dblms->querylms("UPDATE ".FEES." SET 
                                                                    status    	= '1'
                                                                , paid_date		= '".date('Y-m-d')."'
                                                                , date_modify	= NOW()
                                                            WHERE challan_no	= '".$valueOrder['challan_no']."' ");

            //Insert Transaction
            $sqllmsInsertTrans  = $dblms->querylms("INSERT INTO ".PAY_API_TRAN." (
                                                                    status						    ,
                                                                    id_api						    ,
                                                                    customer_code					,
                                                                    branch_code					    ,
                                                                    challan_no						,
                                                                    refrence_no						,
                                                                    trans_id						,
                                                                    trans_amount					,
                                                                    trans_currency					,
                                                                    trans_date						,
                                                                    date_added				        ,
                                                                    ip	
                                                                )
                                                        VALUES (
                                                                    '1'   											,
                                                                    '2'   						                    ,
                                                                    'AGS'				                            ,
                                                                    'PayPro'		                                ,
                                                                    '".cleanvars($valueOrder['challan_no'])."'		,
                                                                    ''	                                            ,
                                                                    '".$valueOrder['order_id']."'			        ,
                                                                    '".$valueOrder['total_amount']."'				,
                                                                    'PKR'		                                    ,
                                                                    '".date('Y-m-d')."'	                            ,
                                                                    NOW()                							,
                                                                    '".$ip."'
                                                                ) ");
        }

        header("Location: $redirectBasic", true, 301);
        exit();

    } else {

        header("Location: $redirectBasic", true, 301);
        exit();
    }

}
?>