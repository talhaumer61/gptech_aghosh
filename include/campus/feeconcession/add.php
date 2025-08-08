<?php 
if($view == 'add'){
	

//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'add' => '1'))){ 


echo'
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="feeconcession.php?view=add" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Concessoion Detail</h4>
</div>

<div class="panel-body">

<div class="row mt-sm">
	<div class="col-sm-2">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;"> Date <span class="required">*</span></label>
			<input type="date" class="form-control" required title="Must Be Required" name="date" value="'.date("Y-m-d").'" id="date" autocomplete="off"/>
	  	</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Class <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_class" name="id_class" onchange="get_classstudent(this.value)">
				<option value="">Select</option>';
							$sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES." 
																	WHERE class_status = '1' ORDER BY class_id ASC");
							while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
							echo '<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
							}
							echo '
						</select>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Student <span class="required">*</span></label>
			<div id="getclassstudent">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std" name="id_std">
					<option value="">Select</option>
				</select>
			</div>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-3">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Concession Category <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat" id="id_cat">
				<option value="">Select</option>';
					$sqllms	= $dblms->querylms("SELECT cat_id, cat_type, cat_status, cat_name 
													FROM ".SCHOLARSHIP_CAT."
													WHERE cat_id != '' AND cat_status = '1' AND cat_type = '2' 
													AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													ORDER BY cat_name ASC");
					while($rowvalues = mysqli_fetch_array($sqllms)) {
						echo '<option value="'.$rowvalues['cat_id'].'">'.$rowvalues['cat_name'].'</option>';
					}
				echo '
			</select>
	  	</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Authority <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_authority" name="id_authority">
				<option value="">Select</option>';
					foreach($authority as $listauthority) {
						echo '<option value="'.$listauthority['id'].'">'.$listauthority['name'].'</option>';
					}
				echo '
			</select>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Concession Head <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_feecat" name="id_feecat" >
				<option value="">Select</option>';
		$sqllmsheads  = $dblms->querylms("SELECT cat_id, cat_name  
												FROM ".FEE_CATEGORY."
												WHERE cat_status = '1' 
												AND cat_isdiscounted = '1'
												ORDER BY cat_ordering ASC");
			
		while($rowheads = mysqli_fetch_array($sqllmsheads)) {
				echo '<option value="'.$rowheads['cat_id'].'">'.$rowheads['cat_name'].'</option>';
		}
	echo '
		</select>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Amount <span class="required">*</span></label>
			<input type="number" class="form-control" required title="Must Be Required" name="amount" id="amount" autocomplete="off"/>
	  	</div>
	</div>
	
</div>


<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label" style="font-weight:600; color:#333;">Note</label>
			<textarea type="text" class="form-control" name="note" id="note"></textarea>
		</div>
	</div>
</div>

<div class="form-group mt-sm mb-sm">
	<label class="col-sm-2 control-label" style="font-weight:600; color:#333;">Status <span class="required">*</span></label>
	<div class="col-md-5">
		<div class="radio-custom radio-inline">
			<input type="radio" id="status" name="status" value="1" checked>
			<label for="radioExample1">Active</label>
		</div>
		<div class="radio-custom radio-inline">
			<input type="radio" id="status" name="status" value="2">
			<label for="radioExample2">Inactive</label>
		</div>
	</div>
</div>

</div>
<footer class="panel-footer">
	<div class="row">
		<div class="col-md-12 text-right">
			<button type="submit" class="mr-xs btn btn-primary" id="submit_concessionadd" name="submit_concessionadd">Add Record</button>
			<button type="reset" class="btn btn-default">Reset</button>
			<a href="feeconcession.php" class="btn btn-default">Cancel</a>
		</div>
	</div>
</footer>

	<div id="studentconcessions">
	
	</div>
	
</form>
</section>
</div>
</div>
<script type="text/javascript">
// CLASSES
					$(document).on(\'change\', \'#id_std\', function() {
						var IDSTD 	 = $(this).val();
						var idclass  = $(\'#id_class\').val();
						$.ajax({
							url: "include/ajax/get_studentconcessiondetail.php",
							type: \'POST\',
							data: { 
									  idstd: IDSTD 
									, idclass: idclass 
								  },
							success: function(data) {
								$(\'#studentconcessions\').html(data);
							}
						});
					});
</script>';
	
} else{
	header("Location: feeconcession.php");
}

}
