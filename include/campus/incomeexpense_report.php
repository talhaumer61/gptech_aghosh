<?php
echo '
<title>Income & Expense Report | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Income & Expense Report</h2>
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
		<h2 class="panel-title"><i class="fa fa-list"></i>  Income & Expense Report</h2>
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
                        <input type="text" class="form-control" required title="Must Be Required" name="start_date" value="'.$start_date.'">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control" required title="Must Be Required" name="end_date" value="'.$end_date.'">
                    </div>
                </div>
			</div>
		</div>
		<center>
			<button type="submit" name="view_report" id="view_report" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>
';
//-----------------------------------------------
if(isset($_POST['view_report'])){
echo '
<section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
<header class="panel-heading">
	<h2 class="panel-title"> <i class="fa fa-pie-chart"></i> Income & Expense Report from <b>'.$start_date.'</b> to <b>'.$end_date.'</b></h2>
</header>
<div class="panel-body">';
//----------------------Income start--------------------------------
/*$sqllms_fee	= $dblms->querylms("SELECT SUM(total_amount) as paid
								   FROM ".FEES."
								   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND status = '1' AND MONTH(issue_date) = '".$id_month."'
								  ");
$value_fee = mysqli_fetch_array($sqllms_fee);
if($value_fee['paid']){$paid = $value_fee['paid'];}else{$paid = 0;}*/
//------------------------------------------------------
//-----------------------------------------------------
$sqllms_inc	= $dblms->querylms("SELECT t.trans_title, t.trans_amount,
                                h.head_name
                                FROM ".ACCOUNT_TRANS." t
                                INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
								WHERE t.trans_status= '1' AND t.trans_type = '1' AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								AND (t.dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($start_date)))."' AND '".date('Y-m-d' , strtotime(cleanvars($end_date)))."')
								ORDER BY t.trans_id DESC");
//--------------------------income end---------------------------
//----------------------------Expense Start-------------------------
$sqllms_exp	= $dblms->querylms("SELECT t.trans_id, t.trans_title, t.trans_amount, t.voucher_no, t.trans_method, t.dated,
                                h.head_name
                                FROM ".ACCOUNT_TRANS." t
                                INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
								WHERE t.trans_status= '1' AND t.trans_type = '2' AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								AND (t.dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($start_date)))."' AND '".date('Y-m-d' , strtotime(cleanvars($end_date)))."') 
								ORDER BY t.trans_id DESC");
//----------------------------Expense end-------------------------
if(mysqli_num_rows($sqllms_inc) > 0 || mysqli_num_rows($sqllms_exp) > 0){
echo '
	<div id="printResult">
	<div class="invoice mt-md">
		<div class="table-responsive">
		
		<div class="col-md-12 row">
		<div class="row">
			<div class=" col-md-6">
			<table class="table invoice-items">
				<thead>
					<tr class="h5 text-dark">
						<th class="text-center"><b>Income</b></th>
					</tr>
				</thead>
				<tbody>
				<!--  
					<tr style="padding: 5px;">
						<td>
							Total Income of Fee: 
							<b class="pull-right">'.$paid.'</b>
						</td>
					</tr>
					 -->
					';
						
//-----------------------------------------------------
$income = 0;
while($values_inc = mysqli_fetch_array($sqllms_inc)) {
//-----------------------------------------------------
						echo'
						<tr style="padding: 5px;">
							<td>
								'.$values_inc['trans_title'].'
								<b class="pull-right">'.$values_inc['trans_amount'].'</b>
							</td>
						</tr>					
						';
						$income = $income + $values_inc['trans_amount'];
}
						$tot_inc = $paid + $income;
echo'
				</tbody>
			</table>
			<p class="pull-right label label-primary"><b>Total Income: <span style="font-size: 18px;">'.number_format($tot_inc).'</span> Rs</b></p>
			</div>';


		echo'
			<div class=" col-md-6">
			<table class="table invoice-items">
				<thead>
					<tr class="h5 text-dark">
						<th class="text-center">Expenses</th>
					</tr>
				</thead>
				<tbody>
					';
//-----------------------------------------------------
$expense = 0;
while($values_exp = mysqli_fetch_array($sqllms_exp)) {
//-----------------------------------------------------
echo'
					<tr  style="padding: 5px;">
						<td>
							'.$values_exp['trans_title'].'
							<b class="pull-right">'.$values_exp['trans_amount'].'</b>
						</td>
					</tr>';
					$expense = $expense + $values_exp['trans_amount'];
}
echo '
				</tbody>
			</table>
			<p class="pull-right label label-warning"><b>Total Expense: <span style="font-size: 18px;">'.number_format($expense).'</span> Rs</b></p>
			</div>
		</div>
		</div>';
		if($tot_inc > $expense){
			$ans = $tot_inc - $expense;
			echo'<p class="pull-right label label-success"><b style="font-size: 15px;">Profit: <span style="font-size: 25px;">'.number_format($ans).'</span> Rs</b></p>';
		}else{
			$ans = $expense - $tot_inc;
			echo'<p class="pull-right label label-danger"><b style="font-size: 15px;">Loss: <span style="font-size: 25px;">'.number_format($ans).'</span> Rs</b></p>';
		}
			 
			echo'
		</div>
	</div>
	</div>
	<!-- <div class="text-right mr-lg on-screen">
		<button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button>
	</div> -->
	<div class="text-right mr-lg on-screen">
		<a href="campus_finance_prints.php?incexp_from='.$start_date.'&incexp_to='.$end_date.'" target="_blank"><button class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button></a>
	</div>';
}
else{
	echo '<h2 class="center">No Record Found</h2>';
}
echo '
</div>
</section>';
}
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
echo'
</div>
</section>';
?>