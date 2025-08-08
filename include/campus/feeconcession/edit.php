<?php 
if($view == 'edit' && $idstd){
	

//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'edit' => '1'))){ 

// Get all Student Concessions
	$conditions = array ( 
								  'select' 		=> 'SUM(s.amount) AS TotalConcess, st.std_id, st.std_name, st.std_fathername, st.std_regno,
								  					st.id_class, cl.class_name, se.session_id, se.session_name, fs.id AS idsetup'
								, 'join' 		=> "INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std 
													INNER JOIN ".CLASSES." cl ON cl.class_id = s.id_class 
													INNER JOIN ".SCHOLARSHIP_CAT." c ON c.cat_id = s.id_cat  
													INNER JOIN ".FEE_CATEGORY." fc ON fc.cat_id = s.id_feecat  
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session 
													INNER JOIN ".FEESETUP." fs ON st.id_class = fs.id_class AND fs.id_session = st.id_session"
								, 'where' 		=> array( 
															  'st.id_campus' => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 'fs.id_campus' => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 's.id_std' 	 => $idstd 
															, 's.id_session' => $_SESSION['userlogininfo']['ACADEMICSESSION']
															, 's.is_deleted' => 0 
															, 'fs.is_deleted' => 0 
															, 'fs.status' 	=> 1
														) 
								, 'limit' 		=> 1
								, 'return_type' => 'single' 
							); 
	$rowsvalues 	= $dblms->getRows(SCHOLARSHIP.' s ', $conditions);
// -----------------

 //Check Student Hostel Registration
	$sqllmHostelRegistration	= $dblms->querylms("SELECT id 
														FROM ".HOSTEL_REG."
														WHERE status    = '1' 
														AND id_std      = '".$rowsvalues['std_id']."'
														AND id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
														LIMIT 1");
//If Hostelized Add Fee Cats
	if(mysqli_num_rows($sqllmHostelRegistration) == 1) {
		$hostel_cats = ""; 
	} else{
		$hostel_cats = ",6,7,8"; 
	}
// Total Pkg                                           
	$sqllmsTotPkg	= $dblms->querylms("SELECT	SUM(d.amount) as totalPkg
												FROM ".FEESETUPDETAIL." d
												WHERE id_setup = '".$rowsvalues['idsetup']."'
												AND (duration != 'Select' OR duration = '') 
												AND duration = 'Monthly'
												AND id_cat NOT IN (1,4,5$hostel_cats) ");
	$valTotPkg = mysqli_fetch_array($sqllmsTotPkg);
// Get all Student Concessions
	$consconditions = array ( 
								  'select' 		=> 's.*, st.std_id, st.std_name, st.std_fathername, st.std_regno,
								 					c.cat_name, fc.cat_name as Feehead, st.id_class, cl.class_name, se.session_id, se.session_name'
								, 'join' 		=> "INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std 
													INNER JOIN ".CLASSES." cl ON cl.class_id = s.id_class  
													INNER JOIN ".SCHOLARSHIP_CAT." c ON c.cat_id = s.id_cat 
													INNER JOIN ".FEE_CATEGORY." fc ON fc.cat_id = s.id_feecat  
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session"
								, 'where' 		=> array( 
															  's.id_campus' => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 's.id_std' 	 => $idstd 
															, 's.id_session' => $_SESSION['userlogininfo']['ACADEMICSESSION']
															, 's.is_deleted' => 0 
														) 
								, 'order_by' 	=> ' s.date DESC '
								, 'return_type' => 'all' 
							); 
	$concessions 	= $dblms->getRows(SCHOLARSHIP.' s ', $consconditions);

echo'
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="feeconcession.php?view=edit" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" id="id_class" name="id_class" value="'.$rowsvalues['id_class'].'">
<input type="hidden" id="id_std" name="id_std" value="'.$rowsvalues['std_id'].'">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i>  Concessoion Detail
	<a href="feeconcession.php" class="btn btn-sm btn-default" style="float:right;">Cancel</a>
	</h4>
	
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
			<input type="text" class="form-control" required name="class_name" id="class_name" value="'.$rowsvalues['class_name'].'" readonly/>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group">
			<label class="control-label" style="font-weight:600;color:#333;">Student <span class="required">*</span></label>
			<input type="text" class="form-control" required name="std_name" id="std_name" value="'.$rowsvalues['std_name'].' ('.$rowsvalues['std_regno'].')" readonly/>
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
												AND cat_id NOT IN (0$hostel_cats) 
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
<div class="panel-body">
	<div class="table-responsive">
	<div id="studentconcessions">
	<table class="table table-bordered mt-md nowrap" >
			<thead>
				<tr>
					<th class="text-center" style="width:70px;">Sr #</th>
					<th style="width:100px;">Date</th>
					<th>Concession Category</th>
					<th>Concession head</th>
					<th>Authority </th>
					<th style="width:100px;">Amount</th>
					<th style="width:70px;">Status</th>
					<th style="width:100px;" class="center">Options</th>
				</tr>
			</thead>
			<tbody>';
	$totalcons = 0;
	$srno = 0;
	foreach($concessions as $listconcess) :
	$srno++;
		echo '
				<tr>
					<td class="text-center">'.$srno.'</td>
					<td>'.$listconcess['date'].'</td>
					<td>'.$listconcess['cat_name'].'</td>
					<td>'.$listconcess['Feehead'].'</td>
					<td>'.get_authority($listconcess['id_authority']).'</td>
					<td class="text-right">'.number_format($listconcess['amount']).'</td>
					<td class="text-center">'.get_status($listconcess['status']).'</td>
					<td class="text-center">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'edit' => '1'))){ 
						echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-success btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/feeconcession/update.php?id='.$listconcess['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'deleted' => '1'))){ 
						echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'feeconcession.php?deleteid='.$listconcess['id'].'\');"><i class="el el-trash"></i></a>';
					}
				echo '
						</td>
				</tr>';
	$totalcons = ($totalcons + $listconcess['amount']);
	endforeach;
	echo '
			</tbody>
			<tfoot>
				<tr>
					<td class="text-right" colspan="5"><b style="font-size:14px;">Actual Fee</b></td>
					<td class="text-right" colspan="3">
						<input type="text" id="netGrandTotal" class="form-control" name="net_grand_total" style="color:#00f; font-weight:600; font-size:16px;" value="'.number_format($valTotPkg['totalPkg']).'" readonly />
					</td>
					
				</tr>
				<tr>
					<td class="text-right" colspan="5"><b style="font-size:14px;">Total Concession Granted </b></td>
					<td class="text-right" colspan="3">
						<input type="text" id="netGrandTotal" class="form-control" name="net_grand_total" style="color:green; font-weight:600; font-size:16px;"  value="'.number_format($totalcons).'" readonly />
					</td>
				
				</tr>
				
				<tr>
					<td class="text-right" colspan="5"><b style="font-size:14px;">Monthly Fee  </b></td>
					<td class="text-right" colspan="3">
						<input type="text" id="netGrandTotal" class="form-control" name="net_grand_total" style="color:#f00; font-weight:600; font-size:16px;" value="'.number_format($valTotPkg['totalPkg']-$rowsvalues['TotalConcess']).'" readonly />
					</td>
				</tr>
				
			</tfoot>
		</table>
	</div>
	</div>
</div>
</form>
</section>
</div>
</div>';
	
} else{
	header("Location: feeconcession.php");
}

}
