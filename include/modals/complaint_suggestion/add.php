<?php
//------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT adm_logintype, adm_fullname, adm_phone FROM ".ADMINS." WHERE adm_id = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' ");
$adm_value = mysqli_fetch_array($sqllms); 
//------------------------------------------------------
echo'
<!-- Add Modal Box -->
<div id="make_complaint" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="complaint_suggestion.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Add Complaint or Suggestion</h2>
			</header>
			<div class="panel-body">

				<input type="hidden" name="complaint_by" value="'.$adm_value['adm_logintype'].'">

				<input type="hidden" name="id_complaint_by" value="'.$_SESSION['userlogininfo']['LOGINIDA'].'">
				
				<input type="hidden" name="name" value="'.$adm_value['adm_fullname'].'">

				<input type="hidden" name="phone" value="'.$adm_value['adm_phone'].'">
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type" id="id_type" required>
							<option>Select</option>
							<option value="1">Complaint</option>
							<option value="2">Suggestion</option>
						</select>
					</div>
				</div>
			
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="title" id="title" required/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Assign To <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="assign_to" id="assign_to" required>
							<option>Select</option>
							<option value="1">Head Office</option>
							<option value="2">Relevaint Campus</option>
						</select>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="detail" id="detail" required></textarea>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_complaint" name="submit_complaint">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>