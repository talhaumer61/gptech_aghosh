<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");

echo 'File included successfully.';
ini_set('memory_limit', '-1');
set_time_limit(0);

//--------------------------------------------
// ================= CONFIG ==================
$BATCH_LIMIT = 200;             // 👈 Increased batch limit since it's just an update
$NEW_PASSWORD = 'ags@786';      // 👈 Your new target password
//--------------------------------------------

// 🔐 Hash new password once
$salt = dechex(mt_rand()) . dechex(mt_rand());
$password = hash('sha256', $NEW_PASSWORD . $salt);
for ($i = 0; $i < 65536; $i++) {
    $password = hash('sha256', $password . $salt);
}

echo "<pre>";
echo "===== PARENT PASSWORD UPDATE BATCH =====\n\n";

//--------------------------------------------
// GET PARENTS (adm_logintype = 4)
// We check for parents who AREN'T deleted.
//--------------------------------------------
$qParents = $dblms->querylms("
    SELECT adm_id, adm_username, adm_fullname
    FROM ".ADMINS."
    WHERE adm_logintype = '4' 
    AND is_deleted = '0'
    ORDER BY adm_id ASC
    LIMIT $BATCH_LIMIT
");

if (!mysqli_num_rows($qParents)) {
    echo "✅ No active parent accounts found to update.\n";
    exit;
}

$count = 0;
while ($p = mysqli_fetch_array($qParents)) {

    $adm_id   = $p['adm_id'];
    $username = $p['adm_username'];
    $name     = $p['adm_fullname'];

    //----------------------------------------
    // UPDATE PASSWORD AND SALT
    //----------------------------------------
    $dblms->querylms("
        UPDATE ".ADMINS." SET
            adm_salt      = '$salt',
            adm_userpass  = '$password'
        WHERE adm_id = '$adm_id'
    ");

    echo "🔐 Password Updated: $username ($name)\n";
    $count++;
}

echo "\n----------------------------------------\n";
echo "🎯 Batch Completed. Total Updated: $count\n";
echo "Run the file again to process the next batch if needed.\n";
echo "</pre>";