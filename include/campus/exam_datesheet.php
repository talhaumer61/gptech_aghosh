<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '9')))
{
	//-----------------------------------------------
	require_once("exam_datesheet/query.php");
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
	if ($view == 'add') {
			include_once("exam_datesheet/add.php");
	} elseif ($view == 'routine') {
			include_once("exam_datesheet/viewall.php");
	} elseif (isset($_GET['routine'])) {
			include_once("exam_datesheet/view.php");
	} elseif (isset($_GET['id'])) {
			include_once("exam_datesheet/edit.php");
	} else {
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
	if(isset($_SESSION['msg'])) { 
	//-----------------------------------------------
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
	//-----------------------------------------------
		unset($_SESSION['msg']);
	//-----------------------------------------------
	}
	//-----------------------------------------------
	?>	
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
	//-----------------------------------------------

		function get_classsection(id_class) {  
			$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_classsection.php",  
				data: "id_class="+id_class,  
				success: function(msg){  
					$("#getclasssection").html(msg); 
					$("#loading").html(''); 
				}
			});  
		}
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
					swal( "Oops", "We couldn\'t\ connect to the server!", "error" );
				} );
			} );
		}
	</script>    
	<!-- INCLUDES BOTTOM -->';
}
else
{
	header("Location: dashboard.php");
}
?>