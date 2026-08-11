<?php 
//error_reporting(0);
//session_start();
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";

if(isset($_POST['yearmonth'])){

	$yearmonth 	= date('Y-m', strtotime(cleanvars($_POST['yearmonth'])));
	$DueYear 	= date('Y', strtotime(cleanvars($_POST['yearmonth'])));
	$DueMonth 	= date('m', strtotime($yearmonth));
	
	$sqlSession = $dblms->querylms("SELECT session_startdate
											FROM ".SESSIONS." 
											WHERE session_id	= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
											AND session_status	= '1'
											AND is_deleted		= '0' ");
	$valueSession = mysqli_fetch_array($sqlSession);
	$session_startMonth = date('m', strtotime(cleanvars($valueSession['session_startdate'])));
	$session_startYear = date('Y', strtotime(cleanvars($valueSession['session_startdate'])));

	if($DueMonth >= $session_startMonth){
	//	$DueYear = $session_startYear;
		$DueDate = date(''.$DueMonth.'/15/'.$DueYear.'');
	}elseif($DueMonth == ''){
		$DueDate = date('m/15/Y');
	}else{
	//	$DueYear = $session_startYear + 1;
		$DueDate = date(''.$DueMonth.'/15/'.$DueYear.'');
	}

    echo'
    <label class="control-label">Due Date <span class="required">*</span></label>
    <input type="text" class="form-control" name="due_date" id="due_date" value="'.$DueDate.'" data-plugin-datepicker required title="Must Be Required"/>';
}
?>