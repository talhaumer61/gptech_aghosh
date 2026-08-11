<?php 
//----------------------------------------------------- 
$sqllmsassignment	= $dblms->querylms("SELECT assig_id, assig_status, assig_title, assig_file, open_date, close_date
                                                FROM ".ASSIGNMENT."
                                                WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                AND id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                                AND id_teacher = '".$value_emp['emply_id']."' 
                                                AND id_section = '".$_GET['section']."' AND id_class = '".$_GET['class']."' 
                                                AND id_subject = '".$_GET['id']."' ORDER BY close_date ASC");
//-----------------------------------------------------
if (mysqli_num_rows($sqllmsassignment) > 0) {
    echo '
    <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
        <thead>
            <tr>
                <th class="center">#</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th class="center">Status</th>
                <th width="100px;" class="center">Options</th>
            </tr>
        </thead>
        <tbody>';
        $sratt = 0;
        while($value_assign = mysqli_fetch_assoc($sqllmsassignment)) { 
            $sratt ++;
            echo '
            <tr>
                <td class="center">'.$sratt.'</td>
                <td>'.$value_assign['assig_title'].'</td>
                <td>'.date('d M Y', strtotime($value_assign['open_date'])).'</td>
                <td>'.date('d M Y', strtotime($value_assign['close_date'])).'</td>
                <td class="center" width="60">'.get_status($value_assign['assig_status']).'</td>
                <td class="center">';
                    if($value_assign['assig_file']){
                        echo'<a href="uploads/assignments/'.$value_assign['assig_file'].'" download="'.$value_assign['assig_file'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>';
                    }
                    echo'
                <a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/assignments/modal_update.php?edit_id='.$value_assign['assig_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
            </tr>';
        }
        echo '
        </tbody>
    </table>';
}
else{
    echo'<h4 class="center">No Record Found</h4>';
}