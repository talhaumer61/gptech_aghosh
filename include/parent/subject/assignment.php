<?php
echo '
<header class="panel-heading bg-primary">
    <p class="text-weight-semibold mt-none" style="font-size: 24px; color:#ffffff;"><i class="fa fa-list"></i> Assignments</p>
</header>
<div class="panel-body">';
//---------------------------------------------
include_once('assignment/list.php');
//---------------------------------------------
echo '
</div>';