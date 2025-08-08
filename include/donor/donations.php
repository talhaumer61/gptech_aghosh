<?php 
//-----------------------------------------------
//-----------------------------------------------
echo '
<title> Donation Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Donation Panel </h2>
	</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
		<div class="col-md-12">';
			if(isset($_GET['std']) && isset($_GET['don']) || isset($_GET['search_word'])) {
				include_once("donation/donations/studentProfile.php");
			} else {
				include_once("donation/donations/list.php");
			}
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
</script>
<!-- (STYLE AJAX MODAL)-->
<div id="show_modal" class="mfp-with-anim modal-block modal-block-primary mfp-hide"></div>
<script type="text/javascript">
	function confirm_modal( delete_url ) {
		swal( {
			title: "Are you sure?",
			text: "Are you sure that you want to delete this information?",
			type: "warning",
			showCancelButton: true,
			showLoaderOnConfirm: true,
			closeOnConfirm: false,
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "Cancel",
			confirmButtonColor: "#ec6c62"
		}, function () {
			window.location.href = delete_url;
		} );
	}
</script>    
<!-- INCLUDES BOTTOM -->';
//-----------------------------------------------
?>