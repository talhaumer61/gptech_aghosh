<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Defaulter Report Print</title>
<style type="text/css">
body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
@media all {
	.page-break	{ display: none; }
}

@media print{
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: A4 portrait;
	   margin: 12mm 12mm 12mm 12mm; 
	}
}
h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; }
h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:18px; font-weight:700; text-transform:uppercase; }
h4 { text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:15px; font-weight:700; word-spacing:0.1em; }
td { padding-bottom:4px; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; font-size: 14px; }
.line1 { border:1px solid #333; width:100%; margin-top:2px; margin-bottom:5px; }
.payable { border:2px solid #000; padding:2px; text-align:center; font-size:14px; }
.border-bottom { border-bottom: 1px solid #000;}
.text-center { text-align: center; }
.text-right { text-align: right; }
.text-left { text-align: left; }

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
</style>
<link rel="shortcut icon" href="images/favicon/favicon.ico">
</head>

<body>
<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top">
            <h2 style="text-align: center;">
                <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                <span style="">Aghosh Grammar School</span>
            </h2>';

            if(isset($_GET['receipt_no']) && !empty($_GET['receipt_no']) && isset($_GET['book_no']) && !empty($_GET['book_no']) && isset($_GET['grandTotal']) && !empty($_GET['grandTotal'])){
                $receipt_no = $_GET['receipt_no'];
                $book_no = $_GET['book_no'];
                $grandTotal = $_GET['grandTotal'];

                $sqlDeposit = $dblms->querylms("SELECT t.trans_id, SUM(t.trans_amount) paid, t.receipt_no, t.book_no, t.dated, f.pay_mode, f.id_std, f.challan_no, f.id_month, f.due_date, st.std_name
                                                FROM ".ACCOUNT_TRANS." t
                                                INNER JOIN ".FEES." f ON t.voucher_no = f.challan_no
                                                INNER JOIN ".STUDENTS." st ON f.id_std = st.std_id
                                                WHERE t.receipt_no    = '".cleanvars(($receipt_no))."'
                                                AND t.book_no         = '".cleanvars(($book_no))."'
                                                AND t.is_deleted      = '0' ");
                if(mysqli_num_rows($sqlDeposit)>0){
                    $valueDeposit = mysqli_fetch_array($sqlDeposit);
                    $pending = $grandTotal - $valueDeposit['paid'];
                    echo'
                    <div style="font-size:12px; margin-top:10px;">
                        <table style="border-collapse:collapse;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td><h5 style="margin-top: 10px; text-align:center;">Shah-e-Jeelani Road, Township Lahore. Ph# 042-35116787 , 35116790-91</h5></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse; margin-top:2rem;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="100">RECEIPT NO:</td>
                                    <td class="border-bottom text-center">'.$valueDeposit['receipt_no'].'</td>
                                    <td width="90" class="text-right">BOOK NO:</td>
                                    <td class="border-bottom text-center">'.$valueDeposit['book_no'].'</td>
                                    <td width="60" class="text-right">DATE:</td>
                                    <td class="border-bottom text-center">'.$valueDeposit['dated'].'</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse; margin-top:2rem;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="140">NAME OF STUDENT:</td>
                                    <td class="border-bottom text-center">'.$valueDeposit['std_name'].'</td>
                                    <td width="60" class="text-right">Challan:</td>
                                    <td class="border-bottom text-center">'.$valueDeposit['challan_no'].' ('.get_monthtypes($valueDeposit['id_month']).'-'.date('Y',strtotime($valueDeposit['due_date'])).')</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse; margin-top:1.2rem;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="140">AMOUNT <span>(in figure)</span>:</td>
                                    <td class="border-bottom text-center">'.number_format($valueDeposit['paid']).'</td>
                                    <td width="120" class="text-right">CASH/CHEQUE:</td>
                                    <td class="border-bottom text-center">'.get_paymethod($valueDeposit['pay_mode']).'</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse; margin-top:1.2rem;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="140">AMOUNT <span>(in words)</span>:</td>
                                    <td class="border-bottom text-center">'.convert_number_to_words($valueDeposit['paid']).'</td>
                                    <td width="80" class="text-right">PURPOSE:</td>
                                    <td class="border-bottom text-center">Fee</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse; margin-top:1.2rem;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="120">TOTAL AMOUNT:</td>
                                    <td class="border-bottom text-center">'.number_format($grandTotal).'</td>
                                    <td width="100" class="text-right">PAID AMOUNT:</td>
                                    <td class="border-bottom text-center">'.number_format($valueDeposit['paid']).'</td>
                                    <td width="160" class="text-right">REMAINING AMOUNT:</td>
                                    <td class="border-bottom text-center">'.number_format($pending).'</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse; margin-top:2rem;" cellpadding="2" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="150" class="border-bottom text-center"></td>
                                    <td></td>
                                    <td width="150" class="border-bottom text-center"></td>
                                </tr>
                                <tr>
                                    <td width="150" class="text-center">Cashier</td>
                                    <td></td>
                                    <td width="150" class="text-center">Accoutant</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
                }else{
                    echo'<h2 style="text-align: center; color: red; margin-top: 50px;">No Record Found</h2>';
                }
            }else{
                echo'<h2 style="text-align: center; color: red; margin-top: 50px;">No Record Found</h2>';
            }
			echo'
            <br>
            <br>
            <br>
			<span style="font-size:9px; float:right;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
            <br>
			<span style="font-size:9px; margin-top:3px; float:right;">Print Date: '.date("m/d/Y").'</span>
		</td>
	</tr>
</table>
<div class="page-break"></div>
</body>
<script type="text/javascript" language="javascript1.2">
    if(typeof(window.print) != "undefined") {
        window.print();
    }
    function windowOnAfterPrint()
    {
        window.location.href = "fee_challans.php";
    }
    window.onafterprint = windowOnAfterPrint;
</script>
</html>';
?>