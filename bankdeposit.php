<?php  
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

$queryFeeCollection  = $dblms->querylms("SELECT * 
                                            FROM ".FEES_COLLECTION_BANK_DEPOSIT." 
                                            WHERE id  = '".cleanvars($_GET['recepitid'])."' 
											AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
if(mysqli_num_rows($queryFeeCollection) > 0) {

    $valueFeeCollection = mysqli_fetch_array($queryFeeCollection);
	if($valueFeeCollection['id_bank'] == 5) {
		$paytype = "Cash in Head";
	} else {
		$paytype =get_depositBankAccounts($valueFeeCollection['id_bank']);
	}
echo '

    <!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Payment Voucher</title>
    <style type="text/css">
        body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; }
        /* All margins set to 2cm */
        @media all {
            .page-break	{ display: none; }
        }

        @media print {
            .page-break	{ display: block; page-break-before: always; }
        }

        @media all {
            .page-break	{ display: none; }
        }
        @media print { 
            .page-break	{ display: block; page-break-before: always; }
            @page {
                size: A4 potrait;
                thead {display: table-header-group;}    
            }
        }
        @page :first {  margin-top:30px;    /* Top margin on first page 10cm */ }
        h1 { 
            text-align:center;margin:0; margin-top:0; margin-bottom:5px; 
            font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:35px; font-weight:bold; 
            text-transform:uppercase; text-decoration:underline;
        }
        h3 { 
            text-align:center; margin:0; margin-top:0; margin-bottom:0px; 
            font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:25px; font-weight:normal;  
        }
        h4 { 
            text-align:center; margin:0; margin-bottom:5px; margin-top:5px; 
            font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-weight:700; font-size:16px; text-decoration:underline;  
        }
        .payable { border:2px solid #000; padding:2px; text-align:center; font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:13px; }

        table td.label { font-weight:bold; margin: 0; text-align:left; padding:2px; vertical-align:middle !important; }

        table.datatable { border: 1px solid #333; border-collapse: collapse; border-spacing: 0; margin-top:5px; }

        table.datatable td { 
            border: 1px solid #888; border-collapse:collapse; border-spacing: 0; padding:5px; 
            font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:14px; color:#000; 
        }

        table.datatable th { 
            border: 1px solid #888; border-collapse:collapse; border-spacing: 0; padding:7px; background:#f4f4f4; 
            font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:15px;  
        }
    </style>
    <script language="JavaScript1.2">
        function openwindow() {
            window.open("feereportprint", "feechallan","toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no,width=800,height=700");
        }
    </script>
    <link rel="shortcut icon" href="images/favicon/favicon.ico">
    </head>
    <body>
    <div style="text-align:center;">
    <table width="850" class="page" border="0" align="center" style="border-collapse:collapse;">
        <tr>
            <td align="right">
                <img src="uploads/logo.png" style="width:80px;margin-top:10px;" >
            </td>
            <td>
                <h1>AGHOSH GRAMMAR SCHOOL</h1>
				 <h3>Cash Payment Voucher</h3>
            </td>
        </tr>
		
    </table>
    <div style="clear:both;"></div>
<style type="text/css">
    table.datatable th { 
        border: 1px solid #888; border-collapse:collapse; border-spacing: 0; padding:7px; background:#f4f4f4; 
        font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:17px;  
    }
    table.datatable td { 
        border: 1px solid #888; border-collapse:collapse; border-spacing: 0; padding:5px; 
        font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; font-size:16px; color:#000; 
    }
    .border-class {
        width: 100%;
        border-bottom: 1px solid #000000;
        display: inline-block;
    }
</style> 
<table align="center" class="page" border="0" style="width:97%; border-collapse:collapse;margin-top:20px;">
        <tr>
            <td align="left" style="font-size:18px;font-weight:bold;text-align:left;">
                Payee Name: '.($valueFeeCollection['payeee']).'
            </td>
            <td align="center" style="font-size:18px;font-weight:bold;text-align:center;">
                Department: '.get_department($valueFeeCollection['id_dept']).'
            </td>
            <td align="right" style="font-size:18px;font-weight:bold;text-align:right;">
               Dated: '.date('Y-m-d', strtotime(cleanvars($valueFeeCollection['date']))).'
            </td>
        </tr>
		
    </table>

<table align="center" class="datatable" style="margin-top:20px; width:98%; font-size:16px!important;">
    <thead>
        <tr style="height:40px;">
            <th style="text-align:center;">HEAD OF ACCOUNT</th>
            <th style="text-align:center; width:120px;">Dr</th>
            <th style="text-align:center; width:120px;">Cr</th>
        </tr>
    </thead>
    <tbody>
        
        <tr style="height:40px;">
            <td style="text-align:left;">'.$valueFeeCollection['expense_head'].'</td>
            <td style="text-align:right; width:120px;">'.number_format($valueFeeCollection['amount']).'</td>
            <td style="text-align:right; width:120px;"></td>
        </tr>
          <tr style="height:40px;">
                <td style="text-align:left;"></td>
                <td style="text-align:right; width:120px;"></td>
                <td style="text-align:right; width:120px;"></td>
            </tr>
            <tr style="height:40px;">
                <td style="text-align:left;"></td>
                <td style="text-align:right; width:120px;"></td>
                <td style="text-align:right; width:120px;"></td>
            </tr>
            <tr style="height:40px;">
                <td style="text-align:left;"></td>
                <td style="text-align:right; width:120px;"></td>
                <td style="text-align:right; width:120px;"></td>
            </tr>
			<tr style="height:40px;">
            <td style="text-align:center;">'.$paytype.' ('.$valueFeeCollection['deposit_slip'].')</td>
            <td style="text-align:right; width:120px;"></td>
            <td style="text-align:right; width:120px;">'.number_format($valueFeeCollection['amount']).'</td>
        </tr>
            <tr style="height:40px;">
                <td style="text-align:left;"></td>
                <td style="text-align:right; width:120px;"></td>
                <td style="text-align:right; width:120px;"></td>
            </tr>
            <tr style="height:40px;">
                <td style="text-align:left;"></td>
                <td style="text-align:right; width:120px;"></td>
                <td style="text-align:right; width:120px;"></td>
            </tr>
            <tr style="height:40px;">
                <td style="text-align:left;"></td>
                <td style="text-align:right; width:120px;"></td>
                <td style="text-align:right; width:120px;"></td>
            </tr>
          
    </tbody>
    <thead>
        <tr style="height:40px;">
            <th style="text-align:center;">TOTAL</th>
            <th style="text-align:right; width:120px;">'.number_format($valueFeeCollection['amount']).'</th>
            <th style="text-align:right; width:120px;">'.number_format($valueFeeCollection['amount']).'</th>
        </tr>
    </thead>
</table>

<div class="border-class" style="text-align:left; margin:30px 0px 0px 10px; font-size:16px; font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif;">
    <b>Amount in words: </b>'.convert_number_to_words($valueFeeCollection['amount']).' only
</div>

<div class="border-class" style="text-align:left; margin:30px 0px 0px 10px; font-size:16px; font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif;">
    <b>NARRATION: </b>'.$valueFeeCollection['remarks'].'
</div>
<div class="border-class" style="text-align:left; margin:30px 0px 0px 10px;"></div>
<div style="text-align:left; margin-top:200px; font-size:16px; font-family: Calibri, "Calibri Light", Arial, Helvetica, sans-serif; width:98%;">
    <span style="border-top: 2px solid #000000;">Prepared By</span>
    <span style="border-top: 2px solid #000000; margin-left:18%;">Checked By</span>
    <span style="border-top: 2px solid #000000; margin-left:18%;">D.D Finance</span>
	<span style="float:right;border-top: 2px solid #000000;">Received By</span>
</div>
<div style="clear:both;"></div>
<div style="border-top:2px solid #000000; width:100%; position: fixed; bottom: 1px;  font-size:13px; text-align:center;">
    <h3 style="margin-bottom:3px; margin-top:5px;">AGHOSH GRAMMAR SCHOOL</h3>
    <span style="">Hamdard, Chowk, Township, Lahore. 04235145621</span>
    <div style="margin-bottom:15px; font-size:14px; text-align:left; ">
        <a href="https://gptech.pk" style="text-decoration:none;" target="_blank">Powered by: Green Professional Technologies</a>
        <span style="font-size:12px; float:right; margin-top:3px;margin-left:30px;">Printed date: 22/03/2024</span> 
        <span style="font-size:12px; float:right; margin-top:3px;">Printed By: System Administrator</span>
    </div>
</div>
    <div style="clear:both;"></div>
    </div>
   
    </body>
    </html>
    <script type="text/javascript" language="javascript1.2">
        <!--
        //Do print the page
        if (typeof(window.print) != "undefined") {
            window.print();
        }
        -->
    </script>
</body>
</html>';
 }