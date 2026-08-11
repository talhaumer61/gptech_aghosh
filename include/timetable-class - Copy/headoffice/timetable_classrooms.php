<?php 
//-----------------------------------------------
echo '
<title> Class Room | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Classroom Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	include_once("timetable/classrooms/list_classrooms.php");
//-----------------------------------------------
echo '
</div>
</div>
</section>';
//-----------------------------------------------
?>