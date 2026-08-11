<?php
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

echo'
<!--HIGHCHARTS-->
<script src="assets/vendor/highcharts/-highcharts.js" type="text/javascript"></script>
<link rel="shortcut icon" href="assets/images/favicon.png">
<title> Marks Sheet | School Management System</title>';
   
if($_GET['id_campus']){
    $id_campus = $_GET['id_campus'];
    $sql1 = " WHERE campus_id = '".cleanvars($id_campus)."' ";
}elseif(!empty($_SESSION['userlogininfo']['LOGINCAMPUS'])){
    $id_campus = $_SESSION['userlogininfo']['LOGINCAMPUS'];
    $sql1 = " WHERE campus_id = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ";
}

// VARIABLES
if($_GET['id_type']){ $id_exam = $_GET['id_type']; }else{ $id_exam = 'all'; }
if($_GET['id_session']){ $id_session = $_GET['id_session']; }else{ $id_session = ''; }

// CAMPUS INFO
$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code, campus_name, campus_phone, campus_address, campus_email
                                    FROM ".CAMPUS." $sql1 LIMIT 1
                                    ");
$value_campus = mysqli_fetch_array($sqllmscampus);

// DATE SHEET
$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_exam, t.id_session, t.id_class, t.id_section, t.id_campus,
                            e.type_name, c.class_name
                            FROM ".DATESHEET." t
                            INNER JOIN ".EXAM_TYPES."	e	ON	e.type_id	= t.id_exam
                            INNER JOIN ".CLASSES."		c 	ON	c.class_id	= t.id_class
                            WHERE t.id_exam     = '".cleanvars($id_exam)."'
                            AND t.id_class      = '".cleanvars($_GET['id_class'])."'                                
                            AND t.is_deleted    = '0'
                            AND t.id_session = '".$id_session."'
                            AND t.id_campus     = '".cleanvars($id_campus)."' 
                            LIMIT 1
                            ");
$rowsvalues = mysqli_fetch_array($sqllms);

$sqllmsdetail	= $dblms->querylms("SELECT d.total_marks, d.passing_marks, d.dated, s.subject_id, s.subject_name, s.subject_code
                                    FROM ".DATESHEET_DETAIL." 	 d 
                                    INNER JOIN ".CLASS_SUBJECTS." s	ON	s.subject_id	= d.id_subject
                                    WHERE d.id_setup    = '".$rowsvalues['id']."'
                                    ORDER BY d.dated
                                    ");
$examdetail = array();
while($rowsdetail = mysqli_fetch_array($sqllmsdetail)){
    $examdetail[] = $rowsdetail;
}

$sqlGrade = $dblms->querylms("SELECT g.*
                                FROM ".GRADESYSTEM." g
                                WHERE g.is_deleted = '0'
                            ");
$grades = array();
while($valGrade = mysqli_fetch_array($sqlGrade)){
    $grades[] = $valGrade;
}

// EXAM SESSION NAME
$sqllms_setting	= $dblms->querylms("SELECT session_name 
                                    FROM ".SESSIONS."
                                    WHERE session_status ='1' AND is_deleted != '1' AND session_id = '".$id_session."' 
                                    LIMIT 1
                                ");
$values_setting = mysqli_fetch_array($sqllms_setting);

echo'
<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
    <div class="panel-body">
        <style type="text/css">
            body {
                overflow: -moz-scrollbars-vertical; 
                margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";
                font-size: 12px;
                -webkit-print-color-adjust: exact !important;
            }
            body .btn-primary {
                color: #ffffff;
                text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
                background-color: #cb3f44;
                border-color: #cb3f44;
            }
            body .btn {
                white-space: normal;
            }
            .ml-sm {
                margin-left: 10px !important;
            }
            .mb-xs {
                margin-bottom: 5px !important;
            }
            .pull-right {
                float: right !important;
            }
            .btn {
                margin-right:20px;
                margin-top:20px;
                display: inline-block;
                padding: 6px 12px;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.42857143;
                text-align: center;
                vertical-align: middle;
                touch-action: manipulation;
                cursor: pointer;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
            }
            
            @media print {
                .page-break	{
                    page-break-before: always;
                }
                @page { 
                        
                }
                #printPageButton {
                    display: none;
                }
            }
            td,th{
                font-size: 11px;
            }
            table{
                border-spacing: 0;
                border-collapse: collapse;
            }
            .td-border {
                padding: 5px;
                border: 1px solid #ddd;
            }
            .th-border {
                padding: 5px;
                border: 1px solid #ddd; 
            }
            .font-times{
                font-family:"Times New Roman", Times, serif; 
                color:#000; 
                font-weight:bold;
            }
            .text-center{
                text-align:center;
            }
            .text-right{
                text-align:right;
            }
        </style>';

        // STUDENT DETAILS
        $sqlStd	= $dblms->querylms("SELECT  s.*, c.class_name
                                        FROM ".STUDENTS." 		s
                                        INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
                                        WHERE s.std_id != '' 
                                        AND s.is_deleted != '1' 
                                        AND s.id_class = '".$_GET['id_class']."'
                                        AND s.id_campus = '".cleanvars($id_campus)."' 
                                        AND s.std_id = '".cleanvars($_GET['std_id'])."'
                                        ORDER BY s.std_id
                                        ");
        $valStd = mysqli_fetch_array($sqlStd);
        
        $year = date('Y',strtotime($valStd['std_admissiondate']));
        $sr = $year.$valStd['std_id'];

        if($valStd['std_photo']) { 
            $photo = "uploads/images/students/".$valStd['std_photo']."";
        }else{
            $photo = "uploads/default-student.jpg";
        }
        echo'
        <button type="button" id="printPageButton" onClick="window.print();" class="modal-with-move-anim ml-sm mb-xs btn btn-primary btn-xs pull-right">Print</button>
        <div class="table-responsive" style="padding: 0 2rem;">        
            <style>
                .border-bottom{
                    border-bottom: 1px solid #777;
                }
                .pr-10{
                    padding-right: 5px;
                }
                .pl-10{
                    padding-left: 5px;
                }
            </style>
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="text-center" width="80"><img src="uploads/logo.png" style="max-height : 80px;"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h2 class="" style="font-size: 1.5rem;">Laurel Home International Schools</h2>
                            <h3 class="" style="font-size: 1.2rem;"><span style="text-decoration:underline">'.$value_campus['campus_name'].'</span></h3>
                            <h3 class="">'.$value_campus['campus_phone'].' / '.$value_campus['campus_email'].'</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="text-center" rowspan="4" width="150"><img src="'.$photo.'" width="100" height="100" style="border-radius: 50%;"></td>
                        <td class="pr-10 pl-10" width="200"><div class="border-bottom">Serial No: <b>'.$sr.'</b></div></td>
                        <td class="pr-10 pl-10" width="200"><div class="border-bottom">Reg No: <b>'.$valStd['std_regno'].'</b></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="pr-10 pl-10" width="200"><div class="border-bottom">Student Name: <b>'.$valStd['std_name'].'</b></div></td>
                        <td class="pr-10 pl-10" width="200"><div class="border-bottom">Father Name: <b>'.$valStd['std_fathername'].'</b></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="pr-10 pl-10" width="200"><div class="border-bottom">Class: <b>'.$valStd['class_name'].'</b></div></td>
                        <td class="pr-10 pl-10" width="200"><div class="border-bottom">Roll No: <b>'.$valStd['std_rollno'].'</b></div></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="text-center">
                            <h2 class="" style="text-decoration: underline;">Result Card '.(!empty($rowsvalues['type_name']) ? ', '.$rowsvalues['type_name'].'' : '').'</h2>
                        </td>
                    </tr>
                </tbody>
            </table>';
            if($id_exam=='all'){
                echo'
                <table style="width:100%;" class="table table-striped table-condensed mb-none">
                    <thead>
                        <tr>
                            <th colspan="2" class="th-border">Exam</th>';
                            $sqllmss	= $dblms->querylms("SELECT DISTINCT t.type_name, t.type_id
                                                            FROM ".EXAM_TYPES." t
                                                            INNER JOIN ".EXAM_MARKS."           m   ON m.id_exam    =   t.type_id
                                                            INNER JOIN ".EXAM_MARKS_DETAILS."   d   ON d.id_setup   =   m.id
                                                            WHERE d.id_std  = '".cleanvars($valStd['std_id'])."'
                                                            AND m.id_class  = '".cleanvars($_GET['id_class'])."'
                                                            ");
                            $termArray = array();
                            while($valuesql = mysqli_fetch_array($sqllmss)){
                                $termArray[] = $valuesql;
                                echo'<th colspan="2" class="th-border">'.$valuesql['type_name'].'</th>';
                            }
                            echo'
                        </tr>
                        <tr>
                            <th width="40" class="th-border">Sr.</th>
                            <th class="th-border">Subject Name</th>';
                            foreach ($termArray as $terms):
                                echo'<th class="th-border">T-M</th>
                                    <th class="th-border">O-M</th>';
                            endforeach;
                            echo'
                        </tr>
                    </thead>
                    <tbody>';
                        $sqllmsSub	= $dblms->querylms("SELECT s.subject_id, s.subject_name
                                                        FROM ".CLASS_SUBJECTS." s
                                                        WHERE s.id_class = '".cleanvars($_GET['id_class'])."'
                                                        $sqlSubject
                                                        AND s.subject_status = '1' 
                                                        AND s.is_deleted != '1'
                                                        ORDER BY s.subject_name");
                        $subjectarray = array();
                        $sr = 0;
                        while($rowSub = mysqli_fetch_array($sqllmsSub)){ 
                            $sr++;
                            $subjectarray[] = $rowSub;
                            echo'
                            <tr>
                                <td class="td-border text-center">'.$sr.'</td>
                                <td class="td-border">'.$rowSub['subject_name'].'</td>';
                                foreach ($termArray as $terms):
                                    $sqllmsmarks = $dblms->querylms("SELECT *
                                                                        FROM ".EXAM_MARKS_DETAILS." d
                                                                        INNER JOIN ".EXAM_MARKS." m ON m.id = d.id_setup 
                                                                        WHERE m.id_campus   = '".cleanvars($id_campus)."'
                                                                        AND m.id_session    = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
                                                                        AND m.id_class      = '".cleanvars($_GET['id_class'])."' 
                                                                        $sqlMarksSection
                                                                        AND m.id_subject    = '".cleanvars($rowSub['subject_id'])."'
                                                                        AND m.id_exam       = '".cleanvars($terms['type_id'])."'
                                                                        AND d.id_std        = '".cleanvars($_GET['std_id'])."' ");
                                    $valuemarks = mysqli_fetch_array($sqllmsmarks);
                                    echo'
                                        <td class="td-border">'.(isset($valuemarks['total_marks']) ? $valuemarks['total_marks'] : '0').'</td>
                                        <td class="td-border">'.(isset($valuemarks['obtain_marks']) ? $valuemarks['obtain_marks'] : '0').'</td>
                                    ';
                                endforeach;
                                echo'
                            </tr>';
                        }
                        echo'
                        <tr>
                            <td class="td-border text-right" colspan="2"><b>Total</b></td>';
                            $obt_total = 0;
                            $grand_total = 0;
                            foreach ($termArray as $terms):
                                $sqllmSUMsmarks = $dblms->querylms("SELECT SUM(m.total_marks) as TotalMarks, SUM(d.obtain_marks) as ObtMarks
                                                                    FROM ".EXAM_MARKS_DETAILS." d
                                                                    INNER JOIN ".EXAM_MARKS." m ON m.id = d.id_setup 
                                                                    WHERE m.id_campus   = '".cleanvars($id_campus)."'
                                                                    AND m.id_session    = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
                                                                    AND m.id_class      = '".cleanvars($_GET['id_class'])."' 
                                                                    $sqlMarksSection $sqlMarksSubject
                                                                    AND m.id_exam       = '".cleanvars($terms['type_id'])."'
                                                                    AND d.id_std        = '".cleanvars($_GET['std_id'])."' ");
                                $valueSUMmarks = mysqli_fetch_array($sqllmSUMsmarks);
                                echo'
                                    <td class="td-border"><b>'.(isset($valueSUMmarks['TotalMarks']) ? $valueSUMmarks['TotalMarks'] : '0').'</b></td>
                                    <td class="td-border"><b>'.(isset($valueSUMmarks['ObtMarks']) ? $valueSUMmarks['ObtMarks'] : '0').'</b></td>
                                ';
                                $obt_total = $obt_total + $valueSUMmarks['ObtMarks'];
                                $sub_tmarks = $valueSUMmarks['TotalMarks'];
                                $grand_total = $grand_total + $sub_tmarks;
                            endforeach;
                            $per = round((($obt_total/$grand_total)*100),2);
                            echo'
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="width:100%; margin-top: 10px;" class="table table-striped table-condensed mb-none">
                    <thead>
                        <tr>
                            <th class="th-border">Percentage</th>';
                            foreach ($termArray as $terms):
                                echo'<th class="th-border">'.$terms['type_name'].'</th>';
                            endforeach;
                            echo'
                            <th class="th-border">Average Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-border text-center">Marks Percentage</td>';
                            foreach ($termArray as $terms):
                                $sqllmSUMsmarks = $dblms->querylms("SELECT SUM(m.total_marks) as TotalMarks, SUM(d.obtain_marks) as ObtMarks
                                                                    FROM ".EXAM_MARKS_DETAILS." d
                                                                    INNER JOIN ".EXAM_MARKS." m ON m.id = d.id_setup 
                                                                    WHERE m.id_campus   = '".cleanvars($id_campus)."'
                                                                    AND m.id_session    = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
                                                                    AND m.id_class      = '".cleanvars($_GET['id_class'])."' 
                                                                    $sqlMarksSection $sqlMarksSubject
                                                                    AND m.id_exam       = '".cleanvars($terms['type_id'])."'
                                                                    AND d.id_std        = '".cleanvars($_GET['std_id'])."' ");
                                $valueSUMmarks = mysqli_fetch_array($sqllmSUMsmarks);
                                
                                $per = round((($valueSUMmarks['ObtMarks']/$valueSUMmarks['TotalMarks'])*100),2);
                                echo'<td class="td-border">'.$per.'%</td>';

                                $obt_total = $obt_total + $valueSUMmarks['ObtMarks'];
                                $sub_tmarks = $valueSUMmarks['TotalMarks'];
                                $grand_total = $grand_total + $sub_tmarks;
                            endforeach;
                            $percent = round((($obt_total/$grand_total)*100),2);
                            echo'
                            <td class="td-border">'.$percent.'%</td>
                        </tr>
                    </tbody>
                </table>';
            }else{
                $sqllmss = $dblms->querylms("SELECT
                                                m.id, m.total_marks, m.status, m.id_exam, m.id_class, m.id_section, m.id_subject, m.id_session, 
                                                s.subject_name, 
                                                c.class_name, 
                                                se.session_id, se.session_name, 
                                                d.id_setup, d.id_std, d.obtain_marks 
                                                FROM ".EXAM_MARKS." m 
                                                INNER JOIN ".CLASS_SUBJECTS."		s ON s.subject_id	=	m.id_subject
                                                INNER JOIN ".CLASSES."				c ON c.class_id		=	m.id_class
                                                INNER JOIN ".SESSIONS."				se ON se.session_id	=	m.id_session
                                                INNER JOIN ".EXAM_MARKS_DETAILS."	d ON d.id_setup		=	m.id
                                                WHERE m.id_campus   = '".cleanvars($id_campus)."'
                                                AND d.id_std        = '".cleanvars($valStd['std_id'])."'
                                                AND m.id_exam       = '".cleanvars($id_exam)."'
                                                AND m.id_class      = '".cleanvars($_GET['id_class'])."'
                                            ");
                echo'
                <table style="width:100%;" class="table table-striped table-condensed mb-none">
                    <thead>
                        <tr>
                            <th width="40" class="th-border">Sr.</th>
                            <th class="th-border">Subject Name</th>
                            <th class="th-border">Total Marks</th>
                            <th class="th-border">Obtained Marks</th>
                            <th class="th-border">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $obt_total      = 0;
                    $grand_total    = 0;
                    $percentage     = 0;
                    $i=0;
                    while($valuesqllmss = mysqli_fetch_array($sqllmss)){
                        $i++;
                        $percentage = round((($valuesqllmss['obtain_marks']/$valuesqllmss['total_marks'])*100),2);
                        echo'
                        <tr>
                            <td class="td-border text-center">'.$i.' </td>
                            <td class="td-border">'.$valuesqllmss['subject_name'].' </td>
                            <td class="td-border text-center">'.$valuesqllmss['total_marks'].' </td>
                            <td class="td-border text-center">'.$valuesqllmss['obtain_marks'].'</td>
                            <td class="td-border text-center">'.$percentage.'%</td>
                        </tr>';
                        $obt_total = $obt_total + $valuesqllmss['obtain_marks'];
                        $grand_total = $grand_total + $valuesqllmss['total_marks'];
                    }
                    $percent = round((($obt_total/$grand_total)*100),2);
                    echo'
                        <tr>
                            <td class="td-border text-center" colspan="2"><b>Grand Total</b></td>
                            <td class="text-center td-border"><b>'.$grand_total.'</b></td>
                            <td class="text-center td-border"><b>'.$obt_total.'</b></td>
                            <td class="text-center td-border"><b>'.$percent.'%</b></td>
                        </tr>
                    </tbody>
                </table>';
            }
            echo'
            <table width="100%" style="margin-top:10px;">
                <tbody>
                    <tr>
                        <td class="text-center">
                            <h3 style="text-decoration: underline">Development in Behavior</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table width="100%">
                <thead>
                    <tr>
                        <th class="text-center td-border">Traits</th>
                        <th class="text-center td-border" width="100">Score(10-1)</th>
                        <th class="text-center td-border">Traits</th>
                        <th class="text-center td-border" width="100">Score(10-1)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-border">Interest in Academic Activities</td>
                        <td class="td-border"></td>
                        <td class="td-border">Interest in Completion of Home/Class Assignment</td>
                        <td class="td-border"></td>
                    </tr>
                    <tr>
                        <td class="td-border">Application of Knowledge</td>
                        <td class="td-border"></td>
                        <td class="td-border">Dress and Personal Hygiene</td>
                        <td class="td-border"></td>
                    </tr>
                    <tr>
                        <td class="td-border">Spirit of Cooperation</td>
                        <td class="td-border"></td>
                        <td class="td-border">Observance and Application of School/Class Rules</td>
                        <td class="td-border"></td>
                    </tr>
                    <tr>
                        <td class="td-border">Mixing with Peer Socially/Academically</td>
                        <td class="td-border"></td>
                        <td class="td-border">Respect to Class/School Inventory</td>
                        <td class="td-border"></td>
                    </tr>
                    <tr>
                        <td class="td-border">Obedience and Respectfulness</td>
                        <td class="td-border"></td>
                        <td class="td-border">Participation in Co-Curricular Activities</td>
                        <td class="td-border"></td>
                    </tr>
                    <tr>
                        <td class="td-border">Overall Conduct</td>
                        <td class="td-border"></td>
                        <td class="td-border">Number of Attendance</td>
                        <td class="td-border"></td>
                    </tr>
                    <tr>
                        <td class="td-border" colspan="2">Total Score</td>
                        <td class="td-border" colspan="2"></td>
                    </tr>
                </tbody>
            </table> 
            <table width="100%" style="margin-top:10px;">
                <tbody>
                    <tr>
                        <th class="td-border" rowspan="2">Grading</th>';
                        foreach($grades as $grade){
                            $select = '';
                            if($grade['grade_lowermark']<= round($percent)){
                                if(round($percent) <= $grade['grade_uppermark']){
                                    $select = 'style="background: #37F713;"';
                                }else{
                                    $select = '';
                                }
                            }
                            echo'<td class="td-border text-center" '.$select.'>'.$grade['grade_name'].'</td>';
                        }
                        echo'
                    </tr>
                    <tr>';
                        foreach($grades as $grade){
                            $select = '';
                            if($grade['grade_lowermark']<= round($percent)){
                                if(round($percent) <= $grade['grade_uppermark']){
                                    $select = 'style="background: #37F713;"';
                                }else{
                                    $select = '';
                                }
                            }
                            echo'<td class="td-border text-center" '.$select.'>'.$grade['grade_comment'].'</td>';
                        }
                        echo'
                    </tr>
                </tbody>
            </table>
            <br>
            <br>
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="120"><b>CLASS TEACHER: </b></td>
                        <td width="150" style="border-bottom: 1px solid;"></td>
                        <td></td>
                        <td width="150" class="text-center"><b>EXAM COORDINATOR: </b></td>
                        <td width="150" style="border-bottom: 1px solid;"></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</section>
<!-- CHART FILES -->
<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
<script src="assets/vendor/snap.svg/snap.svg.js"></script>
<script src="assets/vendor/snap.svg/snap.svg.js"></script>
<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>';
?>