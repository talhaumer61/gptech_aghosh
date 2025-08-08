<?php

$headarray = array();
$grandTotal = 0;
foreach($monthtypes as $month):
    // CURRENT MONTH
    if($feercord['id_month']==$month['id']){

        $year = date('Y' , strtotime(cleanvars($feercord['yearmonth'])));
        if($feercord['status']==1){
            $amount = $feercord['paid_amount'];
        }else{
            $amount = $feercord['total_amount'] - $feercord['paid_amount'];
        }

        if($feercord['due_date'] < date('Y-m-d') && $feercord['status'] != '1'){
            $amount = $amount;
        }
        $itm['monthname'] 	= $month['name'].' '.$year;
        $itm['amount'] 		= $amount;
        array_push($headarray, $itm);
    }
    // PREVIOUS MONTHS
    else{
        $sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.yearmonth, f.challan_no, f.id_std,
																		f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																		FROM ".FEES." f
																		WHERE f.id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																		AND f.id_month		= '".cleanvars($month['id'])."'
																		AND f.id_std		= '".cleanvars($feercord['id_std'])."'
																		AND (f.status = '2' OR f.status = '4')
																		AND f.is_deleted != '1' LIMIT 1");
        if(mysqli_num_rows($sqlnarration)>0){
            $valnarration = mysqli_fetch_array($sqlnarration);

            $year = date('Y' , strtotime(cleanvars($valnarration['yearmonth'])));
            $amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

            if($valnarration['due_date'] < date('Y-m-d')){
                $amount = $amount + LATEFEE;
            }

            if(($feercord['status']==1 && $feercord['id_month']==$month['id']) || ($feercord['status']==2 || $feercord['status']==4)){
                $amount = $amount;
            }else{
                $amount = 0;
            }

            $itm['monthname'] 	= $month['name'].' '.$year;
            $itm['amount'] 		= $amount;
            array_push($headarray, $itm);
        } else {
            $amount = 0;
        }
    }

    $grandTotal = ($grandTotal + $amount);
endforeach;
echo '
<html>

<head>

    <style>

        /*

        PDF library using PHP have some limitations and all CSS properties may not support. Before Editing this file, Please create a backup, so that You can restore this.

        The location of this file is here- system/lib/invoices/pdf-x2.php

        */

        * { margin: 0; padding: 0; }
      
         body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; }
      

        #page-wrap {   size: A4 landscape;
			margin: 0 auto; }

       


        #customer { overflow: hidden; }

        #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }

        #meta { margin-top: 1px; width: 100%; float: right; }
        #meta td { text-align: right;  }
        #meta th.meta-head { text-align: center; background: #eee; }
        #meta td.meta-head { text-align: left; background: #eee; }
        #meta td textarea { width: 100%; height: 20px; text-align: right; }

        #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
        #items th { background: #eee; }
        #items textarea { width: 80px; height: 50px; }
        #items tr.item-row td {  vertical-align: top; }
        #items td.description { width: 300px; }
        #items td.item-name { width: 175px; }
        #items td.description textarea, #items td.item-name textarea { width: 100%; }
        #items td.total-line { border-right: 0; text-align: right; }
        #items td.total-value { border-left: 0; padding: 10px; }
        #items td.total-value textarea { height: 20px; background: none; }
        #items td.balance { background: #eee; }
        #items td.blank { border: 0; }

        #terms { text-align: left; margin: 20px 0 0 0; }
        #terms h5 { text-transform: uppercase; font-size: 13px; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
        #terms textarea { width: 100%; text-align: center;}
        #items td.blank { border: 0; }
        
        h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
		.spanh1 { font-size:11px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:0px; }
		h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:22px; font-weight:700; text-transform:uppercase; }
		.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
		h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:19px; font-weight:700; text-transform:uppercase; padding: 0px; }
		h4 { 
			text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:13px; font-weight:700; word-spacing:0.1em;  
		}
		td { padding-bottom:4px; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; }
		.line1 { border:1px solid #333; width:100%; margin-top:2px; margin-bottom:5px; }
		.payable { border:2px solid #000; padding:2px; text-align:center; font-size:14px; }
        
    </style>

</head>

<body>

<div id="page-wrap">
    <table width="99%" border="0" class="page " cellpadding="7" cellspacing="10" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>';
$cpi = 0;

for($ifee = 1; $ifee<=3; $ifee++) {
    if ($ifee < 3) {
        $rightborder = 'style="border-right:1px dashed #333;"';
    } else {
        $rightborder = '';
    }
    $cpi++;

    if ($cpi == 1) {
        $copyfor = 'Bank';
    } elseif ($cpi == 2) {
        $copyfor = 'Account';
    } elseif ($cpi == 3) {
        $copyfor = "Student's";
    }
    echo '<td width="341" '.$rightborder.' class="'.$clspaid.'">
            <table style="border-collapse:collapse; margin-top: 5px; margin-bottom: 5px; width: 100%;" >
						<tr>
							<td style="width: 90px; text-align: left;">
								<img src="../uploads/Aghosh-Orphan-Care-Homes-Logo.png" style="width:90px; height: 90px;  vertical-align: middle;">
								<br>
							</td>
							<td style="width: 35px; text-align: left;">
								<img src="../uploads/logo.png" style="width:35px; height: 35px;  vertical-align: middle;">
								<br>
								<img src="../uploads/Tehfeez-Logo.png" style="width:35px; height: 35px; text-align: left; vertical-align: middle; margin-top: 10px;">
							</td>
							<td style="text-align: left;">
								<div style="text-align: center; font-size: 14px; font-weight: bold;">
									<span>AGHOSH GRAMMAR HIGHER SECONDARY SCHOOL</span>
									<br><br>
									<span>TAHFEEZ UL QURAN INSTITUTE</span>
								</div>
							</td>
							<td style="width: 50px; text-align: right;">
								<div style="margin-right: -10px;writing-mode: vertical-lr; text-orientation: mixed; border: 1px dashed black; border-radius: 12px; padding: 5px 3px;"> <span class="spanh1">'.$copyfor.'</span></div>
							</td>
						</tr>
					</table>
					<div style="clear:both;"></div>
					<div class="line1"></div>
					<div style="font-size:14px; margin-top:5px;">
						<table style="border-collapse:collapse; padding: 10px; border:3px solid #333;" width="100%" border="1">
						<tr>
							<td style="text-align: center; width: 40px;"><img src="../uploads/1-link.jpg" style="width:35px; height: 35px; vertical-align: middle; "></td>
							<td style="font-size:16px; font-weight:bold; padding-left: 10px;">All Mobile Banking Payments:<br>1 Bill  Invoice ID: '.$challanNumber.'</td>
						</tr>
						</table>
						<div style="clear:both;"></div>
						<table style="border-collapse:collapse; margin-top:10px; font-size:16px; width: 100%;">
							
							<tr>
								<td style="text-align:left;">Challan #:</td>
								<td style="text-align:left;">'.$feercord['challan_no'].'</td>
								<td style="text-align:left;">Issue Date:</td>
								<td style=" text-align:left; text-decoration:underline;">'.date('d-m-Y', strtotime($feercord['issue_date'])).'</td>
							</tr>
							<tr>
								<td style="text-align:left;">Name:<br>Father:</td>
								<td style=" text-decoration:underline;">'.$displayname.'<br>'.$fathername.'</td>
								<td style="text-align:left;">Due Date:</td>
								<td style=" text-align:left; text-decoration:underline;">'.date('d-m-Y', strtotime($feercord['due_date'])).'</td>
							</tr>
							<tr>
								<td style="text-align:left;">'.$inqFromRegTitle.' #:</td>
								<td style="text-align:left;"><span style="font-size:10px;"><u>'.$inqFromRegVal.'</u></span></td>
								<td style="text-align:left;">Expiry Date:</td>
								<td style=" text-align:left; text-decoration:underline;">'.date('t-m-Y',strtotime($feercord['due_date'])).'</td>
							</tr>
							<tr>
								<td style="text-align:left;">Class:</td>
								<td style="text-align:left; text-decoration:underline;">'.$feercord['class_name'].'</td>';
                            if($feercord['section_name']){
                             echo'
								<td style="text-align:left;">Section:</td>
								<td style="text-align:left; text-decoration:underline;">'.$feercord['section_name'].'</td>';
                             } else{
                            echo'
								<td style="text-align:left;">Session:</td>
								<td style="text-align:left; text-decoration:underline;">'.$feercord['session_name'].'</td>';
                            }
                            echo'
							</tr>
							<tr>';
                            if($feercord['std_rollno']){
                                echo'
                                    <td style="text-align:left;">Roll No:</td>
                                    <td style=" text-align:left; text-decoration:underline;">'.$feercord['std_rollno'].'</td>';}
                            if($feercord['id_month']){
                                echo'
                                    <td style="text-align:left;">Month</td>
                                    <td style=" text-align:left;  text-decoration:underline;">'.get_monthtypes($feercord['id_month']).'-'.date('Y' , strtotime(cleanvars($feercord['due_date']))).'</td>';
                            }
                        echo '
							</tr>
						</table>
					</div>
					<div style="font-size:16px; margin-top:5px;">
						<table style="border-collapse:collapse; border:1px solid #666; font-size:14px;" cellpadding="2" cellspacing="2" border="1" width="100%">
							<tr>
								<td style="text-align:center; font-size:11px; font-weight:bold;"> Descriptions </td>
								<td style="text-align:right; font-size:11px; font-weight:bold; width:50px;">Rs.</td>
							</tr>';
                            foreach ($headarray as $mths):
                                echo '
									<tr>
										<td>'.$mths['monthname'].'</td>
										<td style="text-align:right;">'.number_format($mths['amount']).'</td>
									</tr>';
                            endforeach;
                            echo '
							<tr>
								<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Amount Before Due Date</td>
								<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($grandTotal).'</td>
							</tr>
							<tr>
								<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Amount After Due Date</td>
								<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($grandTotal + LATEFEE).'</td>
							</tr>
						</table>';
						if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
						echo '<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
						}
						echo '
						<span style="font-size:9px; float:right; margin-top:3px;">issue Date: '.date("m/d/Y").'</span>
					</div>
					<div style="clear:both;"></div>
					<div style="font-size:13px; color:#000; margin-top:10px;">
						<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="5">
							<tr>
								<td style="font-weight:normal; font-style:italic; text-align:left; font-size:14px; width:85%;">Rupees in word: <span style="text-decoration:underline; font-size:9px; color:#000;">'.convert_number_to_words($grandTotal).' only</span>
								</td>
								<td style="font-weight:normal; font-style:italic; text-align:right;">Cashier</td>
							</tr>
							<tr>
								<td style="font-weight:normal; font-style:italic; color: #777777; text-align:left; font-size:13px; width:80%;"><b>Parents Note: </b>
								
                                      '. $Instructions.'
		                        
									<b>Student Login: </b>
									<ol type="1" style="margin-left:40px;">
										<li>Visit this url https://aghosh.gptech.pk/</li>
										<li>Provide Username = '.inqFromRegVal.'</li>
										<li>Provide Password = ags786</li>
									</ol>
								</td>
								<td style="text-align:right; vertical-align: top; "><img src="'.$PNG_WEB_DIR.basename($filename).'" ></td>
							</tr>
							
						</table>
						
					</div>
					</td>';
}

echo '

</tr>
</table>
</div>

</body>

</html>';
?>