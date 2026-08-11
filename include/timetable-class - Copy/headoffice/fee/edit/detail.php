<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
								   c.class_name, cs.section_name, s.session_name,
								   d.amount, d.duration, d.type,
								   fc.cat_name
								   FROM ".FEESETUP." f
								   								   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
								   INNER JOIN ".FEESETUPDETAIL." d ON d.id_setup = f.id						 
								   INNER JOIN ".FEE_CATEGORY." fc ON fc.cat_id = d.id_cat
								   
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY f.dated ASC");

	$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div class="col-md-4">
	<section class="panel">
		<div class="panel-body">
			<div class="widget-toggle-expand mb-xs">
				<div class="widget-content-expanded">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td>Dated</td>
							<td align="right">'.$rowsvalues['dated'].'</td>
						</tr>
						<tr>
							<td>Session</td>
							<td align="right">'.$rowsvalues['session_name'].'</td>
						</tr>
						<tr>
							<td>Class</td>
							<td align="right">'.$rowsvalues['class_name'].'</td>
						</tr>
						<tr>
							<td>Section</td>
							<td align="right">'.$rowsvalues['section_name'].'</td>
						</tr>
						<tr>
							<td>Duration</td>
							<td align="right">'.$rowsvalues['duration'].'</td>
						</tr>
						<tr>
							<td>Type</td>
							<td align="right">'.$rowsvalues['type'].'</td>
						</tr>
						<tr>
							<td>Amount</td>
							<td align="right">'.$rowsvalues['amount'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
