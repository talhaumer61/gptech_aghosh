<?php
echo '
<header class="panel-heading bg-primary">
    <p class="text-weight-semibold mt-none" style="font-size: 24px; color:#ffffff;"><i class="fa fa-list"></i> Announcement List</p>
</header>
<div class="panel-body">';
//---------------------------------------------
include_once('announcement/list.php');
//---------------------------------------------
echo '
</div>';