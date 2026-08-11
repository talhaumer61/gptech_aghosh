<?php 
if (isset($_POST['submit_parent'])) {

    $username = cleanvars($_POST['adm_username']);
    $id_campus = $_SESSION['userlogininfo']['LOGINCAMPUS'];
    
    $sqllmsFather = $dblms->querylms("
        SELECT std_fathercnic 
        FROM ".STUDENTS."
        WHERE std_id = '".cleanvars($_POST['id_std'])."'
        LIMIT 1
    ");
    $father = mysqli_fetch_array($sqllmsFather);
    $fatherCNIC = $father['std_fathercnic'];

    // =========================================================
    // 2. CHECK IF USERNAME EXISTS (Ignore is_deleted status)
    // =========================================================
    // We check for the username ONLY. If it exists as is_deleted=1, we must 
    // UPDATE it rather than INSERT to avoid SQL Duplicate Entry errors.
    $sqllmscheck = $dblms->querylms("
        SELECT adm_id, is_deleted 
        FROM ".ADMINS." 
        WHERE adm_username = '$username'
        LIMIT 1
    ");

    // Password Hashing
    $salt = dechex(mt_rand()) . dechex(mt_rand());
    $pass = $_POST['adm_userpass'];
    $password = hash('sha256', $pass . $salt);
    for ($round = 0; $round < 65536; $round++) {
        $password = hash('sha256', $password . $salt);
    }

    $adm_id = 0;

    if (mysqli_num_rows($sqllmscheck)) {
        $row = mysqli_fetch_array($sqllmscheck);
        $adm_id = $row['adm_id'];

        $sqlLinked = $dblms->querylms("SELECT COUNT(*) AS total FROM ".STUDENTS." WHERE id_loginid = '$adm_id'");
        $link = mysqli_fetch_array($sqlLinked);

        if ($row['is_deleted'] == '0' && $link['total'] > 0) {
            // Check if it's linked to a student NOT belonging to this father
            $sqlFamilyCheck = $dblms->querylms("SELECT std_id FROM ".STUDENTS." WHERE id_loginid = '$adm_id' AND std_fathercnic != '$fatherCNIC' LIMIT 1");
            if (mysqli_num_rows($sqlFamilyCheck)) {
                $_SESSION['msg'] = ['title' => 'Error', 'text' => 'Username belongs to another family.', 'type' => 'error'];
                header("Location: parentlogin.php");
                exit();
            }
        }

        // RECLAIM/UPDATE (Solves A -> B -> A scenario)
        $dblms->querylms("
            UPDATE ".ADMINS." SET
                adm_status    = '1',
                adm_logintype = '4',
                adm_salt      = '$salt',
                adm_userpass  = '$password',
                adm_fullname  = '".cleanvars($_POST['adm_fullname'])."',
                adm_email     = '".cleanvars($_POST['adm_email'])."',
                adm_phone     = '".cleanvars($_POST['adm_phone'])."',
                is_deleted    = '0'
            WHERE adm_id = '$adm_id'
        ");
    } else {
        // BRAND NEW USERNAME
        $dblms->querylms("
            INSERT INTO ".ADMINS." (
                adm_status, adm_logintype, adm_username, adm_salt, adm_userpass,
                adm_fullname, adm_email, adm_phone, id_campus
            ) VALUES (
                '1', '4', '$username', '$salt', '$password',
                '".cleanvars($_POST['adm_fullname'])."', '".cleanvars($_POST['adm_email'])."', 
                '".cleanvars($_POST['adm_phone'])."', '$id_campus'
            )
        ");
        $adm_id = $dblms->lastestid();
    }

    // =========================================================
    // 3. CLEANUP & SYNC (The "Killer" Logic)
    // =========================================================
    if ($adm_id > 0) {
        
        // A. Identify any OTHER logins currently held by this family's students
        $oldLogins = $dblms->querylms("
            SELECT DISTINCT id_loginid 
            FROM ".STUDENTS." 
            WHERE std_fathercnic = '$fatherCNIC' 
            AND id_loginid IS NOT NULL 
            AND id_loginid != '$adm_id'
        ");

        while ($old = mysqli_fetch_array($oldLogins)) {
            $oldId = $old['id_loginid'];
            
            // B. Unlink the students from that old login
            $dblms->querylms("UPDATE ".STUDENTS." SET id_loginid = NULL WHERE id_loginid = '$oldId'");

            // C. Deactivate that old login record if no other families are using it
            $checkOrphan = $dblms->querylms("SELECT COUNT(*) AS total FROM ".STUDENTS." WHERE id_loginid = '$oldId'");
            $orphan = mysqli_fetch_array($checkOrphan);
            if ($orphan['total'] == 0) {
                $dblms->querylms("UPDATE ".ADMINS." SET is_deleted = '1', adm_status = '0' WHERE adm_id = '$oldId'");
            }
        }

        // D. FINAL SYNC: Link all siblings to the correct $adm_id
        $dblms->querylms("
            UPDATE ".STUDENTS."
            SET id_loginid = '$adm_id'
            WHERE std_fathercnic = '$fatherCNIC'
        ");

        // LOGGING
        $remarks = "Parent login synced for CNIC: $fatherCNIC. Username: $username";
        $dblms->querylms("INSERT INTO ".LOGS." (id_user, filename, action, dated, ip, remarks, id_campus) 
                          VALUES ('".$_SESSION['userlogininfo']['LOGINIDA']."', 'parent_sync', '2', NOW(), '$ip', '$remarks', '$id_campus')");

        $_SESSION['msg'] = ['title' => 'Success', 'text' => 'Parent login created.', 'type' => 'success'];
        header("Location: parentlogin.php");
        exit();
    }
}


//----------------Admin update reocrd----------------------
if(isset($_POST['changes_parent'])) { 
	
	//------------hashing---------------
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	$pass = $_POST['adm_userpass'];
	$password = hash('sha256', $pass . $salt);
	for ($round = 0; $round < 65536; $round++) {
		$password = hash('sha256', $password . $salt);
	}
	//------------------------------------------------
	$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET  
													  adm_status	= '".cleanvars($_POST['adm_status'])."'
													, adm_salt		= '".cleanvars($salt)."'
													, adm_userpass	= '".cleanvars($password)."'
												WHERE adm_id		= '".cleanvars($_POST['adm_id'])."'");
											  

	//--------------------------------------
	if($sqllms) { 
		//--------------------------------------
		$remarks = 'Update Admin: "'.cleanvars($_POST['adm_username']).'"';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks										, 
															id_campus				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'2'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: parentlogin.php", true, 301);
		exit();
		//--------------------------------------
	}
	//--------------------------------------
}

if(isset($_GET['deleteid'])) {
	$sqllms  = $dblms->querylms("UPDATE ".ADMINS." SET is_deleted = '1', date_deleted = NOW() WHERE adm_id = '".cleanvars($_GET['deleteid'])."' AND adm_logintype = '4' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'");
	
	//--------------------------------------
	if($sqllms) { 
		//--------------------------------------
		$remarks = 'Delete Parent Login ID: "'.cleanvars($_GET['deleteid']).'"';
		$sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
															id_user										, 
															filename									, 
															action										,
															dated										,
															ip											,
															remarks										, 
															id_campus				
														  )
		
													VALUES(
															'".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'	,
															'".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' , 
															'3'											, 
															NOW()										,
															'".cleanvars($ip)."'						,
															'".cleanvars($remarks)."'						,
															'".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
														  )
									");
		//--------------------------------------
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'info';
		header("Location: parentlogin.php", true, 301);
		exit();
		//--------------------------------------
	}
	//--------------------------------------
}
?>