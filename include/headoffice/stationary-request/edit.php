<?php
if(isset($_GET['id'])){
//-----------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'edit' => '1'))){ 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT pur_id, pur_status, pur_pay_invoice, pur_receipt_no, pur_total_amount, dated, id_supplier, pur_note, id_campus	 
                                FROM ".INVENTORY_PURCHASE."
                                WHERE pur_id='".$_GET['id']."' ");
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
if($rowsvalues['pur_status'] == '1'){
//-----------------------------------------------------
$sqllms_det	= $dblms->querylms("SELECT d.id_setup, d.id_item, d.qty, d.unit_price, i.item_id, i.item_name, i.school_price	 
                                FROM ".INVENTORY_PUR_DETAIL." d
                                INNER JOIN ".INVENTORY_ITEMS." i ON i.item_id = d.id_item
                                WHERE d.id_setup ='".$_GET['id']."' ");
//-----------------------------------------------------
echo '
<form action="stationary_request.php" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate">
    <section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Update Stationary Request</h2>
        </header>
        <div class="panel-body">
        <input type="hidden" name="pur_id" value="'.$_GET['id'].'">
        <input type="hidden" name="id_campus" value="'.$rowsvalues['id_campus'].'">
        <input type="hidden" name="pur_receipt_no" value="'.$rowsvalues['pur_receipt_no'].'">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Items</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row mb-md">';
                            $srno = 0;
                            //-----------------------------------------------------
                            while($values_det = mysqli_fetch_array($sqllms_det))
                            //-----------------------------------------------------
                            {
                                $item_price = $values_det['qty'] *$values_det['unit_price'];
                                echo'
                                <div class="col-sm-3 mt-md">
                                    <input type="hidden" name="id_item[]" value="'.$values_det['item_id'].'">
                                    <label for="radioExample2">Item</label>
                                    <input class="form-control" type="text" name="item_name[]" value="'.$values_det['item_name'].'" readonly>
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Unit Price</label>
                                    <input class="form-control" type="number" name="unit_price[]" value="'.$values_det['unit_price'].'" readonly>
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Qunatity</label>
                                    <input class="form-control" type="number" name="qty[]" value="'.$values_det['qty'].'" readonly>
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Price</label>
                                    <input class="total form-control" type="number" name="" value="'.$item_price.'" readonly>
                                </div>
                                ';

                            }
                            echo'
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-offset-6">
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
                                                <input type="text" class="form-control" name="pur_receipt_no" readonly="" value="'.$rowsvalues['pur_receipt_no'].'" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Purchase Note</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <textarea class="form-control" name="pur_note" readonly>'.$rowsvalues['pur_note'].'</textarea>
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
                                                    <input type="radio" id="pur_status" name="pur_status"'; if($rowsvalues['pur_status'] == '2'){echo'checked';} echo' value="2">
                                                    <label for="radioExample2">Onhold</label>
                                                </div>
                                                <div class="radio-custom radio-inline" style="margin-bottom: 5px;">
                                                    <input type="radio" id="pur_status" name="pur_status"'; if($rowsvalues['pur_status'] == '3'){echo'checked';} echo' value="3">
                                                    <label for="radioExample2">Accepted</label>
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
            <button type="submit" id="changes_request" name="changes_request" class="btn btn-primary"> Update </button>
        </div>
    </section>
</form>';
}
}
else{
    header("Location: stationary_request.php");
}
}
//-----------------------------------------------
?>