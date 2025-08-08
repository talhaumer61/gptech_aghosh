<?php 

require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

include_once("include/header.php");

if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
    //-----------------------------------------------
	require_once("include/campus/admission_challans/query.php");
    
    echo '
    <title> Admission Challan Panel | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Admission Challan Panel </h2>
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
                
                if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 

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
                    $classComma = "";
                    
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
                            $sql3 = "AND (f.challan_no LIKE '%".$_GET['search_word']."%' OR st.std_name LIKE '%".$_GET['search_word']."%' OR st.std_rollno LIKE '%".$_GET['search_word']."%' OR q.name LIKE '%".$_GET['search_word']."%')";
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
                    $sqllmspaid	= $dblms->querylms("SELECT SUM(f.paid_amount) as total_paid,
                                                    SUM(CASE WHEN c.id_classgroup = '3' THEN f.paid_amount ELSE 0 END) AS teh_paid,
		                                            SUM(CASE WHEN c.id_classgroup != '3' THEN f.paid_amount ELSE 0 END) AS ags_paid
                                                    FROM ".FEES." f		
                                                    INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
                                                    LEFT JOIN ".STUDENTS." st ON st.std_id   = f.id_std		   
                                                    WHERE (f.status = '1' OR f.status = '4') 
                                                    AND f.id_type = '1' AND f.is_deleted != '1'
                                                    AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8
                                                  ");
                    $value_paid = mysqli_fetch_array($sqllmspaid);

                    //------------------- Fee Pending ----------------------------
                    $sqllmspending	= $dblms->querylms("SELECT f.status,
                                                        SUM(f.paid_amount) as total_paid,
                                                        SUM(f.total_amount) as total_amount, 
                                                        SUM(CASE WHEN c.id_classgroup = '3' THEN f.total_amount ELSE 0 END) AS teh_total,
		                                                SUM(CASE WHEN c.id_classgroup != '3' THEN f.total_amount ELSE 0 END) AS ags_total,
                                                        SUM(CASE WHEN c.id_classgroup = '3' THEN f.paid_amount ELSE 0 END) AS teh_paid,
		                                                SUM(CASE WHEN c.id_classgroup != '3' THEN f.paid_amount ELSE 0 END) AS ags_paid
                                                        FROM ".FEES." f
                                                        INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
                                                        LEFT JOIN ".STUDENTS." st ON st.std_id   = f.id_std
                                                        WHERE (f.status = '2' OR f.status = '4') 
                                                        AND f.id_type = '1' AND f.is_deleted != '1'
                                                        AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8
                                                      ");
                    $value_pending = mysqli_fetch_array($sqllmspending);
                    echo '
                    <div class="row row-sm" style="margin-bottom:10px;">
                        <div class="col-lg-4 col-sm-6 col-xs-12 mg-t-20 mg-sm-t-0">
                            <div class="bg-primary  rounded overflow-hidden">
                                <div class="pd-10 d-flex align-items-center">
                                    <i class="fa fa-money tx-40 lh-0 tx-white op-7"></i>
                                    <div class="mg-l-20">
                                        <p class="tx-16 tx-bold tx-spacing-1 tx-bold tx-white-8">Total Receivable</p>
                                        <p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($value_paid['total_paid'] + ($value_pending['total_amount'] - $value_pending['total_paid'])).'</p>
                                        <p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['ags_paid'] + ($value_pending['ags_total'] - $value_pending['ags_paid'])).'</p>
                                        <p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($value_paid['teh_paid'] + ($value_pending['teh_total'] - $value_pending['teh_paid'])).'</p>
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
                                        <p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($value_paid['total_paid']).'</p>
                                        <p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_paid['ags_paid']).'</p>
                                        <p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($value_paid['teh_paid']).'</p>
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
                                        <p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1">'.number_format($value_pending['total_amount'] - $value_pending['total_paid']).'</p>
                                        <p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">AGS: '.number_format($value_pending['ags_total'] - $value_pending['ags_paid']).'</p>
                                        <p class="tx-15 tx-white tx-lato tx-white-8 tx-bold mg-b-2 lh-1">TEH: '.number_format($value_pending['teh_total'] - $value_pending['teh_paid']).'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="panel panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <h2 class="panel-title"><i class="fa fa-list"></i> Admission Challans List</h2>
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label class="control-label">Gender </label>
                                        <select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
                                            <option value="">Select</option>';
                                            foreach($gender as $gndr){
                                                echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
                                            }
                                            echo'
                                        </select>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-offset-5 col-md-2 mt-md mb-md">
                                        <div class="form-group">
                                            <button type="submit" name="show" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>';
                            $sql = "SELECT f.id, f.status, f.id_type, f.id_month, f.challan_no, f.issue_date, f.due_date, f.paid_date, f.total_amount, f.remaining_amount, f.paid_amount,
                            c.class_name, cs.section_name, s.session_name, st.std_id, st.std_name, st.std_fathername, st.std_regno, q.name, q.fathername
                                    FROM ".FEES." f				   
                                    INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
                                    LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
                                    INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
                                    LEFT JOIN ".STUDENTS." st ON st.std_id = f.id_std
                                    LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no = f.inquiry_formno
                                    WHERE f.id_type     = '1'
                                    AND f.is_deleted    = '0'
                                    AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8 
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
                                                <th>Student</th>
                                                <th>Father</th>
                                                <th>Class</th>
                                                <th>Session</th>
                                                <th width="90px;">Issue Date</th>
                                                <th width="90px;">Due Date</th>
                                                <th width="90px;">Paid Date</th>
                                                <th width="70px;" class="center">Status</th>
                                                <th>Total</th>
                                                <th>Remaining</th>
                                                <th width="130" class="center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        
                                            $srno = 0;
                                            
                                            while($rowsvalues = mysqli_fetch_array($sqllms)) {
                                                $srno++;
                                                $paidDate = '';

                                                //Std Details
                                                if($rowsvalues['paid_date'] != '0000-00-00'){$paidDate = $rowsvalues['paid_date'];}
                                                if($rowsvalues['std_name']){ $stdName = $rowsvalues['std_name'];} else {$stdName = $rowsvalues['name'];}
                                                if($rowsvalues['std_fathername']){ $stdFather = $rowsvalues['std_fathername'];} else {$stdFather = $rowsvalues['fathername'];}
                                                
                                                // After Due Date
                                                if(date('Y-m-d') > $rowsvalues['due_date'] && $rowsvalues['status'] != '1') {
                                                    $granTotal = $rowsvalues['total_amount'] + 300;
                                                    $pendingAmount = $rowsvalues['total_amount'] + 300 - $rowsvalues['paid_amount'];
                                                } else {
                                                    $granTotal = $rowsvalues['total_amount'];
                                                    $pendingAmount = $rowsvalues['total_amount'] - $rowsvalues['paid_amount'];
                                                }
                                                
                                                echo '
                                                <tr>
                                                    <td class="center">'.$srno.'</td>
                                                    <td>
                                                        <a href="#show_std_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoomStd(\'include/modals/fee_challans/challan_detail.php?challan_no='.$rowsvalues['challan_no'].'\');">
                                                            '.$rowsvalues['challan_no'].' </a>
                                                    </td>
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
                                                    <td class="center">'.(($pendingAmount>0)?number_format(round($pendingAmount)):"N/A").'</td>
                                                    <td class="center">';
                                                        if($rowsvalues['status'] != '1'){
                                                            // PRINT BUTTON
                                                            echo '<a class="btn btn-success btn-xs mr-xs" class="center" href="feechallanprint.php?id='.$rowsvalues['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
                                                            //EDIT BUTTON
                                                            if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || in_array($_SESSION['userlogininfo']['LOGINIDA'],$FEE_CHALLAN_RIGHTS)){ 
                                                                echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/admission_challans/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> </a>';
                                                            }
                                                            //PARTIAL BUTTON
                                                            if($_SESSION['userlogininfo']['LOGINIDA'] == '4' && $rowsvalues['remaining_amount'] == 0){
                                                            	echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs mr-xs" onclick="showAjaxModalZoom(\'include/modals/admission_challans/partialpayment.php?id='.$rowsvalues['id'].'\');"><img src="assets/images/partial_payment.png" height="15" width="auto"></a>';
                                                            }
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
    <div id="show_std_modal" class="mfp-with-anim modal-block modal-block-lg modal-block-primary mfp-hide" style=" margin:auto;"></div>


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