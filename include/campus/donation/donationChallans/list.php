
<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'view' => '1'))){ 

	$sql2 = "";
	$search_word = "";
	//--------- Filter ---------------
	if(isset($_GET['search_word']))
	{
		$sql2 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%' OR d.donor_name LIKE '%".$_GET['search_word']."%')";
		$search_word = $_GET['search_word'];
	}
	//-------------------------------
	echo'
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<a href="#printReport" class="modal-with-move-anim ml-sm btn btn-primary btn-xs pull-right"><i class="fa fa-print"></i> Print Report</a>';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'add' => '1'))){ 
				echo'<a href="donationChallans.php?view=bulk" class="btn btn-primary ml-sm btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Bulk Challan</a>
				<a href="donationChallans.php?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Single Challan</a>';
			}
			echo'
			<h2 class="panel-title"><i class="fa fa-list"></i> Donation Challans List</h2>
		</header>
		<div class="panel-body">
			<form action="#" method="GET" autocomplete="off">
				<div class="form-group mb-sm">
					<div class="col-sm-3 col-sm-offset-8">
						<div class="form-group">
							<input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search">
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							<button type="submit" class="btn btn-primary" style="width: 90px;;"><i class="fa fa-search"></i> Search</button>
						</div>
					</div>
				</div>
			</form>';
			//------------- Pagination ---------------------
			$sqlstring	    = "";
			$adjacents = 3;
			if(!($Limit)) 	{ $Limit = 50; } 
			if($page)		{ $start = ($page - 1) * $Limit; } else {	$start = 0;	}
			//------------------------------------------------
			$sqllms	= $dblms->querylms("SELECT f.id
											FROM ".FEES." f			   
											INNER JOIN ".DONORS." d ON d.donor_id = f.id_donor 	
											WHERE f.id != '' AND f.id_type = '3' 
											AND f.is_deleted != '1'  $sql2");
			//--------------------------------------------------
			$count = mysqli_num_rows($sqllms);
			if($page == 0) { $page = 1; }						//if no page var is given, default to 1.
			$prev 		    = $page - 1;							//previous page is page - 1
			$next 		    = $page + 1;							//next page is page + 1
			$lastpage  		= ceil($count/$Limit);					//lastpage is = total pages / items per page, rounded up.
			$lpm1 		    = $lastpage - 1;
			//--------------------------------------------------  
			$sqllmsDonation	= $dblms->querylms("SELECT f.status, f.challan_no, f.id_month, f.to_month, f.issue_date, f.due_date, f.paid_date, f.total_amount, f.remaining_amount, d.donor_name
											FROM ".FEES." f			   
											INNER JOIN ".DONORS." d ON d.donor_id = f.id_donor 	
											WHERE f.id != '' AND f.id_type = '3' 
											AND f.is_deleted != '1'  $sql2
											ORDER BY f.id DESC  LIMIT ".($page-1)*$Limit .",$Limit");
			//---------------------------------------------------
			if(mysqli_num_rows($sqllmsDonation) > 0){
				echo'
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed mb-none">
						<thead>
							<tr>
								<th class="center">#</th>
								<th>Challan #</th>
								<th>Of Month</th>
								<th>Donor</th>
								<th>Issue Date</th>
								<th>Due Date</th>
								<th>Total</th>
								<th>Balance</th>
								<th width="70px;" class="center">Status</th>
								<th width="100" class="center">Options</th>
							</tr>
						</thead>
						<tbody>';
							$srno = 0;
							//-----------------------------------------------------
							while($rowsvalues = mysqli_fetch_array($sqllmsDonation)) {
								//-----------------------------------------------------
								$srno++;
								$paidDate = '';
								// Challan For Month
								if($rowsvalues['paid_date'] != '0000-00-00'){$paidDate = $rowsvalues['paid_date'];}

								if($rowsvalues['id_month'] == $rowsvalues['to_month'] || $rowsvalues['to_month'] == '0') {
									$month = get_monthtypes($rowsvalues['id_month']);
								} else {
									$month = get_monthtypes($rowsvalues['id_month']).' To '. get_monthtypes($rowsvalues['to_month']);
								}
								//---------------- Online Payment ----------------------
								$sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
																	FROM ".PAY_API_TRAN." 
																	WHERE challan_no = '".cleanvars($rowsvalues['challan_no'])."'");
								$onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
								if($rowsvalues['status'] == 1){
									$status = '1';
								} elseif($onlinePaid['total_paid'] < $rowsvalues['total_amount'] && $onlinePaid['total_paid'] != 0){
									$status = 4;
								} else {

									$status = $rowsvalues['status'];
								}
								//-----------------------------------------------------
								echo '
								<tr>
									<td class="center">'.$srno.'</td>
									<td>'.$rowsvalues['challan_no'].'</td>
									<td>'.$month.'</td>
									<td>'.$rowsvalues['donor_name'].'</td>
									<td>'.$rowsvalues['issue_date'].'</td>
									<td>'.$rowsvalues['due_date'].'</td>
									<td>'.number_format(round($rowsvalues['total_amount'])).'</td>
									<td>'.number_format(round($rowsvalues['remaining_amount'])).'</td>
									<td class="center">'.get_payments($status).'</td>
									<td class="center">';
									echo '
										<a class="btn btn-success btn-xs" class="center" href="donationchallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
										if($rowsvalues['status'] != '1'){
											if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'edit' => '1'))){ 
												echo '<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs ml-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/donation/donationChallans/update.php?id='.$rowsvalues['challan_no'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
											}
											if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'delete' => '1'))){ 
												echo '<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'donationChallans.php?deleteid='.$rowsvalues['challan_no'].'\');"><i class="el el-trash"></i></a>';
											}
										}
										echo '
									</td>
								</tr>';
							}
							echo '
						</tbody>
					</table>
				</div>';
				//-------------- Pagination ------------------
				if($count>$Limit) {
					echo '
					<div class="widget-foot">
					<!--WI_PAGINATION-->
					<ul class="pagination pull-right">';
					//--------------------------------------------------
					$current_page = strstr(basename($_SERVER['REQUEST_URI']), '.php', true);
					//--------------------------------------------------
					$pagination = "";
					if($lastpage > 1) { 
					//previous button
					if ($page > 1) {
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$prev.$sqlstring.'"><span class="fa fa-chevron-left"></span></a></a></li>';
					}
					//pages 
					if ($lastpage < 7 + ($adjacents * 3)) { //not enough pages to bother breaking it up
						for ($counter = 1; $counter <= $lastpage; $counter++) {
							if ($counter == $page) {
								$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
							} else {
								$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
							}
						}
					} else if($lastpage > 5 + ($adjacents * 3)) { //enough pages to hide some
					//close to beginning; only hide later pages
						if($page < 1 + ($adjacents * 3)) {
							for ($counter = 1; $counter < 4 + ($adjacents * 3); $counter++) {
								if ($counter == $page) {
									$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
								} else {
									$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
								}
							}
							$pagination.= '<li><a href="#"> ... </a></li>';
							$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
							$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
					} else if($lastpage - ($adjacents * 3) > $page && $page > ($adjacents * 3)) { //in middle; hide some front and some back
							$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page=1'.$sqlstring.'">1</a></li>';
							$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page=2'.$sqlstring.'">2</a></li>';
							$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page=3'.$sqlstring.'">3</a></li>';
							$pagination.= '<li><a href="#"> ... </a></li>';
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
							if ($counter == $page) {
								$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
							} else {
								$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
							}
						}
						$pagination.= '<li><a href="#"> ... </a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
					} else { //close to end; only hide early pages
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page=1'.$sqlstring.'">1</a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page=2'.$sqlstring.'">2</a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page=3'.$sqlstring.'">3</a></li>';
						$pagination.= '<li><a href="#"> ... </a></li>';
						for ($counter = $lastpage - (3 + ($adjacents * 3)); $counter <= $lastpage; $counter++) {
							if ($counter == $page) {
								$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
							} else {
								$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
							}
						}
					}
					}
					//next button
					if ($page < $counter - 1) {
						$pagination.= '<li><a href="'.$current_page.'.php?search_word='.$search_word.'&page='.$next.$sqlstring.'"><span class="fa fa-chevron-right"></span></a></li>';
					} else {
						$pagination.= "";
					}
						echo $pagination;
					}
					echo '
					</ul>
					<!--WI_PAGINATION-->
						<div class="clearfix"></div>
					</div>';
				}
				
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