<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '58', 'view' => '1'))){ 
echo '
<title>Students Learning Resources | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Students Learning Resources Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i> Students Learning Resources List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="text-center">#</th>
		<th>Week</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Note</th>
		<th width="80" class="text-center">Download</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT r.res_id, r.res_file, r.id_class, r.week,
								r.id_term, r.id_session, r.note, se.session_name, c.class_name,
								cs.subject_name
								FROM ".LEARNING_RESOURCES." r 
								INNER JOIN ".SESSIONS." se ON se.session_id = r.id_session
								INNER JOIN ".CLASSES." c ON c.class_id = r.id_class
								LEFT JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = r.id_subject
								WHERE r.res_status = '1' AND r.is_deleted != '1'
								AND r.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
								ORDER BY r.res_id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno ++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['week'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['subject_name'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td class="text-center">
	<a href="uploads/learning_resources/'.$rowsvalues['res_file'].'" download="'.$rowsvalues['session_name'].'-'.$rowsvalues['week'].'-'.$rowsvalues['class_name'].'" class="btn btn-success btn-xs");"><i class="glyphicon glyphicon-download"></i> </a>
	<a href="uploads/learning_resources/'.$rowsvalues['res_file'].'" class="btn btn-info btn-xs");" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>';
	echo'
	</td>
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
//-----------------------------------------------
echo '
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
//-----------------------------------------------
}
else{
	header("Location: dashboard.php");
}
?>