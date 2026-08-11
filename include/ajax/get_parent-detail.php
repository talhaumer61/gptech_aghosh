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
$sqllmstu	= $dblms->querylms("SELECT std_id, std_name, std_fathername, std_phone, std_email, std_fathercnic
                                    FROM ".STUDENTS."
                                    WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                    AND std_status = '1'  AND is_deleted != '1' AND std_id = '".$id_std."' LIMIT 1");
//--------------------------------------------
    if (mysqli_num_rows($sqllmstu) == 1) {
    $value_stu = mysqli_fetch_array($sqllmstu);
    $fatherCNIC = $value_stu['std_fathercnic'];

$sqlChildren = $dblms->querylms("
    SELECT s.std_name, c.class_name
    FROM ".STUDENTS." s
    LEFT JOIN ".CLASSES." c ON c.class_id = s.id_class
    WHERE 
        s.std_fathercnic = '$fatherCNIC'
        AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
        AND s.std_status = '1'
        AND s.is_deleted != '1'
");
$childrenList = '';

if (mysqli_num_rows($sqlChildren) > 0) {
    $childrenList .= '<div class="form-group mt-sm">
        <label class="col-md-3 control-label">Children</label>
        <div class="col-md-9">
        <ul style="margin:0;padding-left:18px;">';

    while ($child = mysqli_fetch_array($sqlChildren)) {
        $childrenList .= '<li>'.$child['std_name'].' - '.$child['class_name'].'</li>';
    }

    $childrenList .= '</ul></div></div>';
}

    echo '
    '.$childrenList.'
    <div class="form-group mt-sm">
        <label class="col-md-3 control-label"> Full Name <span class="required">*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="adm_fullname" name="adm_fullname" value="'.$value_stu['std_fathername'].'" readonly/>
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
            <input type="text" class="form-control" id="adm_username" name="adm_username" value="'.$value_stu['std_fathercnic'].'" readonly/>
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