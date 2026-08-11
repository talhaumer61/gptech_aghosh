<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
include_once("include/header.php");

//Today Date
$today = date('Y-m');

//Rights Check
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'view' => '1'))){
    echo'
    <title>Fee Concessions Report | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Fee Concessions Report</h2>
        </header>
        <div class="row">
            <div class="col-md-12">
                <section class="panel panel-featured panel-featured-primary">
                    <header class="panel-heading">
                        <h2 class="panel-title"><i class="fa fa-list"></i>  Fee Concessions Report</h2>
                    </header>
                    <form action="feeconcessionsReportPrint.php" target="_balnk" id="form" method="POST" accept-charset="utf-8" autocomplete="off">
                        <div class="panel-body">
                            <div class="row mb-lg">                        
                              
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class=" control-label">Date <span class="required" aria-required="true">*</span></label>
                                        <div class="input-daterange input-group" data-plugin-datepicker="" data-plugin-options="{&quot;format&quot;: &quot;yyyy-mm&quot;}">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" required title="Must Be Required" id="monthdate" name="monthdate" value="'.$today.'">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button type="submit" name="show_result" class="btn btn-primary"><i class="fa fa-search"></i> Generate Report</button>
                                
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