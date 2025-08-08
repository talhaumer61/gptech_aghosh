<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i>  Section List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Section Name</th>
		<th>Section Strength</th>
		<th>Class Name</th>
		<th width="70px;" style="text-align:center;">Status</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT sec.section_id, sec.section_name, sec.section_strength, sec.id_class, sec.section_status,
									c.class_id, c.class_name
								FROM ".CLASS_SECTIONS." sec
								INNER JOIN ".CLASSES." c ON c.class_id = sec.id_class
								WHERE sec.section_id != ''  
								ORDER BY sec.section_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['section_strength'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['section_status']).'</td>';
echo '
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
?>