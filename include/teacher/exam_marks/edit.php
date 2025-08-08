<?php
if(($_GET['id'])){
    echo'
    <section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
        <form action="exam_marks.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">    
            <header class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
                Update Students Progress Report</h2>
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
                            // Marks 
                            $sqllmsMarks = $dblms->querylms("SELECT *
                                                                FROM ".EXAM_MARKS." m
                                                                INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id 
                                                                INNER JOIN ".STUDENTS."           s ON s.std_id   = d.id_std
                                                                WHERE m.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
                                                                AND  m.id = '".$_GET['id']."' ");
                            $srno = 0;
                            while($valueMarks = mysqli_fetch_array($sqllmsMarks)) {	

                                $srno++;	
                                if($valueMarks['std_photo']) {
                                    $photo = 'uploads/images/students/'.$valueMarks['std_photo'].'';
                                } else {
                                    $photo = 'uploads/admin_image/default.jpg';
                                }
                                echo'
                                <tr>
                                    <td class="center">'.$srno.'</td>
                                    <td class="center"> <img src="'.$photo.'" width="35" height="35"</td>  
                                    <td>'.$valueMarks['std_name'].'</td>
                                    <td>'.$valueMarks['std_fathername'].'</td>
                                    <td>'.$valueMarks['std_rollno'].'</td>
                                    <td>'.$valueMarks['total_marks'].'</td>
                                    <td>
                                        <input type="hidden" name="id_std['.$srno.']" id="id_std" value="'.$valueMarks['std_id'].'">
                                        <input type="number" class="form-control" name="obtained_marks['.$srno.']" id="obtained_marks" min="0" max="'.$valueMarks['total_marks'].'" value="'.$valueMarks['obtain_marks'].'" required/>
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