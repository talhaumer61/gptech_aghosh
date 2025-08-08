<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();

    // Academic Calendar
    $sqllms	= $dblms->querylms("SELECT d.date_start, d.date_end, d.remarks, p.cat_name
                                    FROM ".ACADEMIC_DETAIL." d
                                    INNER JOIN ".ACADEMIC_PARTICULARS." p ON p.cat_id = d.id_cat 
                                    WHERE d.id_setup = '".cleanvars($_GET['id'])."' 
                                    AND p.cat_status = '1' AND p.is_deleted != '1'
                                    ORDER BY p.cat_ordering ASC");
                                    
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Academic Calender '.cleanvars($_GET['sess']).' - '.SCHOOL_NAME.'</title>
<link rel="shortcut icon" href="assets/images/favicon.png">
<style type="text/css">
body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		 
	   margin: 4mm 4mm 4mm 4mm; 
	}
}
h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; }
h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:18px; font-weight:700; text-transform:uppercase; }
h4 { 
	text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:15px; font-weight:700; word-spacing:0.1em;  
}
td { padding-bottom:4px; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; }
.line1 { border:1px solid #333; width:100%; margin-top:2px; margin-bottom:5px; }
.payable { border:2px solid #000; padding:2px; text-align:center; font-size:14px; }

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
                <div class="row">
                    <h2>
                        <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px; vertical-align: middle;">
                        '.SCHOOL_NAME.'
                    </h2>
                    <h4>Academic Calender '.cleanvars($_GET['sess']).' ('.cleanvars(get_term($_GET['term'])).')</h4>
                </div>
                <div class="line1"></div>
                    <div style="font-size:12px;">
                        <table style="width:100%; border-collapse:collapse; margin-top: 10px;" border="1">
                            <tbody>				
                                <tr>
                                    <th>Sr#</th>
                                    <th>Category </th>
                                    <th>Start Date </th>
                                    <th>End Date </th>
                                    <th>Remarks</th>
                                </tr>';

                                $srno = 0;

                                while($rowsvalues = mysqli_fetch_array($sqllms)) {
                                    $srno++;
                                    echo'
                                    <tr>
                                        <td style="text-align: center;">'.$srno.'</td>
                                        <td>'.$rowsvalues['cat_name'].'</td>
                                        <td>'.date("d, F Y", strtotime($rowsvalues['date_start'])).'</td>
                                        <td>'.date("d, F Y", strtotime($rowsvalues['date_end'])).'</td>
                                        <td>'.$rowsvalues['remarks'].'</td>
                                    </tr>';
                                }
                                echo'
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
<script type="text/javascript" language="javascript1.2">
<!--
 //Do print the page
if (typeof(window.print) != "undefined") {
    window.print();
}
-->
</script>
</html>';
?>