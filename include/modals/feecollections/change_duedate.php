<?php  
echo '
<!-- Add Modal Box -->
<div id="chnage_duedate" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="" class="form-horizontal" id="form" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-calendar"></i> Update Due Date</h2>
			</header>
			<div class="panel-body">
            
				<div class="form-group mb-md">
                    <div class="col-sm-12">
                        <label class="ccontrol-label">Due Date <span class="required"> (Update Of All Pending Challans) *</span></label>
                        <div class="form-group ml-xs mr-xs">
                            <input type="text" class="form-control" name="due_date" id="due_date" data-plugin-datepicker required title="Must Be Required"/>
                        </div>		
                    </div>
                </div>	
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="update_duedate" name="update_duedate">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>