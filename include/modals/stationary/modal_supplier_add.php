	<?php 
 if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'added' => '1'))){ 
    echo '
    <!-- Add Modal Box -->
    <div id="make_supplier" class="zoom-anim-dialog modal-block modal-block-primary modal-dialog modal-xl mfp-hide">
        <section class="panel panel-featured panel-featured-primary">
            <form action="#" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Supplier</h2>
        </header>
        <div class="panel-body">
 <!--<div class="form-group mt-xl">
  <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-6">
          <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-new thumbnail" style="width: 130px; height: 130px;" data-trigger="fileinput">
                  <img src="uploads/default-student.jpg" alt="...">
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 130px"></div>
              <div>
                  <span class="btn btn-xs btn-default btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="emply_photo" accept="image/*">
                  </span>
                  <a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
          </div>
      </div>
      <div class="col-md-2"></div>
  </div>
  </div>-->
  
            <div class="form-group mt-sm">
                <label class="col-md-3 control-label">Supplier Name <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="supplier_name" id="supplier_name" required title="Must Be Required"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Supplier Phone <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="number" class="form-control" required title="Must Be Required" name="supplier_phone" id="supplier_phone"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Supplier Email <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="email" class="form-control" required title="Must Be Required" name="supplier_email" id="supplier_email"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Supplier Address<span class="required">*</span></label>
                <div class="col-md-9">
                    <textarea type="text" class="form-control" required title="Must Be Required" name="supplier_address" id="supplier_address"></textarea>
                </div>
            </div>
            <div class="form-group mt-sm">
                <label class="col-md-3 control-label">Supplier Company <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="supplier_company" id="supplier_company" required title="Must Be Required"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Contact Name <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" required title="Must Be Required" name="supplier_contactname" id="supplier_contactname"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Contact Phone <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" required title="Must Be Required" name="supplier_contactphone" id="supplier_contactphone"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Contact Email <span class="required">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" required title="Must Be Required" name="supplier_contactemail" id="supplier_contactemail"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Status <span class="required">*</span></label>
                <div class="col-md-9">
                    <div class="radio-custom radio-inline">
                        <input type="radio" id="supplier_status" name="supplier_status" value="1" checked>
                        <label for="radioExample1">Active</label>
                    </div>
                    <div class="radio-custom radio-inline">
                        <input type="radio" id="supplier_status" name="supplier_status" value="2">
                        <label for="radioExample2">Inactive</label>
                    </div>
                </div>
            </div>
            
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary" id="submit_supplier" name="submit_supplier">Save</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </form>
    </section>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("form#frm").validate({
                rules: {
                    room_beds: {
                        number: true
                    },
                    room_bedfee: {
                        number: true
                    }
                },
    
                messages: {
                    room_beds: {
                        number: \'Please enter a valid number.\'
                    },
    
                    room_bedfee: {
                        number: \'Please enter a valid number.\'
                    }
                },
    
                errorPlacement: function (error, element) {
                    var placement = element.closest(\'.input-group\');
                    if (!placement.get(0)) {
                        placement = element;
                    }
                    if (error.text() !== \'\') {
                        if (element.parent(\'.checkbox, .radio\').length || element.parent(\'.input-group\').length) {
                            placement.after(error);
                        } else {
                            var placement = element.closest(\'div\');
                            placement.append(error);
                            wrapper: "li"
                        }
                    }
                }
            });
        });
    </script>';
 }
 ?>