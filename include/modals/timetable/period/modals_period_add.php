<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '8', 'add' => '1'))){
echo '
<!-- Add Modal Box -->
<div id="make_timetable" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="timetable_period.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Period</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Period Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="period_name" id="period_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Period Time From <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="input-timerange input-group">
							<span class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</span>
							<input type="text" class="form-control valid" name="period_timestart" id="period_timestart" required  data-plugin-timepicker title="Must Be Required" aria-required="true">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" name = "period_timeend" id="period_timeend" required data-plugin-timepicker title="Must Be Required"  aria-required="true">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="period_status" name="period_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="period_status" name="period_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_timetable" name="submit_timetable">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>