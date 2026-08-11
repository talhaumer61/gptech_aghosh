<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'view' => '1'))){   
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'add' => '1'))){
		echo'
		<a href="#make_class" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
			<i class="fa fa-plus-square"></i> Make Donor
		</a>';
		}
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i>  Donors List</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
			<thead>
				<tr>
					<th class="center"  width="70">No #</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Whastapp</th>
					<th>Email</th>
					<th width="70" class="center">Status</th>
					<th width="100" class="center">Options</th>
				</tr>
			</thead>
			<tbody>';
				//-----------------------------------------------------
				$sqllms	= $dblms->querylms("SELECT donor_id, donor_status, donor_name, donor_phone, donor_whatsapp, donor_email
												FROM ".DONORS."
												WHERE donor_id != ''  
												ORDER BY donor_name ASC");
				$srno = 0;
				//-----------------------------------------------------
				while($rowsvalues = mysqli_fetch_array($sqllms)) {
					//-----------------------------------------------------
					$srno++;
					//-----------------------------------------------------
					echo '
					<tr>
						<td class="center">'.$srno.'</td>
						<td>'.$rowsvalues['donor_name'].'</td>
						<td>'.$rowsvalues['donor_phone'].'</td>
						<td>'.$rowsvalues['donor_whatsapp'].'</td>
						<td>'.$rowsvalues['donor_email'].'</td>
						<td class="center">'.get_status($rowsvalues['donor_status']).'</td>
						<td class="center">
						<a href="donorsreportprint.php?id='.$rowsvalues['donor_id'].'" target="_blank" class="btn btn-success btn-xs ml-xs"><i class="fa fa-file"></i></a>';
						if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'edit' => '1'))){
							echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs ml-xs" onclick="showAjaxModalZoom(\'include/modals/donation/donors/update.php?id='.$rowsvalues['donor_id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
						}
						if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'delete' => '1'))){
							echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'class.php?deleteid='.$rowsvalues['donor_id'].'\');"><i class="el el-trash"></i></a>';
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