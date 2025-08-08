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
if(isset($_POST['id_class'])) {
	$class = $_POST['id_class']; 
//--------------------------------------------
echo '
<div class="col-md-offset-3 col-md-6 mt-lg">
    <div class="form-group">
        <label class="control-label">Subject <span class="required">*</span></label>
        <select data-plugin-selectTwo data-width="100%" id="id_subject" name="id_subject" required title="Must Be Required" class="form-control populate">
            <option value="">Select</option>';
            $sqllmssubject	= $dblms->querylms("SELECT subject_id, subject_code, subject_name
                                                FROM ".CLASS_SUBJECTS."  
                                                WHERE subject_status = '1' AND is_deleted != '1' AND id_class = '".$class."'
                                                ORDER BY subject_name ASC");
            while($value_subject = mysqli_fetch_array($sqllmssubject)){
                if($value_subject['subject_id'] == $id_subject){
                    echo'<option value="'.$value_subject['subject_id'].'" selected>'.$value_subject['subject_code'].' - '.$value_subject['subject_name'].'</option>';
                    }else{
                        echo'<option value="'.$value_subject['subject_id'].'">'.$value_subject['subject_code'].' - '.$value_subject['subject_name'].'</option>';
                        }
            }
            echo'
            </select>
    </div>
</div>';
//---------------------------------------
}
?>