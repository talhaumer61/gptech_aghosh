<?php 
//-----------------------------------------------
//	include_once("../header.php");
//-----------------------------------------------
echo '

<section role="main" class="content-body">
	<header class="page-header">
		<h2>FeeSetup Control </h2>
	</header>

<!-- INCLUDEING PAGE -->
<div class="row appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
//-----------------------------------------------
	include_once("edit/detail.php");
//-----------------------------------------------
echo '
<div class="col-md-8">
<div class="tabs tabs-primary">
	<ul class="nav nav-tabs">
		<li class="active"	>
			<a href="#edit" data-toggle="tab"><i class="fa fa-dollar"></i> <span class="hidden-xs"> Fee</span></a>
		</li>
	</ul>
	<div class="tab-content">';
//-----------------------------------------------
	include_once("edit/edit_fee.php");
	//include_once("../employee/profile/change_password.php");
//-----------------------------------------------
echo '
	</div>
</div>
</div>
</div>
</section>

</div>
</section>';
?>
		
<!-- INCLUDES MODAL -->
<script type="text/javascript">
	function showAjaxModalZoom( url ) {
// PRELODER SHOW ENABLE / DISABLE
		jQuery( '#show_modal' ).html( '<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>' );
// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax( {
			url: url,
			success: function ( response ) {
				jQuery( '#show_modal' ).html( response );
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
				swal( "Oops", "We couldn't connect to the server!", "error" );
			} );
		} );
	}
</script>    
<!-- INCLUDES BOTTOM -->
<?php 
//---------------------------------------------
//	include_once("../footer.php"); 
//---------------------------------------------
?>