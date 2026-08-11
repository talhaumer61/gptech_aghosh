<?php
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">';
		if(!empty($coordinator_for)){			
			$query_gender_stdlist = 'AND s.std_gender = "'.$coordinator_for.'" ';
		}else{
			$query_gender_stdlist = '';
		}
		
		//------------- Vars --------------
		$sql2 = "";
		$sql3 = "";
		$sql4 = "";
		$sql5 = "";
		$class = "";
		$std_status = "";
		$orphan = "";
		$search_word = "";
		$filters = "";
		//-----------------------------------------------------
		if(isset($_GET['show_students']))
		{
			//--------- FIlters ----------
			//  class
			if($_GET['id_class'])
			{
				$sql2 = "AND s.id_class = '".$_GET['id_class']."'";
				$class = $_GET['id_class'];
				// $class_id = $_GET['id_class'];
			}
			// status
			if($_GET['status'])
			{
				$sql3 = "AND s.std_status = '".$_GET['status']."'";
				$std_status = $_GET['status'];
			}
			// oprhan
			if($_GET['is_orphan'])
			{
				$sql4 = "AND s.is_orphan = '".$_GET['is_orphan']."'";
				$orphan = $_GET['is_orphan'];
			}
			// search Words
			if($_GET['search_word'])
			{
				$sql5 = "AND (s.std_name LIKE '%".$_GET['search_word']."%' OR s.std_rollno LIKE '%".$_GET['search_word']."%' OR s.std_regno LIKE '%".$_GET['search_word']."%')";
				$search_word = $_GET['search_word'];
			}
		}
		//------------ Print Students ------------------------
		echo'<a href="studentsPrint.php?id_class='.$class.'&status='.$std_status.'&is_orphan='.$orphan.'" target="_blank" class="btn btn-primary btn-xs pull-right mr-sm"><i class="glyphicon glyphicon-print"></i> Print Students List</a>';
		//-----------------------------------------------------
		echo'
		<h2 class="panel-title"><i class="fa fa-list"></i>  Students List</h2>
	</header>
	<div class="panel-body">
		<form action="#" method="GET" autocomplete="off">
			<div class="form-group mb-lg">
				<div class="col-sm-3">
					<label class="control-label">Search </label>
					<div class="form-group">
						<input type="search" name="search_word" id="search_word" class="form-control" value="'.$search_word.'" placeholder="Search" aria-controls="table_export">
					</div>
				</div>
				<div class="col-md-3">
					<label class="control-label">Class </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_class">
						<option value="">Select</option>
						<option value="" selected>All</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
												FROM ".CLASSES." 
												WHERE class_status = '1' AND class_id IN (".$allottedClasses.") AND is_deleted != '1'
												ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['class_id'].'"'; if($class == $valuecls['class_id']){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
							}
							echo '
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Status </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="status">
						<option value="">Select</option>';
						foreach($stdstatus as $stat){
							echo '<option value="'.$stat['id'].'"'; if($std_status == $stat['id']){ echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Is Orphan </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_orphan">
						<option value="">Select</option>';
						foreach($statusyesno as $orph){
							echo '<option value="'.$orph['id'].'"'; if($orphan == $orph['id']){ echo'selected';} echo'>'.$orph['name'].'</option>';
						}
						echo'
					</select>
				</div>
			</div>
			<div class="form-group text-center">
				<button type="submit" name="show_students" class="btn btn-primary" style="width: 90px;"><i class="fa fa-search"></i> Search</button>
			</div>
		</form>';
		//------------- Pagination ---------------------
		$sqlstring	    = "";
		$adjacents = 3;
		if(!($Limit)) 	{ $Limit = 50; } 
		if($page)		{ $start = ($page - 1) * $Limit; } else {	$start = 0;	}
		//------------------------------------------------
		$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_name, s.std_fathername, s.std_gender,
											s.is_orphan, s.is_orphan_approved, s.std_nic, s.std_phone, s.id_class, s.id_session,
											s.std_rollno, s.std_regno, s.std_photo, c.class_name
											FROM ".STUDENTS." 		s
											INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
											WHERE s.std_id != '' AND s.is_deleted != '1'
											AND c.class_id IN (".$allottedClasses.")   $sql2 $sql3 $sql4 $sql5 $query_gender_stdlist
											AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
											ORDER BY s.std_name");
		//--------------------------------------------------
		$count = mysqli_num_rows($sqllms);
		if($page == 0) { $page = 1; }						//if no page var is given, default to 1.
		$prev 		    = $page - 1;							//previous page is page - 1
		$next 		    = $page + 1;							//next page is page + 1
		$lastpage  		= ceil($count/$Limit);					//lastpage is = total pages / items per page, rounded up.
		$lpm1 		    = $lastpage - 1;

		//--------------------------------------------------
		$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_name, s.std_fathername, s.std_gender,
										s.is_orphan, s.is_orphan_approved, s.std_nic, s.std_phone, s.id_class, s.id_session,
										s.std_rollno, s.std_regno, s.std_photo, c.class_name
										FROM ".STUDENTS." 		s
										INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
										WHERE s.std_id != '' AND s.is_deleted != '1'
										AND c.class_id IN (".$allottedClasses.") $sql2 $sql3 $sql4 $sql5 $query_gender_stdlist
										AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										ORDER BY s.std_name LIMIT ".($page-1)*$Limit .",$Limit");
		//--------------------------------------------------
		if(mysqli_num_rows($sqllms) > 0){
		echo'
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-condensed" style="margin-top: 10px;">
					<thead>
						<tr>
							<th class="center">Sr.</th>
							<th width= 40>Photo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Roll no</th>
							<th>Class</th>
							<th>Phone</th>
							<th>CNIC</th>
							<th width="70" class="center">Status</th>
							<th width="100" class="center">Options</th>
						</tr>
					</thead>
					<tbody>';
						//-----------------------------------------------------

						$srno = ($page == 1 ? '0' : ($page - 1) * $Limit);
						//-----------------------------------------------------
						while($rowsvalues = mysqli_fetch_array($sqllms)) {
						//-----------------------------------------------------
						$srno++;
						//-----------------------------------------------------
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
							<td>'.$rowsvalues['std_phone'].'</td>
							<td>'.$rowsvalues['std_nic'].'</td>';
							echo'
							<td class="center">'.get_stdstatus($rowsvalues['std_status']).'</td>
							<td class="center">
								<a class="btn btn-info btn-xs mr-xs" target="_blank" href="admissionformprint.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-file"></i></a>
								<a class="btn btn-success btn-xs mr-xs" href="students.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-user-circle-o"></i></a>
							</td>
						</tr>';
						}
						echo '
					</tbody>
				</table>
			</div>';
			//-------------- Pagination ------------------
			if($count>$Limit) {
				echo '
				<div class="widget-foot">
				<!--WI_PAGINATION-->
				<ul class="pagination pull-right">';
				//--------------------------------------------------
				$current_page = strstr(basename($_SERVER['REQUEST_URI']), '.php', true);
				$filters = 'id_class='.$class.'&status='.$std_status.'&is_orphan='.$orphan.'&search_word='.$search_word.'&show_students';
				//--------------------------------------------------
				$pagination = "";
				if($lastpage > 1) { 
				//previous button
				if ($page > 1) {
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$prev.$sqlstring.'"><span class="fa fa-chevron-left"></span></a></a></li>';
				}
				//pages 
				if ($lastpage < 7 + ($adjacents * 3)) { //not enough pages to bother breaking it up
					for ($counter = 1; $counter <= $lastpage; $counter++) {
						if ($counter == $page) {
							$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
						} else {
							$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
						}
					}
				} else if($lastpage > 5 + ($adjacents * 3)) { //enough pages to hide some
				//close to beginning; only hide later pages
					if($page < 1 + ($adjacents * 3)) {
						for ($counter = 1; $counter < 4 + ($adjacents * 3); $counter++) {
							if ($counter == $page) {
								$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
							} else {
								$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
							}
						}
						$pagination.= '<li><a href="#"> ... </a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
				} else if($lastpage - ($adjacents * 3) > $page && $page > ($adjacents * 3)) { //in middle; hide some front and some back
						$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=1'.$sqlstring.'">1</a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=2'.$sqlstring.'">2</a></li>';
						$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=3'.$sqlstring.'">3</a></li>';
						$pagination.= '<li><a href="#"> ... </a></li>';
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page) {
							$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
						} else {
							$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
						}
					}
					$pagination.= '<li><a href="#"> ... </a></li>';
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
				} else { //close to end; only hide early pages
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=1'.$sqlstring.'">1</a></li>';
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=2'.$sqlstring.'">2</a></li>';
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=3'.$sqlstring.'">3</a></li>';
					$pagination.= '<li><a href="#"> ... </a></li>';
					for ($counter = $lastpage - (3 + ($adjacents * 3)); $counter <= $lastpage; $counter++) {
						if ($counter == $page) {
							$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
						} else {
							$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
						}
					}
				}
				}
				//next button
				if ($page < $counter - 1) {
					$pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$next.$sqlstring.'"><span class="fa fa-chevron-right"></span></a></li>';
				} else {
					$pagination.= "";
				}
					echo $pagination;
				}
				echo '
				</ul>
				<!--WI_PAGINATION-->
					<div class="clearfix"></div>
				</div>';
			}
			//------------------------------------------------
		}
		else{
			echo'<div class="panel-body"><h2 class="text text-center text-danger mt-lg">No Record Found!</h2></div>';
		}
		echo'
	</div>
</section>';
?>