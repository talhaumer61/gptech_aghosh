<?php 
echo'
<!-- VENDOR -->
<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
<script src="assets/vendor/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="assets/vendor/jquery-ui/jquery-ui.js"></script>
<script src="assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<script src="assets/vendor/select2/js/select2.js"></script>
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<script src="assets/vendor/fuelux/js/spinner.js"></script>
<script src="assets/vendor/dropzone/dropzone.js"></script>
<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="assets/vendor/summernote/summernote.js"></script>
<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
<script src="assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>

<!-- DATATABLES PAGE VENDOR -->
<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

<!-- FILEINPUT JS -->
<script src="assets/javascripts/fileinput.js"></script>
<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
	
<!-- PNOTIFY NOTIFICATIONS JS -->
<script src="assets/vendor/pnotify/pnotify.custom.js"></script>

<!-- ANIMATIONS APPEAR JS -->
<script src="assets/vendor/jquery-appear/jquery-appear.js"></script>

<!-- FORM VALIDATION -->
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- THEME CUSTOM -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- THEME INITIALIZATION FILES -->
<script src="assets/javascripts/theme.init.js"></script>

<!-- CALENDAR FILES -->
<script src="assets/vendor/moment/moment.js"></script>
<script src="assets/vendor/fullcalendar/fullcalendar.js"></script>

<!-- CHART FILES -->
<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
<script src="assets/vendor/snap.svg/snap.svg.js"></script>
<script src="assets/vendor/snap.svg/snap.svg.js"></script>
<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
	
<!-- USER JS -->
<script src="assets/javascripts/user_config/dashboard.js"></script>
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/modals.js"></script>

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
	jQuery(document).ready(function($)	{
		$(\'.table_default\').dataTable( {
			bAutoWidth : false,
			ordering: false
		});
	});
</script>
<!-- SHOW PNOTIFIVATION -->

<script type="text/javascript">
	$(\'.popup-youtube\').magnificPopup({
		disableOn: 700,
		type: \'iframe\',
		mainClass: \'mfp-fade\',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	$(\'.thumbnail .mg-toggle\').parent()
	.on(\'show.bs.dropdown\', function( ev ) {
		$(this).closest(\'.mg-thumb-options\').css(\'overflow\', \'visible\');
	})
	.on(\'hidden.bs.dropdown\', function( ev ) {
		$(this).closest(\'.mg-thumb-options\').css(\'overflow\', \'\');
	});

	$(\'.thumbnail\').on(\'mouseenter\', function() {
		var toggle = $(this).find(\'.mg-toggle\');
		if ( toggle.parent().hasClass(\'open\') ) {
			toggle.dropdown(\'toggle\');
		}
	});
</script>
</body>
</html>';
?>