<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'add' => '1'))){ 
	echo'
	<a href="#make_scholarship" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Fine
	</a>';
}
echo '
	<h2 class="panel-title"><i class="fa fa-list"></i>  Fine List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center; width: 50px;">#</th>
		<th>Student Reg no.</th>
		<th>Student</th>
		<th>Fine Name</th>
		<th>Amount</th>
		<th>Date</th>
		<th>Class </th>
		<th>Session </th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.id, s.status, s.id_type, s.amount, s.date, s.id_cat,  s.id_std, s.id_session, s.note, s.id_campus,
								   c.cat_id, c.cat_name, c.cat_type,
								   st.std_id, st.std_name, st.std_fathername, st.std_regno,
								   cl.class_name, se.session_id, se.session_name
								   FROM ".SCHOLARSHIP." s
								   INNER JOIN ".SCHOLARSHIP_CAT." c ON c.cat_id = s.id_cat
								   INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std
								   LEFT  JOIN ".CLASSES."  cl ON cl.class_id 	= s.id_class
								   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   WHERE s.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
								   AND s.id_type = '3' AND c.cat_type = '3'
								   ORDER BY s.id DESC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['std_regno'].'</td>
	<td>'.$rowsvalues['std_name'].' '.$rowsvalues['std_fathername'].'</td>
	<td>'.$rowsvalues['cat_name'].'</td>
	<td>'.$rowsvalues['amount'].'</td>
	<td>'.date('Y-m', strtotime($rowsvalues['date'])).'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['session_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td class="text-center">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'edit' => '1'))){ 
	echo'
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" 
		onclick="showAjaxModalZoom(\'include/modals/fine/fine_update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i></a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'delete' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'notice.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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
<script type="text/javascript">
	function get_classstudent(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_class-student.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#getclassstudent").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}
</script>