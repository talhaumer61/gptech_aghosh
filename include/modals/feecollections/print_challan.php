<?php  
echo '
<!-- Add Modal Box -->
<div id="print_challan" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="feechallanprint.php" target="_blank" class="form-horizontal" id="form" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i> Print Monthly Challan</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mb-md">
					<label class="col-md-2 control-label">Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
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
				<div class="form-group mb-md">
					<label class="col-md-2 control-label">Month <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_month">
							<option value="">Select</option>';
							foreach($monthtypes as $month) {
							echo '<option value="'.$month['id'].'">'.$month['name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>	
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit" name="submit">Print</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>