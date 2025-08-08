<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '82'))){

    // EXAM TYPE
    $arrayType  =   explode('|', $_POST['id_type']);
    $typeId     =   $arrayType[0];
    $typeName   =   $arrayType[1];
    // SESSION
    if(isset($_POST['id_session'])){
        $arraySess  =   explode('|', $_POST['id_session']);
        $id_session =   $arraySess[0];
        $sessName   =   $arraySess[1];
    }else{
        $id_session =   $_SESSION['userlogininfo']['ACADEMICSESSION'];
    }

	echo'
	<title> Campus Wise Demand | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Campus Wise Demand </h2>
		</header>
        <!-- INCLUDEING PAGE -->
        <div class="row">
            <div class="col-md-12">';
                if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){ 		
                    echo'
                    <section class="panel panel-featured panel-featured-primary">
                        <form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-list"></i> Select</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row mt-sm">
                                    <div class="col-md-6">
                                        <label class="control-label">Session <span class="required">*</span></label>
                                        <select data-plugin-selectTwo data-width="100%" id="id_session" name="id_session" required title="Must Be Required" class="form-control populate">
                                            <option value="">Select</option>';
                                                $sqlSession	= $dblms->querylms("SELECT session_id, session_name 
                                                                                FROM ".SESSIONS."
                                                                                WHERE is_deleted    = '0'
                                                                                AND session_status  = '1'
                                                                            ");
                                                while($valSession = mysqli_fetch_array($sqlSession)) {
                                                    echo '<option value="'.$valSession['session_id'].'|'.$valSession['session_name'].'" '.($valSession['session_id'] == $id_session ? 'selected' : '').'>'.$valSession['session_name'].'</option>';
                                                }
                                            echo'
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Exam Type <span class="required">*</span></label>
                                            <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_type" name="id_type">
                                            <option value="">Select</option>';
                                                $sqllms_type	= $dblms->querylms("SELECT type_id, type_status, type_name 
                                                                    FROM ".EXAM_TYPES."
                                                                    WHERE type_status = '1' AND is_deleted != '1' 
                                                                    ORDER BY type_id ASC");
                                                while($value_type = mysqli_fetch_array($sqllms_type)) 
                                                {
                                                    echo '<option value="'.$value_type['type_id'].'|'.$value_type['type_name'].'" '.($typeId == $value_type['type_id'] ? 'selected' : '').'>'.$value_type['type_name'].'</option>';
                                                }
                                                echo '
                                        </select>
                                    </div>
                                </div>		
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                    <button type="submit" id="exam_campusDemand" name="exam_campusDemand" class="mr-xs btn btn-primary"><i class="fa fa-filter"></i> Show Result</button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                    </section>';
                    if(isset($_POST['exam_campusDemand'])){
                        echo '
                        <section class="panel panel-featured panel-featured-primary">
                            <header class="panel-heading">
                                <button id="export_button" class="btn btn-success btn-xs mr-xs pull-right"><i class="fa fa-file-excel-o"></i> Excel</button>
                                <button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-print"></i> Print</button>
                                <h2 class="panel-title"><i class="fa fa-list"></i> Campus Wise Demand</h2>
                            </header>
                            <div class="panel-body">';
                                $sqllms_camp	= $dblms->querylms("SELECT d.total_std, d.total_amount, d.id_campus, c.campus_name, c.campus_head, c.campus_phone, dd.amount_per_std
                                                                    FROM ".EXAM_DEMAND." d
                                                                    INNER JOIN ".CAMPUS." c ON c.campus_id = d.id_campus 
                                                                    INNER JOIN ".EXAM_DEMAND_DET." as dd ON dd.id_demand = d.demand_id
                                                                    WHERE d.id_session = '".$id_session."' 
                                                                    AND d.id_examtype = '".$typeId."' 
                                                                    AND d.is_deleted = '0'
                                                                    AND d.demand_status = '1'
                                                                    AND d.is_publish = '1'
                                                                    GROUP BY dd.id_demand
                                                                    ORDER BY c.campus_name ASC
                                                              ");
                                if(mysqli_num_rows($sqllms_camp) > 0){
                                    // CLASSES
                                    $sqllms_classes	= $dblms->querylms("SELECT class_id, class_name 
                                                                        FROM ".CLASSES."
                                                                        WHERE class_id != '' 
                                                                        AND class_status ='1' 
                                                                        AND is_deleted != '1' 
                                                                    ");
                                    echo'
                                    <div id="printResult">
                                        <img src="uploads/logo.png" style="max-height : 100px;">
                                        <center style="margin-top: -100px;  text-align:right">
                                            <h3 style="font-weight: 100;">Laurel Home International Schools </h3> ('.$typeName.' - '.$sessName.')
                                        </center><br><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr class="h5 text-dark">
                                                        <th width="40" class="center">Sr.#</th>
                                                        <th>Campus</th>
                                                        <th>Principal</th>
                                                        <th>Mobile</th>';
                                                        while($values_class = mysqli_fetch_array($sqllms_classes)){
                                                            echo'<th class="center">'.$values_class['class_name'].'</th>';
                                                            $classes[] = $values_class;
                                                        }
                                                        echo'
                                                        <th class="center">Total Std</th>
                                                        <th class="center">Exam Fee</th>
                                                        <th class="center">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                    $srno               = 0;
                                                    $grandTotalAmount   = 0;
                                                    $grandTotalPerStd   = 0;
                                                    $grandTotalStd      = 0;
                                                    while($value_camp = mysqli_fetch_array($sqllms_camp)){
                                                        $srno++;
                                                        echo'
                                                        <tr>
                                                            <td class="center">'.$srno.'</td>
                                                            <td>'.$value_camp['campus_name'].'</td>
                                                            <td>'.$value_camp['campus_head'].'</td>
                                                            <td>'.$value_camp['campus_phone'].'</td>';
                                                            $t_stds = 0;
                                                            foreach($classes as $class){ 
                                                                $sqllms_std	= $dblms->querylms("SELECT  dd.no_of_std 
                                                                                                FROM ".EXAM_DEMAND." d
                                                                                                INNER JOIN ".EXAM_DEMAND_DET." as dd ON dd.id_demand = d.demand_id AND dd.id_class = '".$class['class_id']."'
                                                                                                WHERE d.id_campus = '".$value_camp['id_campus']."' 
                                                                                                AND d.id_session = '".$id_session."' 
                                                                                                AND d.id_examtype = '".$typeId."' 
                                                                                                AND d.is_deleted = '0'
                                                                                                AND d.demand_status = '1'
                                                                                                AND d.is_publish = '1'
                                                                                            ");
                                                                $value_std = mysqli_fetch_array($sqllms_std);
                                                                echo '<td class="center">'.(!empty($value_std['no_of_std']) ? $value_std['no_of_std'] : '0').'</td>';
                                                                $t_stds = $t_stds + $value_std['no_of_std'];
                                                            }
                                                            echo'
                                                            <td class="center">'.$t_stds.' </td>
                                                            <td class="center">'.$value_camp['amount_per_std'].' </td>
                                                            <td class="center">'.$value_camp['total_amount'].' </td>
                                                        </tr>';
                                                        $grandTotalAmount   = $grandTotalAmount + $value_camp['total_amount'];
                                                        $grandTotalPerStd   = $grandTotalPerStd + $value_camp['amount_per_std'];
                                                        $grandTotalStd      = $grandTotalStd    + $t_stds;
                                                    }
                                                    echo'
                                                    <tr>
                                                        <th class="center" colspan="4">Grand total</th>';
                                                        foreach($classes as $class){ 
                                                            $sqllms_std	= $dblms->querylms("SELECT  SUM(dd.no_of_std) students 
                                                                                            FROM ".EXAM_DEMAND." d
                                                                                            INNER JOIN ".EXAM_DEMAND_DET." as dd ON dd.id_demand = d.demand_id AND dd.id_class = '".$class['class_id']."'
                                                                                            WHERE d.id_session = '".$id_session."' 
                                                                                            AND d.id_examtype = '".$typeId."' 
                                                                                            AND d.is_deleted = '0'
                                                                                            AND d.demand_status = '1'
                                                                                            AND d.is_publish = '1'
                                                                                        ");
                                                            $value_std = mysqli_fetch_array($sqllms_std);
                                                            echo '<th class="center">'.(!empty($value_std['students']) ? $value_std['students'] : '0').'</th>';
                                                        }
                                                        echo '
                                                        <th class="center">'.$grandTotalStd.'</th>
                                                        <th class="center">'.$grandTotalPerStd.'</th>
                                                        <th class="center">'.$grandTotalAmount.'</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>';
                                }else{
                                    echo '<h2 class="center">No Record Found</h2>';
                                }
                                echo'
                            </div>
                        </section>';        
                    }
                }
                else{
                    header("location: dashboard.php");
                }
                echo '
            </div>
        </div>
	</section>
	</div>
	</section>	
	<!-- INCLUDES MODAL -->';
}
else
{
	header("Location: dashboard.php");
}
?>
<script>
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

    // EXPORT TO EXCEL
    function html_table_to_excel(type){
        var data = document.getElementById('printResult');
        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'report.' + type);
    }

    const export_button = document.getElementById('export_button');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
</script>