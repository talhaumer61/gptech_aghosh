<?php 
echo '
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
<header class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-list"></i> Subject List</h3>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped mb-none table_default">
<thead>
	<tr>
		<th width="60">No</th>
		<th>Subject Name</th>
		<th>Subject Code</th>
		<th>Pass/full Mark</th>
		<th>Subject Type</th>
		<th>Subject Author</th>
		<th>Class</th>
		<th>Teacher</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
<tr>
	<td>1</td>
	<td>English</td>
	<td>101</td>
	<td>33 / 100</td>
	<td>Theory</td>
	<td></td>
	<td>One</td>
	<td>Anzo Perez</td>
	<td>
	<!-- SUBJECT UPDATE LINK -->
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/modal_subject_update.php?id=1\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'subject/maintain/delete/1/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
<tr>
	<td>2</td>
	<td>Bangla</td>
	<td>102</td>
	<td>33 / 100</td>
	<td>Theory</td>
	<td></td>
	<td>One</td>
	<td>Anzo Perez</td>
	<td>
	<!-- SUBJECT UPDATE LINK -->
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/modal_subject_update.php?id=1\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'subject/maintain/delete/1/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
<tr>
	<td>3</td>
	<td>Computer</td>
	<td>103</td>
	<td>33 / 100</td>
	<td>Theory</td>
	<td></td>
	<td>One</td>
	<td>Anzo Perez</td>
	<td>
	<!-- SUBJECT UPDATE LINK -->
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/modal_subject_update.php?id=1\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'subject/maintain/delete/1/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
<tr>
	<td>4</td>
	<td>Mathematics</td>
	<td>104</td>
	<td>33 / 100</td>
	<td>Theory</td>
	<td></td>
	<td>One</td>
	<td>Anzo Perez</td>
	<td>
	<!-- SUBJECT UPDATE LINK -->
		<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/modal_subject_update.php?id=1\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	<!-- DELETION LINK -->
		<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'subject/maintain/delete/1/1\');"><i class="el el-trash"></i></a>
	</td>
</tr>
</tbody>
</table>
</div>
</section>';