<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'view' => '1')))
{ 
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'add' => '1')))
		{ 
			echo'<a href="#admission_inquiry" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
					<i class="fa fa-plus-square"></i> Make Inquiry
				</a>';
		}
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i>  Inquiry List test</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
			<thead>
				<tr>
					<th class="center">No.</th>
					<th>Form no.</th>
					<th>Name</th>
					<th>Father Name</th>
					<th>Cell No.</th>
					<th>Dated</th>
					<th>Source</th>
					<th>Class</th>
					<th width="70px;" class="center">Status</th>
					<th width="125" class="center">Options</th>
				</tr>
			</thead>
			<tbody>';
				//-----------------------------------------------------
				$sqllms	= $dblms->querylms("SELECT q.id, q.form_no, q.status, q.name, q.fathername, q.cell_no, q.address, q.note,
												q.date_added, q.source, q.id_class, q.is_hostelized, q.is_orphan, c.class_name
												FROM ".ADMISSIONS_INQUIRY." q  
												INNER JOIN ".CLASSES." c ON c.class_id = q.id_class
												WHERE q.is_deleted != '1'
												AND q.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
												ORDER BY q.id DESC");
				$srno = 0;
				//-----------------------------------------------------
				while($rowsvalues = mysqli_fetch_array($sqllms)) {
					//-----------------------------------------------------
					$srno++;
					//-----------------------------------------------------
					echo'
					<tr>
						<td class="center">'.$srno.'</td>
						<td>'.$rowsvalues['form_no'].'</td>
						<td>'.$rowsvalues['name'].'</td>
						<td>'.$rowsvalues['fathername'].'</td>
						<td>'.$rowsvalues['cell_no'].'</td>
						<td>'.date("d M Y", strtotime($rowsvalues['date_added'])).'</td>
						<td>'.get_inquirysrc($rowsvalues['source']).'</td>
						<td>'.$rowsvalues['class_name'].'</td>
						<td class="center">'.get_status($rowsvalues['status']).'</td>
						<td class="center">';
							// If Std Is Not Orphan Then Challan OPtion
							if($rowsvalues['is_orphan'] != '1') {
								$sqllmsChallan = $dblms->querylms("SELECT id, challan_no
																		FROM ".FEES."
																		WHERE id_type = '1' AND inquiry_formno = '".$rowsvalues['form_no']."'
																		AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
								if(mysqli_num_rows($sqllmsChallan) > 0) {
									$valChallan = mysqli_fetch_array($sqllmsChallan);
									echo'<a class="btn btn-info btn-xs mr-xs" href="feechallanprint.php?id='.$valChallan['challan_no'].'" target="_blank" data-toggle="tooltip" title="Print Challan"> <i class="fa fa-file"></i></a>';
								} else {
									echo'<a class="btn btn-primary btn-xs mr-xs" href="include/campus/admissions/admissionChallanGenrate.php?form_no='.$rowsvalues['form_no'].'&id_class='.$rowsvalues['id_class'].'&is_hostelized='.$rowsvalues['is_hostelized'].'&is_orphan='.$rowsvalues['is_orphan'].'&phone='.$rowsvalues['cell_no'].'" target="_blank"  data-toggle="tooltip" title="Genrate Challan"> <i class="fa fa-file"></i></a>';
								}	
							}
								
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'add' => '1'))){
								// Chekc If Std Exist
								$sqllmsStd = $dblms->querylms("SELECT std_id FROM ".STUDENTS."
																		WHERE admission_formno = '".$rowsvalues['form_no']."'
																		AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
								if(mysqli_num_rows($sqllmsStd) == 0) {
									echo'<a href="students.php?inquiry='.$rowsvalues['id'].'" class="btn btn-success btn-xs mr-xs"  data-toggle="tooltip" title="Make Admission"><i class="glyphicon glyphicon-plus-sign"></i> </a>';
								}
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'edit' => '1'))) { 
								echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/admissions/modal_admission_inquiry_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"  data-toggle="tooltip" title="Edit Inquiry"></i> </a>';
							}
							if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'delete' => '1'))) { 
								echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'admission_inquiry.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash" data-toggle="tooltip" title="Delete Inquiry"></i></a>';
							}
							echo'
						</td>
					</tr>';
				}
				echo'
			</tbody>
		</table>
	</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
?>