<?php
echo '
<header class="panel-heading bg-primary">
    <p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Online Classes</p>
</header>
<header class="panel-heading">
	<h2 class="panel-title"><i class="fa fa-list"></i> Online Classes List </h2>
</header>
<hr/>
<div class="panel-body">';
//---------------------------------------------
include_once('online_classes/list.php');
//---------------------------------------------
echo '
</div>';