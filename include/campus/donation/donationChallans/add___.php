<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'add' => '1'))){   


if(isset($_POST['view_details'])){ $donor_id = $_POST['id_donor'];} else{$donor_id = '';}
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fa fa-plus-square"></i> Make Donation</h4>
	</header>
	
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-3"></div>
			 <div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Donor <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" name="id_donor" id="id_donor" required title="Must Be Required" class="form-control">
						<option value="">Select</option>';
						$sqllmsDonors	= $dblms->querylms("SELECT donor_id, donor_name
														FROM ".DONORS."
														WHERE donor_id != '' AND  donor_status = '1'
														ORDER BY donor_name ASC");
						while($donor = mysqli_fetch_array($sqllmsDonors)){
							echo '<option value="'.$donor['donor_id'].'"'; if($donor['donor_id'] == $donor_id){echo ' selected';} echo'>'.$donor['donor_name'].'</option>';
						}
						echo'
					</select>
				</div>
			</div>          
		</div>
		<center>
			<button type="submit" name="view_details" id="view_details" class="btn btn-primary"><i class="fa fa-search"></i> Check Details</button>
		</center>
	</div>
	</form>
</section>';


if(isset($_POST['view_details'])){
	//-----------------------------------------------------
	$sqllmsStudents	= $dblms->querylms("SELECT s.std_id, s.std_name, s.std_regno, d.amount, d.duration
									FROM ".STUDENTS." s
									INNER JOIN ".DONATIONS_STUDENTS." d ON d.id_std = s.std_id
									WHERE s.std_status = '1' AND s.is_deleted != '1' 
									AND d.status = '1' AND d.is_deleted != '1' 
									AND d.id_donor = '".$donor_id."' ORDER BY s.std_name");
	//-----------------------------------------------------
	if(mysqli_num_rows($sqllmsStudents) > 0){
		//-----------------------------------------------------
		$today = date('m/d/Y');
		//-----------------------------------------------------
		echo'
		<section class="panel panel-featured panel-featured-primary">
			<form action="donationChallans.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off" target="_blank">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-dollar"></i> Donation </h2>
				</header>
				<div class="panel-body">
					<div class="row mb-sm">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Issue Date  <span class="required">*</span></label>
								<input type="text" class="form-control" value="'.$today.'" name="issue_date" required readonly/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Due Date  <span class="required">*</span></label>
								<input type="text" class="form-control" name="due_date" required class="input-daterange input-group" data-plugin-datepicker/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">For Month  <span class="required">*</span></label>
								<select data-plugin-selectTwo data-width="100%" name="id_month" id="id_month" required title="Must Be Required" class="form-control">
									<option value="">Select</option>';
									foreach($monthtypes as $month){
										echo '<option value="'.$month['id'].'" >'.$month['name'].'</option>';
									}
									echo'
								</select>
							</div>
						</div>
						<!-- <div class="col-sm-3">
							<div class="form-group">
								<label class="control-label">Receipt  <span class="required">*</span></label>
								<input type="text" class="form-control" name="receipt" required title="Must Be Required"/>
							</div>
						</div> -->
					</div>
						<table class="table table-bordered table-striped table-condensed mb-none mt-md">
							<thead>
								<tr>
									<th>Student</th>
									<th>Reg No</th>
									<th>Amount </th>
									<th>Frequency (Month) </th>
									<th>Total Amount</th>
								</tr>
							</thead>
							<tbody> ';
								$grand_total = 0;
								$no = 0;
								while($valueStudents = mysqli_fetch_array($sqllmsStudents))
								{
									$perStdAmount = $valueStudents['amount'] * $valueStudents['duration'];
									$grand_total = $grand_total + $perStdAmount;
									$no++;
									echo'
									<tr>
										<td>
											<input type="hidden" name="id_std[]" id="id_std" value="'.$valueStudents['std_id'].'">
											<input type="text" class="form-control" value="'.$valueStudents['std_name'].'" required title="Must Be Required" readonly/>
										</td>
										<td>
											<input type="text" class="form-control" value="'.$valueStudents['std_regno'].'" required title="Must Be Required" readonly>
										</td>
										<td>
											<input type="text" class="form-control" value="'.$valueStudents['amount'].'" required title="Must Be Required" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="month[]" value="'.$valueStudents['duration'].'" required title="Must Be Required" readonly>
										</td>
										<td>
										<input type="text" class="form-control" name="amount[]" value="'.$perStdAmount.'" required title="Must Be Required" readonly>
										</td>
									</tr>';
								}
								echo'
							</tbody>
						</table>
					<div class="row mt-md mb-md">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Total Donation <span class="required">*</span></label>
								<input class="form-control" type="number" class="form-control" name="grand_total" id="grand_total" value="'.$grand_total.'" readonly/>
							</div>
						</div>
					</div>
					<input type="hidden" value="'.$donor_id.'" name="id_donor">
				</div>
				<footer class="panel-footer mt-sm">
					<div class="row">
						<div class="col-md-12">
							<center><button type="submit" name="challans_generate" id="challans_generate" class="btn btn-primary">Generate Challans</button></center>
						</div>
					</div>
				</footer>
			</form>
		</section>';
	}
	else{
		echo '
		<section class="panel panel-featured panel-featured-primary">
		<div class="panel-body">
			<div class="col-sm-12">
				<div class="form-group">
					<h2 style="text-align:center;">No Record Found!</h2>
				</div>
			</div>
		</div>
		</section>';
	}
}
	echo '
</section>';

}
else{
	header("Location: donationChallans.php");
}
?>