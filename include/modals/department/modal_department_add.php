<?php 
//--------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'add' => '1'))){
//------------------------------------------------
echo '
<!-- Add Modal Box -->
<div id="make_hostel" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="department.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Add Department</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-4 control-label">Department Name <span class="required">*</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="dept_name" id="dept_name" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-4 control-label">Department Code </label>
					<div class="col-md-8">
						<input type="text" class="form-control" name = "dept_code" id="dept_code"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Status <span class="required">*</span></label>
					<div class="col-md-8">
						<div class="radio-custom radio-inline">
							<input type="radio" id="dept_status" name="dept_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="dept_status" name="dept_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_department" name="submit_department">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
//------------------------------------------------
}
?>