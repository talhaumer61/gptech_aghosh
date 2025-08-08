<?php
if(isset($_GET['id'])){
//-----------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '54', 'edit' => '1'))){ 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.sal_id, s.sal_status, s.receipt_no, s.sal_total_amount, s.dated, s.id_customers, s.note, p.id, p.id_purchase, p.id_sale, p.total_amount, SUM(p.paid_amount) as total_paid, p.payable, c.campus_name	 
                                FROM ".INVENTORY_SALE." s
                                INNER JOIN ".INVENTORY_SALE_PAYABLE." p ON p.id_sale = s.sal_id 
                                INNER JOIN ".CAMPUS." c ON c.campus_id = s.id_customers   
                                WHERE s.sal_id ='".$_GET['id']."' AND s.sal_status != '6' ORDER BY p.id DESC ");
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
$sqllms_invoice	= $dblms->querylms("SELECT pur_receipt_no, pur_pay_invoice
                                FROM ".INVENTORY_PURCHASE."  
                                WHERE pur_id ='".$rowsvalues['id_purchase']."' AND id_campus='".$rowsvalues['id_customers']."' LIMIT 1");
//-----------------------------------------------------
$rowsvalues_invoice = mysqli_fetch_array($sqllms_invoice);
//-----------------------------------------------------
$sqllms_det	= $dblms->querylms("SELECT d.id_setup, d.id_item, d.qty, d.unit_price, i.item_name, i.school_price	 
                                    FROM ".INVENTORY_SALE_DETAIL." d
                                    INNER JOIN ".INVENTORY_ITEMS." i ON i.item_id =  d.id_item
                                    WHERE d.id_setup ='".$_GET['id']."' ");
//-----------------------------------------------------
echo '
<form action="stationary_sale.php" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate">
    <section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Update Sale </h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title"><i class="glyphicon glyphicon-list"></i> Items</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row mb-md">
                            <input type="hidden" name="sal_id" value="'.$rowsvalues['sal_id'].'">
                            <input type="hidden" name="id" value="'.$rowsvalues['id'].'">
                            <input type="hidden" name="pur_id" value="'.$rowsvalues['id_purchase'].'">';
                            //-----------------------------------------------------
                            while($values_det = mysqli_fetch_array($sqllms_det))
                            //-----------------------------------------------------
                            {
                                $item_price = $values_det['school_price'] * $values_det['qty'];
                            echo'
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Item</label>
                                    <input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price" type="text" value="'.$values_det['item_name'].'" readonly>
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Unit Price</label>
                                    <input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price" type="number" value="'.$values_det['school_price'].'" readonly>
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Qunatity</label>
                                    <input class="form-control" name="qty[]" placeholder="Quantity" id="qty" type="number" value="'.$values_det['qty'].'" readonly>
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <label for="radioExample2">Price</label>
                                    <input class="total form-control" name="price[]" placeholder="Price" id="price" type="number" value="'.$item_price.'" readonly>
                                </div>';
                            }
                            echo'
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Payment Invoice </h2>
                        </header>
                        <div class="panel-body">
                            <div class="form-group mt-sm">';
                                if($rowsvalues_invoice['pur_pay_invoice']) { 
                                    echo'
                                    <div class="fileinput-new text-center">
                                        <img src="uploads/images/purchases/campus/'.$rowsvalues_invoice['pur_pay_invoice'].'" alt="invoice" class="rounded img-responsive" style="width: 500px; height: auto;">
                                    </div>' ;
                                } else {
                                    echo'<h4 class="text-center">Receipt not attached yet.</h4>';
                                }
                                echo'
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-6">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Sale Detail</h2>
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
                                        <td colspan="2">Campus</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="" readonly="" value="'.$rowsvalues['campus_name'].'">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Receipt Number</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <input type="text" class="form-control" name="pur_receipt_no" readonly="" value="'.$rowsvalues['receipt_no'].'" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Purchase Note</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                <textarea class="form-control" name="pur_note" readonly>'.$rowsvalues['note'].'</textarea>
                                            </div>
                                        </td>
                                    </tr>';
                                    $rem_amount = $rowsvalues['total_amount'] - $rowsvalues['paid_amount'];
                                    echo'
                                    <tr>
                                        <td colspan="2">Total Amount</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="text" class="form-control" name="total_amount" readonly="" id="total_amount" value="'.$rowsvalues['total_amount'].'">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                         <td colspan="2">Paid </td>
                                         <td class="text-left">
                                             <div class="input-group">
                                                 <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                 <input type="text" class="form-control" name="paid_amount" value="'.$rowsvalues['total_paid'].'" readonly>
                                             </div>
                                         </td>
                                    </tr>
                                    <tr class="b-top-none">
                                         <td colspan="2">Pay Amount</td>
                                         <td class="text-left">
                                             <div class="input-group">
                                                 <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                 <input type="text" class="form-control" name="now_pay_amount" ">
                                             </div>
                                         </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Remianning </td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="text" class="form-control" name="" readonly="" value="'.$rem_amount.'">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Payable Amount</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="text" class="form-control" name="payable" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="b-top-none">
                                        <td colspan="2">Purchase Status</td>
                                        <td class="text-left">
                                            <div class="input-group">
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="sal_status" name="sal_status"'; if($rowsvalues['sal_status'] == '2'){echo'checked';} echo' value="2">
                                                    <label for="radioExample2">Onhold</label>
                                                </div>
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="sal_status" name="sal_status"'; if($rowsvalues['sal_status'] == '3'){echo'checked';} echo' value="3">
                                                    <label for="radioExample2">Accepted</label>
                                                </div>
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="sal_status" name="sal_status"'; if($rowsvalues['sal_status'] == '4'){echo'checked';} echo' value="4">
                                                    <label for="radioExample2">Dispatched</label>
                                                </div>
                                                <div class="radio-custom radio-inline">
                                                    <input type="radio" id="sal_status" name="sal_status"'; if($rowsvalues['sal_status'] == '5'){echo'checked';} echo' value="5">
                                                    <label for="radioExample2">Delivered</label>
                                                </div>
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
            <button type="submit" name="change_sale" class="btn btn-primary"> Update Sale </button>
        </div>
    </section>
</form>';
}else{
    header("location: stationary_sale.php");
}
}
?>