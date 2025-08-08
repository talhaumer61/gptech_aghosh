<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'add' => '1'))){
		echo'<a href="#make_visitor" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Visitor</a>
		<h2 class="panel-title"><i class="fa fa-list"></i> Visitor List</h2>';
	}
	echo'
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Id Purpose</th>
		<th>Card No</th>
		<th>Name</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Cnic</th>
		<th>Num Of Person</th>
		<th>Dated</th>
		<th>Time In</th>
		<th>Time Out</th>
		<th>Note</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-------------------------------------------------				
														
$sqllms	= $dblms->querylms("SELECT v.id, v.status, v.id_purpose, v.card_no, v.name, v.phone, v.email, v.cnic, v.num_of_person, v.dated, v.time_in, v.time_out, v.note,
								p.purpose_id,p.purpose_name

								 
								   FROM ".VISITOR." v 
								   INNER JOIN ".VISITOR_PURPOSES." p ON p.purpose_id = v.id_purpose
								   WHERE v.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY v.card_no ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['purpose_name'].'</td>
	<td>'.$rowsvalues['card_no'].'</td>
	<td>'.$rowsvalues['name'].'</td>
	<td>'.$rowsvalues['phone'].'</td>
	<td>'.$rowsvalues['email'].'</td>
	<td>'.$rowsvalues['cnic'].'</td>
	<td>'.$rowsvalues['num_of_person'].'</td>
	<td>'.$rowsvalues['dated'].'</td>
	<td>'.$rowsvalues['time_in'].'</td>
	<td>'.$rowsvalues['time_out'].'</td>
	<td>'.$rowsvalues['note'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['status']).'</td>
	<td>';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'edit' => '1'))){
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/visit/visitor/update.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'delete' => '1'))){
			echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'visitors.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
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
}else{
    header("Location: dashboard.php");
}