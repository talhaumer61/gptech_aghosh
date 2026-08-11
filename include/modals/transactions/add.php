	<?php 
echo '
<!-- Add Modal Box -->
<div id="make_voucher" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Voucher</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="trans_name" id="trans_name" required title="Must Be Required"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Category <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="trans_cat">
							<option value="">Select</option>';
						foreach($transtype as $listtype) { 
							echo '<option value="'.$listtype['id'].'">'.$listtype['name'].'</option>';
						}
						echo '
						</select>
					</div>
				</div>
				
				

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Amount <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "trans_amount" id="trans_amount" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Note </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "trans_note" id="trans_note"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Voucher ID <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "voucher_no" id="voucher_no" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text"  data-plugin-datepicker class="form-control" name="dated" id="dated" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Method <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="trans_method" name="trans_method" value="1" checked>
							<label for="radioExample1">Cash</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="trans_method" name="trans_method" value="2">
							<label for="radioExample2">Check</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="trans_method" name="trans_method" value="3">
							<label for="radioExample2">Online</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_transaction" name="submit_transaction">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';