<?php
//-----------------------------------------------
if(isset($_GET['pr'])){
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '53', 'view' => '1'))){ 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT pur_id, pur_status, pur_pay_invoice, pur_receipt_no, pur_total_amount, dated, pur_note	 
                                FROM ".INVENTORY_PURCHASE."
                                WHERE pur_id='".$_GET['pr']."' LIMIT 1");
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<section class="panel">
    <div class="panel-body" id="invoice_print">
        <div class="invoice">
            <header class="clearfix">
                <div class="row">
                    <div class="col-sm-4 mt-md">
                        <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Purchase Receipt</h2>
                        <h4 class="h4 m-none text-dark text-weight-bold">#'.$rowsvalues['pur_receipt_no'].'</h4>
                    </div>
                    <div class="col-sm-8 text-right mt-md mb-md">
                        <address class="ib mr-xlg">
                            <span class="text-dark"><b>'.$rowsvalues['campus_name'].'</b></span><br>
                            Total Amount : '.$rowsvalues['pur_total_amount'].'<br>
                            Date : '.date('d M, Y' , strtotime(cleanvars($rowsvalues['dated']))).'<br>  
                            Supplier : LHS Head Office <br>
                            Status : '.get_delivery($rowsvalues['pur_status']).'  
                        </address>
                        <div class="ib">
                            <img src="uploads/logo.png" width="174" height="69" alt="'.TITLE_HEADER.'">
                        </div>
                    </div>
                </div>
            </header>';
            if($rowsvalues['pur_note']){
            echo'
            <div class="bill-info mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <p>'.$rowsvalues['pur_note'].'</p>
                    </div>
                </div>
            </div>';
            }
            echo'
            <div class="row">
                <div class="col-md-12">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Purchase Details</h2>
                        </header>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table invoice-items">
                                    <thead>
                                        <tr class="h5 text-dark">
                                            <th id="cell-id" class="text-weight-semibold">#</th>
                                            <th id="cell-item" class="text-weight-semibold">Item</th>
                                            <th id="cell-desc" class="text-weight-semibold">Unit Price</th>
                                            <th id="cell-desc" class="text-weight-semibold">Qty</th>
                                            <th id="cell-desc" class="text-weight-semibold">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
    //-----------------------------------------------------
   $sqllms_det	= $dblms->querylms("SELECT d.id_setup, d.id_item, d.qty, d.unit_price, i.item_name, i.school_price	 
                                    FROM ".INVENTORY_PUR_DETAIL." d
                                    INNER JOIN ".INVENTORY_ITEMS." i ON i.item_id = d.id_item
                                    WHERE d.id_setup ='".$_GET['pr']."' ");
    //-----------------------------------------------------
    $srno = 0;
    while($value_det = mysqli_fetch_array($sqllms_det)) {
    $srno++;
    $item_price = $value_det['school_price'] * $value_det['qty'];
    //-----------------------------------------------------
                                    echo'<tr>
                                            <td>'.$srno.'</td>
                                            <td class="text-weight-semibold text-dark">'.$value_det['item_name'].'</td>
                                            <td>'.$value_det['school_price'].'</td>
                                            <td>'.$value_det['qty'].'</td>
                                            <td>'.$item_price.'</td>
                                        </tr>';
    }
    echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    
            <div class="invoice-summary">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table h5 text-dark">
                            <tbody>
                                <tr class="h4">
                                    <td colspan="2">Total Amount</td>
                                    <td class="text-left">Rs. '.$rowsvalues['pur_total_amount'].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="panel-footer">
        <div class="text-right mr-lg">
            <a href="#" onclick="PrintElem(\'#invoice_print\')" class="btn btn-primary ml-sm"><i class="glyphicon glyphicon-print"></i></a>
        </div>
    </footer>
</section>';
}
else{
    header("Location: stationary_request.php");
}
}
?>