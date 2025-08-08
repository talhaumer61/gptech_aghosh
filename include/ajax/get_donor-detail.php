<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['id_donor'])) {

	$id_donor = $_POST['id_donor']; 

    //--------------------------------------------
    $sqllmDonor	= $dblms->querylms("SELECT donor_id, donor_name, donor_phone, donor_email
                                        FROM ".DONORS."
                                        WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        AND donor_status = '1'  AND is_deleted != '1' AND donor_id = '".$id_donor."' LIMIT 1");
    //--------------------------------------------
    if (mysqli_num_rows($sqllmDonor) == 1) {
        $valueDonor = mysqli_fetch_array($sqllmDonor);
        echo '
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Name <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_fullname" name="adm_fullname" value="'.$valueDonor['donor_name'].'" readonly/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Phone </label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_phone" name="adm_phone" value="'.$valueDonor['donor_phone'].'" readonly/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Email </label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_email" name="adm_email" value="'.$valueDonor['donor_email'].'" readonly/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_username" name="adm_username" value="'.$valueDonor['donor_email'].'" readonly/>
            </div>
        </div>';
    } else {
        echo '
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Name <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_fullname" name="adm_fullname" required title="Must Be Required"/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Phone <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_phone" name="adm_phone"/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Email <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_email" name="adm_email"/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_username" name="adm_username"  required title="Must Be Required"/>
            </div>
        </div>
        <div class="form-group mt-sm">
            <label class="col-md-3 control-label"> Username <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="adm_username" name="adm_username"/>
            </div>
        </div>';
    }
}
?>