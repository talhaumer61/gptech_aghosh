<?php
include "../../../dbsetting/lms_vars_config.php";
include "../../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../../functions/login_func.php";
include "../../../functions/functions.php";
checkCpanelLMSALogin();
	
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '21', 'updated' => '1'))){ 
	
	$sqlClass = $dblms->querylms("SELECT *
                                    FROM ".EXAM_FEE_CHALLANS." 
                                    WHERE id = '".cleanvars($_GET['id'])."'
                                    LIMIT 1
                                ");
    $value = mysqli_fetch_array($sqlClass);
    echo '
    <script src="assets/javascripts/user_config/forms_validation.js"></script>
    <script src="assets/javascripts/theme.init.js"></script>
    <div class="row">
        <div class="col-md-12">
            <form action="exam_registration_challans.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
                <section class="panel panel-featured panel-featured-primary">
                    <header class="panel-heading">
                        <h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Exam Registration Challan</h2>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Session <span class="required">*</span></label>
                                <select data-plugin-selectTwo data-width="100%" id="id_session" name="id_session" required title="Must Be Required" disabled class="form-control populate">
                                    <option value="">Select</option>';
                                        $sqlSession	= $dblms->querylms("SELECT session_id, session_name 
                                                                            FROM ".SESSIONS."
                                                                            WHERE is_deleted    = '0'
                                                                            AND session_status  = '1'
                                                                        ");
                                        while($valSession = mysqli_fetch_array($sqlSession)) {
                                            echo '<option value="'.$valSession['session_id'].'" '.($valSession['session_id']==$value['id_session'] ? 'selected' : '').'>'.$valSession['session_name'].'</option>';
                                        }
                                    echo'
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Campus <span class="required">*</span></label>
                                <select data-plugin-selectTwo data-width="100%" name="campus" id="campus" required disabled title="Must Be Required" class="form-control populate">
                                    <option value="">Select</option>';
                                    $sqllmscampus	= $dblms->querylms("SELECT c.campus_id, c.campus_name
                                                                            FROM ".CAMPUS." c  
                                                                            WHERE c.campus_id != '' AND campus_status = '1'
                                                                            ORDER BY c.campus_name ASC");
                                    while($value_campus = mysqli_fetch_array($sqllmscampus)){
                                        echo'<option value="'.$value_campus['campus_id'].'" '.($value_campus['campus_id'] == $value['id_campus'] ? 'selected' : '').'>'.$value_campus['campus_name'].'</option>';
                                    }
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Type <span class="required">*</span></label>
                                <select data-plugin-selectTwo data-width="100%" id="id_examtype" name="id_examtype" disabled required title="Must Be Required" class="form-control populate">
                                    <option value="">Select</option>';
                                        $sqlExamType	= $dblms->querylms("SELECT type_id, type_name 
                                                                            FROM ".EXAM_TYPES."
                                                                            WHERE is_deleted    = '0'
                                                                            AND type_status     = '1'
                                                                        ");
                                        while($valExamType = mysqli_fetch_array($sqlExamType)) {
                                            echo '<option value="'.$valExamType['type_id'].'" '.($valExamType['type_id']==$value['id_examtype'] ? 'selected' : '').'>'.$valExamType['type_name'].'</option>';
                                        }
                                    echo'
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Payable <span class="required">*</span></label>
                                <input type="text" class="form-control" name="total_amount" readonly id="total_amount" value="'.$value['total_amount'].'" required title="Must Be Required"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Issue Date <span class="required">*</span></label>
                                <input type="text" class="form-control" name="issue_date" id="issue_date" readonly value="'.date('m/d/Y', strtotime($value['issue_date'])).'" required title="Must Be Required"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Due Date <span class="required">*</span></label>
                                <input type="text" class="form-control" name="due_date" id="due_date" value="'.date('m/d/Y', strtotime($value['due_date'])).'" data-plugin-datepicker required title="Must Be Required"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label id="label_paid_date" class="control-label">Paid Date </label>
                                <input type="text" class="form-control" name="paid_date" id="paid_date" data-plugin-datepicker title="Must Be Required"/>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="paid_amount" id="paid_amount" value="'.$value['total_amount'].'"  title="Must Be Required"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Note </label>
                                <textarea class="form-control" name="note">'.$value['class="form-control"'].'</textarea>
                            </div>
                        </div>
                        <div class="form-group mt-md">
                            <label class="col-sm-2 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-custom radio-inline">
                                    <input type="radio" id="status1" name="status" '.($value['status'] == '1' ? 'checked' : '').' value="1">
                                    <label for="radioExample1">Paid</label>
                                </div>
                                <div class="radio-custom radio-inline">
                                    <input type="radio" id="status2" name="status" '.($value['status'] == '2' ? 'checked' : '').' value="2">
                                    <label for="radioExample2">Pending</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary" id="update_challan" name="update_challan">Update</button>
                                <button class="btn btn-default modal-dismiss">Cancel</button>
                            </div>
                        </div>
                    </footer>
                </section>
            </form>
        </div>
    </div>';
}
?>
<script>
    $(document).ready(function(){
        var sts1 = $('#status1'); 
        var sts2 = $('#status2'); 
        var paidDate = $('#paid_date'); 
        var label = $('#label_paid_date'); 
        $(sts1).click(function(){
            paidDate.attr('required', '');
            label.append('<span class="required">*</span>');
        });
        $(sts2).click(function(){
            paidDate.removeAttr('required');
            label.html('Paid Date ');
        });
    });
</script>