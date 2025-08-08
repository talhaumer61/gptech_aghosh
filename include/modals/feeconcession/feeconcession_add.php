<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_feeconcession" class="zoom-anim-dialog modal-block modal-block-primary modal-block-lg mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="feeconcession.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Fee Concession</h2>
			</header>
			<div class="panel-body">

			
			<div class="col-md-4">
				<div class="form-group mb-xs">
					<div class="col-md-12">
						<label class="control-label">Category <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat" onchange="getConcessionCatDetail(this.value)">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT cat_id, cat_type, cat_status, cat_name 
													FROM ".SCHOLARSHIP_CAT."
													WHERE cat_id != '' AND cat_status = '1' AND cat_type = '2' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													ORDER BY cat_name ASC");
								while($rowvalues = mysqli_fetch_array($sqllms)) {
									echo '<option value="'.$rowvalues['cat_id'].'">'.$rowvalues['cat_name'].'</option>';
								}
							echo '
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-xs">
					<div class="col-md-12">
						<label class="control-label">Class <span class="required">*</span></label>
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
			</div>
			<div class="col-md-4">
				<div class="form-group mb-xs">
					<div class="col-md-12">
						<label class="control-label">Student <span class="required">*</span></label>
						<div id="getclassstudent">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std" name="id_std">
								<option value="">Select</option>
							</select>
						</div>
					</div>
				</div>
			</div>';
			//------------------------------------------------
			$sqllmsCats  = $dblms->querylms("SELECT cat_id, cat_name  
												FROM ".FEE_CATEGORY."
												WHERE cat_status = '1' 
												AND cat_id NOT IN(13, 14, 16, 17)
												ORDER BY cat_ordering ASC");
			if(mysqli_num_rows($sqllmsCats) >0) {
				$src = 0;
				while($valCat = mysqli_fetch_array($sqllmsCats)) {
					$src++;
					echo'
					<div class="col-md-4">
						<div class="form-group mt-sm">
							<div class="col-md-12">
								<label class="control-label">'.$valCat['cat_name'].'</label>
								<input type="hidden" name="fee_cat[]" value="'.$valCat['cat_id'].'">
								<input type="number" id="cat_amount" name="cat_amount[]" class="form-control cats"'; if($valCat['cat_id'] == 2){echo'required title="Must Be Required"';} echo'/>
							</div>
						</div>
					</div>';
				}
			}
			//------------------------------------------------
			echo'
			<div style="clear:both;"></div> 
			
			<div class="col-md-12">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label">Total Amount <span class="required">*</span></label>
						<input type="text" id="total_amount" name="total_amount" class="form-control total" required title="Must Be Required" readonly/>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label">Note </label>
						<textarea class="form-control" rows="2" name="note" id="note"></textarea>
					</div>
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
						<button type="submit" class="btn btn-primary" id="submit_feeconcession" name="submit_feeconcession">Save</button>
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
	$(document).on("change", ".cats", function() {
		var sum = 0;
		$(".cats").each(function(){
			sum += +$(this).val();
		});
		$(".total").val(sum);
	});
</script>