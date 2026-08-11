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

$sql2 = "";
$search_word = "";
//--------- Filter ---------------
if(isset($_GET['search_word']) && !empty(($_GET['search_word'])))
{
    $sql2 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%')";
    $search_word = $_GET['search_word'];
}

// Paid
$sqllmspaid	= $dblms->querylms("SELECT f.status, SUM(d.amount) as paid
									FROM ".FEES." f				   
                                    INNER JOIN ".DONATION_DETAILS." d ON d.id_donation = f.id
									WHERE f.status = '1' AND f.id_type = '3' AND f.is_deleted != '1' 
                                    AND f.id_donor = '".$_GET['don']."' AND d.id_std = '".$_GET['std']."'
									AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2");
$value_paid = mysqli_fetch_array($sqllmspaid);
if($value_paid['paid']){$paid = $value_paid['paid'];}else{$paid = 0;}
// Pending
$sqllmspending	= $dblms->querylms("SELECT f.status, SUM(d.amount) as pending
                                            FROM ".FEES." f
                                            INNER JOIN ".DONATION_DETAILS." d ON d.id_donation = f.id
                                            WHERE f.status = '2' AND f.id_type = '3' AND f.is_deleted != '1' 
                                            AND f.id_donor = '".$_GET['don']."' AND d.id_std = '".$_GET['std']."'
                                            AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2");
$value_pending = mysqli_fetch_array($sqllmspending);
if($value_pending['pending']){$pending = $value_pending['pending'];}else{$pending = 0;}

echo '
<div id="donation" class="tab-pane active">
    <div class="row mt-none mb-md">
        <div class="col-sm-12 col-md-12 col-lg-3 bg bg-info card mb-sm">
            <i class="fa fa-money" aria-hidden="true"></i> Payable
            <p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid + $pending).'</p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 bg bg-success card mb-sm">
            <i class="fa fa-star" aria-hidden="true"></i> Paid
            <p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid).'</p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 bg bg-warning card mb-sm">
            <i class="fa fa-refresh" aria-hidden="true"></i> Pending
            <p class="val mt-md"><span class="span">Rs:</span> '.number_format($pending).'</p>
        </div>
    </div>
    <fieldset class="mt-lg mb-md">
        <div class="panel-body">
            <!-- <form action="donations.php?std='.$_GET['std'].'&don='.$_GET['don'].'" method="GET" autocomplete="off">
                <div class="form-group mb-sm">
                    <div class="col-sm-3 col-sm-offset-8">
                        <div class="form-group">
                            <input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="width: 90px;"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </form> -->';
            //------------- Pagination ---------------------
            $sqlstring	    = "";
            $adjacents = 3;
            if(!($Limit)) 	{ $Limit = 50; } 
            if($page)		{ $start = ($page - 1) * $Limit; } else {	$start = 0;	}
            //------------------------------------------------
            $sqllms	= $dblms->querylms("SELECT f.id
                                            FROM ".FEES." f
                                            INNER JOIN ".DONATION_DETAILS." d ON d.id_donation = f.id
                                            WHERE f.id != '' AND f.id_type = '3' AND f.is_deleted != '1'  
                                            AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2
                                            AND f.id_donor = '".cleanvars($_GET['don'])."' AND d.id_std = '".cleanvars($_GET['std'])."' 
                                            ORDER BY f.challan_no DESC ");
            //--------------------------------------------------
            $count = mysqli_num_rows($sqllms);
            if($page == 0) { $page = 1; }						//if no page var is given, default to 1.
            $prev 		    = $page - 1;							//previous page is page - 1
            $next 		    = $page + 1;							//next page is page + 1
            $lastpage  		= ceil($count/$Limit);					//lastpage is = total pages / items per page, rounded up.
            $lpm1 		    = $lastpage - 1;
            //--------------------------------------------------  
            $sqllms	= $dblms->querylms("SELECT f.id, f.status, f.challan_no, f.id_month, f.to_month, f.due_date, f.paid_date, f.total_amount, f.pay_mode, d.amount
                                            FROM ".FEES." f
                                            INNER JOIN ".DONATION_DETAILS." d ON d.id_donation = f.id 
                                            WHERE f.id != '' AND f.id_type = '3' AND f.is_deleted != '1'
                                            AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2
                                            AND f.id_donor = '".cleanvars($_GET['don'])."' AND d.id_std = '".cleanvars($_GET['std'])."' 
                                            ORDER BY f.challan_no DESC LIMIT ".($page-1)*$Limit .",$Limit");
            //---------------------------------------------------
            if(mysqli_num_rows($sqllms) > 0){
                echo'
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Challan #</th>
                                <th>Month</th>
                                <th>Due Date</th>
                                <th>Paid Date</th>
                                <th>Pay Mode</th>
                                <th>Total</th>
                                <th width="70px;" class="center">Status</th>
                                <th width="100" class="center">Options</th>
                            </tr>
                        </thead>
                        <tbody>';
                            $srno = 0;
                            //-----------------------------------------------------
                            while($rowsvalues = mysqli_fetch_array($sqllms)) {
                                //-----------------------------------------------------
                                $srno++;
                                $paidDate = '';
                                $paidMode = '';
                                // Paid Date
                                if($rowsvalues['paid_date'] != '0000-00-00'){$paidDate = $rowsvalues['paid_date'];}
                                // Paid Mode
                                if($rowsvalues['pay_mode'] != '0' && $rowsvalues['status'] == 1){$paidMode = get_paymethod($rowsvalues['pay_mode']);}
                                
                                // Challan For Month
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
                                    <td>'.$rowsvalues['due_date'].'</td>
                                    <td>'.$paidDate.'</td>
                                    <td class="center">'.$paidMode.'</td>
                                    <td>'.number_format(round($rowsvalues['amount'])).'</td>
                                    <td class="center">'.get_payments($status).'</td>
                                    <td class="center">
                                        <a class="btn btn-success btn-xs" data-toggle="tooltip" title="Print Challan" href="donationchallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
                                        if($status == 2) {
                                            echo'<a class="btn btn-info btn-xs ml-xs" data-toggle="tooltip" title="PayPro Payment" href="payProPayment.php?challan_no='.$rowsvalues['challan_no'].'" target="_blank"><img src="assets/images/partial_payment.png" height="15" width="auto"></a>';
                                        }
                                        echo'
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
                    // $current_page = strstr(basename($_SERVER['REQUEST_URI']), '.php', true);
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
    </fieldset>
</div>';