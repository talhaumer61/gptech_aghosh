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
<title> Resource Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Resource Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Resource List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
<thead>
	<tr>
		<th class="center">No.</th>
		<th class="center">Subject</th>
		<th>Title</th>
		<th>Detail</th>
		<th></th>
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
                                        WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND t.status = '1' AND t.id_session = '1' 
                                        AND t.id_class = '".$value_stu['id_class']."' AND t.id_section = '".$value_stu['id_section']."'
                                        ORDER BY d.id ASC");
$srno = 0;
//-----------------------------------------------------
while($value_sub = mysqli_fetch_array($sqllmssubject)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
$sqllmsres	= $dblms->querylms("SELECT r.res_title, r.res_detail, r.res_file, s.subject_name
                                        FROM ".RESOURCES." r
                                        INNER JOIN ".CLASS_SUBJECTS." s	ON s.subject_id = r.id_subject
                                        WHERE r.res_status = '1' AND r.id_session = '1' AND r.id_class = '".$value_stu['id_class']."' 
                                        AND r.id_section = '".$value_stu['id_section']."' AND r.id_subject = '".$value_sub['id_subject']."'
                                        AND r.id_teacher = '".$value_sub['id_teacher']."' AND r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                        ORDER BY r.res_id DESC");
$sr = 0;
//-----------------------------------------------------
while($value_res = mysqli_fetch_array($sqllmsres)) {
if($value_res['res_file']){
    $download = '<a class="btn btn-primary btn-xs" style="width: 90px" href="uploads/resources/'.$value_res['res_file'].'"><i class="fa fa-download"></i> Download</a>';
}
else{
    $download = '';
}
$sr++;
echo '
<tr>
	<td class="center">'.$sr.'</td>
	<td class="center">'.$value_res['subject_name'].'</td>
	<td>'.$value_res['res_title'].'</td>
	<td>'.$value_res['res_detail'].'</td>
	<td class="center" width="120">'.$download.'</td>
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