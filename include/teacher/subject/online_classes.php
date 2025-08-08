<?php
echo '
<header class="panel-heading bg-primary">
    <p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Online Classes - '.$value_detail['class_name'].' ('.$value_detail['section_name'].')</p>
</header>
<header class="panel-heading">
	<a href="#make_onlineclass" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Online Class</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Online Classes List </h2>
</header>
<hr/>
<div class="panel-body">';
//---------------------------------------------
include_once('online_classes/query.php');
include_once('online_classes/list.php');
include_once("include/modals/online_classes/add.php");
//---------------------------------------------
echo '
</div>';