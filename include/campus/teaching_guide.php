<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '64')))
{
//-----------------------------------------------
echo'
<title> Teaching Guide Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Teaching Guide Panel </h2>
	</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
		<div class="col-md-12">';
		//-----------------------------------------------
			include_once("teaching_guide/list.php");
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
		function get_classsubject(id_class) {  
			$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_classsubject.php",  
				data: "id_class="+id_class,  
				success: function(msg){  
					$("#getclasssubject").html(msg); 
					$("#loading").html(''); 
				}
			});  
		}
	</script>
	<?php 
	//------------------------------------
	echo '
</section>';
//-----------------------------------------------
}
else
{
	header("Location: dashboard.php");
}
?>