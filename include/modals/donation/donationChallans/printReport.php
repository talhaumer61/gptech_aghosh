<?php  
echo '
<!-- Add Modal Box -->
<div id="printReport" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="donationReportPrint.php" target="_blank" class="form-horizontal" id="form" method="GET" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-print"></i> Print Donation Report</h2>
			</header>
			<div class="panel-body">	
				<div class="form-group mb-md">
					<label class="col-md-2 control-label">Month <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_month">
							<option value="">Select</option>
							<option value="0">All</option>';
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
						<button type="submit" class="btn btn-primary">Print</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>