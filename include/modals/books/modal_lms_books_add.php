<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '40', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_books" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="lms_books.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Add Books</h2>
			</header>
			<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Book Code	 <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_code" id="book_code" required title="Must Be Required" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Book Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_name" id="book_name" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Author <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_author" id="book_author" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">isbn <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_isbn" id="book_isbn" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Category <span class="required">*</span></label>
				<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_name 
													FROM ".LMS_BOOKCATEGORY."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY cat_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
							}
						echo '
						</select>
					</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Publisher <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_publisher" id="book_publisher" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Price <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_price" id="book_price" required title="Must Be Required" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Rack no. <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_rackno" id="book_rackno" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Quantity <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="book_qty" id="book_qty" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Details <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="book_detail" id="book_detail" required title="Must Be Required"></textarea>
				</div>
			</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="book_status" name="book_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="book_status" name="book_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_books" name="submit_books">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>
