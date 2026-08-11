<?php 

	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '21', 'updated' => '1'))){ 
	
	$sqlClass = $dblms->querylms("SELECT c.class_id, c.class_name, dd.*
                                    FROM ".CLASSES." as c
                                    INNER JOIN ".EXAM_DEMAND_DET." dd ON (
                                                                            dd.id_class = c.class_id
                                                                            AND dd.id_demand = '".cleanvars($_GET['id'])."'  
                                                                         )
                                    WHERE c.is_deleted = '0'
                                    AND c.class_status = '1'
                                    ORDER BY c.class_id
                                ");
	
echo '
    <script src="assets/javascripts/user_config/forms_validation.js"></script>
    <script src="assets/javascripts/theme.init.js"></script>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Exam Demand Detail</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive mt-sm mb-md">
                        <table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
                            <thead>
                                <tr>
                                    <th class="center" width="40">Sr.</th>
                                    <th>Class</th>
                                    <th width="150" class="center">Amount Per Student</th>
                                    <th width="110" class="center">No of Students</th>
                                    <th width="110" class="center">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>';	
                                $srno = 0;
                                $grandTotal = 0;
                                while($valClass = mysqli_fetch_array($sqlClass)){
                                    $grandTotal = $grandTotal + $valClass['total_amount'];
                                    $srno++;
                                    echo'
                                    <tr>
                                        <td class="center">'.$srno.'</td>
                                        <td>'.$valClass['class_name'].'</td>
                                        <td class="center">'.$valClass['amount_per_std'].'</td>
                                        <td class="center">'.$valClass['no_of_std'].'</td>
                                        <td class="center">'.$valClass['total_amount'].'</td>
                                    </tr>';
                                }
                                echo'
                                <tr>
                                    <th class="center" colspan="4">Grand Total</th>
                                    <th class="center">'.$grandTotal.'</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </div>';
}
//---------------------------------------------------------