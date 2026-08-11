<?php 
//error_reporting(0);
//session_start();
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['id_type'])) {
//--------------------------------------------
    if($_POST['id_type'] == 2)
    {
        echo'
        <div class="form-group mb-md">
            <label class="col-md-3 control-label">Month <span class="required">*</span></label>
            <div class="col-md-9">
                <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_month" name="id_month">
                    <option value="">Select</option>';
                        foreach($monthtypes as $month) {
                            echo '<option value="'.$month['id'].'">'.$month['name'].'</option>';
                        }
                echo '
                </select>
            </div>
        </div>';
    }
//---------------------------------------
}
?>