<?php
// if(!isset($_POST['view_student']) && !isset($_GET['edit_id'])){
//----------------------------------------------------- 
$today = date("Y-m-d");
//----------------------------------------------------- 
if($value_emp['id_class'] && $value_emp['id_section'] && $value_emp['emply_id']) {
//-----------------------------------------------------
$sqllmsattendance = $dblms->querylms("SELECT id, dated
                                            FROM ".STUDENT_ATTENDANCE."
                                            WHERE status = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                            AND id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."' 
                                            AND id_section = '".$value_emp['id_section']."'
                                            AND id_class = '".$value_emp['id_class']."'
                                            ORDER BY dated DESC");
//-----------------------------------------------------
// if (mysqli_num_rows($sqllmsattendance) > 0) {
echo '
<section class="panel panel-featured panel-featured-primary">
    <header class="panel-heading">
        <a href="attendance_students.php?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Attendance</a>
        <h2 class="panel-title"><i class="fa fa-list"></i> Attendance List</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
            <thead>
                <tr>
                    <th class="center">#</th>
                    <th>Date</th>
                    <th class="center">Total Students</th>
                    <th class="center">Present</th>
                    <th class="center">Absent</th>
                    <th width="100px;" class="center">Options</th>
                </tr>
            </thead>
            <tbody>';
                 //-----------------------------------------------------
                $sratt = 0;
                while($value_att = mysqli_fetch_assoc($sqllmsattendance)) { 
                    //-----------------------------------------------------
                    $sratt ++;
                    //------------------------------------------------
                    $sqllmsprsent  = $dblms->querylms("SELECT COUNT(dt.id) AS totalpresent     
                                                            FROM ".STUDENT_ATTENDANCE_DETAIL." dt 
                                                            INNER JOIN ".STUDENTS." std ON std.std_id = dt.id_std  
                                                            WHERE dt.status = '1' AND dt.id_setup = '".cleanvars($value_att['id'])."' 
                                                            AND std.std_status = '1'");
                    $valuepresent = mysqli_fetch_array($sqllmsprsent);
                    //------------------------------------------------
                    $sqllmsabsent  = $dblms->querylms("SELECT COUNT(dt.id) AS totalabsent     
                                                            FROM ".STUDENT_ATTENDANCE_DETAIL." dt 
                                                            INNER JOIN ".STUDENTS." std ON std.std_id = dt.id_std  
                                                            WHERE dt.status = '2' AND dt.id_setup = '".cleanvars($value_att['id'])."' 
                                                            AND std.std_status = '1'");
                    $valueabsent = mysqli_fetch_array($sqllmsabsent);
                    //------------------------------------------------
                    echo '
                    <tr>
                        <td class="center">'.$sratt.'</td>
                        <td>'.date("l d M Y", strtotime($value_att['dated'])).'</td>
                        <td class="center">'.($valuepresent['totalpresent'] + $valueabsent['totalabsent']).'</td>
                        <td class="center">'.$valuepresent['totalpresent'].'</td>
                        <td class="center">'.$valueabsent['totalabsent'].'</td>
                        <td class="center">';
                            if($value_att['dated'] == $today){
                                echo'<a class="btn btn-success btn-xs" href="attendance_students.php?id='.$value_att['id'].'&date='.$value_att['dated'].'"> <i class="fa fa-pencil"></i></a>';
                            }
                            echo'
                        </td>
                    </tr>';
                }
                //-----------------------------------------------------
                echo '
            </tbody>
        </table>
    </div>
</section>';
// } 
// else{
//     echo'
//     <div class="panel-body">
//         <h3 class="center text text-danger ">No Record Found</h3>
//     </div>';
// }
}
else{
    header("location: dashboard.php");
}
// }
