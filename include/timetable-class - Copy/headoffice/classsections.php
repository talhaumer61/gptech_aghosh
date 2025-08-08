<?php 
//-----------------------------------------------
echo '
<title> Section Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Section Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	include_once("classes/list_classsections.php");
//-----------------------------------------------
echo '
</div>
</div>
</section>';