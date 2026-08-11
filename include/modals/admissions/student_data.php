<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '76', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="student_data" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" autocomplete="off">
	<section class="panel panel-featured panel-featured-primary">
		<form action="studentsdataprint.php" target="_blank" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Class Wise Student Data</h2>
			</header>
			<div class="panel-body">
				
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Class <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="idclass">
					<option value="">-- Select --</option>';
						$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES."
																	WHERE class_status = '1' ORDER BY class_id ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['class_id'].'|'.$valuecls['class_name'].'">'.$valuecls['class_name'].'</option>';
							}
					echo '</select>
				</div>
			</div>

			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_cat" name="submit_cat">Print Data</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>