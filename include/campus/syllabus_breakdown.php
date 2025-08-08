<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '57')))
{ 
	//-----------------------------------------------
	echo '
	<title> Syllabus Panel | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Syllabus Panel </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
		include_once("syllabus-breakdown/list_syllabus.php");
	//-----------------------------------------------
	echo '
	</div>
	</div>
	</section>';
}
else
{
	header("Location: dashboard.php");
}
?>

<script type="text/javascript">
	jQuery(document).ready(function($) {	
var datatable = $('#table_export').dataTable({
			bAutoWidth : false,
			ordering: false,
		});
	});
</script>