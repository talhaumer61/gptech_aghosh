<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'view' => '1'))){ 
	echo '
	<title> Assessment Policy | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2> Exam Panel  </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
		include_once("exam_policy/list.php");
	//-----------------------------------------------
	echo '
	</div>
	</div>';
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {	
	//------------------------------------
		var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
	</script>
	<?php 
	//------------------------------------
	echo '
	</section>
	</div>
	</section>	';
	//-----------------------------------------------
} 
else{
	header("Location: dashboard.php");
}
?>