<?php 
//-----------------------------------------------
echo '
<title> Fee Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Fee Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">
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
		text-vertical-align: center;
		margin-left: 18%;
		}
	.span{
		font-size:14px;
		}
	</style>';
$month = date('n');
//-----------------------------------------------------
$sqllmstudent  = $dblms->querylms("SELECT std_id, id_class, id_section  
										FROM ".STUDENTS." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
$value_stu = mysqli_fetch_array($sqllmstudent);
//------------------------------------------------------
$sqllmspaid	= $dblms->querylms("SELECT f.status, SUM(f.paid_amount) as paid
								   FROM ".FEES." f
								   WHERE f.status IN (1,4) 
								   AND f.id_std = '".$value_stu['std_id']."'
								   AND f.is_deleted != '1'
								   ");
$value_paid = mysqli_fetch_array($sqllmspaid);
if($value_paid['paid']){$paid = $value_paid['paid'];}else{$paid = 0;}
//------------------------------------------------------
$sqllmspending	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as total, SUM(f.paid_amount) as paid
								   FROM ".FEES." f
								   WHERE f.status IN (2,4)
								   AND f.is_deleted != '1'
								   AND f.id_std = '".$value_stu['std_id']."'
								   ");
$value_pending = mysqli_fetch_array($sqllmspending);
$TotalPending = $value_pending['total'] - $value_pending['paid'];
if($TotalPending){$pending = $TotalPending;}else{$pending = 0;}
//------------------------------------------------------
$sqllmsunpaid	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as unpaid
								   FROM ".FEES." f
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND f.status = '3'
								   AND f.id_std = '".$value_stu['std_id']."'
								   AND f.is_deleted != '1'
								   ");
$value_unpaid = mysqli_fetch_array($sqllmsunpaid);
if($value_unpaid['unpaid']){$unpaid = $value_unpaid['unpaid'];}else{$unpaid = 0;}
//------------------------------------------------------
echo '
<div class="row mt-none mb-md">
	<div class="col-sm-12 col-md-12 col-lg-3 bg bg-success card mb-sm">
		<i class="fa fa-star" aria-hidden="true"></i> Total Paid
		<p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid).'</p>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-3 bg bg-warning card mb-sm">
		<i class="fa fa-refresh" aria-hidden="true"></i> Total Pending
		<p class="val mt-md"><span class="span">Rs:</span> '.number_format($pending).'</p>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-3 bg bg-danger card mb-sm">
		<i class="fa fa-ban" aria-hidden="true"></i> Total Unpaid
		<p class="val mt-md"><span class="span">Rs:</span> '.number_format($unpaid).'</p>
	</div>
</div>
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Challans Payment List / History</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Challan #</th>
		<th>Type</th>
		<th>Session</th>
		<th>Class</th>
		<th>Month</th>
		<th>Issue Date</th>
		<th>Due Date</th>
		<th>Paid Date</th>
		<th>Total Amount</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Print</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.id_type, f.status, f.id_month, f.challan_no, f.issue_date, f.paid_date, f.due_date, f.total_amount, f.paid_amount, c.class_name, cs.section_name, s.session_name
							FROM ".FEES." f		
							INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
							LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section						 
							INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session				
							WHERE f.id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
							AND f.id_std		= '".$value_stu['std_id']."'
							AND f.is_deleted	= '0'
							ORDER BY f.id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
$paidDate = '';
if($rowsvalues['paid_date'] != '0000-00-00'){$paidDate = $rowsvalues['paid_date'];}

if($rowsvalues['status']==1){
	$granTotal = $rowsvalues['paid_amount'];
}elseif(date('Y-m-d') > $rowsvalues['due_date'] && $rowsvalues['status'] != 1) {
	$granTotal = $rowsvalues['total_amount'] + 300;
}else{
	$granTotal = $rowsvalues['total_amount'];
}

if($rowsvalues['id_type']=='2'){
	$id_type = 'Fee';
}elseif($rowsvalues['id_type']=='1'){
	$id_type = 'Admission';
}
//-----------------------------------------------------
echo '
<tr>
<td style="text-align:center;">'.$srno.'</td>
<td>'.$rowsvalues['challan_no'].'</td>
<td>'.$id_type.'</td>
<td>'.$rowsvalues['session_name'].'</td>
<td>'.$rowsvalues['class_name'].' '; if($rowsvalues['section_name']){echo' ('.$rowsvalues['section_name'].') ';} echo'</td>
<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
<td>'.$rowsvalues['issue_date'].'</td>
<td>'.$rowsvalues['due_date'].'</td>
<td>'.$paidDate.'</td>
<td>'.number_format(round($granTotal)).'</td>
<td style="text-align:center;">'.get_payments($rowsvalues['status']).'</td>
<td style="text-align:center;">';
$sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
								FROM ".FEES." f						 
								INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
								WHERE f.id_type		= '2'
								AND f.status		= '2'
								AND f.is_deleted	= '0'
								AND f.id_std		= '".cleanvars($value_stu['std_id'])."'
								AND st.is_deleted	= '0'
								ORDER BY f.id DESC LIMIT 1");
$valuesqllmscheck = mysqli_fetch_array($sqllmscheck);
if($valuesqllmscheck['challan_no'] == $rowsvalues['challan_no'] || $rowsvalues['status']==1 || $rowsvalues['id_type'] == '1'){
	echo'<a class="btn btn-success btn-xs" style="text-align:center;" href="feechallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
}
echo'
</td>
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>
</div>
</div>';
?>
<script type="text/javascript">
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
?>