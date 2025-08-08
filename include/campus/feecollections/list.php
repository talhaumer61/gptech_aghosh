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
if(!$view) {
	
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '90', 'view' => '1')) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '91', 'view' => '1'))){ 

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
		$sql3 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%' OR st.std_name LIKE '%".$_GET['search_word']."%' OR st.std_rollno LIKE '%".$_GET['search_word']."%')";
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
	
}
$filters = 'search_word='.$search_word.'&paid_date='.$paid_date.'&method='.$pay_through.'&status='.$status.'&id_class2='.$classComma.'&std_gender='.$std_gender.'&is_hostelized='.$is_hostelized.'&show';

	$start_date = date("Y-m-01");
	$end_date 	= date("Y-m-t");
//-------------------- Fee Paid -----------------------------
$sqllmspaid	= $dblms->querylms("SELECT SUM(f.total_amount) as allpaid, 
									SUM(CASE WHEN c.id_classgroup = '3' AND f.dated BETWEEN '".$start_date."' AND '".$end_date."' THEN f.total_amount ELSE 0 END) AS teh_allpaid,
									SUM(CASE WHEN c.id_classgroup != '3' AND f.dated BETWEEN '".$start_date."' AND '".$end_date."' THEN f.total_amount ELSE 0 END) AS ags_allpaid,
									SUM(CASE WHEN c.id_classgroup = '3' AND f.dated = '".date("Y-m-d")."' THEN f.total_amount ELSE 0 END) AS teh_Todaypaid,
									SUM(CASE WHEN c.id_classgroup != '3' AND f.dated = '".date("Y-m-d")."' THEN f.total_amount ELSE 0 END) AS ags_Todaypaid, 
									SUM(CASE WHEN f.dated = '".date("Y-m-d")."' THEN f.total_amount ELSE 0 END) AS Todaypaid
									FROM ".FEES_COLLECTION." f	
									INNER JOIN ".FEES." fe ON fe.challan_no = f.challan_no
									INNER JOIN ".CLASSES." c ON c.class_id = fe.id_class	
									WHERE f.is_deleted != '1' 
									AND f.pay_mode = '1' 
									AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
$value_paid = mysqli_fetch_array($sqllmspaid);
//fcc.date = '".date('Y-m-d')."'
$queryBankDeposits  = $dblms->querylms("SELECT SUM(fcc.amount) AS totalDeposited, 
												SUM(CASE WHEN fcc.id_dept = '1' AND fcc.date BETWEEN '".$start_date."' AND '".$end_date."' THEN fcc.amount ELSE 0 END) AS totalDepositedAGS,
												SUM(CASE WHEN fcc.id_dept = '2' AND fcc.date BETWEEN '".$start_date."' AND '".$end_date."' THEN fcc.amount ELSE 0 END) AS totalDepositedTEH, 
												SUM(CASE WHEN fcc.date BETWEEN '".$start_date."' AND '".$end_date."' THEN fcc.amount ELSE 0 END) AS totalMonthly 
												FROM ".FEES_COLLECTION_BANK_DEPOSIT." fcc
												WHERE fcc.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
												AND fcc.is_deleted != '1'");
$valueBankDeposit = mysqli_fetch_array($queryBankDeposits);
//------------------------------------------------------

echo '
<div class="row row-sm" style="margin-bottom:10px;">

			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
				<div class="bg-success rounded overflow-hidden">
				<div class="pd-10 d-flex align-items-center">
					<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
					<div class="mg-l-20">
						<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8">Today Collection</p>
						<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($value_paid['Todaypaid']).'</p>
						<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['ags_Todaypaid']).'</p>
						<p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($value_paid['teh_Todaypaid']).'</p>
					</div>
				</div>
				</div>
			</div>
			<!-- col-3 -->

			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
				<div class="bg-primary rounded overflow-hidden">
				<div class="pd-10 d-flex align-items-center">
					<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
					<div class="mg-l-20">
						<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8 ">Total Collection</p>
						<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($value_paid['ags_allpaid'] + $value_paid['teh_allpaid']).'</p>
						<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['ags_allpaid']).'</p>
						<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($value_paid['teh_allpaid']).'</p>
					</div>
				</div>
				</div>
			</div>
			<!-- col-3 -->

			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
				<a href="feecollections.php?view=bankdeposit" style="text-decoration: none;">
					<div class="bg-indigo rounded overflow-hidden">
						<div class="pd-10 d-flex align-items-center">
							<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
							<div class="mg-l-20">
								<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8 ">Deposited / Cash</p>
								<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($valueBankDeposit['totalMonthly']).'</p>
								<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($valueBankDeposit['totalDepositedAGS']).'</p>
								<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($valueBankDeposit['totalDepositedTEH']).'</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<!-- col-3 -->
			
			<div class="col-lg-3 col-sm-6 col-xs-12 mg-t-20 mg-xl-t-0">
				<div class="bg-danger rounded overflow-hidden">
				<div class="pd-10 d-flex align-items-center">
					<i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
					<div class="mg-l-20">
						<p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8 ">Cash in Hand</p>
						<p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1"> '.number_format(($value_paid['allpaid']) - ($valueBankDeposit['totalDeposited'])).'</p>
						<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format(($value_paid['ags_allpaid']-$valueBankDeposit['totalDepositedAGS'])).'</p>
						<p class="tx-15  tx-mont tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format(($value_paid['teh_allpaid']-$valueBankDeposit['totalDepositedTEH'])).'</p>
					</div>
				</div>
				</div>
			</div>
			<!-- col-3 -->
				
		</div>
		<!-- row -->

<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">	<span class="pull-right">';
	
		if(($_SESSION['userlogininfo']['LOGINIDA']  == 4)){ 
			echo '<a href="#make_partialchallan" class="modal-with-move-anim btn btn-primary btn-xs"><i class="fa fa-plus-square"></i> Pay Challan</a>';
		} elseif(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '90', 'add' => '1'))){ 
			echo '<a href="#make_challan" class="modal-with-move-anim btn btn-primary btn-xs"><i class="fa fa-plus-square"></i> Pay Challan</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '91', 'add' => '1'))){ 
			echo ' <a href="#make_bankdeposit" class="modal-with-move-anim btn btn-success btn-xs"><i class="fa fa-bank"></i> Add Bank Deposit</a>';
		}
		echo '
		</span>
		<h2 class="panel-title"><i class="fa fa-list"></i> Challans List</h2>
	</header>
	<div class="panel-body">
		';
		$sql = "SELECT fc.id, fc.id_fee, fc.recepit_no, fc.status, f.id_month, fc.challan_no, fc.dated, f.issue_date, f.due_date, f.paid_date, fc.total_amount, c.class_name, cs.section_name, s.session_name, st.std_id, st.std_name, st.std_fathername, st.std_regno, st.std_gender, st.is_hostelized, ad.adm_fullname, (SELECT name FROM ".ADMISSIONS_INQUIRY." WHERE form_no = f.inquiry_formno GROUP BY form_no) as name 
				FROM ".FEES_COLLECTION." fc				   
				INNER JOIN ".FEES." f ON f.challan_no = fc.challan_no	 	
				INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
				LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
				INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
				LEFT JOIN ".STUDENTS." st ON st.std_id = f.id_std 
				INNER JOIN ".ADMINS." ad ON ad.adm_id = fc.id_added  
				WHERE fc.is_deleted = '0' 
				AND fc.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8
				ORDER BY fc.id DESC";
				
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
							<th>Recepit #</th>
							<th>Student</th>
							<th>Father</th>
							<th>Class</th>
							<th>Session</th>
							<th>Month</th>
							<th width="90px;">Issue Date</th>
							<th width="90px;">Due Date</th>
							<th width="90px;">Paid Date</th>
							<th width="90px;">Paid By</th>
							<th width="70px;" class="center">Status</th>
							<th>Total</th>
							<th width="80" class="center">Options</th>
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
							if($rowsvalues['dated'] != '0000-00-00'){$paidDate = $rowsvalues['dated'];}

							$granTotal = $rowsvalues['total_amount'];
							if($rowsvalues['std_name']) { 
								$stdName = $rowsvalues['std_name'];
							} else { 
								$stdName = $rowsvalues['name'];
							}
							$stdFather = '';
                            if($rowsvalues['std_fathername']) { 
								$stdFather .= $rowsvalues['std_fathername']; 
							} 
							echo '
							<tr>
								<td class="center">'.$srno.'</td>
								
								<td>
									<a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/challan_detail.php?challan_no='.$rowsvalues['challan_no'].'\');">
										'.$rowsvalues['challan_no'].' </a>
								</td>
								<td>'.$rowsvalues['recepit_no'].'</td>
								<td>';
								if($rowsvalues['std_id']) {
									echo '<a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/student_details.php?id_std='.$rowsvalues['std_id'].'\');">
										'.$stdName.'  </a>';
								} else {
									echo $stdName;
								}
								echo '
								</td>
								<td>'.$rowsvalues['std_fathername'].'</td>
								<td>'.$rowsvalues['class_name'].' '; if($rowsvalues['section_name']){echo' ('.$rowsvalues['section_name'].') ';} echo'</td>
								<td>'.$rowsvalues['session_name'].'</td>
								<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
								<td>'.$rowsvalues['issue_date'].'</td>
								<td>'.$rowsvalues['due_date'].'</td>
								<td>'.$paidDate.'</td>
								<td>'.$rowsvalues['adm_fullname'].'</td>
								<td class="center">'.get_payments($rowsvalues['status']).'</td>
								<td>'.number_format(round($granTotal)).'</td>
								<td class="center">';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '90', 'delete' => '1'))){ 
									echo'<a href="#" class="btn btn-danger btn-xs mr-xs" onclick="confirm_modal(\'feecollections.php?deleteid='.$rowsvalues['id'].'&challano='.$rowsvalues['id_fee'].'\');"><i class="el el-trash"></i></a> ';
								}
									echo '
									<a class="btn btn-success btn-xs mr-xs" class="center" href="feecashcollectionprint.php?recepitno='.$rowsvalues['recepit_no'].'" target="_blank"> <i class="fa fa-print"></i></a>';
								
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

}