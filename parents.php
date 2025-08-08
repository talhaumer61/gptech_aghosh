<?php 
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
echo '
<title>Parents Panel | School Management System</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Parents Panel</h2>
	</header>
<!-- INCLUDEING PAGE -->';
	include_once("include/parents/parents_list.php");
	include_once("include/parents/modal/modal_parent_add.php");
	
?>

<script type="text/javascript">

	//DEFAULT DATA TABLE CONFIGURATIONS
	jQuery(document).ready(function($)
	{
		$('input[name="user_id"]').bootstrapSwitch();
		$('#table_default').dataTable( {
		  "ordering": false
		});
		
		$("form#frm").validate({
			rules: {
				email: {
					email: true,
					remote: {
						url: 'parents/get_email_exists',
						type: "post",
						data: {
							email: function(){ return $("#email").val(); }
						}
					}
				}
			},

			messages: {
				email: {
					email: 'Please enter a valid email address.',
					remote: 'This Email account already used'
				}
			}
		});
		
	});
	
	//ACCOUNT ACTIVATED/DEACTIVATED
	$('input[name="user_id"]').on('switchChange.bootstrapSwitch', function(event, state) {
		var id =  event.target.id;
		if ( id != null ) {
			$.ajax({
				method: 'POST',
				url: 'parents/status',
				data: "id=" + id + "&status=" + state,
				dataType: "html",
				success: function(data) {
					swal("Successfully", data, "success")
				}
			});
		}
	});
</script>
</section>
</div>
</section>
		
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
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>