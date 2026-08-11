<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '68')))
{
	//-----------------------------------------------
		require_once("academic_calender/query_academic_calender.php");
	//-----------------------------------------------
	echo '
	<title> Academic Calender | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2> Academic Calender  </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
		if($view){
			include_once("academic_calender/add_calender.php");
		}
		elseif(isset($_GET['id'])){
			include_once("academic_calender/edit_calender.php");
		}
		else{
			include_once("academic_calender/list_academic_calender.php");
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
	</script>
	<?php 
	//------------------------------------
	echo '
	</section>
	</div>
	</section>	
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
	</script>    
	<!-- INCLUDES BOTTOM -->';
	//-----------------------------------------------
} 
else{
	header("Location: dashboard.php");
}
?>