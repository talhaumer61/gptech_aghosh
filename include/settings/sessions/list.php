<?php 
echo '
<div class="col-md-7">
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title">Sessions List</h2>
	</header>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed mb-none">
<thead>
	<tr>
		<th> Sessions </th>
		<th> Date </th>
		<th> Status </th>
		<th> Action </th>
	</tr>
</thead>
<tbody>
<tr>
	<td> 2018-2019 </td>
	<th> 05/06/2017 </th>
	<td><span class="label label-primary"> Running Session </span></td>
<td>
<!-- SESSIONS UPDATE  LINK -->
<a class="modal-with-move-anim-pvs btn btn-primary btn-xs" href="#schoolyear1"><i class="glyphicon glyphicon-edit"></i> Edit</a>
<!-- EDIT MODAL FORM -->
<div id="schoolyear1" class="mfp-with-anim modal-block modal-block-primary mfp-hide">
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form role="form" action="sessions/maintain/edit/1" method="post" class="validate">
					<header class="panel-heading">
						<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit</h2>
					</header>
					<div class="panel-body">
						<div class="form-group mb-sm ">
							<label class="control-label">
								Sessions <span class="required">*</span>
							</label>
							<input type="text" class="form-control" required title="Must Be Required" value="2018-2019" name="sessionyear" />
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="submit" class="btn btn-primary">Update</button>
								<button class="btn btn-default modal-dismiss">Cancel</button>
							</div>
						</div>
					</footer>
				</form>
			</section>
		</div>
	</div>
</div>
<!-- SESSIONS DELETE LINK -->
<a href="#" class="btn btn-danger btn-xs" disabled=""> <i class="fa fa-trash"></i></a>
</td>
</tr>
<tr>
	<td> 2019-2020 </td>
	<th> 21/04/2017 </th>
	<td></td>
<td>
<!-- SESSIONS UPDATE  LINK -->
<a class="modal-with-move-anim-pvs btn btn-primary btn-xs" href="#schoolyear3"><i class="glyphicon glyphicon-edit"></i> Edit</a>
<!-- EDIT MODAL FORM -->
<div id="schoolyear3" class="mfp-with-anim modal-block modal-block-primary mfp-hide">
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form role="form" action="sessions/maintain/edit/3" method="post" class="validate">
					<header class="panel-heading">
						<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit</h2>
					</header>
					<div class="panel-body">
						<div class="form-group mb-sm ">
							<label class="control-label">
								Sessions <span class="required">*</span>
							</label>
							<input type="text" class="form-control" required title="Must Be Required" value="2019-2020" name="sessionyear" />
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="submit" class="btn btn-primary">Update</button>
								<button class="btn btn-default modal-dismiss">Cancel</button>
							</div>
						</div>
					</footer>
				</form>
			</section>
		</div>
	</div>
</div>
<!-- SESSIONS DELETE LINK -->
	<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'Sessions/maintain/delete/3\');"><i class="fa fa-trash"></i></a>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</section>
</div>';