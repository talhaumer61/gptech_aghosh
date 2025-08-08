<?php
$due_date = '';
$id_session = '';
$id_examtype = '';
$id_campus = '';
if(isset($_POST['due_date'])){$due_date = $_POST['due_date'];}	
if(isset($_POST['id_session'])){$id_session = $_POST['id_session'];}	
if(isset($_POST['id_examtype'])){$id_examtype = $_POST['id_examtype'];}	
if(isset($_POST['id_campus'])){$id_campus = $_POST['id_campus'];}	
//===========================================================================================
		
//============================================================================
//-----------------------------------------------
echo'
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-list"></i>  Genrate Single Challan</h2>
	</header>
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
		<div class="panel-body">
			<div class="row mb-lg">
				<div class="col-md-3">
					<label class="control-label">Session <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="id_session" name="id_session" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
							$sqlSession	= $dblms->querylms("SELECT session_id, session_name 
																FROM ".SESSIONS."
																WHERE is_deleted    = '0'
																AND session_status  = '1'
															");
							while($valSession = mysqli_fetch_array($sqlSession)) {
								echo '<option value="'.$valSession['session_id'].'" '.($valSession['session_id']==$id_session ? 'selected' : '').'>'.$valSession['session_name'].'</option>';
							}
						echo'
					</select>
				</div>
				<div class="col-md-3">
					<label class="control-label">Campus <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="id_campus" name="id_campus" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
							$sqlCampus	= $dblms->querylms("SELECT campus_id, campus_name 
																FROM ".CAMPUS."
																WHERE is_deleted    = '0'
																AND campus_status     = '1'
															");
							while($valCampus = mysqli_fetch_array($sqlCampus)) {
								echo '<option value="'.$valCampus['campus_id'].'" '.($valCampus['campus_id']==$id_campus? 'selected' : '').'>'.$valCampus['campus_name'].'</option>';
							}
						echo'
					</select>
				</div>
                <div class="col-md-3">
					<label class="control-label">Type <span class="required">*</span></label>
					<select data-plugin-selectTwo data-width="100%" id="id_examtype" name="id_examtype" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
							$sqlExamType	= $dblms->querylms("SELECT type_id, type_name 
																FROM ".EXAM_TYPES."
																WHERE is_deleted    = '0'
																AND type_status     = '1'
															");
							while($valExamType = mysqli_fetch_array($sqlExamType)) {
								echo '<option value="'.$valExamType['type_id'].'" '.($valExamType['type_id']==$id_examtype ? 'selected' : '').'>'.$valExamType['type_name'].'</option>';
							}
						echo'
					</select>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Due Date <span class="required">*</span></label>
						<input type="text" class="form-control" name="due_date" id="due_date" value="'.$_POST['due_date'].'" data-plugin-datepicker required title="Must Be Required"/>
					</div>
				</div>
			</div>
			<center>
				<button type="submit" name="view_detail" id="view_detail" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
			</center>
		</div>
	</form>
</section>';

//-----------------------------------------------
if(isset($_POST['view_detail'])){
		$sqllmsRegistrationCheck	= $dblms->querylms("SELECT d.reg_id, GROUP_CONCAT(d.reg_id) idCommaDemand , d.reg_status , d.id_session , d.id_campus, d.id_class , d.is_publish , d.date_added , d.id_type , GROUP_CONCAT(cs.class_name) commaClass , GROUP_CONCAT(d.id_class) commaIdClass , s.session_name , et.type_name , c.campus_name, ef.fee_per_std
		                								FROM ".EXAM_REGISTRATION." d
                                                        INNER JOIN ".CLASSES." cs ON cs.class_id = d.id_class
                                                        INNER JOIN ".SESSIONS." s ON s.session_id = d.id_session
                                                        INNER JOIN ".EXAM_TYPES." et ON et.type_id = d.id_type
                                                        INNER JOIN ".CAMPUS." c ON c.campus_id = d.id_campus
                                                        LEFT JOIN ".EXAM_FEE." ef ON d.id_campus = ef.id_campus
                                                        WHERE d.is_publish 		= '1'
											            AND d.is_deleted 		= '0'
											            AND cs.is_deleted 		= '0'
											            AND et.is_deleted 		= '0'
											            AND s.session_status 	= '1'
                                                        AND d.id_session        = '".cleanvars($_POST['id_session'])."'
                                                        AND d.id_campus         = '".cleanvars($_POST['id_campus'])."'
                                                        AND d.id_type           = '".cleanvars($_POST['id_examtype'])."'
                                                        AND NOT EXISTS (SELECT challan_no FROM ".EXAM_FEE_CHALLANS." efc WHERE s.session_id = efc.id_session AND efc.id_campus = c.campus_id AND efc.id_examtype = et.type_id AND efc.is_deleted = '0')
                                                        GROUP BY d.id_type, s.session_id
                                                        ORDER BY reg_id DESC
									                ");
		if(mysqli_num_rows($sqllmsRegistrationCheck) > 0){							
			echo '
            <section class="panel panel-featured panel-featured-primary">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-list"></i> Exam Registration Detail</h2>
                </header>
                <div class="panel-body">
                    <form action="exam_registration_challans.php?view=add_single" method="POST">
                        <input type="hidden" name="id_session" id="id_session" value="'.$id_session.'">
                        <input type="hidden" name="id_examtype" id="id_examtype" value="'.$id_examtype.'">
                        <input type="hidden" name="due_date" id="due_date" value="'.$due_date.'">
                        <fieldset>
                            <div class="panel-body">
                                <div class="table-responsive mt-sm mb-md">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                                <th width="10px;" class="center">Sr#</th>
                                                <th>Campus</th>
                                                <th width="350px">Exam Term</th>
                                                <th >Class</th>
                                                <th width="50px;" class="center">Students</th>
                                                <th width="50px;" class="center">Amounts</th>
                                                <th width="70px;" class="center">Publish</th>
                                                <th width="70px;" class="center">Status</th>
                                                <th width="70px;" class="center">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            $srno = 0;
                                            while($rowsvalues = mysqli_fetch_array($sqllmsRegistrationCheck)):
                                                
                                                $srno++;
                                                $sqllmsCountStd	= $dblms->querylms("SELECT edd.id_std
                                                                                    FROM ".EXAM_REGISTRATION." ed
                                                                                    INNER JOIN ".EXAM_REGISTRATION_DETAIL." edd ON ed.reg_id = edd.id_reg
                                                                                    WHERE ed.id_session 		= ".cleanvars($rowsvalues['id_session'])."
                                                                                    AND ed.id_campus 			= ".cleanvars($rowsvalues['id_campus'])."
                                                                                    AND ed.id_type 			    = ".cleanvars($rowsvalues['id_type'])."
                                                                                    AND ed.is_deleted 		    = '0'");
                                                echo'
                                                <tr>
                                                    <td class="center">
                                                        <input type="hidden" name="id_demand" id="id_demand" value="'.$rowsvalues['idCommaDemand'].'">
                                                        '.$srno.'
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="id_campus" id="id_campus" value="'.$rowsvalues['id_campus'].'">
                                                        <b>'.$rowsvalues['campus_name'].'</b>
                                                    </td>
                                                    <td>'.$rowsvalues['type_name'].'</td>
                                                    <td>';
                                                        $idCommaDemand = explode(',', $rowsvalues['idCommaDemand']);
                                                        $class_ids = explode(',', $rowsvalues['commaIdClass']);
                                                        $class_names = explode(',', $rowsvalues['commaClass']);
                                                        foreach($idCommaDemand as $key => $val):
                                                            echo '<a href="#show_modal" class="modal-with-move-anim-pvs" onclick="showAjaxModalZoom(\'include/modals/exam_registration/viewByFee.php?demand_id='.$val.'\');">['.$class_names[$key].'] </a>';
                                                        endforeach;
                                                        echo '
                                                    </td>
                                                    <td class="center">'.mysqli_num_rows($sqllmsCountStd).'</td>
                                                    <td class="center">';
                                                        $total_amount = (mysqli_num_rows($sqllmsCountStd)*(!empty($rowsvalues['fee_per_std'])? $rowsvalues['fee_per_std']: DEFAULT_EXAM_FEE));
                                                        echo $total_amount.'<input type="hidden" name="total_amount" id="total_amount" value="'.$total_amount.'">
                                                    </td>
                                                    <td class="center">'.get_publish($rowsvalues['is_publish']).'</td>
                                                    <td class="center">'.get_status($rowsvalues['reg_status']).'</td>
                                                    <td class="center"><a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/exam_registration/viewByFee.php?id_type='.$rowsvalues['id_type'].'&id_class='.$rowsvalues['commaIdClass'].'\');"> <i class="fa fa-eye"></i> </a></td>
                                                </tr>';
                                            endwhile;
                                            echo '
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                        <div class="panel-footer row text-right" style="margin-bottom: -15px;">
                            <button type="submit" name="genrate_single_challan" id="genrate_single_challan" class="btn btn-primary">Genrate Challan</button>
                        </div>
                    </form>
                </div>
                
			</section>';
		} else{
			echo'
            <section class="panel panel-featured panel-featured-primary">
                <div class="panel-body">
                    <h2 class="text text-danger text-center">No Record Found!</h2>
                </div>
            </section>';
		}
}
?>