<?php 
//-----------------------------------------------
echo '
<title> Exam Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
    <section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
        // Emply Details
        $sqllmsemp  = $dblms->querylms("SELECT emply_id  
                                                FROM ".EMPLOYEES." 
                                                WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
        $value_emp = mysqli_fetch_array($sqllmsemp);

        // Exam Date Sheet
        $sqllmsExam	= $dblms->querylms("SELECT tp.type_name, c.class_name, d.dated, d.start_time, d.end_time, s.subject_name, s.subject_code, r.room_no
                                        FROM ".DATESHEET." 	            t
                                        INNER JOIN ".DATESHEET_DETAIL." d 	ON 	d.id_setup 	 = t.id
                                        INNER JOIN ".EXAM_TYPES."  	    tp	ON 	tp.type_id 	 = t.id_exam
                                        INNER JOIN ".CLASSES."  	 	c 	ON 	c.class_id 	 = t.id_class
                                        INNER JOIN ".CLASS_SUBJECTS."   s 	ON 	s.subject_id = d.id_subject
                                        INNER JOIN ".CLASS_ROOMS."      r 	ON 	r.room_id 	 = d.id_room
                                        WHERE t.status = '1' AND t.is_deleted != '1'
                                        AND t.id_session = '".cleanvars($_SESSION['userlogininfo']['EXAM_SESSION'])."'
                                        AND t.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
                                        AND d.id_teacher = '".$value_emp['emply_id']."'
                                        ORDER BY d.dated ");
        //-----------------------------------------------------
        if(mysqli_num_rows($sqllmsExam) > 0){
            echo '
            <header class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-clock-o"></i> Exam Schedule</h2>
            </header>
            
            <div class="panel-body">
                <div class="table-responsive mt-sm mb-md">
                    <table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
                        <tbody>	
                    
                            
                            <tr>
                                <th class="center" width="70">Sr No. </th>
                                <th>Days </th>
                                <th>Date </th>
                                <th>Class  </th>
                                <th>Subject  </th>
                                <th>Room </th>
                                <th>Start Time </th>
                                <th>End Time </th>
                            </tr>';
                            $srno = 0;
                            while($rowsDetail = mysqli_fetch_array($sqllmsExam))
                            {
                                $srno++;
                                
                                //--------------------------------------
                                $dated = date("d F Y", strtotime($rowsDetail['dated']));
                                $day = date("l", strtotime($rowsDetail['dated']));
                                //--------------------------------------
                                echo '					
                                <tr>
                                    <td class="center">'.$srno.'</td>
                                    <td>'.$day.'</td>
                                    <td>'.$dated.'</td>
                                    <td>'.$rowsDetail['class_name'].'</td>
                                    <td>'.$rowsDetail['subject_name'].' ('.$rowsDetail['subject_code'].')</td>
                                    <td>'.$rowsDetail['room_no'].'</td>
                                    <td>'.$rowsDetail['start_time'].'</td>
                                    <td>'.$rowsDetail['end_time'].'</td>
                                </tr>';
                            }
                            echo'			
                        </tbody>
                    </table>
                </div>	
            </div>
            <!-- <div class="panel-footer">
                <div class="text-right">
                    <a href="timetable-documents_print.php" class="btn btn-sm btn-primary " target="include/marks/marks_sheetprint.php">
                        <i class="glyphicon glyphicon-print"></i> Print
                    </a>
                </div>
            </div> --> ';
        }
        else{
            echo'
            <div class="panel-body">
                <h2 class="text-center text-danger">No Result Found!</h2>
            </div>';
        }
        echo '
    </section>
</section>';
//-----------------------------------------------
?>