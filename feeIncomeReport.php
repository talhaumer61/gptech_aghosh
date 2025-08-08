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
    <title>Fee Income Report | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Fee Income Report</h2>
        </header>
        <div class="row">
            <div class="col-md-12">
                <section class="panel panel-featured panel-featured-primary">
                    <header class="panel-heading">
                        <h2 class="panel-title"><i class="fa fa-list"></i>  Fee Income Report</h2>
                    </header>
                    <form action="feeIncomeReportPrint.php" target="_balnk" id="form" method="POST" accept-charset="utf-8" autocomplete="off">
                        <div class="panel-body">
                            <div class="row mb-lg">                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Pay Mode </label>
                                        <select data-plugin-selectTwo data-width="100%" name="pay_mode" id="pay_mode" title="Must Be Required" class="form-control populate">
                                            <option value="">Select</option>';
                                            foreach($paymethod as $mode){
                                                echo'<option value="'.$mode['id'].'|'.$mode['name'].'" '.($mode['id'] == $pay_mode ? 'selected' : '').'>'.$mode['name'].'</option>';
                                            }
                                            echo'
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class=" control-label">Date <span class="required" aria-required="true">*</span></label>
                                        <div class="input-daterange input-group" data-plugin-datepicker="" data-plugin-options="{&quot;format&quot;: &quot;dd-mm-yyyy&quot;}">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" required title="Must Be Required" name="from_date" value="'.$today.'">
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="form-control" required title="Must Be Required" name="to_date" value="'.$today.'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button type="submit" name="show_result" class="btn btn-primary"><i class="fa fa-search"></i> Income Head wise Report</button>
                                <button type="submit" name="show_detailed_result" class="btn btn-primary"><i class="fa fa-search"></i> Student wise Report</button>
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