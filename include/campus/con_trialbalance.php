<?php
echo '
<title>Trial Balance Sheet | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Trial Balance Sheet</h2>
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
		<h2 class="panel-title"><i class="fa fa-list"></i>  Trial Balance Sheet</h2>
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
	<h2 class="panel-title"> <i class="fa fa-pie-chart"></i> Concise Trial Balance Sheet from <b>'.$start_date.'</b> to <b>'.$end_date.'</b></h2>
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
$sqllms_head	= $dblms->querylms("SELECT head_id, head_name
                                FROM ".ACCOUNT_HEADS."
								WHERE head_status= '1' AND is_deleted != '1' 
								AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								ORDER BY head_id ASC");
//------------------------------------------------------
if(mysqli_num_rows($sqllms_head) > 0){
//------------------------------------------------------
echo '
	<div id="printResult">
	<div class="invoice mt-md">
		<div class="table-responsive">
		
    <div class="col-md-12">
        <table class="table invoice-items">
            <thead>
                <tr class="h5 text-dark">
                    <th>Particulars</th>
                    <th width=200>Debit</th>
                    <th width=200>Credit</th>
                </tr>
            </thead>
            <tbody>';
			$debit = 0;
            $credit = 0;
		//-----------------------------------------------------
        while($values_heads = mysqli_fetch_array($sqllms_head)){
        //------------------------------------------------------
            $sqllms_trans	= $dblms->querylms("SELECT trans_title, SUM(trans_amount) as amount, trans_type, dated
                                FROM ".ACCOUNT_TRANS."
								WHERE trans_status= '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND id_head = '".$values_heads['head_id']."'
								AND (dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($start_date)))."' AND '".date('Y-m-d' , strtotime(cleanvars($end_date)))."')
                                ORDER BY trans_id DESC");
            //-----------------------------------------------------
            
            //-----------------------------------------------------
			$values_trans = mysqli_fetch_array($sqllms_trans);
			//-----------------------------------------------------
			if ($values_trans['amount'] > 0){
				echo'
				<tr style="padding: 5px;">
					<td>';
					if($values_trans['trans_type'] == '1'){
						echo'Recivable: '.$values_heads['head_name'].' ';
					}
					elseif($values_trans['trans_type'] == '2'){
						echo'Payable: '.$values_heads['head_name'].' ';
					}
					echo'
					</td>';
					if($values_trans['trans_type'] == '1'){
						echo'
						<td>
							<b>'.number_format($values_trans['amount']).'</b>
						</td>
						<td>0</td>';
						$debit = $debit + $values_trans['amount'];
					}
					elseif($values_trans['trans_type'] == '2'){
						echo'
						<td>0</td>
						<td>
							<b>'.number_format($values_trans['amount']).'</b>
						</td>';
						$credit = $credit + $values_trans['amount'];
					}
					else{
						echo'<td></td>';
					}
					echo'
				</tr>';
			}
		}
			echo'
				<tr>
					<th class="text-center">Totals</th>
					<td><p class="pull-left label label-success"><b>Total Debit: <span style="font-size: 18px;">'.number_format($debit).'</span> Rs</b></p></td>
					<td><p class="pull-left label label-danger"><b>Total Credit: <span style="font-size: 18px;">'.number_format($credit).'</span> Rs</b></p></td>
				</tr>
            </tbody>
        </table>
    </div>
	</div>
	</div>
	</div>
	<!-- <div class="text-right mr-lg on-screen">
		<button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button>
	</div> -->
	<div class="text-right mr-lg on-screen">
		<a href="campus_finance_prints.php?con_trailbal_from='.$start_date.'&con_trailbal_to='.$end_date.'" target="_blank"><button class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button></a>
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