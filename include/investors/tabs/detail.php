<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.inv_id, i.inv_status, i.id_type, i.inv_name, i.inv_add, i.inv_email, i.inv_phone,
								   i.inv_cnic, i.dated,
								   l.level_id, l.level_status, l.level_name
									
								   FROM ".INVESTORS." i 
								   INNER JOIN ".SCHOOL_LEVEL." l ON l.level_id = i.id_type
								   WHERE i.inv_id = '".cleanvars($_GET['id'])."'
								   AND i.inv_status = '1' 
								   AND l.level_status = '1'  LIMIT 1");

	$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div class="col-md-4">
	<section class="panel">
		<div class="panel-body">
			<div class="thumb-info mb-md">';
			if($rowsvalues['emply_photo']) { 
    		echo'
				<img src="uploads/images/employees/'.$rowsvalues['photo'].'" class="rounded img-responsive">' ;
    		} else {
				 echo "No Image";
			}
   			 echo'
				<div class="thumb-info-title">
					<span class="thumb-info-inner">'.$rowsvalues['inv_name'].'</span>
					<span>'.get_status($rowsvalues['inv_status']).'</span>
				</div>
			</div>	
			<div class="widget-toggle-expand mb-xs">
				<div class="widget-content-expanded">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td>Name</td>
							<td align="right">'.$rowsvalues['inv_name'].'</td>
						</tr>
						<tr>
							<td>Registration Number</td>
							<td align="right">'.$rowsvalues['inv_email'].'</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td align="right">'.$rowsvalues['inv_phone'].'</td>
						</tr>
						<tr>
							<td>Type</td>
							<td align="right">'.$rowsvalues['level_name'].'</td>
						</tr>
						<tr>
							<td>CNIC</td>
							<td align="right">'.$rowsvalues['inv_cnic'].'</td>
						</tr>
						<tr>
							<td>Dated</td>
							<td align="right">'.$rowsvalues['dated'].'</td>
						</tr>
						<tr>
							<td>Address</td>
							<td align="right">'.$rowsvalues['inv_add'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
