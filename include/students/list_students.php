<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'view' => '1'))){
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'added' => '1'))){
	echo'
		<a href="students.php?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Student</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Students List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
<tr>
	<th>#</th>
	<th width= 40>Photo</th>
	<th>Regestration Number</th>
	<th>Full Name</th>
	<th>Roll no</th>
	<th>Class</th>
	<th>Section</th>
	<th>Group</th>
	<th>Phone</th>
	<th>CNIC</th>
	<th>Gurdian</th>
	<th width="70px;" style="text-align:center;">Status</th>
	<th width="100px;" style="text-align:center;">Options</th>
</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$campus_id = '';

if($_SESSION['userlogininfo']['LOGINTYPE'] != 1){
	$campus_id .= "AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'";
}
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_firstname, s.std_lastname, s.std_gender, 
								   s.id_guardian, s.std_nic, s.std_phone, s.id_class, s.id_section, s.id_group, s.id_session,
								   s.std_rollno, s.std_regno, s.std_photo,
								   g.guardian_id, g.guardian_status, g.guardian_name,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name, 
								   gr.group_id, gr.group_status, gr.group_name 
								   FROM ".STUDENTS." s
								   INNER JOIN ".GUARDIANS."		  g  ON g.guardian_id 	= s.id_guardian
								   INNER JOIN ".CLASSES."         c  ON c.class_id 	   	= s.id_class
								   INNER JOIN ".CLASS_SECTIONS."  se ON se.section_id   = s.id_section
								   INNER JOIN ".GROUPS."  		  gr ON gr.group_id   	= s.id_group
								   WHERE s.std_id != '' $campus_id
								   ORDER BY s.std_regno ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>';
    	if($rowsvalues['std_photo']) { 
    		echo'
    			<img src="uploads/images/students/'.$rowsvalues['std_photo'].'" style="width:40px; height:40px;">' ;
    		} else {
				 echo "No Image";
			}
    echo'
    </td>
	<td>'.$rowsvalues['std_regno'].'</td>
	<td>'.$rowsvalues['std_firstname'].' '.$rowsvalues['std_lastname'].'</td>
	<td>'.$rowsvalues['std_rollno'].'</td>
	<td>'.$rowsvalues['class_name'].'</td>
	<td>'.$rowsvalues['section_name'].'</td>
	<td>'.$rowsvalues['group_name'].'</td>
	<td>'.$rowsvalues['std_phone'].'</td>
	<td>'.$rowsvalues['std_nic'].'</td>
	<td>'.$rowsvalues['guardian_name'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['std_status']).'</td>
	<td style="text-align:center;">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'updated' => '1'))){
	echo'
		<a class="btn btn-success btn-xs" href="students.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-user-circle-o"></i></a>';
	}
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'deleted' => '1'))){
	echo'
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'students.php?deleteid='.$rowsvalues['std_id'].'\');"><i class="el el-trash"></i></a>';
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