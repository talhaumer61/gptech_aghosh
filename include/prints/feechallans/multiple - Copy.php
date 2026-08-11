<?php 
	if($_POST['id_month'] <= 9){
			$challanIn = date('Y').'0'.$_POST['id_month'];
		}else{
			$challanIn = date('Y').$_POST['id_month'];
		}
		$sqllms  = $dblms->querylms("SELECT f.id, f.status, f.id_month, f.challan_no, f.id_session, f.id_class, f.id_section, f.id_std,
											f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
											c.class_id, c.class_name,
											cs.section_id, cs.section_name,
											st.std_id, st.std_name, st.std_regno,st.std_rollno,
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
					echo '
					<td width="341" '.$rightborder.' class="'.$clspaid.'">
						<table style="border-collapse:collapse; margin-top: -20px; margin-bottom: -20px;" width="100%" border="0">
							<tr>
								<td>
									<img src="uploads/Aghosh Orphan Care Homes Logo.png" style="width:90px; height: 90px; text-align: left; vertical-align: middle;">
									<br>
								</td>
								<td>
									<img src="uploads/logo.png" style="width:35px; height: 35px; text-align: left; vertical-align: middle;">
									<br>
									<img src="uploads/Tehfeez Logo.png" style="width:35px; height: 35px; text-align: left; vertical-align: middle; margin-top: 10px;">
								</td>
								<td>
									<h6 style="text-align: center;">
										<span>AGHOSH GRAMMAR HIGHER SECONDARY SCHOOL</span>
										<br><br>
										<span>TAHFEEZ UL QURAN INSTITUTE</span>
									</h6>
								</td>
								<td>
									<h6 style="margin-right: -10px;writing-mode: vertical-lr; text-orientation: mixed; border: 1px dashed black; border-radius: 12px; padding: 5px 3px;"> <span class="spanh1">'.$copyfor.'</span></h6>
								</td>
							</tr>
						</table>
						<h4 style="margin-top: 0px;">ABL Collection Account # 0762-0010027282250031</h4>
						<div class="line1"></div>
						<div style="font-size:13px; margin-top:5px;">
							<table style="border-collapse:collapse;" width="100%" border="0">
								<tr>
									<td style="text-align:left; width:75px;">Challan #:</td>
									<td style= text-align:left; width:150px;"><span style="width:90px;display:inline-block; overflow:hidden; border-bottom:1px solid;">'.$feercord['challan_no'].'</span></td>
									<td style="text-align:left;width:70px;">Issue Date:</td>
									<td style="text-align:left; text-decoration:underline;">'.$feercord['issue_date'].'</td>
								</tr>
								<tr>
									<td style="text-align:left;">Reg #:</td>
									<td style="text-align:left;"><span style="font-size:10px;"><u>'.$feercord['std_regno'].'</u></span></td>
									<td style="text-align:left;">Due Date:</td>
									<td style=" text-align:left; text-decoration:underline;">'.$feercord['due_date'].'</td>	
								</tr>
								<tr>
									<td style="text-align:left;">Name:</td>
									<td  colspan="3" style=" text-decoration:underline;"><span style="font-size:12px;">'.$displayname.'</span></td>
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
							<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="2" cellspacing="2" border="1" width="100%">
								<tr>
									<td style="text-align:center; font-size:12px; font-weight:bold;"></td>
									<td width="100" style="text-align:right; font-size:12px; font-weight:bold;">Rs.</td>
								</tr>';
								$sqllmscats  = $dblms->querylms("SELECT cat_id, cat_name  
																	FROM ".FEE_CATEGORY."
																	WHERE cat_status = '1' 
																	ORDER BY cat_id ASC");
																	
								if(mysqli_num_rows($sqllmscats) > 0){
									$src = 0;
									while($rowdoc 	= mysqli_fetch_array($sqllmscats)){
										$src++;
										$sqllmsfeeprt  = $dblms->querylms("SELECT id_cat, amount FROM ".FEE_PARTICULARS." 
																			WHERE id_cat = '".$rowdoc['cat_id']."' AND id_fee  = '".$feercord['id']."' 
																			LIMIT 1");
										if(mysqli_num_rows($sqllmsfeeprt)>0) { 
											$valuefeeprt = mysqli_fetch_array($sqllmsfeeprt);
											echo '
											<tr>
												<td>'.$rowdoc['cat_name'].'</td>
												<td style="text-align:right; width:45%;">'.number_format($valuefeeprt['amount']).'</td>
											</tr>';
										}else{ 
											echo '
											<tr>
												<td>'.$rowdoc['cat_name'].'</td>
												<td style="text-align:right; width:45%;"></td>
											</tr>';
										}
									}
								}
								echo'
								<tr>
									<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;">Before Due Date Grand Total</td>
									<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($feercord['total_amount']).'</td>
								</tr>
								<tr>
									<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;">After Due Date Grand Total</td>
									<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($feercord['total_amount'] +300).'</td>
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
									<td style="font-weight:normal; font-style:italic; text-align:left; font-size:11px; width:80%;">Rupees in word: <span style="text-decoration:underline; font-size:9px; color:#000;">'.convert_number_to_words($feercord['total_amount']).' only</span>
									</td>
									<td style="font-weight:normal; font-style:italic; text-align:right;">Cashier</td>
								</tr>
								<tr>
									<td style="font-weight:normal; font-style:italic; color: #777777; text-align:left; font-size:9px; width:80%;"><b>Cashier Note: </b>
										<ol type="1">
											<li>Only Cash will be accepted.</li>
											<li>After Due Date student will pay PKR 300/.</li>
											<li>The additional amount collected after the due date will be used for need based scholarship purposes.</li>
										</ol>
									</td>
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