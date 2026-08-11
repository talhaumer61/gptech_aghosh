<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
	include_once("include/header.php");
	//-----------------------------------------------
	if($_SESSION['userlogininfo']['LOGINAFOR'] == 1 || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '34'))){
		require_once("include/".get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/stationary-item/query.php");
	}
	//-----------------------------------------------
echo '
<title> Stationary Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Stationary Panel </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//---------------------- STOCK DETAILS -------------------------
if($_SESSION['userlogininfo']['LOGINAFOR'] == 1 || $_SESSION['userlogininfo']['LOGINAFOR'] == 2 || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '34'))){
    // include_once("include/".get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/stationary-stock/list.php");
    echo'
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-list"></i>  Stationary Stock</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Item Name</th>
                        <th>Item Code</th>
                        <th>Item Quantity</th>
                    </tr>
                </thead>
                <tbody>';
                //-----------------------------------------------------
                $sqllms_item	= $dblms->querylms("SELECT item_id, item_name, item_code
                                                FROM ".INVENTORY_ITEMS."
                                                ORDER BY item_name ASC");
                $srno = 0;
                //-----------------------------------------------------
                while($values_item = mysqli_fetch_array($sqllms_item)) {
                    //-------------------------- PURCHASE ---------------------------
                    $sqllms_pur	= $dblms->querylms("SELECT SUM(d.qty) AS totalpurchase
                                                FROM ".INVENTORY_PURCHASE." p 
                                                INNER JOIN ".INVENTORY_PUR_DETAIL." d ON d.id_setup = p.pur_id 
                                                WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                AND d.id_item = '".$values_item['item_id']."'");
                    //-----------------------------------------------------
                    $values_purchase = mysqli_fetch_array($sqllms_pur);
					//-----------------------------------------------------
					
                    //------------------------- SALES ----------------------------
                    $sqllms_sale = $dblms->querylms("SELECT SUM(qty) AS totalsale
                                                FROM ".INVENTORY_SALE." s 
                                                INNER JOIN ".INVENTORY_SALE_DETAIL." d ON d.id_setup = s.sal_id 
                                                WHERE (s.sal_status = '4' OR s.sal_status = '5') AND d.id_item = '".$values_item['item_id']."'");
                    //-----------------------------------------------------
                    $values_sale = mysqli_fetch_array($sqllms_sale);
					//-----------------------------------------------------
					$items = $values_purchase['totalpurchase'] - $values_sale['totalsale'];
					//-----------------------------------------------------
					$srno++;
					//-----------------------------------------------------

                echo '
                    <tr>
                        <td class="text-center">'.$srno.'</td>
                        <td>'.$values_item['item_name'].'</td>
                        <td>'.$values_item['item_code'].'</td>
                        <td>'.$items.'</td>
                    </tr>';
                //-----------------------------------------------------
                }
                //-----------------------------------------------------
                echo '
                </tbody>
            </table>
        </div>
    </section>';
}
//-----------------------------------------------
echo '
</div>
</div>';
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
<?php 
//-----------------------------------------------
if(isset($_SESSION['msg'])) { 
//-----------------------------------------------
		echo 'new PNotify({
				title	: "'.$_SESSION['msg']['title'].'"	,
				text	: "'.$_SESSION['msg']['text'].'"	,
				type	: "'.$_SESSION['msg']['type'].'"	,
				hide	: true	,
				buttons: {
					closer	: true	,
					sticker	: false
				}
			});';
//-----------------------------------------------
    unset($_SESSION['msg']);
//-----------------------------------------------
}
//-----------------------------------------------
?>	
var datatable = $('#table_export').dataTable({
			bAutoWidth : false,
			ordering: false,
		});
	});
</script>
<?php 
//------------------------------------
echo '
</section>
</div>
</section>	
<!-- INCLUDES MODAL -->
<script type="text/javascript">
	function showAjaxModalZoom( url ) {
// PRELODER SHOW ENABLE / DISABLE
		jQuery( \'#show_modal\' ).html( \'<div style="text-align:center; "><img src="assets/images/preloader.gif" /></div>\' );
// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax( {
			url: url,
			success: function ( response ) {
				jQuery( \'#show_modal\' ).html( response );
			}
		} );
	}
</script>
<!-- (STYLE AJAX MODAL)-->
<div id="show_modal" class="mfp-with-anim modal-block modal-block-primary mfp-hide"></div>
<script type="text/javascript">
	function confirm_modal( delete_url ) {
		swal( {
			title: "Are you sure?",
			text: "Are you sure that you want to delete this information?",
			type: "warning",
			showCancelButton: true,
			showLoaderOnConfirm: true,
			closeOnConfirm: false,
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "Cancel",
			confirmButtonColor: "#ec6c62"
		}, function () {
			$.ajax( {
				url: delete_url,
				type: "POST"
			} )
			.done( function ( data ) {
				swal( {
					title: "Deleted",
					text: "Information has been successfully deleted",
					type: "success"
				}, function () {
					location.reload();
				} );
			} )
			.error( function ( data ) {
				swal( "Oops", "We couldn\'t\ connect to the server!", "error" );
			} );
		} );
	}
</script>    
<!-- INCLUDES BOTTOM -->';
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>