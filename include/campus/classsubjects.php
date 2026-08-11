<?php
//-----------------------------------------------
echo '
<title> Subject Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Subject Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	include_once("classes/list_classsubjects.php");
//-----------------------------------------------
echo '
</div>
</div>
</section>';
//-----------------------------------------------
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
</script>