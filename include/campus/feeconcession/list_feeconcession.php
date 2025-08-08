<?php 
if(!$view) {
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'view' => '1'))){ 

$month = date('n');
$sql1 = "";
$sql2 = "";
$sql3 = "";
$sql4 = "";
$sql5 = "";
$sql6 = "";
$sql7 = "";
$sql8 = "";
$search_word = "";
$paid_date = "";
$pay_through = "";
$status = "";
$class = "";
$std_gender = "";
$is_hostelized = "";
$filters = "";

//--------- FIlters ----------
if(isset($_GET['show'])){
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
            $sql1 = "AND st.id_class IN (".implode(", ",$arrayClass).")";
            $classComma 	= 	implode(", ",$arrayClass);
        }
        $class	=	$arrayClass;
    }
	//	class on pagination
	if(isset($_GET['id_class2']) && !empty($_GET['id_class2'])){
		$sql2 = "AND st.id_class IN (".$_GET['id_class2'].")";
		$classComma = $_GET['id_class2'];
		$class = explode(", ",$_GET['id_class2']);
	}
	//  word
	if(isset($_GET['search_word'])){
		$sql3 = "AND (st.admission_formno LIKE '".$_GET['search_word']."' OR st.std_regno LIKE '".$_GET['search_word']."' OR st.std_name LIKE '%".$_GET['search_word']."%' OR st.std_rollno LIKE '%".$_GET['search_word']."%')";
		$search_word = $_GET['search_word'];
	}

	// status
	if($_GET['status']){
		$sql6 = "AND s.status = '".$_GET['status']."'";
		$status = $_GET['status'];
	}
	// status
	if($_GET['std_gender']){
		$sql7 = "AND st.std_gender = '".$_GET['std_gender']."'";
		$std_gender = $_GET['std_gender'];
	}
	//	is_hostelized
	if($_GET['is_hostelized']){
		if($_GET['is_hostelized']==1){
			$sql8 = "AND st.is_hostelized = '1'";
			$is_hostelized = $_GET['is_hostelized'];
		}else{
			$sql8 = "AND st.is_hostelized != '1'";
			$is_hostelized = $_GET['is_hostelized'];
		}
	}
}
$filters = 'search_word='.$search_word.'&status='.$status.'&id_class2='.$classComma.'&std_gender='.$std_gender.'&is_hostelized='.$is_hostelized.'&show';

	echo'
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">';
			if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'add' => '1'))){ 
				echo'<a href="feeconcession.php?view=add" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Fee Concession </a>';
			}
			echo'
			<a href="feeconcession.php?view=copy" class="btn btn-primary btn-xs mr-xs pull-right"><i class="fa fa-file"></i> Copy Fee Concession </a>
			<h2 class="panel-title"><i class="fa fa-list"></i>  Fee Concession List</h2>
		</header>
		<div class="panel-body">
		<form action="#" method="GET" autocomplete="off">
			<div class="row">
				<div class="col-md-4 mb-sm">
					<div class="form-group">
						<label class="control-label" style="font-weight:600;">Search </label>
						<input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search">
					</div>
				</div>				
				<div class="col-md-4 mb-sm">
					<label class="control-label" style="font-weight:600;">Status </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="status">
						<option value="">Select</option>';
						foreach($payments as $stat){
							echo '<option value="'.$stat['id'].'"'; if($status == $stat['id']){ echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-4 mb-sm">
					<label class="control-label" style="font-weight:600;">Class </label>
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
							echo'
					</select>
				</div>
				<div class="col-md-4 mb-sm">
					<label class="control-label" style="font-weight:600;">Gender </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
						<option value="">Select</option>';
						foreach($gender as $gndr){
							echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-4 mb-sm">
					<label class="control-label"  style="font-weight:600;">Boarder / Day Scholar</label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_hostelized">
						<option value="">Select</option>';
						foreach($studenttype as $hostel)
						{
							echo' <option value="'.$hostel['id'].'"'; if($is_hostelized == $hostel['id']){ echo'selected';} echo'>'.$hostel['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-4 mb-sm" style="margin-top: 2.5rem;">
					<div class="form-group">
						<button type="submit" name="show" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
					</div>
				</div>
			</div>
		</form>';
	$sql	= ("SELECT SUM(s.amount) AS TotalConcess, s.id, s.status, s.consession_on, s.percent, s.amount, s.note,
												
												st.std_id, st.std_name, st.std_fathername, st.std_regno,
												cl.class_name, se.session_id, se.session_name, fs.id AS idsetup 
												FROM ".SCHOLARSHIP." s
												INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std
												LEFT  JOIN ".CLASSES."  cl ON cl.class_id 	= st.id_class
												INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session 
												INNER JOIN ".FEESETUP." fs ON st.id_class = fs.id_class AND fs.id_session = st.id_session
												WHERE s.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												AND s.id_session = '".($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
												AND s.id_type = '2'  
												AND fs.is_deleted   = '0' 
												AND fs.status    	= '1' 
												AND fs.id_campus    = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
												AND s.is_deleted = '0' $sql1 $sql2 $sql3 $sql4 $sql5 $sql6 $sql7 $sql8 
												GROUP BY s.id_std 
												ORDER BY s.id DESC");
		$sqllms	= $dblms->querylms($sql);
		
		$count = mysqli_num_rows($sqllms);
		if($page == 0) { $page = 1; }				//if no page var is given, default to 1.
		$Limit = 50;
		$prev 		    = $page - 1;				//previous page is page - 1
		$next 		    = $page + 1;				//next page is page + 1
		$lastpage  		= ceil($count/$Limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 		    = $lastpage - 1;

		$sqllms	= $dblms->querylms("$sql LIMIT ".($page-1)*$Limit .",$Limit");
		if(mysqli_num_rows($sqllms) > 0){
		echo '
			<div class="table-responsive">
				<table class="table table-bordered table-striped mb-none">
					<thead>
				<thead>
					<tr>
						<th width="40" class="center">Sr.</th>
						<th>Student Regno.</th>
						<th>Student</th>
						<th>Class </th>
						<th style="width:140px;">Actual Fee</th>
						<th style="width:140px;">Total Concession</th>
						<th style="width:140px;">Monthly Fee </th>
						<th width="70" class="center">Status</th>
						<th width="130" class="center">Options</th>
					</tr>
				</thead>
				<tbody>';
					
					$srno = 0;
					while($rowsvalues = mysqli_fetch_array($sqllms)) {
						$srno++;
						
						    //Check Student Hostel Registration
						$sqllmHostelRegistration	= $dblms->querylms("SELECT id 
																		FROM ".HOSTEL_REG."
																		WHERE status    = '1' 
																		AND id_std      = '".$rowsvalues['std_id']."'
																		AND id_campus   = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																		LIMIT 1");
						//If Hostelized Add Fee Cats
						if(mysqli_num_rows($sqllmHostelRegistration) == 1) {
							$hostel_cats = ""; 
						} else{
							$hostel_cats = ",6,7,8"; 
						}
						 // Total Pkg                                           
						$sqllmsTotPkg	= $dblms->querylms("SELECT	SUM(d.amount) as totalPkg
																	FROM ".FEESETUPDETAIL." d
																	WHERE id_setup = '".$rowsvalues['idsetup']."'
																	AND (duration != 'Select' OR duration = '') 
																	AND duration = 'Monthly'
																	AND id_cat NOT IN (1,4,5$hostel_cats) ");
						$valTotPkg = mysqli_fetch_array($sqllmsTotPkg);
						echo'
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$rowsvalues['std_regno'].' </td>
							<td>'.$rowsvalues['std_name'].' '.$rowsvalues['std_fathername'].'</td>
							<td>'.$rowsvalues['class_name'].'</td>
							<td class="text-right">'.number_format($valTotPkg['totalPkg']).'</td>
							<td class="text-right">'.number_format($rowsvalues['TotalConcess']).'</td>
							<td class="text-right">'.number_format($valTotPkg['totalPkg'] - $rowsvalues['TotalConcess']).'</td>
							<td class="center">'.get_status($rowsvalues['status']).'</td>
							<td class="text-center"> <a href="#show_std_modal" class="modal-with-move-anim-pvs btn btn-info btn-xs mr-xs" onclick="showAjaxModalZoomStd(\'include/modals/feeconcession/detail.php?id_std='.$rowsvalues['std_id'].'\');"><i class="fa fa-eye"></i></a>';
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) ||  Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'edit' => '1'))){ 
									echo'<a href="feeconcession.php?view=edit&idstd='.$rowsvalues['std_id'].'" class=" btn btn-primary btn-xs mr-xs""><i class="glyphicon glyphicon-edit"></i> Edit</a>';
								}
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'deleted' => '1'))){ 
									echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'feeconcession.php?deleteid='.$rowsvalues['id'].'\');"><i class="el el-trash"></i></a>';
								}
								echo' 
							</td>
						</tr>';
					}
					echo'
				</tbody>
			</table>
			</div>';
			include_once('include/pagination.php');
		}
		else{
			echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
		}
		
	echo '
			
		</div>
	</section>';
}else{
	header("Location: dashboard.php");
}
}
