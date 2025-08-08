  <?php
  echo'
  <div id="bank_details" class="tab-pane ">
	<section class="panel panel-pvs-shadow mt-lg">
		<header class="panel-heading panel-featured-primary pvs-heading-tran">
			<div class="pull-right">
				<a href="#add_account" class="modal-with-move-anim btn btn-xs btn-primary">
					<i class="fa fa-plus-square"></i> Add Account
				</a>
			</div>
			<h2 class="panel-title">List Of Bank Details</h2>
		</header>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped mb-none">
					<thead>
						<tr>
							<th>#</th>
							<th>Bank Name</th>
							<th>Account Name</th>
							<th>Branch</th>
							<th>Employee</th>
							<th>IFSC Code</th>
							<th>Account TYpe</th>
							<th>Account No</th>
							<th>Status </th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>';
						//-----------------------------------------------------
						$sqllms	= $dblms->querylms("SELECT a.id, a.status, a.id_emply, a.id_bank, a.branch, a.account_name,
														   a.account_no, a.account_type,
														   b.bank_id, b.bank_name,
														   e.emply_id, e.emply_name
								     
								   					FROM ".EMPLOYEES_BANKACCOUNTS." a
													INNER JOIN ".BANKS." b ON b.bank_id = a.id_bank
													INNER JOIN ".EMPLOYEES." e ON e.emply_id = a.id_emply
								   					WHERE a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													AND   a.id_emply = '".$_GET['id']."' 
								   					ORDER BY a.account_name ASC ");
						$srno = 0;
						//-----------------------------------------------------
						while($rowsvalues = mysqli_fetch_array($sqllms)) {
						//-----------------------------------------------------
						$srno++;
						//-----------------------------------------------------
						echo '
						<tr>
							<td style="text-align:center;">'.$srno.'</td>
							<td>'.$rowsvalues['bank_name'].'</td>
							<td>'.$rowsvalues['account_name'].'</td>
							<td>'.$rowsvalues['branch'].'</td>
							<td>'.$rowsvalues['emply_name'].'</td>
							<td></td>
							<td>'.$rowsvalues['account_type'].'</td>
							<td>'.$rowsvalues['account_no'].'</td>
							<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
							<td>
								<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/employee/bankaccount_edit.php?id='.$rowsvalues['id_emply'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>
								<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'employee.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
							</td>
						</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
					</tbody>
				</table>
			</div>
		</div>
	</section>
  </div>
  ';
  ?>