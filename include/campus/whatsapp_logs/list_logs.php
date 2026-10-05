<style>
.card {
    padding: 20px;
    font-size: 30px;
    border-radius: 10px;
    margin-left: 4%;
    margin-right: 4%;
}
.val {
    font-size: 20px;
}
.span {
    font-size: 14px;
}
</style>

<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'view' => '1'))){ 

$sql1 = "";
$sql2 = "";
$sql3 = "";
$sql4 = "";
$sql5 = "";

$from_date = "";
$to_date   = "";
$status    = "";
$msg_type  = "";
$search    = "";
$filters   = "";

// Set records per page limit to 20
$Limit = 20;

//--------- Filters ----------
if(isset($_GET['show'])){
    // Date Range (From Date & To Date)
    if(!empty($_GET['from_date']) && !empty($_GET['to_date'])){
        $start_date = date('Y-m-d', strtotime($_GET['from_date']));
        $end_date   = date('Y-m-d', strtotime($_GET['to_date']));
        $sql1 = "AND DATE(dated) BETWEEN '".$start_date."' AND '".$end_date."'";
        $from_date = date('m/d/Y', strtotime($_GET['from_date']));
        $to_date   = date('m/d/Y', strtotime($_GET['to_date']));
    } elseif(!empty($_GET['from_date'])){
        $start_date = date('Y-m-d', strtotime($_GET['from_date']));
        $sql1 = "AND DATE(dated) >= '".$start_date."'";
        $from_date = date('m/d/Y', strtotime($_GET['from_date']));
    } elseif(!empty($_GET['to_date'])){
        $end_date = date('Y-m-d', strtotime($_GET['to_date']));
        $sql1 = "AND DATE(dated) <= '".$end_date."'";
        $to_date = date('m/d/Y', strtotime($_GET['to_date']));
    }

    // Status Filter
    if($_GET['status'] != ''){
        $sql2 = "AND status = '".cleanvars($_GET['status'])."'";
        $status = $_GET['status'];
    }

    // Type Filter (Message Type)
    if($_GET['msg_type'] != ''){
        $sql3 = "AND message_type = '".cleanvars($_GET['msg_type'])."'";
        $msg_type = $_GET['msg_type'];
    }

    // Keyword Search Filter
    if(!empty($_GET['search'])){
        $search = cleanvars($_GET['search']);
        $sql5 = "AND (cellno LIKE '%".$search."%' OR challanno LIKE '%".$search."%' OR amount LIKE '%".$search."%')";
    }
}

$filters = 'from_date='.$from_date.'&to_date='.$to_date.'&status='.$status.'&msg_type='.$msg_type.'&search='.$search.'&show';

// Get current page URL without query string for reset button
$current_page = strtok($_SERVER["REQUEST_URI"], '?');

echo '
<section class="panel panel-featured panel-featured-primary">
    <header class="panel-heading">
        <h2 class="panel-title"><i class="fa fa-list"></i> Logs List</h2>
    </header>
    <div class="panel-body">
        <form action="#" method="GET" autocomplete="off">
            <div class="form-group mb-sm">
                <div class="col-md-3">
                    <label class="control-label">Search Keyword </label>
                    <input type="text" class="form-control" name="search" id="search" value="'.$search.'" placeholder="Cell No, Challan No..." />
                </div>
                <div class="col-md-2">
                    <label class="control-label">From Date </label>
                    <input type="text" class="form-control" name="from_date" id="from_date" value="'.$from_date.'" data-plugin-datepicker />
                </div>
                <div class="col-md-2">
                    <label class="control-label">To Date </label>
                    <input type="text" class="form-control" name="to_date" id="to_date" value="'.$to_date.'" data-plugin-datepicker />
                </div>
                <div class="col-md-2">
                    <label class="control-label">Status </label>
                    <select class="form-control" data-plugin-selectTwo data-width="100%" name="status">
                        <option value="">Select</option>';
                        foreach(get_whatsappMsgStatus() as $key => $val){
                            echo '<option value="'.$key.'"'; if($status != '' && $status == $key){ echo ' selected'; } echo '>'.$val.'</option>';
                        }
                        echo '
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Type </label>
                    <select class="form-control" data-plugin-selectTwo data-width="100%" name="msg_type">
                        <option value="">Select</option>';
                        foreach(get_whatsappMsgType() as $key => $val){
                            echo '<option value="'.$key.'"'; if($msg_type != '' && $msg_type == $key){ echo ' selected'; } echo '>'.$val.'</option>';
                        }
                        echo '
                    </select>
                </div>
                <div class="col-md-1" style="margin-top: 25px; display: flex; gap: 4px;">
                    <button type="submit" name="show" class="btn btn-primary" title="Search"><i class="fa fa-search"></i></button>
                    <a href="'.$current_page.'" class="btn btn-default" title="Clear Filters"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </form>';

        // Main Query for Logs
        $sql = "SELECT * 
                FROM ".WHATSAPP_MESSAGES." 
                WHERE id != '' 
                $sql1 $sql2 $sql3 $sql4 $sql5
                ORDER BY id DESC";

        $sqllms = $dblms->querylms($sql);
        
        $count = mysqli_num_rows($sqllms);
        if(!isset($page) || $page == 0) { $page = 1; } // If no page var is given, default to 1.
        $prev     = $page - 1;                         // Previous page
        $next     = $page + 1;                         // Next page
        $lastpage = ceil($count/$Limit);               // Lastpage calculation
        $lpm1     = $lastpage - 1;

        $sqllms = $dblms->querylms("$sql LIMIT ".($page-1)*$Limit .",$Limit");

        if(mysqli_num_rows($sqllms) > 0){
            echo '
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
                    <thead>
                        <tr>
                            <th style="text-align:center; width: 50px;">#</th>
                            <th>Cell No</th>
                            <th>Challan No</th>
                            <th>Amount</th>
                            <th>Dated</th>
                            <th style="text-align:center;">Type</th>
                            <th width="70px;" style="text-align:center;">Status</th>
                            <th width="100" style="text-align:center;">Options</th>
                        </tr>
                    </thead>
                    <tbody>';
                        $srno = ($page - 1) * $Limit;
                        while($rowsvalues = mysqli_fetch_array($sqllms)) {
                            $srno++;
                            echo '
                            <tr>
                                <td style="text-align:center;">'.$srno.'</td>
                                <td>'.$rowsvalues['cellno'].'</td>
                                <td>'.$rowsvalues['challanno'].'</td>
                                <td>'.$rowsvalues['amount'].'</td>
                                <td>'.date('Y-m-d', strtotime($rowsvalues['dated'])).'</td>
                                <td style="text-align:center;">'.get_whatsappMsgType($rowsvalues['message_type']).'</td>
                                <td style="text-align:center;">'.get_whatsappMsgStatus($rowsvalues['status']).'</td>
                                <td class="text-center">';
                                    if($rowsvalues['status'] == 3){ 
                                        echo '
                                        <a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" 
                                        onclick="showAjaxModalZoom(\'include/modals/whatsapp_logs/msg_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
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
        } else {
            echo '<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
        }
        echo '
    </div>
</section>';
} else {
    header("Location: dashboard.php");
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        // Disable DataTables popup alerts completely
        if ($.fn.dataTable) {
            $.fn.dataTable.ext.errMode = 'none';
        }

        // Reconfigure existing DataTable or initialize safely
        $('#table_export').DataTable({
            destroy: true,       // Destroys any existing instance first
            paging: false,        // Disables DataTables automatic pagination
            info: false,          // Disables "Showing 1 to 10 of 20 entries"
            searching: false      // Disables top search bar
        });
    });
</script>