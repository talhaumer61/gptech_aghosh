<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'add' => '1'))){
echo'
<!-- Add Modal Box -->
<div id="makeDonation" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="donations.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Student Donation</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Donor <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_donor">
							<option value="">Select</option>';
								$sqllmsDon	= $dblms->querylms("SELECT donor_id, donor_name 
													FROM ".DONORS."
													WHERE donor_status = '1' ORDER BY donor_name ASC");
								while($valueDon = mysqli_fetch_array($sqllmsDon)) {
									echo '<option value="'.$valueDon['donor_id'].'">'.$valueDon['donor_name'].'</option>';
								}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classstudent(this.value)">
							<option value="">Select</option>';
							$sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES." 
																	WHERE class_status = '1' ORDER BY class_id ASC");
							while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
								echo '<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Student <span class="required">*</span></label>
					<div class="col-md-9">
						<div id="getclassstudent">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std" name="id_std">
								<option value="">Select</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Amount <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="number" class="form-control amount" name="amount" id="amount" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Frequency <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="number" class="form-control duration"  id="duration" name="duration" placeholder="In Month"  required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Total Amount <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" id="total_amount" name="total_amount" class="form-control total" required title="Must Be Required" readonly/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_donation" name="submit_donation">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>
<script type="text/javascript">
	//------------ Students Against Class --------------
	function get_classstudent(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_class-student.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#getclassstudent").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}
	
	//------------- If Duration Change ------------------
	$(document).on("change", ".duration", function() {
		var amount =  document.getElementById("amount").value;
		var duration = document.getElementById("duration").value;
		var total  = amount * duration;
		$(".total").val(total);
	});
	//------------- If Amount Change ------------------
	$(document).on("change", ".amount", function() {
		var amount =  document.getElementById("amount").value;
		var duration = document.getElementById("duration").value;
		var total  = amount * duration;
		$(".total").val(total);
	});
</script>