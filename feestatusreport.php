<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
//-----------------------------------------------
echo '
<title>Fee Report | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Fee Report</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';

//	status
if(isset($_POST['status'])){$status = $_POST['status'];}
//  std_gender
if($_POST['std_gender']){
	$sql1 = "AND s.std_gender = '".$_POST['std_gender']."'";
	$std_gender = $_POST['std_gender'];
}else{
	$sql1 = "";
	$std_gender = "Male & Female";
}
//	is_hostelized
if($_POST['is_hostelized']){
	if($_POST['is_hostelized']==1){
		$sql2 = "AND s.is_hostelized = '1'";
		$is_hostelized = $_POST['is_hostelized'];
		$title = get_studenttype($is_hostelized);
	}else{
		$sql2 = "AND s.is_hostelized != '1'";
		$is_hostelized = $_POST['is_hostelized'];
		$title = get_studenttype($is_hostelized);
	}
}else{
	$sql2 = "";
	$is_hostelized = "";
	$title = "Boarder & Day Scholars";
}

echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Select Report Status</h2>
	</header>
	<form action="feestatusreport.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Status <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="status" name="status" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
						foreach($payments as $payment){
							if($payment['id'] == $status){
								echo'<option value="'.$payment['id'].'" selected>'.$payment['name'].'</option>';
								}else{
									echo'<option value="'.$payment['id'].'">'.$payment['name'].'</option>';
									}
						}
						echo'
						</select>
				</div>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender </label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
					<option value="">Select</option>';
					foreach($gender as $gndr){
						echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
					}
					echo'
				</select>
			</div>
			<div class="col-md-4">
				<label class="control-label">Boarder / Day Scholar</label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_hostelized">
					<option value="">Select</option>';
					foreach($studenttype as $hostel)
					{
						echo' <option value="'.$hostel['id'].'"'; if($is_hostelized == $hostel['id']){ echo'selected';} echo'>'.$hostel['name'].'</option>';
					}
					echo'
				</select>
			</div>
		</div>
		<center>
			<button type="submit" name="view_students" id="view_students" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_students'])){
echo '
<section id="printResult" class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
<header class="panel-heading">
	<h2 class="panel-title"> <i class="fa fa-pie-chart"></i> '.get_payments1($status).' Fee Report - '.$std_gender.' - '.$title.'</h2>
</header>
<div class="panel-body">';
//-----------------------------------------------------
$sqllmsfee	= $dblms->querylms("SELECT f.challan_no, f.total_amount, s.std_name, s.std_gender, s.std_phone, s.std_whatsapp, s.std_rollno, s.std_regno, c.class_name, se.session_name
									FROM ".FEES." f
									INNER JOIN ".STUDENTS." s ON s.std_id = f.id_std
									INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
									INNER JOIN ".SESSIONS." se ON se.session_id = f.id_session
									WHERE f.status = '".$status."' AND f.id_type = '2'
									AND f.is_deleted != '1' AND s.std_status = '1' AND s.is_deleted != '1'
									AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 
									ORDER BY f.id_class ASC");
//-----------------------------------------------------
if(mysqli_num_rows($sqllmsfee) > 0){
echo '
	<div >
	<div class="invoice mt-md">
		<div class="table-responsive">
			<table class="table invoice-items">
				<thead>
					<tr class="h5 text-dark">
						<th width="80">#</th>
						<th>Challan No</th>
						<th>Amount</th>
						<th>Name</th>
						<th>Roll #</th>
						<th>Class</th>
						<th>Session</th>
						<th>Phone</th>
						<th>Whatsapp</th>
					</tr>
				</thead>
				<tbody>
					<tr>';
//-----------------------------------------------------
$srno = 0;
$total_amount = 0;
//-----------------------------------------------------
while($value_fee = mysqli_fetch_array($sqllmsfee)) {
//-----------------------------------------------------
$srno++;
$total_amount = $total_amount + $value_fee['total_amount'];
//-----------------------------------------------------
echo '
						<td>'.$srno.'</td>
						<td>'.$value_fee['challan_no'].'</td>
						<td>'.$value_fee['total_amount'].'</td>
						<td>'.$value_fee['std_name'].'</td>
						<td>'.$value_fee['std_rollno'].'</td>
						<td>'.$value_fee['class_name'].'</td>
						<td>'.$value_fee['session_name'].'</td>
						<td>'.$value_fee['std_phone'].'</td>
						<td>'.$value_fee['std_whatsapp'].'</td>
					</tr>';
}
echo '
				</tbody>
			</table>
		</div>
		<div class="invoice-summary">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-8">
					<table class="table h5 text-dark">
						<tbody>
							<tr class="b-top-none">
								<td colspan="2">'.get_payments1($status).' Amount</td>
								<td class="text-left">Rs. '.$total_amount.'</td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td class="text-left"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
	</div>
	<div class="text-right mr-lg on-screen">
		<button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button>
	</div>';
}
else{
	echo '<h2 class="center">No Record Found</h2>';
}
echo '
</div>
</section>';
}
echo '
</div>
</div>';
?>
<script type="text/javascript">
	function print_report(printResult) {
		var printContents = document.getElementById(printResult).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
	jQuery(document).ready(function($) {	
		var datatable = $('#table_export').dataTable({
			bAutoWidth : false,
			ordering: false,
		});
	});
</script>
<?php 
//------------------------------------
echo '
</section>
</div>
</section>';
//-----------------------------------------------
}
else{
    header("Location: dashboard.php");
}
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>