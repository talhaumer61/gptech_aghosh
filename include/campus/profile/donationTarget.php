<?php 
$sqllms	= $dblms->querylms("SELECT donation_target, target_date
								FROM ".CAMPUS." a  
								WHERE campus_id = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);

if($rowsvalues['target_date'] != '0000-00-00'){
    $target_date = date('m/d/Y' , strtotime(cleanvars($rowsvalues['target_date'])));
} else {
    $target_date = '';
}

echo '
<div id="target" class="tab-pane">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<fieldset class="mt-lg">
		<div class="form-group">
			<label class="col-sm-3 control-label">Amount <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="number" class="form-control" required name="donation_target" value="'.$rowsvalues['donation_target'].'">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Date From <span class="required">*</span></label>
			<div class="col-md-8">
            <input type="text" class="form-control" name="target_date" id="target_date" value="'.$target_date.'" data-plugin-datepicker required title="Must Be Required"/>
			</div>
		</div>
	</fieldset>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary" name="update_target">Update Target</button>
			</div>
		</div>
	</div>
</form>
</div>';
?>