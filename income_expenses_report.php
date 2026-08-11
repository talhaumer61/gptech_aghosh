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
            <h2>Income & Expenses Report</h2>
        </header>
        <div class="row">
            <div class="col-md-12">
                <section class="panel panel-featured panel-featured-primary">
                    <header class="panel-heading">
                        <h2 class="panel-title"><i class="fa fa-list"></i> Income & Expenses Report</h2>
                    </header>
                    <form action="income_expenses_report_print.php" target="_balnk" id="form" method="POST" accept-charset="utf-8" autocomplete="off">
                        <div class="panel-body">
                            <div class="row mb-lg">                        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Class Group <span class="required">*</span></label>                                        
                                        <select data-plugin-selectTwo data-width="100%" name="id_classgroup" id="id_classgroup" required title="Must Be Required" class="form-control populate">
                                            <option value="">Select</option>';
                                            foreach ($classgroup as $group):
                                                echo'<option value="'.$group['id'].'|'.$group['name'].'">'.$group['name'].'</option>';
                                            endforeach;
                                            echo'
                                        </select>
                                    </div>
                                </div>                                            
                                <div class="col-md-6">
                                    <label class="control-label">For Month <span class="required">*</span></label>
                                    <input type="month" class="form-control" name="yearmonth" id="yearmonth" value=""  required title="Must Be Required"  onchange="get_duedate(this.value)"/>
                                </div>
                            </div>
                            <center>
                                <button type="submit" name="show_result" class="btn btn-primary"><i class="fa fa-search"></i> Filter Report</button>
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