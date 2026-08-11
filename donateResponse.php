<?php
if($_GET['status'] == 00) {
  $img ='<img src="assets/donation/images/success_heart.png" alt="Successfully Donate">';
  $response = 'Donated Successfully';
  $text = 'Thanks! We are very glad to get you valuable love for beautiful people!';
} else {
  $img ='<img src="assets/donation/images/failed.png" alt="Failed">';
  $response = "Donation Failed";
  $text = '';
}
echo'
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>'.$response.'</title>

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
    
    <div class="ugf-bg">
      <div class="final-content">
        <div class="icon">
          '.$img.'
        </div>
        <h2>'.$response.'</h2>
        <p>'.$text.'</p>
        <a href="donate.php" class="btn">Donate Again</a>
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
?>