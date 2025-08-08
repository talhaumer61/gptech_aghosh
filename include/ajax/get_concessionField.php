<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
    
echo'
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>';
//--------------------------------------------
if(isset($_POST['id_cat'])) {
	$cat = $_POST['id_cat']; 
    //--------------------------------------------
    $sqllms	= $dblms->querylms("SELECT cat_amount
                                    FROM ".SCHOLARSHIP_CAT."
                                    WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
                                    AND cat_type = '2' AND cat_id = '".$cat."' LIMIT 1");
    $rowsvalues = mysqli_fetch_array($sqllms);
    //--------------------------------------------
    echo'
    <div class="form-group mb-md">
        <label class="col-md-3 control-label">Type <span class="required">*</span></label>
        <div class="col-md-9">
            <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_consessionType" name="id_consessionType" onchange="get_concessionField(this.value)">
                <option value="">Select</option>';
                foreach($concessionType as $type){
                echo '<option value="'.$type['id'].'"'; if($type['id'] == 1){echo'selected';} echo'>'.$type['name'].'</option>';
                }
                echo '
            </select>
        </div>
    </div>

    <div id="getConcessionField">
        <div class="form-group mb-md">
        <label class="col-md-3 control-label">Concess. Amount <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="amount" id="amount" value="'.$rowsvalues['cat_amount'].'" required title="Must Be Required" readonly/>
            </div>
        </div>
    </div>';
}
else if(isset($_POST['id_consessionType'])) {
	$type = $_POST['id_consessionType']; 
    //--------------------------------------------
    if($type == 1){
        echo'
        <div class="form-group mb-md">
            <label class="col-md-3 control-label">Concess. Amount <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="amount" id="amount" required title="Must Be Required"/>
            </div>
        </div>';
    }
    else{
        echo'
        <div class="form-group mb-md">
            <label class="col-md-3 control-label">Consession (%) <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="percent" id="percent" required title="Must Be Required"/>
            </div>
        </div>';
    }
    //---------------------------------------
}

?>