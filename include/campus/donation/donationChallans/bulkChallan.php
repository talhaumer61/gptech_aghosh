<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'add' => '1'))){   

if(isset($_POST['view_details'])) {
    $due_date = $_POST['due_date'];
    $from_month = $_POST['id_month'];
    $to_month = $_POST['to_month'];
} else {
    $due_date = '';
    $from_month = '';
    $to_month = '';
}

echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
        <header class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-plus-square"></i> Make Bulk Donation Challan</h4>
        </header>
        <div class="panel-body">
            <div class="row mb-lg">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Due Date  <span class="required">*</span></label>
                        <input type="text" class="form-control" name="due_date" value="'.$due_date.'" required class="input-daterange input-group" data-plugin-datepicker/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">From Month  <span class="required">*</span></label>
                        <select data-plugin-selectTwo data-width="100%" name="id_month" id="id_month" required title="Must Be Required" class="form-control">
                            <option value="">Select</option>';
                            foreach($monthtypes as $month){
                                if($month['id'] == $from_month) {
                                    echo '<option value="'.$month['id'].'" selected>'.$month['name'].'</option>';
                                } else {
                                    echo '<option value="'.$month['id'].'">'.$month['name'].'</option>';
                                }
                            }
                            echo'
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">To Month  <span class="required">*</span></label>
                        <select data-plugin-selectTwo data-width="100%" name="to_month" id="to_month" required title="Must Be Required" class="form-control">
                            <option value="">Select</option>';
                            foreach($monthtypes as $month){
                                if($month['id'] == $to_month) {
                                    echo '<option value="'.$month['id'].'" selected>'.$month['name'].'</option>';
                                } else {
                                    echo '<option value="'.$month['id'].'">'.$month['name'].'</option>';
                                }
                            }
                            echo'
                        </select>
                    </div>
                </div>
            </div>
            <center>
                <button type="submit" name="view_details" id="view_details" class="btn btn-primary"><i class="fa fa-search"></i> Check Details</button>
            </center>
        </div>
	</form>
</section>';


if(isset($_POST['view_details'])){
	//-----------------------------------------------------
    $sqllmsDonors = $dblms->querylms("SELECT d.donor_id, d.donor_name, d.donor_phone
                                            FROM ".DONORS." d
                                            WHERE d.donor_id != '' AND  d.donor_status = '1' AND d.is_deleted != '1'
                                            AND d.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
                                            ORDER BY d.donor_name ASC");
	//-----------------------------------------------------
	if(mysqli_num_rows($sqllmsDonors) > 0){
		//-----------------------------------------------------
		$today = date('m/d/Y');
        $months = ($_POST['to_month'] - $_POST['id_month']) + 1;
		//-----------------------------------------------------
		echo'
		<section class="panel panel-featured panel-featured-primary">
			<form action="donationChallans.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off" target="_blank">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-dollar"></i> Genrate Donation Challans For '.$months.' Month</h2>
				</header>
				<div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed mb-none mt-md">
                        <thead>
                            <tr>
                                <th class="text-center" width="70">Sr #</th>
                                <th>Donors</th>
                                <th>Amount Per Month</th>
                                <th>Total Amount</th>
                                <th class="text-center"><input type="checkbox" id="allGenrateChallan"> Genrate Challan</th>
                                <th class="text-center"><input type="checkbox" id="allSendMessage"> Send Message</th>
                            </tr>
                        </thead>
                        <tbody> ';
                            $grand_total = 0;
                            $srno = 0;
                            while($valueDonor = mysqli_fetch_array($sqllmsDonors)) {

                                
                                $sqllmscheck  = $dblms->querylms("SELECT id_donor
                                                                    FROM ".FEES." 
                                                                    WHERE id_donor = '".$valueDonor['donor_id']."'
                                                                    AND ( (id_month BETWEEN '".cleanvars($_POST['id_month'])."' AND '".cleanvars($_POST['to_month'])."')
                                                                    OR (to_month BETWEEN '".cleanvars($_POST['id_month'])."' AND '".cleanvars($_POST['to_month'])."') )
                                                                    AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
                                                                    AND is_deleted != '1' AND id_type = '3'
                                                                ");	
                                if(mysqli_num_rows($sqllmscheck) == 0) {

                                    // $perStdAmount = $valueStudents['amount'] * $valueStudents['duration'];
                                    // $grand_total = $grand_total + $perStdAmount;
                                    $srno++;

                                    $total_donation = 0;
                                    $std = 0;
                                    
                                    // STUDENT ATCIVE CHECK REMOVE ON EMAIL OF ALI
                                    // s.std_status = '1' AND s.is_deleted != '1'
                                    $sqllmsStudents	= $dblms->querylms("SELECT s.std_id, d.amount, d.duration
                                                                    FROM ".STUDENTS." s
                                                                    INNER JOIN ".DONATIONS_STUDENTS." d ON d.id_std = s.std_id
                                                                    WHERE d.status = '1' AND d.is_deleted != '1' 
                                                                    AND d.id_donor = '".$valueDonor['donor_id']."' ORDER BY s.std_name");
                                    while($valueStudents = mysqli_fetch_array($sqllmsStudents)) {
                                        
                                        $std++;
                                        // echo'
                                        // <input type="text" name="id_std['.$srno.']['.$std.']" id="id_std" value="'.$valueStudents['std_id'].'">
                                        // <input type="text" name="std_amount['.$srno.']['.$std.']" id="std_amount" value="'.$valueStudents['amount'].'">';

                                        $total_donation = $total_donation + $valueStudents['amount'];

                                    }
                                    echo'
                                    <tr>
                                        <td class="text-center">'.$srno.'</td>
                                        <td>
                                            <input type="hidden" name="donor_id['.$srno.']" id="donor_id" value="'.$valueDonor['donor_id'].'">
                                            <input type="hidden" name="donor_phone['.$srno.']" id="donor_phone" value="'.$valueDonor['donor_phone'].'">
                                            <input type="text" class="form-control" name="donor_name['.$srno.']" id="donor_name" value="'.$valueDonor['donor_name'].'" required title="Must Be Required" readonly/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="'.$total_donation.'" required title="Must Be Required" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="total_amount['.$srno.']" id="amount" value="'.$total_donation * $months.'" required title="Must Be Required" readonly>
                                        </td>
                                        <td class="text-center"><input type="checkbox" name="genrateChallan['.$srno.']" class="genrateChallan"></td>
                                        <td class="text-center"><input type="checkbox" name="sendMessage['.$srno.']"- class="sendMessage"></td>
                                    </tr>';

                                    $grand_total = $grand_total + ($total_donation * $months);

                                } else {
                                    continue;
                                }

                            }
                            echo'
                        </tbody>
                    </table>
					<div class="row mt-md mb-md">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Total Donation <span class="required">*</span></label>
								<input class="form-control grandTotalChallan" type="number" class="form-control" name="grand_total" id="grand_total" value="'.$grand_total.'" readonly/>
							</div>
						</div>
					</div>
                    <input type="hidden" value="'.$today.'" name="issue_date" required readonly/>
                    <input type="hidden" value="'.$due_date.'" name="due_date" required readonly/>
                    <input type="hidden" value="'.$from_month.'" name="from_month" required readonly/>
                    <input type="hidden" value="'.$to_month.'" name="to_month" required readonly/>
					<input type="hidden" value="'.$months.'" name="months" id="months">
				</div>
				<footer class="panel-footer mt-sm">
					<div class="row">
						<div class="col-md-12">
							<center><button type="submit" name="bulk_challans_generate" id="bulk_challans_generate" class="btn btn-primary">Generate Challans</button></center>
						</div>
					</div>
				</footer>
			</form>
		</section>';
	} else {
		echo '
		<section class="panel panel-featured panel-featured-primary">
		<div class="panel-body">
			<div class="col-sm-12">
				<div class="form-group">
					<h2 style="text-align:center;">No Record Found!</h2>
				</div>
			</div>
		</div>
		</section>';
	}
}
	echo '
</section>';

}
else{
	header("Location: donationChallans.php");
}
?>
<script>
    $("#allGenrateChallan").click(function () {
        $(".genrateChallan").prop("checked", $(this).prop("checked"));
    });

    $("#allSendMessage").click(function () {
        $(".sendMessage").prop("checked", $(this).prop("checked"));
    });
</script>