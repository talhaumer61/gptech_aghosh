<?php  
echo '
<!-- Add Modal Box -->
<div id="report_challan" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="feechallanGenrationReportPrint.php" target="_blank" class="form-horizontal" id="form" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-file"></i> Challan Generation Report</h2>
			</header>
			<div class="panel-body">	
				<div class="form-group mb-md">
					<label class="col-md-2 control-label">Month <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="month" class="form-control" name="yearmonth" id="yearmonth" value="" required title="Must Be Required"/>
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