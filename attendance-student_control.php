<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
	require_once("include/student/student_attendce/query_students_attendce.php");
	include_once("include/header.php");
//-----------------------------------------------
echo '
<title> Employee Attendce Marking | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Employee Attendce Marking </h2>
	</header> '
	?>

					<!-- INCLUDEING PAGE -->
					<style>
	.radio-custom {
		margin-bottom: 0;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<?php
		include_once("include/student/student_attendce/select_date.php");
        include_once("include/student/student_attendce/students_attendce_list.php");
		?>
	</div>
</div>
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
			sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
			oTableTools: {
				sSwfPath: 'assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf',
				aButtons: [
					{
						sExtends: 'pdf',
						sButtonText: 'PDF',
						mColumns: [0,1,2,3,4]
					},
					{
						sExtends: 'csv',
						sButtonText: 'CSV',
						mColumns: [0,1,2,3,4]
					},
					{
						sExtends: 'xls',
						sButtonText: 'Excel',
						mColumns:[0,1,2,3,4]
					},
					{
						sExtends: 'print',
						sButtonText: 'Print',
						sInfo: '',
						fnClick: function (nButton, oConfig) {
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								if (e.which == 27) {
									datatable.fnSetColumnVis(5, true);
								}
							});
						}
					}
				]
			}
		});
	});
</script>
<script type="text/javascript">

    function select_section(class_id) {

		$.ajax({
			url: 'attendance/get_class_section/' + class_id,
			success: function( response ) {
				jQuery( '#section_id' ).html( response );
			}
		});
    }
	
    function mark_all_present() {
        var count = 1+<?php echo $srno; ?>;
		
		for(var i = 1; i < count; i++) {
			document.getElementById('pstatus_' + i).checked = true;
		}
    }

    function mark_all_absent() {
        var count = 1+<?php echo $srno; ?>;
		
		for(var i = 1; i < count; i++){
			document.getElementById('astatus_' + i).checked = true;
		}
    }
	
    function mark_all_holiday() {
        var count = 1+<?php echo $srno; ?>;
		
		for(var i = 1; i < count; i++){
			document.getElementById('hstatus_' + i).checked = true;
		}
    }
	
</script>				</section>
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
				<!-- VENDOR -->
		<?php
        include_once("include/footer.php");
        ?>