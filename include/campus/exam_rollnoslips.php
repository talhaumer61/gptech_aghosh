<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '82')))
{
	//-----------------------------------------------
	echo '
	<title> Exam Panel | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Exam Panel </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'view' => '1'))){ 	

        //-----------------------------------------------
        if(isset($_POST['id_type'])){$type = $_POST['id_type'];}else{$type = "";}
        if(isset($_POST['id_class'])){$class = $_POST['id_class'];}else{$class = "";}
        if(isset($_POST['id_section'])){$section = $_POST['id_section'];}else{$section = "";}
        //-----------------------------------------------	
        echo'
        <section class="panel panel-featured panel-featured-primary">
            <form action="exam_rollnoslip_print.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" target="_blank">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-list"></i> Select</h4>
                </div>
                <div class="panel-body">
                    <div class="row mt-sm">
                        <div class="col-md-6">
                            <label class="control-label">Exam Type <span class="required">*</span></label>
                                <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
                                <option value="">Select</option>';
                                    $sqllms_type	= $dblms->querylms("SELECT type_id, type_status, type_name 
                                                        FROM ".EXAM_TYPES."
                                                        WHERE type_status = '1' AND is_deleted != '1' 
                                                        ORDER BY type_id ASC");
                                    while($value_type = mysqli_fetch_array($sqllms_type)) 
                                    {
                                        if($value_type['type_id'] == $type){
                                            echo '<option value="'.$value_type['type_id'].'" selected>'.$value_type['type_name'].'</option>';
                                        }else{
                                            echo '<option value="'.$value_type['type_id'].'">'.$value_type['type_name'].'</option>';
                                        }
                                    }
                                    echo '
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="control-label">Class <span class="required">*</span></label>
                            <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classsection(this.value)">
							<option value="">Select</option>';
							//-----------------------------------------------------
                            $sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
                                                                    FROM ".CLASSES." 
                                                                    WHERE class_status = '1' AND is_deleted != '1' ORDER BY class_id ASC");
                            while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
                                if($value_class['class_id'] == $class){
                                    echo'<option value="'.$value_class['class_id'].'" selected>'.$value_class['class_name'].'</option>';
                                }
                                else{
                                    echo'<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
                                }
                            }
                            //-----------------------------------------------------
							echo '
						    </select>
                        </div>
                    </div>		
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="view_rollnoslips" name="view_rollnoslips" target="_blank" class="mr-xs btn btn-primary">Get Roll No Slips</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>';       
        }
        else{
            header("location: dashboard.php");
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
	
	//-----------------------------------------------
	?>	
	var datatable = $('#table_export').dataTable({
				bAutoWidth : false,
				ordering: false,
			});
		});
	//-----------------------------------------------

    function get_classsection(id_class) {  
        $("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
        $.ajax({  
            type: "POST",  
            url: "include/ajax/get_classsection.php",  
            data: "id_class="+id_class,  
            success: function(msg){  
                $("#getclasssection").html(msg); 
                $("#loading").html(''); 
            }
        });  
    }

        
	function get_classstudent(id_class) {  
		$("#loading").html('<img src="images/ajax-loader-horizintal.gif"> loading...');  
		$.ajax({  
			type: "POST",  
			url: "include/ajax/get_class-student.php",  
			data: "id_class="+id_class,  
			success: function(msg){  
				$("#getclassstudent").html(msg); 
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
	<!-- INCLUDES MODAL -->';
}
else
{
	header("Location: dashboard.php");
}
?>