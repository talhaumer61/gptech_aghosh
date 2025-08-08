<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
//-----------------------------------------------
	include_once("include/header.php");
	
//-----------------------------------------------
    $addClassSQL = '';
    if(isset($_POST['id_class'])){
        if(cleanvars($_POST['id_class']) != 'all'){
            $addClassSQL = "AND f.id_class = '".cleanvars($_POST['id_class'])."'";
        }
    }
    
    $sql1 = "";
    $sql2 = "";
    $sql3 = "";
    $sql4 = "";
    $sql5 = "";
    $sql6 = "";
    $search_word = "";
    $type = "";
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
                $sql1 = '';
                $classComma = '';
            }else{
                $sql1 = "AND f.id_class IN (".implode(", ",$arrayClass).")";
                $classComma = implode(", ",$arrayClass);
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
        // if(isset($_GET['search_word']) && !empty($_GET['search_word'])){
        //     $sql3 = "AND (f.challan_no LIKE '%".cleanvars($_GET['search_word'])."%' OR st.std_name LIKE '%".cleanvars($_GET['search_word'])."%' OR c.class_name LIKE '%".cleanvars($_GET['search_word'])."%' OR st.std_rollno LIKE '%".cleanvars($_GET['search_word'])."%')";
        //     $search_word = cleanvars($_GET['search_word']);
        // }
        // status
        // if($_GET['type']){
        //     $sql4 = "AND f.id_type = '".cleanvars($_GET['type'])."'";
        //     $type = cleanvars($_GET['type']);
        // }
        //  std_gender
        if($_GET['std_gender']){
            $sql5 = "AND st.std_gender = '".$_GET['std_gender']."'";
            $std_gender = $_GET['std_gender'];
        }
        //	is_hostelized
        if($_GET['is_hostelized']){
            if($_GET['is_hostelized']==1){
                $sql6 = "AND st.is_hostelized = '1'";
                $is_hostelized = $_GET['is_hostelized'];
            }else{
                $sql6 = "AND st.is_hostelized != '1'";
                $is_hostelized = $_GET['is_hostelized'];
            }
        }
    }

    $filters = 'id_class2='.$classComma.'&std_gender='.$std_gender.'&is_hostelized='.$is_hostelized.'&show';

    echo '
    <title> Fee Defaulter List | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Fee Defaulter List </h2>
        </header>
    <!-- INCLUDEING PAGE -->
    <div class="row">
    <div class="col-md-12">
        <section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <a href="feedefaulterlistprint.php?id_class2='.$classComma.'&std_gender='.$std_gender.'&is_hostelized='.$is_hostelized.'&type=1" target="_blank" class="ml-sm btn btn-primary btn-xs pull-right"><i class="fa fa-print"></i> Print Class Defaulters Report</a>
                <a href="feedefaulterlistprint.php?id_class2='.$classComma.'&std_gender='.$std_gender.'&is_hostelized='.$is_hostelized.'&type=2" target="_blank" class="ml-sm btn btn-primary btn-xs pull-right"><i class="fa fa-print"></i> Print Defaulters Summary Report</a>
            
                <h2 class="panel-title"><i class="fa fa-list"></i> Fee Defaulter List</h2>
            </header>
            <div class="panel-body">
                <form action="#" method="GET" autocomplete="off">
                    <div class="form-group mb-sm">
                        <!--
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Search </label>
                                <input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Challan </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="type">
                                <option value="">Select</option>';
                                foreach($challanType as $chllType){
                                    if($chllType['id'] <= 2){
                                        echo '<option value="'.$chllType['id'].'"'; if($type == $chllType['id']){ echo'selected';} echo'>'.$chllType['name'].'</option>';
                                    }
                                }
                                echo'
                            </select>
                        </div>
                        -->
                        <div class="col-md-5">
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
                        <div class="col-sm-1">
                            <div class="form-group mt-xl">
                                <button type="submit" name="show" class="btn btn-primary btn-block"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';
                $sql = "SELECT f.id, f.status, f.id_month, f.challan_no, f.issue_date, f.due_date, f.paid_date, f.total_amount,
                c.class_name, cs.section_name, s.session_name, st.std_id, st.std_name, st.std_regno
                        FROM ".FEES." f				   
                        INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
                        LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
                        INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
                        INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
                        WHERE (f.status = '2' OR f.status = '4') $sql1 $sql2 $sql5 $sql6
                        AND f.id_type       = '2'
                        AND f.is_deleted    = '0' 
                        AND st.is_deleted   = '0'
                        AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                        AND st.std_status   = '1'
                        ORDER BY st.std_id, f.id DESC";

                $sqllms	= $dblms->querylms($sql);
                
                $count = mysqli_num_rows($sqllms);
                if($page == 0) { $page = 1; }               //if no page var is given, default to 1.
                $prev 		    = $page - 1;                //previous page is page - 1
                $next 		    = $page + 1;                //next page is page + 1
                $lastpage  		= ceil($count/$Limit);      //lastpage is = total pages / items per page, rounded up.
                $lpm1 		    = $lastpage - 1;
                
                $sqllmsFeeDefaulter	= $dblms->querylms("$sql  LIMIT ".($page-1)*$Limit .",$Limit");
                //-----------------------------------------------------
                if(mysqli_num_rows($sqllmsFeeDefaulter) > 0){
                    echo '
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                            <tr>
                                <th style="text-align:center;">#</th>
                                <th>Challan #</th>
                                <th>Reg #</th>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Month</th>
                                <th width="90px;">Issue Date</th>
                                <th width="90px;">Due Date</th>
                                <th width="70px;" style="text-align:center;">Status</th>
                                <th>Total</th>
                                <th width="100" style="text-align:center;">Options</th>
                            </tr>
                        </thead>
                        <tbody>';
                            $srno = 0;

                            while($valueFee = mysqli_fetch_array($sqllmsFeeDefaulter)) {

                                if(date('Y-m-d') > $valueFee['due_date']) {
                                    $granTotal = $valueFee['total_amount'] + 300;
                                } else {
                                    $granTotal = $valueFee['total_amount'];
                                }

                                // Online Payment
                                $sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
                                                                    FROM ".PAY_API_TRAN." 
                                                                    WHERE challan_no = '".cleanvars($valueFee['challan_no'])."'");
                                $onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
                                $totalAmount = $valueFee['total_amount'];
                                $paidAmount = $onlinePaid['total_paid'];
                                $remainingAmount = $totalAmount - $onlinePaid['total_paid'];
                                
                                if($remainingAmount > 0){
                                    $srno++;
                                    echo '
                                    <tr>
                                        <td style="text-align:center;">'.$srno.'</td>
                                        <td>'.$valueFee['challan_no'].'</td>
                                        <td>'.$valueFee['std_regno'].'</td>
                                        <td>'.$valueFee['std_name'].'</td>
                                        <td>'.$valueFee['class_name'].' '; if($valueFee['section_name']){echo' ('.$valueFee['section_name'].') ';} echo'</td>
                                        <td>'.$valueFee['session_name'].'</td>
                                        <td>'; if($valueFee['id_month']){ echo' '.get_monthtypes($valueFee['id_month']).' ';} echo'</td>
                                        <td>'.$valueFee['issue_date'].'</td>
                                        <td>'.$valueFee['due_date'].'</td>
                                        <td style="text-align:center;">'.get_payments($valueFee['status']).'</td>
                                        <td>'.number_format(round($granTotal)).'</td>
                                        <td style="text-align:center;">';
                                        echo '
                                            <a class="btn btn-success btn-xs" style="text-align:center;" href="feechallanprint.php?id='.$valueFee['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
                                            
                                            echo '
                                        </td>
                                    </tr>';
                                }
                            }
                            echo '
                        </tbody>
                    </table>';
                    include_once('include/pagination.php');
                }
                else{
                    echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
                }
                echo'
            </div>
        </section>
    </div>
    </div>';
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var datatable = $('#table_export').dataTable({
                        bAutoWidth : false,
                        ordering: false,
                    });
        });
    </script>
    <?php 
    //------------------------------------
    echo '
    </section>';
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
} else{
    header("Location: dashboard.php");
}
?>