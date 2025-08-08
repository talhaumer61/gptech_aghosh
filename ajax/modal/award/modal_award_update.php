<script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/user_config/forms_validation.js"></script><script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
		<form action="http://pvssystem.com/rudras_school_demo/student/award/update/8" class="validate form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Award</h2>
			</header>
				<div class="panel-body">
					<div class="form-group mt-sm">
						<label class="col-md-3 control-label">Award Name <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="award_name" value="Champion Trophy" required title="Must Be Required"/>
						</div>
					</div>
					
					<div class="form-group mt-sm">
						<label class="col-md-3 control-label">Gift Item <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="gift_item" value="Trophy" required title="Must Be Required"/>
						</div>
					</div>
					
					<div class="form-group mt-sm">
						<label class="col-md-3 control-label">Cash Price</label>
						<div class="col-md-9">
							<input type="number" class="form-control" name="cash_price" value="60" />
						</div>
					</div>
					
					<div class="form-group mt-sm">
						<label class="col-md-3 control-label">Award Reason <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="award_reason" value="Sports champion" required title="Must Be Required"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Class <span class="required">*</span></label>
						<div class="col-md-9">
							<select name="class_id" class='form-control mb-sm' id='section_id' required title='Value Required' data-plugin-selectTwo
								data-width='100%' data-minimum-results-for-search='Infinity' onchange='get_student(this.value)' >
<option value="1" selected="selected">One</option>
</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">
							Student Name <span class="required">*</span>
						</label>
						<div class="col-md-9">
							<select name="user_id" class="form-control" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" id="user_name_holder" required
							title="Must Be Required">
								<optgroup label="Section (A)"><option value="1"selected>Cherri Portnoy</option><option value="2">Rudyard Maddox</option><option value="3">Sweet Mondal</option><option value="4">Blake Estes</option><option value="5">Carter Bradford</option><option value="7">Shimul Roy</option><option value="8">Joseph Chadwick</option>							</select>
						</div>
					</div>

					<div class="form-group mb-md">
						<label class="col-md-3 control-label">Given Date <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' name="given_date" value="30-Aug-2017" required
							title="Must Be Required"/>
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

<script type="text/javascript">
	function get_student( class_id ) {
		$.ajax( {
			url: 'http://pvssystem.com/rudras_school_demo/student/get_students_award/' + class_id,
			success: function ( response ) {
				jQuery( '#user_name_holder' ).html( response );
			}
		} );
	}
</script>