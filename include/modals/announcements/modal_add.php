<?php 
echo '
<!-- Add Modal Box -->
<div id="make_announcement" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<input type="hidden" id="id_subject" name="id_subject" value="'.$_GET['id'].'">
			<input type="hidden" id="id_section" name="id_section" value="'.$_GET['section'].'">
			<input type="hidden" id="id_class" name="id_class" value="'.$_GET['class'].'">	
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Announcement</h2>
			</header>
			<div class="panel-body">
				
				<div class="form-group">
					<label class="col-md-3 control-label">Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input class="form-control" name="ann_title" id="ann_title" required title="Must Be Required">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
					<div class="col-md-9">
						<input class="form-control" name="ann_dated" id="ann_dated" required title="Must Be Required" data-plugin-datepicker>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Detail </label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name="ann_detail" id="ann_detail"></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="ann_status" name="ann_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="ann_status" name="ann_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>

			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_announcement" name="submit_announcement">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>