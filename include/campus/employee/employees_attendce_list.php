<?php
echo'
<div id="edit_attendce" class="accordion-body collapse" style="height: 0px;">
	<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
		<header class="panel-heading">
			<h2 class="panel-title">
				<i class="fa fa-users"></i> 
				Employees List				
			</h2>
		</header>
			<div class="panel-body">
				<div class="text-right mb-md">
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_present()"><i class="fa fa-check"></i><span class="hidden-xs"> Set All Present</span></button>
						
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_absent()"><i class="fa fa-close"></i><span class="hidden-xs"> Set All Absent</span></button>
						
						<button type="button" class="btn btn-default btn-sm" onclick="mark_all_holiday()"><i class="fa fa-power-off"></i><span class="hidden-xs"> Set All Holiday</span></button>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered ">
						<thead>
							<tr>
								<th width="40">#</th>
								<th width="80">Photo</th>
								<th>Name </th>
								<th>User Type </th>
								<th>Email </th>
								<th width="40%">Status </th>
							</tr>
						</thead>
						<tbody>
						';
//-------------select latest ID from session----------------------------------------------
$ssqllms	= $dblms->querylms("SELECT 
									s.session_id
										FROM ".SESSIONS." s
										WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
										ORDER BY s.session_id DESC LIMIT 1 ");

$rrowsvalues = mysqli_fetch_array($ssqllms);
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT 
								e.emply_id, e.emply_name, e.emply_photo, e.emply_email, e.emply_id, e.id_dept
								   FROM ".EMPLOYEES." e  
								   WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY e.emply_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {}
//-----------------------------------------------------
$srno++;
			echo'			
							<tr>
								<td>'.$srno.'</td>
								<td class="center"> <img src="'.$rowsvalues['emply_photo'].'" width="35" height="35" /> </td>
								<input type="input" name="emply_ID[$srno]"id="emply_ID" value="'.$rowsvalues['emply_id'].'">
                                <input type="input" name="deprt_ID[$srno]"id="deprt_ID" value="'.$rowsvalues['id_dept'].'">
                                <input type="input" name="session"id="session" value="'.$rrowsvalues['session_id'].'">
                                
                                <td>"'.$rowsvalues['emply_name'].'"</td>
								<td>"'.$rowsvalues['emply_regno'].'"</td>
								<td>"'.$rowsvalues['emply_email'].'"</td>
								<td>
									<div class="radio-custom radio-success radio-inline">
										<input type="radio" value="1" name="arr[$srno]" id="pstatus_$srno">
										<label for="pstatus_$srno">Present</label>
									</div>

									<div class="radio-custom radio-danger radio-inline">
										<input type="radio" value="2"  name="arr[$srno]" id="astatus_<?php echo $srno; ?>">
										<label for="astatus_<?php echo $srno; ?>">Absent</label>
									</div>

									<div class="radio-custom radio-info radio-inline">
										<input type="radio" value="3"  name="arr[<?php echo $srno; ?>]" id="hstatus_<?php echo $srno; ?>">
										<label for="hstatus_<?php echo $srno; ?>">Holiday</label>
									</div>

									<div class="radio-custom radio-inline">
										<input type="radio" value="4"  name="arr[<?php echo $srno; ?>]" id="lstatus_<?php echo $srno; ?>">
										<label for="lstatus_<?php echo $srno; ?>">Late</label>
									</div>
								</td>
							</tr>
						</tbody>
						
					</table>
				</div>
			</div>
	</section>
</div>
';
?>
