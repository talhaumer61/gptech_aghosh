<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '9')))
{
	//-----------------------------------------------
	echo '
	<title> Exam Datesheet Panel | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Datesheet Panel </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
	if($view == 'routine'){
			include_once("exam_datesheet/viewall.php");
	}
	elseif(isset($_GET['routine'])){
			include_once("exam_datesheet/view.php");
	}
	else{
		include_once("exam_datesheet/list.php");
	}
	//-----------------------------------------------
	echo '
	</div>
	</div>';
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
	<?php 
	//-----------------------------------------------
	?>	
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
	//-----------------------------------------------
	</script>
	<?php 
	//------------------------------------
	echo '
	</section>
	</div>';
}
else
{
	header("Location: dashboard.php");
}
?>