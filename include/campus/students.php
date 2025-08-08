<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '1')))
{
//-----------------------------------------------
	include_once("students/query_students.php");
	require_once("include/functions/send_message.php");
//-----------------------------------------------
echo '
<title>Student Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>';if(isset($_GET['id'])){echo ' Student Profile';} else{echo ' Student Panel';} echo '</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	if($view == 'add'){
		include_once("students/student_add.php");
	} elseif(isset($_GET['inquiry'])){
		include_once("students/inquiry_add.php");
	} elseif(isset($_GET['id'])){
		include_once("students/student_edit.php");
	}else{
		include_once("students/list_students.php");
	}
	include_once("include/modals/admissions/student_data.php");
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

	
	function get_formno(form_no) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_admissiondetail.php",  
			data: "form_no="+form_no,  
			success: function(msg){  
				$("#getadmissiondetail").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}

	function get_classsection(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_admissionSectionRoll.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#getclasssection").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}

	function get_editclasssection(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_editclasssection.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#geteditclasssection").html(msg); 
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
			// location.reload();
			window.location.href = delete_url;
		} );
	}
</script>   


<!-- INCLUDES MODAL -->
<script type="text/javascript">
	function showAjaxModalZoom( url_orp ) {
// PRELODER SHOW ENABLE / DISABLE
		jQuery( \'#show_orphan_modal\' ).html( \'<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>\' );
// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax( {
			url_orp: url_orp,
			success: function ( response ) {
				jQuery( \'#show_orphan_modal\' ).html( response );
			}
		} );
	}
</script>
<!-- (STYLE AJAX MODAL)-->
<div id="show_orphan_modal" class="mfp-with-anim modal-block modal-block-primary mfp-hide"></div>
<script type="text/javascript">
	function oprhan_modal( orphan_url ) {
		swal( {
			title: "Are you sure?",
			text: "Are you sure that you want this student as Orpahn?",
			type: "warning",
			showCancelButton: true,
			showLoaderOnConfirm: true,
			closeOnConfirm: false,
			confirmButtonText: "Yes, Approve it!",
			cancelButtonText: "Cancel",
			confirmButtonColor: "#0088cc"
		}, function () {
			// location.reload();
			window.location.href = orphan_url;
		} );
	}
</script> 
<!-- INCLUDES BOTTOM -->';
//-----------------------------------------------
}
else
{
	header("location: dashboard.php");
}
?>