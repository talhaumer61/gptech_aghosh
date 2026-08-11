<?php
// RECORD ADDED
if (isset($_POST['submit_scheme'])) {
	$con 	= array(
						 'select' 		=> 'id'
						,'where' 		=> array(
													 'id_type' 		=> 3
													,'is_deleted' 	=> 0
													,'id_exam' 		=> cleanvars($_POST['id_exam'])
													,'id_class' 	=> cleanvars($_POST['id_class'])
													,'id_session' 	=> cleanvars($_POST['id_session'])
											)
						,'return_type'	=> 'count'
	);
	if ($dblms->getRows(EXAM_DOWNLOADS, $con)) {
		errorMsg('Error','Record Already Exists','error');
		header("Location: ".moduleName(true).".php", true, 301);
		exit();
	} else {
		$values = array (
							 'status'		=>	cleanvars($_POST['status'])
							,'id_type'		=>	3
							,'id_exam'		=>	cleanvars($_POST['id_exam'])
							,'id_class'		=>	cleanvars($_POST['id_class'])
							,'note'			=>	cleanvars($_POST['note'])
							,'id_session'	=>	cleanvars($_POST['id_session'])
							,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'	=>	date('Y-m-d G:i:s')
		);
		$sqllms = $dblms->insert(EXAM_DOWNLOADS, $values);
		
		if ($sqllms) {

			$lastestid = $dblms->lastestid();

			if (!empty($_FILES['file']['name'])) {
				$extension 		= strtolower(pathinfo($_FILES["file"]["name"])['extension']);
				$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'].'-'.$_POST['id_month'])).'_'.$lastestid.'.'.$extension;
				$img_dir 		= 'uploads/assessment_downloads/';
				$originalImage	= $img_dir.$img_fileName;
				if (in_array($extension, array('pdf', 'ppt', 'docx'))) {
					$values = array( 'file' =>	$img_fileName );
					$uploadfile = $dblms->Update(EXAM_DOWNLOADS,$values,"WHERE id = ".cleanvars($lastestid));
					unset($uploadfile);
					move_uploaded_file($_FILES['file']['tmp_name'], $originalImage);
					chmod($originalImage, octdec('0644'));
				}
			}
		
			sendRemark(moduleName(false).' Added','1',$lastestid);
			errorMsg('Successfully','Record Successfully Added','success');
			header("Location: ".moduleName(true).".php", true, 301);
			exit();
		}
	}
}
// RECORD UPDATED
if (isset($_POST['changes_scheme'])) {
	$values = array (
						 'status'		=>	cleanvars($_POST['status'])
						,'id_exam'		=>	cleanvars($_POST['id_exam'])
						,'id_class'		=>	cleanvars($_POST['id_class'])
						,'note'			=>	cleanvars($_POST['note'])
						,'id_session'	=>	cleanvars($_POST['id_session'])
						,'id_modify'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'date_modify'	=>	date('Y-m-d G:i:s')
					);
	$sqllms = $dblms->Update(EXAM_DOWNLOADS,$values,"WHERE id = ".cleanvars($_POST['id']));

	if ($sqllms) {

		$lastestid = $_POST['id'];

		if (!empty($_FILES['file']['name'])) {
			$extension 		= strtolower(pathinfo($_FILES["file"]["name"])['extension']);
			$img_fileName	= to_seo_url(cleanvars($_POST['id_session'].'-'.$_POST['id_class'].'-'.$_POST['id_month'])).'_'.$lastestid.'.'.$extension;
			$img_dir 		= 'uploads/assessment_downloads/';
			$originalImage	= $img_dir.$img_fileName;
			if (in_array($extension, array('pdf', 'ppt', 'docx'))) {
				$values = array( 'file' =>	$img_fileName );
				$uploadfile = $dblms->Update(EXAM_DOWNLOADS,$values,"WHERE id = ".cleanvars($lastestid));
				unset($uploadfile);
				move_uploaded_file($_FILES['file']['tmp_name'], $originalImage);
				chmod($originalImage, octdec('0644'));
			}
		}

		sendRemark(moduleName(false).' Updated','2',$id);
		errorMsg('Successfully','Record Successfully Updated','success');
		header("Location: ".moduleName(true).".php", true, 301);
		exit();
	}
}
// RECORD DELETED
if(isset($_GET['deleteid'])){
	$values = array (
						 'is_deleted'	=>	1
						,'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'ip_deleted'	=>	$ip
						,'date_deleted'	=>	date('Y-m-d G:i:s')
					);
	$sqllms = $dblms->Update(EXAM_DOWNLOADS,$values,"WHERE id = ".cleanvars($_GET['deleteid']));
	if($sqllms){ 
		sendRemark(moduleName(false).' Deleted','3',$id);
		errorMsg('Warning','Record Successfully Deleted.','warning');
		header("Location: ".moduleName(true).".php", true, 301);
		exit();
	}
}
?>