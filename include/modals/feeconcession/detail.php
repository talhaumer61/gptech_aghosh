<?php 
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
    
//if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){ 
	// Personal Information
    $sqllmsStudent	= $dblms->querylms("SELECT SUM(sp.amount) AS TotalConcess, s.std_id, s.std_name, s.std_status, s.id_class, fs.id, 
												s.std_fathername, s.id_session, s.std_photo, s.std_regno, c.class_name, se.section_name, ss.session_name 
                                            FROM ".SCHOLARSHIP." sp		   
                                           	INNER JOIN ".STUDENTS." s ON s.std_id = sp.id_std 
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
                                            AND sp.is_deleted   = '0' LIMIT 1 ");

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
    if(mysqli_num_rows($sqllmHostelRegistration) == 1) {
        $hostel_cats = ""; 
    } else{
        $hostel_cats = ",6,7,8"; 
    }
	 // Total Pkg                                           
	$sqllmsTotPkg	= $dblms->querylms("SELECT	SUM(d.amount) as totalPkg
                                                FROM ".FEESETUPDETAIL." d
                                                WHERE id_setup = '".$valStdDet['id']."'
                                                AND (duration != 'Select' OR duration = '') 
                                                AND duration = 'Monthly'
                                                AND id_cat NOT IN (1,4,5$hostel_cats) ");
	$valTotPkg = mysqli_fetch_array($sqllmsTotPkg);
// Get all Student Concessions
	$consconditions = array ( 
								  'select' 		=> 's.*, st.std_id, st.std_name, st.std_fathername, st.std_regno,
								 					c.cat_name, fc.cat_name as Feehead, st.id_class, cl.class_name, se.session_id, se.session_name'
								, 'join' 		=> "INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std 
													INNER JOIN ".CLASSES." cl ON cl.class_id = s.id_class  
													INNER JOIN ".SCHOLARSHIP_CAT." c ON c.cat_id = s.id_cat 
													INNER JOIN ".FEE_CATEGORY." fc ON fc.cat_id = s.id_feecat  
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session"
								, 'where' 		=> array( 
															  's.id_campus' => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 's.id_std' 	 => $_GET['id_std'] 
															, 's.id_session' => $_SESSION['userlogininfo']['ACADEMICSESSION']
															, 's.is_deleted' => 0 
														) 
								, 'order_by' 	=> ' s.date DESC '
								, 'return_type' => 'all' 
							); 
	$concessions 	= $dblms->getRows(SCHOLARSHIP.' s ', $consconditions);

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
                                        <th>Session</th>
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
                                        <td>Rs '.number_format(($valStdDet['TotalConcess'])).'</td>
                                        <td>Rs '.number_format($valTotPkg['totalPkg'] - $valStdDet['TotalConcess']).'</td>                      
                                    </tr>
                                </tbody>
                            </table>
                            <h2 class="panel-title mt-md mb-sm">Concession Details</h2>';
                           
                            echo'
                            <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                       <th class="text-center" style="width:70px;">Sr #</th>
										<th style="width:100px;">Date</th>
										<th>Concession Category</th>
										<th>Concession head</th>
										<th>Authority </th>
										<th style="width:100px;">Amount</th>
										<th style="width:70px;">Status</th>
										
                                    </tr>
                                </thead>
								
                                <tbody>';
						$totalcons = 0;
						$srno = 0;
						foreach($concessions as $listconcess) :
						$srno++;
							echo '
									<tr>
										<td class="text-center">'.$srno.'</td>
										<td>'.$listconcess['date'].'</td>
										<td>'.$listconcess['cat_name'].'</td>
										<td>'.$listconcess['Feehead'].'</td>
										<td>'.get_authority($listconcess['id_authority']).'</td>
										<td class="text-right">'.number_format($listconcess['amount']).'</td>
										<td class="text-center">'.get_status($listconcess['status']).'</td>
										
									</tr>';
						$totalcons = ($totalcons + $listconcess['amount']);
						endforeach;
						echo '
								</tbody>
								<tfoot>
									<tr>
										<td class="text-right" colspan="5"><b>Actual Fee</b></td>
										<td class="text-right" colspan="3">
											<input type="text" id="netGrandTotal" class="form-control" name="net_grand_total" value="'.number_format($valTotPkg['totalPkg']).'" readonly />
										</td>

									</tr>
									<tr>
										<td class="text-right" colspan="5"><b>Total Concession Granted </b></td>
										<td class="text-right" colspan="3">
											<input type="text" id="netGrandTotal" class="form-control" name="net_grand_total" value="'.number_format($totalcons).'" readonly />
										</td>

									</tr>

									<tr>
										<td class="text-right" colspan="5"><b>Monthly Fee  </b></td>
										<td class="text-right" colspan="3">
											<input type="text" id="netGrandTotal" class="form-control" name="net_grand_total" value="'.number_format($valTotPkg['totalPkg']-$totalcons).'" readonly />
										</td>
									</tr>

								</tfoot>
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
//}
