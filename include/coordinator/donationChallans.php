<?php 
echo '
<title> Donation Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Donation Panel </h2>
	</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
		<div class="col-md-12">';
			include_once("donation/donationChallans/list.php");
			echo '
		</div>
	</div>
</section>';
?>