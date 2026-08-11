<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.supplier_id, s.supplier_status, s.supplier_name, s.supplier_phone, s.supplier_email,
								   s.supplier_address, s.supplier_company, s.supplier_contactname, s.supplier_contactphone,
								   s.supplier_contactemail
								   FROM ".INVENTORY_SUPPLIERS." s 
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND s.supplier_id = '".$_GET['id']."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div class="col-md-4">
	<section class="panel">
		<div class="panel-body">
			<div class="thumb-info mb-md">
				<img src="uploads/admin_image/1.jpg" class="rounded img-responsive">
				<div class="thumb-info-title">
					<span class="thumb-info-inner">'.$rowsvalues['supplier_company'].'</span>
					<span class="thumb-info-type">'.get_status($rowsvalues['supplier_status']).'</span>
				</div>
			</div>	
			<div class="widget-toggle-expand mb-xs">
				<div class="widget-content-expanded">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td>Name</td>
							<td align="right">'.$rowsvalues['supplier_name'].'</td>
							
						</tr>
						<tr>
							<td>Phone</td>
							<td align="right">'.$rowsvalues['supplier_phone'].'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td align="right">'.$rowsvalues['supplier_email'].'</td>
						</tr>
						<tr>
							<td>Address</td>
							<td align="right">'.$rowsvalues['supplier_address'].'</td>
						</tr>
						<tr>
							<td>Company</td>
							<td align="right">'.$rowsvalues['supplier_company'].'</td>
						</tr>
						<tr>
							<td>Contact Name</td>
							<td align="right">'.$rowsvalues['supplier_contactname'].'</td>
						</tr>
						<tr>
							<td>Contact Phone</td>
							<td align="right">'.$rowsvalues['supplier_contactphone'].'</td>
						</tr>
						<tr>
							<td>Contact Email</td>
							<td align="right">'.$rowsvalues['supplier_contactemail'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
