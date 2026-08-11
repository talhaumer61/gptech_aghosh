<?php

include "include/dbsetting/lms_vars_config.php";
include "include/dbsetting/classdbconection.php";
$dblms = new dblms();
include "include/functions/login_func.php";
include "include/functions/functions.php";

$challanNo   = get_dataHashingOnlyExp($_GET['challanNo'], false);

$sqllms  = $dblms->querylms("SELECT f.id, f.status, f.id_type, f.id_month, f.yearmonth, f.challan_no, f.id_session, f.id_class, f.id_section, f.inquiry_formno, f.id_std, f.narration,
                                    f.issue_date, f.due_date, f.paid_date, f.total_amount, f.pay_mode, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
                                    c.class_id, c.class_name, c.id_classgroup, 
                                    cs.section_id, cs.section_name,
                                    st.std_id, st.std_name, st.std_fathername, st.std_regno, st.std_rollno, st.id_loginid,
                                    q.form_no, q.name, q.fathername,
                                    se.session_id, se.session_name
                                    FROM ".FEES." f
                                    INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
                                    LEFT  JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section	
                                    LEFT  JOIN ".STUDENTS." st ON st.std_id = f.id_std	
                                    LEFT  JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no = f.inquiry_formno	
                                    INNER JOIN ".SESSIONS." se ON se.session_id = f.id_session
                                    WHERE f.id_campus = '4' 
                                    AND f.challan_no = '".cleanvars($challanNo)."'
                                    AND f.is_deleted != '1' LIMIT 1");

$feercord = mysqli_fetch_array($sqllms);

if($feercord && $feercord['status'] != 1) {

    $grandTotal = 0;
    if(!empty($feercord['inquiry_formno'])) {
        $stdname = preg_replace('/\s+/', ' ', $feercord['name']);
        $shortarray = explode(' ',trim($stdname));
        $firstname 	= $shortarray[0];
        $displayname =  $feercord['name'];
        $fathername =  $feercord['fathername'];

        $inqFromRegTitle = 'Form';
        $inqFromRegVal = $feercord['form_no'];
    }else{
        $stdname = preg_replace('/\s+/', ' ', $feercord['std_name']);
        $shortarray = explode(' ',trim($stdname));
        $firstname 	= $shortarray[0];
        $displayname =  $feercord['std_name'];
        $fathername =  $feercord['std_fathername'];

        $inqFromRegTitle = 'Reg';
        $inqFromRegVal = $feercord['std_regno'];
    }
		

    foreach($monthtypes as $month):
        // CURRENT MONTH
        if($feercord['id_month'] == $month['id']){

            $year = date('Y' , strtotime(cleanvars($feercord['yearmonth'])));
            if($feercord['status']==1){
                $amount = $feercord['paid_amount'];
            }else{
                $amount = $feercord['total_amount'] - $feercord['paid_amount'];
            }

            if($feercord['due_date'] < date('Y-m-d') && $feercord['status'] != '1'){
                $amount = ($amount + LATEFEE);
                echo '<script>console.log("Late fee applicable for current month");</script>';
            }
           
        }
        // PREVIOUS MONTHS
        else{
            $sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.yearmonth, f.challan_no, f.id_std,
                                                f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
                                                FROM ".FEES." f
                                                WHERE f.id_campus	= '4'
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
            } else {
                $amount = 0; 
            }
        }
        $grandTotal = $grandTotal + $amount;
    endforeach;

    $totalAmount = (float)($grandTotal);
    // $totalAmount = (float)($row['total_amount'] + BANK_CHARGES);
   

    $qrCodeText = '';

    $tokenParams = [
        'username'      => BANKCO_USERNAME,
        'password'      => BANKCO_PASSWORD,
        'client_id'     => BANKCO_CLIENTID,
        'client_secret' => BANKCO_CLIENTSECRET
    ];

    $ch = curl_init(BANKCO_ACCESSTOKENURL);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($tokenParams),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => true
    ]);

    $tokenResponse = curl_exec($ch);
    curl_close($ch);

    $tokenResponse = json_decode($tokenResponse, true);

    if(isset($tokenResponse['access_token'])) {

        $expiryDateTime = date('t-m-Y 23:59:59', strtotime($feercord['due_date']));

        $qrParams = [
            'consumerNumber' => $feercord['challan_no'],
            'consumerName'   => $displayname,
            'amount'         => $totalAmount,
            'currency'       => 'PKR',
            "expiryDateTime" => $expiryDateTime
        ];

        $ch = curl_init(BANKCO_QRCODEURL);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($qrParams),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Authorization: Bearer '.$tokenResponse['access_token']
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true
        ]);


        $qrResponse = curl_exec($ch);
        curl_close($ch);

        $qrResponse = json_decode($qrResponse, true);


        if(isset($qrResponse['qrCode'])) {
            $qrCodeText = $qrResponse['qrCode'];
        }

        $dataRaastqr = array(
                                  'status'		        => '2'
                                , 'challan_no'			=> $feercord['challan_no']
                                , 'QR_code'		        => $qrCodeText
                                , 'QR_id'		        => $qrResponse['qrid']
                                , 'detail'			    => $qrResponse['message']
                                , 'QR_response'			=> json_encode($qrResponse)
                                , 'QR_response_date'	=> date("Y-m-d H:i:s")											
                            );

	    $sqllmsInsert  = $dblms->Insert(RAAST_QR_DETAILS , $dataRaastqr);

        echo '
        <!doctype html>
        <html lang="en">

            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width,initial-scale=1" />
                <title>RAAST QR Payment</title>
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
                <link rel="shortcut icon" href="login/assets/images/favicon.png">
                <style>
                    :root {
                        --bg: #0f172a;
                        --card: #0b1220;
                        --muted: #94a3b8;
                        --accent1: #7c3aed;
                        --accent2: #06b6d4;
                        --glass: rgba(255, 255, 255, 0.04);
                        --radius: 16px;
                    }

                    * {
                        box-sizing: border-box
                    }

                    html,
                    body {
                        height: 100%;
                        margin: 0;
                        font-family: Inter, system-ui, Arial;
                        background: linear-gradient(180deg, #071025 0%, #071a2b 60%);
                        color: #e6eef8;
                    }

                    .wrap {
                        min-height: 100vh;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 28px;
                    }

                    .card {
                        width: auto;
                        max-width: 100%;
                        background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
                        border-radius: var(--radius);
                        padding: 28px;
                        box-shadow: 0 10px 30px rgba(2, 6, 23, 0.6);
                        display: grid;
                        grid-template-columns: 1fr 360px;
                        gap: 24px;
                        align-items: start;
                        border: 1px solid rgba(255, 255, 255, 0.04);
                    }

                    .info {
                        padding: 18px;
                        border-radius: 12px;
                        background: linear-gradient(180deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.00));
                    }

                    .brand {
                        display: flex;
                        align-items: center;
                        gap: 14px
                    }

                    .school {
                        font-size: 18px;
                        font-weight: 700
                    }

                    .small {
                        color: var(--muted);
                        font-size: 13px
                    }

                    .meta {
                        display: flex;
                        gap: 12px;
                        flex-wrap: wrap;
                        margin-top: 16px
                    }

                    .meta .pill {
                        background: var(--glass);
                        padding: 10px 12px;
                        border-radius: 10px;
                        font-weight: 600;
                        font-size: 13px;
                        color: #dbeafe
                    }

                    .table {
                        margin-top: 20px;
                        border-radius: 12px;
                        overflow: hidden;
                        background: linear-gradient(180deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.00));
                        border: 1px solid rgba(255, 255, 255, 0.03)
                    }

                    .row {
                        display: flex;
                        padding: 14px 18px;
                        align-items: center
                    }

                    .row:nth-child(odd) {
                        background: rgba(255, 255, 255, 0.008)
                    }

                    .label {
                        flex: 0 0 150px;
                        color: var(--muted);
                        font-weight: 600
                    }

                    .value {
                        flex: 1;
                        font-weight: 700
                    }

                    .amount {
                        display: flex;
                        align-items: center;
                        gap: 16px;
                        margin-top: 18px
                    }

                    .amount .big {
                        font-size: 28px;
                        font-weight: 800
                    }

                    .tag {
                        background: linear-gradient(90deg, var(--accent1), var(--accent2));
                        padding: 8px 12px;
                        border-radius: 10px;
                        font-weight: 700
                    }

                    .note {
                        margin-top: 12px;
                        color: var(--muted);
                        font-size: 13px
                    }

                    .qrcard {
                        padding: 18px;
                        border-radius: 12px;
                        background: linear-gradient(180deg, rgba(255, 255, 255, 0.015), rgba(255, 255, 255, 0.00));
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 14px;
                        border: 1px solid rgba(255, 255, 255, 0.03)
                    }

                    .qrcode {
                        width: 260px;
                        height: 260px;
                        border-radius: 14px;
                        padding: 14px;
                        background: white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2)
                    }

                    .qrcode canvas {
                        border-radius: 6px
                    }

                    .paybtn {
                        display: flex;
                        gap: 10px;
                        width: 100%;
                        margin-top: 8px
                    }

                    .btn {
                        flex: 1;
                        padding: 12px 14px;
                        border-radius: 10px;
                        font-weight: 700;
                        border: 0;
                        cursor: pointer
                    }

                    .btn-cta {
                        background: linear-gradient(90deg, var(--accent2), var(--accent1));
                        color: #032;
                    }

                    .btn-alt {
                        background: transparent;
                        border: 1px solid rgba(255, 255, 255, 0.06);
                        color: var(--muted)
                    }

                    .small-muted {
                        font-size: 13px;
                        color: var(--muted);
                        text-align: center
                    }

                    @media (max-width:880px) {
                        .card {
                            grid-template-columns: 1fr;
                        }

                        .row {
                            display: flex;
                            flex-direction: column;
                            align-items: start;
                        }

                        .qrcode {
                            width: 260px;
                            height: 260px;
                            border-radius: 14px;
                            padding: 14px;
                            background: white;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2)
                        }

                        .card {
                            width: auto;
                            padding: 0;
                            gap: 0px;
                        }

                        .brand {
                            display: flex;
                            flex-direction: column;
                            align-items: start;
                            gap: 14px
                        }

                        .label {
                            flex: 0 0;
                        }
                    }
                    
                    @media print {
                        body {
                            display: none !important;
                        }
                    }
                </style>
            </head>

            <body>
                <div class="wrap">
                    <div class="card" id="card">
                        <div class="info">
                            <div class="brand">
                                <img src="uploads/ags-logo.png" alt="AGHOSH COMPLEX LAHORE" style="width:90px; height: 90px;">
                                <div>
                                    <div class="school">RAAST QR Payment</div>
                                    <div class="small">Dated '.date('d-m-Y').'</div>
                                </div>
                            </div>

                            <div class="meta">
                                <div class="pill">Challan No: <span id="challanNo">'.$feercord['challan_no'].'</span></div>
                                <div class="pill">Due Date: <strong id="dueDate">'.date('d-m-Y', strtotime($feercord['due_date'])).'</strong></div>
                                <div class="pill">Expiry: <strong id=""><span class="label label-warning" id="bns-status-badge">'.date('t-m-Y 23:59:59', strtotime($feercord['due_date'])).'</span></strong></div>
                            </div>

                            <div class="table">
                                <div class="row">
                                    <div class="label">Registration No</div>
                                    <div class="value" id="regNo">'.$inqFromRegVal.'</div>
                                </div>
                                <div class="row">
                                    <div class="label">Student Name</div>
                                    <div class="value" id="studentName">'.$displayname.'</div>
                                </div>
                                <div class="row">
                                    <div class="label">Father Name</div>
                                    <div class="value" id="fatherName">'.$fathername.'</div>
                                </div>
                                <div class="row">
                                    <div class="label">Class</div>
                                    <div class="value" id="program">'.$feercord['class_name'].'</div>
                                </div>
                                <div class="row">
                                    <div class="label">Session</div>
                                    <div class="value" id="session">'.$feercord['session_name'].'</div>
                                </div>
                                <div class="row">
                                    <div class="label">Month</div>
                                    <div class="value" id="month">'.get_monthtypes($feercord['id_month']).'-'.date('Y' , strtotime(cleanvars($feercord['due_date']))).'</div>
                                </div>
                            </div>

                            <div class="amount">
                                <div>
                                    <div class="small-muted">Total Payable</div>
                                    <div class="big" id="amount">PKR '.number_format($totalAmount).'</div>
                                </div>
                                <div class="tag">Pay by QR</div>
                            </div>
                        </div>

                        <div class="qrcard">
                            <div style="width:100%;display:flex;justify-content:space-between;align-items:center">
                                <div style="font-weight:700">Scan & Pay</div>
                                <div style="font-size:13px;color:var(--muted)">Secure • Instant</div>
                            </div>

                            <div class="qrcode" id="qrcode"></div>

                            <div class="small-muted">Scan the QR with your banking app to pay instantly. After payment, keep the transaction reference for records.</div>
                        </div>
                    </div>
                </div>
                
                <script src="assets/javascripts/qrcode.min.js"></script>
                <script type="text/javascript" src="assets/vendor/jquery/jquery.js"></script>

                <script>
                    const qrCodeText = "'.$qrCodeText.'";

                    if(qrCodeText) {
                        new QRCode(document.getElementById("qrcode"), {
                            text: qrCodeText,
                            width: 220,
                            height: 220,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H
                        });
                    }
                    
                    document.addEventListener("keydown", function (e) { 
                        if((e.ctrlKey || e.metaKey) && e.key === "p") {
                            e.preventDefault();
                            alert("Printing is disabled on this page.");
                        }
                    });
                </script>

                <script>
                    let interval = setInterval(function() {
                        $.ajax({
                            url: "include/ajax/get_challan_status.php",
                            type: "POST",
                            data: { challan: '.$feercord['challan_no'].' },
                            dataType: "json",
                            success: function(response) {
                                console.log(response.status);
                                if(response.status == 1) {
                                    clearInterval(interval);
                                    window.location.href = "fee_challans.php?std='.$feercord['id_std'].'";
                                }
                            }
                        });
                    }, 3000);
                </script>

            </body>

        </html>';
    }else{
        die('Invalid Credentials');
    }
} else {
    die('Invalid Challan');
}