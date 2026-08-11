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
if($_SESSION['userlogininfo']['LOGINAFOR'] == 4){
//-----------------------------------------------
echo '
<title> Announcement Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Announcement Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Announcement List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center">No.</th>
		<th class="center">Subject</th>
		<th>Title</th>
		<th>Detail</th>
		<th>Date</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllmstudent  = $dblms->querylms("SELECT std_id, id_class, id_section  
										FROM ".STUDENTS." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
$value_stu = mysqli_fetch_array($sqllmstudent);
//-----------------------------------------------------
$sqllmssubject	= $dblms->querylms("SELECT DISTINCT(d.id_subject), d.id_teacher
                                        FROM ".TIMETABEL_DETAIL." d 
                                        INNER JOIN ".TIMETABLE." t 	ON t.id = d.id_setup
                                        INNER JOIN ".EMPLOYEES." e ON e.emply_id = d.id_teacher
                                        WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND t.status = '1' AND t.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
                                        AND t.id_class = '".$value_stu['id_class']."' AND t.id_section = '".$value_stu['id_section']."'
                                        ORDER BY d.id ASC");
$srno = 0;
//-----------------------------------------------------
while($value_sub = mysqli_fetch_array($sqllmssubject)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
$sqllmsann	= $dblms->querylms("SELECT a.ann_title, a.ann_detail, a.ann_dated, s.subject_name
                                        FROM ".ANNOUNCEMENT." a
                                        INNER JOIN ".CLASS_SUBJECTS." s	ON s.subject_id = a.id_subject
                                        WHERE a.ann_status = '1' AND a.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."' AND a.id_class = '".$value_stu['id_class']."' 
                                        AND a.id_section = '".$value_stu['id_section']."' AND a.id_subject = '".$value_sub['id_subject']."'
                                        AND a.id_teacher = '".$value_sub['id_teacher']."' AND a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        ORDER BY a.ann_id DESC");
$sr = 0;
//-----------------------------------------------------
while($value_ann = mysqli_fetch_array($sqllmsann)) {
$sr++;
echo '
<tr>
	<td class="center">'.$sr.'</td>
	<td class="center">'.$value_ann['subject_name'].'</td>
	<td>'.$value_ann['ann_title'].'</td>
	<td>'.$value_ann['ann_detail'].'</td>
	<td>'.date('d, M, Y' , strtotime(cleanvars($value_ann['ann_dated']))).'</td>
</tr>';
}
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>
</div>
</div>';
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {	
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
</script>
<?php 
//------------------------------------
echo '
</section>
</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>