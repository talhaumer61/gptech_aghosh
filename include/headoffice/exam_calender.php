<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '12')))
{
	//-----------------------------------------------
		require_once("exam_calender/query.php");
	//-----------------------------------------------
	echo '
	<title> Exam Calender | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2> Exam Panel  </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
		if($view){
			include_once("exam_calender/add.php");
		}
		elseif(isset($_GET['id'])){
			include_once("exam_calender/edit.php");
		}
		else{
			include_once("exam_calender/list.php");
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