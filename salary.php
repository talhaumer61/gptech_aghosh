<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
    checkCpanelLMSALogin();
//-----------------------------------------------
    require_once("include/campus/salary/query_create-salary.php");
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'add' => '1'))){ 
//-----------------------------------------------
echo '
<title>Salary | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Employee Salary</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
if(isset($_GET['id'])){
$sqllmspayslip	= $dblms->querylms("SELECT s.id, s.slip_no, s.month, s.basic_salary, s.total_allowances, s.total_deductions, s.net_pay, s.dated,
                                        e.emply_name, e.emply_joindate, e.emply_phone, e.emply_email, d.dept_name, dp.designation_name, c.campus_name, c.campus_address, c.campus_email, c.campus_phone
                                        FROM ".SALARY." s
                                        INNER JOIN ".EMPLOYEES." e ON e.emply_id = s.id_emply
                                        LEFT JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
                                        LEFT JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
                                        INNER JOIN ".CAMPUS." c ON c.campus_id = s.id_campus
                                        WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        AND s.status = '1' AND id = '".$_GET['id']."' LIMIT 1");
$value_pay = mysqli_fetch_array($sqllmspayslip);
//-----------------------------------------------
echo '<section class="panel">
<div class="panel-body" id="invoice_print">
    <div class="invoice">
        <header class="clearfix">
            <div class="row">
                <div class="col-sm-4 mt-md">
                    <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">PAYSLIP</h2>
                    <h4 class="h4 m-none text-dark text-weight-bold">#'.$value_pay['slip_no'].'</h4>
                </div>
                <div class="col-sm-8 text-right mt-md mb-md">
                    <address class="ib mr-xlg">
                        <span class="text-dark"><b>'.$value_pay['campus_name'].'</b></span><br>
                        '.$value_pay['campus_address'].'<br> 
                        '.$value_pay['campus_phone'].'<br>  
                        '.$value_pay['campus_email'].'  
                    </address>
                    <div class="ib">
                        <img src="uploads/logo.png" width="174" height="69" alt="'.TITLE_HEADER.'">
                    </div>
                </div>
            </div>
        </header>
        
        <div class="bill-info">
            <div class="row">
                <div class="col-md-6">
                    <div class="bill-to">
                        <p class="h5 mb-xs text-dark text-weight-semibold">To:</p>
                        <address>
                            '.$value_pay['emply_name'].'<br>
                            Designation : '.$value_pay['designation_name'].'<br>
                            Department : '.$value_pay['dept_name'].'<br>
                            Joining Date : '.date('d M, Y' , strtotime(cleanvars($value_pay['emply_joindate']))).'<br>
                            Phone : '.$value_pay['emply_phone'].'<br>
                            Email : '.$value_pay['emply_email'].'
                        </address>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bill-data text-right">
                        <p class="mb-none">
                            <span class="text-dark">Creation Date : </span>
                            <span>'.date('d M, Y' , strtotime(cleanvars($value_pay['dated']))).'</span>
                        </p>
                        <p class="mb-none">
                            <span class="text-dark">Salary Month : </span>
                            <span>'.get_monthtypes($value_pay['month']).'</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                    <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                        <h2 class="panel-title">Allowances</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table invoice-items">
                                <thead>
                                    <tr class="h5 text-dark">
                                        <th id="cell-id" class="text-weight-semibold">#</th>
                                        <th id="cell-item" class="text-weight-semibold">Name</th>
                                        <th id="cell-desc" class="text-weight-semibold">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>';
//-----------------------------------------------------
$sqllmsallowance	= $dblms->querylms("SELECT name, amount
                                        FROM ".SALARY_PART."
                                        WHERE type = '1' AND id_voucher = '".$value_pay['id']."' ORDER BY id ASC");
//-----------------------------------------------------
$srno = 0;
while($value_allow = mysqli_fetch_array($sqllmsallowance)) {
$srno++;
//-----------------------------------------------------
                                echo'<tr>
                                        <td>'.$srno.'</td>
                                        <td class="text-weight-semibold text-dark">'.$value_allow['name'].'</td>
                                        <td>'.$value_allow['amount'].'</td>
                                    </tr>';
}
echo '
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                    <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                        <h2 class="panel-title">Deductions</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table invoice-items">
                                <thead>
                                    <tr class="h5 text-dark">
                                        <th id="cell-id" class="text-weight-semibold">#</th>
                                        <th id="cell-item" class="text-weight-semibold">Name</th>
                                        <th id="cell-desc" class="text-weight-semibold">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>';
//-----------------------------------------------------
$sqllmsdeductions	= $dblms->querylms("SELECT name, amount
                                        FROM ".SALARY_PART."
                                        WHERE type = '2' AND id_voucher = '".$value_pay['id']."' ORDER BY id ASC");
//-----------------------------------------------------
$srno = 0;
while($value_ded = mysqli_fetch_array($sqllmsdeductions)) {
$srno++;
//-----------------------------------------------------
                                echo'<tr>
                                        <td>'.$srno.'</td>
                                        <td class="text-weight-semibold text-dark">'.$value_ded['name'].'</td>
                                        <td>'.$value_ded['amount'].'</td>
                                    </tr>';
}
echo '
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="invoice-summary">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <table class="table h5 text-dark">
                        <tbody>
                            <tr class="b-top-none">
                                <td colspan="2">Basic Salary</td>
                                <td class="text-left">Rs. '.$value_pay['basic_salary'].'</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Allowance</td>
                                <td class="text-left">Rs. '.$value_pay['total_allowances'].'</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Deductions</td>
                                <td class="text-left">Rs. '.$value_pay['total_deductions'].'</td>
                            </tr>
                            <tr class="h4">
                                <td colspan="2">Net Salary</td>
                                <td class="text-left">Rs. '.$value_pay['net_pay'].'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="text-right mr-lg">
        <a href="#" onclick="PrintElem(\'#invoice_print\')" class="btn btn-primary ml-sm"><i class="glyphicon glyphicon-print"></i></a>
    </div>
</footer>
</section>';
}
//-----------------------------------------------
if(!isset($_GET['id'])){
//-----------------------------------------------
if(isset($_POST['id_dept'])){$id_dept = $_POST['id_dept'];}else{$id_dept = '';}
if(isset($_POST['id_employe'])){$id_employe = $_POST['id_employe'];}else{$id_employe = '';}
if(isset($_POST['month'])){$id_month = $_POST['month'];}else{$id_month = '';}
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Select Department</h2>
	</header>
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Department <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="id_dept" name="id_dept" onchange="get_deptemployee(this.value)" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
						//-----------------------------------------------------
                        $sqllmsdepartment	= $dblms->querylms("SELECT dept_id, dept_name  
                                                                    FROM ".DEPARTMENTS." 
                                                                    WHERE dept_status = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
                                                                    ORDER BY dept_name ASC");
                        //-----------------------------------------------------
                        while($value_dept = mysqli_fetch_array($sqllmsdepartment)) {
							if($value_dept['dept_id'] == $id_dept){
								echo'<option value="'.$value_dept['dept_id'].'" selected>'.$value_dept['dept_name'].'</option>';
                            }else{
                                echo'<option value="'.$value_dept['dept_id'].'">'.$value_dept['dept_name'].'</option>';
                            }
                        }
                        //-----------------------------------------------------
						echo'
						</select>
				</div>
            </div>
            <div class="col-md-4">
				<div class="form-group">
                    <label class="control-label">Employee <span class="required">*</span></label>
                    <div id="getdeptemployee">
					<select class="form-control populate" data-plugin-selectTwo data-width="100%" id="id_employe" name="id_employe" required title="Must Be Required">
                        <option value="">Select</option>';
                            $sqllmsdept	= $dblms->querylms("SELECT emply_id, emply_name 
                                                FROM ".EMPLOYEES."
                                                WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                AND emply_status = '1' AND emply_id = '".$id_employe."' LIMIT 1");
                            $valuedept = mysqli_fetch_array($sqllmsdept);
                            if($valuedept['emply_id']){echo '<option value="'.$valuedept['emply_id'].'" selected>'.$valuedept['emply_name'].'</option>';}
                        echo '
                    </select>
                    </div>
				</div>
            </div>
            <div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Month <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="month" name="month" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
                        //-----------------------------------------------------
                        foreach($monthtypes as $month) {
							if($month['id'] == $id_month){
								echo'<option value="'.$month['id'].'" selected>'.$month['name'].'</option>';
                            }else{
                                echo'<option value="'.$month['id'].'">'.$month['name'].'</option>';
                            }
                        }
                        //-----------------------------------------------------
						echo'
						</select>
				</div>
			</div>
		</div>
        <center>
			<button type="submit" name="view_employee" id="view_employee" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Done</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_employee'])){
//-----------------------------------------------------
$sqllmsemployee	= $dblms->querylms("SELECT e.emply_id, e.emply_name, e.id_type, e.emply_joindate,
                                        e.emply_phone, e.emply_email, e.emply_basicsalary, e.emply_photo,
                                        d.dept_name,
                                        dp.designation_name 
                                        FROM ".EMPLOYEES." e      
                                        INNER JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
                                        INNER JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
                                        WHERE e.emply_id = '".$id_employe."' AND e.emply_status = '1' AND e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                        AND e.id_dept = '".$id_dept."' LIMIT 1");
$value_emp = mysqli_fetch_array($sqllmsemployee);
//-----------------------------------------------------
echo '
<form action="salary.php" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
    <section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
        <header class="panel-heading">
            <h2 class="panel-title">Make Payment</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Allowances</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6 mt-md">
                                    <input class="form-control" name="allowance_name[]" placeholder="Name Of Allowance" type="text">
                                </div>
                                <div class="col-sm-6 mt-md">
                                    <input class="salary form-control" name="allowance_value[]" placeholder="Amount" id="allowance_amount" type="number">
                                </div>
                            </div>
                            <div id="add_new_allowance"></div>
                            <button type="button" class="btn btn-default mt-md" onclick="add_more_allowances()"><i class="fa fa-plus"></i> Add More</button>
                        </div>
                    </section>
                </div>
                
                <div class="col-md-6">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Deductions</h2>
                        </header>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-6 mt-md">
                                    <input class="form-control" name="deduction_name[]" placeholder="Name Of Deductions" type="text">
                                </div>
                                <div class="col-sm-6 mt-md">
                                    <input class="deduction form-control" name="deduction_value[]" placeholder="Amount" id="deduction_amount" type="number">
                                </div>
                            </div>
                            <div id="add_new_deduction"></div>
                            <button type="button" class="btn btn-default mt-md" onclick="add_more_deduction()"><i class="fa fa-plus"></i> Add More</button>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-6">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Salary Details</h2>
                        </header>
                        <div class="panel-body">
                            <table class="table h5 text-dark">
                                <tbody>
                                    <tr class="b-top-none">
                                        <td colspan="2">Basic Salary</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" name="basic_salary" readonly="" value="'.$value_emp['emply_basicsalary'].'">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Allowance</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" name="total_allowance" readonly="" id="total_allowance" value="0">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Deductions</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" name="total_deduction" readonly="" id="total_deduction" value="0">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="h4">
                                        <td colspan="2">Net Salary</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" name="net_salary" readonly="" id="net_salary" value="'.$value_emp['emply_basicsalary'].'">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="hidden" name="id_emply" value="'.$id_employe.'">
        <input type="hidden" name="id_dept" value="'.$id_dept.'">
        <input type="hidden" name="month" value="'.$id_month.'">
        <div class="panel-footer text-right">
            <button type="submit" id="make_salary" name="make_salary" class="btn btn-primary"> Make Payment</button>
        </div>
    </section>
    </form>';
?>
    <script type="text/javascript">
        function add_more_allowances() {
            var add_new = $('<div class="row"><div class="col-sm-6 mt-md"> <input class="form-control" name="allowance_name[]" placeholder="Name Of Allowance" type="text">\n\
            </div><div class="col-sm-4 mt-md"> <input class="salary form-control" name="allowance_value[]" placeholder="Amount" type="number"></div>\n\
            <div class="col-sm-2 mt-md text-right"><button type="button" class="btn btn-danger removeAL" ><i class="fa fa-times"></i> </button></div></div>');
            $("#add_new_allowance").append( add_new );
        }

        $("#add_new_allowance").on('click', '.removeAL', function () {
            $(this).parent().parent().remove();
            check_sum();
        });
        
        function add_more_deduction() {
            var add_new = $('<div class="row"><div class="col-sm-6 mt-md"> <input class="form-control" name="deduction_name[]" placeholder="Name Of Deductions" type="text">\n\
            </div><div class="col-sm-4 mt-md"> <input class="deduction form-control" name="deduction_value[]" placeholder="Amount" type="number"></div>\n\
            <div class="col-sm-2 mt-md text-right"><button type="button" class="btn btn-danger removeDE"><i class="fa fa-times"></i> </button></div></div>');
            $("#add_new_deduction").append( add_new );
        }

        $("#add_new_deduction").on('click', '.removeDE', function () {
            $(this).parent().parent().remove();
            check_sum();
        });
        
        $(document).on("change", function () {
            check_sum();
        });
        
        function check_sum() {
            var sum = 0;
            var deduc = 0;
            $(".salary").each(function () {
                sum += +$(this).val();
            });

            $(".deduction").each(function () {
                deduc += +$(this).val();
            });
            var ctc = $("#ctc").val();

            $("#total_allowance").val(sum);
            $("#total_deduction").val(deduc);
            var net_salary = 0;
            var basic = <?php echo $value_emp['emply_basicsalary'];?>;
            net_salary = (basic + sum) - deduc;
            $("#net_salary").val(net_salary);
        }
    </script>
<?php
    }
}
echo '
</div>
</div>';
?>
<script type="text/javascript">
    function get_deptemployee(id_dept) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_dept-emply.php",  
			data: "id_dept="+id_dept,  
			success: function(msg){  
				$("#getdeptemployee").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}

    // print invoice function
        function PrintElem(elem)
    {
        Popup($(elem).html());
    }
	
    function Popup(data)
    {
        var mywindow = window.open();
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/stylesheets/invoice-print.css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
    }
</script>
<?php 
//-----------------------------------------------
echo '
</section>';
//-----------------------------------------------
}
else{
    header("Location: dashboard.php");
}
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>