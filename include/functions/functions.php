<?php 
//--------------- Status ------------------
$admstatus = array (
						  array('id'=>1, 'name'=>'Active')
						, array('id'=>2, 'name'=>'Inactive')
				   );

function get_admstatus($id) {
	$listadmstatus= array (
							'1' => '<span class="label label-primary">Active</span>', 
							'2' => '<span class="label label-warning">Inactive</span>');
	return $listadmstatus[$id];
}

//--------------- Authority ------------------
$authority  = array (
							array('id'=>1, 'name'=>'Chairman Office')
						  , array('id'=>2, 'name'=>'Director Aghsoh Complex')
						  , array('id'=>3, 'name'=>'Principal / V.Principal')
					);

function get_authority($id) {
	$list = array (
						  '1' => 'Chairman Office'
						, '2' => 'Director Aghsoh Complex'
						, '3' => 'Principal / V.Principal'
				  );
	return $list[$id];
}


$depositBankAccounts = array (
								 // array('id_bank'=>'1', 'bank_code'=>'HBL', 			'bank_account_no'=>'1589-790-210-9303')
								// , array('id_bank'=>'2', 'bank_code'=>'MBL', 			'bank_account_no'=>'0293-010-4141000')
								// , array('id_bank'=>'3', 'bank_code'=>'BAF', 			'bank_account_no'=>'5510-500-150-3958')
								 array('id_bank'=>'4', 'bank_code'=>'ABL', 			'bank_account_no'=>'0010027282250031')
								, array('id_bank'=>'5', 'bank_code'=>'Cash Payment',	'bank_account_no'=>'')
								// , array('id_bank'=>'6', 'bank_code'=>'FINJA', 			'bank_account_no'=>'0294-0104146639')
							);
function get_depositBankAccounts($id) {
$liststdstatus= array (
		'4' => 'ABL (0010027282250031)'	, 
		'5' => 'Cash Payment'	
	);
return $liststdstatus[$id];
}
//Get Array's Column and ID value
function getColumnValue($array, $columnName, $index) {
	$columnValues = array_column($array, $columnName);
	$index = ($index-1);
	if (isset($columnValues[$index])) {
		return $columnValues[$index];
	}
	return null; // Or you can handle the case when the index is out of range
}
//--------------- Student Status ------------------
$stdstatus = array (
	array('id'=>1, 'name'=>'Active')		,
	array('id'=>2, 'name'=>'Inactive')		,
	array('id'=>3, 'name'=>'Stuck Off')		,
	array('id'=>4, 'name'=>'Student Left')	,
	array('id'=>5, 'name'=>'Completed')
);

function get_stdstatus($id) {
$liststdstatus= array (
		'1' => '<span class="label label-primary">Active</span>'	, 
		'2' => '<span class="label label-warning">Inactive</span>'	, 
		'3' => '<span class="label label-danger">Stuck Off</span>'	, 
		'4' => '<span class="label label-info">Student Left</span>'	, 
		'5' => '<span class="label label-success">Completed</span>'
	);
return $liststdstatus[$id];
}

//--------------- Notification Status ------------------
$status = array (
	array('id'=>1, 'name'=>'Yes'), array('id'=>2, 'name'=>'No')
);

function get_notification($id) {
	$listnote= array (
			'1' => '<span class="label label-success">Yes</span>', 
			'2' => '<span class="label label-warning">No</span>'
		);
	return $listnote[$id];
}
//--------------- Status ------------------
$status = array (
						array('id'=>1, 'name'=>'Active'), array('id'=>2, 'name'=>'Inactive')
				   );

function get_status($id) {
	$liststatus= array (
							'1' => '<span class="label label-primary">Active</span>', 
							'2' => '<span class="label label-warning">Inactive</span>');
	return $liststatus[$id];
}
//--------------- Leave Status ------------------
$status = array (
	array('id'=>1, 'name'=>'Approved'), array('id'=>2, 'name'=>'Pending'), array('id'=>3, 'name'=>'Rejected')
);

function get_leave($id) {
	$liststatus= array (
			'1' => '<span class="label label-success">Approved</span>', 
			'2' => '<span class="label label-warning">Pending</span>', 
			'3' => '<span class="label label-danger">Rejected</span>');
	return $liststatus[$id];
}
//--------------- Challan Types ------------------
$challanType = array (
	array('id'=>1, 'name'=>'Admission'), array('id'=>2, 'name'=>'Fee'), array('id'=>3, 'name'=>'Donation')
);

function get_challantype($id) {
$listChallanType= array (
		'1' => 'Admission', 
		'2' => 'Fee', 
		'3' => 'Donation');
return $listChallanType[$id];
}

//--------------- Donation Type ------------------
$donationType = array (
	array('id'=>1, 'name'=>'Sadka'),
	array('id'=>2, 'name'=>'Zakat'),
	array('id'=>3, 'name'=>'Other')
);

function get_donType($id) {
	$listDonType = array (
						'1' => 'Sadka'	, 
						'2' => 'Zakat'	,
						'3' => 'Other'	
						);
	return $listDonType[$id];
}

//--------------- Payments Status ------------------
$payments = array (
						array('id'=>1, 'name'=>'Paid')		, 
						array('id'=>2, 'name'=>'Pending')	, 
						array('id'=>3, 'name'=>'Unpaid')	,
						array('id'=>4, 'name'=>'Partial Paid')
				   );

function get_payments($id) {
	$listpayments = array (
							'1' => '<span class="label label-success" id="bns-status-badge">Paid</span>'		, 
							'2' => '<span class="label label-warning" id="bns-status-badge">Pending</span>'		,
							'3' => '<span class="label label-danger" id="bns-status-badge">Unpaid</span>'		,
							'4' => '<span class="label label-info" id="bns-status-badge">Partially Paid</span>'
						  );
	return $listpayments[$id];
}

function get_payments1($id) {
	$listpayments = array (
							'1' => 'Paid'		, 
							'2' => 'Pending'	,
							'3' => 'Unpaid'		,
							'4' => 'Partially Paid'
						  );
	return $listpayments[$id];
}
//--------------- Complaint Status ------------------
$status = array (
	array('id'=>1, 'name'=>'Resolved'), array('id'=>2, 'name'=>'Pending'), array('id'=>3, 'name'=>'Rejected')
);

function get_complaint($id) {
$listcomplaint= array (
		'1' => '<span class="label label-success">Resolved</span>', 
		'2' => '<span class="label label-warning">Pending</span>', 
		'3' => '<span class="label label-danger">Rejected</span>');
return $listcomplaint[$id];
}

function get_complaint1($id) {
$listcomplaint= array (
		'1' => 'Resolved', 
		'2' => 'Pending', 
		'3' => 'Rejected');
return $listcomplaint[$id];
}
//--------------- Delivery Status ------------------
$status = array (
					array('id'=>1, 'name'=>'Pending')
				  , array('id'=>2, 'name'=>'Onhold')
				  , array('id'=>3, 'name'=>'Accepted')
				  , array('id'=>4, 'name'=>'Dispatched')
				  , array('id'=>5, 'name'=>'Delivered')
				  , array('id'=>6, 'name'=>'Rejected')
				);

function get_delivery($id) {
	$listdelivery= array (
							'1' => '<span class="label label-dark">Pending</span>'	, 
							'2' => '<span class="label label-warning">Onhold</span>'	, 
							'3' => '<span class="label label-primary">Accepted</span>'	, 
							'4' => '<span class="label label-info">Dispatched</span>'	, 
							'5' => '<span class="label label-success">Delivered</span>'	, 
							'6' => '<span class="label label-danger">Rejected</span>');
	return $listdelivery[$id];
}
//--------------- Guardian ---------------
$guardian = array (
	array('id'=>1, 'name'=>'Father'),
	array('id'=>2, 'name'=>'Mother'),
	array('id'=>3, 'name'=>'Brother'),
	array('id'=>4, 'name'=>'Sister'),
	array('id'=>5, 'name'=>'Uncle'),
	array('id'=>6, 'name'=>'Other')
   );
//--------------- Admins Rights ----------
$admtypes = array (
					array('id'=>1, 'name'=>'Super Admin'),
					array('id'=>2, 'name'=>'Campus Head'),
					array('id'=>3, 'name'=>'Administrator'),
					array('id'=>4, 'name'=>'Accountant'),
					array('id'=>5, 'name'=>'Designer'),
					array('id'=>6, 'name'=>'Simple'),
					array('id'=>7, 'name'=>'Director'),
					array('id'=>8, 'name'=>'Principal'),
					array('id'=>9, 'name'=>'Vice Principal'),
					array('id'=>10, 'name'=>'Hostel Warden')
				   );

function get_admtypes($id) {
	$listadmrights = array (
							'1'	=> 'Super Admin',
							'2'	=> 'Campus Head',
							'3'	=> 'Administrator',
							'4'	=> 'Accountant',
							'5'	=> 'Designer',
							'6'	=> 'Simple',
							'7'	=> 'Director',
							'8'	=> 'Principal',
							'9'	=> 'Vice Principal',
							'10'=> 'Hostel Warden'
							);
	return $listadmrights[$id];
}
//--------------- Status Yes No ----------
$statusyesno = array (
						array('id'=>1, 'name'=>'Yes'), array('id'=>2, 'name'=>'No')
				   );

function get_statusyesno($id) {
	
	$liststatusyesno = array (
								'1'	=> 'Yes',	'2'	=> 'No'
							 );
	return $liststatusyesno[$id];
}

//--------------- Student Type ----------
$studenttype = array (
	array('id'=>1, 'name'=>'Boarder'),
	array('id'=>2, 'name'=>'Day Scholar')
);

function get_studenttype($id) {

$liststudenttype = array (
			'1'	=> 'Boarder',
			'2'	=> 'Day Scholar'
		 );
return $liststudenttype[$id];
}

//--------------- Hostel Type ----------
$hostelype = array (
						array('id'=>1, 'name'=>'Boys'), array('id'=>2, 'name'=>'Girls')
				   );

function get_hostelype($id) {
	
	$listhostelype = array (
								'1'	=> 'Boys',	'2'	=> 'Girls'
							 );
	return $listhostelype[$id];
}
//--------------- Hostel Reg Status ----------
$regStatus = array (
						array('id'=>1, 'name'=>'Active')	,
						array('id'=>2, 'name'=>'Inactive')	,
						array('id'=>3, 'name'=>'Left')		,
						array('id'=>4, 'name'=>'Suspend')	
				   );

function get_regStataus($id) {
	
	$listregStatus = array (
							'1' => '<span class="label label-primary">Active</span>'	, 
							'2' => '<span class="label label-warning">Inactive</span>'	,
							'3' => '<span class="label label-dark">Left</span>'	,
							'4' => '<span class="label label-danger">Suspend</span>'

							 );
	return $listregStatus[$id];
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
//--------------- Subject Type ----------
$subjecttype = array (
						array('id'=>1, 'name'=>'Optional'), array('id'=>2, 'name'=>'Mandatory')
				   );

function get_subjecttype($id) {
	
	$listsubjecttype= array (
							'1' => '<span class="label label-primary">Optional</span>', 
							'2' => '<span class="label label-warning">Mandatory</span>');
	return $listsubjecttype[$id];
}
//--------------- Employee Type ------------------
$emply_type = array (
						array('id'=>1, 'name'=>'Teaching'), array('id'=>2, 'name'=>'Non Teaching')
				   );

function get_emplytype($id) {
	$listemply= array (
							'1' => 'Teaching', 
							'2' => 'Non Teacheing');
	return $listemply[$id];
}
//--------------- Inquiry Type ------------------
$inquirysrc = array (
						array('id'=>1, 'name'=>'Online')
				   );

function get_inquirysrc($id) {
	$lissrc= array (
							'1' => 'Online');
	return $lissrc[$id];
}
//--------------- USer Type ------------------
$userType = array (
						array('id'=>1, 'name'=>'Student'), array('id'=>2, 'name'=>'Employee')
				   );

function get_usertype($id) {
	$listUserType= array (
							'1' => 'Student', 
							'2' => 'Employee');
	return $listUserType[$id];
}

//--------------- Attendce Keywords ----------
$attendtype = array (
					array('id'=>1, 'name'=>'Present'),
					array('id'=>2, 'name'=>'Absent'),
					array('id'=>3, 'name'=>'Holiday'),
					array('id'=>4, 'name'=>'Late')
				   );

function get_attendtype($id) {
	$attendcetype = array (
							'1'	=> '<span class="label label-success">P</span>', 
							'2'	=> '<span class="label label-danger">A</span>', 
							'3'	=> '<span class="label label-primary">H</span>', 
							'4'	=> '<span class="label label-warning">L</span>'
							);
	return $attendcetype[$id];
}

function get_attendtype1($id) {
	$listpayments = array (
							'1' => 'Present'	, 
							'2' => 'Absent'		,
							'3' => 'Holiday'	,
							'4' => 'Late'
						  );
	return $listpayments[$id];
}

//------------- Digital Resources ----------
function get_digitalresource($id) {
	$listdigitalresource = array (
							'1' => 'youtube'	, 
							'2' => 'website'	,
							'3' => 'ebook'		
						  );
	return $listdigitalresource[$id];
}

//------------- Exam Terms ---------------
$termrtypes = array (
					array('id'=>1, 'name'=>'First Term'),
					array('id'=>2, 'name'=>'Second Term')
				   );

function get_term($id) {
	$listterm = array (
						'1' => 'First Term'		, 
						'2' => 'Second Term'		
						);
	return $listterm[$id];
}


//--------------- Concession Type ------------------
$concessionType = array (
	array('id'=>1, 'name'=>'Amount'), array('id'=>2, 'name'=>'Percentage')
);

function get_concessionType($id) {
$listConcession= array (
		'1' => 'Amount', 
		'2' => 'Percentage');
return $listConcession[$id];
}

//--------------- Concession On ------------------
$concessionOn = array (
	array('id'=>1, 'name'=>'Total Package'), array('id'=>2, 'name'=>'Tuition Fee')
);

function get_concessionOn($id) {
$listConcessionOn= array (
		'1' => 'Total Package', 
		'2' => 'Tuition Fee');
return $listConcessionOn[$id];
}

//------------- Exam Assessments ---------------
function get_assessment($id) {
	$listassessment = array (
						'1' => 'Assessment Manual'	, 
						'2' => 'Assessment Policy'	, 
						'3' => 'Assessment Scheme'		
						);
	return $listassessment[$id];
}

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

$summermonth = array (
					array('id'=>3, 'name'=>'March'),
					array('id'=>4, 'name'=>'April'),
					array('id'=>5, 'name'=>'May')
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
//--------------- Month Weeks ----------
$weeks = array (
	array('id'=>1, 'name'=>'Week 1'),
	array('id'=>2, 'name'=>'Week 2'),
	array('id'=>3, 'name'=>'Week 3'),
	array('id'=>4, 'name'=>'Week 4')
   );

function get_week($id) {
$week = array (
			'1'		=> 'Week 1',
			'2'		=> 'Week 2',
			'3'		=> 'Week 3',
			'4'		=> 'Week 4'
			);
return $week[$id];
}
//--------------- Days Keywords ----------
$daytypes = array (
					array('id'=>1, 'name'=>'Monday')	,
					array('id'=>2, 'name'=>'Tuesday')	,
					array('id'=>3, 'name'=>'Wednesday')	,
					array('id'=>4, 'name'=>'Thursday')	,
					array('id'=>5, 'name'=>'Friday')	,
					array('id'=>6, 'name'=>'Saturday')	,
					array('id'=>7, 'name'=>'Sunday')
				   );

function get_daytypes($id) {
	$day = array (
							'1'		=> 'Monday'		,
							'2'		=> 'Tuesday'	,
							'3'		=> 'Wednesday'	,
							'4'		=> 'Thursday'	,
							'5'		=> 'Friday'		,
							'6'		=> 'Saturday'	,
							'7'		=> 'Sunday'
							);
	return $day[$id];
} 

//--------------- Qualifications ----------
$qualtypes = array (
					array('id'=>1, 'name'=>'Bachelors')	,
					array('id'=>2, 'name'=>'Master')	,
					array('id'=>3, 'name'=>'Docrate')	,
					array('id'=>4, 'name'=>'Others')	
				   );

function get_qualtypes($id) {
	$qual = array (
							'1'		=> 'Bachelors'	,
							'2'		=> 'Master'		,
							'3'		=> 'Docrate'	,
							'4'		=> 'Others'
							);
	return $qual[$id];
} 
//--------------- Building ----------
$buildings = array (
					array('id'=>1, 'name'=>'Owned')				,
					array('id'=>2, 'name'=>'Rented')			,
					array('id'=>3, 'name'=>'To be arranged')	
					);
function get_buildings($id) {
	$build = array (
							'1'		=> 'Owned'				,
							'2'		=> 'Rented'				,
							'3'		=> 'To be arranged'		
							);
	return $build[$id];
} 
//--------------- Building Type ----------
$buildingtypes = array (
					array('id'=>1, 'name'=>'Resdential') ,
					array('id'=>2, 'name'=>'Commercial')		
				   );

function get_buildingtypes($id) {
	$building = array (
							'1'		=> 'Resdential'	,
							'2'		=> 'Commercial'		
							);
	return $building[$id];
} 
//--------------- Mediums ----------
$mediumtypes = array (
					array('id'=>1, 'name'=>'Resdential') ,
					array('id'=>2, 'name'=>'Commercial')		
				   );

function get_mediumtypes($id) {
	$medium = array (
							'1'		=> 'English'	,
							'2'		=> 'Urdu'		
							);
	return $medium[$id];
} 
//--------------- Investment Type ----------
$investypes = array (
					array('id'=>1, 'name'=>'Personal') 	  ,
					array('id'=>2, 'name'=>'Partnership') ,
					array('id'=>3, 'name'=>'Bank loan') 		
				   );

function get_investypes($id) {
	$investment = array (
							'1'		=> 'Personal'		,
							'2'		=> 'Partnership'	,
							'3'		=> 'Bank loan'		
							);
	return $investment[$id];
} 
//--------------- Calls ----------
$calltypes = array (
					array('id'=>1, 'name'=>'Incoming') ,
					array('id'=>2, 'name'=>'Out Going')		
				   );

function get_calltypes($id) {
	$calls = array (
							'1'		=> 'Incoming'	,
							'2'		=> 'Out Going'		
							);
	return $calls[$id];
} 
//--------------- Roles ----------
$roletypes = array (
					array('id'=>1,  'name'=>'Admission')	,
					array('id'=>2,  'name'=>'Academic')		,
					array('id'=>3,  'name'=>'Attendance')	,
					array('id'=>4,  'name'=>'Exams')		,
					array('id'=>5,  'name'=>'HR')			,
					array('id'=>6,  'name'=>'Frenchies')	,
					array('id'=>7,  'name'=>'Complaints')	,
					array('id'=>8,  'name'=>'Accounts')		,
					array('id'=>9,  'name'=>'Donation')		,
					array('id'=>10, 'name'=>'Frenchies')	,
					array('id'=>11, 'name'=>'Accounts')		,
					array('id'=>12, 'name'=>'Hostel')		,
					array('id'=>13, 'name'=>'Stationary')	,
					array('id'=>14, 'name'=>'Front Office')	,
					array('id'=>15, 'name'=>'Library')		,
					array('id'=>16, 'name'=>'Awards')		,
					array('id'=>17, 'name'=>'Events')		,
					array('id'=>18, 'name'=>'Admins')		,
					array('id'=>19, 'name'=>'Syllabus')
				   );

function get_roletypes($id) {
	$role = array (
							'1'		=> 'Admission'		,
							'2'		=> 'Academic'		,
							'3'		=> 'Attendance'		,
							'4'		=> 'Exams'			,
							'5'		=> 'HR'				,
							'6'		=> 'Frenchies'		,
							'7'		=> 'Complaints' 	,
							'8'		=> 'Accounts'		,
							'9'		=> 'Donation'		,
							'10'	=> 'Frenchies'		,
							'11'	=> 'Accounts'		,
							'12'	=> 'Hostel'			,
							'13'	=> 'Stationary'		,
							'14'	=> 'Front Office'	,
							'15'	=> 'Library'		,
							'16'	=> 'Awards'			,
							'17'	=> 'Events'			,
							'18'	=> 'Admins'			,
							'19'	=> 'Syllabus'		
							);
	return $role[$id];
}

//--------------- Transcation Type ----------
$transtype = array (
						array('id'=>1, 'name'=>'Credit'), array('id'=>2, 'name'=>'Debit')
				   );

function get_transtype($id) {
	
	$listtranstype = array (
								'1'	=> 'Credit',	'2'	=> 'Debit'
							 );
	return $listtranstype[$id];
}
//--------------- Transcation Method ------------------
$paymethod = array (
						array('id'=>1, 'name'=>'Cash')		,
						array('id'=>2, 'name'=>'Check') 	,
						array('id'=>3, 'name'=>'ABL')		,
						array('id'=>4, 'name'=>'Finja')		,
						array('id'=>5, 'name'=>'Salary')	,
						array('id'=>6, 'name'=>'PayIT')	,
				   );

function get_paymethod($id) {
	$listpaymethod= array (
							'1' => '<span class="label label-primary">Cash</span>'	, 
							'2' => '<span class="label label-warning">Check</span>'	,   
							'3' => '<span class="label label-warning">ABL</span>'	,
							'4' => '<span class="label label-warning">Finja</span>'	,
							'5' => '<span class="label label-warning">Salary</span>',
							'6' => '<span class="label label-danger">PayIT</span>'
						);
	return $listpaymethod[$id];
}

//--------------- Transcation Method ------------------
$feeduration = array (
						array('id'=>1, 'name'=>'Yearly')	,
						array('id'=>2, 'name'=>'Half') 		,
						array('id'=>3, 'name'=>'Quatar') 	,
						array('id'=>4, 'name'=>'Monthly') 	,
						array('id'=>5, 'name'=>'Once')
				   );

function get_feeduration($id) {
	$listfeeduration= array (
							'1' => 'Yearly'	, 
							'2' => 'Half'	, 
							'3' => 'Quatar'	, 
							'4' => 'Monthly', 
							'5' => 'Once' );
	return $listfeeduration[$id];
}
//--------------- Transcation Method ------------------
$refunable = array (
						array('id'=>1, 'name'=>'Refundable')	,
						array('id'=>2, 'name'=>'Non Refundable') 	
				   );

function get_refunable($id) {
	$listrefunable= array (
							'1' => 'Refundable'	, 
							'2' => 'Non Refundable'	 );
	return $listrefunable[$id];
}
//------------- Countries ------------------- 
$country = array (
	array ('id' => '25'     ,'name' => 'Australia'                      ,'nameur' => 'آسٹریلیا'),
	array ('id' => '26'     ,'name' => 'Austria'                        ,'nameur' => 'آسٹریا'),
	array ('id' => '29'     ,'name' => 'Bahrain'                        ,'nameur' => 'بحرین'),
	array ('id' => '5'      ,'name' => 'Bangladesh'                     ,'nameur' => 'بنگلہ دیش'),
	array ('id' => '32'     ,'name' => 'Belgium'                        ,'nameur' => 'بیلجیئم'),
	array ('id' => '3'      ,'name' => 'Canada'                         ,'nameur' => 'کینیڈا'),
	array ('id' => '50'     ,'name' => 'Central-African-Republic'       ,'nameur' => 'افریقہ'),
	array ('id' => '63'     ,'name' => 'Cyprus'                         ,'nameur' => 'قبرص'),
	array ('id' => '6'      ,'name' => 'Denmark'                        ,'nameur' => 'ڈنمارک'),
	array ('id' => '71'     ,'name' => 'Egypt'                          ,'nameur' => 'مصر'),
	array ('id' => '80'     ,'name' => 'Finland'                        ,'nameur' => 'فن لینڈ'),
	array ('id' => '10'     ,'name' => 'France'                         ,'nameur' => 'فرانس'),
	array ('id' => '86'     ,'name' => 'Germany'                        ,'nameur' => 'جرمنی'),
	array ('id' => '89'     ,'name' => 'Greece'                         ,'nameur' => 'یونان'),
	array ('id' => '100'    ,'name' => 'Hong-Kong'                      ,'nameur' => 'ہانگ کانگ'),
	array ('id' => '2'      ,'name' => 'India'                          ,'nameur' => 'انڈیا'),
	array ('id' => '103'    ,'name' => 'Indonesia'                      ,'nameur' => 'انڈونیشیا'),
	array ('id' => '14'     ,'name' => 'Iran'                           ,'nameur' => 'ایران'),
	array ('id' => '105'    ,'name' => 'Ireland'                        ,'nameur' => 'آئرلینڈ'),
	array ('id' => '13'     ,'name' => 'Italy'                          ,'nameur' => 'اٹلی'),
	array ('id' => '232'    ,'name' => 'Japan'                          ,'nameur' => 'جاپان'),
	array ('id' => '108'    ,'name' => 'Jordan'                         ,'nameur' => 'اردن'),
	array ('id' => '110'    ,'name' => 'Kenya'                          ,'nameur' => 'کینیا'),
	array ('id' => '112'    ,'name' => 'Korea'                          ,'nameur' => 'کوریا'),
	array ('id' => '113'    ,'name' => 'Kuwait'                         ,'nameur' => 'کویت'),
	array ('id' => '128'    ,'name' => 'Malaysia'                       ,'nameur' => 'ملائشیا'),
	array ('id' => '148'    ,'name' => 'Netherlands'                    ,'nameur' => 'نیدر لینڈز'),
	array ('id' => '15'     ,'name' => 'New-Zealand'                    ,'nameur' => 'نیوزی لینڈ'),
	array ('id' => '158'    ,'name' => 'Norway'                         ,'nameur' => 'ناروے'),
	array ('id' => '1'      ,'name' => 'Pakistan'                       ,'nameur' => 'پاکستان'),
	array ('id' => '166'    ,'name' => 'Philippines'                    ,'nameur' => 'فلپائن'),
	array ('id' => '186'    ,'name' => 'Somalia'                        ,'nameur' => 'صومالیہ'),
	array ('id' => '187'    ,'name' => 'South-Africa'                   ,'nameur' => 'جنوبی افریقہ'),
	array ('id' => '188'    ,'name' => 'Spain'                          ,'nameur' => 'سپین'),
	array ('id' => '199'    ,'name' => 'Sweden'                         ,'nameur' => 'سویڈن'),
	array ('id' => '200'    ,'name' => 'Switzerland'                    ,'nameur' => 'سویٹزرلینڈ'),
	array ('id' => '201'    ,'name' => 'Syria'                          ,'nameur' => 'شام'),
	array ('id' => '202'    ,'name' => 'Taiwan'                         ,'nameur' => 'تائیوان'),
	array ('id' => '211'    ,'name' => 'Turkey'                         ,'nameur' => 'ترکی'),
	array ('id' => '217'    ,'name' => 'UAE'                            ,'nameur' => 'متحدہ عرب امارات'),
	array ('id' => '8'      ,'name' => 'UK'                             ,'nameur' => 'برطانیہ'),
	array ('id' => '218'    ,'name' => 'USA'                            ,'nameur' => 'امریکہ'),
);

function get_country($id) {
$listCountry = array (
			'1' => 'Pakistan',
			'2' => 'India',
			'3' =>  'Canada',
			'5' =>  'Bangladesh',
			'6' => 'Denmark',
			'8' => 'UK',
			'10'  => 'France',
			'13'  => 'Italy',
			'14'  => 'Iran',
			'15'  => 'New-Zealand',
			'25'  =>  'Australia',
			'26'  => 'Austria',
			'29'  => 'Bahrain',
			'32'  => 'Belgium',
			'50'  => 'Central-African-Republic',
			'63'  => 'Cyprus',
			'71'  => 'Egypt',
			'80'  => 'Finland',
			'86'  => 'Germany',
			'89'  => 'Greece',
			'100' => 'Hong-Kong',
			'103' => 'Indonesia',
			'105' => 'Ireland',
			'108' => 'Jordan',
			'110' => 'Kenya',
			'112' => 'Korea',
			'113' => 'Kuwait',
			'128' => 'Malaysia',
			'148' => 'Netherlands',
			'158' => 'Norway',
			'166' => 'Philippines',
			'186' => 'Somalia',
			'187' => 'South-Africa',
			'188' => 'Spain',
			'199' => 'Sweden',
			'200' => 'Switzerland',
			'201' => 'Syria',
			'202' => 'Taiwan',
			'211' => 'Turkey',
			'217' => 'UAE',
			'218' => 'USA',
			'232' => 'Japan'
			);
	return $listCountry[$id];
}
//--------------- Fee Duration ----------
// $feeduration = array('Yearly', 'Half', 'Quatar', 'Monthly', 'Once');
//--------------- Fee Type ----------
$feetype = array('Refundable', 'Nonrefundable');
//--------------- Gender ----------
$gender = array('Female', 'Male');
//--------------- Religion ----------
$religion = array('Islam', 'Christan', 'Hindu', 'Sikeh', 'Any other');
//--------------- Marital Status ----------
$marital = array('Married', 'Single');
//----------------Blood Groups------------------------------
$bloodgroup = array('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-');
//---------------------------------------
/*function cleanvars($str) {
		$str = trim($str);
		$str = mysql_escape_string($str);

	return($str);
}
*/
function cleanvars($str){ 
	return is_array($str) ? array_map('cleanvars', $str) : str_replace("\\", "\\\\", htmlspecialchars( stripslashes($str), ENT_QUOTES)); 
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
//--------------- Login Types ------------------
$logintypes = array (
	array('id'=>1, 'name'=>'headoffice')	,
	array('id'=>2, 'name'=>'campus')		,
	array('id'=>3, 'name'=>'teacher')		,
	array('id'=>4, 'name'=>'parent')		,
	array('id'=>5, 'name'=>'student')		,
	array('id'=>6, 'name'=>'donor')			,
	array('id'=>7, 'name'=>'coordinator')
);

function get_logintypes($id) {
	$listlogintypes = array (

		'1'	=> 'headoffice'				,
		'2'	=> 'campus'					,
		'3'	=> 'teacher'				,
		'4'	=> 'parent'					,
		'5'	=> 'student'				,
		'6'	=> 'donor'					,
		'7'	=> 'coordinator'
	);
	return $listlogintypes[$id];
}
//--------------- Log File Action----------
function get_logfile($id) {

	$listlogfile = array (
							'1' => 'Add'		, 
							'2' => 'Update'		, 
							'3' => 'Delete'		,
							'4' => 'Login'	
						  );
	return $listlogfile[$id];

}

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

//----------Get Current Url------------------------------
function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
 return $pageURL;
}

// Function to find the difference  between two dates.
function dateDiffInDays($date1, $date2) 
{
    // Calculating the difference in timestamps
    $diff = strtotime($date2) - strtotime($date1);
      
    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return abs(round($diff / 86400));
}

//----------Days Name------------------------------
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); 

//--------------- FEE CHALLAN RIGHTS(USERS) ------------------
$FEE_CHALLAN_RIGHTS = array('4', '324', '326', '327');

//--------------- Class Group List ------------------
$classgroup = array(
	  array('id'=>1, 'name'=>'Aghosh Grammar School')
	, array('id'=>2, 'name'=>'Minhaj College of Management & Technology')
	, array('id'=>3, 'name'=>'Tehfeez')
);

function get_classgroup($id){
	$listclassgroup = array (
		  '1'	=> 'Aghosh Grammar School'
		, '2'	=> 'Minhaj College of Management & Technology'
		, '3'	=> 'Tehfeez'
	);
	return $listclassgroup[$id];
}
function errorMsg($title = "", $msg = "", $color = "") {
	if (!empty($title) && !empty($msg)&& !empty($color))
	{
		$_SESSION['msg']['title'] 	= ''.$title.'';
		$_SESSION['msg']['text'] 	= ''.$msg.'';
		$_SESSION['msg']['type'] 	= ''.$color.'';	
		if (!empty($_SESSION['msg']['title']) && !empty($_SESSION['msg']['text'])&& !empty($_SESSION['msg']['info']))
			return true;	
		else
			return false;	
	}
	else
		return false;	
}
function get_publish($id) {
	$liststatus= array (
							'1' => '<span class="label label-info">Yes</span>', 
							'0' => '<span class="label label-warning">No</span>');
	return $liststatus[$id];
}

function number_million($n) {
	// first strip any formatting;
	$n = (0+str_replace(",", "", $n));

	// is this a number?
	if (!is_numeric($n)) return false;

	// now filter it;
	  if ($n) return round(($n/1000000), 3).' M';
	else {
		return '0.00 M';
	}
	

	return number_format($n);
}



function nice_number($n) {
	// first strip any formatting;
	$n = (0+str_replace(",", "", $n));

	// is this a number?
	if (!is_numeric($n)) return false;

	// now filter it;
	if ($n > 1000000000000) return round(($n/1000000000000), 3).' T';
	elseif ($n > 1000000000) return round(($n/1000000000), 3).' B';
	elseif ($n > 1000000) return round(($n/1000000), 3).' M';
	elseif ($n > 1000) return round(($n/1000), 3).' K';

	return number_format($n);
}

// SCHOOL DEPARTMENT
function get_department($id = ''){
	$listdepartment = array (
								  '1'	=> 'Aghosh'
								, '2'	=> 'Tehfeez'
							);
	if(empty(($id))){
		return $listdepartment;
	}else{
		return $listdepartment[$id];
	}
}

// SEND REMARKS
function sendRemark($remarks = "", $action = "", $id_record = "") {
	if (!empty($remarks) && !empty($action) && !empty($id_record)) {
		require_once("include/dbsetting/lms_vars_config.php");
		require_once("include/dbsetting/classdbconection.php");
		$dblms = new dblms();

		$values = array (
							 'id_user'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'id_record'	=>	cleanvars($id_record)
							,'filename'		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
							,'action'		=>	cleanvars($action)
							,'dated'		=>	date('Y-m-d G:i:s')
							,'ip'			=>	cleanvars(LMS_IP)
							,'remarks'		=>	cleanvars($remarks)
							,'id_campus'	=>	cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
						);
		$sqlRemarks = $dblms->insert(LOGS, $values);
		if ($sqlRemarks) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function moduleName($flag = true) {
	$fileName = strstr(basename($_SERVER['REQUEST_URI']), '.php', true);
	if (gettype($flag) == 'string') {		
		$flag = str_replace('_',' ',$flag);
		$flag = str_replace('-',' ',$flag);
		$flag = ucwords(strtolower($flag));
		return $flag;
	}
	if ($flag) {
		return strtolower($fileName);
	} else {
		$fileName = str_replace('_',' ',$fileName);
		$fileName = str_replace('-',' ',$fileName);
		return ucwords(strtolower($fileName));
	}
}
?>