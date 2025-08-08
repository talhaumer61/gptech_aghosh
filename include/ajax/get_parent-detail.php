<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['id_std'])) {
	$id_std = $_POST['id_std']; 
//--------------------------------------------
$sqllmstu	= $dblms->querylms("SELECT std_id, std_name, std_phone, std_email, std_regno
                                    FROM ".STUDENTS."
                                    WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                    AND std_status = '1'  AND is_deleted != '1' AND std_id = '".$id_std."' LIMIT 1");
//--------------------------------------------
    if (mysqli_num_rows($sqllmstu) == 1) {
    $value_stu = mysqli_fetch_array($sqllmstu);
    echo '
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Full Name <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_fullname" name="adm_fullname" value="'.$value_stu['std_name'].'" readonly/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Phone </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_phone" name="adm_phone" value="'.$value_stu['std_phone'].'" readonly/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Email </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_email" name="adm_email" value="'.$value_stu['std_email'].'" />
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_username" name="adm_username" value="'.$value_stu['std_regno'].'@ags.edu.pk" readonly/>
        </div>
    </div>';
    //---------------------------------------
    }
    else{
    echo '
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Full Name <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_fullname" name="adm_fullname" required title="Must Be Required"/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Phone </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_phone" name="adm_phone"/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Email </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_email" name="adm_email"/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_username" name="adm_username"  required title="Must Be Required"/>
        </div>
    </div>';
    }
}
?>