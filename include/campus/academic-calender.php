<?php 
//-----------------------------------------------
echo '
<title> Academic Calender | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2> Academic Calender  </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	include_once("academic_calender/list_academic_calender.php");
//-----------------------------------------------
echo '
</div>
</div>
</section>';