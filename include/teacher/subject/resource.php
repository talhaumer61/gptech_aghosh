<?php
echo '
<header class="panel-heading bg-primary">
    <a href=""><p class="text-weight-semibold mt-none text-center" style="font-size: 24px; color:#ffffff;">Resource - '.$value_detail['class_name'].' ('.$value_detail['section_name'].')</p></a>
</header>
<header class="panel-heading">
	<a href="#make_resource" class="modal-with-move-anim btn btn-primary btn-xs pull-right"><i class="fa fa-plus-square"></i> Make Resource</a>
	<h2 class="panel-title"><i class="fa fa-list"></i> Resource List</h2>
</header>
<hr/>
<div class="panel-body">';
//---------------------------------------------
include_once('resource/query_resource.php');
include_once('resource/list.php');
include_once("include/modals/resources/modal_add.php");
//---------------------------------------------
echo '
</div>';