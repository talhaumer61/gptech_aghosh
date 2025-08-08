<?php 
if(($view != 'add') && !isset($_GET['edit_id'])){
//----------------------------------------------------- 
$sqllms_class	= $dblms->querylms("SELECT zoom_id, zoom_status, zoom_title, dated, start_time, end_time, zoom_link, zoom_pass
                                    FROM ".ONLINE_CLASSES."
                                    WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									AND id_teacher = '".$value_emp['emply_id']."' 
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
                    <th class="center">Status</th>
                    <th width="100px;" class="center">Options</th>
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
                <td class="center">'.get_status($value_class['zoom_status']).'</td>
                <td class="center"><a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/online_classes/update.php?edit_id='.$value_class['zoom_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
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
}