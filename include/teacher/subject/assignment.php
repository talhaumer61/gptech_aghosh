<?php
echo '
<header class="panel-heading bg-primary">
    <a href=""><p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Assignment - '.$value_detail['class_name'].' ('.$value_detail['section_name'].')</p></a>
</header>
<header class="panel-heading">
	<a href="#make_assignment" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Assignment</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Assignment List</h2>
</header>
<hr/>
<div class="panel-body">';
//---------------------------------------------
include_once('assignment/query_assignment.php');
include_once('assignment/list.php');
include_once("include/modals/assignments/modal_add.php");
//---------------------------------------------
echo '
</div>';