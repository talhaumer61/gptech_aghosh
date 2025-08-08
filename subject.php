<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
    checkCpanelLMSALogin();
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
echo '
<title>Subject Teaching | '.TITLE_HEADER.'</title>
';
//-----------------------------------------------
include_once("include/".get_logintypes($_SESSION['userlogininfo']['LOGINAFOR'])."/subject.php");
echo'

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
<div id="show_modal" class="mfp-with-anim modal-block modal-block-primary mfp-hide"></div>';
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
    });
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	
    var datatable = $('#table_export').dataTable({
                bAutoWidth : false,
                ordering: false,
            });
        });
</script>
<?php 
//-----------------------------------------------
echo '
</section>';
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
?>