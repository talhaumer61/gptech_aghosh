<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'added' => '1'))){ 
	echo'
	<a href="fee_challans.php?view=add" class="btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Challan</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Challans List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Issue Date</th>
		<th>Due Date</th>
		<th>Session</th>
		<th>Class</th>
		<th>Section</th>
		<th>Reg no</th>
		<th>Student</th>
		<th>Total Amount</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.challan_no, f.id_session, f.id_class, f.id_section, f.id_std,
								   f.issue_date, f.due_date, f.total_amount, f.note, 
								   c.class_id, c.class_name,
								   cs.section_id, cs.section_name,
								   s.session_id, s.session_name,
								   st.std_id, st.std_firstname, st.std_lastname, st.std_regno
								   FROM ".FEES." f
								   								   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
								   INNER JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std
								   
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY f.id_section ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['issue_date'].'</td>
	<td>'.$rowsvalues['due_date'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['std_regno'].'</td>
	<td>'.$rowsvalues['std_firstname'].' '.$rowsvalues['std_lastname'].'</td>
	<td>'.$rowsvalues['total_amount'].'</td>
	<td style="text-align:center;">'.get_payments($rowsvalues['status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'updated' => '1'))){ 
	echo'
		<a href="feesetup.php?id='.$rowsvalues['id'].'" class="btn btn-primary btn-xs");"><i class="glyphicon glyphicon-edit"></i></a>
		';
	}
	echo'
		<a class="btn btn-success btn-xs" href="feesetup.php?id='.$rowsvalues['id'].'"> <i class="fa fa-file"></i></a>
		';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'feesetup.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>
		';
		}
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
?>