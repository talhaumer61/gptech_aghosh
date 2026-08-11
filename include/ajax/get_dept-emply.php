<?php
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../functions/login_func.php";
include "../functions/functions.php";

if(isset($_POST['id_dept'])) {
	$dept = $_POST['id_dept'];
    echo'
    <select class="form-control populate" data-plugin-selectTwo data-width="100%" id="id_employe" name="id_employe" required title="Must Be Required" onchange="get_employeedetail(this.value)">
        <option value="">Select</option>';
        $sqllmsdept	= $dblms->querylms("SELECT emply_id, emply_name 
                            FROM ".EMPLOYEES."
                            WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND id_type != '0'
                            AND emply_status = '1' AND id_dept = '".$dept."' AND is_deleted != '1'
                            ORDER BY emply_name ASC");
        while($valuedept = mysqli_fetch_array($sqllmsdept)) {
            echo '<option value="'.$valuedept['emply_id'].'">'.$valuedept['emply_name'].'</option>';
        }
        echo'
    </select>';
}
?>