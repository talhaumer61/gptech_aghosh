<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'view' => '1'))){
    $campus         = '';
    $current_year   = date('Y');
    $id_campus      = (isset($_POST['id_campus']) ? $_POST['id_campus'] : '');
    $pay_mode       = (isset($_POST['pay_mode']) ? $_POST['pay_mode'] : '');
    $date_from      = (isset($_POST['date_from']) ? $_POST['date_from'] : '');
    $date_to        = (isset($_POST['date_to']) ? $_POST['date_to'] : '');
    $year           = (isset($_POST['year']) ? $_POST['year'] : date('Y'));
    
    if(!empty($id_campus)){
        $sql1 = "AND f.id_campus = '".$id_campus."' ";
    }
    if(!empty($pay_mode)){
        $sql2 = "AND f.pay_mode = '".$pay_mode."' ";
    }
    echo'
    <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
    <title>Income & Expense Report | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Fee Head Wise Income Report</h2>
        </header>
        <section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-list"></i> Select Filters</h2>
            </header>
            <form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Campus </label>
                                <select data-plugin-selectTwo data-width="100%" name="id_campus" id="id_campus" title="Must Be Required" class="form-control populate">
                                    <option value="">Select</option>';
                                    $sqllmscampus	= $dblms->querylms("SELECT c.campus_id, c.campus_name
                                                                        FROM ".CAMPUS." c  
                                                                        WHERE c.campus_id != '' AND campus_status = '1'
                                                                        ORDER BY c.campus_name ASC");
                                    while($value_campus = mysqli_fetch_array($sqllmscampus)){
                                        echo'<option value="'.$value_campus['campus_id'].'" '.($value_campus['campus_id'] == $id_campus ? 'selected' : '').'>'.$value_campus['campus_name'].'</option>';
                                    }
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Pay Mode </label>
                                <select data-plugin-selectTwo data-width="100%" name="pay_mode" id="pay_mode" title="Must Be Required" class="form-control populate">
                                    <option value="">Select</option>';
                                    foreach($paymethod as $mode){
                                        echo'<option value="'.$mode['id'].'" '.($mode['id'] == $pay_mode ? 'selected' : '').'>'.$mode['name'].'</option>';
                                    }
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Date <span class="required">*</span></label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" name="date_from" id="date_from" value="'.$date_from.'" required title="Must Be Required" aria-required="true" aria-invalid="false">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="date_to" id="date_to" value="'.$date_to.'" required title="Must Be Required" aria-required="true" aria-invalid="false">
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Year </label>
                                <input type="text" class="date-own form-control pickayear" name="year" id="year" value="'.$year.'" max="'.$current_year.'">
                            </div>
                        </div>
                        -->
                    </div>                    
                    <center class="mt-lg">
                        <button type="submit" name="view_report" id="view_report" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
                    </center>
                </div>
            </form>
        </section>';

        if(isset($_POST['view_report'])){
            echo'
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="fa fa-list"></i> Fee Head Wise Income Report <b>('.$year.')</b></h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
                        <thead>
                            <tr>
                                <th colspan="5" class="center">Fee Head Wise Income Report</th>
                            </tr>
                            <tr>
                                <th colspan="5" class="center">Fee Head Wise Income Report</th>
                            </tr>
                            <tr>
                                <th width="40" class="center">Sr.</th>
                                <th>Heads</th>
                                <th class="center">Aghosh Grammar School</th>
                                <th class="center">Minhaj College of Management & Technology</th>
                                <th class="center">Tehfeez</th>
                            </tr>
                        </thead>
                        <tbody>';
                            $srno=0;
                            $amount_1=0;
                            $amount_2=0;
                            $amount_3=0;
                            $grandTotal=0;
                            $sqlFeeHead	= $dblms->querylms("SELECT cat_id, cat_name
                                                        FROM ".FEE_CATEGORY."  
                                                        WHERE cat_status    = '1'
                                                        AND is_deleted      = '0'
                                                        ORDER BY cat_id ASC");
                            while($valFeeHead = mysqli_fetch_array($sqlFeeHead)){
                                $srno++;
                                $sqlIncome	= $dblms->querylms("SELECT
                                                                SUM(CASE WHEN c.id_classgroup = '1' THEN fp.amount ELSE NULL END) as amount_1,
                                                                SUM(CASE WHEN c.id_classgroup = '2' THEN fp.amount ELSE NULL END) as amount_2,
                                                                SUM(CASE WHEN c.id_classgroup = '3' THEN fp.amount ELSE NULL END) as amount_3
                                                                FROM ".FEES." f
                                                                INNER JOIN ".FEE_PARTICULARS." fp ON fp.id_fee = f.id AND fp.id_cat = '".$valFeeHead['cat_id']."'
                                                                INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
                                                                WHERE f.status      = '1'
                                                                AND f.is_deleted    = '0'
                                                                AND f.id_type IN (1,2)
                                                                AND (f.paid_date BETWEEN '".date('Y-m-d',strtotime($date_from))."' AND '".date('Y-m-d',strtotime($date_to))."')
                                                                $sql1 $sql2 
                                                            ");
                                $valIncome = mysqli_fetch_array($sqlIncome);
                                echo '
                                <tr>
                                    <td style="text-align:center;">'.$srno.'</td>
                                    <td>'.$valFeeHead['cat_name'].'</td>
                                    <td class="text-right">'.$valIncome['amount_1'].'</td>
                                    <td class="text-right">'.$valIncome['amount_2'].'</td>
                                    <td class="text-right">'.$valIncome['amount_3'].'</td>
                                </tr>';
                                $amount_1 += $valIncome['amount_1'];
                                $amount_2 += $valIncome['amount_2'];
                                $amount_3 += $valIncome['amount_3'];
                            }
                            $grandTotal = $amount_1 + $amount_2 + $amount_3;
                            echo'
                            <tr>
                                <th colspan="2" class="center">Total Amount</th>
                                <th class="text-right">'.$amount_1.'</th>
                                <th class="text-right">'.$amount_2.'</th>
                                <th class="text-right">'.$amount_3.'</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="center">Grand Total</th>
                                <th colspan="3" class="center">'.$grandTotal.'</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>';
        }
        echo'
    </section>';
}else{
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
</script>