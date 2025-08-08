<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['idstd'])) {

// Get all Student Concessions
	$consconditions = array ( 
								  'select' 		=> 's.*, st.std_id, st.std_name, st.std_fathername, st.std_regno,
								 					c.cat_name, fc.cat_name as Feehead, st.id_class, cl.class_name, se.session_id, se.session_name'
								, 'join' 		=> "INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std 
													INNER JOIN ".CLASSES." cl ON cl.class_id = s.id_class  
													INNER JOIN ".SCHOLARSHIP_CAT." c ON c.cat_id = s.id_cat 
													INNER JOIN ".FEE_CATEGORY." fc ON fc.cat_id = s.id_feecat  
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session"
								, 'where' 		=> array( 
															  's.id_campus'  => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 's.id_std' 	 => $_POST['idstd']
															, 's.id_session' => $_SESSION['userlogininfo']['ACADEMICSESSION']
															, 's.is_deleted' => 0 
														) 
								, 'order_by' 	=> ' s.date DESC '
								, 'return_type' => 'all' 
							); 
	$concessions 	= $dblms->getRows(SCHOLARSHIP.' s ', $consconditions);
echo '
	<div class="panel-body">
	<div class="table-responsive">
	<table class="table table-bordered mt-md nowrap" >
			<thead>
				<tr>
					<th class="text-center" style="width:70px;">Sr #</th>
					<th style="width:100px;">Date</th>
					<th>Concession Category</th>
					<th>Concession head</th>
					<th>Authority </th>
					<th style="width:100px;">Amount</th>
					<th style="width:70px;">Status</th>
					<th style="width:100px;" class="center">Options</th>
				</tr>
			</thead>
			<tbody>';
	$totalcons = 0;
	$srno = 0;
	foreach($concessions as $listconcess) :
	$srno++;
		echo '
				<tr>
					<td class="text-center">'.$srno.'</td>
					<td>'.$listconcess['date'].'</td>
					<td>'.$listconcess['cat_name'].'</td>
					<td>'.$listconcess['Feehead'].'</td>
					<td>'.get_authority($listconcess['id_authority']).'</td>
					<td class="text-right">'.number_format($listconcess['amount']).'</td>
					<td class="text-center">'.get_status($listconcess['status']).'</td>
					<td class="text-center">';
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'edit' => '1'))){ 
						echo'<a href="feeconcession.php?view=edit&idstd='.$_POST['idstd'].'" class="btn btn-success btn-xs mr-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
					}
					if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'deleted' => '1'))){ 
						echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'feeconcession.php?deleteid='.$listconcess['id'].'\');"><i class="el el-trash"></i></a>';
					}
				echo '
						</td>
				</tr>';
	$totalcons = ($totalcons + $listconcess['amount']);
	endforeach;
	echo '
			</tbody>
			<tfoot>
				<tr>
					<td class="text-right" colspan="5"><b>Total Concession Granted </b></td>
					<td class="text-right">
						<input type="text" id="netGrandTotal" class="text-right form-control" name="net_grand_total" value="'.number_format($totalcons).'" readonly />
					</td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
		</div>
</div>';
    
}
