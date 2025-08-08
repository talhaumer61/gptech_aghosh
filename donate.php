<?php
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
if(!isset($_POST['donate'])) {

  // Donation Target
  $sqllmsTarget	= $dblms->querylms("SELECT donation_target, target_date
                                  FROM ".CAMPUS."  
                                  WHERE campus_id = '4' LIMIT 1");
  $valTarget = mysqli_fetch_array($sqllmsTarget);

  // Raised Donation CAMPUS
  $sqllmsAmount = $dblms->querylms("SELECT SUM(amount) as raised
                                          FROM ".DONATION_UNREGISTER." 
                                          WHERE status = '1' ");
  $valChallan = mysqli_fetch_array($sqllmsAmount);

  // Raised Donation Percentage
  $raisedPercentage = ($valChallan['raised'] / $valTarget['donation_target']) * 100;

  // Count Days
  $targetDate = date('d-m-Y' , strtotime(cleanvars($valTarget['target_date'])));
  $today = date('d-m-Y');
  $daysLeft = dateDiffInDays($targetDate, $today);
  echo'
  <!doctype html>
  <html lang="en">
    
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title>Aghosh Orphan Care Home</title>
    
      <meta property="og:image:url" content="uploads/logo.png">
      <meta property="og:title" content="Aghosh Donation">
      <meta property="og:description" content="Aghosh Orphan Care Home">
      <meta property="og:url" content="">
      <meta property="og:site_name" content="Aghosh Donation">
      <meta property="og:type" content="website">
      <meta property="og:locale" content="en_US">
      <meta property="article:author" content="https://www.facebook.com/AghoshOrphanCareHomes">
      <meta property="article:publisher" content="https://www.facebook.com/AghoshOrphanCareHomes">
      <meta name="twitter:card" content="summary">
      <meta name="twitter:url" content="">
      <meta name="twitter:title" content="Aghosh Donation">
      <meta name="twitter:description" content="Aghosh Donation">
      <meta name="twitter:image:src" content="uploads/logo.png">
      <meta name="twitter:image" content="uploads/logo.png">
      <meta name="twitter:domain" content="Aghosh Donation">
      <meta name="twitter:site" content="@AGS">
      <meta name="twitter:creator" content="@AGS">
      <!-- Schema.org markup for Google+ -->
      <meta itemprop="name" content="Aghosh Donation">
      <meta itemprop="description" content="Aghosh Orphan Care Home">
      <meta itemprop="image" content="uploads/logo.png">
      <meta itemprop="alternativeHeadline" content="Aghosh Donation">
      <meta itemprop="thumbnailUrl" content="uploads/logo.png">
      <meta name="description" content="Aghosh Orphan Care Home">
      <meta name="keywords" content="AGS, Donation, Aghosh Donation, Orphan, Orphan Care, Orphan Care Home, Aghosh Orphan Care Homes, Aghosh Donation Lahore">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/donation/assets/css/bootstrap.min.css">

      <!-- External Css -->
      <link rel="stylesheet" href="assets/donation/assets/css/line-awesome.min.css">
      <link rel="stylesheet" href="assets/donation/assets/css/owl.carousel.min.css" />

      <!-- Custom Css --> 
      <link rel="stylesheet" type="text/css" href="assets/donation/css/main.css">
      <link rel="stylesheet" type="text/css" href="assets/donation/css/donation.css">

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet">

      <!-- Favicon -->
      <link rel="icon" href="uploads/logo.png">
      <link rel="apple-touch-icon" href="uploads/logo.png">
      <link rel="apple-touch-icon" sizes="72x72" href="uploads/logo.png">
      <link rel="apple-touch-icon" sizes="114x114" href="uploads/logo.png">


    </head>
    <body>

      <div class="ugf-wraper">
        <div class="content-block">
          <!-- <img src="assets/donation/images/shape-1.png" class="img-fluid shape-1" alt="">-->
          <img src="assets/donation/images/shape-2.png" class="img-fluid shape-2" alt=""> 
          <img src="assets/donation/images/shape-3.png" class="img-fluid shape-3" alt="">
          <img src="assets/donation/images/shape-4.png" class="img-fluid shape-4" alt="">
          <div class="logo">
            <img src="assets/donation/images/logo.png" class="img-fluid" alt="AGS">
          </div>
          <div class="main-content">
            <h2>Rise your helping hand For Orphans 🙌</h2>
            <p class="text">We Shall Leave You Never. We Are Family Forever.</p>
            <div class="fund-area">
              <h3>PKR '.number_format($valTarget['donation_target']).'</h3>
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: '.$raisedPercentage.'%;" aria-valuenow="'.$raisedPercentage.'" aria-valuemin="0" aria-valuemax="100">
                </div>
                <div class="collected"><p>Raised: <span>PKR '.number_format($valChallan['raised']).'</span></p></div>
                <div class="days-left"><p>Left: <span>'.$daysLeft.'</span> Days</p></div>
              </div>
            </div>    
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-5 offset-lg-7">
              <div class="form-steps active">
                <div class="form-block">
                  <div class="donation-header">
                    <h2>Donation Details</h2>
                  </div>
                  <form action="#" method="POST" class="donation-form" autocomplete="off">
                      <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label for="first_name">First Name</label>
                              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label for="last_name">Last Name</label>
                              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                          </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label for="phone">Phone</label>
                              <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                          </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group country-select">
                                  <label for="id_country">Country</label>
                                  <div class="select-input choose-country">
                                      <span></span>
                                      <select name="id_country" id="id_country" class="form-control" required>
                                          <option value="">Select Country</option>';
                                          foreach($country as $coun) {
                                              echo'<option value="'.$coun['id'].'">'.$coun['name'].'</option>';
                                          }
                                          echo'
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group country-select">
                              <label for="id_purpose">Purpose / Type</label>
                              <div class="select-input choose-country">
                              <span></span>
                                  <select name="id_purpose" id="id_purpose" class="form-control" required>
                                      <option value="">Select Purpose / Type</option>';
                                      foreach($donationType as $type) {
                                          echo'<option value="'.$type['id'].'">'.$type['name'].'</option>';
                                      }
                                      echo'
                                  </select>
                              </div>
                          </div>
                      </div>
                      
                      <div class="col-sm-12">
                          <div class="form-group">
                              <label for="custom-donation">Amount</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="validatedInputGroupPrepend">PKR </span>
                                  </div>
                                  <input type="number" class="form-control custom-donation" id="custom-donation" name="amount" min="50" aria-describedby="validatedInputGroupPrepend" placeholder="0.00" required>
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-100" type="submit" name="donate">Send Your Donation &nbsp; &#10084;</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer">
          <div class="copyright">
            <p>Copyright &copy; 2021 <a href="https://gptech.pk/">GPTech</a>. All Rights Reserved</p>
          </div>
          <div class="social-links">
            <a href="#"><i class="lab la-facebook-f"></i></a>
            <a href="#"><i class="lab la-twitter"></i></a>
            <a href="#"><i class="lab la-linkedin-in"></i></a>
            <a href="#"><i class="lab la-instagram"></i></a>
          </div>
        </div>
      </div>



      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="assets/donation/assets/js/jquery.min.js"></script>
      <script src="assets/donation/assets/js/popper.min.js"></script>
      <script src="assets/donation/assets/js/bootstrap.min.js"></script>

      <script src="assets/donation/js/custom.js"></script>
    </body>

  </html>';

} else if(isset($_POST['donate'])){

    $callBackURL = 'https://aghosh.gptech.pk/donate.php?call=orderStatus';

    //Dates Conversion
    $issue_date = date('Y-m-d');
		$challandate	= date('Ym');
    $due_date   = date('Y-m-d' , strtotime($issue_date. ' + 7 day'));
    
    // Challan Number 
    $sqllmschallan 	= $dblms->querylms("SELECT challan_no 
                                            FROM ".DONATION_UNREGISTER." 
                                            WHERE challan_no LIKE '%".$challandate."%'  
                                            ORDER by challan_no DESC LIMIT 1 ");
    $rowchallan = mysqli_fetch_array($sqllmschallan);
    if(mysqli_num_rows($sqllmschallan) < 1) {
      $challano	= $challandate.'00001';
    } else  {
      $challano = ($rowchallan['challan_no'] +1);
    }
    
    // Inset 
    $sqllmsDonation = $dblms->querylms("INSERT INTO ".DONATION_UNREGISTER."(
                                                            status                  ,
                                                            challan_no 		    	    ,
                                                            first_name				      ,
                                                            last_name			        	, 
                                                            phone				          	, 
                                                            email				          	,
                                                            issue_date			      	,
                                                            due_date				        ,
                                                            amount					        ,
                                                            id_purpose			      	,
                                                            id_country			      	, 
                                                            date_added 	
                                                        )
                                                    VALUES(
                                                            '2'                                   ,
                                                            '".cleanvars($challano)."'			      ,
                                                            '".cleanvars($_POST['first_name'])."'	,
                                                            '".cleanvars($_POST['last_name'])."'	,
                                                            '".cleanvars($_POST['phone'])."'		  ,
                                                            '".cleanvars($_POST['email'])."'	    ,
                                                            '".cleanvars($issue_date)."'		      , 
                                                            '".cleanvars($due_date)."'			      ,
                                                            '".cleanvars($_POST['amount'])."'	    ,
                                                            '".cleanvars($_POST['id_purpose'])."'	,
                                                            '".cleanvars($_POST['id_country'])."'	,
                                                            Now()	
                                                        )" );
                                
    if($sqllmsDonation) {

      // Send To PayPro

      //Date Conversion 
      $issuedate = date('d/m/Y' , strtotime($issue_date));
      $duedate   = date('d/m/Y' , strtotime($issue_date. ' + 7 day'));

      //Initialize Array
      $dataArray = array();

      //Set Credential Objects
      // $data0['MerchantId'] = 'Aghosh_School';
      // $data0['MerchantPassword'] = 'Live@aghosh21';

      $data0['MerchantId'] = 'Aghosh_School';
      $data0['MerchantPassword'] = 'Demo@school21';

      //Set Other Objects
      $data1['OrderNumber'] = $challano;
      $data1['OrderAmount'] = cleanvars($_POST['amount']);
      $data1['OrderDueDate'] = $duedate;
      $data1['OrderAmountWithinDueDate'] = cleanvars($_POST['amount']);
      $data1['OrderAmountAfterDueDate'] = cleanvars($_POST['amount']+300);
      $data1['OrderType'] = 'Service';
      $data1['IssueDate'] = $issuedate;
      $data1['OrderExpireAfterSeconds'] = '';
      $data1['CustomerName'] = cleanvars($_POST['first_name'])." ".cleanvars($_POST['last_name']);
      $data1['CustomerMobile'] = '';
      $data1['CustomerEmail'] = $_POST['email'];
      $data1['CustomerAddress'] = '';

      // echo json_encode($data1);

      //Push Objects to Array
      array_push($dataArray,$data0,$data1);

      //Encode Request Parameters for cURL
      $payLoad = json_encode($dataArray);

      //Create a new cURL resource
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
          // CURLOPT_URL => 'https://api.paypro.com.pk/cpay/co?oJson=',
          CURLOPT_URL => 'https://demoapi.paypro.com.pk/cpay/co?oJson=',
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

      // echo $responseStatus;
      // exit;

      //If Response Status Code and URL Ok then redirect
      if($responseStatus == '00' && $responseURL){

          $sqllmsUpdateID = $dblms->querylms("UPDATE ".DONATION_UNREGISTER." SET 
                                                    order_id	  = '".cleanvars($payProID)."'
                                              WHERE challan_no  = '$challano' ");

          // Send Messgae From AGS
          $phone = str_replace("-","",$_POST['phone']);

          // Set Credentials, Cell and MSG in Data Objects
          $data['username'] = 'demoumer';
          $data['password'] = '786786';
          $data['mask'] = 'AGS';
          $data['mobile'] = $phone;
          $data['message'] = 'Dear '.cleanvars($_POST['first_name']).',\n\nYou donation challan of amount '.cleanvars($_POST['amount']).' PKR has been issued.\n\nThanks,\nAghosh Grammar School';
        
          $curl = curl_init();
        
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://brandyourtext.com/sms/api/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          ));
        
          $response = curl_exec($curl);
          $err = curl_error($curl);
        
          curl_close($curl);

          header("Location: $responseURL.'&callback_url=$callBackURL", true, 301);
          exit();

      } else {

          header("Location: https://aghosh.gptech.pk/donateResponse.php?status=$responseStatus", true, 301);
          exit();
      }
    }
} 


// Pay Order
if($_REQUEST['ordId']){

  // Order ID
  $orderID = $_REQUEST['ordId'];

  //Set Credential Objects
  // $userName = 'Aghosh_School';
  // $password = 'Live@aghosh21';

  $userName  = 'Aghosh_School';
  $password  = 'Demo@school21';
  $cpayId    = cleanvars($orderID);

  //Create a new cURL resource
  $curl = curl_init();

  curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://demoapi.paypro.com.pk/cpay/gos?userName='.$userName.'&password='.$password.'&cpayId='.$cpayId,
      // CURLOPT_URL => 'https://api.paypro.com.pk/cpay/gos?userName='.$userName.'&password='.$password.'&cpayId='.$cpayId,
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
    
    //Update Donation As Paid
    $sqllmsPaid  = $dblms->querylms("UPDATE ".DONATION_UNREGISTER." SET 
                                        status	  = '1' 
                                      , date_paid = NOW() 
                                WHERE order_id  = '".$orderID."' ");

    if($sqllmsPaid) {

      // Donor Details
      $sqllmsDonor = $dblms->querylms("SELECT first_name, amount, phone
                                            FROM ".DONATION_UNREGISTER." f			   
                                            WHERE order_id = '".$orderID."' ");
      $valDonor = mysqli_fetch_array($sqllmsDonor);
      
      // Send Messgae From AGS
      $phone = str_replace("-","",$valDonor['phone']);

      // Set Credentials, Cell and MSG in Data Objects
      $data['username'] = 'demoumer';
      $data['password'] = '786786';
      $data['mask'] = 'AGS';
      $data['mobile'] = $phone;
      $data['message'] = 'Dear '.cleanvars($valDonor['first_name']).',\n\nYour donation of amount '.cleanvars($valDonor['amount']).' PKR has been paid on date '.date('d-m-Y').'.\n\nThanks,\nAghosh Grammar School';
    
      $curl = curl_init();
    
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://brandyourtext.com/sms/api/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      ));
    
      $response = curl_exec($curl);
      $err = curl_error($curl);
    
      curl_close($curl);
    }

    header("Location: https://aghosh.gptech.pk/donateResponse.php?status=00", true, 301);
    exit();

  } else{

    header("Location: https://aghosh.gptech.pk/donateResponse.php?status=02", true, 301);
    exit();

  }
}    
?>

