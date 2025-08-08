<?php
require_once("feeconcession/query.php");
	$idstd	= (isset($_REQUEST['idstd']) && $_REQUEST['idstd'] != '') ? $_REQUEST['idstd'] : '';
	if($view == 'copy'){
		$title = 'Copy Fee Concession';
	} elseif($view == 'add'){
		$title = 'Add Fee Concession';
	} elseif($view == 'edit'){
		$title = 'Edit Fee Concession';
	} else{
		$title = 'Fee Concession';
	}

echo'
<title> '.$title.' | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>'.$title.' Panel </h2>
	</header>
	<div class="row">
		<div class="col-md-12">';
			
				include_once("feeconcession/copy_feeconcession.php");
				include_once("feeconcession/list_feeconcession.php");
				include_once("feeconcession/add.php");
				include_once("feeconcession/edit.php");
			//	include_once("include/modals/feeconcession/feeconcession_add.php");
		
			echo'
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
		
		function getConcessionCatDetail(id_cat) {  
			$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_concessionField.php",  
				data: "id_cat="+id_cat,  
				success: function(msg){  
					$("#getConcessionCatDetail").html(msg); 
					$("#loading").html(''); 
				}
			});  
		}
		
		function get_classstudent(id_class) {  
			$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_class-student.php",  
				data: "id_class="+id_class,  
				success: function(msg){  
					$("#getclassstudent").html(msg); 
					$("#loading").html(''); 
				}
			});  
		}

		function get_concessionField(id_consessionType) {  
			$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_concessionField.php",  
				data: "id_consessionType="+id_consessionType,  
				success: function(msg){  
					$("#getConcessionField").html(msg); 
					$("#loading").html(''); 
				}
			});  
		}
		
		// Check/uncheck all checkboxes on clicking main checkbox
		$('#main-checkbox').change(function() {
			if($(this).is(":checked")) {
				$('.sub-checkbox').prop('checked', true);
			} else {
				$('.sub-checkbox').prop('checked', false);
			}
		});
	</script>
	<?php
	echo'
</section>

<!-- INCLUDES MODAL -->
<script type="text/javascript">
	function showAjaxModalZoomStd( url ) {
// PRELODER SHOW ENABLE / DISABLE
		jQuery( \'#show_std_modal\' ).html( \'<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>\' );
// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax( {
			url: url,
			success: function ( response ) {
				jQuery( \'#show_std_modal\' ).html( response );
			}
		} );
	}
</script>
<!-- (STYLE AJAX MODAL)-->
<div id="show_std_modal" class="mfp-with-anim modal-block-primary mfp-hide" style="width: 70%; margin:auto;"></div>

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
<div id="show_modal" class="mfp-with-anim modal-block-primary mfp-hide" style="width: 60%; margin:auto;"></div>
<!-- (STYLE AJAX MODAL)-->

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
				swal( "Oops", "We couldn\'t\ connect to the server!", "error" );
			} );
		} );
	}
</script>';
?>