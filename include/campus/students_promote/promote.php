<?php
if(isset($_POST['promote_details'])){
    $class   = $_POST['id_class'];
    $section = $_POST['id_section'];
}
else{
    $class="";
    $section="";
}
if(!isset($_POST['promote_details'])){
echo'
<section class="panel panel-featured panel-featured-primary">
    <form action="students_promote.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-random"></i> Select</h4>
        </div>
        <div class="panel-body">
            <div class="row mt-sm">
                <div class="col-md-offset-2 col-md-4">
                    <label class="control-label">Class <span class="required">*</span></label>
                    <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classsection(this.value)">
                    <option value="">Select</option>';
                    //-----------------------------------------------------
                    $sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
                                                            FROM ".CLASSES." 
                                                            WHERE class_status = '1' AND is_deleted != '1' ORDER BY class_id ASC");
                    while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
                        if($value_class['class_id'] == $class){
                            echo'<option value="'.$value_class['class_id'].'" selected>'.$value_class['class_name'].'</option>';
                        }
                        else{
                            echo'<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
                        }
                    }
                    //-----------------------------------------------------
                    echo '
                    </select>
                </div>
                <div id="getclasssection">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Section </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section" name="id_section">
                                <option value="">Select</option>';  
                                    //-----------------------------------------------------
                                    $sqllmssection	= $dblms->querylms("SELECT section_id, section_name 
                                                                    FROM ".CLASS_SECTIONS." 
                                                                    WHERE section_status = '1' AND is_deleted != '1'
                                                                    AND id_class='".$class."' 
                                                                    AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                                    ORDER BY section_id ASC");
                                    //-----------------------------------------------------
                                    while($value_section = mysqli_fetch_array($sqllmssection)) {
                                        if($value_section['section_id'] == $section){
                                            echo'<option value="'.$value_section['section_id'].'" selected>'.$value_section['section_name'].'</option>';
                                        }
                                        else{
                                            echo'<option value="'.$value_section['section_id'].'">'.$value_section['section_name'].'</option>';
                                        }
                                    }
                                    //-----------------------------------------------------
                            echo'
                            </select>
                    </div>
                </div>
                </div>
            </div>		
        </div>
        <footer class="panel-footer mt-sm">
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" id="promote_details" name="promote_details" class="mr-xs btn btn-primary">Get Details</button>
                </div>
            </div>
        </footer>
    </form>
</section>';
}

if(isset($_POST['promote_details'])){
    //-----------------------------------------------------
    $sqllms_clsSec	= $dblms->querylms("SELECT c.class_name, s.section_name
                                FROM ".CLASSES." c
                                LEFT JOIN ".CLASS_SECTIONS." s ON s.id_class = c.class_id
                                WHERE c.class_id != '' AND c.is_deleted != '1'
                                AND c.class_id = '".$class."' ");
    $value_clsSec 	= mysqli_fetch_array($sqllms_clsSec);
    //-----------------------------------------------------
echo'
<section class="panel panel-featured panel-featured-primary">
    <form action="students_promote.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <input type="hidden" name="class_from" value="'.$class.'"/>
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-random"></i> Promote Students of <u>'.$value_clsSec['class_name'].''; if($section > 0){echo'('.$value_clsSec['section_name'].')';} echo'</u></h4>
        </div>
        <div class="panel-body">
            <div class="row mb-md">
                <div class="col-md-offset-2 col-md-4">
                    <label class="control-label">Class <span class="required">*</span></label>
                    <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" name="id_class" name="id_class" onchange="get_classsection(this.value)">
                        <option value="">Select</option>';
                        //-----------------------------------------------------
                        $sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
                                                                FROM ".CLASSES." 
                                                                WHERE class_status = '1' AND is_deleted != '1'
                                                                AND class_id != '".$class."' ORDER BY class_id ASC");
                        while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
                            echo'<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
                        }
                        //-----------------------------------------------------
                        echo '
                    </select>
                </div>
                <div id="getclasssection">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Section </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="id_section" name="id_section">
                                <option value="">Select</option>';
                                    //-----------------------------------------------------
                                    // $sqllmssection	= $dblms->querylms("SELECT section_id, section_name 
                                    //                                 FROM ".CLASS_SECTIONS." 
                                    //                                 WHERE section_status = '1' AND is_deleted != '1'
                                    //                                 AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    //                                 ORDER BY section_id ASC");
                                    // //-----------------------------------------------------
                                    // while($value_section = mysqli_fetch_array($sqllmssection)) {
                                    //     echo'<option value="'.$value_section['section_id'].'">'.$value_section['section_name'].'</option>';
                                    // }
                                    //-----------------------------------------------------
                            echo'
                            </select>
                    </div>
                </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-condensed mb-none">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th width= 40>Photo</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Roll no</th>
                        <th>Phone</th>
                        <th>CNIC</th>
                        <th width="70px;" class="center">Promote</th>
                    </tr>
                </thead>
                <tbody>';
                //-----------------------------------------------------
                $sqllms	= $dblms->querylms("SELECT  std_id, std_status, std_name, std_fathername, std_gender, 
                                                std_nic, std_phone, id_class, id_session,
                                                std_rollno, std_regno, std_photo
                                                FROM ".STUDENTS." 		
                                                WHERE std_id != '' AND std_status = '1'  AND is_deleted != '1'
                                                AND id_class = '".$class."' AND id_section = '".$section."'
                                                AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                ORDER BY std_rollno ");
                    $srno = 0;
                    //-----------------------------------------------------
                    while($rowsvalues = mysqli_fetch_array($sqllms)) {
                        //-----------------------------------------------------
                        $srno++;
                        //-----------------------------------------------------
                        if($rowsvalues['std_photo']) { 
                            $photo = "uploads/images/students/".$rowsvalues['std_photo']."";
                        }
                        else{
                            $photo = "uploads/default-student.jpg";
                        }
                        echo '
                        <tr>
                            <td class="center">'.$srno.'</td>
                            <td><img src="'.$photo.'" style="width:40px; height:40px;"></td>
                            <td>'.$rowsvalues['std_name'].'</td>
                            <td>'.$rowsvalues['std_fathername'].'</td>
                            <td>'.$rowsvalues['std_rollno'].'</td>
                            <td>'.$rowsvalues['std_phone'].'</td>
                            <td>'.$rowsvalues['std_nic'].'</td>
                            <td class="center">
                                <div class="checkbox-custom checkbox-inline mt-sm">
                                    <input type="checkbox" name="is_promote['.$srno.']" checked>
                                    <label for="checkboxExample1"></label>
                                </div>
                                <input type="hidden" name="id_std['.$srno.']" value="'.$rowsvalues['std_id'].'">
                            </td>
                        </tr>';
                        //-----------------------------------------------------
                    }
                    //-----------------------------------------------------
                    echo '

                </tbody>
            </table>
        </div>
        <footer class="panel-footer mt-sm">
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" id="promote_students" name="promote_students" class="mr-xs btn btn-primary">Promote</button>
                </div>
            </div>
        </footer>
    </form>
</section>';
}
?>