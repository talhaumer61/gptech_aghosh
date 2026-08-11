<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'view' => '1'))){
//-----------------------------------------------
$campus = '';
if(isset($_POST['campus'])){$campus = $_POST['campus'];}
//-----------------------------------------------	
$today = date('d-m-Y');	
//-----------------------------------------------
if(isset($_POST['start_date'])){$start_date = $_POST['start_date'];}else{$start_date = date('d-m-Y');}
if(isset($_POST['end_date'])){$end_date = $_POST['end_date'];}else{$end_date = date('d-m-Y');}
//-----------------------------------------------

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
            <form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="panel-body">
                <div class="row mb-lg">
                    <div class="col-md-offset-4 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Campus <span class="required">*</span></label>
                            <select data-plugin-selectTwo data-width="100%" name="campus" id="campus" required title="Must Be Required" class="form-control populate">
                                <option value="">Select</option>';
                            $sqllmscampus	= $dblms->querylms("SELECT c.campus_id, c.campus_name
                                                                    FROM ".CAMPUS." c  
                                                                    WHERE c.campus_id != '' AND campus_status = '1'
                                                                    ORDER BY c.campus_name ASC");
                                while($value_campus = mysqli_fetch_array($sqllmscampus)){
                                    if($value_campus['campus_id'] == $campus)
                                    {
                                        echo'<option value="'.$value_campus['campus_id'].'" selected>'.$value_campus['campus_name'].'</option>';
                                    }else
                                    {
                                        echo'<option value="'.$value_campus['campus_id'].'">'.$value_campus['campus_name'].'</option>';
                                    }
                                }
                                echo'
                                </select>
                        </div>
                    </div>
                    <div class="col-md-offset-4 col-md-4 mt-md">
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
                    <button type="submit" name="view_report" id="view_report" class="btn btn-primary"><i class="fa fa-search"></i> Show Report</button>
                </center>
            </div>
            </form>
        </section>';
        //-----------------------------------------------
if(isset($_POST['view_report'])){
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
                                        WHERE s.std_status = '1' AND s.id_campus = '".$campus."'
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
                                <td>'.$value_stu['std_name'].'</td>
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
<script>
    //USED BY: All date picking forms
    $(document).ready(function(){
        $(".pickayear").datepicker({
        format: "yyyy",
        language: "lang",
        viewMode: "years", 
        minViewMode: "years",
        autoclose: true
        });	
    });

    // PRINT THE TABLE 
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