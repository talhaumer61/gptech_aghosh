<?php
//Degree/Transcript
function get_stdaffairstypes($id) {

	$liststdaffairstypes= array (
									'1' => 'Transcript'		, 
									'2' => 'Degree'			, 
									'3' => 'Verification'	,
									'4' => 'General'
						  		);
	return $liststdaffairstypes[$id];

}

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
//----------------------------------------
function searchArrayKeyVal($sKey, $id, $array) {
	foreach ($array as $key => $val) {
		if ($val[$sKey] == $id) {
			return $key;
		}
	}
	return null;
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
//----------------------------------------
function url_seo_url($str){
   // if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
      //  $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
   //$str = preg_replace('`&#[^a-zA-Z]+#(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
  // $str = preg_replace(array('`#[^a-zA-Z]+#`i','`[-]+`'), '-', $str);
    $str = trim($str);
    $str = trim($str, '-');
    return $str;
}
//----------------------------------------
function cleanvars($str){ 
	return is_array($str) ? array_map('cleanvars', $str) : str_replace("\\", "\\\\", htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES)); 
}
//----------------------------------------
function curPageURL( $trim_query_string = false ) {
    $pageURL = (isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on') ? "https://" : "http://";
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    if( ! $trim_query_string ) {
        return $pageURL;
    } else {
        $url = explode( '?', $pageURL );
        return $url[0];
    }
}
//----------------------------------------
function generateSeoURL($string, $wordLimit = 0){
    $separator = '-';
    
    if($wordLimit != 0){
        $wordArr = explode(' ', $string);
        $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
    }

    $quoteSeparator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;'                   => '',
        '[^\w\d _-]'            => '',
        '\s+'                    => $separator,
        '('.$quoteSeparator.')+'=> $separator
    );

    $string = strip_tags($string);
    foreach ($trans as $key => $val){
        $string = preg_replace('#'.$key.'#i', $val, $string);
    }

    $string = strtolower($string);

    return trim(trim($string, $separator));
}


//----------------------------------------
function ValidateEmail($email) {
	$regex = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'; # domain extension 
if($email == '') { 
	return false;
} else {
	$eregi = preg_replace($regex, '', $email);
}
return empty($eregi) ? true : false;
}
//----------------------------------------
function dots($max, $string) {
	$string = substr_replace($string, '...', $max, strlen($string));
	return $string;
}

//Salutation 
$salutation = array (
	array('id'=>1,  'name'=>'Mr.')				,
	array('id'=>2,  'name'=>'Mrs.')				,
	array('id'=>3,  'name'=>'Miss.')			,
	array('id'=>4,  'name'=>'Dr.')				,
	array('id'=>5,  'name'=>'Prof.')			,
	array('id'=>6,  'name'=>'Other')
);

function get_Salutation($id) {
	$listSalutation = array (
				'1'	=> 'Mr.'				,
				'2'	=> 'Mrs.'				,
				'3'	=> 'Miss.'				,
				'4'	=> 'Dr.'				,
				'5'	=> 'Prof.'				,
				'6'	=> 'Other'
				);
	return $listSalutation[$id];
}

//WIEFC Confrenece Source
$wiefcSource = array (
	array('id'=>1,  'name'=>'Conference Alert')								,
	array('id'=>2,  'name'=>'Email')										,
	array('id'=>3,  'name'=>'Social Media')									,
	array('id'=>4,  'name'=>'Search on Web')								,
	array('id'=>5,  'name'=>'Advertisement')								,
	array('id'=>6,  'name'=>'Through University / Institution / College')	,
	array('id'=>7,  'name'=>'WhatsApp')										,
	array('id'=>8,  'name'=>'Friend')										,
	array('id'=>9,  'name'=>'Other')
);

function get_WiefcSource($id) {
	$listwiefcSource = array (
				'1'	=> 'Conference Alert'								,
				'2'	=> 'Email'											,
				'3'	=> 'Social Media'									,
				'4'	=> 'Search on Web'									,
				'5'	=> 'Advertisement'									,
				'6'	=> 'Through University / Institution / College'		,
				'7'	=> 'WhatsApp'										,
				'8'	=> 'Friend'											,
				'9'	=> 'Other'
				);
	return $listwiefcSource[$id];
}
//------------ Social Media ---------------------------
$SocialMedia = array (
	array('id'=>19,  'name'=>'Facebook')				,
	array('id'=>28,  'name'=>'Whatsapp')				,
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
			'28'	=> 'Whatsapp'				,
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

//Source of Inquiry
$inquirysrc = array (
	array('id'=>1,  'name'=>'Newspaper Ad.'),
	array('id'=>2,  'name'=>'Through Website'),
	array('id'=>3,  'name'=>'Leaflet'),
	array('id'=>4,  'name'=>'SMS'),
	array('id'=>5,  'name'=>'E-Mail'),
	array('id'=>6,  'name'=>'Social Media'),
	array('id'=>7,  'name'=>'Through a friend'),
	array('id'=>13,  'name'=>'Old Student'),
	array('id'=>8,  'name'=>'Just walked In'),
	array('id'=>10, 'name'=>'TVC/Radio/Cable'),
	array('id'=>11, 'name'=>'Referred by Tehreek Member'),
	array('id'=>12, 'name'=>'Referred by Staff Member'),
	array('id'=>14, 'name'=>'Billboard'),
	array('id'=>15, 'name'=>'Poll Streamer'),
	array('id'=>9,  'name'=>'Other')
   );

function get_inquirysrc($id) {
	$listinquirysrc = array (
				'1'		=> 'Newspaper Ad.',
				'2'		=> 'Through Website',
				'3'		=> 'Leaflet',
				'4'		=> 'SMS',
				'5'		=> 'E-Mail',
				'6'		=> 'Social Media',
				'7'		=> 'Through a friend',
				'8'		=> 'Just walked In',
				'9'		=> 'Other',
				'10'	=> 'TVC/Radio/Cable',
				'11'	=> 'Referred by Tehreek Member',
				'12'	=> 'Referred by Staff Member',
				'13'	=> 'Old Student',
				'14'	=> 'Billboard',
				'15'	=> 'Poll Streamer'
				);
	return $listinquirysrc[$id];
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


//--------------- FAQ Degree Names ------------------
$faqDegreeName = array (
	array('id'=>1	, 'name'=>'Bachelor')		,
	array('id'=>2	, 'name'=>'Master')			,
	array('id'=>3	, 'name'=>'M.Phil / MS')	,
	array('id'=>4	, 'name'=>'Phd')
);

function get_faqDegreeName($id) {
	$listregtypes= array (
			'1' => 'Bachelor'		, 
			'2' => 'Master'			,
			'3' => 'M.Phil / MS'	,
			'4' => 'Phd');
	return $listregtypes[$id];
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


//--------------- program Timing ----------
$programtiming = array (
						array('id'=>1, 'name'=>'Morning')	, 
						array('id'=>2, 'name'=>'Evening')	, 
						array('id'=>3, 'name'=>'Both')
				   );

function get_programtiming($id) {
	
	$listprogramtiming = array (
								'1'	=> 'Morning'			,	
								'2'	=> 'Evening'			,	
								'3'	=> 'Both'
							 );
	return $listprogramtiming[$id];
}

//--------------- Sessions ----------
$session = array(
					'Spring 2018'	,
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
//----------------------------------------
function generateCode($characters) { 
    $possible = '23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    $possible = $possible.$possible.'2345678923456789'; 
    $code = ''; 
    $i = 0; 
    while ($i < $characters) {  
      $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1); 
      $i++; 
    } 
    return $code; 
  }
//------------months name in urdu---------
$monthsname = array (
	array ('id' => '01'		,'name' => 'جنوری'		,'namear' => 'يناير'),
	array ('id' => '02'		,'name' => 'فروری'		,'namear' => 'فبراير'),
	array ('id' => '03'		,'name' => 'مارچ'		,'namear' => 'مارس'),
	array ('id' => '04'		,'name' => 'اپریل'		,'namear' => 'أبريل'),
	array ('id' => '05'		,'name' => 'مئی'		,'namear' => 'مايو'),
	array ('id' => '06'		,'name' => 'جون'		,'namear' => 'يونيو'),
	array ('id' => '07'		,'name' => 'جولائی'		,'namear' => 'يوليو'),
	array ('id' => '08'		,'name' => 'اگست'		,'namear' => 'أغسطس'),
	array ('id' => '09'		,'name' => 'ستمبر'		,'namear' => 'سبتمبر'),
	array ('id' => '10'		,'name' => 'اکتوبر'		,'namear' => 'أكتوبر'),
	array ('id' => '11'		,'name' => 'نومبر'		,'namear' => 'نوفمبر'),
	array ('id' => '12'		,'name' => 'دسمبر'		,'namear' => 'ديسمبر'),
);
//------------week name in urdu---------
$weeksname = array (
	array ('name' => 'Monday'		,'nameur' => 'سوموار'	,'namear' => 'الإثنين'),
	array ('name' => 'Tuesday'		,'nameur' => 'منگل'		,'namear' => 'الثَلاثاء'),
	array ('name' => 'Wednesday'	,'nameur' => 'بدھ'		,'namear' => 'الأربَعاء'),
	array ('name' => 'Thursday'		,'nameur' => 'جمعرات'	,'namear' => 'الخَميس'),
	array ('name' => 'Friday'		,'nameur' => 'جمعہ'		,'namear' => 'الجُمُعة'),
	array ('name' => 'Saturday'		,'nameur' => 'ہفتہ'		,'namear' => 'السَبْت'),
	array ('name' => 'Sunday'		,'nameur' => 'اتوار'	,'namear' => 'الأحَد'),
);
?>