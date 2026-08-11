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
if($_SESSION['userlogininfo']['LOGINAFOR'] == 2){
//-----------------------------------------------
echo '
<title>Profit Loss Report | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Profit Loss Report</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
if(isset($_POST['start_date'])){$start_date = $_POST['start_date'];}else{$start_date = date('d-m-Y');}
if(isset($_POST['end_date'])){$end_date = $_POST['end_date'];}else{$end_date = date('d-m-Y');}
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i> Profit Loss Report</h2>
	</header>
	<form action="" id="form" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
            <div class="col-md-offset-4 col-md-4">				
                <div class="form-group">
                    <label class=" control-label">Date <span class="required" aria-required="true">*</span></label>
                    <div class="input-daterange input-group" data-plugin-datepicker="" data-plugin-options="{&quot;format&quot;: &quot;dd-mm-yyyy&quot;}">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" required title="Must Be Required" name="start_date" value="'.date('d-m-Y').'">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control" required title="Must Be Required" name="end_date" value="'.date('d-m-Y').'">
                    </div>
                </div>
            </div>
		</div>
		<center>
			<button type="submit" name="view_report" id="view_report" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_report'])){
echo '
<section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
<header class="panel-heading">
	<h2 class="panel-title"> <i class="fa fa-pie-chart"></i> Profit & Loss List From '.date('d M, Y' , strtotime($start_date)).' To '.date('d M, Y' , strtotime($end_date)).'</h2>
</header>
<div class="panel-body">';
//-----------------------------------------------------
$sqllmsReport	= $dblms->querylms("SELECT t.trans_id, t.trans_title, t.trans_type, t.trans_amount, t.voucher_no, t.trans_method, t.dated, h.head_name
									FROM ".ACCOUNT_TRANS." t
									INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
                                    WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                    AND (t.dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($start_date)))."' AND '".date('Y-m-d' , strtotime(cleanvars($end_date)))."')
									ORDER BY t.trans_id ASC");
//-----------------------------------------------------
if(mysqli_num_rows($sqllmsReport) > 0){
echo '
	<div id="printResult">
	<div class="invoice mt-md">
		<div class="table-responsive">
			<table class="table invoice-items">
				<thead>
					<tr class="h5 text-dark">
						<th width="80">#</th>
						<th>Date</th>
						<th>Title</th>
						<th>Voucher ID</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Balance</th>
					</tr>
				</thead>
				<tbody>
					<tr>';
//-----------------------------------------------------
$srno = 0;
//-----------------------------------------------------
while($value_rep = mysqli_fetch_array($sqllmsReport)) {
//-----------------------------------------------------
$srno++;

if($value_rep['trans_type'] == 1){
    $debit = $value_rep['trans_amount'];
    $credit = 0;

} else{
    $debit = 0;
    $credit = $value_rep['trans_amount'];
}
//-----------------------------------------------------
echo '
						<td>'.$srno.'</td>
						<td>'.date('d, M, Y' , strtotime($value_rep['dated'])).'</td>
						<td>'.$value_rep['trans_title'].'</td>
						<td>'.$value_rep['voucher_no'].'</td>
						<td>'.$debit.'</td>
						<td>'.$credit.'</td>
						<td>'.($debit + $credit).'</td>
					</tr>';
}
echo '
				</tbody>
			</table>
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