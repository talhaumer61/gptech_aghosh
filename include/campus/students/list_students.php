<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'add' => '1'))){
		// echo'<a href="students.php?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Student</a>';
	}
		
		//------------- Vars --------------
		$selectAll = "";
		$sql1 = "";
		$sql2 = "";
		$sql3 = "";	
		$sql4 = "";
		$sql5 = "";
		$sql6 = "";
		$sql7 = "";
		$class = "";
		$std_status = "";
		$std_gender = "";
		$orphan = "";
		$is_hostelized = "";
		$search_word = "";
		$classComma = "";
		$filters = "";
		
		//--------- FIlters ----------
		if(isset($_GET['show_students'])){
			//  class
			if($_GET['id_class']){
				$arrayClass = array();
				foreach ($_GET['id_class'] as $class){
					array_push($arrayClass, $class);
				}
				if(in_array('all', $arrayClass)){
					$selectAll = 'selected';
					$sql1 = "";
					$classComma = '';
				}else{
					$sql1 = "AND s.id_class IN (".implode(", ",$arrayClass).")";
					$classComma 	= 	implode(", ",$arrayClass);
				}
				$class		 	=	$arrayClass;
			}
			//	class on pagination
			if(isset($_GET['id_class2']) && !empty($_GET['id_class2'])){
				$sql2 = "AND s.id_class IN (".$_GET['id_class2'].")";
				$classComma = $_GET['id_class2'];
				$class = explode(", ",$_GET['id_class2']);
			}
			// status
			if($_GET['status']){
				$sql3 = "AND s.std_status = '".$_GET['status']."'";
				$std_status = $_GET['status'];
			}
			// oprhan
			if($_GET['is_orphan']){
				if($_GET['is_orphan']==1){
					$sql4 = "AND s.is_orphan = '1'";
					$orphan = $_GET['is_orphan'];
				}else{
					$sql4 = "AND s.is_orphan != '1'";
					$orphan = $_GET['is_orphan'];
				}
			}
			// search Words
			if($_GET['search_word']){
				$sql5 = "AND (s.std_fathercnic LIKE '".$_GET['search_word']."' OR  s.std_fathername LIKE '%".$_GET['search_word']."%' OR  s.std_nic LIKE '".$_GET['search_word']."' OR s.std_name LIKE '%".$_GET['search_word']."%' OR s.std_rollno LIKE '%".$_GET['search_word']."%' OR s.std_regno LIKE '%".$_GET['search_word']."%')";
				$search_word = $_GET['search_word'];
			}
			//  Gender
			if($_GET['std_gender']){
				$sql6 = "AND s.std_gender = '".$_GET['std_gender']."'";
				$std_gender = $_GET['std_gender'];
			}
			//	is_hostelized
			if($_GET['is_hostelized']){
				if($_GET['is_hostelized']==1){
					$sql7 = "AND s.is_hostelized = '1'";
					$is_hostelized = $_GET['is_hostelized'];
				}else{
					$sql7 = "AND s.is_hostelized != '1'";
					$is_hostelized = $_GET['is_hostelized'];
				}
			}
		}
		$filters = 'id_class2='.$classComma.'&status='.$std_status.'&std_gender='.$std_gender.'&is_orphan='.$orphan.'&is_hostelized='.$is_hostelized.'&search_word='.$search_word.'&show_students';
		
		//------------ Print Students ------------------------
		echo' <a href="studentsPrint.php?id_class='.$classComma.'&status='.$std_status.'&std_gender='.$std_gender.'&is_orphan='.$orphan.'&is_hostelized='.$is_hostelized.'" target="_blank" class="btn btn-primary btn-xs pull-right mr-sm"><i class="glyphicon glyphicon-print"></i> Print Students List</a>  
		<a href="#student_data" class="modal-with-move-anim btn btn-success btn-xs pull-right" style="margin-right:5px;"> <i class="fa fa-group"></i> Student Data</a>';
		//-----------------------------------------------------
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i>  Students List</h2>
	</header>
	<div class="panel-body">
		<form action="#" method="GET" autocomplete="off">
			<div class="form-group mb-lg">
				<div class="col-sm-4">
					<label class="control-label">Search </label>
					<div class="form-group">
						<input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search" aria-controls="table_export">
					</div>
				</div>
				<div class="col-md-4">
					<label class="control-label">Class </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_class[]" multiple>
						<option value="all" '.$selectAll.'>All</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
															FROM ".CLASSES." 
															WHERE class_status = '1'
															AND is_deleted != '1'
															ORDER BY class_id ASC"
														  );
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['class_id'].'"'; if(in_array($valuecls['class_id'], $class)){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
							}
							echo '
					</select>
				</div>
				<div class="col-md-4">
					<label class="control-label">Gender </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
						<option value="">Select</option>';
						foreach($gender as $gndr){
							echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo'selected';} echo'>'.$gndr.'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-4">
					<label class="control-label">Status </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="status">
						<option value="">Select</option>';
						foreach($stdstatus as $stat){
							echo '<option value="'.$stat['id'].'"'; if($std_status == $stat['id']){ echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-4">
					<label class="control-label">Is Orphan </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_orphan">
						<option value="">Select</option>';
						foreach($statusyesno as $orph){
							echo '<option value="'.$orph['id'].'"'; if($orphan == $orph['id']){ echo'selected';} echo'>'.$orph['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-4">
					<label class="control-label">Boarder / Day Scholar</label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_hostelized">
						<option value="">Select</option>';
						foreach($studenttype as $hostel)
						{
							echo' <option value="'.$hostel['id'].'"'; if($is_hostelized == $hostel['id']){ echo'selected';} echo'>'.$hostel['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-offset-5 col-md-2">
					<div class="form-group mt-xl">
						<button type="submit" name="show_students" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search Results</button>
					</div>
				</div>
			</div>
		</form>';
		//------------- Pagination ---------------------
		$sql = "SELECT s.std_id, s.std_status, s.std_name, s.std_fathername, s.std_gender, s.is_orphan, s.is_orphan_approved, s.std_nic, s.std_whatsapp, s.id_class, s.id_session, s.std_rollno, s.std_regno, s.std_photo, s.is_hostelized, c.class_name
				FROM ".STUDENTS." 		s
				INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
				WHERE s.std_id != '' AND s.is_deleted != '1' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7
				AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
				ORDER BY s.std_name";

		$sqllms	= $dblms->querylms($sql);
		//--------------------------------------------------
		$count = mysqli_num_rows($sqllms);
		if($page == 0) { $page = 1; }			//if no page var is given, default to 1.
		$prev		= $page - 1;				//previous page is page - 1
		$next		= $page + 1;				//next page is page + 1
		$lastpage	= ceil($count/$Limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1		= $lastpage - 1;

		$sqllms	= $dblms->querylms("$sql LIMIT ".($page-1)*$Limit .",$Limit");
		
		if(mysqli_num_rows($sqllms) > 0){
		echo'
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-condensed" style="margin-top: 10px;">
					<thead>
						<tr>
							<th class="center">#</th>
							<th width= 40>Photo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Roll no</th>
							<th>Class</th>
							<th>Whatsapp</th>
							<th>CNIC</th>
							<th width="70px;" class="center">Status</th>
							<th width="180px;" class="center">Options</th>
						</tr>
					</thead>
					<tbody>';
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
							
						if($rowsvalues['std_photo']) { 
							$photo = "uploads/images/students/".$rowsvalues['std_photo']."";
						}
						else{
							$photo = "uploads/default-student.jpg";
						}
						echo '
						<tr>
							<td class="center">'.$srno.'</td>
							<td><img src="'.$photo.'" style="width:40px; height:40px;"></td>
							<td>'.$rowsvalues['std_name'].'</td>
							<td>'.$rowsvalues['std_fathername'].'</td>
							<td>'.$rowsvalues['std_rollno'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td>'.(strpos($rowsvalues['std_whatsapp'], '-') === false ? substr($rowsvalues['std_whatsapp'], 0, 4) . '-' . substr($rowsvalues['std_whatsapp'], 4) : $rowsvalues['std_whatsapp']).'</td>
							<td>'.$rowsvalues['std_nic'].'</td>';
							echo'
							<td class="center">'.get_stdstatus($rowsvalues['std_status']).'</td>
							<td class="center"><a class="btn btn-info btn-xs mr-xs" target="_blank" href="admissionformprint.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-file"></i></a>';
								if($_SESSION['userlogininfo']['LOGINIDA']  == 4 && $rowsvalues['is_orphan'] == 1 && $rowsvalues['is_orphan_approved'] != 1){
									echo'<a href="#" class="btn btn-warning btn-xs mr-xs" onclick="oprhan_modal(\'students.php?oprhanid='.$rowsvalues['std_id'].'\');">Approve</a>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'edit' => '1'))){
									echo'<a class="btn btn-success btn-xs mr-xs" href="students.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-user-circle-o"></i></a>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'delete' => '1'))){
									echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'students.php?deleteid='.$rowsvalues['std_id'].'\');"><i class="el el-trash"></i></a>';
								}
								echo'
							</td>
						</tr>';
					}
						echo '
					</tbody>
				</table>
			</div>';
			//-------------- Pagination ------------------
			include_once('include/pagination.php');
		}
		else{
			echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
		}
		echo'
	</div>
</section>';
}
else{
	header("Location: dashboard.php");
}
?>