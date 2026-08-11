<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
//--------------------------------------------
if(isset($_POST['id_item'])) {
    $i = $_POST['i'];
	$id_item = $_POST['id_item']; 
//--------------------------------------------
    $sqllmspr	= $dblms->querylms("SELECT school_price 
                        FROM ".INVENTORY_ITEMS."
                        WHERE item_status = '1' AND is_deleted != '1' AND item_id = '".$id_item."' ");
    $valuepr = mysqli_fetch_array($sqllmspr);

        $location = 'price_'.$i;
        echo'
            <div class="col-sm-3 mt-md">
                <input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price_'.$i.'" oninput="multiply()" type="number" value="'.$valuepr['school_price'].'" readonly>
                
            </div>
            <div class="col-sm-2 mt-md">
                <input class="form-control" name="qty[]" id="qty_'.$i.'" oninput="multiply('.$valuepr['school_price'].',this.value, \''.$location.'\')"  placeholder="Quantity" type="number" autocomplete="off" required>
            </div>
            <div class="col-sm-3 mt-md">
                <input class="total form-control" name="price[]" placeholder="Price" id="price_'.$i.'" type="number" readonly>
            </div>
            ';
//---------------------------------------
}
?>
<script type="text/javascript">
    function multiply(unit_price, qty, location ) { 
        var price = (unit_price * qty);
        $("#"+location).val(price);

    }
</script>