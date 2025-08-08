<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '83')))
{  
	//-----------------------------------------------
	echo '
	<title> Exam Panel | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Exam Panel </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
		include_once("exam_paper/list.php");
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
	//------------------------------------
	echo '
	</section>
	</div>
	</section>	
	<!-- INCLUDES MODAL -->
<script type="text/javascript">
	function showAjaxModalZoom( url ) {
// PRELODER SHOW ENABLE / DISABLE
		jQuery( \'#show_modal\' ).html( \'<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>\' );
// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax( {
			url: url,
			success: function ( response ) {
				jQuery( \'#show_modal\' ).html( response );
			}
		} );
	}
</script>';
//-----------------------------------------------
}
else
{
	header("location: dashboard.php");
}
?>