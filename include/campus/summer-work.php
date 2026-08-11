<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '62')))
{
//-----------------------------------------------
echo '
<title>Summer Work Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Summer Work Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	include_once("summer-work/list_summer-work.php");
//-----------------------------------------------
echo '
</div>
</div>';
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
	});
</script>
<?php 
//------------------------------------------
echo '
</section>';
//-------------------------------------------
} 
else{
	header("Location: dashboard.php");
}
?>