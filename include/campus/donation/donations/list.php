<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'view' => '1'))){
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
					<th>Donor </th>
					<th>Student Name</th>
					<th>Student Reg no</th>
					<th>Frequency (In Month)</th>
					<th class="center">Amount</th>
					<th width="70" class="center">Status</th>
					<th width="100" class="center">Options</th>
				</tr>
			</thead>
			<tbody>';
				//-----------------------------------------------------
				$sqllmsDonations	= $dblms->querylms("SELECT d.id, d.status, d.amount, d.duration, s.std_name, s.std_regno, o.donor_name
												FROM ".DONATIONS_STUDENTS." d
												INNER JOIN ".STUDENTS." s ON s.std_id = d.id_std
												INNER JOIN ".DONORS."   o ON o.donor_id = d.id_donor
												WHERE d.id != '' ORDER BY o.donor_name ASC");
				$srno = 0;
				//-----------------------------------------------------
				while($valDonation = mysqli_fetch_array($sqllmsDonations)) {
					//-----------------------------------------------------
					$srno++;
					//-----------------------------------------------------
					echo '
					<tr>
						<td class="center">'.$srno.'</td>
						<td>'.$valDonation['donor_name'].'</td>
						<td>'.$valDonation['std_name'].'</td>
						<td>'.$valDonation['std_regno'].'</td>
						<td>'.$valDonation['duration'].'</td>
						<td class="center">'.number_format($valDonation['amount']).'</td>
						<td class="center">'.get_status($valDonation['status']).'</td>
						<td class="center">';
						if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'edit' => '1'))){
							echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/donation/donations/update.php?id='.$valDonation['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
						}
						if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'delete' => '1'))){
							echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'class.php?deleteid='.$valDonation['id'].'\');"><i class="el el-trash"></i></a>';
						}
						echo'
						</td>
					</tr>';
				}
				//-----------------------------------------------------
			echo '
			</tbody>
		</table>
	</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
?>