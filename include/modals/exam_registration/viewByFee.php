<?php 
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../functions/login_func.php";
include "../../functions/functions.php";
checkCpanelLMSALogin();

if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){ 
	if (!empty($_GET['demand_id'])):
		$demand_id		 	= cleanvars($_GET['demand_id']);
		$sqllmsViewDemand	= $dblms->querylms("
												SELECT  
													  d.is_publish
													, s.std_name
													, s.std_photo
													, edd.id_subjects
													, ef.fee_per_std
												FROM 
													".EXAM_REGISTRATION." d
													INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON edd.id_reg = d.reg_id
													INNER JOIN ".STUDENTS." s ON s.std_id = edd.id_std
													LEFT JOIN ".EXAM_FEE." ef ON D.id_campus = ef.id_campus
												WHERE d.is_deleted = '0' 
												AND d.reg_id 			= 	'".$demand_id."'
											");
				echo '
				<script src="assets/javascripts/user_config/forms_validation.js"></script>
				<script src="assets/javascripts/theme.init.js"></script>
				<div class="row">
					<div class="col-md-12">
						<section class="panel panel-featured panel-featured-primary">
							<form action="roles.php" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
								<header class="panel-heading">
									<h2 class="panel-title"><i class="fa fa-eye"></i>  Exam Registration View</h2>
								</header>
								<div class="panel-body">
									<table class="table table-bordered text-justify table-striped table-condensed mb-5 readonly">
										<thead>
											<tr>
												<th>
													Sr
												</th>
												<th>
													Picture
												</th>
												<th>
													Name
												</th>
												<th class="center">
													Subjects
												</th>
												<th class="center">
													Fee
												</th>
											</tr>
										</thead>
										<tbody>';
										$sr = 0;
										$total = 0;
										while ($valViewDemand	= mysqli_fetch_array($sqllmsViewDemand)):
											$total += (!empty($valViewDemand['fee_per_std'])? $valViewDemand['fee_per_std']: DEFAULT_EXAM_FEE);
											$is_publish_check	= $valViewDemand['is_publish'];
											$sr++;
											echo '
											<tr>
												<td class="center">
													'.$sr.'
												</td>
												<td class="center">
													<img src="uploads/images/students/'.$valViewDemand['std_photo'].'" style="border-radius: 50px; width:50px; height:50px;">
												</td>
												<td>
													'.$valViewDemand['std_name'].'
												</td>
												<td class="center">';
												foreach(explode(',', $valViewDemand['id_subjects']) as $key => $val):
													$sqllmsClass	= $dblms->querylms("
																							SELECT 
																								SS.subject_name
																							FROM 
																								".CLASS_SUBJECTS." SS
																							WHERE 
																									SS.subject_status			=	'1'
																								AND 
																									SS.is_deleted				=	'0'
																								AND 
																									SS.subject_id 				=	'".$val."'
																						");
												$valClass = mysqli_fetch_array($sqllmsClass);
													echo '[ '.$valClass['subject_name'].' ]';
												endforeach;
											echo '</td>
												<td class="center">
													<b>'.(!empty($valViewDemand['fee_per_std'])? $valViewDemand['fee_per_std']: DEFAULT_EXAM_FEE).'</b>
												</td>
											</tr>';
										endwhile;
											echo '
											<tr>
												<td colspan="4" class="center">
													<b>Grand Total<b>
												</td>
												<td class="center">
													<b>'.$total.'<b>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">';
										$valViewDemand	= mysqli_fetch_array($sqllmsViewDemand);
									echo ''.((($_SESSION['userlogininfo']['LOGINTYPE']  == 1) && ($is_publish_check != 1 ))?'
											<a href="exam_registration_campus.php?deleteid='.$demand_id.'" class="mr-xs btn btn-danger" ><i class="el el-trash"></i> Delete</a>
											<a href="?edit_id='.$demand_id.'" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
										': '').'
											<button class="btn btn-default modal-dismiss">Cancel</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
				</div>';
	endif;
	if (isset($_GET['id_type'])):
		$sqllms	= $dblms->querylms("
										SELECT d.id_class , c.class_name , ef.fee_per_std
										FROM ".EXAM_REGISTRATION." d
										INNER JOIN ".CLASSES." c ON c.class_id = d.id_class
										LEFT JOIN ".EXAM_FEE." ef ON d.id_campus = ef.id_campus
										WHERE d.is_publish 		= '1'
										AND d.is_deleted 		= '0'
										AND d.id_type			= '".cleanvars($_GET['id_type'])."'
										AND FIND_IN_SET (d.id_class, '".cleanvars($_GET['id_class'])."')
										AND d.id_session		= '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										ORDER BY reg_id DESC
									");
			echo '
			<script src="assets/javascripts/user_config/forms_validation.js"></script>
			<script src="assets/javascripts/theme.init.js"></script>
			<div class="row">
				<div class="col-md-12">
					<section class="panel panel-featured panel-featured-primary">
						<form action="roles.php" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<header class="panel-heading">
								<h2 class="panel-title"><i class="fa fa-eye"></i>  Exam Registration View</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered text-justify table-striped table-condensed mb-5 readonly">
									<thead>
										<tr>
											<th width="5px">
												Sr
											</th>
											<th>
												Class
											</th>
											<th class="center">
												Amount Per Student
											</th>
											<th class="center">
												No of Students	
											</th>
											<th class="center">
												Total Amount
											</th>
										</tr>
									</thead>
									<tbody>';
									$sr = 0;
									$total = 0;
									while ($row	= mysqli_fetch_array($sqllms)):
										$sqllmsCountStd	= $dblms->querylms("SELECT edd.id_std
																			FROM ".EXAM_REGISTRATION." ed
																			INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON ED.reg_id = edd.id_reg
																			WHERE ed.id_session 	= ".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."
																			AND ed.id_type 			= ".cleanvars($_GET['id_type'])."
																			AND ed.id_class 		= ".cleanvars($row['id_class'])."
																			AND ed.is_deleted 		= '0'");
										$sr++;
										echo '
										<tr>
											<td>
												'.$sr.'
											</td>
											<td>
												'.$row['class_name'].'
											</td>
											<td class="center">
												'.(!empty($row['fee_per_std'])? $row['fee_per_std']: DEFAULT_EXAM_FEE).'
											</td>
											<td class="center">
												'.mysqli_num_rows($sqllmsCountStd).'
											</td>
											<td class="center">
												<b>'.(mysqli_num_rows($sqllmsCountStd)*(!empty($row['fee_per_std'])? $row['fee_per_std']: DEFAULT_EXAM_FEE)).'</b>
											</td>
										</tr>';
										$total += (mysqli_num_rows($sqllmsCountStd)*(!empty($row['fee_per_std'])? $row['fee_per_std']: DEFAULT_EXAM_FEE));
									endwhile;
										echo '
										<tr>
											<td colspan="4" class="center">
												<b>Grand Total<b>
											</td>
											<td class="center">
												<b>'.$total.'<b>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-default modal-dismiss">Cancel</button>
									</div>
								</div>
							</footer>
						</form>
					</section>
				</div>
			</div>';
	endif;
}
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".selectTwo2").select2({
			  dropdownParent: $("#show_modal")
			, minimumResultsForSearch: 0
			, width: "100%"
		});
	});
</script>