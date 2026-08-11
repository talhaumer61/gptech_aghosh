<?php 
//----------------------------------------------------- 
$sqllmsstudent	= $dblms->querylms("SELECT s.std_id, s.std_name, s.std_photo, s.std_phone, s.std_regno	
                                        FROM ".STUDENTS." s
                                        INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
                                        WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                        AND s.id_class = '".cleanvars($_GET['class'])."' AND s.id_section = '".cleanvars($_GET['section'])."'
                                        AND s.std_status = '1' AND s.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
                                        ORDER BY s.std_name ASC ");
//-----------------------------------------------------
if (mysqli_num_rows($sqllmsstudent) > 0) {
    echo '
    <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
        <thead>
            <tr>
                <th width="40" class="center">#</th>
                <th width="40">Photo</th>
                <th>Name</th>
                <th>Regno</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>';
        $sr = 0;
        while($value_stu = mysqli_fetch_assoc($sqllmsstudent)) { 
            $sr ++;
            if($value_stu['std_photo']) {
                $photo = 'uploads/images/students/'.$value_stu['std_photo'].'';
            } else {
                $photo = 'uploads/admin_image/default.jpg';
            }
            echo '
            <tr>
                <td class="center">'.$sr.'</td>
                <td class="center"><img src="'.$photo.'" width="35" height="35"></td>
                <td>'.$value_stu['std_name'].'</td>
                <td>'.$value_stu['std_regno'].'</td>
                <td>'.$value_stu['std_phone'].'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>';
}
else{
    echo'<h4 class="center">No Record Found</h4>';
}