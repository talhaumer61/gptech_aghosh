<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
echo'<title> Dashboard | '.TITLE_HEADER.'</title>';

//------------------NOTIFICATION MODAL START----------------------
$sqllms	= $dblms->querylms("SELECT not_title, dated, not_description
										FROM ".NOTIFICATIONS." 
										WHERE not_status = '1' AND is_deleted != '1' AND to_parent = '1'
										AND (id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' OR id_campus = '0') ORDER BY not_id desc
										");
//---------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------
if($rowsvalues['not_title'] || $rowsvalues['not_description'])
{
echo'
<div class="modal fade col-md-6 col-sm-10" id="myModal" style="position: absolute; left: 50%;top: 35%;transform: translate(-50%, -50%);">
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <h2 class="panel-title">
                <span style="font-size: 30px; line-height: 30px;"><i class="fa fa-bell"></i> '.$rowsvalues['not_title'].'</span>
                <a class="close" data-dismiss="modal"><i class="fa fa-window-close"></i></a>
            </h2>
        </header>
        <div class="panel-body" style="height: 200px; line-height: 30px; padding: 20px; text-align:center; text-align: justify;">
            <h3>'.$rowsvalues['not_description'].'</h3>
        </div>
    </section>
</div>
';
}
//------------------NOTIFICATION MODAL END----------------------
if(!isset($_GET['std']))
{
echo '
<style>
.image{
	border-radius: 40px;
	border: 2px solid white;
	height: 70px;
	width: 70px;
	}
a:hover{
	text-decoration: none;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Childrens </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">';
//-----------------------------------------------------
$sqllmsdetail	= $dblms->querylms("SELECT g.guardian_relation, s.std_id, s.std_name, s.std_fathername, s.std_photo, c.class_name, cs.section_name
                                        FROM ".GUARDIANS." g 
                                        INNER JOIN ".STUDENTS." 	  s  ON s.id_guardian = g.guardian_id
                                        INNER JOIN ".CLASSES."  	  c  ON c.class_id	  = s.id_class
                                        INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = s.id_section
                                        WHERE g.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND g.guardian_status = '1' 
										AND g.id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
                                        ORDER BY c.class_name ASC");
$srno = 0;
//-----------------------------------------------------
while($value_detail = mysqli_fetch_array($sqllmsdetail)) {

if($value_detail['std_photo']){
	$photo = '<img class="image" src="uploads/images/employees/'.$value_detail['std_photo'].'"/>';
}
else{
	$photo = '<img class="image" src="uploads/images/employees/default.jpg"/>';
}

echo'
<div class="col-md-4 col-lg-4 col-xl-3">
	<a href="dashboard.php?std='.$value_detail['std_id'].'">
		<section class="panel panel-featured panel-featured-primary" >
			<header class="panel-heading">
				<center>
					<p>'.$photo.'</p>
					<h4 class="text text-primary">'.$value_detail['std_name'].' '.$value_detail['std_fathername'].'</h4>
				</center>
			</header>
		
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-condensed mb-none">
						<tr>
							<td class="text text-primary"><i class="fa fa-check"></i> Realtion</td>
							<td align="right">'.$value_detail['guardian_relation'].'</td>
						</tr>
						<tr>
							<td class="text text-primary"><i class="fa fa-check"></i> Class</td>
							<td align="right">'.$value_detail['class_name'].'</td>
						</tr>
						<tr>
							<td class="text text-primary"><i class="fa fa-check"></i> Section</td>
							<td align="right">'.$value_detail['section_name'].'</td>
						</tr>
					</table>
				</div>
			</div>
		</section>
	</a>
</div>';
}
echo'
</div>
</section>';
}
//-----------------------------------------------

else if(isset($_GET['std']))
{
	echo'<section role="main" class="content-body">
	<header class="page-header">
		<h2>Subjects</h2>
	</header>
    <!-- INCLUDEING PAGE -->
    <style>
        a:link {text-decoration: none;}
    </style>
<div class="row">';
//-----------------------------------------------------
$sqllms_std	= $dblms->querylms("SELECT id_class, id_section
								   FROM ".STUDENTS." 
								   WHERE std_id = '".$_GET['std']."'
								   AND   id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   LIMIT 1");
$values_std = mysqli_fetch_array($sqllms_std);
//-----------------------------------------------------
$sqllmsdetail	= $dblms->querylms("SELECT *
                                        FROM ".CLASSES." c 
										INNER JOIN ".CLASS_SUBJECTS." s ON s.id_class = c.class_id
                                        WHERE c.class_id = '".$values_std['id_class']."' AND s.subject_status = '1' 
                                        ");
if(mysqli_num_rows($sqllmsdetail) > 0){								
while($value_detail = mysqli_fetch_array($sqllmsdetail)){
//-----------------------------------------------------
echo ' 
<div class="col-md-4 col-lg-4 col-xl-3">
<section class="panel panel-featured panel-featured-primary" >
<header class="panel-heading bg-primary">
    <a href="subject.php?id='.$value_detail['subject_id'].'">
            <p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;" >'.$value_detail['subject_code'].' - '.$value_detail['subject_name'].'</p>
    </a>
</header>

<div class="panel-body">
   
    <div class="table-responsive">
        <table class="table table-striped table-condensed mb-none">
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?id='.$value_detail['subject_id'].'&std='.$_GET['std'].'"> Subject Info</a></td>
            </tr>
			<tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=announcement"> Announcement</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$value_detail['class_id'].'&view=online_classes"> Online Classes</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=attendance"> Attendance</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&section='.$values_std['id_section'].'&class='.$values_std['id_class'].'&view=assignment"> Assignment</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['id_class'].'&view=dlp"> Syllabus DLP\'s</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['id_class'].'&view=syllabus_breakdown"> Syllabus Breakdown</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['id_class'].'&view=worksheet"> Worksheets</a></td>
            </tr>
			<tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['class_id'].'&view=video_lctr"> Video Lectures</a></td>
            </tr>
            <tr>
                <td><i class="fa fa-dot-circle-o"></i><a href="subject.php?std='.$_GET['std'].'&id='.$value_detail['subject_id'].'&class='.$values_std['class_id'].'&view=summer_work"> Summer Vacation Work</a></td>
            </tr>
        </table>
    </div>
</div>
</section>
</div>';
}
}else{echo'<h2>Not Enrolled In Any Course</h2>';}
echo '
</div>
</section>';
	}

//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>