<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '82'))){
	echo'
	<title> Exam Demand Defaulter Panel | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2> Exam Demand Defaulter Panel </h2>
		</header>
    	<div class="row">
	        <div class="col-md-12">';
                $id_type = "";
                $type_name = "";
                $sql = "";

                if(isset($_POST['id_type']) && !empty($_POST['id_type'])){
                    $array      = explode('|',$_POST['id_type']);
                    $id_type    = $array[0];
                    $type_name  = $array[1];                    
                    $sql = " AND f.id_examtype = '".$id_type."'";
                }

                echo $sql;
                if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){ 		
                    echo'
                    <section class="panel panel-featured panel-featured-primary">
                        <form action="" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-list"></i> Select Filter</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-4">
                                        <label class="control-label">Exam Type </label>
                                            <select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_type" name="id_type">
                                            <option value="">Select</option>';
                                                $sqllms_type = $dblms->querylms("SELECT type_id, type_status, type_name 
                                                                                    FROM ".EXAM_TYPES."
                                                                                    WHERE type_status = '1' AND is_deleted != '1' 
                                                                                    ORDER BY type_id ASC");
                                                while($value_type = mysqli_fetch_array($sqllms_type)){
                                                    echo'<option value="'.$value_type['type_id'].'|'.$value_type['type_name'].'" '.($value_type['type_id'] == $id_type ? 'selected' : '').'>'.$value_type['type_name'].'</option>';
                                                }
                                                echo'
                                        </select>
                                    </div>
                                </div>		
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                    <button type="submit" id="get_results" name="get_results" class="mr-xs btn btn-primary"> <i class="fa fa-search"></i> Get Results</button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                    </section>
                    
                    
                    <section class="panel panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <button id="export_button" class="btn btn-success btn-xs mr-xs pull-right"><i class="fa fa-file-excel-o"></i> Excel</button>
                            <button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-print"></i> Print</button>
                            <h2 class="panel-title"><i class="fa fa-list"></i> Defaulter List</h2>
                        </header>
                        <div class="panel-body">';
                            $sqllms	= $dblms->querylms("SELECT f.id, f.status, f.challan_no, f.issue_date, f.due_date, f.total_amount, f.paid_amount, c.campus_name, s.session_name, et.type_name
                                                        FROM ".EXAM_FEE_CHALLANS." f				   
                                                        INNER JOIN ".CAMPUS." c ON c.campus_id = f.id_campus
                                                        INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
                                                        INNER JOIN ".EXAM_TYPES." et ON et.type_id = f.id_examtype							 
                                                        WHERE f.is_deleted = '0'
                                                        AND f.status IN (2,4)
                                                        $sql
                                                        ORDER BY f.id DESC");
                            if(mysqli_num_rows($sqllms) > 0){
                                echo'
                                <div id="printResult">
                                    <center>
                                        <img src="uploads/logo.png" style="max-height : 100px;">
                                        <h3>'.SCHOOL_NAME.' </h3> <b>'.(!empty($type_name) ? $type_name : '').'</b>
                                    </center><br><br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th width="40" class="center">Sr.</th>
                                                    <th width="130" class="center">Challan No</th>
                                                    <th>Campus</th>
                                                    <th>Exam Type</th>
                                                    <th width="80" class="center">Session</th>
                                                    <th width="100" class="center">Total Amount</th>
                                                    <th width="100" class="center">Paid Amount</th>
                                                    <th width="100" class="center">Payable</th>
                                                    <th width="70" class="center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                                while($rowsvalues = mysqli_fetch_array($sqllms)){
                                                    $payable = $rowsvalues['total_amount'] - $rowsvalues['paid_amount'];
                                                    $srno++;
                                                    echo '
                                                    <tr>
                                                        <td class="center">'.$srno.'</td>
                                                        <td class="center">'.$rowsvalues['challan_no'].'</td>
                                                        <td>'.$rowsvalues['campus_name'].'</td>
                                                        <td>'.$rowsvalues['type_name'].'</td>
                                                        <td>'.$rowsvalues['session_name'].'</td>
                                                        <td class="center">'.number_format(round($rowsvalues['total_amount'])).'</td>
                                                        <td class="center">'.number_format(round($rowsvalues['paid_amount'])).'</td>
                                                        <td class="center">'.number_format(round($payable)).'</td>
                                                        <td class="center">'.get_payments($rowsvalues['status']).'</td>
                                                    </tr>';
                                                }
                                                echo'
                                            </tbody>
                                        </table>
                                    </div>
                                </div>';
                            }else{
                                echo '<h2 class="center text-danger">No Record Found</h2>';
                            }
                            echo'
                        </div>
                    </section>';
                }else{
                    header("location: dashboard.php");
                }
            	echo'
	        </div>
	    </div>
	</section>';
}else{
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