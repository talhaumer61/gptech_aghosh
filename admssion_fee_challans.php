<?php 

require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

include_once("include/header.php");

if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
    
	require_once("include/campus/admission_challans/query.php");
	require_once("include/campus/fee_challans/query_feechallans.php");
    
    echo'
    <title> Challan Panel | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Challan Panel </h2>
        </header>
        <!-- INCLUDEING PAGE -->
        <div class="row">
            <div class="col-md-12">';
                echo'
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
                    font-si ze:14px;
                    }
                </style>';
                
                $sql2 = "";
                $sql3 = "";
                $sql4 = "";
                $sql5 = "";
                $sql6 = "";
                $search_word = "";
                $paid_date = "";
                $pay_through = "";
                $status = "";
                $class = "";
                $filters = "";
                //--------- FIlters ----------
                if(isset($_GET['show']))
                {
                    //  word
                    if(isset($_GET['search_word']))
                    {
                        $sql2 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%' OR st.std_name LIKE '%".$_GET['search_word']."%' OR st.std_rollno LIKE '%".$_GET['search_word']."%')";
                        $search_word = $_GET['search_word'];
                    }
                    // Date
                    if($_GET['paid_date'])
                    {
                        $sql3 = "AND f.paid_date = '".date('Y-m-d', strtotime($_GET['paid_date']))."' AND f.paid_date != '0000-00-00' ";
		                if(!empty($_GET['paid_date'])){$paid_date = date('m/d/Y', strtotime($_GET['paid_date']));} else {$paid_date = '';}
                    }
                    // pay method
                    if($_GET['method'])
                    {
                        $sql4 = "AND f.pay_mode = '".$_GET['method']."'";
                        $pay_through = $_GET['method'];
                    }
                    // status
                    if($_GET['status'])
                    {
                        $sql5 = "AND f.status = '".$_GET['status']."'";
                        $status = $_GET['status'];
                    }
                    //  class
                    if($_GET['id_class'])
                    {
                        $sql6 = "AND f.id_class = '".$_GET['id_class']."'";
                        $class = $_GET['id_class'];
                    }
                }
                
                if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
                    
                    //-------------------- Fee Paid -----------------------------
                    $sqllmspaid	= $dblms->querylms("SELECT f.status, SUM(f.paid_amount) as paid
                                                    FROM ".FEES." f				   
                                                    WHERE (f.status = '1' OR f.status = '4')
                                                    AND f.id_type IN (1,2)
                                                    AND f.is_deleted    = '0' 
                                                    AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2 $sql3 $sql4 $sql5 $sql6");
                    $value_paid = mysqli_fetch_array($sqllmspaid);
                    if($value_paid['paid']){$paid = $value_paid['paid'];}else{$paid = 0;}

                    //------------------- Fee Pending ----------------------------
                    $sqllmspending	= $dblms->querylms("SELECT f.status, SUM(f.total_amount) as total, SUM(f.paid_amount) as paid
                                                        FROM ".FEES." f
                                                        WHERE (f.status = '2' OR f.status = '4') 
                                                        AND f.id_type IN (1,2)
                                                        AND f.is_deleted    = '0' 
                                                        AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8");
                    $value_pending = mysqli_fetch_array($sqllmspending);
                    $TotalPending = $value_pending['total'] - $value_pending['paid'];
                    if($TotalPending){$pending = $TotalPending;}else{$pending = 0;}
                   
                    echo '
                    <div class="row mt-none mb-md">
                        <div class="col-sm-12 col-md-12 col-lg-3 bg bg-info card mb-sm">
                            <i class="fa fa-money" aria-hidden="true"></i> Total Receivable
                            <p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid + $pending).'</p>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 bg bg-success card mb-sm">
                            <i class="fa fa-star" aria-hidden="true"></i> Total Paid
                            <p class="val mt-md"><span class="span">Rs:</span> '.number_format($paid).'</p>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 bg bg-warning card mb-sm">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Total Pending
                            <p class="val mt-md"><span class="span">Rs:</span> '.number_format($pending).'</p>
                        </div>
                    </div>
                    <section class="panel panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <h2 class="panel-title"><i class="fa fa-list"></i> Admission and Fee Challans List</h2>
                        </header>
                        <div class="panel-body">
                            <form action="#" method="GET" autocomplete="off">
                                <div class="form-group mb-sm">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Search </label>
                                            <input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Paid Date </label>
                                        <input type="text" class="form-control" name="paid_date" id="paid_date" value="'.$paid_date.'" data-plugin-datepicker/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Paid Through </label>
                                        <select class="form-control" data-plugin-selectTwo data-width="100%" name="method">
                                            <option value="">Select</option>';
                                            foreach($paymethod as $method){
                                                echo '<option value="'.$method['id'].'"'; if($pay_through == $method['id']){ echo'selected';} echo'>'.$method['name'].'</option>';
                                            }
                                            echo'
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Status </label>
                                        <select class="form-control" data-plugin-selectTwo data-width="100%" name="status">
                                            <option value="">Select</option>';
                                            foreach($payments as $stat){
                                                echo '<option value="'.$stat['id'].'"'; if($status == $stat['id']){ echo'selected';} echo'>'.$stat['name'].'</option>';
                                            }
                                            echo'
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Class </label>
                                        <select class="form-control" data-plugin-selectTwo data-width="100%" name="id_class">
                                            <option value="">Select</option>
                                            <option value="" selected>All</option>';
                                                $sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
                                                                    FROM ".CLASSES." 
                                                                    WHERE class_status = '1'
                                                                    AND is_deleted != '1'
                                                                    ORDER BY class_id ASC");
                                                while($valuecls = mysqli_fetch_array($sqllmscls)) {
                                                    echo '<option value="'.$valuecls['class_id'].'"'; if($class == $valuecls['class_id']){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
                                                }
                                                echo '
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group mt-xl">
                                            <button type="submit" name="show" class="btn btn-primary" style="width: 90px;"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>';
                            //------------- Pagination ---------------------
                            $sqlstring	    = "";
                            $adjacents = 3;
                            if(!($Limit)) 	{ $Limit = 50; }
                            if($page)		{ $start = ($page - 1) * $Limit; } else {	$start = 0;	}

                            $sql = "SELECT f.id, f.status, f.id_type, f.id_month, f.challan_no, f.issue_date, f.due_date, f.paid_date, f.total_amount, f.remaining_amount,
                                    c.class_name, cs.section_name, s.session_name, st.std_id, st.std_name, st.std_fathername, st.std_regno, q.name, q.fathername
                                    FROM ".FEES." f				   
                                    INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
                                    LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
                                    INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
                                    LEFT JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std
                                    LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no = f.inquiry_formno
                                    WHERE f.id_type IN(1,2)
                                    AND f.is_deleted != '1'
                                    AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql2 $sql3 $sql4 $sql5 $sql6
                                    ORDER BY f.id DESC";
                            $sqllms	= $dblms->querylms($sql);          
                            $count = mysqli_num_rows($sqllms);
                            if($page == 0) { $page = 1; }						
                            $prev 		    = $page - 1;							
                            $next 		    = $page + 1;							
                            $lastpage  		= ceil($count/$Limit);					
                            $lpm1 		    = $lastpage - 1;
                            $sqllms	= $dblms->querylms("$sql  LIMIT ".($page-1)*$Limit .",$Limit");
		                    if(mysqli_num_rows($sqllms) > 0){
                                echo'
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Challan #</th>
                                                <th>Type</th>
                                                <th>Student</th>
                                                <th>Father</th>
                                                <th>Class</th>
                                                <th>Session</th>
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
                                            while($rowsvalues = mysqli_fetch_array($sqllms)) {
                                                $srno++;
                                                $paidDate = '';
                                                // Std Details
                                                if($rowsvalues['paid_date'] != '0000-00-00'){$paidDate = $rowsvalues['paid_date'];}
                                                if($rowsvalues['std_name']){ $stdName = $rowsvalues['std_name'];} else {$stdName = $rowsvalues['name'];}
                                                if($rowsvalues['std_fathername']){ $stdFather = $rowsvalues['std_fathername'];} else {$stdFather = $rowsvalues['fathername'];}
                                                
                                                // After Due Date
                                                if(date('Y-m-d') > $rowsvalues['due_date']) {
                                                    $granTotal = $rowsvalues['total_amount'] + 300;
                                                } else {
                                                    $granTotal = $rowsvalues['total_amount'];
                                                }
                                                // Path For Modals
                                                if($rowsvalues['id_type'] == 1){
                                                    $editPath = 'admission_challans/update.php';
                                                    $partialPath = 'admission_challans/partialpayment.php';

                                                } else if($rowsvalues['id_type'] == 2){
                                                    $editPath = 'fee_challans/modal_feechallan_update.php';
                                                    $partialPath = 'fee_challans/modal_feechallan_partialpayment.php';
                                                }else {
                                                    $editPath = '';
                                                    $partialPath = '';
                                                }
                                                echo '
                                                <tr>
                                                    <td class="center">'.$srno.'</td>
                                                    <td>
                                                        <a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/challan_detail.php?challan_no='.$rowsvalues['challan_no'].'\');">
                                                            '.$rowsvalues['challan_no'].' </a>
                                                    </td>
                                                    <td>'.get_challantype($rowsvalues['id_type']).'</td>
                                                    <td>';
                                                        if($rowsvalues['std_id']) {
                                                            echo'<a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/student_details.php?id_std='.$rowsvalues['std_id'].'\');">
                                                            '.$stdName.'  </a>';
                                                        } else {
                                                            echo $stdName;
                                                        }
                                                        echo'
                                                    </td>
                                                    <td>'.$stdFather.'</td>
                                                    <td>'.$rowsvalues['class_name'].' '; if($rowsvalues['section_name']){echo' ('.$rowsvalues['section_name'].') ';} echo'</td>
                                                    <td>'.$rowsvalues['session_name'].'</td>
                                                    <td>'.$rowsvalues['issue_date'].'</td>
                                                    <td>'.$rowsvalues['due_date'].'</td>
                                                    <td>'.$paidDate.'</td>
                                                    <td class="center">'.get_payments($rowsvalues['status']).'</td>
                                                    <td>'.number_format(round($granTotal)).'</td>
                                                    <td class="center">';
                                                    $sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
                                                                                        FROM ".FEES." f						 
                                                                                        INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
                                                                                        WHERE f.id_type IN (1,2)
                                                                                        AND f.status		= '2'
                                                                                        AND f.is_deleted	= '0'
                                                                                        AND f.id_std		= '".cleanvars($rowsvalues['std_id'])."'
                                                                                        AND st.is_deleted	= '0'
                                                                                        AND f.id_campus		= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                                                        ORDER BY f.id DESC LIMIT 1");
                                                    $valuesqllmscheck = mysqli_fetch_array($sqllmscheck);
                                                    if($valuesqllmscheck['challan_no'] == $rowsvalues['challan_no']){
                                                        //PRINT BUTTON
                                                        echo'<a class="btn btn-success btn-xs mr-xs" class="center" href="feechallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
                                                        //EDIT BUTTON
                                                        if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || in_array($_SESSION['userlogininfo']['LOGINTYPE'],$FEE_CHALLAN_RIGHTS) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'edit' => '1'))){ 
                                                            echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/fee_challans/modal_feechallan_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
                                                        }
                                                        //DELETE BUTTON
                                                        if((($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'delete' => '1'))) && $rowsvalues['status'] !=4){ 
                                                            echo '<a href="#" class="btn btn-danger btn-xs mr-xs" onclick="confirm_modal(\'fee_challans.php?deleteid='.$rowsvalues['challan_no'].'\');"><i class="el el-trash"></i></a>';
                                                        }
                    
                                                    }elseif($rowsvalues['status'] != '1'){
                                                        //EDIT BUTTON
                                                        if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || in_array($_SESSION['userlogininfo']['LOGINTYPE'],$FEE_CHALLAN_RIGHTS)){ 
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
                                //-------------- Pagination ------------------
                                if($count>$Limit) {
                                    echo '
                                    <div class="widget-foot">
                                    <!--WI_PAGINATION-->
                                    <ul class="pagination pull-right">';
                                    //--------------------------------------------------
                                    $current_page = strstr(basename($_SERVER['REQUEST_URI']), '.php', true);
                                    $filters = 'search_word='.$search_word.'&paid_date='.$paid_date.'&method='.$pay_through.'&status='.$status.'&id_class='.$class.'&show';
                                    //--------------------------------------------------
                                    $pagination = "";
                                    if($lastpage > 1) { 
                                    //previous button
                                    if ($page > 1) {
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$prev.$sqlstring.'"><span class="fa fa-chevron-left"></span></a></a></li>';
                                    }
                                    //pages 
                                    if ($lastpage < 7 + ($adjacents * 3)) { //not enough pages to bother breaking it up
                                        for ($counter = 1; $counter <= $lastpage; $counter++) {
                                            if ($counter == $page) {
                                                $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
                                            } else {
                                                $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
                                            }
                                        }
                                    } else if($lastpage > 5 + ($adjacents * 3)) { //enough pages to hide some
                                    //close to beginning; only hide later pages
                                        if($page < 1 + ($adjacents * 3)) {
                                            for ($counter = 1; $counter < 4 + ($adjacents * 3); $counter++) {
                                                if ($counter == $page) {
                                                    $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
                                                } else {
                                                    $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
                                                }
                                            }
                                            $pagination.= '<li><a href="#"> ... </a></li>';
                                            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
                                            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
                                    } else if($lastpage - ($adjacents * 3) > $page && $page > ($adjacents * 3)) { //in middle; hide some front and some back
                                            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=1'.$sqlstring.'">1</a></li>';
                                            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=2'.$sqlstring.'">2</a></li>';
                                            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=3'.$sqlstring.'">3</a></li>';
                                            $pagination.= '<li><a href="#"> ... </a></li>';
                                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                            if ($counter == $page) {
                                                $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
                                            } else {
                                                $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
                                            }
                                        }
                                        $pagination.= '<li><a href="#"> ... </a></li>';
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
                                    } else { //close to end; only hide early pages
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=1'.$sqlstring.'">1</a></li>';
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=2'.$sqlstring.'">2</a></li>';
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=3'.$sqlstring.'">3</a></li>';
                                        $pagination.= '<li><a href="#"> ... </a></li>';
                                        for ($counter = $lastpage - (3 + ($adjacents * 3)); $counter <= $lastpage; $counter++) {
                                            if ($counter == $page) {
                                                $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
                                            } else {
                                                $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
                                            }
                                        }
                                    }
                                    }
                                    //next button
                                    if ($page < $counter - 1) {
                                        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$next.$sqlstring.'"><span class="fa fa-chevron-right"></span></a></li>';
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
            echo '
            </div>
        </div>';
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
    <?php 
    
    if(isset($_SESSION['msg'])) { 
        
            echo 'new PNotify({
                    title	: "'.$_SESSION['msg']['title'].'"	,
                    text	: "'.$_SESSION['msg']['text'].'"	,
                    type	: "'.$_SESSION['msg']['type'].'"	,
                    hide	: true	,
                    buttons: {
                        closer	: true	,
                        sticker	: false
                    }
                });';
                
        unset($_SESSION['msg']);
        
    }
    
    ?>	
    var datatable = $('#table_export').dataTable({
                bAutoWidth : false,
                ordering: false,
            });
        });

        function get_feeclasssection(id_class) {  
            $("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
            $.ajax({  
                type: "POST",  
                url: "include/ajax/get_feeclasssection.php",  
                data: "id_class="+id_class,  
                success: function(msg){  
                    $("#getfeeclasssection").html(msg); 
                    $("#loading").html(''); 
                }
            });  
        }
    </script>
    <?php 
    
    echo '
    </section>
    </div>
    </section>	
    <!-- INCLUDES MODAL -->
    <script type="text/javascript">
        function showAjaxModalZoom( url ) {
    // PRELODER SHOW ENABLE / DISABLE
            jQuery( \'#show_modal\' ).html( \'<div class="center "><img src="assets/images/preloader.gif" /></div>\' );
    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
            $.ajax( {
                url: url,
                success: function ( response ) {
                    jQuery( \'#show_modal\' ).html( response );
                }
            } );
        }
    </script>
    <!-- (STYLE AJAX MODAL)-->
    <div id="show_modal" class="mfp-with-anim modal-block modal-block-lg modal-block-primary mfp-hide"></div>


        
    <!-- INCLUDES MODAL -->
    <script type="text/javascript">
        function showAjaxModalZoomStd( url ) {
    // PRELODER SHOW ENABLE / DISABLE
            jQuery( \'#show_std_modal\' ).html( \'<div class="center "><img src="assets/images/preloader.gif" /></div>\' );
    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
            $.ajax( {
                url: url,
                success: function ( response ) {
                    jQuery( \'#show_std_modal\' ).html( response );
                }
            } );
        }
    </script>
    <!-- (STYLE AJAX MODAL)-->
    <div id="show_std_modal" class="mfp-with-anim modal-block-primary mfp-hide" style="width: 70%; margin:auto;"></div>


    <script type="text/javascript">
        function confirm_modal( delete_url ) {
            swal( {
                title: "Are you sure?",
                text: "Are you sure that you want to delete this information?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#ec6c62"
            }, function () {
                window.location.href = delete_url;
            } );
        }
    </script>    
    <!-- INCLUDES BOTTOM -->';
    
}
else
{
    header("location: dashboard.php");
}

include_once("include/footer.php");

?>