<?php 
//-----------------------------------------------------
$sqllmsstudents	= $dblms->querylms("SELECT COUNT(std_id) as total
									FROM ".STUDENTS."
									WHERE std_id != '' AND std_status = '1' AND is_deleted != '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
$value_std = mysqli_fetch_array($sqllmsstudents);
//-----------------------------------------------------
$sqllmsemployee	= $dblms->querylms("SELECT COUNT(emply_id) as total
									FROM ".EMPLOYEES."
									WHERE emply_id != '' AND emply_status = '1' AND is_deleted != '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
$value_emp = mysqli_fetch_array($sqllmsemployee);
//-----------------------------------------------------
echo '
<div class="col-md-6 col-lg-12 col-xl-6">
	<div class="row">

		<div class="col-md-12 col-lg-6 col-xl-6">
			<section class="panel panel-featured-left panel-featured-secondary">
				<div class="panel-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-secondary">
								<i class="fa fa-users"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Student</h4>
								<div class="info"><strong class="amount">'.$value_std['total'].'</strong></div>
							</div>
							<div class="summary-footer">
								<span class="text-muted text-uppercase">total students</span>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	
		<div class="col-md-12 col-lg-6 col-xl-6">
			<section class="panel panel-featured-left panel-featured-primary">
				<div class="panel-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-primary">
								<i class="glyphicon glyphicon-user"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Employees</h4>
								<div class="info"><strong class="amount">'.$value_emp['total'].'</strong></div>
							</div>
							<div class="summary-footer">
								<span class="text-muted text-uppercase">total employees</span>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<!--
		<div class="col-md-12 col-lg-6 col-xl-6">
			<section class="panel panel-featured-left panel-featured-tertiary">
				<div class="panel-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-tertiary">
								<i class="fa fa-snowflake-o"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Leave Application</h4>
								<div class="info"><strong class="amount">1</strong></div>
							</div>
							<div class="summary-footer">
								<span class="text-muted text-uppercase">total pending</span>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		
		<div class="col-md-12 col-lg-6 col-xl-6">
			<section class="panel panel-featured-left panel-featured-quaternary">
				<div class="panel-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-quaternary">
								<i class="fa fa-credit-card"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Invoice</h4>
								<div class="info"><strong class="amount">0</strong></div>
							</div>
							<div class="summary-footer">
								<span class="text-muted text-uppercase">today payments</span>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		-->
				
	</div>
</div>';
