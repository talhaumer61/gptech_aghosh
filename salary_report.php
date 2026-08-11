<?php
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'view' => '1'))){ 
//-----------------------------------------------
echo '
<title>Salary Report | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Salary Report</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
if(isset($_POST['month'])){$month = $_POST['month'];}else{$month = date('MM-YYYY');}
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Salary Report</h2>
	</header>
	<form action="" id="form" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-offset-4 col-md-4">
				<div class="form-group">
                    <label class=" control-label">Month <span class="required" aria-required="true">*</span></label>
                    <div class="input-daterange input-group">
                        <input type="month" class="form-control" required title="Must Be Required" name="month" value="'.$month.'">
                    </div>
                </div>
			</div>
		</div>
		<center>
			<button type="submit" name="view_report" id="view_report" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>
';
//-----------------------------------------------
if(isset($_POST['view_report'])){
echo '
<section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
<header class="panel-heading">
	<h2 class="panel-title"> <i class="fa fa-pie-chart"></i> Employees Salary Report of <b> '.date('M Y' , strtotime(cleanvars($month))).' </b></h2>
</header>
<div class="panel-body">';
//-----------------------------------------------------
$sqllmspayslip	= $dblms->querylms("SELECT s.id, s.slip_no, s.month, s.basic_salary, s.total_allowances, s.total_deductions, s.net_pay, s.dated,
                                        e.emply_name, e.emply_joindate, e.emply_phone, e.emply_email, d.dept_name, dp.designation_name
                                        FROM ".SALARY." s
                                        INNER JOIN ".EMPLOYEES." e ON e.emply_id = s.id_emply
                                        LEFT JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
                                        LEFT JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
                                        WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        AND s.dated LIKE '".$month."-%'
                                        AND s.status = '1' ");
//------------------------------------------------------
if(mysqli_num_rows($sqllmspayslip) > 0){
echo '
	<div id="printResult">
	<div class="invoice mt-md">
		<div class="table-responsive">
		
    <div class="col-md-12">
        <table class="table invoice-items">
            <thead>
                <tr class="h5 text-dark">
                    <th class="text-center">Sr#</th>
                    <th>Name</th>
                    <th>Desg.</th>
                    <th>Basic Pay</th>
                    <th>Allowances</th>
                    <th>Deductions</th>
                    <th>Net Salary</th>
                </tr>
            </thead>
            <tbody>';
            //-----------------------------------------------------
            $srno = 0;
            $srno = 0;
            $total_basic = 0;
            $total_allowance = 0;
            $totla_deduction = 0;
            $total_net = 0;
			while($value_pay = mysqli_fetch_array($sqllmspayslip)) {
            $srno++;
            //-----------------------------------------------------
			echo'
				<tr style="padding: 5px;">
                    <td class="text-center">'.$srno.'</td>
                    <td>'.$value_pay['emply_name'].'</td>
                    <td>'.$value_pay['designation_name'].'</td>
                    <td>'.$value_pay['basic_salary'].'</td>
                    <td>'.$value_pay['total_allowances'].'</td>
                    <td>'.$value_pay['total_deductions'].'</td>
                    <td>'.number_format($value_pay['net_pay']).'</td>
                </tr>';
                $total_basic = $total_basic + $value_pay['basic_salary'];
                $total_allowance = $total_allowance + $value_pay['total_allowances'];
                $totla_deduction = $totla_deduction + $value_pay['total_deductions'];
                $total_net = $total_net + $value_pay['net_pay'];
			}
                echo'
                <tr>
                    <th colspan="3" class="text-center">Totals</th>
                    <th>'.number_format($total_basic).'</th>
                    <th>'.number_format($total_allowance).'</th>
                    <th>'.number_format($totla_deduction).'</th>
                    <th>'.number_format($total_net).'</th>
                </tr>
            </tbody>
        </table>
    </div>
	</div>
	</div>
	</div>
	<!-- <div class="text-right mr-lg on-screen">
		<button onclick="print_report(\'printResult\')" class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button>
	</div> -->
	<div class="text-right mr-lg on-screen">
		<a href="salary_print.php?month='.$month.'" target="_blank"><button class="mr-xs btn btn-primary"><i class="glyphicon glyphicon-print"></i></button></a>
	</div>';
}
else{
	echo '<h2 class="center">No Record Found</h2>';
}
echo '
</div>
</section>';
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
<?php 
//------------------------------------
echo'
</div>
</section>';
}
else{
    header("Location: dashboard.php");
}
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>