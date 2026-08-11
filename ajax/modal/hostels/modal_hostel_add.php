<?php 
echo '
<!-- Add Modal Box -->
<div id="make_hostel" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
<section class="panel panel-featured panel-featured-primary">
<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<header class="panel-heading">
<h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Hostel</h2>
</header>
<div class="panel-body">
<div class="form-group mt-sm">
<label class="col-md-3 control-label">Hostel Name <span class="required">*</span></label>
<div class="col-md-9">
<input type="text" class="form-control" name="name" required title="Must Be Required"/>
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label">Hostel Type <span class="required">*</span></label>
<div class="col-md-9">
<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" 
required title="Must Be Required" name="type_id">
<option value="">Select</option>
<option value="1">Boys</option>
<option value="2">Girls</option>
<option value="3">Boyss</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label">Hostel Address <span class="required">*</span></label>
<div class="col-md-9">
<textarea class="form-control" rows="3" name = "hostel_address"></textarea>
</div>
</div>
<div class="form-group">
<label class="col-md-3 control-label">Watchman Name <span class="required">*</span></label>
<div class="col-md-9">
<input type="text" class="form-control" name="watchman_name"/>
</div>
</div>

<div class="form-group mb-md">
<label class="col-md-3 control-label">Description</label>
<div class="col-md-9">
<textarea class="form-control" rows="2" name = "description"></textarea>
</div>
</div>
</div>
<footer class="panel-footer">
<div class="row">
<div class="col-md-12 text-right">
<button type="submit" class="btn btn-primary">Save</button>
<button class="btn btn-default modal-dismiss">Cancel</button>
</div>
</div>
</footer>
</form>
</section>
</div>';