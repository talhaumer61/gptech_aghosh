<?php
//if(!isset($_POST['view_student']) && !isset($_GET['edit_id'])){
//----------------------------------------------------- 
$sqllmsattendance	= $dblms->querylms("SELECT a.id, a.dated, d.status
                                    FROM ".STUDENT_ATTENDANCE." a
									INNER JOIN ".STUDENT_ATTENDANCE_DETAIL." d ON d.id_setup = a.id 
                                    WHERE a.status = '1' AND a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND a.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									AND a.id_section = '".$_GET['section']."' AND a.id_class = '".$_GET['class']."'
									AND a.id_subject = '".$_GET['id']."' AND d.id_std = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'");
//-----------------------------------------------------
    if (mysqli_num_rows($sqllmsattendance) > 0) {
    //------------------------------------------------
	echo'
        <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
            <thead>
                <tr>
                    <th width=70px; class="center">#</th>
                    <th>Date</th>
                    <th width=100px; class="center">Status</th>
                </tr>
            </thead>
            <tbody>';

    $sratt = 0;
    while($value_att = mysqli_fetch_assoc($sqllmsattendance)) { 
    //-----------------------------------------------------
    $sratt ++;
    echo '
                <tr>
                    <td class="center">'.$sratt.' </td>
                    <td>'.date("D d M Y", strtotime($value_att['dated'])).'</td>
                    <td class="center">'.get_attendtype($value_att['status']).'</td>  
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
//}