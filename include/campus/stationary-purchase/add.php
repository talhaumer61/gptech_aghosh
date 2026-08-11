<?php
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'add' => '1'))){ 
//-----------------------------------------------
$sqllms_pur	= $dblms->querylms("SELECT count(pur_id) as purchases  FROM ".INVENTORY_PURCHASE."  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'");
$value_pur = mysqli_fetch_array($sqllms_pur);
//-----------------------------------------------
$date = date("Y-m-d");
$purchase_no = $value_pur['purchases'];
//-----------------------------------------------
$receipt_no = "LHS-".$_SESSION['userlogininfo']['LOGINCAMPUS']."-".$purchase_no." ";
//-----------------------------------------------
echo '
<form action="stationary_purchase.php" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
    <section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Purchase</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title"> Select</h2>
                        </header>
                        <div class="panel-body">
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
                                        <input class="total form-control" name="price[]" placeholder="Price" id="price" type="number" readonly>
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
                                        <td colspan="2">Supplier</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="" readonly="" value="LHS Head Office">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Receipt Number</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <input type="text" class="form-control" name="pur_receipt_no" readonly="" value="'.$receipt_no.'">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Purchase Note</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <textarea class="form-control" name="pur_note"></textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="h4">
                                        <td colspan="2">Total Amount</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="text" class="form-control" name="pur_total_amount" readonly="" id="total_amount" value="0">
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
            <button type="submit" id="make_purchase" name="make_purchase" class="btn btn-primary"> Confirm Puchase </button>
        </div>
    </section>
</form>';
?>
    <script type="text/javascript">
        // A $( document ).ready() block.
        $( document ).ready(function() {
            // $('.id_item').select2();
            // console.log( "ready!" );
        });

        
    </script>
    <script type="text/javascript">

        var i=0;
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
<?php
}
else{
	header("Location: stationary_purchase.php");
}
echo '
</div>
</div>';
?>
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