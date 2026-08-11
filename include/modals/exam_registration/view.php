<?php 
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../functions/login_func.php";
include "../../functions/functions.php";
checkCpanelLMSALogin();

if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)){ 
	$demand_id		 	= cleanvars($_GET['demand_id']);
	$id_class		 	= cleanvars($_GET['id_class']);
	$id_type 			= cleanvars($_GET['id_type']);
	$sqllmsViewDemand	= $dblms->querylms("SELECT d.is_publish , s.std_name , s.std_photo , edd.id_subjects
												FROM ".EXAM_REGISTRATION." d
												INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON edd.id_reg = d.reg_id
												INNER JOIN ".STUDENTS." s ON s.std_id = edd.id_std
												WHERE d.is_deleted	= '0' 
												AND d.reg_id		= '".$demand_id."'
												AND d.id_class		= '".$id_class."'
												AND d.id_type		= '".$id_type."'
											");
	echo'
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
									<th class="center" width="5px;">
										Sr
									</th>
									<th width="10px;">
										Picture
									</th>
									<th width="50px;">
										Name
									</th>
									<th class="center">
										Subjects
									</th>
								</tr>
							</thead>
							<tbody>';
								$sr = 0;
								while ($valViewDemand	= mysqli_fetch_array($sqllmsViewDemand)):
									$is_publish_check	= $valViewDemand['is_publish'];
									$sr++;
									echo '
									<tr>
										<td class="center">'.$sr.'</td>
										<td class="center">
											<img src="uploads/images/students/'.$valViewDemand['std_photo'].'" style="border-radius: 50px; width:50px; height:50px;">
										</td>
										<td>'.$valViewDemand['std_name'].'</td>
										<td class="center">';
											foreach(explode(',', $valViewDemand['id_subjects']) as $key => $val):
												$sqllmsClass	= $dblms->querylms("SELECT SS.subject_name
																						FROM ".CLASS_SUBJECTS." SS
																						WHERE SS.subject_status	= '1'
																						AND SS.is_deleted		= '0'
																						AND SS.subject_id		= '".$val."'
																					");
												$valClass = mysqli_fetch_array($sqllmsClass);
												echo '[ '.$valClass['subject_name'].' ]';
											endforeach;
											echo'
										</td>
									</tr>';
								endwhile;
								echo'
							</tbody>
						</table>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">';
								$valViewDemand	= mysqli_fetch_array($sqllmsViewDemand);
								if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) && ($is_publish_check != 1 )){
									echo'
									<a href="exam_registration.php?deleteid='.$demand_id.'" class="mr-xs btn btn-danger" ><i class="el el-trash"></i> Delete</a>
									<a href="?edit_id='.$demand_id.'" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
								}
								echo'
								<button class="btn btn-default modal-dismiss">Cancel</button>
							</div>
						</div>
					</footer>
				</form>
			</section>
		</div>
	</div>';
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