<?php 
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
    
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
	// Personal Information
    $sqllmsStudent	= $dblms->querylms("SELECT s.std_id, s.std_name, s.std_status, s.id_class, s.std_fathername, s.id_session, 
											s.std_photo, s.std_regno, c.class_name, se.section_name, ss.session_name, fs.id AS idsetup
                                            FROM ".STUDENTS." s		   
                                            INNER JOIN ".CLASSES." c ON c.class_id = s.id_class	 	
                                            LEFT JOIN ".CLASS_SECTIONS." se ON se.section_id = s.id_section					 
                                            INNER JOIN ".SESSIONS." ss ON ss.session_id = s.id_session	
											INNER JOIN ".FEESETUP." fs ON s.id_class = fs.id_class AND fs.id_session = s.id_session 
                                            WHERE s.id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                            AND s.std_id        = '".cleanvars($_GET['id_std'])."' 
                                            AND s.is_deleted    = '0'
											AND fs.is_deleted   = '0' 
                                            AND fs.status    	= '1' 
											AND fs.id_campus    = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
                                            LIMIT 1 ");

	$valStdDet = mysqli_fetch_array($sqllmsStudent);
    
    if($valStdDet['std_photo']){
        $photo = "uploads/images/students/".$valStdDet['std_photo']."";
    }
    else{
        $photo = "uploads/default-student.jpg";
    }


    //Check Student Hostel Registration
    $sqllmHostelRegistration	= $dblms->querylms("SELECT id 
                                                    FROM ".HOSTEL_REG."
                                                    WHERE status    = '1' 
                                                    AND id_std      = '".$valStdDet['std_id']."'
                                                    AND id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                    LIMIT 1");
    //If Hostelized Add Fee Cats
    if (mysqli_num_rows($sqllmHostelRegistration) == 1) {
        $hostel_cats = ""; 
    }
    else{
        $hostel_cats = ",6,7,8"; 
    }
	
	 // Total Pkg                                           
	$sqllmsTotPkg	= $dblms->querylms("SELECT	SUM(d.amount) as totalPkg
                                                FROM ".FEESETUPDETAIL." d
                                                WHERE id_setup = '".$valStdDet['idsetup']."'
                                                AND (duration != 'Select' OR duration = '') 
                                                AND duration = 'Monthly'
                                                AND id_cat NOT IN (1,4,5$hostel_cats) ");
	$valTotPkg = mysqli_fetch_array($sqllmsTotPkg);
// Get all Student Concessions
	$conditions = array ( 
								  'select' 		=> 'SUM(s.amount) AS TotalConcess'
								, 'join' 		=> "INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std 
													INNER JOIN ".CLASSES." cl ON cl.class_id = s.id_class  
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session"
								, 'where' 		=> array( 
															  'st.id_campus' => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 's.id_std' 	 => $valStdDet['std_id']
															, 's.id_type' 	 => 2 
															, 's.id_session' => $_SESSION['userlogininfo']['ACADEMICSESSION']
															, 's.is_deleted' => 0 
														) 
								, 'limit' 		=> 1
								, 'return_type' => 'single' 
							); 
	$rowsconcession	= $dblms->getRows(SCHOLARSHIP.' s ', $conditions);
    
    $sqllmsAcc	= $dblms->querylms("SELECT f.id, f.status, f.id_month, f.challan_no, f.issue_date, f.paid_date, 
											f.due_date, f.total_amount, f.paid_amount, f.remaining_amount,  c.class_name, cs.section_name, s.session_name
                                    FROM ".FEES." f		
                                    INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
                                    LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section						 
                                    INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session				
                                    WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND f.id_std = '".cleanvars($_GET['id_std'])."'
                                    AND f.is_deleted != '1'
                                    ORDER BY f.yearmonth DESC");

    echo'
    <script src="assets/javascripts/user_config/forms_validation.js"></script>
    <script src="assets/javascripts/theme.init.js"></script>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="glyphicon glyphicon-user"></i> Student Information </h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-sm">
                        <div class="col-md-12">
                            <h2 class="panel-title mb-sm">Basic Information</h2>
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th class="center">Photo</th>
                                        <th>Student Name </th>
                                        <th>Father Name </th>
                                        <th>Session </th>
                                        <th>Reg #</th>
                                        <th>Class</th>';
                                        if($valStdDet['section_name']){echo'<th>Section</th>';}
                                        echo'
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">
                                            <img class="img-fluid" src="'.$photo.'" width="50" height="50">
                                        </td>
                                        <td>'.$valStdDet['std_name'].'</td>
                                        <td>'.$valStdDet['std_fathername'].'</td>
                                        <td>'.$valStdDet['session_name'].'</td>
                                        <td>'.$valStdDet['std_regno'].'</td>                              
                                        <td>'.$valStdDet['class_name'].'</td>'; 
                                        if($valStdDet['section_name']){echo'<td>'.$valStdDet['section_name'].'</td>';}
                                        echo'                         
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th class="center">Status</th>
                                        <th>Actual Fee </th>
                                        <th>Discount </th>
                                        <th>Fee After Discount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">'.get_stdstatus($valStdDet['std_status']).'</td>
                                        <td>Rs '.number_format($valTotPkg['totalPkg']).'</td>
                                        <td>Rs '.number_format($rowsconcession['TotalConcess']).'</td>
                                        <td>Rs '.number_format($valTotPkg['totalPkg']-$rowsconcession['TotalConcess']).'</td>                      
                                    </tr>
                                </tbody>
                            </table>
                            <h2 class="panel-title mt-md mb-sm">Accounts Information</h2>';
                            if(mysqli_num_rows($sqllmsAcc) > 0){
                            echo'
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th>Challan #</th>
                                        <th>Session</th>
                                        <th>Class</th>
                                        <th>Month</th>
                                        <th>Issue Date</th>
                                        <th>Due Date</th>
                                        <th>Paid Date</th>
                                        <th width="70;" style="text-align:center;">Status</th>
                                        <th width="70" style="text-align:center;">Print</th>
                                        <th class="center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $srno = 0;   
                                    $grandTotal = 0;
                                    $grandPaid = 0;

                                    while($valAccounts = mysqli_fetch_array($sqllmsAcc)) {
                                        //---------------- Online Payment ----------------------
                                        // $sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
                                        //                                 FROM ".PAY_API_TRAN." 
                                        //                                 WHERE challan_no = '".cleanvars($valAccounts['challan_no'])."'");
                                        // $onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
                                        // if($onlinePaid['total_paid'] >= $valAccounts['total_amount']){
                                        //     $status = '1';
                                        // }elseif($onlinePaid['total_paid'] < $valAccounts['total_amount'] && $onlinePaid['total_paid'] != 0){
                                        //     $status = 4;
                                        // } else{

                                        //     $status = $valAccounts['status'];
                                        // }
                                        //-----------------------------------------------------
                                        
                                        // After Due Date
                                        if( $valAccounts['status'] == '1'){
                                            $totalAmount = $valAccounts['paid_amount'] ;
                                        }elseif(date('Y-m-d') > $valAccounts['due_date'] && $valAccounts['status'] != '1') {
                                            $totalAmount = $valAccounts['total_amount'] + LATEFEE;
                                        }else{
                                            $totalAmount = $valAccounts['total_amount'];
                                        }
                                        $totalPaid = $valAccounts['paid_amount'];

                                        $srno++;
                                        $paidDate = '';
                                        if($valAccounts['paid_date'] != '0000-00-00'){$paidDate = $valAccounts['paid_date'];}
                                        echo'
                                        <tr>
                                            <td style="text-align:center;">'.$srno.'</td>
                                            <td>'.$valAccounts['challan_no'].'</td>
                                            <td>'.$valAccounts['session_name'].'</td>
                                            <td>'.$valAccounts['class_name'].' '; if($valAccounts['section_name']){echo' ('.$valAccounts['section_name'].') ';} echo'</td>
                                            <td>'.get_monthtypes($valAccounts['id_month']).'</td>
                                            <td>'.$valAccounts['issue_date'].'</td>
                                            <td>'.$valAccounts['due_date'].'</td>
                                            <td>'.$paidDate.'</td>
                                            <td style="text-align:center;">'.get_payments($valAccounts['status']).'</td>      
                                            <td style="text-align:center;">';
                                            if($valAccounts['status'] ==1 || ($valAccounts['status'] ==2 && date('Y-m-d') <= $valAccounts['due_date'])){
                                                echo'<a class="btn btn-info text-light btn-xs" style="text-align:center;" href="feechallanprint.php?id='.$valAccounts['challan_no'].'" target="_blank"> <i class="fa fa-file"></i></a>';
                                            }
                                            echo'
                                            </td> 
                                            <td class="text-right">'.number_format(round($totalAmount)).'</td>                  
                                        </tr>';

                                        $grandTotal = $grandTotal + $totalAmount;
                                        $grandPaid = $grandPaid + $totalPaid;
                                    }
                                    echo'
                                    <tr>
                                        <th colspan="10">Total Due Fee</th>
                                        <th style="text-align: right;">'.number_format($grandTotal).'</th>
                                    </tr>
                                    <tr>
                                        <th colspan="10">Total Paid</th>
                                        <th style="text-align: right;">'.number_format($grandPaid).'</th>
                                    </tr>
                                    <tr>
                                        <th colspan="10">Balance</th>
                                        <th style="text-align: right;">'.number_format($grandTotal - $grandPaid).'</th>
                                    </tr>
                                </tbody>
                            </table>';
                            }
                            else{
                                echo'<h2 class="text-center text-danger">No Challan Found!</h2>';
                            }
                            echo'
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