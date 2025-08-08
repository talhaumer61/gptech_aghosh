<?php 
//----------------------------------------------------- 
$sqllms_video	= $dblms->querylms("SELECT  id, title, facebook_code, facebook_code
                                   	FROM ".VIDEO_LECTURE."
									WHERE id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."' 
									AND id_class = '".$_GET['class']."' AND id_subject = '".$_GET['id']."'
									AND status = '1' ORDER BY id ASC									
                                    ");
//-----------------------------------------------------
    if (mysqli_num_rows($sqllms_video) > 0) {
    echo '
        <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
            <thead>
                <tr>
                    <th width="70px" class="text-center">#</th>
                    <th class="text-center">Title</th>
                    <th width="100px"  class="center">View</th>
                </tr>
            </thead>
            <tbody>';

    $srno = 0;
    while($value_video = mysqli_fetch_assoc($sqllms_video)) { 
	//-----------------------------------------------------
	$srno++;
    echo '
                <tr>
                    <td class="text-center">'.$srno.'</td>
					<td>'.$value_video['title'].'</td>
                	<td class="text-center">
						<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/video-lecture/modal_video_view.php?id='.$value_video['id'].'\');"><i class="glyphicon glyphicon-link"></i></a>
					</td>
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