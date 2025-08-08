<?php 
if(($view != 'add') && !isset($_GET['edit_id'])){
//----------------------------------------------------- 
$sqllmsresource	= $dblms->querylms("SELECT res_id, res_status, res_title, res_detail, res_file
                                    FROM ".RESOURCES."
                                    WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND id_session = '1' AND id_teacher = '".$value_emp['emply_id']."' 
									AND id_section = '".$_GET['section']."' AND id_class = '".$_GET['class']."' 
									AND id_subject = '".$_GET['id']."'");
//-----------------------------------------------------
    if (mysqli_num_rows($sqllmsresource) > 0) {
    echo '
        <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th class="center">Status</th>
                    <th width="100px;" class="center">Options</th>
                </tr>
            </thead>
            <tbody>';

    $sratt = 0;
    while($value_res = mysqli_fetch_assoc($sqllmsresource)) { 
    //-----------------------------------------------------
    $sratt ++;
    //------------------------------------------------
    echo '
                <tr>
                    <td>'.$sratt.'</td>
                    <td>'.$value_res['res_title'].'</td>
                    <td class="center">'.get_status($value_res['res_status']).'</td>
                    <td class="center">
                    <a href="uploads/resources/'.$value_res['res_file'].'" download="'.$value_res['res_file'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
                    <a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/resources/modal_update.php?edit_id='.$value_res['res_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
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