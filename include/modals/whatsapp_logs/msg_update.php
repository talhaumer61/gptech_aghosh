<?php 
//---------------------------------------------------------
    include "../../dbsetting/lms_vars_config.php";
    include "../../dbsetting/classdbconection.php";
    $dblms = new dblms();
    include "../../functions/login_func.php";
    include "../../functions/functions.php";
    checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'edit' => '1'))){ 
//---------------------------------------------------------
    $sqllms = $dblms->querylms("SELECT id, cellno, message, challanno
                                  FROM ".WHATSAPP_MESSAGES."
                                 WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
    $rowsvalues = mysqli_fetch_array($sqllms);
//--------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
    <form action="whatsapp_log.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
    <input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Message</h2>
        </header>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Challan No <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="cellno" id="cellno" value="'.$rowsvalues['challanno'].'" readonly />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Cell No <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="cellno" id="cellno" value="'.$rowsvalues['cellno'].'" required />
                </div>
            </div>
            <div class="form-group mb-md">
                <label class="col-md-3 control-label">Message <span class="required">*</span></label>
                <div class="col-md-9">
                    <textarea class="form-control" rows="8" name="message" id="message" required>'.$rowsvalues['message'].'</textarea>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary" id="changes_msg" name="changes_msg">Update</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </form>
</section>
</div>
</div>';
}
?>