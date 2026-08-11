<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
include_once("include/header.php");

//Today Date
$today = date('d-m-Y');

//Rights Check
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
    echo'
    <title>Monthly Fee & Concession Report | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Monthly Fee & Concession Report</h2>
        </header>
        <div class="row">
            <div class="col-md-12">
                <section class="panel panel-featured panel-featured-primary">
                    <header class="panel-heading">
                        <h2 class="panel-title"><i class="fa fa-list"></i> Monthly Fee & Concession Report</h2>
                    </header>
                    <form action="monthly_fee_concession_report_print.php" target="_blank" id="form" method="POST" accept-charset="utf-8" autocomplete="off">
                        <div class="panel-body">
                            <div class="row mb-lg">                        
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        <label class="control-label">Class Group <span class="required">*</span></label>                                        
                                        <select data-plugin-selectTwo data-width="100%" name="id_classgroup" id="id_classgroup" required title="Must Be Required" class="form-control populate">
                                            <option value="">Select</option>';
                                            foreach ($classgroup as $group):
                                                if($group['id'] != 2){
                                                    echo'<option value="'.$group['id'].'|'.$group['name'].'">'.$group['name'].'</option>';
                                                }
                                            endforeach;
                                            echo'
                                        </select>
                                    </div>
                                </div>      
                            </div>
                            <center>
                                <button type="submit" name="detail_result" class="btn btn-primary"><i class="fa fa-search"></i> Detail Report</button>
                                <button type="submit" name="summary_result" class="btn btn-primary"><i class="fa fa-search"></i> Summary Report</button>
                            </center>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>';
}
include_once("include/footer.php");
?>