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
    
    //------------- Seprate The Values ----------------
    $values = explode("|",$_POST['id_class']);
    $class_id   = $values[0];
    $class_code = $values[1];
    //--------------------------------------------
    echo'
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label">Section </label>
            <select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_section" name="id_section" >
                <option value="">Select</option>';
                    $sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
                                        FROM ".CLASS_SECTIONS."
                                        WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        AND section_status = '1' AND id_class = '".$class_id."' AND is_deleted != '1'
                                        ORDER BY section_name ASC");
                    while($valuecls = mysqli_fetch_array($sqllmscls)) {
                echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
                }
            echo '
            </select>
        </div>
    </div>';
    //-------- Roll No -----------------
    $newRollno = 0;
    $sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
                                    FROM ".STUDENTS."
                                    WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                    AND id_class = '".$class_id."'");
    if(mysqli_num_rows($sqllmsRoll) > 0 ){
       $valueRoll = mysqli_fetch_array($sqllmsRoll);
       (int)$valueRoll['rollno'];
       $newRollno = (int)$valueRoll['rollno'] + 1;
    }
    else{
        $newRollno = 1;
    }
    echo'
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label">Roll No.</label>
            <input type="text" class="form-control" name="std_rollno" id="std_rollno" value="'.$newRollno.'" readonly>
        </div>
    </div>';
}
?>