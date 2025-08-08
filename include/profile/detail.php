<?php 
$sqllms	= $dblms->querylms("SELECT a.adm_id, a.adm_status, a.adm_type, a.adm_username, a.adm_fullname,
								   a.adm_email, a.adm_phone, a.adm_photo, a.id_campus,
								   c.campus_id, c.campus_status, campus_regno, campus_code, campus_name, 
								   c.campus_email, c.campus_address, campus_email, c.campus_phone

								FROM ".ADMINS." a  
								INNER JOIN ".CAMPUS." c ON c.campus_id = a.id_campus
								WHERE a.adm_id = '".$_SESSION['userlogininfo']['LOGINIDA']."'
								ORDER BY a.adm_username ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
echo '
<div class="col-md-4">
	<section class="panel">
		<div class="panel-body">
			<div class="thumb-info mb-md">
				<img src="uploads/images/admins/'.$rowsvalues['adm_photo'].'" class="rounded img-responsive">
				<div class="thumb-info-title">
					<span class="thumb-info-inner">'.$rowsvalues['adm_fullname'].'</span>
					<span class="">'.get_status($rowsvalues['adm_status']).'</span>
				</div>
			</div>	
			<div class="widget-toggle-expand mb-xs">
				<div class="widget-content-expanded">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td>Full Name</td>
							<td align="right">'.$rowsvalues['adm_fullname'].'</td>
						</tr>
						<tr>
							<td>Username</td>
							<td align="right">'.$rowsvalues['adm_username'].'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td align="right">'.$rowsvalues['adm_email'].'</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td align="right">'.$rowsvalues['adm_phone'].'</td>
						</tr>
						<tr>
							<td>Campus</td>
							<td align="right">'.$rowsvalues['campus_name'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
}
?>
