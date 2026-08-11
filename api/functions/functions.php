<?php 
//--------------- Months Keywords ----------
$monthtypes = array (
	array('id'=>1, 'name'=>'January'),
	array('id'=>2, 'name'=>'February'),
	array('id'=>3, 'name'=>'March'),
	array('id'=>4, 'name'=>'April'),
	array('id'=>5, 'name'=>'May'),
	array('id'=>6, 'name'=>'June'),
	array('id'=>7, 'name'=>'July'),
	array('id'=>8, 'name'=>'August'),
	array('id'=>9, 'name'=>'September'),
	array('id'=>10, 'name'=>'October'),
	array('id'=>11, 'name'=>'November'),
	array('id'=>12, 'name'=>'December')
   );

function get_monthtypes($id) {
	$month = array (
						'1'		=> 'January',
						'2'		=> 'February',
						'3'		=> 'March',
						'4'		=> 'April',
						'5'		=> 'May',
						'6'		=> 'June',
						'7'		=> 'July',
						'8'		=> 'August',
						'9'		=> 'September',
						'10'	=> 'October',
						'11'	=> 'November',
						'12'	=> 'December'
						);
return $month[$id];
}
//--------------- Status ------------------
$admstatus = array (
						array('status_id'=>1, 'status_name'=>'Active')		, array('status_id'=>0, 'status_name'=>'Inactive')
				   );
$ad_status = array (
						array('status_id'=>1, 'status_name'=>'Active')		, array('status_id'=>0, 'status_name'=>'Inactive')
				   );

function get_admstatus($id) {
	$listadmstatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">Active</span>', 
							'0' => '<span class="label label-danger" id="bns-status-badge">Inactive</span>');
	return $listadmstatus[$id];
}
//--------------- Status ------------------
$status = array (
						array('id'=>1, 'name'=>'Active')		, array('id'=>2, 'name'=>'Inactive')
				   );
function get_status($id) {
	$liststatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">Active</span>', 
							'2' => '<span class="label label-danger" id="bns-status-badge">Inactive</span>');
	return $liststatus[$id];
}

//--------------- HostelStatus ------------------
$hostelstatus = array (
						array('id'=>1, 'name'=>'Active'), array('id'=>2, 'name'=>'Inactive'), array('id'=>3, 'name'=>'Left')
				   );
function get_hostelstatus($id) {
	$liststatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">Active</span>', 
							'2' => '<span class="label label-danger" id="bns-status-badge">Inactive</span>', 
							'3' => '<span class="label label-warning" id="bns-status-badge">Left</span>');
	return $liststatus[$id];
}

function get_admstatus1($id) {
	$liststatus= array (
							'1' => 'Active', 
							'2' => 'Inactive');
	return $liststatus[$id];
}
//--------------- Status ------------------
$struckoff = array (
						array('id'=>1, 'name'=>'Struck Off')		, array('id'=>2, 'name'=>'Inactive')
				   );
function get_struckoff($id) {
	$liststruckoff = array (
							'1' => '<span class="label label-warning" id="bns-status-badge">Struck Off</span>', 
							'2' => '<span class="label label-danger" id="bns-status-badge">Inactive</span>');
	return $liststruckoff[$id];
}
//--------------- Published/Pending ------------------
$publishedstatus = array (
						array('id'=>1, 'name'=>'Published'), 
						array('id'=>2, 'name'=>'Pending') ,
						array('id'=>3, 'name'=>'Rejected'),
						array('id'=>4, 'name'=>'Confirmed')
				   );

function get_publishedstatus($id) {
	$listpublishedstatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">Published</span>', 
							'2' => '<span class="label label-warning" id="bns-status-badge">Pending</span>',
							'3' => '<span class="label label-danger" id="bns-status-badge">Rejected</span>',
							'4' => '<span class="label label-info" id="bns-status-badge">Confirmed</span>');
	return $listpublishedstatus[$id];
}
//--------------- Studdent Status ------------------
$std_status = array (
						array('id'=>1, 'name'=>'New')		, 
						array('id'=>2, 'name'=>'Confirmed')	, 
						array('id'=>3, 'name'=>'Pending')	, 
						array('id'=>4, 'name'=>'Rejected')	,
						array('id'=>5, 'name'=>'Refund')	,
						array('id'=>6, 'name'=>'Completed')	,
						array('id'=>7, 'name'=>'Provisionally Admited')	
						
				   );

function get_stdstatus($id) {
	$liststdstatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">New</span>'	, 
							'2' => '<span class="label label-info" id="bns-status-badge">Confirmed</span>'	, 
							'3' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'	,
							'4' => '<span class="label label-danger" id="bns-status-badge">Rejected</span>'	,
							'5' => '<span class="label label-warning" id="bns-status-badge">Refund</span>'	,
							'6' => '<span class="label label-info" id="bns-status-badge">Complated</span>'	,
							'7' => '<span class="label label-info" id="bns-status-badge">Provisionally Admited</span>'
						  );
	return $liststdstatus[$id];
}
function get_stdstatus1($id) {
	$liststdstatus= array (
							'1' => 'New'		, 
							'2' => 'Confirmed'	, 
							'3' => 'Pending'	,
							'4' => 'Rejected'	,
							'6' => 'Complated'
						  );
	return $liststdstatus[$id];
}


//--------------- Installment Period ------------------
$instperiod = array (
						array('id'=>1, 'name'=>'Monthly')		, 
						array('id'=>2, 'name'=>'Two Months')	, 
						array('id'=>3, 'name'=>'Three Months')	
				   );

function get_instperiod($id) {
	$listinstperiod= array (
							'1' => 'Monthly'		, 
							'2' => 'Two Months'		, 
							'3' => 'Three Months'	
						  );
	return $listinstperiod[$id];
}

//--------------- Credit Debit ------------------
$creditdebit = array (
						array('id'=>1, 'name'=>'Credit')		, 
						array('id'=>2, 'name'=>'Debit')		
				   );

function get_creditdebit($id) {
	$listcreditdebit = array (
							'1' => 'Credit'		, 
							'2' => 'Debit'			
						  );
	return $listcreditdebit[$id];
}


//--------------- API Type------------------
$apitype = array (
						array('id'=>1, 'name'=>'REST')		, 
						array('id'=>2, 'name'=>'SOAP')		
				   );

function get_apitype($id) {
	$listapitype = array (
							'1' => 'REST'		, 
							'2' => 'SOAP'			
						  );
	return $listapitype[$id];
}

//--------------- Inquiry Status ------------------
$midstatus = array (
						array('id'=>1, 'name'=>'Not Publish')		, 
						array('id'=>2, 'name'=>'Publish')	
				   );

function get_midstatus($id) {
	$listmidstatus= array (
							'1' => '<span class="label label-warning" id="bns-status-badge">Not Publish</span>'		, 
							'2' => '<span class="label label-info" id="bns-status-badge">Publish</span>'	
						  );
	return $listmidstatus[$id];
}

//--------------- Result Status ------------------
$resultstatus = array (
						array('id'=>1, 'name'=>'Published')		, 
						array('id'=>2, 'name'=>'Pending')		, 
						array('id'=>3, 'name'=>'Approved')	
				   );

function get_resultstatus($id) {
	$listresultstatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">Published</span>', 
							'2' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'	, 
							'3' => '<span class="label label-success" id="bns-status-badge">Approved</span>'	
							
						  );
	return $listresultstatus[$id];
}

//--------------- Inquiry Status ------------------
$inq_status = array (
						array('id'=>1, 'name'=>'New Inquiry')		, 
						array('id'=>2, 'name'=>'Prospectus Sold')	, 
						array('id'=>4, 'name'=>'Forum Submission')	, 
						array('id'=>3, 'name'=>'Pending')
				   );

function get_inqstatus($id) {
	$listinqstatus= array (
							'1' => '<span class="label label-success" id="bns-status-badge">New Inquiry</span>'		, 
							'2' => '<span class="label label-info" id="bns-status-badge">Prospectus Sold</span>'	, 
							'4' => '<span class="label label-info" id="bns-status-badge">Forum Submission</span>'	, 
							'3' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'
						  );
	return $listinqstatus[$id];
}

function get_inqstatus1($id) {
	$listinqstatus= array (
							'1' => 'New Inquiry'		, 
							'2' => 'Prospectus Sold'	, 
							'3' => 'Pending'
						  );
	return $listinqstatus[$id];
}

//--------------- fees Status ------------------
$fee_status = array ( 
						array('id'=>2, 'name'=>'Paid')		, 
						array('id'=>3, 'name'=>'Pending')	, 
						array('id'=>4, 'name'=>'Unpaid')	
				   );

function get_feestatus($id) {
	$listfeestatus= array (
							'2' => '<span class="label label-info" id="bns-status-badge">Paid</span>'		, 
							'3' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'	,
							'4' => '<span class="label label-danger" id="bns-status-badge">Unpaid</span>'	
						  );
	return $listfeestatus[$id];
}

function get_feestatus1($id) {
	$listfeestatus= array ( 
							'2' => 'Paid'		, 
							'3' => 'Pending'	,
							'4' => 'Unpaid'		
						  );
	return $listfeestatus[$id];
}

//--------------- Library Status ------------------
$lby_status = array (
						array('id'=>1, 'name'=>'Issued')	, array('id'=>2, 'name'=>'Return'), 
						array('id'=>3, 'name'=>'Pending')	, array('id'=>4, 'name'=>'Over Date')
				   );

function get_lbystatus($id) {
	$listlbystatus = array (
							'1' => '<span class="label label-success" id="bns-status-badge">Issued</span>'	, 
							'2' => '<span class="label label-info" id="bns-status-badge">Return</span>'		, 
							'3' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'	,
							'4' => '<span class="label label-danger" id="bns-status-badge">Over Date</span>'
						  );
	return $listlbystatus[$id];
}

function get_lbystatus1($id) {
	$listlbystatus = array (
							'1' => 'Issued'		, 
							'2' => 'Return'		, 
							'3' => 'Pending'	,
							'4' => 'Over Date'
						  );
	return $listlbystatus[$id];
}

//--------------- Subject Types ------------------
$curstypes = array (
					array('id'=>1, 'name'=>'Required'),
					array('id'=>2, 'name'=>'Elective'),
					array('id'=>3, 'name'=>'General')
				   );

function get_curstypes($id) {
	$listcurstypes = array (
							'1'	=> 'Required',
							'2'	=> 'Elective',
							'3'	=> 'General'
							);
	return $listcurstypes[$id];
}

function get_curstypes12($id) {
	$listcurstypes12 = array (
							'Required'	=> '1',
							'Elective'	=> '2',
							'General'	=> '3'
							);
	return $listcurstypes12[$id];
}

//--------------- Admins Rights ----------
$admrights = array (
					array('rgt_id'=>1, 'rgt_name'=>'Administrator'),
					array('rgt_id'=>2, 'rgt_name'=>'Accountant')
				   );

function get_admrights($id) {
	$listadmrights = array (
							'1'	=> 'Administrator',
							'2'	=> 'Accountant'
							);
	return $listadmrights[$id];
}

//--------------- Admins Types ----------
$admtypes = array (
					array('id'=>1, 'name'=>'Super Administrator'),
					array('id'=>2, 'name'=>'Campus Administrator')
				   );

$admtypes1 = array (
					array('id'=>2, 'name'=>'Campus Administrator')	,
					array('id'=>3, 'name'=>'Librarian')				,
					array('id'=>4, 'name'=>'Hostel Warden')			,
					array('id'=>5, 'name'=>'Finance Director')		,
					array('id'=>6, 'name'=>'Accountant')			,
					array('id'=>7, 'name'=>'Clerk')					,
					array('id'=>8, 'name'=>'Dean')					,
					array('id'=>9, 'name'=>'HOD')
					
				   );

function get_admtypes($id) {
	$listadmtypes = array (
							'1'	=> 'Super Administrator'		,
							'2'	=> 'Campus Administrator'		,
							'3'	=> 'Librarian'					,
							'4'	=> 'Hostel Warden'				,
							'5'	=> 'Finance Director'			,
							'6'	=> 'Accountant'					,
							'7'	=> 'Clerk'						,
							'8'	=> 'Dean'						,
							'9'	=> 'HOD'
							);
	return $listadmtypes[$id];
}

//--------------- inquiry Types----------
$inquirytype = array (
					array('id'=>1,  'name'=>'Walked In Inquiry'),
					array('id'=>2,  'name'=>'Telephone Inquiry')
				   );

function get_inquirytype($id) {
	$listinquirytype = array (
							'1'		=> 'Walked In Inquiry',
							'2'		=> 'Telephone Inquiry'
							);
	return $listinquirytype[$id];
}
//--------------- Source of inquiry ----------
$inquirysrc = array (
					array('id'=>1,  'name'=>'Print Media'),
					array('id'=>2,  'name'=>'Through Website'),
					array('id'=>3,  'name'=>'Leaflet'),
					array('id'=>4,  'name'=>'SMS'),
					array('id'=>5,  'name'=>'E-Mail'),
					array('id'=>6,  'name'=>'Social Media'),
					array('id'=>7,  'name'=>'Through a friend'),
					array('id'=>13,  'name'=>'Old Student'),
					array('id'=>8,  'name'=>'Just walked In'),
					array('id'=>10, 'name'=>'Electronic Media'),
					array('id'=>11, 'name'=>'Referred by Tehreek Member'),
					array('id'=>12, 'name'=>'Referred by Staff Member')
				   );

function get_inquirysrc($id) {
	$listinquirysrc = array (
							'1'		=> 'Print Media',
							'2'		=> 'Through Website',
							'3'		=> 'Leaflet',
							'4'		=> 'SMS',
							'5'		=> 'E-Mail',
							'6'		=> 'Social Media',
							'7'		=> 'Through a friend',
							'8'		=> 'Just walked In',
							'10'	=> 'Electronic Media',
							'11'	=> 'Referred by Tehreek Member',
							'12'	=> 'Referred by Staff Member',
							'13'	=> 'Old Student'
							);
	return $listinquirysrc[$id];
}
//------------ Print Media ---------------------------
$PrintMedia = array (
					array('id'=>1,  'name'=>'Express News')			,
					array('id'=>2,  'name'=>'Daily Dunya')			,
					array('id'=>3,  'name'=>'Daily Nawa-e-Waqat')	,
					array('id'=>4,  'name'=>'Daily City 42')		,
					array('id'=>5,  'name'=>'Daily Jang')			,
					array('id'=>6,  'name'=>'The News')				,
					array('id'=>7,  'name'=>'Daily 92')				,
					array('id'=>8,  'name'=>'Daily Ausaf')			,
					array('id'=>9,  'name'=>'Road Campaign')
				   );

function get_PrintMedia($id) {
	$listPrintMedia = array (
							'1'		=> 'Express News'				,
							'2'		=> 'Daily Dunya'				,
							'3'		=> 'Daily Nawa-e-Waqat'			,
							'4'		=> 'Daily City 42'				,
							'5'		=> 'Daily Jang'					,
							'6'		=> 'The News'					,
							'7'		=> 'Daily 92'					,
							'8'		=> 'Daily Ausaf'				,
							'9'		=> 'Road Campaign'
							);
	return $listPrintMedia[$id];
}

//------------ Electronic Media ---------------------------
$ElectronicMedia = array (
					array('id'=>10,  'name'=>'Express News')	,
					array('id'=>11,  'name'=>'ARY News')		,
					array('id'=>12,  'name'=>'Daily Dunya')		,
					array('id'=>13,  'name'=>'24 News')			,
					array('id'=>14,  'name'=>'Daily City 42')	,
					array('id'=>15,  'name'=>'Channel 24')		,
					array('id'=>16,  'name'=>'LHR News HD')		,
					array('id'=>17,  'name'=>'Cable Ad.')		,
					array('id'=>18,  'name'=>'Radio')
				   );

function get_ElectronicMedia($id) {
	$listMedia = array (
							'10'		=> 'Express News'			,
							'11'		=> 'ARY News'				,
							'12'		=> 'Daily Dunya'			,
							'13'		=> '24 News'				,
							'14'		=> 'Daily City 42'			,
							'15'		=> 'Channel 24'				,
							'16'		=> 'LHR News HD'			,
							'17'		=> 'Cable Ad.'				,
							'18'		=> 'Radio'
							);
	return $listMedia[$id];
}

//------------ Social Media ---------------------------
$SocialMedia = array (
					array('id'=>19,  'name'=>'Facebook')				,
					array('id'=>20,  'name'=>'Instagram')				,
					array('id'=>21,  'name'=>'Twitter')					,
					array('id'=>22,  'name'=>'Youtube')					,
					array('id'=>23,  'name'=>'LED inside Campus')		,
					array('id'=>24,  'name'=>'From MUL Students')		,
					array('id'=>25,  'name'=>'Referred by a Friend')	,
					array('id'=>26,  'name'=>'Walk In')					,
					array('id'=>27,  'name'=>'Other')
				   );

function get_SocialMedia($id) {
	$listMedia = array (
							'19'	=> 'Facebook'				,
							'20'	=> 'Instagram'				,
							'21'	=> 'Twitter'				,
							'22'	=> 'Youtube'				,
							'23'	=> 'LED inside Campus'		,
							'24'	=> 'From MUL Students'		,
							'25'	=> 'Referred by a Friend'	,
							'26'	=> 'Walk In'				,
							'27'	=> 'Other'
							);
	return $listMedia[$id];
}
//--------------- Source of inquiry ----------
$promotestatus = array (
					array('id'=>1,  'name'=>'Promoted')					,
					array('id'=>2,  'name'=>'Not Promoted')				,
					array('id'=>3,  'name'=>'1st Probation')			,
					array('id'=>4,  'name'=>'2nd Probation')			,
					array('id'=>5,  'name'=>'Provisionally promoted')	,
					array('id'=>6,  'name'=>'Pass')						,
					array('id'=>7,  'name'=>'Fail')						,
					array('id'=>8,  'name'=>'Freeze')					,
					array('id'=>9,  'name'=>'Freeze/NP')				,
					array('id'=>10,  'name'=>'Freeze/1st P')			,
					array('id'=>11,  'name'=>'Freeze/2nd P')			,
					array('id'=>12,  'name'=>'RL/ill')
				   );

function get_promotestatus($id) {
	$listpromotestatus = array (
							'1'		=> 'Promoted'				,
							'2'		=> 'Not Promoted'			,
							'3'		=> '1st Probation'			,
							'4'		=> '2nd Probation'			,
							'5'		=> 'Provisionally promoted'	,
							'6'		=> 'Pass'					,
							'7'		=> 'Fail'					,
							'8'		=> 'Freeze'					,
							'9'		=> 'Freeze/NP'				,
							'10'	=> 'Freeze/1st P'			,
							'11'	=> 'Freeze/2nd P'			,
							'12'	=> 'RL/ill'
							);
	return $listpromotestatus[$id];
}
//--------------- Hostel Registration ------------------
$reg_types = array (
						array('id'=>1, 'name'=>'Employee'), 
						array('id'=>2, 'name'=>'Student')
				   );

function get_regtypes($id) {
	$listregtypes= array (
							'1' => 'Employee', 
							'2' => 'Student');
	return $listregtypes[$id];
}
//--------------- Employee Types ------------------
$emplytypes = array (
						array('id'=>1, 'name'=>'Teaching'), 
						array('id'=>2, 'name'=>'Non-Teaching')
				    );

function get_emplytypes($id) {

	$listemplytypes = array (
								'1' => 'Teaching', 
								'2' => 'Non-Teaching');
	return $listemplytypes[$id];
}

//--------------- visiting ------------------
$visiting = array (
						array('id'=>1, 'name'=>'Permanent'), 
						array('id'=>2, 'name'=>'Visiting')
				    );

function get_visiting($id) {

	$lisvisiting = array (
								'1' => 'Permanent', 
								'2' => 'Visiting');
	return $lisvisiting[$id];
}

//--------------- Education Level ------------------
$edulevel = array (
						array('id'=>1, 'name'=>'Undergraduate')		, 
						array('id'=>2, 'name'=>'Graduate')			,
						array('id'=>3, 'name'=>'MS/M.Phil')			,
						array('id'=>4, 'name'=>'P.hD')
				    );

function get_edulevel($id) {

	$listedulevel = array (
								'1' => 'Undergraduate'	, 
								'2' => 'Graduate'		,
								'3' => 'MS/M.Phil'		,
								'4' => 'P.hD'		
						);
	return $listedulevel[$id];
}

//--------------- API Request Status ------------------
function get_request_status($id) {
	$lists = array (
						'1'  => 'Challan Paid Successfully'							, 
						'2'  => 'Username is not given'								,  
						'3'  => 'Password is not given'								, 
						'4'  => 'Token is not given'								, 
						'5'  => 'Branch Code is not given'							, 
						'6'  => 'Challan # is not given'							, 
						'7'  => 'Refrence # is not given'							, 
						'8'  => 'Transaction ID is not given'						, 
						'9'  => 'Transaction Amount is not given'					, 
						'10' => 'Transaction Currency is not given'					,
						'11' => 'Transaction Date is not given'						, 
						'12' => 'Username or Password or Token does not match'		, 
						'13' => 'Challan # match'									, 
						'14' => 'Challan # does not match'							, 
						'15' => 'Challan is already paid'							,	 
						'16' => 'Challan is expired'								, 
						'17' => 'Challan Amount does not match'						, 
						'18' => 'Customer code is required'							,
						'19' => 'No Valid Method Name Given'						,
						'20' => 'No Json Input Given'								,
						'21' => 'You are not authorized to access the application'	,
						'22' => 'Invalid Campus Code'	
					);
	return $lists[$id];
}

function get_bank_request_status($id) {
	$lists = array (
						'00'  => 'Successful / Posted Successfully'					, 
						'091'  => 'Voucher ID is Invalid'							,  
						'092'  => 'Voucher date is expired'							,  
						'093'  => 'Authentication Token Invalid'					,  
						'094'  => 'User is Invalid'									,  
						'095'  => 'Campus Code Mismatch'							, 
						'096' => 'General Exception'								,
						'097'  => 'Voucher is already paid'
					);
	return $lists[$id]; 
	
}
//--------------- Payment Types ------------------
$pay_types = array (
						array('id'=>1, 'name'=>'Bank')		, 
						array('id'=>2, 'name'=>'Cash')		, 
						array('id'=>3, 'name'=>'Cheque')
				   );

function get_paytypes($id) {
	$listpaytypes = array ('1' => 'Bank', '2' => 'Cash', '3' => 'Cheque');
	return $listpaytypes[$id];
}
//--------------- Degree Names ------------------
$degreename = array (
						array('id'=>1	, 'name'=>'Matric')			, 
						array('id'=>2	, 'name'=>'Intermediate') 	,
						array('id'=>3	, 'name'=>'Bachelor')		,
						array('id'=>4	, 'name'=>'Master')			,
						array('id'=>5	, 'name'=>'M.Phil / MS')	,
						array('id'=>6	, 'name'=>'Others')
				   );

function get_degreename($id) {
	$listregtypes= array (
							'1' => 'Matric'			, 
							'2' => 'Intermediate'	, 
							'3' => 'Bachelor'		, 
							'4' => 'Master'			,
							'5' => 'M.Phil / MS'	,
							'6' => 'Others');
	return $listregtypes[$id];
}

//--------------- Documents ------------------
$documentsname = array (
						array('id'=>1	, 'name'=>'Complete & Signed Application Form')			, 
						array('id'=>2	, 'name'=>'Matriculation Certificate') 					,
						array('id'=>3	, 'name'=>'Intermediate Certificate')					,
						array('id'=>4	, 'name'=>'Graduation Degree (if applicable)')			,
						array('id'=>5	, 'name'=>'Master Degree (if applicable)')				,
						array('id'=>6	, 'name'=>'Character Certificate')						,
						array('id'=>7	, 'name'=>'CNIC Copy (Original to be seen)')			,
						array('id'=>8	, 'name'=>'Five photos (one attested on the book)')		, 
						array('id'=>9	, 'name'=>'Result Card NTS/Undertaking (for M.Phil)')	,
						array('id'=>10	, 'name'=>'MUL Registration #')							,
						array('id'=>11	, 'name'=>'Others')
						
				   );

function get_documentsname($id) {
	$listdocumentsname = array (
								'1'  => 'Complete & Signed Application Form'					, 
								'2'  => 'Matriculation Certificate'								, 
								'3'  => 'Intermediate Certificate'								, 
								'4'  => 'Graduation Degree (if applicable)'						,
								'5'  => 'Master Degree (if applicable)'							,
								'6'  => 'Character Certificate'									,
								'7'  => 'CNIC Copy (Original to be seen)'						,
								'8'  => 'Five photos (one attested on the book)'				,
								'9'  => 'Result Card NTS/Undertaking (for M.Phil)'				,
								'10' => 'MUL Registration #'									,
								'10' => 'Others'							
							);
	return $listdocumentsname[$id];
}

//--------------- Status Yes No ----------
$statusyesno = array (
						array('id'=>1, 'name'=>'Yes'), 
						array('id'=>0, 'name'=>'No')
				   );


function get_statusyesno($id) {
	
	$liststatusyesno = array (
								'1'	=> 'Yes',	'0'	=> 'No'
							 );
	return $liststatusyesno[$id];
}

function get_statusyesno12($id) {
	
	$liststatusyesno12 = array (
								'Yes'	=> '1',	'No'	=> '0'
							 );
	return $liststatusyesno12[$id];
}

function get_statusyesnobg($id) {
	
	$liststatusyesnobg = array (
								'1'	=> '<span class="label label-success" id="bns-status-badge">Yes</span>',	
								'0'	=> '<span class="label label-warning" id="bns-status-badge">No</span>'
							 );
	return $liststatusyesnobg[$id];
}

//--------------- Status Student Affairs ----------
$stdaffairs = array (
						array('id'=>1, 'name'=>'New')		, 
						array('id'=>2, 'name'=>'Delivered')	, 
						array('id'=>3, 'name'=>'Verified')	, 
						array('id'=>4, 'name'=>'Pending')	,					
						array('id'=>5, 'name'=>'Rejected')
				   );

function get_stdaffairs($id) {

	$liststdaffairs= array (
							'1' => '<span class="label label-success" id="bns-status-badge">New</span>'		, 
							'2' => '<span class="label label-info" id="bns-status-badge">Delivered</span>'	, 
							'3' => '<span class="label label-info" id="bns-status-badge">Verified</span>'	, 
							'4' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'	,
							'5' => '<span class="label label-danger" id="bns-status-badge">Rejected</span>'
						  );
	return $liststdaffairs[$id];

}
//---------------Student Affairs Types ----------
$stdaffairstypes = array (
							array('id'=>1, 'name'=>'Transcript')	, 
							array('id'=>2, 'name'=>'Degree')		, 
							array('id'=>3, 'name'=>'Verification')	, 
							array('id'=>4, 'name'=>'General')
				   );

function get_stdaffairstypes($id) {

	$liststdaffairstypes= array (
									'1' => 'Transcript'		, 
									'2' => 'Degree'			, 
									'3' => 'Verification'	,
									'4' => 'General'
						  		);
	return $liststdaffairstypes[$id];

}

//--------------- Action Through ----------
$actionthrough = array (
				array('id'=>1, 'name'=>'Email')			, 
				array('id'=>2, 'name'=>'Telephonic')	, 
				array('id'=>3, 'name'=>'Others')
			   );

function get_actionthrough($id) {
	$listactionthrough = array ('1'	=> 'Email',	'2'	=> 'Telephonic',	'3'	=> 'Others');
	return $listactionthrough[$id];
}


//--------------- Status Yes No ----------
$yesno = array (
				array('id'=>1, 'name'=>'Yes'), 
				array('id'=>2, 'name'=>'No')
			   );

function get_yesno($id) {
	
	$listyesno = array ('1'	=> 'Yes',	'2'	=> 'No');
	return $listyesno[$id];
}

function get_yesno1($id) {

	$listyesno= array (
							'1' => '<span class="label label-info" id="bns-status-badge">Yes</span>'	, 
							'2' => '<span class="label label-warning" id="bns-status-badge">No</span>'	
						  );
	return $listyesno[$id];

}

//--------------- Deficiency Status ----------
$deficiencystatus = array (
						array('id'=>1, 'name'=>'Paid'), 
						array('id'=>0, 'name'=>'Not Paid'),
						array('id'=>2, 'name'=>'Fee Refund')
				   );

function get_deficiencystatus($id) {
	
	$listdeficiencystatus = array (
								'1'	=> '<span class="label label-success" id="bns-status-badge">Paid</span>',	
								'0'	=> '<span class="label label-danger" id="bns-status-badge">Not Paid</span>',
								'2'	=> '<span class="label label-warning" id="bns-status-badge">Fee Refund</span>'
							 );
	return $listdeficiencystatus[$id];
}
function get_deficiencystatus1($id) {
	
	$listdeficiencystatus = array (
								'1'	=> 'Paid',	
								'0'	=> 'Not Paid'
							 );
	return $listdeficiencystatus[$id];
}

//--------------- program Timing ----------
$programtiming = array (
						array('id'=>1, 'name'=>'Morning')	, 
						array('id'=>2, 'name'=>'Weekend')	, 
						array('id'=>4, 'name'=>'Evening')	, 
						array('id'=>3, 'name'=>'Both')
				   );

function get_programtiming($id) {
	
	$listprogramtiming = array (
								'1'	=> 'Morning'			,	
								'2'	=> 'Weekend'			,	
								'3'	=> 'Both'				,
								'4'	=> 'Evening'
							 );
	return $listprogramtiming[$id];
}


//--------------- program Timing ----------
$timetablereport = array (
						array('id'=>1, 'name'=>'Building Wise')		, 
						array('id'=>2, 'name'=>'Room Wise')			, 
						array('id'=>3, 'name'=>'Period Wise')		,
						array('id'=>4, 'name'=>'Teacher Wise')		,
						array('id'=>5, 'name'=>'Program Wise')		,
						array('id'=>6, 'name'=>'Department Wise')	,
						array('id'=>7, 'name'=>'Faculty Wise')
				   );

function get_timetablereport($id) {
	
	$listtimetablereport = array (
								'1'	=> 'Building Wise'		,	
								'2'	=> 'Room Wise'			,	
								'3'	=> 'Period Wise'		,
								'4'	=> 'Teacher Wise'		,
								'5'	=> 'Program Wise'		,
								'6'	=> 'Department Wise'	,
								'7'	=> 'Faculty Wise'	
							 );
	return $listtimetablereport[$id];
}


//--------------- forward ----------
$forwards = array (
						array('id'=>1, 'name'=>'All Directors / HODs /Dean / Principle') , 
						array('id'=>2, 'name'=>'Controller Examination')	, 
						array('id'=>3, 'name'=>'Director Academic')			,
						array('id'=>4, 'name'=>'HODs / Dean / Principle')
				   );

function get_forwards($id) {
	
	$listforwards = array (
								'1'	=> 'All Directors / HODs /Dean / Principle'	,	
								'2'	=> 'Controller Examination'			,	
								'3'	=> 'Director Academic'				,
								'4'	=> 'HODs / Dean / Principle' 
							 );
	return $listforwards[$id];
}


//--------------- program Class days ----------
$programclassdays = array (
						array('id'=>1, 'name'=>'Monday to Friday')		, 
						array('id'=>2, 'name'=>'Friday to Sunday')		, 
						array('id'=>3, 'name'=>'Saturday to Sunday')	,
						array('id'=>4, 'name'=>'Sunday')
				   );

function get_programclassdays($id) {
	
	$listprogramclassdays = array (
								'1'	=> 'Monday to Friday'			,	
								'2'	=> 'Friday to Sunday'			,	
								'3'	=> 'Saturday to Sunday'			,
								'4'	=> 'Sunday'
							 );
	return $listprogramclassdays[$id];
}

//--------------- Hostel Types ----------
$hosteltypes = array (
						array('id'=>1, 'name'=>'Boys')		, 
						array('id'=>2, 'name'=>'Girls')		, 
						array('id'=>3, 'name'=>'Employees')
				   );

function get_hosteltypes($id) {
	
	$listhosteltypes = array (
								'1'	=> 'Boys'				,	
								'2'	=> 'Girls'				,	
								'3'	=> 'Employees'
							 );
	return $listhosteltypes[$id];
}
//--------------- Salary Heads ----------
$salaryhead = array (
						array('id'=>1, 'name'=>'Allowance')		, 
						array('id'=>2, 'name'=>'Deduction')		
				   );

function get_salaryhead($id) {
	
	$listsalaryhead = array (
								'1'	=> 'Allowance'				,	
								'2'	=> 'Deduction'				
							 );
	return $listsalaryhead[$id];
}
//--------------- Account Heads ----------
$accounthead = array (
						array('id'=>1, 'name'=>'Income')		, 
						array('id'=>2, 'name'=>'Expense')		
				   );

function get_accounthead($id) {
	
	$listaccounthead = array (
								'1'	=> 'Income'					,	
								'2'	=> 'Expense'				
							 );
	return $listaccounthead[$id];
}
//--------------- Absent or Present ----------
$absentpresent = array (
						array('id'=>1, 'name'=>'Absent')		, 
						array('id'=>2, 'name'=>'Present')		
				   );

function get_absentpresent($id) { 
	
	$listabsentpresent = array (
								'1'	=> '<span class="label label-danger" id="bns-status-badge">Absent</span>'		,	
								'2'	=> '<span class="label label-success" id="bns-status-badge">Present</span>'				
							 );
	return $listabsentpresent[$id];
}
//--------------- Range Of Leave ----------
$leaverange = array (
						array('id'=>1, 'name'=>'First Half')		, 
						array('id'=>2, 'name'=>'Second Half')		,
						array('id'=>3, 'name'=>'Full Day')		
				   );

function get_leaverange($id) {
	
	$listleaverange = array (
								'1'	=> 'First Half'					,	
								'2'	=> 'Second Half'				,
								'3'	=> 'Full Day'				
							);
	return $listleaverange[$id];
}
//--------------- Sessions ----------
$session = array(
					'Fall 2019'	,'Spring 2019',
					'Fall 2018' , 'Spring 2018'	,
					'Fall 2017'	, 'Spring 2017'	,
					'Fall 2016'	, 'Spring 2016'	, 
					'Fall 2015'	, 'Spring 2015'	, 
					'Fall 2014'	, 'Spring 2014'	, 
					'Fall 2013'	, 'Spring 2013'	, 
					'Fall 2012'	, 'Spring 2012'	, 
					'Fall 2011'	, 'Spring 2011'	, 
					'Fall 2010'	, 'Spring 2010'	, 
					'Fall 2009'	, 'Spring 2009'	, 
					'Fall 2008'	, 'Spring 2008'	,
					'Fall 2007'	, 'Spring 2007'	,
					'Fall 2006'	, 'Spring 2006'	,
					'Fall 2005'	, 'Spring 2005'	,
					'Fall 2004'	, 'Spring 2004'	,
					'Fall 2003'	, 'Spring 2003'	,
					'Fall 2002'	, 'Spring 2002'
				);
//--------------- Session Function ----------
$loopsession = array (
						array('id'=>9, 'name'=>'Fall 2019')		, 
						array('id'=>9, 'name'=>'Spring 2019')	, 
						array('id'=>8, 'name'=>'Fall 2018')		, 
						array('id'=>7, 'name'=>'Spring 2018')	, 
						array('id'=>6, 'name'=>'Fall 2017')		, 
						array('id'=>5, 'name'=>'Spring 2017')	, 
						array('id'=>4, 'name'=>'Fall 2016')		, 
						array('id'=>3, 'name'=>'Spring 2016')	,					
						array('id'=>2, 'name'=>'Fall 2015')		,
						array('id'=>1, 'name'=>'Spring 2015')
				   );

function get_loopsession($id) {

	$listloopsession = array (
							'10' => 'Fall 2019'		,
							'9' => 'Spring 2019'	,
							'8' => 'Fall 2018'		,
							'7' => 'Spring 2018'	,
							'6' => 'Fall 2017'		, 
							'5' => 'Spring 2017'	, 
							'4' => 'Fall 2016'		, 
							'3' => 'Spring 2016'	,
							'2' => 'Fall 2015'		,
							'1' => 'Spring 2015'
						  );
	return $listloopsession[$id];

}
//--------------- Daily Logs Status ----------
$logstatus = array (
						array('id'=>1, 'name'=>'New')		, 
						array('id'=>2, 'name'=>'Open')		, 
						array('id'=>3, 'name'=>'Close')		, 
						array('id'=>4, 'name'=>'Delivered')	, 
						array('id'=>5, 'name'=>'Verified')	, 
						array('id'=>6, 'name'=>'Pending')	,					
						array('id'=>7, 'name'=>'Rejected')
				   );

function get_logstatus($id) {

	$listlogstatus = array (
							'1' => '<span class="label label-success" id="bns-status-badge">New</span>'		,
							'2' => '<span class="label label-success" id="bns-status-badge">Open</span>'	,
							'3' => '<span class="label label-warning" id="bns-status-badge">Close</span>'	, 
							'4' => '<span class="label label-info" id="bns-status-badge">Delivered</span>'	, 
							'5' => '<span class="label label-info" id="bns-status-badge">Verified</span>'	, 
							'6' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'	,
							'7' => '<span class="label label-danger" id="bns-status-badge">Rejected</span>'
						  );
	return $listlogstatus[$id];

}

//--------------- Fee Setup Status ----------
$feeperiod = array (
						array('id'=>4, 'name'=>'Monthly')		, 
						array('id'=>3, 'name'=>'Semester')		, 
						array('id'=>2, 'name'=>'Yearly')		, 
						array('id'=>1, 'name'=>'Once')	
				   );

function get_feeperiod($id) {

	$listfeeperiod = array (
							'4' => 'Monthly'		,
							'3' => 'Semester'		,
							'2' => 'Yearly'		, 
							'1' => 'Once'	
						  );
	return $listfeeperiod[$id];

}
//--------------- Daily Logs Types ----------
$logtypes = array (
						array('id'=>1, 'name'=>'Registered')		, 
						array('id'=>2, 'name'=>'Unregistered')		
				   );

function get_logtypes($id) {

	$listlogtypes = array (
							'1' => 'Registered'		,
							'2' => 'Unregistered'	
						  );
	return $listlogtypes[$id];

}

//--------------- Exam Term----------
$examterm = array (
						array('id'=>1, 'name'=>'Mid Term')		, 
						array('id'=>2, 'name'=>'Final Term')		
				   );

function get_examterm($id) {

	$listexamterm = array (
							'1' => 'Mid Term'		,
							'2' => 'Final Term'	
						  );
	return $listexamterm[$id];

}

//--------------- Exam Date Sheet----------
$datesheet = array (
						array('id'=>1, 'name'=>'Mid Term')		, 
						array('id'=>2, 'name'=>'Final Term')	, 
						array('id'=>3, 'name'=>'Summer')		
				   );

function get_datesheet($id) {

	$listdatesheet = array (
							'1' => 'Mid Term'		,
							'2' => 'Final Term'		,
							'2' => 'Summer'	
						  );
	return $listdatesheet[$id];

}

//--------------- Theory  Practical----------
$theorypractical = array (
						array('id'=>1, 'name'=>'Theory')		, 
						array('id'=>2, 'name'=>'Practical')		
				   );

function get_theorypractical($id) {

	$listtheorypractical = array (
							'1' => 'Theory'		,
							'2' => 'Practical'	
						  );
	return $listtheorypractical[$id];

}
//--------------- Room Types ----------
$roomtypes = array (
						array('id'=>1, 'name'=>'Students')		, 
						array('id'=>2, 'name'=>'Staffs')		,
						array('id'=>3, 'name'=>'Guest Room')
				   );

function get_roomtypes($id) {

	$listroomtypes = array (
							'1' => 'Students'		,
							'2' => 'Staffs'			,
							'3' => 'Guests Room'	
						  );
	return $listroomtypes[$id];

}


//--------------- roletypes ----------
$roletypes = array (
						array('id'=>1,  'name'=>'Admissions')			, 
						array('id'=>15, 'name'=>'Online Admissions')	,
						array('id'=>2,  'name'=>'Academic')			,
						array('id'=>13,  'name'=>'Summer')			,
						array('id'=>12,  'name'=>'Examination')		,
						array('id'=>3,  'name'=>'Human Resource')	,
						array('id'=>4,  'name'=>'Fee')				,
						array('id'=>14,  'name'=>'Salary')			,
						array('id'=>5,  'name'=>'Library')			,
						array('id'=>6,  'name'=>'Hostel')			,
						array('id'=>7,  'name'=>'Students Affairs')	,
						array('id'=>8,  'name'=>'Setting')			,
						array('id'=>9,  'name'=>'Timetable')		,
						array('id'=>10, 'name'=>'Finance')			,
						array('id'=>11, 'name'=>'QEC')
				   );

function get_roletypes($id) {

	$listroletypes = array (
							'1'  => 'Admissions'			,
							'2'  => 'Academic'				,
							'3'  => 'Human Resource'		,
							'4'  => 'Fee'					,
							'5'  => 'Library'				,
							'6'  => 'Hostel'				,
							'7'  => 'Students Affairs'		,
							'8'  => 'Setting'				,
							'9'  => 'Timetable'				,
							'10' => 'Finance'				,
							'11' => 'QEC'					,
							'12' => 'Examination'			,
							'13' => 'Summer'				,
							'14' => 'Salary'				,
							'15' => 'Online Admissions'
							
						  );
	return $listroletypes[$id];

}
//--------------- Degree Transcript Issue type ----------
$issueto = array (
						array('id'=>1, 'name'=>'Him/Her Self')		, 
						array('id'=>2, 'name'=>'Others')	
				   );

function get_issueto($id) {

	$listissueto = array (
							'1' => '<span class="label label-success" id="bns-status-badge">Him/Her Self</span>'	, 
							'2' => '<span class="label label-info" id="bns-status-badge">Others</span>'	
						  );
	return $listissueto[$id];

}
//--------------- Religion ----------
$religion = array('Muslim', 'Christian', 'Hindu', 'Sikh', 'Buddhist', 'Jewish', 'Parsi', 'Other', 'Non-Mulsim');
//--------------- Gender ----------
$gender = array('Female', 'Male');
//--------------- Marital Status ----------
$marital = array('Married', 'Single');
//--------------- Sections ----------
$sections = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
//----------------Blood Groups------------------------------
$bloodgroup = array('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-');
//--------------- Open With ----------
$fileopenwith = array('Adobe Acrobat Reader', 'MS Excel', 'MS Paint', 'MS Powerpoint', 'MS Word', 'WinRAR', 'WinZip');
//---------------------------------------
/*function cleanvars($str) {
		$str = trim($str);
		$str = mysql_escape_string($str);

	return($str);
}
*/
function cleanvars($str){ 
	return is_array($str) ? array_map('cleanvars', $str) : str_replace("\\", "\\\\", htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES)); 
}

function generateSeoURL($string, $wordLimit = 0){
    $separator = '-';
    
    if($wordLimit != 0){
        $wordArr = explode(' ', $string);
        $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
    }

    $quoteSeparator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;'                    => '',
        '[^\w\d _-]'            => '',
        '\s+'                    => $separator,
        '('.$quoteSeparator.')+'=> $separator
    );

    $string = strip_tags($string);
    foreach ($trans as $key => $val){
        $string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);
    }

    $string = strtolower($string);

    return trim(trim($string, $separator));
}
//----------------------------------------
function to_seo_url($str){
   // if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
      //  $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
    $str = trim($str, '-');
    return $str;
}
//-------Rupees in Word-------------------------------
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

//-------find working day--------------------------
function get_workingday($date){
	 if(date('l', strtotime($date)) == 'Sunday') { 
		$duedatefinal  	= date('Y-m-d', strtotime('1 days', strtotime($date)));
	} else if(date('l', strtotime($date)) == 'Saturday') { 
		$duedatefinal  	= date('Y-m-d', strtotime('2 days', strtotime($date)));
	} else { 
		$duedatefinal  	= $date;
	}
 return $duedatefinal; 
}

//--------------- No of days----------
function get_noofdays($id) {

	$listnoofdays = array (
							'2' => '75'	, 
							'3' => '50'	, 
							'4' => '40'	, 
							'5' => '30'	
						  );
	return $listnoofdays[$id];

}

//--------------- Log File Action----------
function get_logfile($id) {

	$listlogfile = array (
							'1' => 'Add'		, 
							'2' => 'Update'		, 
							'3' => 'Delete'	
						  );
	return $listlogfile[$id];

}
//--------------- Name of Days ----------
$daysname = array (
					'Monday',
					'Tuesday',
					'Wednesday',
					'Thursday',
					'Friday'
				);
				
$daysname2 = array (
					'Monday'		,
					'Tuesday'		,
					'Wednesday'		,
					'Thursday'		,
					'Friday'		,
					'Saturday'
				);				
$dayweekend = array (
					'Friday',
					'Saturday',
					'Sunday'
				);
$weekdays = array (
					'Monday'		,
					'Tuesday'		,
					'Wednesday'		,
					'Thursday'		,
					'Friday'		,
					'Saturday'		,
					'Sunday'
				);
//--------------- Class Room types ----------
$classroomtypes = array (
							array('id'=>1, 'name'=>'Lecture Room')		, 
							array('id'=>2, 'name'=>'Lab')				,
							array('id'=>3, 'name'=>'Board Room')		,
							array('id'=>4, 'name'=>'Auditorium')		,
							array('id'=>5, 'name'=>'Conference Room')	,
							array('id'=>6, 'name'=>'Center Room')		,
							array('id'=>7, 'name'=>'Marquee 1')			,
							array('id'=>8, 'name'=>'Marquee 2')				
				  		);

function get_classroomtypes($id) {

	$listclassroomtypes	= array (
									'1' => 'Lecture Room'		, 
									'2' => 'Lab'				,
									'3' => 'Board Room'			,
									'4' => 'Auditorium'			,
									'5' => 'Conference Room'	,
									'6' => 'Center Room'		,
									'7' => 'Marquee 1'			,
									'8' => 'Marquee 2'		
						  		);
	return $listclassroomtypes[$id];

}

//--------------- Login Types ------------------
$logintypes = array (
					array('id'=>1, 'name'=>'Staffs')		,
					array('id'=>2, 'name'=>'Teachers')		,
					array('id'=>3, 'name'=>'Students')		,
					array('id'=>4, 'name'=>'Parents')
				   );

function get_logintypes($id) {
	$listlogintypes = array (
							'1'	=> 'Staffs'				,
							'2'	=> 'Teachers'			,
							'3'	=> 'Students'			,
							'4'	=> 'Parents'
							);
	return $listlogintypes[$id];
}

//---------------------- QEC ------------------------------------

//--------------- Evaluation Options ------------------
$evaluationoptions = array (
								array('id'=>5, 'name'=>'Strongly Agree')			,
								array('id'=>4, 'name'=>'Agree')						,
								array('id'=>3, 'name'=>'Neutral / No Opinion')		,
								array('id'=>2, 'name'=>'Disagree')					,
								array('id'=>1, 'name'=>'Strongly Disagree')
						   );

function get_evaluationoptions($id) {
	$listevaluationoptions = array (
									'5'	=> 'Strongly Agree'					,
									'4'	=> 'Agree'							,
									'3'	=> 'Neutral / No Opinion'			,
									'2'	=> 'Disagree'						,
									'1'	=> 'Strongly Disagree'
								);
	return $listevaluationoptions[$id];
}


//--------------- Survey of PHD ------------------
$surveyphd = array (
					array('id'=>'1', 'name'=>'General Information')		,
					array('id'=>'2', 'name'=>'Faculty Resources')		,
					array('id'=>'3', 'name'=>'Research Output')			,
					array('id'=>'4', 'name'=>'Student Information')		,
					array('id'=>'5', 'name'=>'Program Information')		,
					array('id'=>'6', 'name'=>'Additional Information')
				   );

function get_surveyphd($id) {
	$listsurveyphd = array (
									'1'	=> 'General Information'	,
									'2'	=> 'Faculty Resources'		,
									'3'	=> 'Research Output'		,
									'4'	=> 'Student Information'	,
									'5'	=> 'Program Information'	,
									'6'	=> 'Additional Information'
								);
	return $listsurveyphd[$id];
}

//--------------- Survey of Graduating Students ------------------
$surveyoptions = array (
								array('id'=>'A', 'name'=>'Very satisfied')		,
								array('id'=>'B', 'name'=>'Satisfied')			,
								array('id'=>'C', 'name'=>'Uncertain')			,
								array('id'=>'D', 'name'=>'Dissatisfied')		,
								array('id'=>'E', 'name'=>'Very dissatisfied')
						   );

function get_surveyoptions($id) {
	$listsurveyoptions = array (
									'A'	=> 'Very satisfied'						,
									'B'	=> 'Satisfied'							,
									'C'	=> 'Uncertain'							,
									'D'	=> 'Dissatisied'						,
									'E'	=> 'Very dissatisfied'
								);
	return $listsurveyoptions[$id];
}

//--------------- Date Formats ------------------
$dateformat = array (
					array('value'=>'d-m-Y'	, 'name'=>'DD-MM-YYYY')		,
					array('value'=>'d/m/Y'	, 'name'=>'DD/MM/YYYY')		,
					array('value'=>'d/m/y'	, 'name'=>'DD/MM/YY')		,
					array('value'=>'m/d/y'	, 'name'=>'MM/DD/YYYY')		,
					array('value'=>'m-d-y'	, 'name'=>'MM-DD-YYYY')		,
					array('value'=>'Y-m-d'	, 'name'=>'YYYY-MM-DD')
				   );

//--------------- Arrary Search ------------------
function arrayKeyValueSearch($array, $key, $value)
{
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }
        foreach ($array as $subArray) {
            $results = array_merge($results, arrayKeyValueSearch($subArray, $key, $value));
        }
    }
    return $results;
}
//--------------- todo priority ------------------
$todopriority = array (
						array('id'=>1, 'name'=>'Low')			, 
						array('id'=>2, 'name'=>'Medium')		, 
						array('id'=>3, 'name'=>'High')	
				   );

function get_todopriority($id) {
	$listtodopriority = array (
							'1' => '<span class="label label-success" id="bns-status-badge">Low</span>'		, 
							'2' => '<span class="label label-info" id="bns-status-badge">Medium</span>'		, 
							'3' => '<span class="label label-warning" id="bns-status-badge">High</span>'	
						  );
	return $listtodopriority[$id];
}

//--------------- publishtype ------------------
$publishtype = array (
						array('id'=>1, 'name'=>'Book')			, 
						array('id'=>2, 'name'=>'Article')		, 
						array('id'=>3, 'name'=>'Report')	
				   );

function get_publishtype($id) {
	$listpublishtype = array (
							'1' => 'Book'		, 
							'2' => 'Article'	, 
							'3' => 'Report'	
						  );
	return $listpublishtype[$id];
}

//--------------- Challan Type ------------------
$challantype = array (
						array('id'=>4, 'name'=>'Online Admission')
				   );

function get_challantype($id) {
	$listchallantype = array (
							'4' => 'Online Admission'	
						  );
	return $listchallantype[$id];
}

//--------------- Levels ------------------
$levels = array (
						array('id'=>1, 'name'=>'Beginner')			, 
						array('id'=>2, 'name'=>'Intermediate')		, 
						array('id'=>3, 'name'=>'Expert')	
				   );

function get_levels($id) {
	$listlevels = array (
							'1' => '<span class="label label-success" id="bns-status-badge">Beginner</span>'		, 
							'2' => '<span class="label label-info" id="bns-status-badge">Intermediate</span>'		, 
							'3' => '<span class="label label-warning" id="bns-status-badge">Expert</span>'	
						  );
	return $listlevels[$id];
}


//--------------- Get Uploaded file size ------------------
function formatSizeUnits($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}
	return $bytes;
}
//--------------- Generate Random Password ------------------
function generatePassword( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
//--------------- Generate Spcee Free String ------------------
function generateregno($string, $wordLimit = 0){
    $separator = '';
    
    if($wordLimit != 0){
        $wordArr = explode(' ', $string);
        $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
    }

    $quoteSeparator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;'                  => '',
        '[^\w\d _-]'           	 => '',
        '\s+'                    => $separator,
        '('.$quoteSeparator.')+'=> $separator
    );

    $string = strip_tags($string);
    foreach ($trans as $key => $val){
        $string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);
    }

    $string = strtolower($string);

    return trim(trim($string, $separator));
}

//--------------- Current Page Url ------------------
function currentPageURL() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}


//--------------- addOrdinalNumberSuffix ------------------
function addOrdinalNumberSuffix($num) {
	if (!in_array(($num % 100),array(11,12,13))){
		switch ($num % 10) {
	// Handle 1st, 2nd, 3rd
			case 1:  return $num.'st';
			case 2:  return $num.'nd';
			case 3:  return $num.'rd';
		}
	}
	return $num.'th';
}

//-----------------------------------------
function thousandsCurrencyFormat($num) {

  if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

  }

  return $num;
}

function print_number_count($number) {
    $units = array( '', 'K', 'M', 'B');
    $power = $number > 0 ? floor(log($number, 1000)) : 0;
    if($power > 0)
        return @number_format($number / pow(1000, $power), 2, ',', ' ').' '.$units[$power];
    else
        return @number_format($number / pow(1000, $power), 0, '', '');
}
//---------------Remove multiple space with single--------------------------
function removeWhiteSpace($text) {
    $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
    $text = preg_replace('/([\s])\1+/', ' ', $text);
    $text = trim($text);
    return $text;
}
//---------------Months Names--------------------------
$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December');

//---------------------------------------
function generateCode($characters) { 
    $possible = '234567-89ABCDEFGHJKLMNPQR-STUVWXYZabcdefghijklmnopqrstuvwxyz-'; 
    $possible = $possible.$possible.'2345678923456789'; 
    $code = ''; 
    $i = 0; 
    while ($i < $characters) {  
      $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1); 
      $i++; 
    } 
    return $code; 
  }

//--------------- Admin Rights ----------
$adminright = array (
					array('id'=>1,  'name'=>'Add'),
					array('id'=>2,  'name'=>'Edit'),
					array('id'=>3,  'name'=>'View'),
					array('id'=>4,  'name'=>'Delete')
   					);

function get_adminright($id) {
$listadminright = array (
						'1'		=> 'Add',
						'2'		=> 'Edit',
						'3'		=> 'View',
						'4'		=> 'Delete'
						);
return $listadminright[$id];
}

?>
