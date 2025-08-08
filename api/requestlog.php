<?php 
//----------------------------------------
	include "../include/dbsetting/lms_vars_config.php";
	include "../include/dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "functions/functions.php";
//----------------------------------------
echo '
<!DOCTYPE html>
<html>
<body>
<title>Request Log</title>
<h1 style="text-align:center;">Request Log</h1>
    <table class="table" border="1" style="border-collapse:collapse; width:60%;" align="center" cellpadding="3" cellspacing="5">
        <thead>
        <tr>
            <th style="font-weight:600; font-size:15px; vertical-align:middle;">Sr # </th>
            <th style="font-weight:600; font-size:15px; text-align:center;">Challan #</th>
            <th style="font-weight:600; font-size:15px; text-align:center;">Status</th>
            <th style="font-weight:600; font-size:15px; text-align:center;">Date</th>
        </tr>
        </thead>
        <tbody>';
//------------------------------------------------
$sqllmslog  = $dblms->querylms("SELECT challan_no, status, date_added
                                    FROM ".PAY_API_LOG."
                                    ORDER by id DESC LIMIT 50");
//------------------------------------------------
$sr = 0;
while ($value_log = mysqli_fetch_array($sqllmslog)) { 
    $sr ++;
        echo '
        <tr>
            <td style="width:40px;text-align:center;vertical-align:middle;">'.$sr.'</td>
            <td style="width:200px;vertical-align:middle; text-align:center;">'.$value_log['challan_no'].'</td>
            <td style="vertical-align:middle; text-align:left;">'.get_request_status($value_log['status']).'</td>
            <td style="width:200px;vertical-align:middle; text-align:center;">'.$value_log['date_added'].'</td>
        </tr>';
} // end while loop
//--------------------------------------
echo '
        </tbody>
    </table>
</body>
</html>';
?>