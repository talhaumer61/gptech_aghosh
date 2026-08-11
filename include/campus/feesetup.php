<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '70'))){
	require_once("fee/query_fee.php");

	if($view == 'copy'){
		$title = 'Copy Fee Setup';
	}else{
		$title = 'Fee Structure';
	}
	echo '
	<title>'.$title.' | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>'.$title.' Panel</h2>
		</header>
		<div class="row">
			<div class="col-md-12">';
				if($view == 'add'){
					include_once("fee/add_fee_detail.php");
				}
				else if($view == 'copy'){
					include_once("fee/copy_feesetup.php");
				}
				else if(isset($_GET['id'])){
					include_once("fee/edit_fee_detail.php");
				}
				else{
					include_once("fee/list_feesetup.php");
				}
				echo '
			</div>
		</div>';
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				<?php 
				if(isset($_SESSION['msg'])) { 
					echo 'new PNotify({
						title	: "'.$_SESSION['msg']['title'].'"	,
						text	: "'.$_SESSION['msg']['text'].'"	,
						type	: "'.$_SESSION['msg']['type'].'"	,
						hide	: true	,
						buttons: {
							closer	: true	,
							sticker	: false
						}
					});';
					unset($_SESSION['msg']);
				}
				?>	
				var datatable = $('#table_export').dataTable({
					bAutoWidth : false,
					ordering: false,
				});
			});

			// Check/uncheck all checkboxes on clicking main checkbox
			$('#main-checkbox').change(function() {
				if($(this).is(":checked")) {
					$('.sub-checkbox').prop('checked', true);
				} else {
					$('.sub-checkbox').prop('checked', false);
				}
			});

			function get_feestruclasssection(id_class) {  
				$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
				$.ajax({  
					type: "POST",  
					url: "include/ajax/get_feestructureclasssection.php",  
					data: "id_class="+id_class,
					success: function(msg){  
						$("#getfeestruclasssection").html(msg); 
						$("#loading").html(''); 
					}
				});  
			}
		</script>
		<?php
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
	</script>';
}else{
	header("location: dashboard.php");
}
?>