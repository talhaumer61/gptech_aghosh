<style>
.card{
	padding: 20px;
	font-size: 30px;
	border-radius:10px;
	margin-left: 4%;
	margin-right: 4%;
	}
.val{
	font-size: 20px;
	margin-left: 18%;
	}
.span{
	font-size:14px;
	}
</style>
<?php 
if($view == 'bankdeposit') {
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '91', 'view' => '1'))){ 

	//-------------------- Fee Paid -----------------------------
$sqllmspaid	= $dblms->querylms("SELECT SUM(f.amount) as allpaid, 
										SUM(CASE WHEN f.id_dept = '1' then f.amount end) as TotalAGS, 
										SUM(CASE WHEN f.id_dept = '2' then f.amount end) as TotalTEH, 
										SUM(CASE WHEN f.id_bank = '5' then f.amount end) as TotalCash, 
										SUM(CASE WHEN f.id_bank = '5' AND f.id_dept = '1' then f.amount end) as TotalCashAGS, 
										SUM(CASE WHEN f.id_bank = '5' AND f.id_dept = '2' then f.amount end) as TotalCashTEH, 
										SUM(CASE WHEN f.id_bank != '5' then f.amount end) as TotalBank,
										SUM(CASE WHEN f.id_bank != '5' AND f.id_dept = '1' then f.amount end) as TotalBankAGS,
										SUM(CASE WHEN f.id_bank != '5' AND f.id_dept = '2' then f.amount end) as TotalBankTEH
									FROM ".FEES_COLLECTION_BANK_DEPOSIT." f				   
									WHERE f.is_deleted != '1' 
									AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
$value_paid = mysqli_fetch_array($sqllmspaid);
echo '
<div class="row row-sm" style="margin-bottom:10px;">
		<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
		</div>

			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
				<div class="bg-primary rounded overflow-hidden">
				<div class="pd-10 d-flex align-items-center">
					<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
					<div class="mg-l-20">
						<p class="tx-16 tx-bold tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total Amount</p>
						<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">Rs: '.number_format($value_paid['allpaid']).'</p>
						<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['TotalAGS']).' / TEH: '.number_format($value_paid['TotalTEH']).'</p>
					</div>
				</div>
				</div>
			</div>
			<!-- col-3 -->

			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
				<a href="feecollections.php?view=bankdeposit">
					<div class="bg-indigo rounded overflow-hidden">
						<div class="pd-10 d-flex align-items-center">
							<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
							<div class="mg-l-20">
								<p class="tx-16 tx-bold tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Bank Deposited</p>
								<p class="tx-22 tx-white tx-lato tx-bold mg-b-2 lh-1">Rs: '.number_format($value_paid['TotalBank']).'</p>
								<p class="tx-15 tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['TotalBankAGS']).' / TEH: '.number_format($value_paid['TotalBankTEH']).'</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<!-- col-3 -->
			
			
			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
				<div class="bg-success rounded overflow-hidden">
				<div class="pd-10 d-flex align-items-center">
					<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
					<div class="mg-l-20">
						<p class="tx-16 tx-bold tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Cash Payments</p>
						<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">Rs: '.number_format($value_paid['TotalCash']).'</p>
						<p class="tx-15 tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['TotalCashAGS']).' / TEH: '.number_format($value_paid['TotalCashTEH']).'</p>
					</div>
				</div>
				</div>
			</div>
			<!-- col-3 -->
			
		
				
		</div>
		<!-- row -->
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
	<span class="pull-right">';
	
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '91', 'add' => '1'))){ 
			echo'<a href="#make_bankdeposit" class="modal-with-move-anim btn btn-success btn-xs"><i class="fa fa-bank"></i> Add Bank Deposit</a>';
		}
		echo ' <a href="feecollections.php" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Cash Collections</a>
		</span>
		<h2 class="panel-title"><i class="fa fa-list"></i> Bank Desposit</h2>
	</header>
	<div class="panel-body">';
		$filters = 'view=bankdeposit';
		$sql = "SELECT * 
				FROM ".FEES_COLLECTION_BANK_DEPOSIT." 
				WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
				ORDER BY id DESC";

		$sqllms	= $dblms->querylms($sql);
		
		$count = mysqli_num_rows($sqllms);
		if($page == 0) { $page = 1; }				//if no page var is given, default to 1.
		$prev 		    = $page - 1;				//previous page is page - 1
		$next 		    = $page + 1;				//next page is page + 1
		$lastpage  		= ceil($count/$Limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 		    = $lastpage - 1;

		$sqllms	= $dblms->querylms("$sql LIMIT ".($page-1)*$Limit .",$Limit");
		if(mysqli_num_rows($sqllms) > 0){
			echo'
			<div class="table-responsive">
				<table class="table table-bordered table-striped mb-none">
					<thead>
						<tr>
							<th width="80" class="center">Sr #</th>
							<th width="135">Deposit Slip #</th>
							<th>Bank Name</th>
							<th>Description</th>
							<th width="150">Total Amount</th>
							<th width="120" class="center">Date</th>
							<th width="80" class="center">Options</th>
						</tr>
					</thead>
					<tbody>';
						$srno = 0;
						$totalConcessionScholarship = 0;
						$totFine = 0;
						$totRemaining = 0;
						$totPayable = 0;
						while($rowsvalues = mysqli_fetch_array($sqllms)) {
							$srno++;
							$depositDate = '';
							if($rowsvalues['date'] != '0000-00-00'){
								$depositDate = date('d-m-Y', strtotime($rowsvalues['date']));
							}
							echo '
							<tr>
								<td class="center">'.$srno.'</td>
				
								<td>'.$rowsvalues['deposit_slip'].'</td>
								<td>'.get_depositBankAccounts($rowsvalues['id_bank']).'</td>
								<td>'.$rowsvalues['remarks'].'</td>
								<td class="text-right">'.number_format(round($rowsvalues['amount'])).'</td>
								<td class="center">'.$depositDate.'</td>
								<td class="center"><a class="btn btn-info btn-xs mr-xs" class="center" href="bankdeposit.php?recepitid='.$rowsvalues['id'].'" target="_blank"> <i class="fa fa-print"></i></a>
								</td>
							</tr>';
						}
						echo '
					</tbody>
				</table>
			</div>';
			include_once('include/pagination.php');
		}
		else{
			echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
		}
		echo'
	</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
}