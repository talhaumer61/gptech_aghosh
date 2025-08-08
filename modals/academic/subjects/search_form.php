<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">	
		<a href="#make_subject" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
			<i class="fa fa-plus-square"></i> Make Subject		</a>
		<h3 class="panel-title">Select Field</h3>
	</header>
	<div class="panel-body">
		<div class="row mb-sm">
			<div class="form-group">
				<center>
					<label class="col-sm-6 col-sm-offset-3 control-label" style="margin-bottom: 5px;">Class</label>
				</center>
				<div class="col-sm-6 col-sm-offset-3">
					<select data-plugin-selectTwo class="form-control populate" id="class_id" style="width: 100%">
						<option value="">Select Class</option>
						<option value="1" >One</option>
					</select>
				</div>
			</div>
		</div>
		<center>
			<a class="mb-xs mt-xs mr-xs btn btn btn-primary" onclick="class_section()"> <i class="fa fa-search"></i> Search </a>
		</center>
	</div>
</section>';