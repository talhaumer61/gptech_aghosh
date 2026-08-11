<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '8', 'added' => '1'))){
echo'
<!-- Print Model -->
<div id="print_subjects" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="subjects-print.php?" target="_blank" class="form-horizontal" id="form" enctype="multipart/form-data" method="GET" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-print"></i>  Print Subjects</h2>
			</header>
			<div class="panel-body">
                <div class="form-group mt-sm mb-xs">
                    <label class="col-md-3 control-label">Class </label>
                    <div class="col-md-9">
                        <select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="cls">
                            <option value="">All Subjects</option>';
                                $sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
                                                    FROM ".CLASSES." 
                                                    WHERE class_status = '1'
                                                    ORDER BY class_id ASC");
                                while($valuecls = mysqli_fetch_array($sqllmscls)) {
                                    echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
                                }
                                echo '
                        </select>
                    </div>
                </div>
                <div class="form-group mt-sm mb-xs">
                    <label class="col-md-3 control-label">Subject Type </label>
                    <div class="col-md-9">
                        <select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="type">
                            <option value="">Both</option>';
                                foreach($subjecttype as $type) {
                                    echo '<option value="'.$type['id'].'">'.$type['name'].'</option>';
                                }
                                echo '
                        </select>
                    </div>
                </div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Print</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}	
else{
	header("Location: dashboard.php");
}
?>