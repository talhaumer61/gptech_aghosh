<?php
error_reporting(0);
echo'
<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title">
					Select Field				</h2>
			</header>
			<div class="panel-body">
				<div class="row mb-lg">
					<div class="col-md-6 col-sm-offset-3">
						<div class="form-group">
							<center>
								<label class="control-label">
									Date <span class="required">*</span>
								</label>
							</center>
							<div class="input-group">
							    <input type="text" class="form-control" required title="Must Be Required" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true , "format": "dd-mm-yyyy"}\' name="timestamp"
								 value=""/>
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-offset-4">
					<button type="submit" class="btn btn-primary" id="submit_attendance" name="submit_attendance">
						<i class="fa fa-search"></i> Mark Attendance					</button>
			
					<button type="submit" class="btn btn-primary" id="edit_attendce" name="edit_attendce">
						<i class="glyphicon glyphicon-edit"></i> Edit Attendance					</button>
                          </div>
			
			</div>
				</section>
';
?>