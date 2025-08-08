<?php 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">
		<a href="#make_parent"  class="modal-with-move-anim btn btn-primary btn-xs pull-right">
			<i class="fa fa-plus-square"></i> Make Parent		</a>
		<h2 class="panel-title"><i class="fa fa-user"></i> Guardian List</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none table_default">
			<thead>
				<tr>
					<th width="80">Photo</th>
					<th>Guardian Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Relation</th>
					<th>User Status</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
								<tr>
					<td class="center"><img src="uploads/parent_image/1.jpg"width="35" height="35" />
					<td>Krishna Ray</td>
					<td>parent@rudras.com</td>
					<td>+1-1724-904347</td>
					<td>Father</td>
					<td>
						<input type="checkbox" id="1" data-size="mini" checked name="user_id" >
					</td>
					<td>
					    <!-- PARENT UPDATE LINK -->
						<a href="parents/profile/1" class="btn btn-primary btn-xs" data-toggle="tooltip"
						data-original-title="Profile / Edit"> 
						<i class="el el-user"></i>
						</a>

					    <!-- PARENT DELETE LINK -->
						<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'parents/maintain/delete/1\');"> 
							<i class="el el-trash"></i>
						</a>
					</td>
				</tr>
								<tr>
					<td class="center"><img src="uploads/parent_image/2.jpg"width="35" height="35" />
					<td>Xander Rowe</td>
					<td>monlu@hotmail.com</td>
					<td>+1-99-2431654</td>
					<td>Father</td>
					<td>
						<input type="checkbox" id="2" data-size="mini" checked name="user_id" >
					</td>
					<td>
					    <!-- PARENT UPDATE LINK -->
						<a href="parents/profile/2" class="btn btn-primary btn-xs" data-toggle="tooltip"
						data-original-title="Profile / Edit"> 
						<i class="el el-user"></i>
						</a>

					    <!-- PARENT DELETE LINK -->
						<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'parents/maintain/delete/2\');"> 
							<i class="el el-trash"></i>
						</a>
					</td>
				</tr>
								<tr>
					<td class="center"><img src="uploads/parent_image/3.jpg"width="35" height="35" />
					<td>John doe</td>
					<td>john@hotmail.com</td>
					<td>+784-80-9980251</td>
					<td>Father</td>
					<td>
						<input type="checkbox" id="3" data-size="mini" checked name="user_id" >
					</td>
					<td>
					    <!-- PARENT UPDATE LINK -->
						<a href="parents/profile/3" class="btn btn-primary btn-xs" data-toggle="tooltip"
						data-original-title="Profile / Edit"> 
						<i class="el el-user"></i>
						</a>

					    <!-- PARENT DELETE LINK -->
						<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'parents/maintain/delete/3\');"> 
							<i class="el el-trash"></i>
						</a>
					</td>
				</tr>
							</tbody>
		</table>
	</div>
</section>';