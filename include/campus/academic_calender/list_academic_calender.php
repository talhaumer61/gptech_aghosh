<?php 
//-----------------------------------------------------
$sqllmsacademic	= $dblms->querylms("SELECT a.id, s.session_name
								   FROM ".A_CALENAR." a 
								   INNER JOIN ".SESSIONS." s ON s.session_id = a.id_session
								   WHERE a.status = '1' AND a.published = '1' AND a.is_deleted != '1'
								   ORDER BY a.id DESC");
$value_academic = mysqli_fetch_array($sqllmsacademic);
//-----------------------------------------------------
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<a href="academic-calendar-print.php?id='.$value_academic['id'].'&sess='.$value_academic['session_name'].'&term='.$value_academic['term'].'" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print"></i> Print</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Academic Calender for Academic Session '.$value_academic['session_name'].'</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th class="center" width="70">#</th>
		<th>Category </th>
		<th>Start Date </th>
		<th>End Date </th>
		<th>Remarks</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT d.date_start, d.date_end, d.remarks, p.cat_name
								   FROM ".ACADEMIC_DETAIL." d
								   INNER JOIN ".ACADEMIC_PARTICULARS." p ON p.cat_id = d.id_cat 
								   WHERE d.id_setup = '".$value_academic['id']."' AND p.is_deleted != '1'
								   ORDER BY p.cat_ordering ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td>'.$srno.'</td>
	<td>'.$rowsvalues['cat_name'].'</td>
	<td>'.date("d, F Y", strtotime($rowsvalues['date_start'])).'</td>
	<td>'.date("d, F Y", strtotime($rowsvalues['date_end'])).'</td>
	<td>'.$rowsvalues['remarks'].'</td>
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>';
?>