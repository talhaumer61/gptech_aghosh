<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
    $sqllmsChallan = $dblms->querylms("SELECT f.id, f.status, f.challan_no, f.issue_date, f.due_date, f.id_reg, f.id_session, f.id_examtype, f.total_amount, f.paid_amount, c.campus_name, c.campus_phone, c.campus_head, s.session_name, t.type_name, ef.fee_per_std, f.paid_date
                                        FROM ".EXAM_FEE_CHALLANS." f									
                                        INNER JOIN ".CAMPUS." c ON c.campus_id = f.id_campus
                                        INNER JOIN ".EXAM_REGISTRATION." d ON d.reg_id = f.id_reg
                                        INNER JOIN ".EXAM_REGISTRATION_DETAIL." dd ON dd.id_reg = d.reg_id 
                                        INNER JOIN ".EXAM_TYPES." t ON t.type_id = f.id_examtype
                                        INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
                                        LEFT JOIN ".EXAM_FEE." ef ON f.id_campus = ef.id_campus
                                        WHERE f.challan_no = '".cleanvars($_GET['id'])."'
                                        AND f.is_deleted != '1' 
                                        GROUP BY dd.id_reg
                                        LIMIT 1
                                    ");
    $vlaueChallan = mysqli_fetch_array($sqllmsChallan); 
    $array  =   explode('-',$vlaueChallan['session_name']);
    $sesion =   $array[1];
    // CLASS DETAILS
    $sqlClass = "SELECT c.class_name, c.class_id
                FROM ".CLASSES." as c
                INNER JOIN ".EXAM_REGISTRATION." d ON (
                                                        d.id_class = c.class_id
                                                        AND FIND_IN_SET(d.reg_id, '".cleanvars($vlaueChallan['id_reg'])."')  
                                                    )
                WHERE c.is_deleted = '0'
                AND c.class_status = '1'
                ORDER BY c.class_id ASC
                ";


    $sqllmsCountStd	= $dblms->querylms("SELECT edd.id_std
                                        FROM ".EXAM_REGISTRATION." ed
                                        INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON ED.reg_id = edd.id_reg
                                        WHERE ed.id_session 	= ".cleanvars($vlaueChallan['id_session'])."
                                        AND ed.id_type 			= ".cleanvars($vlaueChallan['id_examtype'])."
                                        AND ed.is_deleted 		= '0'");
    echo '
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Exam Fee Challan Print</title>
            <style type="text/css">
                body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
                @media all {
                    .page-break	{ display: none; }
                }
                @media print {
                    .page-break	{ display: block; page-break-before: always; }
                    body {-webkit-print-color-adjust: exact;}
                    @page { 
                         
                    }
                }
                h1 { 
                    text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:34px; font-weight:700; text-transform:uppercase; 
                }
                .spanh1 { 
                    font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; 
                }
                h2 { 
                    text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; 
                }
                .spanh2 { 
                    font-size:20px; font-weight:700; text-transform:none; 
                }
                h3 { 
                    text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:18px; font-weight:700; text-transform:uppercase; 
                }
                h4 { 
                    text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:15px; font-weight:700; word-spacing:0.1em;  
                }
                .line1 { 
                    border:1px solid #333; width:100%; margin-top:2px; margin-bottom:5px; 
                }
                .payable { 
                    border:2px solid #000; padding:2px; text-align:center; font-size:14px; 
                }
                .paid:after
                {
                    content:"PAID";
                    
                    position:absolute;
                    top:30%;
                    left:20%;
                    z-index:1;
                    font-family:Arial,sans-serif;
                    -webkit-transform: rotate(-5deg); /* Safari */
                    -moz-transform: rotate(-5deg); /* Firefox */
                    -ms-transform: rotate(-5deg); /* IE */
                    -o-transform: rotate(-5deg); /* Opera */
                    transform: rotate(-5deg);
                    font-size:250px;
                    color:green;
                    background:#fff;
                    border:solid 4px yellow;
                    padding:5px;
                    border-radius:5px;
                    zoom:1;
                    filter:alpha(opacity=50);
                    opacity:0.1;
                    -webkit-text-shadow: 0 0 2px #c00;
                    text-shadow: 0 0 2px #c00;
                    box-shadow: 0 0 2px #c00;
                }
                .text-center{
                    text-align:center;
                }
            </style>
            <link rel="shortcut icon" href="images/favicon/favicon.ico">
        </head>
        <body '.($vlaueChallan['status'] == 1 ? 'class="paid"' : '' ).'>
            <br>
            <table width="900px" align="center">
                <tr>
                    <td width="150px">
                        <img src="uploads/logo.png" class="img-fluid"  align="right" style="width: 130px; height: 130px;"> 
                    </td>
                    <td class="text-center">
                        <h1 style="border-bottom:2px solid;   display: inline;">'.SCHOOL_NAME.'</h1>
                        <p style=" font-weight:bold; margin-top:5px">'.SCHOOL_ADDRESS.' Tel: '.SCHOOL_PHONE.'</p>
                        <p style="font-weight:bold; margin-top:-15px"">Email: '.SCHOOL_EMAIL.', '.SCHOOL_WEBSITE.'</p>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table width="900px" align="center">
                <tr>
                    <td><h3>Invoice</h3></td>
                </tr>
            </table>
            <br>
            <table width="900px" align="center">
                <tr>
                    <td  width="180px">
                        <span style="font-weight:bold;">'.$vlaueChallan['campus_name'].'</span><br>
                        <span style="font-weight:bold;">'.$vlaueChallan['campus_head'].'</span><br>
                        <span style="font-weight:bold;">'.$vlaueChallan['campus_phone'].'</span>
                    </td>
                    <td></td>
                    <td  width="180px"><h
                        <span style="font-weight:bold;">Invoice # '.$_GET['id'].'</span><br>
                        <span style="font-weight:bold;">Issue Date : '.$vlaueChallan['issue_date'].'</span><br>
                        <span style="font-weight:bold;">Due Date : '.$vlaueChallan['due_date'].'</span><br>
                        <span style="font-weight:bold;">Paid Date : '.$vlaueChallan['paid_date'].'</span><br>
                    </td>
                </tr>
            </table>
            <table width="900px" align="center" style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1">
                <tr style="background-color:black; color:white;">
                    <th class="text-center">Description</th>
                    <th class="text-center">Number of Students</th>
                    <th class="text-center">ExamFee</th>
                    <th class="text-center">Total</th>
                </tr>
                <tr>
                    <td class="text-center">'.$vlaueChallan['type_name'].' '.$sesion.'</td>
                    <td class="text-center">
                        '.mysqli_num_rows($sqllmsCountStd).'
                    </td>
                    <td class="text-center">'.((!empty($vlaueChallan['fee_per_std']))? $vlaueChallan['fee_per_std']: DEFAULT_EXAM_FEE).'</td>
                    <td class="text-center">'.$vlaueChallan['total_amount'].'</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left-style : hidden!important; border-bottom-style : hidden!important;"></td>
                    <th class="text-center">Payable</th>
                    <th class="text-center">'.(!empty($vlaueChallan['paid_amount']) ? $vlaueChallan['paid_amount']: $vlaueChallan['total_amount']).'</th>
                </tr>
            </table>
            <table width="800px" align="center" style="border-collapse:collapse; border:1px solid #666; margin-top:100px;" cellpadding="2" border="1">
                <tr>';
                    $resultClass = $dblms->querylms($sqlClass);
                    while($valClass = mysqli_fetch_array($resultClass)){
                        echo '<td class="text-center">'.$valClass['class_name'].'</td>';
                    }
                    echo '
                </tr>
                <tr>';
                    $resultStd = $dblms->querylms($sqlClass);
                    while($valStd = mysqli_fetch_array($resultStd)){
                        $StdCount = $dblms->querylms("SELECT dd.id_std
                                                        FROM ".EXAM_REGISTRATION." d
                                                        INNER JOIN ".EXAM_REGISTRATION_DETAIL." dd ON dd.id_reg = d.reg_id
                                                        WHERE d.id_session 	= ".cleanvars($vlaueChallan['id_session'])."
                                                        AND d.id_type 			= ".cleanvars($vlaueChallan['id_examtype'])."
                                                        AND d.id_class 			= ".cleanvars($valStd['class_id'])."
                                                        AND d.is_deleted 		= '0'");
                        echo '<td class="text-center">'.mysqli_num_rows($StdCount).'</td>';
                    }
                    echo '
                </tr>
            </table>
            <table width="920px" align="center" style="margin-top:250px;">
                <tr>
                    <td><p style=" font-size: 18px; font-weight: bold; ">Terms & Conditions</p></td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>Make sure about Number of Students,</li>
                            <li>Above Mentionaed Students Should be Entered on CMS before '.date('d M-y', strtotime($vlaueChallan['due_date'])).'</li>
                            <li>Bank Name: Finja Bank Branch Code: 0293 Account Title :<b><u>Laurel Home International.</u></b> Account Number :<b><u>02930104623590</u></b></li>
                            <li>Account Title: Laurel Home International. Account Number: 02930104623590</li>
                            <li>Please deposit the dues before due date & ensure the sharing of scanned deposit slip by WhatsApp on 0309-0000994 (Central Coordinator). In case of late payment, In case of any query feel free to contact on 0309-0000994(Centeral Coordinator). 08:30 am to 04:30 pm</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </body>
    </html>';
?>
<script type="text/javascript" language="javascript1.2">
    //Do print the page
    if (typeof(window.print) != "undefined") {
        window.print();
    }
</script>