<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<form action="settings/maintain/change_skin" method="post" accept-charset="utf-8">
	<div class="panel-heading">
		<h4 class="panel-title">Theme Settings</h4>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label" for="zoomcontrol">Background Color</label>
			<select name="skin_colour" class="form-control mb-md" data-plugin-selectTwo data-plugin-options=\'{ "minimumResultsForSearch": -1 }\' onchange="return get_hidden_on_dark(this.value)">
				<option value="light" selected>Light</option>
				<option value="dark" >Dark</option>
			</select>
		</div>
		<div id="hidden-on-dark"  >
			<div class="form-group mb-md">
				<label class="control-label" for="zoomcontrol">Header Color</label>
				<select name="header_colour" class="form-control" data-plugin-selectTwo data-width="100%" data-plugin-options=\'{ "minimumResultsForSearch": -1 }\'>
					<option value="header-light" selected>Light</option>
					<option value="header-dark" >Dark</option>
				</select>
			</div>
			<div class="form-group mb-md">
				<label class="control-label" for="zoomcontrol">Sidebar Color</label>
				<select name="sidebar_colour" class="form-control" data-plugin-selectTwo data-width="100%" data-plugin-options=\'{ "minimumResultsForSearch": -1 }\'>
					<option value="sidebar-light" selected>Light</option>
					<option value="sidebar-dark" >Dark</option>
				</select>
			</div> 
		</div>
		<div class="form-group">
			<label class="control-label" for="zoomcontrol">Borders Style</label>
			<select name="borders_style" class="form-control mb-md" data-plugin-selectTwo data-plugin-options=\'{ "minimumResultsForSearch": -1 }\'>
				<option value="true" selected>Rounded</option>
				<option value="false" >Square</option>
			</select>
		</div>
		<div class="form-group mb-md">
			<label class="control-label" for="zoomcontrol">Sidebar Size</label>
			<select name="sidebar_size" class="form-control mb-md" data-plugin-selectTwo data-width="100%" data-plugin-options=\'{ "minimumResultsForSearch": -1 }\'>
				<option value="sidebar-left-big-icons" selected>Big Icons</option>
				<option value="sidebar-left-xs" >Small</option>
				<option value="sidebar-left-sm" >Medium</option>
				<option value="sidebar-left-md" >Normal</option>
			</select>
		</div>    
	</div>
	<footer class="panel-footer">
		<center><button type="submit" class="btn btn-primary">Update</button></center>
	</footer>
</form> 
</section>';