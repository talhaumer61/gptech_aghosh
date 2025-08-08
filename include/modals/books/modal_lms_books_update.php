<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '40', 'edit' => '1'))){ 
	//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  b.book_id, b.book_status, b.book_code, b.book_name, b.book_author, 
										b.book_isbn, b.id_cat, b.book_publisher, b.book_price, b.book_rackno, 
										b.book_qty, b.book_detail
								   		FROM ".LMS_BOOKS." b  
										WHERE b.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND b.book_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
	//---------------------------------------------------------
	echo '
	<script src="assets/javascripts/user_config/forms_validation.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>
	<div class="row">
	<div class="col-md-12">
	<section class="panel panel-featured panel-featured-primary">
		<form action="lms_books.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<input type="hidden" name="book_id" id="book_id" value="'.cleanvars($_GET['id']).'">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Books</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Book Code	 <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_code" id="book_code" required title="Must Be Required" value="'.$rowsvalues['book_code'].'" />
					</div>
				</div>
				
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Book Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_name" id="book_name" required title="Must Be Required" value="'.$rowsvalues['book_name'].'" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Book Author <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_author" id="book_author" required title="Must Be Required" value="'.$rowsvalues['book_author'].'" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Book isbn <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_isbn" id="book_isbn" required title="Must Be Required" value="'.$rowsvalues['book_isbn'].'" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Book Category <span class="required">*</span></label>
									<div class="col-md-9">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
								<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_name 
														FROM ".LMS_BOOKCATEGORY."
														WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
														ORDER BY cat_name ASC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['cat_id'] == $rowsvalues['id_cat']) { 
								echo '<option value="'.$valuecls['cat_id'].'" selected>'.$valuecls['cat_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
							}
						}
							echo '
							</select>
						</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Publisher <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_publisher" id="book_publisher" required title="Must Be Required" value="'.$rowsvalues['book_publisher'].'" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Price <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_price" id="book_price" required title="Must Be Required" value="'.$rowsvalues['book_price'].'" />
					</div>
				</div>
				
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Rack no. <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_rackno" id="book_rackno" required title="Must Be Required" value="'.$rowsvalues['book_rackno'].'" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Quantity <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="book_qty" id="book_qty" required title="Must Be Required" value="'.$rowsvalues['book_qty'].'" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="book_detail" id="book_detail" required title="Must Be Required">'.$rowsvalues['book_detail'].'</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
						if($rowsvalues['book_status'] == 1) { 
							echo '
								<div class="radio-custom radio-inline">
									<input type="radio" id="book_status" name="book_status" value="1" checked>
									<label for="radioExample1">Active</label>
								</div>';
						} else { 
							echo '
								<div class="radio-custom radio-inline">
									<input type="radio" id="book_status" name="book_status" value="1">
									<label for="radioExample1">Active</label>
								</div>';
						}
						if($rowsvalues['book_status'] == 2) { 
							echo '
								<div class="radio-custom radio-inline">
									<input type="radio" id="book_status" name="book_status" checked value="2">
									<label for="radioExample2">Inactive</label>
								</div>';
						} else { 
							echo '
								<div class="radio-custom radio-inline">
									<input type="radio" id="book_status" name="book_status" value="2">
									<label for="radioExample2">Inactive</label>
								</div>';
						}
				echo '
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="changes_books" name="changes_books">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
	</div>
	</div>';
	//---------------------------------------------------------
}
?>