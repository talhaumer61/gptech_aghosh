<?php 
//----------------------------------------------------- 
$sqllmsassignment	= $dblms->querylms("SELECT assig_id, assig_status, assig_title, assig_file, open_date, close_date
                                    FROM ".ASSIGNMENT."
									WHERE a.status = '1' AND a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                    AND a.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									AND a.id_section = '".$_GET['section']."' AND a.id_class = '".$_GET['class']."'
									AND a.id_subject = '".$_GET['id']."'");
//-----------------------------------------------------
if (mysqli_num_rows($sqllmsassignment) > 0) {
echo '
    <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
        <thead>
            <tr>
                <th width=70px; class="text-center";>#</th>
                <th>Title</th>
                <th>Open Date</th>
                <th>Close Date</th>
                <th width="100px;" class="center">Options</th>
            </tr>
        </thead>
        <tbody>';

$sratt = 0;
while($value_assign = mysqli_fetch_assoc($sqllmsassignment)) { 
//-----------------------------------------------------
$sratt ++;
//------------------------------------------------
echo '
            <tr>
                <td class="text-center";>'.$sratt.'</td>
                <td>'.$value_assign['assig_title'].'</td>
                <td>'.date("D d M Y", strtotime($value_assign['open_date'])).'</td>
                <td>'.date("D d M Y", strtotime($value_assign['close_date'])).'</td>
                <td class="center">
                <a href="uploads/resources/'.$value_assign['assig_file'].'" download="'.$value_assign['assig_file'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
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