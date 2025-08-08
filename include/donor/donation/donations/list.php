<?php
//Donor
$sqllmsDonor = $dblms->querylms("SELECT donor_id, donor_name
										FROM ".DONORS."
										WHERE donor_id != ''
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
										LIMIT 1");
$valDonor = mysqli_fetch_array($sqllmsDonor);
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'add' => '1'))){
			echo'
			<a href="#makeDonation" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
				<i class="fa fa-plus-square"></i> Make Student Donation
			</a>';
		}
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i>  Students List</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
			<thead>
				<tr>
					<th class="center" width="70">Sr#</th>
					<th>Student Name</th>
					<th>Father Name</th>
					<th>Student Reg no</th>
					<th>Class</th>
					<th>Frequency (In Month)</th>
					<th class="center">Amount</th>
					<th class="center">Option</th>
				</tr>
			</thead>
			<tbody>';
				//-----------------------------------------------------
				$sqllmsDonations = $dblms->querylms("SELECT d.id, d.status, d.amount, d.duration, s.std_id, s.std_name, s.std_fathername, s.std_regno, c.class_name, cs.section_name
															FROM ".DONATIONS_STUDENTS." d
															INNER JOIN ".STUDENTS." s ON s.std_id = d.id_std
															INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
															LEFT  JOIN ".CLASS_SECTIONS." cs ON cs.section_id = s.id_section
															WHERE d.id != '' AND d.id_donor = '".$valDonor['donor_id']."'
															ORDER BY d.id ASC");
				$srno = 0;
				//-----------------------------------------------------
				while($valDonation = mysqli_fetch_array($sqllmsDonations)) {
					//-----------------------------------------------------
					$srno++;
					//-----------------------------------------------------
					echo '
					<tr>
						<td class="center">'.$srno.'</td>
						<td>'.$valDonation['std_name'].'</td>
						<td>'.$valDonation['std_fathername'].'</td>
						<td>'.$valDonation['std_regno'].'</td>
						<td>'.$valDonation['class_name'].' '; if($valDonation['section_name']){ echo''.$valDonation['section_name'].''; } echo'</td>
						<td>'.$valDonation['duration'].'</td>
						<td class="center">'.number_format($valDonation['amount']).'</td>
						<td class="center">
							<a class="btn btn-success btn-xs mr-xs" href="donations.php?std='.$valDonation['std_id'].'&don='.$valDonor['donor_id'].'"> <i class="fa fa-user-circle-o"></i></a>
						</td>
					</tr>';
				}
				//-----------------------------------------------------
			echo '
			</tbody>
		</table>
	</div>
</section>';
?>