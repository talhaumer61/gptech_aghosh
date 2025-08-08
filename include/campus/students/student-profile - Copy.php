<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'added' => '1'))){
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
echo '

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Student Profile Control </h2>
	</header>

<!-- INCLUDEING PAGE -->
<div class="row appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
//-----------------------------------------------
	include_once("include/students/profile/detail.php");
//-----------------------------------------------
echo '
<div class="col-md-8">
<div class="tabs tabs-primary">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#edit" data-toggle="tab"><i class="fa fa-user"></i> <span class="hidden-xs"> Profile</span></a>
		</li>
		<li>
			<a href="#resetpass" data-toggle="tab"><i class="fa fa-lock"></i> <span class="hidden-xs"> Change Password</span></a>
		</li>
	</ul>
	<div class="tab-content">';
//-----------------------------------------------
	include_once("include/students/profile/edit_profile.php");
	include_once("include/students/profile/bank_details.php");
	include_once("include/students/profile/change_password.php");
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
	include_once("include/footer.php"); 
//---------------------------------------------
}
else{
	header("Location: dashboard.php");
}
?>