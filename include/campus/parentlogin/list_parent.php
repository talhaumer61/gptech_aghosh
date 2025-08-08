<?php 
//--------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'view' => '1'))){ 
//------------------------------------------------
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'add' => '1'))){ 
		echo'<a href="#make_parentlogin" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Make Parent Login</a>
		<h2 class="panel-title"><i class="fa fa-list"></i> Parent List</h2>';
	}
	echo'
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
<thead>
	<tr>
		<th class="center">#</th>
		<th style="width: 40px;">Photo</th>
		<th>Username</th>
		<th>Full Name</th>
		<th>Email</th>
		<th>Phone</th> 
		<th width="70px;" class="center">Status</th>
		<th width="100" class="center">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT adm_id, adm_status, adm_username, adm_fullname, adm_email, adm_phone, adm_photo
								FROM ".ADMINS."
								WHERE adm_logintype = '5' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								ORDER BY adm_username ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;

if($rowsvalues['adm_photo']){
	$photo = ''.$rowsvalues['adm_photo'].'';
}
else{
	
	$sqllmsstudent	= $dblms->querylms("SELECT std_photo
											FROM ".STUDENTS."  
											WHERE id_loginid = '".$rowsvalues['adm_id']."' 
											AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
	
	if(mysqli_num_rows($sqllmsstudent)) {
		$value_stu = mysqli_fetch_array($sqllmsstudent);
		$photo = ''.$value_stu['std_photo'].'';
	} 
	else {
		$photo =  'uploads/defualt.png';
	}
}
//-----------------------------------------------------
echo '
<tr>
	<td class="center">'.$srno.'</td>
	<td><img src="'.$photo.'" style="width:40px; height:40px;"></td>
	<td>'.$rowsvalues['adm_username'].'</td>
	<td>'.$rowsvalues['adm_fullname'].'</td>
	<td>'.$rowsvalues['adm_email'].'</td>
	<td>'.$rowsvalues['adm_phone'].'</td>
	<td class="center">'.get_status($rowsvalues['adm_status']).'</td>
	<td class="text-center">';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/parentlogin/edit_parent.php?id='.$rowsvalues['adm_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'delete' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs ml-xs" onclick="confirm_modal(\'parentlogin.php?deleteid='.$rowsvalues['adm_id'].'\');"><i class="el el-trash"></i></a>';
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