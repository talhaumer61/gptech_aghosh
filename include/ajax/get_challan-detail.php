<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['id_std']) && isset($_POST['yearmonth'])){

	$id_std     =   $_POST['id_std']; 
	$yearmonth 	= date('Y-m', strtotime(cleanvars($_POST['yearmonth'])));
	$year 		= date('y', strtotime(cleanvars($_POST['yearmonth'])));
	$idmonth 	= date('n', strtotime(cleanvars($_POST['yearmonth'])));
    //--------------------------------------------
	// Get all Student Concessions
	$conditions = array ( 
								  'select' 		=> 'st.std_id, st.id_class, st.id_section, st.id_session, st.is_hostelized, st.is_orphan, 
													st.std_name, st.std_whatsapp, st.is_orphan_approved, st.std_phone, st.transport_fee, fs.id'
								, 'join' 		=> "INNER JOIN ".FEESETUP." fs ON st.id_class = fs.id_class AND fs.id_session = st.id_session"
								, 'where' 		=> array( 
															  'st.id_campus' 	=> $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 'fs.id_campus' 	=> $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 'st.std_id' 	 	=> $id_std 
															, 'st.is_deleted' 	=> 0 
															, 'fs.is_deleted' 	=> 0 
															, 'fs.status' 		=> 1
															, 'st.std_status' 	=> 1
														) 
								, 'limit' 		=> 1
								, 'return_type' => 'single' 
							); 
	$value_stu 	= $dblms->getRows(STUDENTS.' st ', $conditions);
   
    //--------------------------------------------
    if (!empty($value_stu)) {
        if($value_stu['std_whatsapp']) {
            $mobilenum1 = '92'.str_replace('-', '', ltrim($value_stu['std_whatsapp'], '0'));
        } else {
            $mobilenum1 = '';
        }
        if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {
            echo '<input type="hidden" name="whatsappno" id="whatsappno" value="'.$mobilenum1.'">
                  <input type="hidden" name="monthname" id="monthname" value="'.get_monthtypes($idmonth).'">
                  <input type="hidden" name="stdname" id="stdname" value="'.$value_stu['std_name'].'">';
        } else {
            echo '<input type="hidden" name="whatsappno" id="whatsappno" value="">
                 <input type="hidden" name="monthname" id="monthname" value="'.get_monthtypes($idmonth).'">
                 <input type="hidden" name="stdname" id="stdname" value="'.$value_stu['std_name'].'">';
        }
        //-----------------------------------------------------
        if($value_stu['is_orphan'] !=  1 || $value_stu['is_orphan_approved'] != 1) {
    
                //Check Student Hostel Registration
                $sqllmHostelRegistration	= $dblms->querylms("SELECT id 
                                                                    FROM ".HOSTEL_REG."
                                                                    WHERE status = '1' AND id_std = '".$value_stu['std_id']."'
                                                                    AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
                //If Hostelized Add Fee Cats
                if (mysqli_num_rows($sqllmHostelRegistration) == 1) {
                    $hostel_cats = ""; 
                }
                else{
                    $hostel_cats = ",6,7,8"; 
                }
                //------------------------------------------------
                $today = date('Y-m-d');
                //------------------------------------------------
                $srno = 0;
                $cat_amount = 0;
                $total_amount = 0;
                $tuitionFee = 0;
                // $schAmount = 0;
                // $consAmount = 0;
                // $fineAmount = 0;
                
			
                $pkgConsAmount = 0;
                $totPkgConsAmount = 0;

                $schAmount = 0;
                $tot_concession_scholarship = 0;
                $tutConsAmount = 0;
                $totTutConsAmount = 0;
                $totPkg = 0;
				
                
                     
                //----------------- Remaining Amount ------------------
                $sqllms_rem = $dblms->querylms("SELECT remaining_amount, challan_no
                                                    FROM ".FEES." 
                                                    WHERE id_std = '".cleanvars($id_std)."'
                                                    AND is_deleted != '1'
                                                    ORDER BY id DESC LIMIT 1");
                if(mysqli_num_rows($sqllms_rem) > 0){
                    $row_rem        = mysqli_fetch_array($sqllms_rem);
                    if($row_rem['remaining_amount']>0){
                        $rem_challan    = $row_rem['challan_no'];
                        $rem_amount     = $row_rem['remaining_amount'];
                        $rem_fine       = 300;
                        $allowEdit      = ""; 
                    }else{
                        $rem_amount     = 0;
                        $rem_fine       = 0;
                        $rem_challan    = "";
                        $allowEdit      = "";
                    }
                }
				 $prev_challans  =   0;


                echo'
                    <div class="form-group">';
				$totalConcess 	= 0;
				$totalPkg 		= 0;
                
                $sqllmsCats	= $dblms->querylms("SELECT c.cat_id, c.cat_name
                                                    FROM ".FEE_CATEGORY." c
                                                    WHERE c.cat_status = '1' 
                                                    AND c.cat_id NOT IN(1,4,5$hostel_cats)
                                                    AND c.is_deleted != '1'
                                                    ORDER BY c.cat_ordering ASC");
                while($valCat = mysqli_fetch_array($sqllmsCats)){

                    $sqllmsDet	= $dblms->querylms("SELECT 	d.id, d.id_setup, d.id_cat, d.amount, d.duration
                                                        FROM ".FEESETUPDETAIL." d											 
                                                        WHERE d.id_setup = '".$value_stu['id']."'
                                                        AND d.id_cat = '".$valCat['cat_id']."'
                                                        AND d.duration = 'Monthly' LIMIT 1");
                    //-----------------------------------------------------
                    $valDet = mysqli_fetch_array($sqllmsDet);
                        //-----------------------------------------------------
                        $srno++;

                            echo '
                            <div class="col-sm-4">';
                            
                                //-------- GET TUITION FEE -------------
                                // if($valCat['cat_id'] == 2){
                                //     $tuitionFee = $valDet['amount'];
                                // }
                                // cat_id = 13 is for arrears
                                if($valCat['cat_id'] == 13){
                                    // previous balance
                                    $cat_amount = $rem_amount;
                                    $total_amount = $total_amount + $cat_amount;
                                }
                                // elseif($valCat['cat_id'] == 14){
                                //     // previous balance
                                //     $cat_amount = $rem_fine + $prev_fine;
                                //     $total_amount = $total_amount + $cat_amount;
                                // }
                                else if($valCat['cat_id'] == 14){
                                    //----------------------------Fine-------------------------
                                    $month = $idmonth - 1;
                                    $sql_fine	= $dblms->querylms("SELECT SUM(amount) as fine
                                                                        FROM ".SCHOLARSHIP." 
                                                                        WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
                                                                        AND  id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
                                                                        AND  id_type = '3' AND status = '1' AND is_deleted != '1'
                                                                        AND  id_std = '".$id_std."'
                                                                        AND  MONTH(date) IN ('".$month."', '".$idmonth."') ");
                                    //---------------- Fine Amount ------------------------
                                    $values_fine = 	mysqli_fetch_array($sql_fine);
                                    //-----------------------------------------------------

                                    // Fine
                                    $cat_amount 	= $values_fine['fine'] + $rem_fine;
                                    $total_amount 	= ($total_amount + $cat_amount);
                                } elseif($valCat['cat_id'] == 16){
                                    //Transport Fee
                                    $cat_amount = $value_stu['transport_fee'];
                                    $total_amount = $total_amount + $cat_amount;
                                }else{
                                    // Get Concession On each Head from Concessions
                                    $sqllmsConcession = $dblms->querylms("SELECT SUM(amount) as amount
                                                                            FROM ".SCHOLARSHIP." 
                                                                            WHERE id_std = '".cleanvars($id_std)."'
																			AND is_deleted = '0' 
																			AND status = '1' 
																			AND id_type = '2'
																			AND id_session  = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                                                            AND id_feecat = '".cleanvars($valCat['cat_id'])."' ");
                                    $valuesConcess = mysqli_fetch_array($sqllmsConcession);
									$totalConcess 	= ($totalConcess + $valuesConcess['amount']);
                                    $cat_amount 	= ($valDet['amount'] - $valuesConcess['amount']);
                                    $totalPkg 		= ($totalPkg + $valDet['amount']);
                                    // echo "amount: ".$valDet['amount'];
                                    // echo "after Concession: ".$cat_amount;
                                    if($cat_amount > 0){
                                        $total_amount = $total_amount + $cat_amount;
                                    } else {
                                        $total_amount = $total_amount + 0;
                                    }
                                    
                                }
                                if($valCat['cat_id'] == 17){
                                    $cat = "sub";
                                    $edit = "";
                                } elseif($valCat['cat_id'] == 13){
                                    $cat = "sum";
                                    $edit = "";
                                }else{
                                    $cat = "sum";
                                    $edit = "";
                                }
                                echo'
                                <label class="control-label">'.$valCat['cat_name'].' <span class="required">*</span></label>
                                <input type="hidden" name="id_cat['.$srno.']" id="id_cat['.$srno.']" value="'.$valCat['cat_id'].'">
                                <input type="text" class="form-control '.$cat.'" name="amount['.$srno.']" id="amount['.$srno.']" value="'; if($cat_amount > 0){echo''.$cat_amount.'';} else{echo'0';} echo'" required title="Must Be Required" '.$edit.'/>
                            </div>';
                        //}
                }

                echo'
                </div>

                <input type="hidden" value="2" name="is_orphan">
                <input type="hidden" value="2" name="is_orphan_approved">
                <input type="hidden" value="'.$value_stu['std_phone'].'" name="std_phone">
                <input type="hidden" name="id_class" value="'.$value_stu['id_class'].'" />
                <input type="hidden" name="id_section" value="'.$value_stu['id_section'].'" />
                <!--
                <input type="hidden" name="prev_total" id="prev_total" value="'.(isset($prev_remaining_amount) ? $prev_remaining_amount : 0).'" />
                <input type="hidden" name="prev_challans" id="prev_challans" value="'.$prev_challans.'"/>
                <input type="hidden" name="rem_challan" id="rem_challan" value="'.$rem_challan.'"/>
                -->
                
				 <table class="table table-bordered table-striped table-condensed mb-md">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="font-size:14px; width:33%">Actual Fee </th>
                                        <th class="text-center" style="font-size:14px; width:33%">Discount </th>
                                        <th class="text-center" style="font-size:14px; width:33%">Fee After Discount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" style="font-weight:600; font-size:14px; color:#00f;">Rs '.number_format($totalPkg).'</td>
                                        <td class="text-center" style="font-weight:600;  font-size:14px; color:green;">Rs '.number_format(($totalConcess)).'</td>
                                        <td class="text-center" style="font-weight:600; font-size:14px; color:#f00;">Rs '.number_format($totalPkg - $totalConcess).'</td>                      
                                    </tr>
                                </tbody>
                            </table>
				<div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label">Total Payable Amount</label>
                        <input type="text" class="form-control total" name="total_amount" id="total_amount" value="'.$total_amount.'" readonly/>
                    </div>
                </div>';

           
            //---------------------------------------
        } 
        else{
            echo'
            <p class="text text-danger center">This Student Is Orphan, You are Not Allowed to make Fee Challan.</p>
            <input type="hidden" value="1" name="is_orphan">';
            exit();
        }
    } else{
                echo'<p class="text text-danger center">No Fee Added! <br> Firstly Kindly Add Fee Details</p>';
                exit();
            }
} else {
    echo'no result';
}
?>

<script type="text/javascript">
    $(document).on("keyup", ".sum", function() {
        var sum = 0;
        $(".sum").each(function(){
            sum += +$(this).val();
        });

        var sub = 0;
        $(".sub").each(function(){
            sub += +$(this).val();
        });

        var payable = sum - sub
        $(".total").val(payable);

        var prev_total = $("#prev_total").val();
		var prev_fine = $("#prev_fine").val();

        var total_payable = Number(payable) + Number(prev_total) + Number(prev_fine);
        $(".total_payable").val(total_payable);
    });

    
    $(document).on("keyup", ".sub", function() {
        var sum = 0;
        $(".sum").each(function(){
            sum += +$(this).val();
        });
        
        var sub = 0;
        $(".sub").each(function(){
            sub += +$(this).val();
        });

        var payable = sum - sub
        $(".total").val(payable);

        var prev_total = $("#prev_total").val();
        var prev_fine = $("#prev_fine").val();

        var total_payable = Number(payable) + Number(prev_total) + Number(prev_fine);
        $(".total_payable").val(total_payable);
    });
</script>