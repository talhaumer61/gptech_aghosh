<?php 
//---------------------------------------------
	include_once("include/header.php");
//---------------------------------------------
echo '
<title>Session Settings | School Management System</title>
<section role="main" class="content-body">

<header class="page-header">
	<h2>Session Settings</h2>
</header>
<!-- INCLUDEING PAGE -->
<div class="row">';
//---------------------------------------------
	include_once("include/settings/sessions/add.php");
	include_once("include/settings/sessions/list.php");
//---------------------------------------------
echo '
</div>
</section>
</div>
</section>

<!-- INCLUDES MODAL -->
<script type="text/javascript">
	function showAjaxModalZoom( url ) {
		jQuery( \'#show_modal\' ).html( \'<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>\' );
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
		$.ajax( {
			url: delete_url,
			type: "POST"
		} )
		.done( function ( data ) {
			swal( {
				title: "Deleted",
				text: "Information has been successfully deleted",
				type: "success"
			}, function () {
			location.reload();
		} );
	} )
	.error( function ( data ) {
		swal( "Oops", "We couldnt connect to the server!", "error" );
	} );
} );
}
</script>    
<!-- INCLUDES BOTTOM -->';
//---------------------------------------------
include_once("include/footer.php");
//---------------------------------------------
?>