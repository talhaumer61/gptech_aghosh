<?php 
//----------------------------------------------------- 
$sqllms	= $dblms->querylms("SELECT summer_id, summer_status, summer_file, id_month, id_class, note, id_session
                                   	FROM ".SUMMER_WORK."
									WHERE id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."' 
									AND id_class = '".$_GET['class']."' AND id_subject = '".$_GET['id']."'
									AND summer_status = '1' ORDER BY summer_id ASC
                                    ");
//-----------------------------------------------------
    if (mysqli_num_rows($sqllms) > 0) {
    echo '
        <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
            <thead>
                <tr>
                    <th width="70px" class="text-center">#</th>
                    <th>Month</th>
                    <th>Note</th>
                    <th width="100px;" class="center">Download</th>
                </tr>
            </thead>
            <tbody>';

    $srno = 0;
    while($value_summerwork = mysqli_fetch_assoc($sqllms)) { 
	//-----------------------------------------------------
	$srno++;
    echo '
                <tr>
                    <td class="text-center">'.$srno.'</td>
					<td width="70"; class="center">'.get_monthtypes($value_summerwork['id_month']).'</td>
					<td>'.$value_summerwork['note'].'</td>
                    <td class="center"><a href="uploads/summer-work/'.$value_summerwork['id_month'].'" download="'.$value_summerwork['id_session'].'-'.$value_summerwork['class_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i></a></td>
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