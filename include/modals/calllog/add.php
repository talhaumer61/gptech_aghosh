<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '37', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_call" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="call_log.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Call</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="name" id="name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "phone" id="phone">
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="dated" id="dated"  data-plugin-datepicker required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Detail  <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "detail" id="detail">
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Followup Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="next_followupdate" id="next_followupdate"  data-plugin-datepicker required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Duration <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "duration" id="duration">
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Note<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="note" id="note" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Call Type	 <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="call_type">
					  		<option value="">Select</option>
					  		<option value="1">Incoming</option>
					  		<option value="2">Out Going</option>
					   </select>
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
						<button type="submit" class="btn btn-primary" id="submit_call" name="submit_call">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>