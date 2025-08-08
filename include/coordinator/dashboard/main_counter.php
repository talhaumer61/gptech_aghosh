<?php
if($allottedClasses != 0) {
	$sqllmsstudents	= $dblms->querylms("SELECT COUNT(std_id) as total
										FROM ".STUDENTS."
										WHERE std_status	= '1'
										AND is_deleted		= '0'
										AND id_campus		= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
										AND id_class IN (".$allottedClasses.")
										$query_gender
									");
	$value_std = mysqli_fetch_array($sqllmsstudents);
	echo '
	<div class="col-md-6 col-lg-12 col-xl-6">
		<div class="row">
			<div class="col-md-12">
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
									<h4 class="title">Students '.(!empty($coordinator_for) ? '('.$coordinator_for.')' : '(Male & Female)').'</h4>
									<div class="info"><strong class="amount">'.$value_std['total'].'</strong></div>
								</div>
								<div class="summary-footer">
									<span class="text-muted text-uppercase">total students against allotted classes</span>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>';
}
