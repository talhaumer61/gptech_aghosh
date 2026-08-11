<?php 
//-----------------------------------------------
echo '
<title> Dashboard | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Coordinator Panel</h2>
	</header>
    <!-- INCLUDEING PAGE -->
    <div class="row">';
        include "dashboard/modal.php";
        include "dashboard/main_counter.php";
        echo '
    </div>';
    include "dashboard/classwisestudents.php";
    echo '
</section>';
?>