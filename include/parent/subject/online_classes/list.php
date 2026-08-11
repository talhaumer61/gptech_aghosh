<?php 
//----------------------------------------------------- 
$sqllms_class	= $dblms->querylms("SELECT zoom_id, zoom_status, zoom_title, dated, start_time, end_time, zoom_link, zoom_pass
                                    FROM ".ONLINE_CLASSES."
                                    WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND zoom_status = '1'
                                    AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									AND id_section = '".$_GET['section']."' AND id_class = '".$_GET['class']."' 
									AND id_subject = '".$_GET['id']."'");
//-----------------------------------------------------
    if (mysqli_num_rows($sqllms_class) > 0) {
    echo '
        <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Title</th>
                    <th class="center">Date</th>
                    <th class="center">Time</th>
                    <th class="center">Link</th>
                    <th class="center">Password</th>
                </tr>
            </thead>
            <tbody>';

    $sratt = 0;
    while($value_class = mysqli_fetch_assoc($sqllms_class)) { 
    //-----------------------------------------------------
    $sratt ++;
    //------------------------------------------------
    echo '
            <tr>
                <td class="text-center">'.$sratt.'</td>
                <td>'.$value_class['zoom_title'].'</td>
                <td class="center">'.$value_class['dated'].'</td>
                <td class="center">'.$value_class['start_time'].' to '.$value_class['end_time'].'</td>
                <td class="center">'.$value_class['zoom_link'].'</td>
                <td class="center">'.$value_class['zoom_pass'].'</td>
            </tr>';
    }
    //-----------------------------------------------------
    echo '
            </tbody>
        </table>';
    }
    else{
        echo'<h4 class="center">No Record Found</h4>';
    }