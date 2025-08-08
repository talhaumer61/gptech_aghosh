<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'add' => '1'))){
echo '
<!-- Add Modal Box -->
<div id="make_visitor" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="visitors.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Visitor</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Purpose Type<span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_purpose">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT purpose_id, purpose_name 
													FROM ".VISITOR_PURPOSES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY purpose_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['purpose_id'].'">'.$valuecls['purpose_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Card No <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "card_no" id="card_no" required title="Must Be Required" >
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="name" id="name" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "phone" id="phone" required title="Must Be Required" >
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Email <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="email" id="email" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">CNIC <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "cnic" id="cnic" required title="Must Be Required" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Num Of Person <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "num_of_person" id="num_of_person" required title="Must Be Required" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name="dated" id="dated" data-plugin-datepicker required title="Must Be Required" />
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Visit Time from  <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="input-timerange input-group">
							<span class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</span>
							<input type="text" class="form-control valid" name="time_in" id="time_in" required  data-plugin-timepicker title="Must Be Required" aria-required="true">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" name="time_out" id="time_out" required data-plugin-timepicker title="Must Be Required"  aria-required="true">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Note<span class="required">*</span></label>
					<div class="col-md-9">
						<textarea type = "text" class="form-control"  name= "note" id="note"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">status <span class="required">*</span></label>
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
						<button type="submit" class="btn btn-primary" id="submit_visitor" name="submit_visitor">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}