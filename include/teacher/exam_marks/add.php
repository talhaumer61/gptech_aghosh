<?php
// POST data
if(isset($_POST['id_type'])) { $examtype = $_POST['id_type']; } else { $examtype = '';}
if(isset($_POST['id_class'])) { $class = $_POST['id_class']; } else { $class = '';} 
if(isset($_POST['id_section'])) { $section = $_POST['id_section']; } else { $section = ''; }	
if(isset($_POST['id_subject'])) { $subject = $_POST['id_subject']; } else { $subject = ''; }	

echo'
<section class="panel panel-featured panel-featured-primary">
    <form action="#" id="form" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">
        <header class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-list"></i> <span class="hidden-xs"> Select 		
            </h2>
        </header>
        <div class="panel-body">
            <div class="row mb-sm">	
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Exam <span class="required">*</span></label>
                        <select name="id_type" data-plugin-selectTwo data-width="100%" id="id_type" required title="Must Be Required" class="form-control populate">
                        <option value="">Select</option>';
                            $sqllmsexam	= $dblms->querylms("SELECT type_id, type_status, type_name 
                                                FROM ".EXAM_TYPES."
                                                WHERE type_status = '1' AND is_deleted != '1'
                                                ORDER BY type_id ASC");
                            while($valueexam = mysqli_fetch_array($sqllmsexam)) {
                                echo '<option value="'.$valueexam['type_id'].'"'; if($valueexam['type_id'] == $examtype){echo'selected';} echo'>'.$valueexam['type_name'].'</option>';
                            }
                        echo'
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Class <span class="required">*</span></label>
                        <select name="id_class" data-plugin-selectTwo data-width="100%" id="id_class" required title="Must Be Required" class="form-control populate" onchange="get_classsectionsubject(this.value)">
                            <option value="">Select</option>';
                            $sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
                                                                FROM ".CLASSES."
                                                                WHERE class_status = '1' AND is_deleted != '1'
                                                                ORDER BY class_id ASC");
                            while($valuecls = mysqli_fetch_array($sqllmscls)) {
                                echo '<option value="'.$valuecls['class_id'].'"'; if($valuecls['class_id'] == $class){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
                            }
                            echo '
                        </select>
                    </div>
                </div>
                <div id="getclasssectionsubject">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Section <span class="required">*</span></label>
                            <select name="id_section" data-plugin-selectTwo data-width="100%" id="id_section" required title="Must Be Required" class="form-control populate">
                                <option value="">Select</option>';
                                $sqllmsSec	= $dblms->querylms("SELECT section_id, section_name 
                                                                    FROM ".CLASS_SECTIONS."
                                                                    WHERE section_status = '1' AND is_deleted != '1'
                                                                    AND id_class = '".$class."'
                                                                    ORDER BY section_id ASC");
                                while($valueSec = mysqli_fetch_array($sqllmsSec)) {
                                    echo '<option value="'.$valueSec['section_id'].'"'; if($valueSec['section_id'] == $section){ echo'selected';} echo'>'.$valueSec['section_name'].'</option>';
                                }
                                echo'
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Subject <span class="required">*</span></label>
                            <select name="id_subject" data-plugin-selectTwo data-width="100%" id="id_subject" required title="Must Be Required" class="form-control populate">
                                <option value="">Select</option>';
                                $sqllmsSub	= $dblms->querylms("SELECT subject_id, subject_name 
                                                                    FROM ".CLASS_SUBJECTS."
                                                                    WHERE subject_status = '1' AND is_deleted != '1'
                                                                    AND id_class = '".$class."'
                                                                    ORDER BY subject_id ASC");
                                while($valueSub = mysqli_fetch_array($sqllmsSub)) {
                                    echo '<option value="'.$valueSub['subject_id'].'"'; if($valueSub['subject_id'] == $subject){ echo'selected';} echo'>'.$valueSub['subject_name'].'</option>';
                                }
                                echo'
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <button type="submit" name="view_students" class="btn btn-primary mt-md"><i class="fa fa-search"></i> View Details</button>
            </center>
        </div>
    </form>
</section>';

if(isset($_POST['view_students'])){

    // Exam Date Sheet
    $sqllmsExam	= $dblms->querylms("SELECT d.id, d.total_marks, d.passing_marks
                                        FROM ".DATESHEET." t
                                        INNER JOIN ".DATESHEET_DETAIL." d ON d.id_setup = t.id
                                        WHERE t.status = '1' AND t.id_class = '".$class."' AND t.is_deleted != '1'
                                        AND t.id_exam = '".$examtype."'
                                        AND t.id_session = '".cleanvars($_SESSION['userlogininfo']['EXAM_SESSION'])."'
                                        AND t.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
                                        AND d.id_subject = '".$subject."' ORDER BY d.id_setup DESC LIMIT 1");
    if(mysqli_num_rows($sqllmsExam) > 0) {
        $valExam = mysqli_fetch_array($sqllmsExam);
        echo'
        <section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
            <form action="exam_marks.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">    
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
                    Students Progress Report</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive mt-sm mb-md">
                        <table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
                            <thead>
                                <tr>
                                    <th class="center" width:"40">#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Father Name</th>
                                    <th>Roll No</th>
                                    <th>Total Marks</th>
                                    <th>Obtained Marks</th>	
                                </tr>
                            </thead>
                            <tbody>';	
                                // Students 
                                $sqllmsStd = $dblms->querylms("SELECT std_id, std_name, std_fathername, std_rollno, std_photo
                                                                    FROM ".STUDENTS."
                                                                    WHERE std_status = '1' AND is_deleted != '1' 
                                                                    AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
                                                                    AND id_class = '".$class."' AND id_section = '".$section."'");
                                $srno = 0;
                                while($valueStd = mysqli_fetch_array($sqllmsStd)) {	

                                    $srno++;	
                                    if($valueStd['std_photo']) {
                                        $photo = 'uploads/images/students/'.$valueStd['std_photo'].'';
                                    } else {
                                        $photo = 'uploads/admin_image/default.jpg';
                                    }
                                    echo'
                                    <tr>
                                        <td class="center">'.$srno.'</td>
                                        <td class="center"> <img src="'.$photo.'" width="35" height="35"</td>  
                                        <td>'.$valueStd['std_name'].'</td>
                                        <td>'.$valueStd['std_fathername'].'</td>
                                        <td>'.$valueStd['std_rollno'].'</td>
                                        <td>'.$valExam['total_marks'].'</td>
                                        <td>
                                            <input type="hidden" name="id_std['.$srno.']" id="id_std" value="'.$valueStd['std_id'].'">
                                            <input type="number" class="form-control" name="obtained_marks['.$srno.']" id="obtained_marks" min="0" max="'.$valExam['total_marks'].'" required/>
                                        </td>
                                    </tr>';
                                }
                                echo'
                                <input type="hidden" name="id_teacher" value="'.$value_emp['emply_id'].'">
                                <input type="hidden" name="id_exam" value="'.$examtype.'">
                                <input type="hidden" name="id_class" value="'.$class.'">
                                <input type="hidden" name="id_section" value="'.$section.'">		
                                <input type="hidden" name="id_subject" value="'.$subject.'">		
                                <input type="hidden" name="total_marks" value="'.$valExam['total_marks'].'">		
                                <input type="hidden" name="passing_marks" value="'.$valExam['passing_marks'].'">		
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-footer">
                    <center>
                        <button type="submit" class="btn btn-primary" id="add_marks" name="add_marks">
                            <i class="fa fa-save"></i> Add Marks</button>
                    </center>
                </div>
            </form>
        </section>';
    } else {
        echo'
        <section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
            <h2 class="panel-body text-center font-bold text text-danger">No Record Found</h2>
        </section';
    }
}

 ?>