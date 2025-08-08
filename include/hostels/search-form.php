<?php 
echo '
<form id="search" method="post">
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<a href="hostels/student_add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Add Students</a>
		<h2 class="panel-title">Select Field</h2>
	</header>
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Hostel Name <span class="required">*</span></label>
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" onchange="get_hostel_room(this.value)" name="hostel_id" id="hostel_id">
						<option value=""> Select </option>
						<option value="1" selected> Sample Hostel </option>
						<option value="2"> Victory </option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Room Name <span class="required">*</span></label>
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="hostel_room_id" id="room_id_holder">
						<option value="1" selected> Sample Room </option>
					</select>
				</div>
			</div>
		</div>
		<center>
			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
		</center>
	</div>
</section>
</form>';