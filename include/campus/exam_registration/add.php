<?php
// if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'add' => '1'))){ 
if (LMS_VIEW == "add"){
	$sqllmsclasses	= $dblms->querylms("SELECT c.class_id, c.class_name
										FROM ".CLASSES." c  
										WHERE c.is_deleted	= '0' 
										AND c.class_status	= '1'
										ORDER BY c.class_name ASC
									");
	$sqllmsExamTerms = $dblms->querylms("SELECT et.type_id, et.type_name
										FROM ".EXAM_TYPES." et
										WHERE et.is_deleted	= '0' 
										AND et.type_status	= '1'
										ORDER BY et.type_id ASC
									");
	echo'
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form action="exam_registration.php?view=add" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Exam Registration</h4>
					</div>
					<div class="panel-body">
						<div id="getadmissiondetail">
							<div class="row mt-sm">
								<div class="col-sm-6">
									<label class="control-label">Exam Type <span class="required">*</span></label>
									<select data-plugin-selectTwo data-width="100%" name="id_term" id="id_term" required title="Must Be Required" class="form-control populate">
										<option value="">Select Any Option</option>';
										while($valueExamTerms = mysqli_fetch_array($sqllmsExamTerms)):
											echo '<option value="'.$valueExamTerms['type_id'].'">'.$valueExamTerms['type_name'].'</option>';										
										endwhile;
										echo '
									</select>
								</div>
								<div class="col-md-6">
									<label class="control-label">Classes <span class="required">*</span></label>
									<select data-plugin-selectTwo data-width="100%" name="id_class" id="id_class" required title="Must Be Required" class="form-control populate">
										<option value="">Select</option>';									
										while($value_classes = mysqli_fetch_array($sqllmsclasses)):
											$sqllmsstd	= $dblms->querylms("SELECT s.std_id
																				FROM ".STUDENTS." s  
																				WHERE s.is_deleted 		= '0'
																				AND s.id_class      	= ".cleanvars($value_classes['class_id'])."
																				AND s.id_campus        	= ".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."
																			");
											if (mysqli_num_rows($sqllmsstd)):
												echo'<option value="'.$value_classes['class_id'].'">'.$value_classes['class_name'].'</option>';
											endif;
										endwhile;
										echo'
									</select>
								</div>
								<div class="col-sm-12">
									<label class="col-sm-1 control-label mt-sm">Status <span class="required">*</span></label>
									<div class="col-md-11 pull-left">
										<div class="radio-custom radio-inline mt-sm">
											<input type="radio" id="demand_status" name="demand_status" value="1" checked>
											<label for="radioExample1">Active</label>
										</div>
										<div class="radio-custom radio-inline">
											<input type="radio" id="demand_status" name="demand_status" value="2">
											<label for="radioExample2">Inactive</label>
										</div>
									</div>
								</div>
								<div class="col-sm-12 m-sm">
									<table class="table table-bordered table-striped table-condensed mb-none std_show" id="table_export">
									
									</table>
								</div>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="submit" id="submit_demand" name="submit_demand" class="mr-xs btn btn-primary">Add</button>
								<a class="btn btn-default" href="exam_registration.php">Cancel</a>
							</div>
						</div>
					</footer>
				</form>
			</section>
		</div>
	</div>';
}
// }
// else{
// 	header("Location: sudents.php");
// }
?>
<script>
	$(document).ready(function() {
		var idClass         	= $('#id_class');
		var stdShows         	= $('.std_show');
		idClass.on("change", function(){
			if (idClass.val() != '')
			{
				$.ajax({
					url: "include/campus/exam_registration/ajax.php"
					, type: "POST"
					, data: {
								idClass : idClass.val()
							}
					, success: function(response) {
						stdShows.html(response);
					}
				});
			}
		});
   });
</script>