<?php 
if(isset($_GET['std']) && isset($_GET['don'])) {
echo '
<section role="main" class="content-body">
	<!-- INCLUDEING PAGE -->
	<div class="row appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
		//-----------------------------------------------
		include_once("profile/detail.php");
		//-----------------------------------------------
		echo '
		<div class="col-md-8">
			<div class="tabs tabs-primary">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#donation" data-toggle="tab"><i class="fa fa-dollar"></i> <span class="hidden-xs"> Donation History</span></a>
					</li>
					<li>
						<a href="#education" data-toggle="tab"><i class="fa fa-book"></i> <span class="hidden-xs"> Education History</span></a>
					</li>
				</ul>
				<div class="tab-content">';
					include_once("profile/donationHistory.php");
					include_once("profile/educationHistory.php");
					echo '
				</div>
			</div>
		</div>
	</div>
</section>';
}
?>