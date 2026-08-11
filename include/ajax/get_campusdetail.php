<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['id_campus'])) {
	$id_campus = $_POST['id_campus']; 
//--------------------------------------------
$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_name, campus_email, campus_phone, campus_head
                                    FROM ".CAMPUS." 
                                    WHERE campus_status = '1' AND is_deleted != '1' AND campus_id = '".$id_campus."' LIMIT 1");
//--------------------------------------------
    if (mysqli_num_rows($sqllmscampus) == 1) {
        $value_camp = mysqli_fetch_array($sqllmscampus);
    echo '
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Full Name <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_fullname" name="adm_fullname" value="'.$value_camp['campus_head'].'" readonly/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Email <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_email" name="adm_email" value="'.$value_camp['campus_email'].'" readonly/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Phone </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_phone" name="adm_phone" value="'.$value_camp['campus_phone'].'" readonly/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_username" name="adm_username" value="'.$value_camp['campus_email'].'" required title="Must Be Required"/>
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
        <label class="col-md-3 control-label"> Email <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_email" name="adm_email" required title="Must Be Required"/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Phone </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_phone" name="adm_phone"/>
        </div>
    </div>
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_username" name="adm_username" required title="Must Be Required"/>
        </div>
    </div>';
    }
}
?>