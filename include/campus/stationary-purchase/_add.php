<?php
// //-----------------------------------------------
// if(isset($_GET['id'])){
// $sqllmspayslip	= $dblms->querylms("SELECT s.id, s.slip_no, s.month, s.basic_salary, s.total_allowances, s.total_deductions, s.net_pay, s.dated,
//                                         e.emply_name, e.emply_joindate, e.emply_phone, e.emply_email, d.dept_name, dp.designation_name, c.campus_name, c.campus_address, c.campus_email, c.campus_phone
//                                         FROM ".SALARY." s
//                                         INNER JOIN ".EMPLOYEES." e ON e.emply_id = s.id_emply
//                                         LEFT JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
//                                         LEFT JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
//                                         INNER JOIN ".CAMPUS." c ON c.campus_id = s.id_campus
//                                         WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
//                                         AND s.status = '1' AND id = '".$_GET['id']."' LIMIT 1");
// $value_pay = mysqli_fetch_array($sqllmspayslip);
// //-----------------------------------------------
// echo '<section class="panel">
// <div class="panel-body" id="invoice_print">
//     <div class="invoice">
//         <header class="clearfix">
//             <div class="row">
//                 <div class="col-sm-4 mt-md">
//                     <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">PAYSLIP</h2>
//                     <h4 class="h4 m-none text-dark text-weight-bold">#'.$value_pay['slip_no'].'</h4>
//                 </div>
//                 <div class="col-sm-8 text-right mt-md mb-md">
//                     <address class="ib mr-xlg">
//                         <span class="text-dark"><b>'.$value_pay['campus_name'].'</b></span><br>
//                         '.$value_pay['campus_address'].'<br> 
//                         '.$value_pay['campus_phone'].'<br>  
//                         '.$value_pay['campus_email'].'  
//                     </address>
//                     <div class="ib">
//                         <img src="uploads/logo.png" width="174" height="69" alt="'.TITLE_HEADER.'">
//                     </div>
//                 </div>
//             </div>
//         </header>
        
//         <div class="bill-info">
//             <div class="row">
//                 <div class="col-md-6">
//                     <div class="bill-to">
//                         <p class="h5 mb-xs text-dark text-weight-semibold">To:</p>
//                         <address>
//                             '.$value_pay['emply_name'].'<br>
//                             Designation : '.$value_pay['designation_name'].'<br>
//                             Department : '.$value_pay['dept_name'].'<br>
//                             Joining Date : '.date('d M, Y' , strtotime(cleanvars($value_pay['emply_joindate']))).'<br>
//                             Phone : '.$value_pay['emply_phone'].'<br>
//                             Email : '.$value_pay['emply_email'].'
//                         </address>
//                     </div>
//                 </div>

//                 <div class="col-md-6">
//                     <div class="bill-data text-right">
//                         <p class="mb-none">
//                             <span class="text-dark">Creation Date : </span>
//                             <span>'.date('d M, Y' , strtotime(cleanvars($value_pay['dated']))).'</span>
//                         </p>
//                         <p class="mb-none">
//                             <span class="text-dark">Salary Month : </span>
//                             <span>'.get_monthtypes($value_pay['month']).'</span>
//                         </p>
//                     </div>
//                 </div>
//             </div>
//         </div>
//         <div class="row">
//             <div class="col-md-6">
//                 <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
//                     <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
//                         <h2 class="panel-title">Allowances</h2>
//                     </header>
//                     <div class="panel-body">
//                         <div class="table-responsive">
//                             <table class="table invoice-items">
//                                 <thead>
//                                     <tr class="h5 text-dark">
//                                         <th id="cell-id" class="text-weight-semibold">#</th>
//                                         <th id="cell-item" class="text-weight-semibold">Name</th>
//                                         <th id="cell-desc" class="text-weight-semibold">Amount</th>
//                                     </tr>
//                                 </thead>
//                                 <tbody>';
// //-----------------------------------------------------
// $sqllmsallowance	= $dblms->querylms("SELECT name, amount
//                                         FROM ".SALARY_PART."
//                                         WHERE type = '1' AND id_voucher = '".$value_pay['id']."' ORDER BY id ASC");
// //-----------------------------------------------------
// $srno = 0;
// while($value_allow = mysqli_fetch_array($sqllmsallowance)) {
// $srno++;
// //-----------------------------------------------------
//                                 echo'<tr>
//                                         <td>'.$srno.'</td>
//                                         <td class="text-weight-semibold text-dark">'.$value_allow['name'].'</td>
//                                         <td>'.$value_allow['amount'].'</td>
//                                     </tr>';
// }
// echo '
//                                 </tbody>
//                             </table>
//                         </div>
//                     </div>
//                 </section>
//             </div>

//             <div class="col-md-6">
//                 <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
//                     <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
//                         <h2 class="panel-title">Deductions</h2>
//                     </header>
//                     <div class="panel-body">
//                         <div class="table-responsive">
//                             <table class="table invoice-items">
//                                 <thead>
//                                     <tr class="h5 text-dark">
//                                         <th id="cell-id" class="text-weight-semibold">#</th>
//                                         <th id="cell-item" class="text-weight-semibold">Name</th>
//                                         <th id="cell-desc" class="text-weight-semibold">Amount</th>
//                                     </tr>
//                                 </thead>
//                                 <tbody>';
// //-----------------------------------------------------
// $sqllmsdeductions	= $dblms->querylms("SELECT name, amount
//                                         FROM ".SALARY_PART."
//                                         WHERE type = '2' AND id_voucher = '".$value_pay['id']."' ORDER BY id ASC");
// //-----------------------------------------------------
// $srno = 0;
// while($value_ded = mysqli_fetch_array($sqllmsdeductions)) {
// $srno++;
// //-----------------------------------------------------
//                                 echo'<tr>
//                                         <td>'.$srno.'</td>
//                                         <td class="text-weight-semibold text-dark">'.$value_ded['name'].'</td>
//                                         <td>'.$value_ded['amount'].'</td>
//                                     </tr>';
// }
// echo '
//                                 </tbody>
//                             </table>
//                         </div>
//                     </div>
//                 </section>
//             </div>
//         </div>

//         <div class="invoice-summary">
//             <div class="row">
//                 <div class="col-sm-4 col-sm-offset-8">
//                     <table class="table h5 text-dark">
//                         <tbody>
//                             <tr class="b-top-none">
//                                 <td colspan="2">Basic Salary</td>
//                                 <td class="text-left">Rs. '.$value_pay['basic_salary'].'</td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2">Total Allowance</td>
//                                 <td class="text-left">Rs. '.$value_pay['total_allowances'].'</td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2">Total Deductions</td>
//                                 <td class="text-left">Rs. '.$value_pay['total_deductions'].'</td>
//                             </tr>
//                             <tr class="h4">
//                                 <td colspan="2">Net Salary</td>
//                                 <td class="text-left">Rs. '.$value_pay['net_pay'].'</td>
//                             </tr>
//                         </tbody>
//                     </table>
//                 </div>
//             </div>
//         </div>
//     </div>
// </div>
// <footer class="panel-footer">
//     <div class="text-right mr-lg">
//         <a href="#" onclick="PrintElem(\'#invoice_print\')" class="btn btn-primary ml-sm"><i class="glyphicon glyphicon-print"></i></a>
//     </div>
// </footer>
// </section>';
// }
//-----------------------------------------------
if(!isset($_GET['id'])){
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
<form action="stationary-purchase.php" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
    <section class="panel panel-featured panel-featured-primary appear-animation fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
        <header class="panel-heading">
            <h2 class="panel-title">Make Purchase</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel" style="box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15);">
                        <header class="panel-heading" style="border-bottom: 2px solid #0088cc;">
                            <h2 class="panel-title">Select</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3 mt-md">
                                    <select data-plugin-selectTwo data-width="100%" id="id_item" name="id_item[]" required title="Must Be Required" onchange="get_itemprice(this.value)" class="form-control populate">
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
                                <div class="col-sm-3 mt-md">
                                    <div id="getprice">
                                        <input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price" type="number" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-2 mt-md">
                                    <input class="form-control" name="qty[]" id="qty" onchange="Multiply()"  placeholder="Quantity" type="number">
                                </div>
                                <div class="col-sm-3 mt-md">
                                    <input class="total form-control" name="price[]" placeholder="Price" id="price" type="number" readonly>
                                </div>
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
        var i=0;
        function add_more_item() {
            i++;
            var add_new = $('<div class="row"> <?php echo' <div class="col-sm-3 mt-md"> <select data-plugin-selectTwo data-width="100%" id="id_item" name="id_item[]" onchange="get_itemprice(this.value,i)" required title="Must Be Required" class="form-control populate"> <option value="">Select Item</option>'; $sqllmssupp	= $dblms->querylms("SELECT item_id, item_name FROM ".INVENTORY_ITEMS."  WHERE item_status = '1' ORDER BY item_name ASC"); while($value_supp = mysqli_fetch_array($sqllmssupp)) { echo'<option value="'.$value_supp['item_id'].'">'.$value_supp['item_name'].'</option>'; }echo' </select> </div>';?>\n\
                                                           <div class="col-sm-3 mt-md"><div id="getprice_"><input class="form-control" name="unit_price[]" placeholder="Unit Price" id="unit_price" type="number"></div></div>\n\
                                                           <div class="col-sm-2 mt-md"> <input class="form-control" name="qty[]" id="qty" placeholder="Quantity" type="number"></div>\n\
                                                           <div class="col-sm-3 mt-md"><input class="total form-control" name="price[]" placeholder="Price" id="price" type="number"></div>\n\
                                                           <div class="col-sm-1 mt-md text-center"><button type="button" class="btn btn-danger removeAL" ><i class="fa fa-times"></i> </button></div></div></div> ');
            $("#add_new_line").append( add_new );x
        }

        $("#add_new_line").on('click', '.removeAL', function () {
            if(i > 0){
                i--;
                $(this).parent().parent().remove();
                check_sum();
                Multiply();
            }
        });

        $(document).on("change", function () {
            Multiply();
        });
        
        function Multiply() {
            var unit_price = $("#unit_price").val();
            var qty = $("#qty").val();

            var price = (unit_price * qty);
            $("#price").val(price);
        }
        
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
?>
<script type="text/javascript">

    function get_itemprice(id_item,i) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_item_price.php",
			data: "id_item="+id_item+"i="+i,  
			success: function(msg){  
				$("#getprice").html(msg); 
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