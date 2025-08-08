<?php
//if($_SESSION['userlogininfo']['LOGINAFOR'] == 3){
//----------------------------------------------------- 
if($_GET['id']){
//-----------------------------------------------------
$sqllms_std	= $dblms->querylms("SELECT id_class, id_section
								   FROM ".STUDENTS." 
								   WHERE std_id = '".$_GET['std']."'
								   AND   id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$values_std = mysqli_fetch_array($sqllms_std);
//-----------------------------------------------------
$sqllmsdetail	= $dblms->querylms("SELECT subject_id, subject_code, subject_name
								   FROM ".CLASS_SUBJECTS." 
								   WHERE id_class = '".$values_std['id_class']."'
								   AND subject_id = '".$_GET['id']."' LIMIT 1");
$value_detail = mysqli_fetch_array($sqllmsdetail);
//-----------------------------------------------------
if(!$view){$info = 'text-weight-bold';}else{$info = '';}	
if($view == 'announcement'){$announcement = 'text-weight-bold';}else{$announcement = '';}	
if($view == 'online_classes'){$online_classes = 'text-weight-bold';}else{$online_classes = '';}	
if($view == 'attendance'){$attendance = 'text-weight-bold';}else{$attendance = '';}
if($view == 'assignment'){$assignment = 'text-weight-bold';}else{$assignment = '';}
if($view == 'dlp'){$dlp = 'text-weight-bold';}else{$dlp = '';}
if($view == 'syllabus_breakdown'){$syllabus_breakdown = 'text-weight-bold';}else{$syllabus_breakdown = '';}
if($view == 'worksheet'){$worksheet = 'text-weight-bold';}else{$worksheet = '';}
if($view == 'resource'){$resource = 'text-weight-bold';}else{$resource = '';}
if($view == 'video_lctr'){$video_lctr = 'text-weight-bold';}else{$video_lctr = '';}
if($view == 'summer_work'){$summer_work = 'text-weight-bold';}else{$summer_work = '';}
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
                <td class="text-md '.$info.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'"> Subject Info</a></td>
            </tr>
            <tr>
                <td class="text-md '.$announcement.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=announcement"> Announcement</a></td>
            </tr>
            <tr>
                <td class="text-md '.$online_classes.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=online_classes"> Online Classes</a></td>
            </tr>
            <tr>
                <td class="text-md '.$attendance.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=attendance"> Attendance</a></td>
            </tr>
            <tr>
                <td class="text-md '.$assignment.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=assignment"> Assignment</a></td>
            </tr>
            <tr>
                <td class="text-md '.$dlp.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['id_class'].'&view=dlp"> Syllabus DLP\'s</a></td>
            </tr>
            <tr>
                <td class="text-md '.$syllabus_breakdown.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['id_class'].'&view=syllabus_breakdown"> Syllabus Breakdown</a></td>
            </tr>
            <tr>
                <td class="text-md '.$worksheet.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['id_class'].'&view=worksheet"> Worksheets</a></td>
            </tr>
			<tr>
                <td class="text-md '.$video_lctr.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['class_id'].'&view=video_lctr"> Video Lectures</a></td>
            </tr>
            <tr>
                <td class="text-md '.$summer_work.'"><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['class_id'].'&view=summer_work"> Summer Vacation Work</a></td>
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

echo'
</div>
		</div>
	</div>
</section>';
}
	/*}
 else{
        header("Location: dashboard.php");
    }*/

?>