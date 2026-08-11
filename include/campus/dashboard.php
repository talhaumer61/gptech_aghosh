<?php 
//-----------------------------------------------
echo '
<title> Dashboard | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Admin Panel</h2>
	</header>
    <!-- INCLUDEING PAGE -->
    <div class="row">';
//-----------------------------------------------
	include "dashboard/modal.php";
//-----------------------------------------------
	//include "dashboard/financegraph.php";
	include "dashboard/main_counter.php";
//-----------------------------------------------
    echo '
    </div>';
//-----------------------------------------------
	include "dashboard/classwisestudents.php";
	include "dashboard/catwisestudents.php";
//-----------------------------------------------
    echo '
    <div class="row">';
//-----------------------------------------------
	//include "dashboard/event_calendar.php";
	//include "dashboard/calculation.php";

//-----------------------------------------------
    echo '
    </div>
</section>';
?>