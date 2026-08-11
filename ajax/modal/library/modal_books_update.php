
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
			<form action="library/maintain/edit/1" class="form-horizontal" id="form" method="post" accept-charset="utf-8">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Update Content</h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
						<div class="form-group">
							<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
							<div class="col-sm-9"><input type="text" class="form-control" name="name" required title="Must Be Required" value="To Kill a Mockingbird "/></div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Author</label>
							<div class="col-sm-9"><input type="text" class="form-control" name="author" value="Harper Lee"/></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Book ISBN No</label>
							<div class="col-sm-9"><input type="text" class="form-control" name="isbn_no" value=" 0061120081"/></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Book Category <span class="required">*</span></label>
							<div class="col-sm-9">
								<select data-plugin-selectTwo data-plugin-selectTwo data-width="100%" name="book_category" required title="Must Be Required"
								class="form-control populate">
									<option value="">Select A Category</option>
																		<option value="check" >check</option>
																		<option value="Novel" selected>Novel</option>
																		<option value="Shahzad Ahmad" >Shahzad Ahmad</option>
																	</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Publisher <span class="required">*</span></label>
							<div class="col-sm-9"><input type="text" class="form-control" required title="Must Be Required" name="publisher" value="Harper Perennial Modern Classics "/></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Description</label>
							<div class="col-sm-9"><input type="text" class="form-control" name="description" value="The unforgettable novel of a childhood"/></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Price <span class="required">*</span></label>
							<div class="col-sm-9"><input type="number" class="form-control" required title="Must Be Required" name="price" value="0"/></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label"> Total Stock <span class="required">*</span></label>
							<div class="col-sm-9">
								<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0 }'>
									<div class="input-group">
										<input type="text" class="spinner-input form-control" required name="total_stock" value="50" 
										title="Must Be Required" maxlength="3">
										<div class="spinner-buttons input-group-btn">
											<button type="button" class="btn btn-default spinner-up">
												<i class="fa fa-angle-up"></i>
											</button>
											<button type="button" class="btn btn-default spinner-down">
												<i class="fa fa-angle-down"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary">Update</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
			</form>
			</section>
	</div>
</div>
