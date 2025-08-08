<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '14'))) {
echo'
<title> Mark Sheet Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Marks Sheet Panel </h2>
	</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
		<div class="col-md-12">';
			if($view == 'view') {
				include_once("exam_marks/marks_view.php");
			}
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
								datatable.fnSetColumnVis(7, false);
								
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
		
		// GET CLASS
		function get_classlevel(id_classlevel){
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_classlevel.php",  
				data: "id_classlevel="+id_classlevel,  
				success: function(msg){  
					$("#id_class").html(msg); 
					$("#loading").html(""); 
				}
			});
		}
		// SECTION TEACHERS
		function get_class_sectionteacher(id_class){
			$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...'); 
			var id_campus = document.getElementById("id_campus").value;
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_class_sectionteacher.php",
				data: { 
						  id_class: id_class
						, id_campus: id_campus
					},
				success: function(msg){  
					$("#get_class_sectionteacher").html(msg); 
					$("#loading").html(''); 
				}
			});  
		}
		// SUBJECTS
		$(document).on('change', '#id_teacher', function() {
			var id_teacher = $(this).val();
			$.ajax({
				url: "include/ajax/get_classsubject.php",
				type: 'POST',
				data: { 
						id_teacher: id_teacher
						},
				success: function(data) {
					$('#id_subject').html(data);
				}
			});
		});

		// EXPORT TO EXCEL
		function html_table_to_excel(type){
			var data = document.getElementById('my_table');
			var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
			XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
			XLSX.writeFile(file, 'exam_marks.' + type);
		}

		const export_button = document.getElementById('export_button');
		export_button.addEventListener('click', () =>  {
			html_table_to_excel('xlsx');
		});

	</script>
	<?php
	echo'
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
</script>';
}else{
	header("location: dashboard.php");
}
?>