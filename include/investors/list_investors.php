<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'view' => '1'))){ 
echo'
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'added' => '1'))){ 
	echo'
	<a href="investors.php?view=add" class="btn btn-primary btn-xs pull-right">
	<i class="fa fa-plus-square"></i> Make Investor</a>
	';
}
echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Investors List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th>Name</th>
		<th>Phone</th>
		<th>EMail</th>
		<th>CNIC</th>
		<th>Type</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="70" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT i.inv_id, i.inv_status, i.id_type, i.inv_name, i.inv_email, i.inv_phone, i.inv_cnic
								   FROM ".INVESTORS." i
								   
								   ORDER BY i.inv_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['inv_name'].'</td>
	<td>'.$rowsvalues['inv_phone'].'</td>
	<td>'.$rowsvalues['inv_email'].'</td>
	<td>'.$rowsvalues['inv_cnic'].'</td>
	<td>'.$rowsvalues['id_type'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['inv_status']).'</td>
	<td>';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'updated' => '1'))){ 
	echo'
		<a class="btn btn-success btn-xs" href="investors.php?id='.$rowsvalues['inv_id'].'"> <i class="fa fa-user-circle-o"></i></a>
		';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '28', 'deleted' => '1'))){ 
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'investors.php?deleteid='.$rowsvalues['inv_id'].'\');"><i class="el el-trash"></i></a>
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