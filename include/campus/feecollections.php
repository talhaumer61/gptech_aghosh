<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '90')) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '91')))
{
	
	$printid	= (isset($_GET['printid']) && $_GET['printid'] != '') ? $_GET['printid'] : '';
	// for sending message
	//require_once("include/functions/send_message.php");
	require_once("feecollections/query.php");
	
echo '
<title> Fee Collections Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Fee Collections Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	include_once("feecollections/list.php");
	include_once("feecollections/listbankdeposit.php");
	include_once("include/modals/feecollections/add.php");
	include_once("include/modals/feecollections/addpartial.php");
	include_once("include/modals/feecollections/addbankdospit.php");
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

	function get_feeclasssection(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_feeclasssection.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#getfeeclasssection").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}
	
	function get_duedate(yearmonth){ 
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_duedate.php",  
			data: "yearmonth="+yearmonth,
			success: function(msg){  
				$("#getduedate").html(msg); 
				$("#loading").html('');
			}
		});  
	}
	function confirmSubmit() {
		
		 // Check if the element with ID 'totaltransamount'  exists in the form
		var totaltransamount 	= document.getElementById('totaltransamount');

		if (totaltransamount) {
			// Check if required fields have data
			var value = totaltransamount.value.trim();
			// Check if any required field is empty
			if (value != '') {
				var agree=confirm("Are you sure you wish to continue?");
				if (agree)
					return true ;
				else
					return false ;
			}
		}else {
			var agree=confirm("Are you sure you wish to continue?");
			if (agree)
				return true ;
			else
				return false ;
		}
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
<div id="show_modal" class="mfp-with-anim modal-block modal-block-lg modal-block-primary mfp-hide"></div>


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
</script>    
<!-- INCLUDES BOTTOM -->';
//-----------------------------------------------
} else {
	header("location: dashboard.php");
}
?>