<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
    checkCpanelLMSALogin();
//-----------------------------------------------
    require_once("include/campus/salary/query_basic-salary.php");
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '78', 'add' => '1'))){ 
//-----------------------------------------------
echo '
<title>Salary Control | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Employee Salary</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
if(isset($_POST['department'])){$department = $_POST['department'];}	
//-----------------------------------------------	
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Select Department</h2>
	</header>
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel-body">
		<div class="row mb-lg">
			 <div class="col-md-offset-3 col-md-6">
				<div class="form-group">
					<label class="control-label">Department <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="department" name="department" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
						//-----------------------------------------------------
                        $sqllmsdepartment	= $dblms->querylms("SELECT dept_id, dept_name  
                                                                    FROM ".DEPARTMENTS." 
                                                                    WHERE dept_status = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
                                                                    ORDER BY dept_name ASC");
                        //-----------------------------------------------------
                        while($value_dept = mysqli_fetch_array($sqllmsdepartment)) {
							if($value_dept['dept_id'] == $department){
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
		</div>
		<center>
			<button type="submit" name="view_employee" id="view_employee" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
		</center>
	</div>
	</form>
</section>';
//-----------------------------------------------
if(isset($_POST['view_employee'])){
echo '
<section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">';
//-----------------------------------------------------
$sqllmsemployee	= $dblms->querylms("SELECT e.emply_id, e.emply_name, e.id_type, e.emply_joindate,
                                    e.emply_phone, e.emply_email, e.emply_basicsalary, e.emply_photo,
                                    d.dept_name,
                                    dp.designation_name 
                                    FROM ".EMPLOYEES." e      
                                    INNER JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
                                    INNER JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
                                    WHERE e.emply_status = '1' AND e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND e.id_dept = '".$department."'
                                    ORDER BY e.emply_name ASC");
//-----------------------------------------------------
if(mysqli_num_rows($sqllmsemployee) > 0){
echo '
    <form action="salarycontrol.php" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-users" aria-hidden="true"></i> Set Employee Basic Salary </h2>
        </header>
        <div class="panel-body">
            <div class="table-responsive mt-xs mb-md">
                <table class="table table-bordered table-condensed mb-none">
                    <thead>
                        <tr>
                            <th class="center" width="60">#</th>
                            <th class="center" width="80">Photo</th>
                            <th width="40%">Name</th>
                            <th>Phone</th>
                            <th>Basic Salary</th>
                        </tr>
                    </thead>
                    <tbody>';
//-----------------------------------------------------
$srno = 0;
//-----------------------------------------------------
while($value_emp = mysqli_fetch_array($sqllmsemployee)) {
//-----------------------------------------------------
$srno++;
if($value_emp['emply_photo']) { 
    $photo = '<img src="uploads/images/employees/'.$value_emp['emply_photo'].'" alt="'.$value_emp['emply_name'].'" style="width:35px; height:35px;">' ;
} else {
    $photo = 'No Image';
}
//-----------------------------------------------------
echo '
                        <tr>
                            <td class="center">'.$srno.'</td>
                            <td class="center">'.$photo.'</td>
                            <td>'.$value_emp['emply_name'].'</td>
                            <td>'.$value_emp['emply_phone'].'</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="hidden" name="emply_id['.$srno.']" value="'.$value_emp['emply_id'].'">
                                    <input type="number" class="form-control valid" required="" name="salary['.$srno.']" value="'.$value_emp['emply_basicsalary'].'" aria-required="true" aria-invalid="false">
                                </div>
                            </td>
                        </tr>';
}
echo '
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <center>
                <button type="submit" id="update_salary" name="update_salary" class="btn btn-primary"><i class="fa fa-refresh"></i> Update</button>
            </center>
        </div>
    </form>';
}
else{
	echo '<h2 class="center">No Record Found</h2>';
}
echo '
</section>';
}
echo '
</div>
</div>';
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
<?php 
//-----------------------------------------------
if(isset($_SESSION['msg'])) { 
//-----------------------------------------------
		echo 'new PNotify({
				title	: "'.$_SESSION['msg']['title'].'"	,
				text	: "'.$_SESSION['msg']['text'].'"	,
				type	: "'.$_SESSION['msg']['type'].'"	,
				hide	: true	,
				buttons: {
					closer	: true	,
					sticker	: false
				}
			});';
//-----------------------------------------------
    unset($_SESSION['msg']);
//-----------------------------------------------
}
//-----------------------------------------------
?>	
	});
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