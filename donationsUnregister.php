<?php 
//-----------------------------------------------
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
include_once("include/header.php");
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '80'))) {
	echo '
	<title> Unregister Donations | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Unregister Donations </h2>
        </header>
        <!-- INCLUDEING PAGE -->
        <div class="row">
            <div class="col-md-12">';
            $sql2 = "";
            $search_word = "";
            //--------- Filter ---------------
            if(isset($_GET['search_word']))
            {
                $sql2 = "AND (challan_no LIKE '%".$_GET['search_word']."%' OR first_name LIKE '%".$_GET['search_word']."%' OR last_name LIKE '%".$_GET['search_word']."%')";
                $search_word = $_GET['search_word'];
            }
            //-------------------------------
            echo '
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="fa fa-list"></i> Unregister Donations List</h2>
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
                    $sqllms	= $dblms->querylms("SELECT id
                                                    FROM ".DONATION_UNREGISTER." f			   
                                                    WHERE id != ''  $sql2");
                    //--------------------------------------------------
                    $count = mysqli_num_rows($sqllms);
                    if($page == 0) { $page = 1; }						//if no page var is given, default to 1.
                    $prev 		    = $page - 1;							//previous page is page - 1
                    $next 		    = $page + 1;							//next page is page + 1
                    $lastpage  		= ceil($count/$Limit);					//lastpage is = total pages / items per page, rounded up.
                    $lpm1 		    = $lastpage - 1;
                    //--------------------------------------------------  
                    $sqllms	= $dblms->querylms("SELECT *
                                                    FROM ".DONATION_UNREGISTER."	
                                                    WHERE id != '' $sql2
                                                    ORDER BY id DESC  LIMIT ".($page-1)*$Limit .",$Limit");
                    //---------------------------------------------------
                    if(mysqli_num_rows($sqllms) > 0){
                        echo'
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed mb-none">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Challan #</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Issue Date</th>
                                        <th>Country</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th width="70px;" class="center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $srno = 0;
                                    //-----------------------------------------------------
                                    while($rowsvalues = mysqli_fetch_array($sqllms)) {
                                        $srno++;
                                        echo '
                                        <tr>
                                            <td class="center">'.$srno.'</td>
                                            <td>'.$rowsvalues['challan_no'].'</td>
                                            <td>'.$rowsvalues['first_name'].' '.$rowsvalues['last_name'].'</td>
                                            <td>'.$rowsvalues['phone'].'</td>
                                            <td>'.$rowsvalues['email'].'</td>
                                            <td>'.$rowsvalues['issue_date'].'</td>
                                            <td>'.get_country($rowsvalues['id_country']).'</td>
                                            <td>'.get_donType($rowsvalues['id_purpose']).'</td>
                                            <td align="right">'.number_format(round($rowsvalues['amount'])).'</td>
                                            <td class="center">'.get_payments($rowsvalues['status']).'</td>
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
            </section>
            </div>
        </div>
    </section>';
} else {
    header("location: dashboard.php");
}

include_once("include/footer.php");
?>