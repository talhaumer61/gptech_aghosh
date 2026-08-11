<style>
.card{
	padding: 20px;
	font-size: 30px;
	border-radius:10px;
	margin-left: 4%;
	margin-right: 4%;
	}
.val{
	font-size: 20px;
	margin-left: 18%;
	}
.span{
	font-size:14px;
	}
</style>
<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 

	$sqllmspaid	= $dblms->querylms("SELECT f.status, SUM(f.paid_amount) as paid
									FROM ".EXAM_FEE_CHALLANS." f
									WHERE f.status = '1' AND f.is_deleted = '0'");
	$value_paid = mysqli_fetch_array($sqllmspaid);
	if($value_paid['paid']){$paid = $value_paid['paid'];}else{$paid = 0;}

	$sqllmspending	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as pending
									FROM ".EXAM_FEE_CHALLANS." f
									WHERE f.status = '2' AND f.is_deleted = '0'");
	$value_pending = mysqli_fetch_array($sqllmspending);
	if($value_pending['pending']){$pending = $value_pending['pending'];}else{$pending = 0;}

	$sqllmsunpaid	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as unpaid
									FROM ".EXAM_FEE_CHALLANS." f
									WHERE f.status = '3' AND f.is_deleted = '0'");
	$value_unpaid = mysqli_fetch_array($sqllmsunpaid);
	if($value_unpaid['unpaid']){$unpaid = $value_unpaid['unpaid'];}else{$unpaid = 0;}

	$sqlSearch   = "";
	$search_word = "";
	if(isset($_GET['search_word'])){
		$sqlSearch 	 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%' OR c.campus_name LIKE '%".$_GET['search_word']."%')";
		$search_word = $_GET['search_word'];
	}	

	echo '
	<div class="row mt-none mb-md">
		<div class="col-sm-12 col-md-12 col-lg-3 bg bg-success card mb-sm">
			<i class="fa fa-star" aria-hidden="true"></i> Total Paid
			<p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid).'</p>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-3 bg bg-warning card mb-sm">
			<i class="fa fa-refresh" aria-hidden="true"></i> Total Pending
			<p class="val mt-md"><span class="span">Rs:</span> '.number_format($pending).'</p>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-3 bg bg-danger card mb-sm">
			<i class="fa fa-ban" aria-hidden="true"></i> Total Unpaid
			<p class="val mt-md"><span class="span">Rs:</span> '.number_format($unpaid).'</p>
		</div>
	</div>
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'add' => '1'))){ 
				echo'
				<a href="exam_registration_challans.php?view=add_single" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Single Challan</a>
				<a href="exam_registration_challans.php?view=add_bulk" style="margin-right:5px;" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Bulk Challan</a>';
			}			
			echo'
			<h2 class="panel-title"><i class="fa fa-list"></i>  Challans List</h2>
		</header>
		<div class="panel-body">
			<form action="#" method="GET" autocomplete="off">
				<div class="form-group mb-lg">
					<div class="row">
						<div class="col-sm-3 col-sm-offset-9">
							<div class="input-group">
								<input type="text" class="form-control" name="search_word" id="search_word" value="'.$search_word.'" placeholder="Search">
								<div class="input-group-btn">
									<button class="btn btn-primary" type="submit">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>';
			$sql = "SELECT f.id, f.status, f.challan_no, f.issue_date, f.due_date, f.total_amount, c.campus_name, s.session_name, et.type_name, f.paid_date
					FROM ".EXAM_FEE_CHALLANS." f				   
					INNER JOIN ".CAMPUS." c ON c.campus_id = f.id_campus
					INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
					INNER JOIN ".EXAM_TYPES." et ON et.type_id = f.id_examtype							 
					WHERE f.is_deleted = '0' $sqlSearch
					ORDER BY f.id DESC";

			$sqllms	= $dblms->querylms($sql);
			
			$count = mysqli_num_rows($sqllms);
			if($page == 0 || empty($page)) { $page = 1; }	//if no page var is given, default to 1.
			$prev		= $page - 1;						//previous page is page - 1
			$next		= $page + 1;						//next page is page + 1
			$lastpage	= ceil($count/$Limit);				//lastpage is = total pages / items per page, rounded up.
			$lpm1		= $lastpage - 1;
			$filters = 'search_word='.$search_word.'&search';

			$sqllms	= $dblms->querylms("$sql LIMIT ".($page-1)*$Limit .",$Limit");
			
			if(mysqli_num_rows($sqllms) > 0){
				echo'
				<table class="table table-bordered table-striped table-condensed mb-none">
					<thead>
						<tr>
							<th width="40" class="center">Sr.</th>
							<th width="80" class="center">Session</th>
							<th width="130" class="center">Challan #</th>
							<th>Campus</th>
							<th>Exam Type</th>
							<th width="100" class="center">Issue Date</th>
							<th width="100" class="center">Due Date</th>
							<th width="100" class="center">Paid Date</th>
							<th width="100" class="center">Payable</th>
							<th width="70" class="center">Status</th>
							<th width="100" class="center">Options</th>
						</tr>
					</thead>
					<tbody>';
						$srno = 0;
						// SERIAL NO
						if($page == 1){
							$srno = 0;
						}else{
							$srno = ($page - 1) * $Limit;
						}
						while($rowsvalues = mysqli_fetch_array($sqllms)) {
							$srno++;
							echo '
							<tr>
								<td class="center">'.$srno.'</td>
								<td>'.$rowsvalues['session_name'].'</td>
								<td class="center">'.$rowsvalues['challan_no'].'</td>
								<td>'.$rowsvalues['campus_name'].'</td>
								<td>'.$rowsvalues['type_name'].'</td>
								<td class="center">'.$rowsvalues['issue_date'].'</td>
								<td class="center">'.$rowsvalues['due_date'].'</td>
								<td class="center">'.$rowsvalues['paid_date'].'</td>
								<td class="center">'.number_format(round($rowsvalues['total_amount'])).'</td>
								<td class="center">'.get_payments($rowsvalues['status']).'</td>
								<td class="center">';
								echo '
									<a class="btn btn-success btn-xs" class="center" href="examRegistrationChallanPrint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
									if($rowsvalues['status'] != '1'){
										if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'edit' => '1'))){ 
											echo '
												<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_registration/challans/edit.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
										}
										echo '<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'exam_registration_challans.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
									}
									echo'
								</td>
							</tr>';
						}
						echo'
					</tbody>
				</table>';
                include_once("include/pagination.php");
			}else{
				echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
			}
			echo'
		</div>
	</section>';
}else{
	header("Location: dashboard.php");
}
?>