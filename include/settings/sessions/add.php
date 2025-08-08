<?php 
echo '
<div class="col-md-5">
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title">Add Session Year</h2>
		</header>
		<div class="panel-body">
			<form role="form" action="sessions/maintain/add" method="post" class="validate">
				<div class="form-group ">
					<label class="control-label">
						Sessions <span class="required">*</span>
					</label>
					<input type="text" class="form-control" placeholder="Exampe : 2017-2018" name="sessionyear" required value="" title="Must Be Required" autofocus />
				</div>
				<div class="form-group">
					<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-plus-square"></i> Add Year</button>
				</div>
			</form>
		</div>
	</section>
</div>';