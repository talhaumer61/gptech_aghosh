<?php
if(($_GET['id'])){
    
    $sqllmsMarks = $dblms->querylms("SELECT status, total_marks
                                        FROM ".EXAM_MARKS."
                                        WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
                                        AND  id = '".$_GET['id']."' LIMIT 1");
    $valueMarks = mysqli_fetch_array($sqllmsMarks);                                    
    echo'
    <section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
        <form action="exam_marks.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">    
            <header class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
                Update Students Progress Report</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive mt-sm mb-md">
                    <div class="form-group mb-sm">
                        <label class="col-sm-1 control-label">Publish <span class="required">*</span></label>
                        <div class="col-md-11">
                            <div class="radio-custom radio-inline mt-md">
                                <input type="radio" id="status" name="status" value="1"'; if($valueMarks['status'] == 1){echo'checked';} echo'>
                                <label for="radioExample1">Yes</label>
                            </div>
                            <div class="radio-custom radio-inline">
                                <input type="radio" id="status" name="status" value="2"'; if($valueMarks['status'] == 2){echo'checked';} echo'>
                                <label for="radioExample2">No</label>
                            </div>
                        </div>
                    </div>
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
                            // Marks 
                            $sqllmsDetail = $dblms->querylms("SELECT *
                                                                FROM ".EXAM_MARKS_DETAILS." d
                                                                INNER JOIN ".STUDENTS."           s ON s.std_id   = d.id_std
                                                                WHERE d.id_setup = '".$_GET['id']."' ");
                            $srno = 0;
                            while($valueDetail = mysqli_fetch_array($sqllmsDetail)) {	

                                $srno++;	
                                if($valueDetail['std_photo']) {
                                    $photo = 'uploads/images/students/'.$valueDetail['std_photo'].'';
                                } else {
                                    $photo = 'uploads/admin_image/default.jpg';
                                }
                                echo'
                                <tr>
                                    <td class="center">'.$srno.'</td>
                                    <td class="center"> <img src="'.$photo.'" width="35" height="35"</td>  
                                    <td>'.$valueDetail['std_name'].'</td>
                                    <td>'.$valueDetail['std_fathername'].'</td>
                                    <td>'.$valueDetail['std_rollno'].'</td>
                                    <td>'.$valueMarks['total_marks'].'</td>
                                    <td>
                                        <input type="hidden" name="id_std['.$srno.']" id="id_std" value="'.$valueDetail['std_id'].'">
                                        <input type="number" class="form-control" name="obtained_marks['.$srno.']" id="obtained_marks" min="0" max="'.$valueMarks['total_marks'].'" value="'.$valueDetail['obtain_marks'].'" required/>
                                    </td>
                                </tr>';
                            }
                            echo'
                            <input type="hidden" name="id" value="'.$_GET['id'].'">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel-footer">
                <center>
                    <button type="submit" class="btn btn-primary" id="update_marks" name="update_marks">
                        <i class="fa fa-save"></i> Update Marks</button>
                </center>
            </div>
        </form>
    </section>';
 }
 ?>