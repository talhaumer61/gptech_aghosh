<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
//---------------------------------------------------------
	

    // //------------ Personal Information ---------------------
    // $sqllmsStudent	= $dblms->querylms("SELECT s.std_id, s.std_name, s.std_fathername, s.std_photo, s.std_regno, c.class_name, se.section_name, ss.session_name
    //                                         FROM ".STUDENTS." s		   
    //                                         INNER JOIN ".CLASSES." c ON c.class_id = s.id_class	 	
    //                                         LEFT JOIN ".CLASS_SECTIONS." se ON se.section_id = s.id_section					 
    //                                         INNER JOIN ".SESSIONS." ss ON ss.session_id = s.id_session		
    //                                         WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
    //                                         AND s.std_id = '".cleanvars($_GET['id_std'])."' LIMIT 1 ");
    // //---------------------------------------------------------
	// $valStdDet = mysqli_fetch_array($sqllmsStudent);
    // //---------------------------------------------------------
    // if($valStdDet['std_photo']){
    //     $photo = "uploads/images/students/".$valStdDet['std_photo']."";
    // }
    // else{
    //     $photo = "uploads/default-student.jpg";
    // }
    // //---------------------------------------------------------

    //------------- Accounts Details ---------------------
    $sqllmsAcc	= $dblms->querylms("SELECT f.id, f.status, f.pay_mode, f.id_month, f.challan_no, f.issue_date, f.paid_date, f.paid_amount, f.note, f.due_date, f.total_amount, f.paid_amount, f.remaining_amount,
                                    c.class_name, cs.section_name, s.session_name, st.std_name, st.std_fathername, st.std_regno, q.name, q.fathername, q.form_no
                                    FROM ".FEES." f		
                                    INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
                                    LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section						 
                                    INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session					 
                                    LEFT JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std		
                                    LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no = f.inquiry_formno	
                                    WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND f.challan_no = '".cleanvars($_GET['challan_no'])."'
                                    AND f.is_deleted != '1'
                                    ORDER BY f.challan_no DESC");
    $valAccounts = mysqli_fetch_array($sqllmsAcc);

    //---------------- Online Payment ----------------------
	// $sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
	// 								FROM ".PAY_API_TRAN." 
	// 								WHERE challan_no = '".cleanvars($valAccounts['challan_no'])."'");
    // $onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
    
    //Payment Status
    if($valAccounts['paid_amount'] >= $valAccounts['total_amount']){
        $status = '1';
    }elseif($valAccounts['paid_amount'] < $valAccounts['total_amount'] && $valAccounts['paid_amount'] != 0){
        $status = 4;
    }else{
        $status = $valAccounts['status'];
    }
    //Std Details
    if($valAccounts['std_name']){ $stdName = $valAccounts['std_name'];} else {$stdName = $valAccounts['name'];}
    if($valAccounts['std_fathername']){ $stdFather = $valAccounts['std_fathername'];} else {$stdFather = $valAccounts['fathername'];}
    if($valAccounts['std_regno']){ $stdRegisInquiry = $valAccounts['std_regno']; $titleRegisInquiry = 'Reg';} else {$stdRegisInquiry = $valAccounts['form_no']; $titleRegisInquiry = 'Form';}
    
    $remaining = $valAccounts['total_amount'] - $valAccounts['paid_amount'];
	//------------------ Fee Paticulars ----------------
    $sqllmsPart = $dblms->querylms("SELECT p.id, p.id_fee, p.amount, p.concession, c.cat_name
                                        FROM ".FEE_PARTICULARS." p	
                                        INNER JOIN ".FEE_CATEGORY." c ON c.cat_id = p.id_cat	
                                        WHERE id_fee = '".cleanvars($valAccounts['id'])."'
                                        ORDER BY c.cat_ordering DESC");
    //-----------------------------------------------------

	//------------------ Fee Log ----------------
     $sqllmsLog = $dblms->querylms("SELECT l.dated, l.ip, l.remarks, u.adm_fullname
                                        FROM ".ACCOUNTS_LOGS." l
                                        INNER JOIN ".ADMINS." u ON u.adm_id = l.id_user	
                                        WHERE (l.challan_no = '".cleanvars($valAccounts['challan_no'])."' OR l.challan_no = '".cleanvars($valAccounts['id'])."')
                                        AND l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        ORDER BY l.id ASC");
    //-----------------------------------------------------
    $month = date('n');
    echo'
    <script src="assets/javascripts/user_config/forms_validation.js"></script>
    <script src="assets/javascripts/theme.init.js"></script>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="fa fa-file"></i> Challan Information</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-sm">
                        <div class="col-md-12">
                            <h2 class="panel-title mb-sm">Basic Information</h2>
                            <div class="text-right" style="margin-top: -25px; margin-bottom: 5px;">
                                '.get_payments($status).'
                                '.get_paymethod($valAccounts['pay_mode']).'
                                ';
                                if($status ==1 || ($status ==2 && $month <= $valAccounts['id_month'])){
                                    echo'<a class="btn btn-info text-light btn-xs" class="center" href="feechallanprint.php?id='.$valAccounts['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
                                }
                                echo'
                            </div>
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th>Challan # </th>
                                        <td>'.$valAccounts['challan_no'].'</td>
                                        <th>Issue Date </th>
                                        <td>'.$valAccounts['issue_date'].'</td>
                                        <th>Due Date </th>
                                        <td>'.$valAccounts['due_date'].'</td>
                                    </tr>
                                    <tr>
                                        <th>Student </th>
                                        <td colspan="2">'.$stdName.'</td>
                                        <th>Father </th>
                                        <td colspan="2">'.$stdFather.'</td>
                                    </tr>
                                    <tr>
                                        <th>'.$titleRegisInquiry.' #</th>
                                        <td>'.$stdRegisInquiry.'</td>
                                        <th>Class </th>                
                                        <td colspan="3">
                                            '.$valAccounts['class_name'].'';
                                            if($valAccounts['section_name']){
                                                echo'<td>'.$valAccounts['section_name'].'</td>';
                                            }
                                            echo'
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>                                          '; 
                                        if($valAccounts['section_name']){echo'<td>'.$valAccounts['section_name'].'</td>';}
                                        echo'                         
                                    </tr>
                                </tbody>
                            </table>
                            
                            <h2 class="panel-title mt-md mb-sm">Challan Detail</h2>
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th class="center" width="70">Sr # </th>
                                        <th>Category </th>
                                        <th class="center" width="100">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $srno = 0;
                                    $totalAmount = 0;
                                    while($valPart = mysqli_fetch_array($sqllmsPart)) {
                                        $srno++;

                                        echo'
                                        <tr>
                                            <td class="center">'.$srno.'</td>
                                            <td>'.$valPart['cat_name'].'</td>
                                            <td class="text-right">'.number_format($valPart['amount']).'</td>
                                        </tr>';
                                        $totalAmount = $totalAmount + $valPart['amount'];
                                    }
                                    
                                    if(date('Y-m-d') > $valAccounts['due_date'] && $status != '1'){
                                        echo'
                                        <tr>
                                            <td class="center">'.$srno.'</td>
                                            <td>Late Fee Fine</td>
                                            <td class="text-right">'.number_format(LATEFEE).'</td>
                                        </tr>';
                                        $totalAmount = $totalAmount + LATEFEE;
                                    }
                                    if($valAccounts['paid_date'] > $valAccounts['due_date'] && $status == '1'){
                                        echo'
                                        <tr>
                                            <td class="center">'.$srno.'</td>
                                            <td>Late Fee Fine</td>
                                            <td class="text-right">'.number_format(LATEFEE).'</td>
                                        </tr>';
                                        $totalAmount = $totalAmount + LATEFEE;
                                    }
                                    echo'
                                    <tr>
                                        <th class="bg bg-success" colspan="2">Total Amount</th>
                                        <th class="text-right bg bg-success">'.number_format($totalAmount).'</th>
                                    </tr>
                                    ';
                                    if($status == '4' || $status == '1'){
                                        $pendingAmount = $totalAmount - $valAccounts['paid_amount'];
                                        echo' 
                                        <tr>
                                            <th class="bg bg-info" colspan="2">'.($status == '4' ? 'Partial' : '').' Paid Amount</th>
                                            <th class="text-right bg bg-info">'.number_format($valAccounts['paid_amount']).'</th>
                                        </tr> 
                                        <tr>
                                            <th class="bg bg-primary" colspan="2">Pending Amount</th>
                                            <th class="text-right bg bg-primary">'.number_format($pendingAmount).'</th>
                                        </tr> 
                                            <tr>
                                                <th class="bg bg-warning">Remarks/*Note</th>
                                                <th class="text-center bg bg-warning" colspan="2">'.$valAccounts['note'].'</th>
                                            </tr>';
                                        
                                    }
                                    echo'
                                    <!-- <tr>
                                        <th class="bg bg-danger" colspan="2">Arrears</th>
                                        <th class="text-right bg bg-danger">'.number_format($valAccounts['remaining_amount']).'</th>
                                    </tr> -->
                                </tbody>
                            </table>
                            
                            <h2 class="panel-title mt-md mb-sm">Challan Log</h2>
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th class="center"># </th>
                                        <th>Remarks </th>
                                        <th width"100">By </th>
                                        <th width="225">Dated </th>
                                        <th width="150">Ip </th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $srno = 0;
                                    while($valLog = mysqli_fetch_array($sqllmsLog)) {
                                        $srno++;
                                        echo'<tr>
                                            <td class="center">'.$srno.'</td>
                                            <td>'.$valLog['remarks'].'</td>
                                            <td>'.$valLog['adm_fullname'].'</td>
                                            <td class="center">'.date('l, d F y h:i:s', strtotime($valLog['dated'])).'</td>
                                            <td class="center">'.$valLog['ip'].'</td>
                                        </tr>';
                                    }
                                    echo'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss">Cancel </button>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </div>';
}
?>