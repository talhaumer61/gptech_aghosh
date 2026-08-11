<?php
if(isset($_GET['id'])){
//-----------------------------------------------------   
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'edit' => '1'))){ 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT pur_id, pur_status, pur_receipt_no, pur_total_amount, dated, id_supplier, pur_note	 
                                FROM ".INVENTORY_PURCHASE."
                                WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND pur_id='".$_GET['id']."' ");
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
$sqllms_det	= $dblms->querylms("SELECT id_setup, id_item, qty, unit_price	 
                                FROM ".INVENTORY_PUR_DETAIL."
                                WHERE id_setup ='".$_GET['id']."' ");
//-----------------------------------------------------
echo '
<form action="stationary_purchase.php" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
    <section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Update Purchase</h2>
        </header>
        <div class="panel-body">
            <input type="hidden" name="pur_id" value="'.$_GET['id'].'">
            <div class="row mb-lg">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Supplier <span class="required">*</span></label>
                        <select data-plugin-selectTwo data-width="100%" id="id_supplier" name="id_supplier" onchange="get_deptemployee(this.value)" required title="Must Be Required" class="form-control populate">
                            <option value="">Select</option>';
                            //-----------------------------------------------------
                            $sqllmssupp	= $dblms->querylms("SELECT supplier_id, supplier_name  
                                                                        FROM ".INVENTORY_SUPPLIERS." 
                                                                        WHERE supplier_status = '1' ORDER BY supplier_name ASC");
                            //-----------------------------------------------------
                            while($value_supp = mysqli_fetch_array($sqllmssupp)) {
                                if($value_supp['supplier_id'] == $rowsvalues['id_supplier']){
                                    echo'<option value="'.$value_supp['supplier_id'].'" selected>'.$value_supp['supplier_name'].'</option>';
                                    
                                }else{
                                    echo'<option value="'.$value_supp['supplier_id'].'">'.$value_supp['supplier_name'].'</option>';
                                }
                            }
                            //-----------------------------------------------------
                            echo'
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Select</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row">';
                            //-----------------------------------------------------
                            $srno = 0;
                            //-----------------------------------------------------
                            while($values_det = mysqli_fetch_array($sqllms_det))
                            //-----------------------------------------------------
                            {
                                $srno++;
                            echo'
                                <div class="col-sm-3 mt-md">
                                    <select  data-width="100%" id="id_item" onchange="get_itemprice(this.value,'.$srno.')" name="id_item[]" required title="Must Be Required" class="id_item form-control populate">
                                        <option value="">Select Item</option>';
                                        //-----------------------------------------------------
                                        $sqllmssitem	= $dblms->querylms("SELECT item_id, item_name  
                                                                                    FROM ".INVENTORY_ITEMS." 
                                                                                    WHERE item_status = '1' ORDER BY item_name ASC");
                                        //-----------------------------------------------------
                                        while($value_item = mysqli_fetch_array($sqllmssitem)) {
                                            if($value_item['item_id'] == $values_det['id_item']){
                                                echo'<option value="'.$value_item['item_id'].'" selected>'.$value_item['item_name'].'</option>';
                                            } else{
                                                echo'<option value="'.$value_item['item_id'].'">'.$value_item['item_name'].'</option>';
                                            }
                                        }
                                        //-----------------------------------------------------
                                        $item_price = $values_det['unit_price'] * $values_det['qty'];
                                        echo'
                                    </select>
                                </div>
                                <div id="getprice_'.$srno.'">
                                <div class="col-sm-3 mt-md">
                                    <input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price" type="number" value="'.$values_det['unit_price'].'" readonly>
                                </div>
                                <div class="col-sm-2 mt-md">
                                    <input class="form-control" name="qty[]" placeholder="Quantity" id="qty" type="number" value="'.$values_det['qty'].'">
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <input class="total form-control" name="price[]" placeholder="Price" id="price" type="number" value="'.$item_price.'" readonly>
                                </div>
                                </div>
                                ';
                            }
                            echo'
                            </div>
                            <div class="row addline">
                                <div class="col-sm-3 mt-md">
                                    <select data-width="100%" id="id_item" name="id_item[]" class="form-control populate id_item" required title="Must Be Required" onchange="get_itemprice(this.value)">
                                        <option value="">Select Item</option>';
                                        //-----------------------------------------------------
                                        $sqllmssupp	= $dblms->querylms("SELECT item_id, item_name  
                                                                                    FROM ".INVENTORY_ITEMS." 
                                                                                    WHERE item_status = '1' ORDER BY item_name ASC");
                                        //-----------------------------------------------------
                                        while($value_supp = mysqli_fetch_array($sqllmssupp)) {
                                                echo'<option value="'.$value_supp['item_id'].'">'.$value_supp['item_name'].'</option>';
                                        }
                                        //-----------------------------------------------------
                                        echo'
                                    </select>
                                </div>
                                <div id="getprice">
                                    <div class="col-sm-3 mt-md">
                                        <input class="form-control" name="unit_price[]" id="unit_price" placeholder="Unit Price" type="number" readonly>
                                    </div>
                                    <div class="col-sm-2 mt-md">
                                        <input class="form-control" name="qty[]" id="qty" onchange="Multiply()"  placeholder="Quantity" type="number" autocomplete="off">
                                    </div>
                                    <div class="col-sm-3 mt-md">
                                        <input class="total form-control" name="price[]" placeholder="Price" id="price" type="number">
                                    </div>
                                </div>
                                <div class="col-sm-1 mt-md text-center"><button type="button" class="btn btn-danger removeAL" ><i class="fa fa-times"></i> </button></div>
                            </div>
                                
                            <div id="add_new_line"></div>
                            <button type="button" class="btn btn-default float-right mt-md" onclick="add_more_item()"><i class="fa fa-plus"></i> Add More</button>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-6">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Purchse Detail</h2>
                        </header>
                        <div class="panel-body">
                            <table class="table h5 text-dark">
                                <tbody>
                                    <tr class="b-top-none">
                                        <td colspan="2">Receipt Number</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <input type="text" class="form-control" name="pur_receipt_no" value="'.$rowsvalues['pur_receipt_no'].'">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Purchase Note</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <textarea class="form-control" name="pur_note">'.$rowsvalues['pur_note'].'</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr class="b-top-none">
                                        <td colspan="2">Purchase Status</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="pur_status" name="pur_status"'; if($rowsvalues['pur_status'] == '1'){echo'checked';} echo' value="1">
                                                    <label for="radioExample2">Pending</label>
                                                </div>
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="pur_status" name="pur_status"'; if($rowsvalues['pur_status'] == '4'){echo'checked';} echo' value="4">
                                                    <label for="radioExample2">Dispatched</label>
                                                </div>
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="pur_status" name="pur_status"'; if($rowsvalues['pur_status'] == '5'){echo'checked';} echo' value="5">
                                                    <label for="radioExample2">Delivered</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="h4">
                                        <td colspan="2">Total Amount</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="text" class="form-control" name="pur_total_amount" readonly="" id="total_amount" value="'.$rowsvalues['pur_total_amount'].'">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button type="submit" id="changes_purchase" name="changes_purchase" class="btn btn-primary"> Update Puchase </button>
        </div>
    </section>
</form>
<script>
    var i = '.$srno.';
</script>
';
?>
    <!-- <script type="text/javascript">
        function add_more_item() {
            var add_new = $('<div class="row"> <?php 
                // echo' <div class="col-sm-3 mt-md"> <select data-plugin-selectTwo data-width="100%" id="id_item" name="id_item[]" onchange="get_deptemployee(this.value)" required title="Must Be Required" class="form-control populate"> <option value="">Select Item</option>'; $sqllmssupp	= $dblms->querylms("SELECT item_id, item_name FROM ".INVENTORY_ITEMS."  WHERE item_status = '1' ORDER BY item_name ASC"); while($value_supp = mysqli_fetch_array($sqllmssupp)) { echo'<option value="'.$value_supp['item_id'].'">'.$value_supp['item_name'].'</option>'; }echo' </select> </div>';?>\n\
                                                           <div class="col-sm-3 mt-md"><input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price" type="number"></div>\n\
                                                           <div class="col-sm-2 mt-md"> <input class="form-control" name="qty[]" placeholder="Quantity" id="qty" type="number"></div>\n\
                                                           <div class="col-sm-3 mt-md"><input class="total form-control" name="unit_price[]" placeholder="Price" id="unit_price" type="number"></div>\n\
                                                           <div class="col-sm-1 mt-md text-center"><button type="button" class="btn btn-danger removeAL" ><i class="fa fa-times"></i> </button></div></div></div> ');
            $("#add_new_line").append( add_new );x
        }

        $("#add_new_line").on('click', '.removeAL', function () {
            $(this).parent().parent().remove();
            check_sum();
        });
        
        $(document).on("change", function () {
            check_sum();
        });
        
        function check_sum() {
            var sum = 0;
            $(".total").each(function () {
                sum += +$(this).val();
            });
            $("#total_amount").val(sum);
        }
    </script>
<?php
}
echo '
</div>
</div>';
}
else{
    header("location: stationary_purchase.php");
}
?>
<script type="text/javascript">
    
    // print invoice function
        function PrintElem(elem)
    {
        Popup($(elem).html());
    }
	
    function Popup(data)
    {
        var mywindow = window.open();
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/stylesheets/invoice-print.css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
    }
</script> -->

<script type="text/javascript">

        // var i=0;
        function add_more_item() {
            i++;
            var add_new = $(".addline").clone();
            
            add_new.removeClass("addline");

            add_new.find("input").each(function() {
            $(this).val('');  });

            
            add_new.find('#getprice').attr("id","getprice"+"_"+i);
            add_new.find('.id_item').attr("onchange","get_itemprice(this.value,"+ i + ")");
            // add_new.find('.id_item').remove();
            // add_new.find('.id_item').select2('destroy');
            add_new.find('.id_item').select2();
            add_new.find('.id_item').select2('val', '');
           $("#add_new_line").append( add_new );
        }

        $("#add_new_line").on('click', '.removeAL', function () {
            if(i > 0){
                i--;
                $(this).parent().parent().remove();
                check_sum();
                // Multiply();
            }
        });

        
        $(document).on("change", function () {
            check_sum();
        });
        
        function check_sum() {
            var sum = 0;
            $(".total").each(function () {
                sum += +$(this).val();
            });
            $("#total_amount").val(sum);
        }
    </script>

<script type="text/javascript">
    function get_itemprice(id_item,i) {
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_item_price.php",
			data: "id_item="+id_item+"&i="+i,  
			success: function(msg){  
                if(i){
                    $("#getprice"+"_"+i).html(msg);
                } else {
                    $("#getprice").html(msg);                 
                }
				 
				$("#loading").html(''); 
			}
		});  
	}

    // print invoice function
        function PrintElem(elem)
    {
        Popup($(elem).html());
    }
	
    function Popup(data)
    {
        var mywindow = window.open();
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/stylesheets/invoice-print.css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
    }
</script>


<?php 
//-----------------------------------------------
echo '
</section>';
?>