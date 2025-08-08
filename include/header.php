<?php 
echo'
<!doctype html>
<html class=" sidebar-light sidebar-left-big-icons">
<head>
<!-- BASIC -->
<meta charset="UTF-8">';
//------------------------------------------
	include_once("header-css.php");
//------------------------------------------
echo '

<script type="text/javascript">
	jQuery(document).ready(function()	{
		var barcode = "";
		var interval;
		document.addEventListener("keydown", function(evt) {
			if (interval)
				clearInterval(interval);
			if (evt.code == "Enter") {
				evt.preventDefault();
				if (barcode)
					handleBarcode(barcode);
				barcode = "";
				return;
			}
			if (evt.key != "Shift")
				barcode += evt.key;
			interval = setInterval(() => barcode = "", 20);
		});
		function handleBarcode(scanned_barcode) {
			var barcodeArray 	= scanned_barcode.split("-");
			var id_challan 		= barcodeArray[0];
			var id_fee 			= barcodeArray[1];
			jQuery("#barcodeModal").html("<div style=\"text-align:center;\"><img src=\"assets/images/preloader.gif\" /></div>");
			$.ajax( {
				url: `include/modals/feecollections/modal_feechallan_barqrcode.php?idchallan=${id_challan}&id_fee=${id_fee}`,
				success: function (response) {
					jQuery("#barcodeModal").html(response);
					$("#barcodeModal").modal("show");
				}
			});
		}
	});
	
	function confirmSubmitmodel() {

		var totaltransamount 	= document.getElementById(\'totaltransamount\');

		if (totaltransamount) {
			// Check if required fields have data
			var value = totaltransamount.value.trim();
			// Check if any required field is empty
			if (value != \'\') {
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
<!-- (STYLE AJAX MODAL)-->
</head>
<!-- loading-overlay-showing-->
<body class="" data-loading-overlay>
<div class="modal fade col-md-6 col-sm-10" id="barcodeModal" style="width: 70%; margin:auto; "></div>
<section class="body">
<!-- INCLUDEING HEADER -->';
//------------------------------------------
	// include_once("header-top.php");
	include_once(get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/header-top.php");
//------------------------------------------
echo '
<div class="inner-wrapper">
<!-- INCLUDEING NAVIGATION -->';
//------------------------------------------
	include_once(get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/sidebar-left.php");
//------------------------------------------

$sqlstring	= "";
$adjacents	= 3;
if(!($Limit)) 	{ $Limit = 20; } 
if($page)		{ $start = ($page - 1) * $Limit; } else {	$start = 0;	}
?>