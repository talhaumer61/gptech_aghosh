<?php 
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
<div class="col-md-6">
    <div class="form-group">
        <label class="control-label">Section <span class="required">*</span></label>
        <select data-plugin-selectTwo data-width="100%" name="id_section" id="id_section" required title="Must Be Required" class="form-control populate">						
        <option value="">Select</option>';
        $sqllms	= $dblms->querylms("SELECT s.section_id, s.section_name
                                        FROM ".CLASS_SECTIONS." s  
                                        WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                        AND section_status = '1'  AND is_deleted != '1' AND id_class = '".$class."' 
                                        ORDER BY s.section_name ASC");
            while($rowsvalues = mysqli_fetch_array($sqllms)){
                echo'<option value="'.$rowsvalues['section_id'].'">'.$rowsvalues['section_name'].'</option>';
            }
            echo'
        </select>
    </div>
</div>';
//---------------------------------------
}
?>