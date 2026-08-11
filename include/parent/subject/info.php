<?php
echo '
<header class="panel-heading bg-primary">
    <p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Subject Information</p>
</header>
<div class="panel-body">
    <h4 class="mt-none text-weight-bold">Information</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped mb-none">
            <tr>
                <td>Subject Code</td>
                <td align="center">'.$value_detail['subject_code'].'</td>
            </tr>
            <tr>
                <td>Subject Name</td>
                <td align="center">'.$value_detail['subject_name'].'</td>
            </tr>
        </table>
    </div>
    <h4 class="mt-md text-weight-bold">Timetable</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped mb-none">
            <tr>
                <th width=40px>Sr. #</th>
                <th>Day</th>
                <th>Period</th>
                <th>Class Room</th>
                <th>Time Start</th>
                <th>Time End</th>
            </tr>';
//----------------------------------------------------- 
$sqllmstimetable	= $dblms->querylms("SELECT d.day, p.period_name, p.period_timestart, p.period_timeend, r.room_no
								   FROM ".TIMETABEL_DETAIL." d 
								   INNER JOIN ".TIMETABLE." t ON t.id = d.id_setup
								   INNER JOIN ".PERIODS." p ON p.period_id = d.id_period
								   INNER JOIN ".CLASS_ROOMS." r ON r.room_id = d.id_room
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND t.status = '1' 
								   AND t.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
								   AND t.id_class = '".$values_std['id_class']."' AND t.id_section  = '".$values_std['id_section']."'
                                   AND d.id_subject = '".$_GET['id']."' ORDER BY d.day AND p.period_name ASC");
//-----------------------------------------------------
$srtime = 0;
while($value_time = mysqli_fetch_assoc($sqllmstimetable)) { 
//-----------------------------------------------------
$srtime ++;
echo '
            <tr>
                <td class="text-center">'.$srtime.'</td>
                <td>'.get_daytypes($value_time['day']).' </td>
                <td>'.$value_time['period_name'].'</td>
                <td>'.$value_time['room_no'].'</td>
                <td>'.$value_time['period_timestart'].'</td>
				<td>'.$value_time['period_timeend'].'</td>
            </tr>';
}
//-----------------------------------------------------
echo '
        </table>
    </div>
</div>';