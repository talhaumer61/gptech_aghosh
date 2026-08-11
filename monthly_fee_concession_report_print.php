<?php
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

if(!empty($_POST['id_classgroup'])){
    $values = explode("|",$_POST['id_classgroup']);
	$group_id   = $values[0];
	$group_name = $values[1];

    if($group_id == 3){
        $clsgrpfilter = " AND c.id_classgroup = '3'";
    }
    else{
        $clsgrpfilter = " AND c.id_classgroup != '3'";
    }
}  
echo'
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Income & Expenses Report Print</title>
        <link rel="shortcut icon" href="assets/images/favicon.png">
        <style type="text/css">
            body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
            @media all {
                .page-break	{ display: none; }
            }

            @media print {
                .page-break	{ display: block; page-break-before: always; }
                @page { 
                    size: A4 portrait;
                margin: 4mm 4mm 4mm 4mm; 
                }
            }
            h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
            .spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; }
            h2 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
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
                    <h2 style="text-align: center;">
                        <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                        <span>'.SCHOOL_NAME.'</span>
                    </h2>
                    <div style="font-size:12px;">
                        <table style="border-collapse:collapse; border:1px solid #666;" cellpadding="2" border="1" width="100%">
                                <thead>
                                    <tr>
                                        <td colspan="7"><h2>'.$group_name.'</h2></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"><h4>Monthly Fee & Concession Report</h4></td>
                                    </tr>';
                                
                                    if(isset($_POST['detail_result'])){
                                       $sqllms = $dblms->querylms("SELECT 
                                                                        s.std_id,
                                                                        s.std_name,
                                                                        s.id_class,
                                                                        s.id_session,
                                                                        s.std_regno,
                                                                        s.is_hostelized,
                                                                        c.class_name,
                                                                        fs.id AS idsetup,

                                                                        /* Hostel Registration Status */
                                                                        CASE 
                                                                            WHEN hr.id IS NOT NULL THEN 1
                                                                            ELSE 0
                                                                        END AS is_hostel_registered,

                                                                        /* Total Package Fee */
                                                                        (
                                                                            COALESCE(pkg.normalPkg,0)

                                                                            +

                                                                            CASE
                                                                                WHEN hr.id IS NOT NULL
                                                                                THEN COALESCE(pkg.hostelPkg,0)
                                                                                ELSE 0
                                                                            END

                                                                        ) AS totalPkg,

                                                                        /* Total Concession */
                                                                        COALESCE(sc.TotalConcess,0) AS TotalConcess

                                                                    FROM ".STUDENTS." s

                                                                    INNER JOIN ".CLASSES." c 
                                                                        ON c.class_id = s.id_class

                                                                    INNER JOIN ".FEESETUP." fs 
                                                                        ON fs.id_class = s.id_class
                                                                        AND fs.id_session = s.id_session

                                                                    /* Hostel Registration Check */
                                                                    LEFT JOIN ".HOSTEL_REG." hr
                                                                        ON hr.id_std = s.std_id
                                                                        AND hr.status = '1'
                                                                        AND hr.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'

                                                                    /* Package Calculation */
                                                                    LEFT JOIN (

                                                                        SELECT 
                                                                            d.id_setup,

                                                                            /* Normal Monthly Fee */
                                                                            SUM(
                                                                                CASE 
                                                                                    WHEN d.duration = 'Monthly'
                                                                                    AND d.id_cat NOT IN (1,4,5,6,7,8)
                                                                                    THEN d.amount
                                                                                    ELSE 0
                                                                                END
                                                                            ) AS normalPkg,

                                                                            /* Hostel Monthly Fee */
                                                                            SUM(
                                                                                CASE 
                                                                                    WHEN d.duration = 'Monthly'
                                                                                    AND d.id_cat IN (6,7,8)
                                                                                    THEN d.amount
                                                                                    ELSE 0
                                                                                END
                                                                            ) AS hostelPkg

                                                                        FROM ".FEESETUPDETAIL." d

                                                                        GROUP BY d.id_setup

                                                                    ) pkg ON pkg.id_setup = fs.id

                                                                    /* Scholarship / Concession */
                                                                    LEFT JOIN (

                                                                        SELECT 
                                                                            sc.id_std,
                                                                            SUM(sc.amount) AS TotalConcess

                                                                        FROM ".SCHOLARSHIP." sc

                                                                        WHERE sc.id_type = 2
                                                                        AND sc.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                                                        AND sc.is_deleted = 0

                                                                        GROUP BY sc.id_std

                                                                    ) sc ON sc.id_std = s.std_id

                                                                    WHERE s.std_id != ''
                                                                    AND s.is_deleted    != '1'
                                                                    AND s.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                                    AND s.std_status    = '1'
                                                                    AND s.is_orphan     = '2'
                                                                    ".$clsgrpfilter."

                                                                    ORDER BY c.class_ordering ASC, s.std_id DESC

                                                                ");
                                        echo '
                                        <tr>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 40px;">Sr.</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Student Name</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Registration No.</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Class</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Monthly Fee</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Concession</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">After Concession</td>
                                        </tr>
                                        </thead>
                                        <tbody>';
                                            $sr = 0;    
                                            while($row = mysqli_fetch_array($sqllms)) {
                                                $sr++;
                                                $monthlyFee    = $row['totalPkg'];
                                                $concession    = $row['TotalConcess'];
                                                $after         = $monthlyFee - $concession;

                                                $grandMonthlyFee += $monthlyFee;
                                                $grandConcession += $concession;
                                                $grandAfter      += $after;
                                                echo '
                                                <tr>
                                                    <td style="text-align:center;">'.$sr.'</td>
                                                    <td>'.$row['std_name'].'</td>
                                                    <td>'.$row['std_regno'].'</td>
                                                    <td>'.$row['class_name'].'</td>
                                                    <td style="text-align:right;">'.number_format($monthlyFee).'</td>
                                                    <td style="text-align:right;">'.number_format($concession).'</td>
                                                    <td style="text-align:right;">'.number_format($after).'</td>
                                                </tr>';
                                            }
                                            echo '
                                            <tr>
                                                <th colspan="4">Total</th>
                                                <th style="text-align:right;">'.number_format($grandMonthlyFee).'</th>
                                                <th style="text-align:right;">'.number_format($grandConcession).'</th>
                                                <th style="text-align:right;">'.number_format($grandAfter).'</th>
                                            </tr>';
                                            
                                    }elseif(isset($_POST['summary_result'])){
                                        $sqllms = $dblms->querylms("
                                                                SELECT 
                                                                    c.class_id,
                                                                    c.class_name,

                                                                    /* Number Of Students */
                                                                    COUNT(DISTINCT s.std_id) AS totalStudents,

                                                                    /* Monthly Fee */
                                                                    COALESCE(SUM(pkg.totalPkg),0) AS totalMonthlyFee,

                                                                    /* Total Concession */
                                                                    COALESCE(SUM(conc.TotalConcess),0) AS totalConcession,

                                                                    /* Remaining After Concession */
                                                                    (
                                                                        COALESCE(SUM(pkg.totalPkg),0) 
                                                                        - 
                                                                        COALESCE(SUM(conc.TotalConcess),0)
                                                                    ) AS afterConcession

                                                                FROM ".STUDENTS." s

                                                                INNER JOIN ".CLASSES." c 
                                                                    ON c.class_id = s.id_class

                                                                INNER JOIN ".FEESETUP." fs 
                                                                    ON fs.id_class = s.id_class
                                                                    AND fs.id_session = s.id_session

                                                                /* Hostel Registration */
                                                                LEFT JOIN ".HOSTEL_REG." hr
                                                                    ON hr.id_std = s.std_id
                                                                    AND hr.status = '1'
                                                                    AND hr.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'

                                                                /* Student Package Fee */
                                                                LEFT JOIN (
                                                                    SELECT 
                                                                        d.id_setup,

                                                                        /* Total Monthly Fee */
                                                                        SUM(
                                                                            CASE
                                                                                WHEN d.duration = 'Monthly'
                                                                                AND d.id_cat NOT IN (1,4,5)
                                                                                THEN d.amount
                                                                                ELSE 0
                                                                            END
                                                                        ) AS totalPkg,

                                                                        /* Hostel Categories */
                                                                        SUM(
                                                                            CASE
                                                                                WHEN d.duration = 'Monthly'
                                                                                AND d.id_cat IN (6,7,8)
                                                                                THEN d.amount
                                                                                ELSE 0
                                                                            END
                                                                        ) AS hostelPkg

                                                                    FROM ".FEESETUPDETAIL." d
                                                                    GROUP BY d.id_setup

                                                                ) pkg ON pkg.id_setup = fs.id

                                                                /* Student Concession */
                                                                LEFT JOIN (
                                                                    SELECT 
                                                                        sc.id_std,
                                                                        SUM(sc.amount) AS TotalConcess

                                                                    FROM ".SCHOLARSHIP." sc

                                                                    WHERE sc.id_type = 2
                                                                    AND sc.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                                                    AND sc.is_deleted = 0

                                                                    GROUP BY sc.id_std

                                                                ) conc ON conc.id_std = s.std_id

                                                                WHERE s.std_id != ''
                                                                AND s.is_deleted != '1'
                                                                AND s.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                                                AND s.std_status    = '1'
                                                                AND s.is_orphan     = '2'
                                                                ".$clsgrpfilter."

                                                                GROUP BY c.class_id

                                                                ORDER BY c.class_ordering ASC, s.std_id DESC
                                                            ");
                                        echo '
                                        <tr>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 40px;">Sr.</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Class</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Number of Students</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Monthly Fee</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Concession</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Previous Remaining</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">After Concession</td>
                                        </tr>
                                        </thead>
                                        <tbody>';
                                            $grandMonthlyFee   = 0;
                                            $grandConcession   = 0;
                                            $grandAfter        = 0;
                                            $sr                = 0;
                                            while($row = mysqli_fetch_array($sqllms)) {
                                                $sr++;
                                                $monthlyFee    = $row['totalMonthlyFee'];
                                                $concession    = $row['totalConcession'];
                                                $after         = $monthlyFee - $concession;

                                                $grandMonthlyFee += $monthlyFee;
                                                $grandConcession += $concession;
                                                $grandAfter      += $after;
                                                echo '
                                                <tr>
                                                    <td>'.$sr++.'</td>
                                                    <td>'.$row['class_name'].'</td>
                                                    <td>'.number_format($row['totalStudents']).'</td>
                                                    <td style="text-align:right;">'.number_format($monthlyFee).'</td>
                                                    <td style="text-align:right;">'.number_format($concession).'</td>
                                                    <td style="text-align:right;"></td>
                                                    <td style="text-align:right;">'.number_format($after).'</td>
                                                </tr>';
                                            } 
                                            echo '
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th style="text-align:right;">'.number_format($grandMonthlyFee).'</th>
                                                <th style="text-align:right;">'.number_format($grandConcession).'</th>
                                                <th style="text-align:right;"></th>
                                                <th style="text-align:right;">'.number_format($grandAfter).'</th>
                                            </tr>';
                                        
                                    }
                                    echo ' 
                                </tbody>
                        </table>
                    </div>
                    <div class="page-break"></div>
                    <span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
                    <span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
                </td>
            </tr>
        </table>
    </body>
    <script type="text/javascript" language="javascript1.2">
        //Do print the page
        if (typeof(window.print) != "undefined") {
            // window.print();
        }
    </script>
</html>';
?>