<?php
error_reporting(E_ALL);
if(isset($_POST['class'])){$clss = $_POST['class'];}
if(isset($_POST['section'])){$sction = $_POST['section'];}		
echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h2 class="panel-title fa fa-list">
			Bulk Challans	</h2>
	</header>
	<div class="panel-body">
		<div class="row mb-lg">
			 <div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Class <span class="required">*</span></label>
								<select data-plugin-selectTwo data-width="100%" name="class" id="class" required title="Must Be Required" class="form-control populate">
                            		<option value="">Select</option>';
                                $sqllms	= $dblms->querylms("SELECT c.class_id, c.class_name
								   FROM ".CLASSES." c  
								   WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY c.class_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									   if($rowsvalues['class_id'] == $clss){
										   echo'<option value="'.$rowsvalues['class_id'].'" selected>'.$rowsvalues['class_name'].'</option>';
										   }else{
											   echo'<option value="'.$rowsvalues['class_id'].'">'.$rowsvalues['class_name'].'</option>';
											   }
								   }
								   echo'
									</select>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Section <span class="required">*</span></label>
								<select data-plugin-selectTwo data-width="100%" name="section" id="section" required title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>';
                                $sqllms	= $dblms->querylms("SELECT s.section_id, s.section_name
								   FROM ".CLASS_SECTIONS." s  
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY s.section_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									   if($rowsvalues['section_id'] == $sction){
										   echo'<option value="'.$rowsvalues['section_id'].'" selected>'.$rowsvalues['section_name'].'</option>';
										   }else{
											   echo'<option value="'.$rowsvalues['section_id'].'">'.$rowsvalues['section_name'].'</option>';
											   }
								   }
								   echo'
								</select>
							</div>
						</div>
                        
		</div>
		<center>
			<button type="submit" name="challans_details" id="challans_details" class="btn btn-primary"><i class="fa fa-search"></i> Check Details</button>
		</center>
	</div>
	</form>
</section>



<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
    if(isset($_POST['challans_details'])){
//-----------------------------------------------------

$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session, f.id_campus,
								   c.class_id, c.class_name,
								   cs.section_id, cs.section_name,
								   d.id_setup, d.id_cat, d.amount
								     
								   FROM ".FEESETUP." f
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section	
								   INNER JOIN ".FEESETUPDETAIL." d ON d.id_setup = f.id
								   
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND f.id_class = ".$clss."
								   AND f.id_section = ".$sction." 
								   AND d.id_setup = f.id
								   ORDER BY f.id_class ASC");
								   
$srno = 0;
//-----------------------------------------------------
$fee_id = $rowsvalues['id'];
//-----------------------------------------------------

	echo'
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
    <header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-dollar"></i>';
		$rowsvalues = mysqli_fetch_array($sqllms);		echo'
		Challan Details of <b>'.$rowsvalues['class_name'].'</b> (<b> '.$rowsvalues['section_name'].'  '.$fee_id.'</b>)</h2>
	</header>
    
	<div class="panel-body">
						';
						
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//----------------------------------------------------- 

echo'				
<div class="mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Class <span class="required">*</span></label>
			<input type="text" class="form-control" name="id_class" id="id_class" value="'.$rowsvalues['class_name'].'" required title="Must Be Required" readonly/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Section <span class="required">*</span></label>
			<input type="text" class="form-control" name="id_section" id="id_section" value="'.$rowsvalues['section_name'].'" required title="Must Be Required" readonly>
		</div>
	</div>
</div>
<div class="mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Issue Date <span class="required">*</span></label>
			<input type="text" class="form-control" name="issue_date" id="issue_date" data-plugin-datepicker required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Due Date <span class="required">*</span></label>
			<input type="text" class="form-control" name="due_date" id="due_date" data-plugin-datepicker required title="Must Be Required"/>
		</div>
	</div>
</div>';
 $sqllms	= $dblms->querylms("SELECT 	d.id, d.id_setup, d.id_cat, d.amount,
 										c.cat_id, c.cat_name
									 FROM ".FEESETUPDETAIL." d
									 INNER JOIN ".FEE_CATEGORY." c ON c.cat_id = d.id_cat
																									 
									 WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									 AND d.id_setup = '49'
									 ORDER BY c.cat_name ASC");
  $srno = 0;
  //-----------------------------------------------------
  while($rowsvalues = mysqli_fetch_array($sqllms)) {
  //-----------------------------------------------------
  $srno++;
  //-----------------------------------------------------
  echo '
  <input type="hidden" name="id_cat['.$srno.']" id="id_cat['.$srno.']" value="'.$rowsvalues['cat_id'].'">
							
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">'.$rowsvalues['cat_name'].' <span class="required">*</span></label>
									<input type="text" class="form-control" name="amount" id="amount" value="'.$rowsvalues['amount'].'" required title="Must Be Required" readonly/>
								</div>
							</div>
  ';
  }
echo'
<div  class="mt-sm">
	<div class="col-sm-14"
		<div class="form-group">
			<label class="control-label">Note </label>
			<textarea type="text" class="form-control" name="note"></textarea>
		</div>
	</div>
</div>

';
						}
echo'			
		</div>	
	<div class="panel-footer">
		<div class="text-right">
			<button type="submit" name="challans_generate" id="challans_generate" class="btn btn-primary">Generate Challans</button>
		</div>
	</div>
	</form>';
	}
	echo'
</section>
';
?>