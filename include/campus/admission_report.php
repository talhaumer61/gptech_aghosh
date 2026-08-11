<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){
//-----------------------------------------------
$today = date('d-m-Y');	
//-----------------------------------------------
if(isset($_POST['start_date'])){$start_date = $_POST['start_date'];}else{$start_date = $today;}
if(isset($_POST['end_date'])){$end_date = $_POST['end_date'];}else{$end_date = $today;}

$selectAll = "";
$sql1 = "";
$sql2 = "";	
$sql3 = "";
$sql4 = "";
$sql5 = "";
$class = "";
$std_status = "";
$std_gender = "";
$is_orphan = "";
$is_hostelized = "";

//  class
if($_POST['id_class']){
    $arrayClass = array();
    foreach ($_POST['id_class'] as $class){
        array_push($arrayClass, $class);
    }
    if(in_array('all', $arrayClass)){
        $selectAll = 'selected';
        $sql1 = "";
        $classComma = '';
    }else{
        $sql1 = "AND s.id_class IN (".implode(", ",$arrayClass).")";
        $classComma 	= 	implode(", ",$arrayClass);
    }
    $class		 	=	$arrayClass;
}
// status
if($_POST['std_status']){
    $sql2 = "AND s.std_status = '".$_POST['std_status']."'";
    $std_status = $_POST['std_status'];
}
//  Gender
if($_POST['std_gender']){
    $sql3 = "AND s.std_gender = '".$_POST['std_gender']."'";
    $std_gender = $_POST['std_gender'];
}
//	is_oprhan
if($_POST['is_orphan']){
    if($_POST['is_orphan']==1){
        $sql4 = "AND s.is_orphan = '1'";
        $is_orphan = $_POST['is_orphan'];
    }else{
        $sql4 = "AND s.is_orphan != '1'";
        $is_orphan = $_POST['is_orphan'];
    }
}
//	is_hostelized
if($_POST['is_hostelized']){
    if($_POST['is_hostelized']==1){
        $sql5 = "AND s.is_hostelized = '1'";
        $is_hostelized = $_POST['is_hostelized'];
    }else{
        $sql5 = "AND s.is_hostelized != '1'";
        $is_hostelized = $_POST['is_hostelized'];
    }
}

echo'
<style>
.ui-datepicker-calendar {
    display: none;
 }
</style>
<title>Admission Report| '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Admission Report</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
    <div class="col-md-12">
        <section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-list"></i>  Select </h2>
            </header>
            <form action="admission_report.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="panel-body">
                    <div class="row mb-lg">
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
                            <label class="control-label">Is Orphan </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="is_orphan">
                                <option value="">Select</option>';
                                foreach($statusyesno as $orph){
                                    echo '<option value="'.$orph['id'].'"'; if($is_orphan == $orph['id']){ echo'selected';} echo'>'.$orph['name'].'</option>';
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
                            <label class="control-label">Status </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="std_status">
                                <option value="">Select</option>';
                                foreach($stdstatus as $stat){
                                    echo '<option value="'.$stat['id'].'"'; if($std_status == $stat['id']){ echo'selected';} echo'>'.$stat['name'].'</option>';
                                }
                                echo'
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Date <span class="required" aria-required="true">*</span></label>
                                <div class="input-daterange input-group" data-plugin-datepicker="" data-plugin-options="{&quot;format&quot;: &quot;dd-mm-yyyy&quot;}">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" required title="Must Be Required" value="'.$start_date.'" name="start_date" value="'.date('d-m-Y').'">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" required title="Must Be Required" value="'.$end_date.'" name="end_date" value="'.date('d-m-Y').'" max="'.$today.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" name="view_students" id="view_students" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
                    </center>
                </div>
            </form>
        </section>';
        //-----------------------------------------------
if(isset($_POST['view_students'])){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i> Admission List From '.date('d, M, Y' , strtotime($start_date)).' To '.date('d, M, Y' , strtotime($end_date)).'</h2>
</header>
<div class="panel-body">';
    //-----------------------------------------------------
    $sqllmsstudent	= $dblms->querylms("SELECT s.std_name, s.std_phone, s.std_whatsapp, s.std_rollno, s.std_regno, s.std_admissiondate, c.class_name, se.session_name
                                        FROM ".STUDENTS." s
                                        INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
                                        INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
                                        WHERE s.std_status = '1' AND s.is_deleted != '1' AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $sql1 $sql2 $sql3 $sql4 $sql5
                                        AND (s.std_admissiondate BETWEEN '".date('Y-m-d' , strtotime(cleanvars($start_date)))."' AND '".date('Y-m-d' , strtotime(cleanvars($end_date)))."')
                                        ORDER BY s.id_class ASC");
    //-----------------------------------------------------
    if(mysqli_num_rows($sqllmsstudent) > 0){
        echo '
        <div id="printResult">
            <div class="invoice mt-md">
                <div class="table-responsive">
                    <table class="table invoice-items">
                        <thead>
                            <tr class="h5 text-dark">
                                <th width="80">#</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Roll #</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Phone</th>
                                <th>Whatsapp</th>
                            </tr>
                        </thead>
                        <tbody>';
                            //-----------------------------------------------------
                            $srno = 0;
                            //-----------------------------------------------------
                            while($value_stu = mysqli_fetch_array($sqllmsstudent)) {
                            //-----------------------------------------------------
                            $srno++;
                            //-----------------------------------------------------
                            echo'
                            <tr>
                                <td>'.$srno.'</td>
                                <td>'.date('d, M, Y' , strtotime($value_stu['std_admissiondate'])).'</td>
                                <td>'.$value_stu['std_name'].' '.$value_stu['std_name'].'</td>
                                <td>'.$value_stu['std_rollno'].'</td>
                                <td>'.$value_stu['class_name'].'</td>
                                <td>'.$value_stu['session_name'].'</td>
                                <td>'.$value_stu['std_phone'].'</td>
                                <td>'.$value_stu['std_whatsapp'].'</td>
                            </tr>';
                            }
                            echo '
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-right mr-lg on-screen">
            <button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button>
        </div>';
    }
    else{
        echo '<h2 class="center">No Record Found</h2>';
    }
    echo'
</div>
</section>';
}
echo'

    </div>
</div>
</section>
';
//-----------------------------------------------
}
else{
	header("Location: dashboard.php");
}

?>

<script type="text/javascript">
    function print_report(printResult) {
        var printContents = document.getElementById(printResult).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    jQuery(document).ready(function($) {	
        var datatable = $('#table_export').dataTable({
            bAutoWidth : false,
            ordering: false,
        });
    });
</script>