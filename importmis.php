<?php 
	include "dbsetting/lms_vars_config.php";
	include "dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "functions/functions.php";
	include "functions/login_func.php";
//-----------------------------------------------
if($view == 'importmis') { 	
//--------------------------------------
if(isset($_POST['submit_memoimport'])) { 
//------------------------------------------------
$exceldata = array();
//------------------------------------------------
	for($ichk=1; $ichk<=sizeof($_POST['feeid']); $ichk++){
//--------------------------------------
	$sqllmsdebit  = $dblms->querylms("INSERT INTO ".STUDENTS_LEDGER." (
															id_std												,
															challanno											, 
															credit_debit										, 
															amount												, 
															dated
														  )
												VALUES	 (
															'".cleanvars($_POST['stdid'][$ichk])."'				, 
															'".cleanvars($_POST['challan'][$ichk])."'			, 
															'2'													, 
															'".cleanvars($_POST['pamount'][$ichk])."'			, 
															NOW() 				
														  )
							 ");

}
//--------------------------------------
	$exceldata[] = $_POST['challan'][$ichk];
	}
	if($sqllmsup) {
		echo '<div id="infoupdated" class="alert-box notice"><span>success: </span>Record update successfully.</div>';
	}

}
}
	
//-----------------------------------------------
if($view == 'import') { 
//--------------------------------------
if(!empty($_FILES['std_photo']['name'])) { 
//------------------------------------------------
if($_FILES["std_photo"]["size"] > 0) {
//------------------------------------------------ 
echo '
<h3 class="modal-title" style="font-weight:700; margin:10px;"> Import Bank MIS</h3>
<form class="form-horizontal" action="importmis.php" method="post" name="importdata" id="importdata" enctype="multipart/form-data">
<input type="hidden" value="importmis" name="view" id="view">
<table class="table table-bordered" border="1" style="border-collapse:collapse;">
<thead>
<tr>
	<th style="font-weight:700;"> Sr.#</th>
	<th style="font-weight:700;"> Challan.#</th>
	<th style="font-weight:700;"> Form / Reg No.</th>
	<th style="font-weight:700;"> Due Date</th>
	<th style="font-weight:700;"> Due Amount</th>
	<th style="font-weight:700;"> Paid Date</th>
	<th style="font-weight:700;"> Paid Amount</th>
</tr>
</thead>
<tbody>';
//--------------------------------------
	$file_name = $_FILES['std_photo']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    //Checking the file extension
    if($ext == "xlsx" || $ext == "csv" || $ext == "xls"){

            $file_name = $_FILES['std_photo']['tmp_name'];
            $inputFileName = $file_name;
  //Had to change this path to point to IOFactory.php.
  //Do not change the contents of the PHPExcel-1.8 folder at all.
  include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

  //Use whatever path to an Excel file you need.

  try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
  } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . 
        $e->getMessage());
  }

  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();
//--------------------------------------
$srno = 0;
$srno1 = 0;
 for ($rowcurs = 1; $rowcurs <= $highestRow; $rowcurs++) { 
    $rowcursData = $sheet->rangeToArray('A' . $rowcurs . ':' . $highestColumn . $rowcurs, 
                                    null, true, false);
//--------------------------------------
$srno++;
if($srno> 10) {
//--------------------------------------------
$challno		= $rowcursData[0][2];
$pdate			= $rowcursData[0][3];
$pamount		= filter_var($rowcursData[0][6], FILTER_SANITIZE_NUMBER_INT);

//--------------------------------------------

$newDateString = date('Y-m-d' , strtotime($pdate));
//--------------------------------------
$sqllms  = $dblms->querylms("SELECT *  
										FROM ".FEES." fee 										
										WHERE fee.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINIDCOM'])."' 
										AND fee.challan_no = '".$challno."' LIMIT 1");									
if(mysqli_num_rows($sqllms)>0) {
	$srno1++;
$valuechallan	= mysqli_fetch_array($sqllms);
if($valuechallan['total_amount']<$pamount || $valuechallan['total_amount']>$pamount) {
	$bgcolor = ' style="background-color:#ECEC00 !important; font-weight:700;"';
echo '
<tr '.$bgcolor.'>
	<td style="width:50px;">'.$srno1.'</td>
	<td>'.$challno.'</td>
	<td>'.$valuechallan['formno'].' / '.$valuechallan['regno'].'</td>
	<td style="width:100px;">'.$valuechallan['due_date'].'</td>
	<td style="text-align:right; width:100px;">'.number_format($valuechallan['total_amount']).'</td>
	<td style="width:100px;">'.$newDateString.'</td>
	<td style="text-align:right; width:100px;">'.number_format($pamount).'</td>
</tr>
<input type="hidden" name="stdid['.$srno1.']" id="stdid['.$srno1.']">
<input type="hidden" name="pamount['.$srno1.']" id="pamount['.$srno1.']" value="'.$pamount.'">
<input type="hidden" name="paid_date['.$srno1.']" id="paid_date['.$srno1.']" value="'.$newDateString.'">
<input type="hidden" name="feeid['.$srno1.']" id="feeid['.$srno1.']" >
<input type="hidden" name="challan['.$srno1.']" id="challan['.$srno1.']" >
<input type="hidden" name="challan['.$srno1.']" id="challan['.$srno1.']">
<input type="hidden" name="admission_status['.$srno1.']" id="admission_status['.$srno1.']">
<input type="hidden" name="formno['.$srno1.']" id="formno['.$srno1.']">';
} else { 
	$bgcolor = ''; 
	echo '
<tr '.$bgcolor.'>
	<td style="width:50px;">'.$srno1.'</td>
	<td>'.$challno.'</td>
	<td>'.$valuechallan['formno'].' / '.$valuechallan['regno'].'</td>
	<td style="width:100px;">'.$valuechallan['due_date'].'</td>
	<td style="text-align:right; width:100px;">'.number_format($valuechallan['total_amount']).'</td>
	<td style="width:100px;">'.$newDateString.'</td>
	<td style="text-align:right; width:100px;">'.number_format($pamount).'</td>
</tr>
<input type="hidden" name="stdid['.$srno1.']" id="stdid['.$srno1.']" value="'.$valuechallan['id_std'].'">
<input type="hidden" name="pamount['.$srno1.']" id="pamount['.$srno1.']" value="'.$pamount.'">
<input type="hidden" name="paid_date['.$srno1.']" id="paid_date['.$srno1.']" value="'.$newDateString.'">
<input type="hidden" name="feeid['.$srno1.']" id="feeid['.$srno1.']" value="'.$valuechallan['id'].'">
<input type="hidden" name="challan['.$srno1.']" id="challan['.$srno1.']" value="'.$challno.'">
<input type="hidden" name="challan['.$srno1.']" id="challan['.$srno1.']" value="'.$challno.'">
<input type="hidden" name="admission_status['.$srno1.']" id="admission_status['.$srno1.']" value="'.$valuechallan['admission_status'].'">
<input type="hidden" name="formno['.$srno1.']" id="formno['.$srno1.']" value="'.$valuechallan['formno'].'">';
	
}
//--------------------------------------

}
}
}
echo '<tr><td colspan="15" style="text-align:right;"><button class="btn btn-info" name="submit_memoimport" id="submit_memoimport" type="submit" style="padding:5px 13px; font-size:12px;"> Save </button></td></tr>';
echo '
</tbody>
</table>
</form>'; 
//fclose($file);
}
}
//--------------------------------------
//} else {
//    echo 'The file is not readable';
//}
} else {
	echo '<div  class="alert-box error"><span>Oop: </span>File extension not valid, only .csv valid</div>';
}
}
//--------------------------------------
if(!$view) { 
//--------------------------------------
echo '
<form class="form-horizontal" action="importmis.php" method="post" id="feeMemo" enctype="multipart/form-data">
<input type="hidden" name="view" id="view" value="import">
<div class="modal-content">
<div class="modal-header">
	<h4 class="modal-title" style="font-weight:700;"> Import Bank MIS</h4>
</div>
<div class="modal-body">
 

	<div class="form-group" style="margin-bottom:10px;">
		<label class="control-label req col-lg-12" style="width:150px;"> <b>File</b></label>
		<div class="col-lg-12">
			<input id="std_photo" name="std_photo" class="btn btn-mid btn-primary clearfix" required type="file"> 
			<span style="color:#f00;">File extension should be .csv only</span>
		</div>
	</div>
	
<div style="clear:both;"></div>

</div>

<div style="clear:both;"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Closed</button>
	<input class="btn btn-primary" type="submit" value=" Import " id="submit_file" name="submit_file">
</div>

</div>
</form>';
}
}
?>