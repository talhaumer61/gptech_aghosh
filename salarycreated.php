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
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'view' => '1'))){ 
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
if(isset($_POST['id_dept'])){$id_dept = $_POST['id_dept'];}else{$id_dept = '';}
if(isset($_POST['month'])){$id_month = $_POST['month'];}else{$id_month = '';}
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Select Department & Month</h2>
	</header>
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Department <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="id_dept" name="id_dept" required title="Must Be Required" class="form-control populate">
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
            <div class="col-md-6">
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
			<button type="submit" name="view_payslip" id="view_payslip" class="btn btn-primary"><i class="fa fa fa-search"></i> Search</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_payslip'])){
//-----------------------------------------------
echo '
<section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">';
//-----------------------------------------------------
$sqllmspayslip	= $dblms->querylms("SELECT s.id, s.basic_salary, s.total_allowances, s.total_deductions, s.net_pay, s.dated,
                                        e.emply_name, e.emply_phone, e.emply_photo
                                        FROM ".SALARY." s      
                                        INNER JOIN ".EMPLOYEES." e ON e.emply_id = s.id_emply
                                        INNER JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
                                        WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND s.month = '".$id_month."'
                                        AND e.emply_status = '1' AND e.id_dept = '".$id_dept."' ORDER BY id");
//-----------------------------------------------------
if(mysqli_num_rows($sqllmspayslip)){
echo '
<header class="panel-heading">
    <h2 class="panel-title"><i class="fa fa-list"></i> Generated Payslips</h2>
</header>
<div class="panel-body">
    <div class="table-responsive">
    <table class="table table-bordered table-condensed table-striped mb-none dataTable no-footer" id="table_export" role="grid" aria-describedby="table_export_info">
        <thead>
            <tr role="row">
                <th width="40">#</th>
                <th width="80">Photo</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Basic Salary</th>
                <th>Total Allowance</th>
                <th>Total Deductions</th>
                <th>Net Salary</th>
                <th>Creation Date</th>
                <th>Payslip </th>
            </tr>
        </thead>
        <tbody>';
    $srno = 0;
//-----------------------------------------------------
while($value_slip = mysqli_fetch_array($sqllmspayslip)){
//-----------------------------------------------------
    $srno++;
    if($value_slip['emply_photo']) { 
        $photo = '<img src="uploads/images/employees/'.$value_slip['emply_photo'].'" width="35" height="35">' ;
    } else {
        $photo = 'No Image';
    }
//-----------------------------------------------------
    echo '                     
            <tr role="row" class="odd">
                <td class="center">'.$srno.'</td>
                <td class="center">'.$photo.'</td>
                <td> '.$value_slip['emply_name'].' </td>
                <td> '.$value_slip['emply_phone'].' </td>
                <td>Rs. '.$value_slip['basic_salary'].' </td>
                <td>Rs. '.$value_slip['total_allowances'].' </td>
                <td>Rs. '.$value_slip['total_deductions'].' </td>
                <td>Rs. '.$value_slip['net_pay'].' </td>
                <td> '.date('d, M, Y' , strtotime(cleanvars($value_slip['dated']))).' </td>
                <td><a href="salary.php?id='.$value_slip['id'].'" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Details </a></td>
            </tr>';
}
echo '
        </tbody>
    </table>
    </div>
    </div>
</div>';
}
else{
    echo '<h2 class="center">No Record Found</h2>';
}
echo '
</section>';

?>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $('#table_export').dataTable({
			bAutoWidth : false,
			ordering: false,
			sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
			oTableTools: {
				sSwfPath: 'assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf',
				aButtons: [
					{
						sExtends: 'print',
						sButtonText: 'Print',
						sInfo: '',
						fnClick: function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(9, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								if (e.which == 27) {
									datatable.fnSetColumnVis(0, true);
									datatable.fnSetColumnVis(9, true);
								}
							});
						}
					}
				]
			}
		});
	});
</script>
<?php
    }
//-----------------------------------------------
}
else{
    header("Location: dashboard.php");
}
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>