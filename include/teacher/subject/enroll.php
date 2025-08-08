<?php
echo '
<header class="panel-heading bg-primary">
    <a href=""><p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Enrolled Students List - '.$value_detail['class_name'].' ('.$value_detail['section_name'].')</p></a>
</header>
<hr/>
<div class="panel-body">';
//---------------------------------------------
include_once('enroll/list.php');
//---------------------------------------------
echo '
</div>';