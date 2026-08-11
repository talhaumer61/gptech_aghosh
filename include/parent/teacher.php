<?php
//-----------------------------------------------------
$sqllmstudent  = $dblms->querylms("SELECT std_name, id_class, id_section  
										FROM ".STUDENTS." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND std_id = '".cleanvars($_GET['std'])."' LIMIT 1");
$value_stu = mysqli_fetch_array($sqllmstudent);
//-----------------------------------------------------
$sqllmsdetail = $dblms->querylms("SELECT d.id_teacher, e.emply_name, e.emply_phone, e.emply_email, e.emply_photo, GROUP_CONCAT(DISTINCT s.subject_name ORDER BY s.subject_name SEPARATOR ', ') AS subject_names
										FROM ".TIMETABEL_DETAIL." d
										INNER JOIN ".TIMETABLE." t ON t.id = d.id_setup
										INNER JOIN ".EMPLOYEES." e ON e.emply_id = d.id_teacher
										INNER JOIN ".CLASS_SUBJECTS." s ON s.subject_id = d.id_subject
										WHERE 
											t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
											AND t.status = '1'
											AND t.id_class = '".$value_stu['id_class']."'
											AND t.id_section = '".$value_stu['id_section']."'
										GROUP BY d.id_teacher
										ORDER BY e.emply_name ASC
								");

$srno = 0;
echo'
<style>
.image{
	border-radius: 40px;
	border: 2px solid white;
	height: 70px;
	width: 70px;
	}
</style>
<title> Teacher Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header" style="display:flex; align-items:center; justify-content:space-between;">
		<h2>Teacher Panel</h2>
		<span style="font-weight:bold; color:#cb3f44; margin-right:5px;">( '.$value_stu['std_name'].' )</span>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">';

//-----------------------------------------------------
while($value_detail = mysqli_fetch_array($sqllmsdetail)) {

if($value_detail['emply_photo']){
	$photo = '<img class="image" src="uploads/images/employees/'.$value_detail['emply_photo'].'"/>';
}
else{
	$photo = '<img class="image" src="uploads/images/employees/default.jpg"/>';
}

echo'
<div class="col-md-4 col-lg-4 col-xl-3">
<section class="panel panel-featured panel-featured-primary" >
<header class="panel-heading">
	<center>
		<p>'.$photo.'</p>
		<h4 class="text text-primary">'.$value_detail['emply_name'].'</h4>
	</center>
</header>

<div class="panel-body">
   
    <div class="table-responsive">
        <table class="table table-striped table-condensed mb-none">
            <tr>
				<td class="text text-primary"><i class="fa fa-envelope"></i> Email</td>
				<td align="right">'.$value_detail['emply_email'].'</td>
			</tr>
            <tr>
				<td class="text text-primary"><i class="fa fa-phone"></i> Phone</td>
				<td align="right">'.$value_detail['emply_phone'].'</td>
			</tr>
            <tr>
				<td class="text text-primary"><i class="fa fa-book"></i> Subject</td>
				<td align="right">'.$value_detail['subject_names'].'</td>
			</tr>
        </table>
    </div>
</div>
</section>
</div>';
}
echo'
</div>
</section>';
?>