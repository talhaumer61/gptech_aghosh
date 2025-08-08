<?php 
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
//-----------------------------------------------
	include_once("include/header.php");
//-----------------------------------------------
echo '
<title>Video Lecture Panel | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Video Lecture Panel</h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------
$id_class = '';
$id_subject = '';
if(isset($_POST['id_class'])){$id_class = $_POST['id_class'];}	
if(isset($_POST['id_subject'])){$id_subject = $_POST['id_subject'];}	
//-----------------------------------------------	
echo '
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-list"></i>  Select Class</h2>
        </header>
        <form action="#" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="panel-body">
            <div class="row mb-lg">
                 <div class="col-md-offset-3 col-md-6">
                    <div class="form-group">
                        <label class="control-label">Class <span class="required">*</span></label>
                        <select data-plugin-selectTwo data-width="100%" id="id_class" name="id_class" onchange="get_videoclasssubject(this.value)" required title="Must Be Required" class="form-control">
                            <option value="">Select</option>';
                            $sqllmsclasses	= $dblms->querylms("SELECT c.class_id, c.class_name
                                                                FROM ".CLASSES." c  
                                                                WHERE c.class_id != '' AND class_status = '1'
                                                                ORDER BY c.class_id ASC");
                            while($value_class = mysqli_fetch_array($sqllmsclasses)){
                                if($value_class['class_id'] == $id_class){
                                    echo'<option value="'.$value_class['class_id'].'" selected>'.$value_class['class_name'].'</option>';
                                    }else{
                                        echo'<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
                                        }
                            }
                            echo'
                            </select>
                    </div>
                </div>
                <div id="getvideoclasssubject">
                    <div class="col-md-offset-3 col-md-6 mt-lg">
                        <div class="form-group">
                            <label class="control-label">Subject <span class="required">*</span></label>
                            <select data-plugin-selectTwo data-width="100%" id="id_subject" name="id_subject" required title="Must Be Required" class="form-control populate">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <button type="submit" name="view_lecture" id="view_lecture" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
            </center>
        </div>
        </form>
    </section>';
    //-----------------------------------------------
    if(isset($_POST['view_lecture'])){
    echo '
    <section class="panel panel-featured panel-featured-primary">
    <header class="panel-heading">
        <h2 class="panel-title"><i class="fa fa-list"></i>  Video Lectures List</h2>
    </header>
    <div class="panel-body">
    <table class="table table-bordered table-striped table-condensed mb-none" id="table_export">
    <thead>
    <tr>
        <th>#</th>
        <th>Session</th>
		<th>Class</th>
		<th>Subject</th>
		<th>Title</th>
        <th width="100px;" style="text-align:center;">View</th>
    </tr>
    </thead>
    <tbody>';
    //-----------------------------------------------------
    $sqllms	= $dblms->querylms("SELECT v.id, v.title, v.facebook_code, v.youtube_code, se.session_name, c.class_name, cs.subject_name
                                        FROM ".VIDEO_LECTURE." v 
                                        INNER JOIN ".SESSIONS." se ON se.session_id = v.id_session
                                        INNER JOIN ".CLASSES." c ON c.class_id = v.id_class
                                        INNER JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = v.id_subject
                                        WHERE v.status = '1' AND v.id_class = '".$id_class."' AND v.id_subject = '".$id_subject."'
                                        ORDER BY v.id DESC");
    $srno = 0;
    //-----------------------------------------------------
    while($rowsvalues = mysqli_fetch_array($sqllms)) {
    //-----------------------------------------------------
    $srno++;
    //-----------------------------------------------------
    echo '
    <tr>
        <td style="text-align:center;">'.$srno.'</td>
        <td>'.$rowsvalues['session_name'].'</td>
        <td>'.$rowsvalues['class_name'].'</td>
        <td>'.$rowsvalues['subject_name'].'</td>
        <td>'.$rowsvalues['title'].'</td>
        <td style="text-align:center;">
            <a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/video-lecture/modal_video_view.php?id='.$rowsvalues['id'].'\');"><i class="glyphicon glyphicon-link"></i></a>
        </td>
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
	function get_videoclasssubject(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_videoclasssubject.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#getvideoclasssubject").html(msg); 
				$("#loading").html(''); 
			}
		});  
	}
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