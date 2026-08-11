<?php
//-----------------------------------------------
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
//-----------------------------------------------
include_once("include/header.php");
//-----------------------------------------------
echo '<title>Dashboard | '.TITLE_HEADER.'</title>';

//------------------ NOTIFICATION MODAL ------------------
/*
$sqllms = $dblms->querylms("
    SELECT not_title, not_description
    FROM ".NOTIFICATIONS."
    WHERE not_status = '1'
    AND is_deleted != '1'
    AND to_parent = '1'
    AND (id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' OR id_campus = '0')
    ORDER BY not_id DESC
    LIMIT 1
");
$notify = mysqli_fetch_array($sqllms);

if (!empty($notify['not_title']) || !empty($notify['not_description'])) {
echo '
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-bell"></i> '.$notify['not_title'].'</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">'.$notify['not_description'].'</div>
        </div>
    </div>
</div>';
}
*/
//-------------------------------------------------------
echo '
<style>
	.card{
		padding: 20px;
		font-size: 30px;
		border-radius:10px;
		margin-left: 4%;
		margin-right: 4%;
		}
	.val{
		font-size: 20px;
		text-vertical-align: center;
		margin-left: 18%;
	}
	.span{
		font-size:14px;
	}
</style>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Childrens Dashboard</h2>
	</header>
	';

	//------------------ FETCH ALL STUDENT IDS ------------------
	$studentIDs = [];
	$sqllmstudent = $dblms->querylms("
		SELECT std_id
		FROM ".STUDENTS."
		WHERE id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
		AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
	");

	while ($s = mysqli_fetch_array($sqllmstudent)) {
		$studentIDs[] = $s['std_id'];
	}

	if (empty($studentIDs)) {
		echo '<h3>No Students Found</h3></section>';
		include_once("include/footer.php");
		exit;
	}

	$ids = implode(',', $studentIDs);

	//------------------ ALL CHALLANS TABLE ------------------
	echo '
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i> Students Challans</h2>
		</header>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Challan #</th>
							<th>Session</th>
							<th>Class</th>
							<th>Month</th>
							<th>Issue</th>
							<th>Due</th>
							<th>Paid</th>
							<th>Amount</th>
							<th>Status</th>
							<th width="130" class="center">Options</th>
						</tr>
					</thead>
					<tbody>
					';

						$qChallan = $dblms->querylms("
												SELECT 
													f.*, 
													st.std_name, 
													c.class_name, 
													cs.section_name, 
													s.session_name
												FROM ".FEES." f
												INNER JOIN (
													SELECT id_std, MAX(id) AS latest_id
													FROM ".FEES."
													WHERE id_std IN ($ids)
													AND status = '2'
													AND is_deleted = '0'
													GROUP BY id_std
												) latest ON latest.latest_id = f.id
												INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
												INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
												LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section
												INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
												ORDER BY st.std_name ASC
											");


						if (!$qChallan || mysqli_num_rows($qChallan) == 0) {
							echo '
							<tr>
								<td colspan="13" style="text-align:center;">No data available in table</td>
							</tr>
							';
						}
						else {
						$sr = 0;
							while ($row = mysqli_fetch_array($qChallan)) {
								$sr++;


								if ($row['status'] == 1) {
									$amount = $row['paid_amount'];
								} elseif (date('Y-m-d') > $row['due_date']) {
									$amount = $row['total_amount'] + 300;
								} else {
									$amount = $row['total_amount'];
								}

								echo '
								<tr>
									<td>'.$sr.'</td>
									<td>'.$row['std_name'].'</td>
									<td>'.$row['challan_no'].'</td>
									<td>'.$row['session_name'].'</td>
									<td>'.$row['class_name'].' '.($row['section_name'] ? '(' .$row['section_name'].')' : '').'</td>
									<td>'.get_monthtypes($row['id_month']).'</td>
									<td>'.$row['issue_date'].'</td>
									<td>'.$row['due_date'].'</td>
									<td>'.($row['paid_date'] != '0000-00-00' ? $row['paid_date'] : '').'</td>
									<td>'.number_format($amount).'</td>
									<td>'.get_payments($row['status']).'</td>
									<td class="center">
										<a class="btn btn-success btn-xs" target="_blank" href="feechallanprint.php?id='.$row['challan_no'].'">
											<i class="fa fa-file"></i>
										</a>
										<a class="btn btn-primary btn-xs mr-xs" target="_blank" href="raast_qr.php?challanNo='.get_dataHashingOnlyExp($row['challan_no'], true).'">
											<i class="fa fa-qrcode"></i> PAY NOW
										</a>
									</td>
								</tr>';
							}
						}
						echo '
					</tbody>
				</table>
			</div>
		</div>
	</section>
</section>';

//-----------------------------------------------
include_once("include/footer.php");
//-----------------------------------------------
?>

<script>
$(window).on('load',function(){
    $('#myModal').modal('show');
});
</script>
