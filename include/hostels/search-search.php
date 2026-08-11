<?php 
echo '
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-user-circle" aria-hidden="true"></i> Student List</h2>
</header>
<div class="panel-body">
<div class="table-responsive mt-sm mb-md">
<table class="table table-bordered table-striped table-condensed mb-none" id="multi-form">
<thead>
	<tr>
		<th width="50px">#</th>
		<th>Student Name</th>
		<th>Roll</th>
		<th>Class</th>
		<th>Hostel Name</th>
		<th>Hostel Type</th>
		<th>Room Name</th>
		<th>Hostel Fee</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
<tr>
	<td> 1</td>
	<td>Cherri Portnoy</td>
	<td>101</td>
	<td>One</td>
	<td> Sample Hostel </td>
	<td>Boys</td>
	<td> Sample Room </td>
	<td>$ 100 </td>
	<td>
<!-- HOSTEL UPDATE LINK -->
		<a href="#edit_1" class="modal-with-move-anim-pvs btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<div id="edit_1" class="mfp-with-anim modal-block modal-block-primary mfp-hide">
			<section class="panel panel-featured panel-featured-primary">
				<form action="#" class="form-horizontal mb-lg" id="form" method="post" accept-charset="utf-8">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Transfer User</h4>
					</div>
					<div class="panel-body">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="control-label">Hostel Name <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" onchange="get_hostel_room(this.value)" name="hostel_id">
									<option value=""> Select </option>
									<option value="1"  selected> Sample Hostel </option>
									<option value="2"  > Victory </option>
								</select>
							</div>
						</div>
						<div class="col-md-12 mb-lg">
							<div class="form-group">
								<label class="control-label">Room Name <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="hostel_room_id" id="room_id_holder">
									<option value="1"  selected> Sample Room </option>
								</select>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Update</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</footer>
				</form>
			</section>
		</div>
<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels/user/delete/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
<tr>
	<td> 2</td>
	<td>Cherri Portnoy</td>
	<td>101</td>
	<td>One</td>
	<td> Sample Hostel </td>
	<td>Boys</td>
	<td> Sample Room </td>
	<td>$ 100 </td>
	<td>
<!-- HOSTEL UPDATE LINK -->
		<a href="#edit_2" class="modal-with-move-anim-pvs btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<div id="edit_2" class="mfp-with-anim modal-block modal-block-primary mfp-hide">
			<section class="panel panel-featured panel-featured-primary">
				<form action="#" class="form-horizontal mb-lg" id="form" method="post" accept-charset="utf-8">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Transfer User</h4>
					</div>
					<div class="panel-body">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="control-label">Hostel Name <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" onchange="get_hostel_room(this.value)" name="hostel_id">
									<option value=""> Select </option>
									<option value="1"  selected> Sample Hostel </option>
									<option value="2"  > Victory </option>
								</select>
							</div>
						</div>
						<div class="col-md-12 mb-lg">
							<div class="form-group">
								<label class="control-label">Room Name <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="hostel_room_id" id="room_id_holder">
									<option value="1"  selected> Sample Room </option>
								</select>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Update</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</footer>
				</form>
			</section>
		</div>
<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels/user/delete/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
<tr>
	<td> 3</td>
	<td>Cherri Portnoy</td>
	<td>101</td>
	<td>One</td>
	<td> Sample Hostel </td>
	<td>Boys</td>
	<td> Sample Room </td>
	<td>$ 100 </td>
	<td>
<!-- HOSTEL UPDATE LINK -->
		<a href="#edit_3" class="modal-with-move-anim-pvs btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<div id="edit_3" class="mfp-with-anim modal-block modal-block-primary mfp-hide">
			<section class="panel panel-featured panel-featured-primary">
				<form action="#" class="form-horizontal mb-lg" id="form" method="post" accept-charset="utf-8">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Transfer User</h4>
					</div>
					<div class="panel-body">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="control-label">Hostel Name <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" onchange="get_hostel_room(this.value)" name="hostel_id">
									<option value=""> Select </option>
									<option value="1"  selected> Sample Hostel </option>
									<option value="2"  > Victory </option>
								</select>
							</div>
						</div>
						<div class="col-md-12 mb-lg">
							<div class="form-group">
								<label class="control-label">Room Name <span class="required">*</span></label>
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="hostel_room_id" id="room_id_holder">
									<option value="1"  selected> Sample Room </option>
								</select>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Update</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</footer>
				</form>
			</section>
		</div>
<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'hostels/user/delete/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
</tbody>
</table>
</div>
</div>
</section>';