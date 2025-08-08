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
	}
.span{
	font-size:14px;
	}
</style>
<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 

$month = date('n');
$sql1 = "";
$sql2 = "";
$sql3 = "";
$sql4 = "";
$sql5 = "";
$sql6 = "";
$sql7 = "";
$sql8 = "";
$search_word = "";
$paid_date = "";
$pay_through = "";
$status = "";
$class = "";
$std_gender = "";
$is_hostelized = "";
$filters = "";

//--------- FIlters ----------
if(isset($_GET['show'])){
	//  class
    if($_GET['id_class']){
        $arrayClass = array();
        foreach ($_GET['id_class'] as $class){
            array_push($arrayClass, $class);
        }
        if(in_array('all', $arrayClass)){
            $selectAll = 'selected';
            $sql1 = "";
            $classComma = '';
        }else{
            $sql1 = "AND f.id_class IN (".implode(", ",$arrayClass).")";
            $classComma 	= 	implode(", ",$arrayClass);
        }
        $class	=	$arrayClass;
    }
	//	class on pagination
	if(isset($_GET['id_class2']) && !empty($_GET['id_class2'])){
		$sql2 = "AND f.id_class IN (".$_GET['id_class2'].")";
		$classComma = $_GET['id_class2'];
		$class = explode(", ",$_GET['id_class2']);
	}
	//  word
	if(isset($_GET['search_word'])){
		$sql3 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%' OR st.admission_formno LIKE '".$_GET['search_word']."' OR st.std_regno LIKE '".$_GET['search_word']."' OR st.std_name LIKE '%".$_GET['search_word']."%' OR st.std_rollno LIKE '%".$_GET['search_word']."%')";
		$search_word = $_GET['search_word'];
	}
	// Date
	if($_GET['paid_date']){
		$sql4 = "AND f.paid_date = '".date('Y-m-d', strtotime($_GET['paid_date']))."' AND f.paid_date != '0000-00-00' ";
		if(!empty($_GET['paid_date'])){$paid_date = date('m/d/Y', strtotime($_GET['paid_date']));} else {$paid_date = '';}
	}
	// pay method
	if($_GET['method']){
		$sql5 = "AND f.pay_mode = '".$_GET['method']."'";
		$pay_through = $_GET['method'];
	}
	// status
	if($_GET['status']){
		$sql6 = "AND f.status = '".$_GET['status']."'";
		$status = $_GET['status'];
	}
	// status
	if($_GET['std_gender']){
		$sql7 = "AND st.std_gender = '".$_GET['std_gender']."'";
		$std_gender = $_GET['std_gender'];
	}
	//	is_hostelized
	if($_GET['is_hostelized']){
		if($_GET['is_hostelized']==1){
			$sql8 = "AND st.is_hostelized = '1'";
			$is_hostelized = $_GET['is_hostelized'];
		}else{
			$sql8 = "AND st.is_hostelized != '1'";
			$is_hostelized = $_GET['is_hostelized'];
		}
	}
}
$filters = 'search_word='.$search_word.'&paid_date='.$paid_date.'&method='.$pay_through.'&status='.$status.'&id_class2='.$classComma.'&std_gender='.$std_gender.'&is_hostelized='.$is_hostelized.'&show';

//-------------------- Fee Paid -----------------------------
$sqllmspaid	= $dblms->querylms("SELECT f.status, 
								SUM(CASE WHEN c.class_name LIKE '%tehfeez%' THEN f.paid_amount ELSE 0 END) AS teh_paid,
								SUM(CASE WHEN c.class_name NOT LIKE '%tehfeez%' THEN f.paid_amount ELSE 0 END) AS ags_paid
								FROM ".FEES." f				   
								INNER JOIN ".STUDENTS." st ON st.std_id   = f.id_std
								INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	
								WHERE (f.status = '1' OR f.status = '4') 
								AND f.id_type = '2' AND f.is_deleted != '1' 
								AND st.is_deleted != '1' 
								AND st.std_status != '3'
								AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								$sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8");
$value_paid = mysqli_fetch_array($sqllmspaid);

if($value_paid){
	$teh_paid = $value_paid['teh_paid'];
	$ags_paid = $value_paid['ags_paid'];
}else{
	$teh_paid = 0;
	$ags_paid = 0;
}

//------------------- Fee Pending ----------------------------
$sqllmspending	= $dblms->querylms("SELECT f.status, 
									SUM(CASE WHEN c.id_classgroup = '3' THEN f.total_amount ELSE 0 END) AS teh_total,
									SUM(CASE WHEN c.id_classgroup != '3' THEN f.total_amount ELSE 0 END) AS ags_total,
									SUM(CASE WHEN c.id_classgroup = '3' THEN f.paid_amount ELSE 0 END) AS teh_paid,
									SUM(CASE WHEN c.id_classgroup != '3' THEN f.paid_amount ELSE 0 END) AS ags_paid
								   FROM ".FEES." f
									INNER JOIN ".STUDENTS." st ON st.std_id   = f.id_std
									INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	
									WHERE (f.status = '2' OR f.status = '4') 
									AND f.id_type = '2' 
									AND f.is_deleted != '1' 
									AND st.is_deleted != '1' 
									AND st.std_status != '3'
									AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									$sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8");
$value_pending = mysqli_fetch_array($sqllmspending);

$tehTotalPending = $value_pending['teh_total'] - $value_pending['teh_paid'];
$agsTotalPending = $value_pending['ags_total'] - $value_pending['ags_paid'];

if($tehTotalPending){$tehpending = $tehTotalPending;}else{$tehpending = 0;}
if($agsTotalPending){$agspending = $agsTotalPending;}else{$agspending = 0;}

//-------------------- Fee Unpaid ----------------------
// $sqllmsunpaid	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as unpaid
// 								   FROM ".FEES." f
// 								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
// 								   AND f.id_type = '2'   
// 								   AND f.status = '3' AND f.is_deleted != '1'");
// $value_unpaid = mysqli_fetch_array($sqllmsunpaid);
// if($value_unpaid['unpaid']){$unpaid = $value_unpaid['unpaid'];}else{$unpaid = 0;}
//------------------------------------------------------

echo '
<div class="row row-sm" style="margin-bottom:10px;">
	<div class="col-lg-4 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
		<div class="bg-primary  rounded overflow-hidden">
		<div class="pd-10 d-flex align-items-center">
			<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
			<div class="mg-l-20">
				<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8">Total Receivable</p>
				<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($ags_paid + $agspending + $teh_paid + $tehpending).'</p>
				<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($ags_paid + $agspending).'</p>
				<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($teh_paid + $tehpending).'</p>
			</div>
		</div>
		</div>
	</div>
	<div class="col-lg-4 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
		<div class="bg-success rounded overflow-hidden">
		<div class="pd-10 d-flex align-items-center">
			<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
			<div class="mg-l-20">
				<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8">Total Paid</p>
				<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($ags_paid + $teh_paid).'</p>
				<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($ags_paid).'</p>
				<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($teh_paid).'</p>
			</div>
		</div>
		</div>
	</div>
	<div class="col-lg-4 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
		<div class="bg-warning rounded overflow-hidden">
		<div class="pd-10 d-flex align-items-center">
			<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
			<div class="mg-l-20">
				<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8">Total Pending</p>
				<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($agspending + $tehpending).'</p>
				<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($agspending).'</p>
				<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($tehpending).'</p>
			</div>
		</div>
		</div>
	</div>
</div>
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
			if($_SESSION['userlogininfo']['LOGINTYPE']  == 1):
				echo'
				<a href="#chnage_duedate" class="modal-with-move-anim ml-sm btn btn-primary btn-xs pull-right"><i class="fa fa-calendar"></i> Change Due Date</a>';
			endif;
			echo '
			<a href="#report_challan" class="modal-with-move-anim ml-sm btn btn-primary btn-xs pull-right"><i class="fa fa-file"></i> Challan Genration Report</a>
			<a href="#print_challan" class="modal-with-move-anim ml-sm btn btn-primary btn-xs pull-right"><i class="fa fa-print"></i> Print Challan</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'add' => '1'))){ 
			echo'<a href="fee_challans.php?view=bulk" class="btn btn-primary ml-sm btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Class Challan</a>
				<a href="#make_challan" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Single Challan</a>';
		}
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i> Challans List</h2>
	</header>
	<div class="panel-body">
		<form action="#" method="GET" autocomplete="off">
			<div class="form-group mb-sm">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Search </label>
						<input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search">
					</div>
				</div>
				<div class="col-md-3">
					<label class="control-label">Paid Date </label>
					<input type="text" class="form-control" name="paid_date" id="paid_date" value="'.$paid_date.'" data-plugin-datepicker/>
				</div>
				<div class="col-md-3">
					<label class="control-label">Paid Through </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="method">
						<option value="">Select</option>';
						foreach($paymethod as $method){
							echo '<option value="'.$method['id'].'"'; if($pay_through == $method['id']){ echo'selected';} echo'>'.$method['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Status </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="status">
						<option value="">Select</option>';
						foreach($payments as $stat){
							echo '<option value="'.$stat['id'].'"'; if($status == $stat['id']){ echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Class </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_class[]" multiple>
						<option value="all" '.$selectAll.'>All</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
															FROM ".CLASSES." 
															WHERE class_status = '1'
															AND is_deleted != '1'
															ORDER BY class_id ASC"
														);
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['class_id'].'"'; if(in_array($valuecls['class_id'], $class)){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
							}
							echo'
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Gender </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
						<option value="">Select</option>';
						foreach($gender as $gndr){
							echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Boarder / Day Scholar</label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_hostelized">
						<option value="">Select</option>';
						foreach($studenttype as $hostel)
						{
							echo' <option value="'.$hostel['id'].'"'; if($is_hostelized == $hostel['id']){ echo'selected';} echo'>'.$hostel['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-3" style="margin-top: 2%;">
					<div class="form-group">
						<button type="submit" name="show" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
					</div>
				</div>
			</div>
		</form>';
		$sql = "SELECT f.id, f.status, f.id_month, f.challan_no, f.issue_date, f.due_date, f.paid_date, f.total_amount, f.remaining_amount, f.paid_amount, f.narration, c.class_name, cs.section_name, s.session_name, st.std_id, st.std_name, st.std_fathername, st.std_regno, st.std_gender, st.is_hostelized
				FROM ".FEES." f				   
				INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
				LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
				INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
				INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
				WHERE f.id_type = '2'
				AND f.is_deleted != '1'
				AND st.is_deleted != '1'
				AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8
				ORDER BY f.id DESC";

		$sqllms	= $dblms->querylms($sql);
		
		$count = mysqli_num_rows($sqllms);
		if($page == 0) { $page = 1; }				//if no page var is given, default to 1.
		$prev 		    = $page - 1;				//previous page is page - 1
		$next 		    = $page + 1;				//next page is page + 1
		$lastpage  		= ceil($count/$Limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 		    = $lastpage - 1;

		$sqllms	= $dblms->querylms("$sql LIMIT ".($page-1)*$Limit .",$Limit");
		if(mysqli_num_rows($sqllms) > 0){
			echo'
			<div class="table-responsive">
				<table class="table table-bordered table-striped mb-none">
					<thead>
						<tr>
							<th class="center">#</th>
							<th>Challan #</th>
							<th>Student</th>
							<th>Father</th>
							<th>Class</th>
							<th>Session</th>
							<th>Month</th>
							<th width="90px;">Issue Date</th>
							<th width="90px;">Due Date</th>
							<th width="90px;">Paid Date</th>
							<th width="70px;" class="center">Status</th>
							<th>Total</th>
							<th width="130" class="center">Options</th>
						</tr>
					</thead>
					<tbody>';
						$srno = 0;
						$totalConcessionScholarship = 0;
						$totFine = 0;
						$totRemaining = 0;
						$totPayable = 0;
						while($rowsvalues = mysqli_fetch_array($sqllms)) {
							$srno++;
							$paidDate = '';
							if($rowsvalues['paid_date'] != '0000-00-00'){$paidDate = $rowsvalues['paid_date'];}

							//---------------- Online Payment ----------------------
							// $sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
							// 									FROM ".PAY_API_TRAN." 
							// 									WHERE challan_no = '".cleanvars($rowsvalues['challan_no'])."'");
							// $onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
							// if($onlinePaid['total_paid'] >= $rowsvalues['total_amount']){
							// 	$challan_status = '1';
							// }elseif($onlinePaid['total_paid'] < $rowsvalues['total_amount'] && $onlinePaid['total_paid'] != 0){
							// 	$challan_status = 4;
							// } else{
								// $challan_status = $rowsvalues['status'];
							// }

							// After Due Date
							if(date('Y-m-d') > $rowsvalues['due_date'] && $rowsvalues['status'] != 1) {
								$granTotal = $rowsvalues['total_amount'] + LATEFEE;
							}else{
								$granTotal = $rowsvalues['total_amount'];
							}
							echo '
							<tr>
								<td class="center">'.$srno.'</td>
								<td>
									<a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/challan_detail.php?challan_no='.$rowsvalues['challan_no'].'\');">
										'.$rowsvalues['challan_no'].' </a>
								</td>
								<td>
									<a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/student_details.php?id_std='.$rowsvalues['std_id'].'\');">
									'.$rowsvalues['std_name'].'  </a>
								</td>
								<td>'.$rowsvalues['std_fathername'].'</td>
								<td>'.$rowsvalues['class_name'].' '; if($rowsvalues['section_name']){echo' ('.$rowsvalues['section_name'].') ';} echo'</td>
								<td>'.$rowsvalues['session_name'].'</td>
								<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
								<td>'.$rowsvalues['issue_date'].'</td>
								<td>'.$rowsvalues['due_date'].'</td>
								<td>'.$paidDate.'</td>
								<td class="center">'.get_payments($rowsvalues['status']).'</td>
								<td>'.number_format(round($granTotal)).'</td>
								<td class="center">';
								$sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
																	FROM ".FEES." f						 
																	INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
																	WHERE f.id_type		= '2'
																	AND f.status		= '2'
																	AND f.is_deleted	= '0'
																	AND f.id_std		= '".cleanvars($rowsvalues['std_id'])."'
																	AND st.is_deleted	= '0'
																	AND f.id_campus		= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																	ORDER BY f.id DESC LIMIT 1");
								$valuesqllmscheck = mysqli_fetch_array($sqllmscheck);
								if(isset($valuesqllmscheck['challan_no']) &&  $valuesqllmscheck['challan_no'] == $rowsvalues['challan_no']){
									//PRINT BUTTON
									echo'<a class="btn btn-success btn-xs mr-xs" class="center" href="feechallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
									//EDIT BUTTON
									// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || in_array($_SESSION['userlogininfo']['LOGINTYPE'],$FEE_CHALLAN_RIGHTS) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'edit' => '1'))){ 
									if($_SESSION['userlogininfo']['LOGINIDA']  == 4 || $_SESSION['userlogininfo']['LOGINIDA']  == 327){
										echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/fee_challans/modal_feechallan_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
									}
									//DELETE BUTTON
									if((($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'delete' => '1'))) && $rowsvalues['status'] !=4){ 
										echo '<a href="#" class="btn btn-danger btn-xs mr-xs" onclick="confirm_modal(\'fee_challans.php?deleteid='.$rowsvalues['challan_no'].'\');"><i class="el el-trash"></i></a>';
									}

								}elseif($rowsvalues['status'] != '1'){
									//EDIT BUTTON
									// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || in_array($_SESSION['userlogininfo']['LOGINTYPE'],$FEE_CHALLAN_RIGHTS)){ 
									if($_SESSION['userlogininfo']['LOGINIDA']  == 4){
										echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/fee_challans/modal_feechallan_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
									}

									// if($rowsvalues['remaining_amount'] == 0){
									// 	echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/fee_challans/modal_feechallan_partialpayment.php?id='.$rowsvalues['id'].'\');"><img src="assets/images/partial_payment.png" height="15" width="auto"></a>';
									// }

									//DELETE BUTTON
									if((($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'delete' => '1'))) && $rowsvalues['status'] !=4){ 
										echo '<a href="#" class="btn btn-danger btn-xs mr-xs" onclick="confirm_modal(\'fee_challans.php?deleteid='.$rowsvalues['challan_no'].'\');"><i class="el el-trash"></i></a>';
									}
								}elseif($rowsvalues['status']==1){
									echo'<a class="btn btn-success btn-xs mr-xs" class="center" href="feechallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
								}
								echo '
								</td>
							</tr>';
						}
						echo '
					</tbody>
				</table>
			</div>';
			include_once('include/pagination.php');
		}
		else{
			echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
		}
		echo'
	</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
?>