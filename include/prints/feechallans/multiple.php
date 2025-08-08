<?php 
	if($_POST['id_month'] <= 9){
			$challanIn = date('Y').'0'.$_POST['id_month'];
	}else{
		$challanIn = date('Y').$_POST['id_month'];
	}
	$sqllms  = $dblms->querylms("SELECT f.id, f.status, f.id_month, f.challan_no, f.id_session, f.id_class, f.id_section, f.id_std,
									f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
									c.class_id, c.class_name, c.id_classgroup, 
									cs.section_id, cs.section_name,
									st.std_id, st.std_name, st.std_regno,st.std_rollno, st.std_fathername,
									se.session_id, se.session_name 
									FROM ".FEES." f									
									INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
									LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section
									INNER JOIN ".SESSIONS." se ON se.session_id = f.id_session
									INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std	
									WHERE f.status !='1' AND f.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
									AND f.id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
									AND f.id_class = '".$_POST['id_class']."'
									AND ( f.id_month = '".cleanvars($_POST['id_month'])."' OR f.challan_no LIKE '%".$challanIn."%' )
									AND f.is_deleted != '1'
								");
	while($feercord = mysqli_fetch_array($sqllms)){ 
		if($feercord['id_classgroup'] == 3) {
			$ublAccount 	= '325-732-068';
			$challanprefix 	= 1000014000;
			$image 			= 'uploads/Tehfeez Logo.png';
			$title 			= 'TAHFEEZ UL QURAN INSTITUTE';
		} else {
			$ublAccount 	= '325-731-744';
			$challanprefix 	= 1000014011;
			$image 			= 'uploads/logo.png';
			$title 			= 'AGHOSH GRAMMAR HIGHER SECONDARY SCHOOL';
		}
		
		$link	=	$feercord['challan_no'].'-'.$feercord['id'];
		
		$challanNumber = $challanprefix.substr($feercord['challan_no'], -7);
		
		$filename	=	$PNG_WEB_DIR.$feercord['challan_no'].'_'.$feercord['id'].'.png';
	
	//processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'M';
    $matrixPointSize = 4;
    //default data
	
	$link	=	$feercord['challan_no'].'-'.$feercord['id'];
	QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		
		$Instructions = '<ol type="1" style="margin-left:-20px;">
			<li>Only Cash will be accepted.</li>
			<li>'.date('jS \of F-Y',strtotime($feercord['due_date'])).' is due date.</li>
			<li>Fine of Rs. 300/- will be charged after due date.</li>
			<li>The additional amount collected after the due date will be used for need based scholarship purposes.</li>
		</ol>';
		echo '
		<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
			<tr>';
			if($feercord['status'] == 1) { 
				$clspaid = " paid";
			} else { 
				$clspaid = "";
			}
			$cpi = 0;
			for($ifee = 1; $ifee<=3; $ifee++) { 
				if($ifee<3) { 
					$rightborder = 'style="border-right:1px dashed #333;"';
				} else { 
					$rightborder = '';
				}
				$cpi++;
				
				if($cpi==1) { 
					$copyfor = 'Bank';
				} else if($cpi==2) { 
					$copyfor = 'Account';
				}else if($cpi==3) { 
					$copyfor = "Student's";
				}

				$stdname = preg_replace('/\s+/', ' ', $feercord['std_name']);
				$shortarray = explode(' ',trim($stdname));
				$firstname 	= $shortarray[0];
				$displayname =  $feercord['std_name'];
				$fathername  =  $feercord['std_fathername'];
				echo '
				<td width="341" '.$rightborder.' class="'.$clspaid.'">
					<table style="border-collapse:collapse; margin-top: 5px; margin-bottom: 5px;" width="100%" border="0">
						<tr>
							<td>
								<img src="uploads/Aghosh Orphan Care Homes Logo.png" style="width:90px; height: 90px; text-align: left; vertical-align: middle;">
								<br>
							</td>
							<td>
								<img src="'.$image.'" style="width:35px; height: 35px; text-align: left; vertical-align: middle;">
							</td>
							<td>
								<h6 style="text-align: center;">
									<span>'.$title.'</span>
								</h6>
							</td>
							<td>
								<h6 style="margin-right: -10px;writing-mode: vertical-lr; text-orientation: mixed; border: 1px dashed black; border-radius: 12px; padding: 5px 3px;"> <span class="spanh1">'.$copyfor.'</span></h6>
							</td>
						</tr>
					</table>
					
					<div class="line1"></div>
					<div style="font-size:13px; margin-top:5px;">
						<table style="border-collapse:collapse; border:3px solid #333;" width="100%" border="1">
							<tr>
								<td style="text-align: center;"><img src="uploads/1-link.jpg" style="width:35px; height: 35px; vertical-align: middle; "></td>
								<td style="font-size:14px; font-weight:600; padding:10px;">All Mobile Banking Payments:<br>1 Bill  Invoice ID: '.$challanNumber.'</td>
							</tr>
							<tr>
								<td style="text-align: center;"><img src="uploads/ubl.png" style="width:35px; height: 35px; vertical-align: middle; "></td>
								<td style="font-size:14px; font-weight:600; padding:10px;">UBL All Over Pakistan ('.$ublAccount.')<br>Challan No: '.$feercord['challan_no'].'</td>
							</tr>
						</table>
						
						<table style="border-collapse:collapse; margin-top:10px; font-size:11px;" width="100%" border="0">
							<tr>
								<td style="text-align:left; width:60px;">Challan #:</td>
								<td style= text-align:left; min-width:150px;"><span style="width:90px;display:inline-block; overflow:hidden; border-bottom:1px solid;">'.$feercord['challan_no'].'</span></td>
								<td style="text-align:left;">Issue Date:</td>
								<td style="text-align:left; width:60px; text-decoration:underline;">'.$feercord['issue_date'].'</td>
							</tr>
							<tr>
								<td style="text-align:left;">Name:<br>Father:</td>
								<td style=" text-decoration:underline;">'.$displayname.'<br>'.$fathername.'</td>
								
								<td style="text-align:left;">Expiry Date:</td>
								<td style=" text-align:left; text-decoration:underline;">'.date('Y-m-t',strtotime($feercord['due_date'])).'</td>	
							</tr>
							<tr>
								<td style="text-align:left;">Reg #:</td>
								<td style="text-align:left;"><span style="font-size:10px;"><u>'.$feercord['std_regno'].'</u></span></td>
								<td style="text-align:left;">Due Date:</td>
								<td style=" text-align:left; text-decoration:underline;">'.$feercord['due_date'].'</td>
							</tr>
							<tr>
								<td style="text-align:left;">Class:</td>
								<td style="text-align:left; text-decoration:underline;">'.$feercord['class_name'].'</td>';
								if($feercord['section_name']){
								echo'
								<td style="text-align:left;">Section:</td>
								<td style="text-align:left; text-decoration:underline;">'.$feercord['section_name'].'</td>';
								}else{
								echo'
								<td style="text-align:left;">Session:</td>
								<td style="text-align:left; text-decoration:underline;">'.$feercord['session_name'].'</td>';
								}
								echo'
							</tr>
							<tr>';
								if($feercord['std_rollno']){
								echo'
								<td style="text-align:left;">Roll No:</td>
								<td style=" text-align:left; text-decoration:underline;">'.$feercord['std_rollno'].'</td>';}
								echo'
								<td style="text-align:left;">Month</td>
								<td style=" text-align:left;  text-decoration:underline;">'.get_monthtypes($feercord['id_month']).'</td>
							</tr>
						</table>
					</div>
					<div style="font-size:12px; margin-top:5px;">
							<table style="border-collapse:collapse; border:1px solid #666; font-size:11px;" cellpadding="2" cellspacing="2" border="1" width="100%">
							<tr>
								<td style="text-align:center; font-size:11px; font-weight:bold;"> Descriptions </td>
								<td style="text-align:right; font-size:11px; font-weight:bold; width:50px;">Rs.</td>
							</tr>';

								$grandTotal = 0;
								foreach($monthtypes as $month):
									// CURRENT MONTH
									if($feercord['id_month']==$month['id']){

										$year = date('Y' , strtotime(cleanvars($feercord['due_date'])));
										if($feercord['status']==1){
											$amount = $feercord['paid_amount'];
										}else{
											$amount = $feercord['total_amount'] - $feercord['paid_amount'];
										}

										if($feercord['due_date'] < date('Y-m-d') && $feercord['status'] != '1'){
											$amount = $amount;
										}
										echo'
										<tr>
											<td>'.$month['name'].' '.$year.'</td>
											<td style="text-align:right;">'.number_format($amount).'</td>
										</tr>';
									}
									// PREVIOUS MONTHS
									else{
										$sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.challan_no, f.id_std,
																			f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																			FROM ".FEES." f
																			WHERE f.id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																			AND f.id_month		= '".cleanvars($month['id'])."'
																			AND f.id_std		= '".cleanvars($feercord['id_std'])."'
																			AND (f.status = '2' OR f.status = '4')
																			AND f.is_deleted != '1' LIMIT 1");
										if(mysqli_num_rows($sqlnarration)>0){
											$valnarration = mysqli_fetch_array($sqlnarration);

											$year = date('Y' , strtotime(cleanvars($valnarration['due_date'])));
											$amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

											if($valnarration['due_date'] < date('Y-m-d')){
												$amount = $amount + LATEFEE;
											}

											if(($feercord['status']==1 && $feercord['id_month']==$month['id']) || ($feercord['status']==2 || $feercord['status']==4)){
												$amount = $amount;
											}else{
												$amount = 0; 
											}
											echo'
										<tr>
											<td>'.$month['name'].' '.$year.'</td>
											<td style="text-align:right;">'.number_format($amount).'</td>
										</tr>';

										} else {
											$amount = 0; 
										}
										
									}
									$grandTotal = $grandTotal + $amount;
								endforeach;

								echo '
								
								<tr>
									<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Amount Before Due Date</td>
									<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($grandTotal).'</td>
								</tr>
								<tr>
									<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Amount After Due Date</td>
									<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($grandTotal + LATEFEE).'</td>
								</tr>
								
							</table>';
							if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
							echo '<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
							}
							echo '
							<span style="font-size:9px; float:right; margin-top:3px;">issue Date: '.date("m/d/Y").'</span>
						</div>
						<div style="clear:both;"></div>
					<div style="font-size:13px; color:#000; margin-top:10px;">
						<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="5">
							<tr>
								<td style="font-weight:normal; font-style:italic; text-align:left; font-size:11px; width:85%;">Rupees in word: <span style="text-decoration:underline; font-size:9px; color:#000;">'.convert_number_to_words($grandTotal).' only</span>
								</td>
								<td style="font-weight:normal; font-style:italic; text-align:right;">Cashier</td>
							</tr>
							<tr>
								<td style="font-weight:normal; font-style:italic; color: #777777; text-align:left; font-size:9px; width:80%;"><b>Parents Note: </b>
									'.$Instructions.'
									<b>Student Login: </b>
									<ol type="1" style="margin-left:-20px;">
										<li>Visit this url '.SITE_URL.'</li>
										<li>Provide Username = '.$feercord['std_regno'].'</li>
										<li>Provide Password = ags786</li>
									</ol>
								</td>
								<td style="text-align:right; " valign="top"><img src="'.$PNG_WEB_DIR.basename($filename).'" align="right" ></td>
							</tr>
							
						</table>
						
					</div>
				</td>';
			}
			echo'
			</tr>
		</table>
		<div class="page-break"></div>';
	}