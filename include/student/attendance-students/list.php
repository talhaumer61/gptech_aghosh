<?php
//----------------------------------------------------- 
$today = date("Y-m-d");
//-----------------------------------------------------
$sqllms_std	= $dblms->querylms("SELECT std_id, id_class, id_section
								   FROM ".STUDENTS." 
								   WHERE id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
								   AND  id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$values_std = mysqli_fetch_array($sqllms_std);
//-----------------------------------------------------
$sqllmsattendance = $dblms->querylms("SELECT a.id, a.dated, d.status
                                            FROM ".STUDENT_ATTENDANCE." a
                                            INNER JOIN ".STUDENT_ATTENDANCE_DETAIL." d ON d.id_setup = a.id
                                            WHERE a.status = '1' AND a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                            AND a.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."' 
                                            AND a.id_section = '".$values_std['id_section']."'
                                            AND a.id_class = '".$values_std['id_class']."'
                                            AND d.id_std = '".$values_std['std_id']."'
                                            ORDER BY dated DESC");
//-----------------------------------------------------
if (mysqli_num_rows($sqllmsattendance) > 0) {
    echo '
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-list"></i> Attendance List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
                <thead>
                    <tr>
                        <th width="70px" class="center">#</th>
                        <th>Date</th>
                        <th width="100px" class="center">status</th>
                    </tr>
                </thead>
                <tbody>';
                    $sratt = 0;
                    while($value_att = mysqli_fetch_assoc($sqllmsattendance)) { 
                        $sratt ++;
                        echo '
                        <tr>
                            <td class="center">'.$sratt.'</td>
                            <td>'.date("l d M Y", strtotime($value_att['dated'])).'</td>
                            <td class="center">'.get_attendtype($value_att['status']).'</td>
                        </tr>';
                    }
                    echo '
                </tbody>
            </table>
        </div>
    </section>';
} else {
    echo'
    <section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
        <h2 class="panel-body text-center font-bold text text-danger">No Record Found</h2>
    </section>';
}
