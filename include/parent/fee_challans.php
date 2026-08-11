<?php 
$sqllmstudent  = $dblms->querylms("SELECT std_id, std_name, id_class, id_section  
										FROM ".STUDENTS." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND   std_id	= '".cleanvars($_GET['std'])."' LIMIT 1");
$value_stu = mysqli_fetch_array($sqllmstudent);
echo '
<title> Fee Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header" style="display:flex; align-items:center; justify-content:space-between;">
		<h2>Fee Panel</h2>
		<span style="font-weight:bold; color:#cb3f44; margin-right:5px;">( '.$value_stu['std_name'].' )</span>
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
			
			$sqllmspaid	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as paid
											FROM ".FEES." f
											WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
											AND f.status = '1' AND f.is_deleted !='1' AND f.id_std = '".$value_stu['std_id']."'");
			$value_paid = mysqli_fetch_array($sqllmspaid);
			if($value_paid['paid']){$paid = $value_paid['paid'];}else{$paid = 0;}

			$sqllmspending	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as pending
											FROM ".FEES." f
											WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
											AND f.status = '2' AND f.is_deleted !='1' AND f.id_std = '".$value_stu['std_id']."'");
			$value_pending = mysqli_fetch_array($sqllmspending);
			if($value_pending['pending']){$pending = $value_pending['pending'];}else{$pending = 0;}

			echo '
			<div class="row mt-none mb-md">
				<div class="col-sm-12 col-md-12 col-lg-3 bg bg-primary card mb-sm" style="font-size:22px; font-weight:bold;">
					<i class="fa fa-star" aria-hidden="true"></i> Total Amount
					<p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid+$pending).'</p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-3 bg bg-success card mb-sm" style="font-size:22px; font-weight:bold;">
					<i class="fa fa-check" aria-hidden="true"></i> Paid Amount
					<p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid).'</p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-3 bg bg-danger card mb-sm" style="font-size:22px; font-weight:bold;">
					<i class="fa fa-refresh" aria-hidden="true"></i> Pending Amount
					<p class="val mt-md"><span class="span">Rs:</span> '.number_format($pending).'</p>
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
								<th>Student</th>
								<th>Father</th>
								<th>Class</th>
								<th>Session</th>
								<th>Month</th>
								<th>Issue Date</th>
								<th>Due Date</th>
								<th>Total Amount</th>
								<th>Fine</th>
								<th>Payable</th>
								<th width="70px;" style="text-align:center;">Status</th>
								<th width="100" style="text-align:center;">Print</th>
							</tr>
						</thead>
						<tbody>';

							$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.challan_no, f.issue_date, f.due_date, f.total_amount, st.std_name, st.std_fathername, f.id_month, c.class_name, cs.section_name, s.session_name
														FROM ".FEES." f	
														INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
															LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
															INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session									 
														INNER JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std
														WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
														AND f.id_std = '".$value_stu['std_id']."'
														AND f.is_deleted != '1'
														ORDER BY f.id DESC");
							$srno = 0;

							while($rowsvalues = mysqli_fetch_array($sqllms)) {
								// Scholarship 
								$sql_scholarship	= $dblms->querylms("SELECT SUM(percent) as scholarship
																FROM ".SCHOLARSHIP." 
																WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
																AND   id_type = '1' AND status = '1' AND id_std = '".$rowsvalues['std_id']."' ");
																
								$values_scholarship = mysqli_fetch_array($sql_scholarship);
								// Fee Concession
								$sql_concess	= $dblms->querylms("SELECT SUM(percent) as concession
																FROM ".SCHOLARSHIP." 
																WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
																AND   id_type = '2' AND status = '1' AND id_std = '".$rowsvalues['std_id']."' ");
																
								$values_concess = mysqli_fetch_array($sql_concess);
								// Fine
								$sql_fine	= $dblms->querylms("SELECT SUM(amount) as fine
																FROM ".SCHOLARSHIP." 
																WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
																AND   id_type = '3' AND status = '1' AND id_std = '".$rowsvalues['std_id']."' ");
																
								$values_fine = mysqli_fetch_array($sql_fine);
								
								// payabel amount after Scholarship & Fine
								$amount = $rowsvalues['total_amount'];
								$dis_per = $values_scholarship['scholarship'] + $values_concess['concession'];
								$dis = ($amount * $dis_per) / 100;
								$total_amount = $amount - $dis;
								$payable = $total_amount + $values_fine['fine'];

								$srno++;

								echo '
								<tr>
									<td style="text-align:center;">'.$srno.'</td>
									<td>'.$rowsvalues['challan_no'].'</td>
									<td>'.$rowsvalues['std_name'].'</td>
									<td>'.$rowsvalues['std_fathername'].'</td>
									<td>'.$rowsvalues['class_name'].' '; if($rowsvalues['section_name']){echo' ('.$rowsvalues['section_name'].') ';} echo'</td>
									<td>'.$rowsvalues['session_name'].'</td>
									<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
									<td>'.$rowsvalues['issue_date'].'</td>
									<td>'.$rowsvalues['due_date'].'</td>
									<td>'.number_format(round($total_amount)).'</td>
									<td>'.$values_fine['fine'].'</td>
									<td>Rs. '.number_format(round($payable)).'</td>
									<td style="text-align:center;">'.get_payments($rowsvalues['status']).'</td>
									<td style="text-align:center;">
										<a class="btn btn-success btn-xs mr-xs" style="text-align:center;" href="feechallanprint.php?id='.$rowsvalues['challan_no'].'"> <i class="fa fa-file"></i></a>
									</td>
								</tr>';
							
							}

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

	echo '
</section>
</div>
</section>';

?>