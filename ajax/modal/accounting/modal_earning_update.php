
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
			<form action="accounting/earning/edit/6" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Voucher				</h4>
			</div>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-sm-3 control-label">
						Title <span class="required">*</span>
					</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" name="name" value="Book" autofocus required title="Must Be Required">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">
						Category <span class="required">*</span>
					</label>
					<div class="col-sm-9">
						<select name="balance_category_id" class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity"
						title="Must Be Required">
							<option value="">Select Costing Category</option>
														<option value="2" selected> Bourse</option>
														<option value="6" > bla bla</option>
													</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">
						Amount <span class="required">*</span>
					</label>

					<div class="col-sm-9">
						<input type="number" class="form-control" name="amount" value="200" required title="Must Be Required">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">
						Note					</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" name="description" value="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">
						Voucher ID <span class="required">*</span>
					</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" name="voucherID" value="2017" required title="Must Be Required">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">
						Method					</label>
					<div class="col-sm-9">
						<div class="radio-custom radio-primary radio-inline">
							<input type="radio" value="1" id="radiocash" name="method" checked>
							<label for="radiocash">Cash</label>
						</div>
						<div class="radio-custom radio-primary radio-inline">
							<input type="radio" value="2" id="radiocheck" name="method" >
							<label for="radiocheck">Check</label>
						</div>
					</div>
				</div>

				<div class="form-group mb-sm">
					<label class="col-sm-3 control-label">
						Transaction Date <span class="required">*</span>
					</label>

					<div class="col-sm-9">
						<input type="text" value="30 Sep,2017" class="form-control" data-plugin-datepicker 
						data-plugin-options='{ "todayHighlight" : true }' name="timestamp" required title="Must Be Required"/>
					</div>
					</div>
			</div>
			<footer class="panel-footer">
				<div class="text-right">
					<button type="submit" class="btn btn-primary">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</footer>
			</form>		</section>
		 
	</div>
</div>