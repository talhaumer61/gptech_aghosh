<?php
//if($_SESSION['userlogininfo']['LOGINAFOR'] == 3){
//----------------------------------------------------- 
if($_GET['id']){
$sqllmsemployee  = $dblms->querylms("SELECT emply_id 
                                    FROM ".EMPLOYEES."   										 
                                    WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
                                    AND id_loginid 	= '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
$value_emp = mysqli_fetch_array($sqllmsemployee);
//----------------------------------------------------- 
$sqllmsdetail	= $dblms->querylms("SELECT d.id, d.day, t.id, t.id_session, c.class_id, c.class_name, se.section_id, se.section_name, s.subject_id, s.subject_code, s.subject_name
								   FROM ".TIMETABEL_DETAIL." d 
								   INNER JOIN ".TIMETABLE." t ON t.id = d.id_setup
								   INNER JOIN ".CLASSES." c ON 	c.class_id = t.id_class
								   INNER JOIN ".CLASS_SECTIONS." se	ON se.section_id = t.id_section
                                   INNER JOIN ".CLASS_SUBJECTS." s 	ON s.subject_id = d.id_subject
                                   INNER JOIN ".CLASS_ROOMS." r ON 	r.room_id = d.id_room
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND t.status = '1' 
								   AND t.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."' 
								   AND d.id_teacher = '".$value_emp['emply_id']."' 
								   AND d.id_subject = ".$_GET['id']." LIMIT 1");
$value_detail = mysqli_fetch_array($sqllmsdetail);
//----------------------------------------------------- 
//-----------------------------------------------
if(!$view){$info = 'text-weight-bold';}else{$info = '';}	
if($view == 'announcement'){$announcement = 'text-weight-bold';}else{$announcement = '';}	
if($view == 'attendance'){$attendance = 'text-weight-bold';}else{$attendance = '';}
if($view == 'assignment'){$assignment = 'text-weight-bold';}else{$assignment = '';}
if($view == 'dlp'){$dlp = 'text-weight-bold';}else{$dlp = '';}
if($view == 'syllabus_breakdown'){$syllabus_breakdown = 'text-weight-bold';}else{$syllabus_breakdown = '';}
if($view == 'worksheet'){$worksheet = 'text-weight-bold';}else{$worksheet = '';}
if($view == 'resource'){$resource = 'text-weight-bold';}else{$resource = '';}
if($view == 'summer_work'){$summer_work = 'text-weight-bold';}else{$summer_work = '';}
if($view == 'video_lctr'){$video_lctr = 'text-weight-bold';}else{$video_lctr = '';}
if($view == 'enroll'){$enroll = 'text-weight-bold';}else{$enroll = '';}
echo'
<section role="main" class="content-body">
	<header class="page-header">
		<h2>'.$value_detail['subject_code'].' - '.$value_detail['subject_name'].'</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';


echo '
<div class="col-md-4 col-lg-4 col-xl-3">
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading bg-primary">
    <a href=""><p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Subject Menu</p></a>
</header>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-condensed mb-none">
            <tr>
                <td class="text-md '.$info.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'"> Subject Info</a></td>
            </tr>
            <tr>
                <td class="text-md '.$announcement.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&section='.$value_detail['section_id'].'&class='.$value_detail['class_id'].'&view=announcement"> Announcement</a></td>
            </tr>
            <!-- <tr>
                <td class="text-md '.$attendance.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&section='.$value_detail['section_id'].'&class='.$value_detail['class_id'].'&view=attendance"> Attendance</a></td>
            </tr> -->
            <tr>
                <td class="text-md '.$assignment.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&section='.$value_detail['section_id'].'&class='.$value_detail['class_id'].'&view=assignment"> Assignment</a></td>
            </tr>
            <tr>
                <td class="text-md '.$dlp.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&class='.$value_detail['class_id'].'&view=dlp"> Syllabus DLP\'s</a></td>
            </tr>
            <tr>
                <td class="text-md '.$syllabus_breakdown.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&class='.$value_detail['class_id'].'&view=syllabus_breakdown"> Syllabus Breakdown</a></td>
            </tr>
            <tr>
                <td class="text-md '.$worksheet.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&class='.$value_detail['class_id'].'&view=worksheet"> Worksheets</a></td>
            </tr>
            <tr>
                <td class="text-md '.$summer_work.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&class='.$value_detail['class_id'].'&view=summer_work"> Summer Vacation Work</a></td>
            </tr>
			<tr>
                <td class="text-md '.$video_lctr.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&class='.$value_detail['class_id'].'&view=video_lctr"> Video Lectures</a></td>
            </tr>
            <tr>
                <td class="text-md '.$enroll.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&section='.$value_detail['section_id'].'&class='.$value_detail['class_id'].'&view=enroll"> Enrolled Students</a></td>
            </tr>
        </table>
    </div>
</div>
</section>
</div>

<div class="col-md-8 col-lg-8 col-xl-8">';
//--------------------------------------------
if(!$view) {
	include_once("subject/info.php");
}elseif($view) {
	include_once("subject/".$view.".php");
}
//--------------------------------------------

echo'</div>
		</div>
	</div>
</section>';
}
	/*}
 else{
        header("Location: dashboard.php");
    }*/

?>