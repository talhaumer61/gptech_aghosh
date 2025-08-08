  <?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '41', 'added' => '1'))){ 
  echo '
  <!-- Add Modal Box -->
  <div id="make_hostel" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	  <section class="panel panel-featured panel-featured-primary">
		  <form action="stationary-item.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			  <header class="panel-heading">
				  <h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Item</h2>
			  </header>
			  <div class="panel-body">
				  <div class="form-group mt-sm">
					  <label class="col-md-3 control-label">Item Name <span class="required">*</span></label>
					  <div class="col-md-9">
						  <input type="text" class="form-control" name="item_name" id="item_name" required title="Must Be Required"/>
					  </div>
				  </div>
					  <div class="form-group">
			  <label class="col-md-3 control-label">Category Name <span class="required">*</span></label>
			  <div class="col-md-9">
				  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
					  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT cat_id, cat_status, cat_name 
													  FROM ".INVENTORY_CATEGORY."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  AND cat_status = '1'
													  ORDER BY cat_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
					  }
			  echo '
				  </select>
			  </div>
		  </div>
				  <div class="form-group">
					  <label class="col-md-3 control-label">Item Code <span class="required">*</span></label>
					  <div class="col-md-9">
						  <input class="form-control" rows="3" name= "item_code" id="item_code"/>
					  </div>
				  </div>
				  <div class="form-group mb-md">
					  <label class="col-md-3 control-label">Item Detail</label>
					  <div class="col-md-9">
						  <textarea class="form-control" rows="2" name = "item_detail" id="item_detail"></textarea>
					  </div>
				  </div>
				  <div class="form-group">
					  <label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					  <div class="col-md-9">
						  <div class="radio-custom radio-inline">
							  <input type="radio" id="item_status" name="item_status" value="1" checked>
							  <label for="radioExample1">Active</label>
						  </div>
						  <div class="radio-custom radio-inline">
							  <input type="radio" id="item_status" name="item_status" value="2">
							  <label for="radioExample2">Inactive</label>
						  </div>
					  </div>
				  </div>
			  </div>
			  <footer class="panel-footer">
				  <div class="row">
					  <div class="col-md-12 text-right">
						  <button type="submit" class="btn btn-primary" id="submit_item" name="submit_item">Save</button>
						  <button class="btn btn-default modal-dismiss">Cancel</button>
					  </div>
				  </div>
			  </footer>
		  </form>
	  </section>
  </div>';
}
?>