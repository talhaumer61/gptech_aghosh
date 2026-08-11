<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '82'))){
	echo '
	<title> Exam Panel | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Exam Panel </h2>
		</header>
    	<div class="row">
	        <div class="col-md-12">';
                if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){ 	
                    if(isset($_POST['id_campus'])){$campus = $_POST['id_campus'];}else{$campus = "";}
                    if(isset($_POST['id_type'])){$type = $_POST['id_type'];}else{$type = "";}
                    echo'
                    <section class="panel panel-featured panel-featured-primary">
                        <form action="exam_report_print.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" target="_blank">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-list"></i> Select</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row mt-sm">
                                    <div class="col-md-offset-2 col-md-4">
                                        <label class="control-label">Campus <span class="required">*</span></label>
                                        <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_campus" name="id_campus">
                                            <option value="">Select</option>';
                                            $sqllmsCamp	= $dblms->querylms("SELECT campus_id, campus_name 
                                                                                    FROM ".CAMPUS." 
                                                                                    WHERE campus_id != '' AND is_deleted != '1' ORDER BY campus_name ASC");
                                            while($valueCamp 	= mysqli_fetch_array($sqllmsCamp)) {
                                                if($valueCamp['campus_id'] == $campus){
                                                    echo'<option value="'.$valueCamp['campus_id'].'" selected>'.$valueCamp['campus_name'].'</option>';
                                                }else{
                                                    echo'<option value="'.$valueCamp['campus_id'].'">'.$valueCamp['campus_name'].'</option>';
                                                }
                                            }
                                            echo'
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Exam Type <span class="required">*</span></label>
                                        <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_type" name="id_type">
                                            <option value="">Select</option>';
                                            $sqllms_type	= $dblms->querylms("SELECT type_id, type_status, type_name 
                                                                FROM ".EXAM_TYPES."
                                                                WHERE type_status = '1' AND is_deleted != '1' 
                                                                ORDER BY type_id ASC");
                                            while($value_type = mysqli_fetch_array($sqllms_type)){
                                                if($value_type['type_id'] == $type){
                                                    echo '<option value="'.$value_type['type_id'].'" selected>'.$value_type['type_name'].'</option>';
                                                }else{
                                                    echo '<option value="'.$value_type['type_id'].'">'.$value_type['type_name'].'</option>';
                                                }
                                            }
                                            echo'
                                        </select>
                                    </div>
                                </div>		
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" id="exam_stdList" name="exam_stdList" class="mr-xs btn btn-primary"><i class="fa fa-search"></i> Get List</button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                    </section>';       
                }else{
                    header("location: dashboard.php");
                }
                echo'
            </div>
        </div>
	</section>';
}else{
	header("Location: dashboard.php");
}
?>