<?php 
//-----------------------------------------------
	require_once("attendance-students/query.php");
//-----------------------------------------------
echo '
<title> Attendance Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Attendance Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
	if($view)
	{
		include_once("attendance-students/add.php");
	}
	else if(isset($_GET['id']))
	{
		include_once("attendance-students/edit.php");
	}
	else{
		include_once("attendance-students/list.php");
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
	<?php
	if(isset($srno)){
		echo'
		function mark_all_present() {
			var count = 1+'.$srno.';
			
			for(var i = 1; i < count; i++) {
				document.getElementById(\'pstatus_\' + i).checked = true;
			}
		}
	
		function mark_all_absent() {
			var count = 1+'.$srno.';
			
			for(var i = 1; i < count; i++){
				document.getElementById(\'astatus_\' + i).checked = true;
			}
		}
		
		function mark_all_holiday() {
			var count = 1+'.$srno.';
			
			for(var i = 1; i < count; i++){
				document.getElementById(\'hstatus_\' + i).checked = true;
			}
		}';
	}
	
	?>
</script>
<?php 
//------------------------------------
echo '
</section>
</div>
</section>	
';
//-----------------------------------------------