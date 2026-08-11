<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '90', 'add' => '1'))){ 
//---------------------------------------------
$today = date('m/d/Y');
// if(isset($_POST['id_month'])){
// 	$DueMonth = $_POST['id_month'];
// 	$DueDate = date(''.$DueMonth.'/15/Y');
// }else{
// 	$DueDate = date('m/15/Y');
// }
//---------------------------------------------
echo '
<!-- Add Modal Box -->
<div id="make_challan" class="zoom-anim-dialog modal-block modal-block-lg modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="feecollections.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i> Pay Fee Challan</h2>
			</header>
			<div class="panel-body">			
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label">Challan #<span class="required">*</span></label>
						<input type="text" class="form-control" name="challanno" id="challanno" value="9930'.date("y").'" required title="Must Be Required" onchange="get_cashchallandetail(this.value)" tabindex="1" />
					</div>
				</div>


				<div id="getchallandetail"></div>

                
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="challan_cashpay" name="challan_cashpay"  onClick=\'return confirmSubmit()\'>Paid</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>
<script LANGUAGE="JavaScript">
<!--
function confirmSubmit() {
	var agree=confirm("Are you sure you wish to continue?");
	if (agree)
	 return true ;
	else
	 return false ;
	}
// -->
</script>';
}
?>
<script type="text/javascript">

	function get_cashchallandetail(challano) { 
		
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_cashchallandetail.php",
			data: "challano="+challano,  
			success: function(msg){  
				$("#getchallandetail").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}

</script>