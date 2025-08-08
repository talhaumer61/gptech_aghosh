<?php 
echo '
<div class="col-md-6">
<form action="#" class="form-horizontal validate" method="post" accept-charset="utf-8">
<div class="panel panel-featured panel-featured-primary">
	<div class="panel-heading">
		<h4 class="panel-title">System Settings</h4>
	</div>
	<div class="panel-body">
		<div class="form-group mt-sm">
			<label  class="col-sm-3 control-label">System Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_name" value="Rudras School Management System ERP">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">System Title</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_title" value="Rudras School">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Phone</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="phone" value="+15452312224">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Address</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="address"  value="New York, United States">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Currency</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="currency" value="USD">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Currency Symbol</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="currency_symbol" value="$">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Footer Text</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="footer_text" value="© 2017 Rudras School Manager v2.5 - Developed by <strong>PVS Systems Ltd.</strong>">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">System Email</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_email" value="admin@shivas.com">
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Academic Session</label>
			<div class="col-sm-9">
				<select name="year_id" class="form-control" data-plugin-selectTwo data-width="100%" data-plugin-options=\'{ "minimumResultsForSearch": -1 }\'>
					<option value="">Select Academic Session</option>
					<option value="1" selected> 2018-2019</option>
					<option value="3" > 2019-2020</option>
					<option value="4" > 2020-2021</option>
					<option value="5" > 2021-2022</option>
					<option value="6" > 2022-2023</option>
					<option value="7" > 2023-2024</option>
					<option value="8" > 2024-2025</option>
					<option value="9" > 2025-2026</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Timezone</label>
			<div class="col-sm-9">
				<select name="timezones" class="form-control populate" id="timezones" data-plugin-selectTwo data-width="100%" required title="Timezone field is required." >
					<option value="Pacific/Midway">(GMT-11:00) Midway Island</option>
					<option value="Asia/Dhaka" selected="selected">(GMT+06:00) Dhaka</option>
					<option value="Asia/Novosibirsk">(GMT+07:00) Novosibirsk</option>
				
				</select>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-3 control-label">Language</label>
			<div class="col-sm-9">
				<select name="language" class="form-control" data-plugin-selectTwo data-width="100%" data-plugin-options=\'{ "minimumResultsForSearch": -1 }\'>
					<option value="english" selected> English </option>
					<option value="bengali" > Bengali </option>
					<option value="arabic" > Arabic </option>
					<option value="german" > German </option>
					<option value="greek" > Greek </option>
					<option value="spanish" > Spanish </option>
					<option value="french" > French </option>
					<option value="hindi" > Hindi </option>
					<option value="hungarian" > Hungarian </option>
					<option value="indonesian" > Indonesian </option>
					<option value="italian" > Italian </option>
					<option value="japanese" > Japanese </option>
					<option value="korean" > Korean </option>
					<option value="latin" > Latin </option>
					<option value="dutch" > Dutch </option>
					<option value="portuguese" > Portuguese </option>
					<option value="russian" > Russian </option>
					<option value="thai" > Thai </option>
					<option value="turkish" > Turkish </option>
					<option value="urdu" > Urdu </option>
					<option value="chinese" > Chinese </option>
				</select>
			</div>
		</div>  
		<div class="form-group mb-md">
			<label  class="col-sm-3 control-label">Online Admission</label>
			<div class="col-sm-9">
				<select name="online_admission" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity">
					<option value="true" selected>Enable</option>
					<option value="false" >Disable</option>
				</select>
			</div>
		</div> 
		<div class="form-group mb-md">
			<label  class="col-sm-3 control-label">Result Publication</label>
			<div class="col-sm-9">
				<select name="result_publication" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity">
					<option value="true" selected>Enable</option>
					<option value="false" >Disable</option>
				</select>
			</div>
		</div> 
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
			 <button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>	
	</footer>
</div>
</form>
</div>';