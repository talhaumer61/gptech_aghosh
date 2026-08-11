<?php
echo '
<header class="panel-heading bg-primary">
	<p class="text-weight-semibold mt-none" style="font-size: 24px; color:#ffffff;"><i class="fa fa-list"></i> Attendance</p>
</header>';
//---------------------------------------------
//if(!isset($_POST['view_student']) && !isset($_GET['edit_id'])){
echo '
<div class="panel-body">
';
//}
//---------------------------------------------
include_once('attendance/list.php');
//---------------------------------------------
echo '
</div>';