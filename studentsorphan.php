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
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'view' => '1'))){
    $sql1 = "";
    $sql3 = "";
    $sql4 = "";
    $class = "";
    $std_gender = "";
    $is_hostelized = "";

    if(isset( $_POST['show_students'])) {                   
        //  class
        if($_POST['id_class']){
            $arrayClass = array();
            foreach ($_POST['id_class'] as $class){
                array_push($arrayClass, $class);
            }
            if(in_array('all', $arrayClass)){
                $selectAll = 'selected';
                $sql1 = "";
                $classComma = '';
            }else{
                $sql1 = "AND s.id_class IN (".implode(", ",$arrayClass).")";
                $classComma 	= 	implode(", ",$arrayClass);
            }
            $class	=	$arrayClass;
        }
        //  gender
        if($_POST['std_gender']){
            $sql3 = "AND s.std_gender = '".$_POST['std_gender']."'";
            $std_gender = $_POST['std_gender'];
        }
        //	is_hostelized
        if($_POST['is_hostelized']){
            if($_POST['is_hostelized']==1){
                $sql4 = "AND s.is_hostelized = '1'";
                $is_hostelized = $_POST['is_hostelized'];
            }else{
                $sql4 = "AND s.is_hostelized != '1'";
                $is_hostelized = $_POST['is_hostelized'];
            }
        }
    }
    echo '
    <title>Orphan Students | '.TITLE_HEADER.'</title>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Orphan Students</h2>
        </header>
    <!-- INCLUDEING PAGE -->
    <div class="row">
    <div class="col-md-12">
        <section class="panel panel-featured panel-featured-primary">
            <form action="studentsorphan.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <header class="panel-heading">
                    <h2 class="panel-title"><i class="fa fa-list"></i>  Select Class</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mb-md">
                        <div class="col-md-4">
                            <label class="control-label">Class </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="id_class[]" multiple>
                                <option value="all" '.$selectAll.'>All</option>';
                                    $sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
                                                                    FROM ".CLASSES." 
                                                                    WHERE class_status = '1'
                                                                    AND is_deleted != '1'
                                                                    ORDER BY class_id ASC"
                                                                );
                                    while($valuecls = mysqli_fetch_array($sqllmscls)) {
                                        echo '<option value="'.$valuecls['class_id'].'"'; if(in_array($valuecls['class_id'], $class)){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
                                    }
                                    echo'
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Gender </label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="std_gender">
                                <option value="">Select</option>';
                                foreach($gender as $gndr){
                                    echo '<option value="'.$gndr.'"'; if($std_gender == $gndr){ echo 'selected';} echo'>'.$gndr.'</option>';
                                }
                                echo'
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Boarder / Day Scholar</label>
                            <select class="form-control" data-plugin-selectTwo data-width="100%" name="is_hostelized">
                                <option value="">Select</option>';
                                foreach($studenttype as $hostel)
                                {
                                    echo' <option value="'.$hostel['id'].'"'; if($is_hostelized == $hostel['id']){ echo'selected';} echo'>'.$hostel['name'].'</option>';
                                }
                                echo'
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" id="show_students" name="show_students" class="mr-xs btn btn-primary">Show Students</button>
                    </div>
                </div>
            </form>
        </section>

        <section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-list"></i> Orphan Students List</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width= 40>Photo</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Roll no</th>
                            <th>Class</th>
                            <th>Phone</th>
                            <th>CNIC</th>
                            <th width="70px;" class="center">Status</th>
                            <th width="150px;" class="center">Options</th>
                        </tr>
                    </thead>
                    <tbody>';
                        //-----------------------------------------------------
                        $sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_name, s.std_gender, s.std_fathername, s.std_gender,
                                                        s.std_nic, s.std_phone, s.std_rollno, s.std_regno, s.std_photo, c.class_name
                                                        FROM ".STUDENTS." s
                                                        INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
                                                        WHERE s.std_id != '' AND s.is_deleted != '1' AND s.is_orphan = '1' 
                                                        AND s.is_orphan_approved = '1' $sql1 $sql3 $sql4
                                                        AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ORDER BY s.std_name");
                        $srno = 0;
                        //-----------------------------------------------------
                        while($rowsvalues = mysqli_fetch_array($sqllms)) {
                        //-----------------------------------------------------
                            $srno++;
                        //-----------------------------------------------------
                            if($rowsvalues['std_photo']) { 
                                $photo = "uploads/images/students/".$rowsvalues['std_photo']."";
                            }
                            else{
                                $photo = "uploads/default-student.jpg";
                            }
                        echo '
                        <tr>
                            <td class="center">'.$srno.'</td>
                            <td><img src="'.$photo.'" style="width:40px; height:40px;"></td>
                            <td>'.$rowsvalues['std_name'].'</td>
                            <td>'.$rowsvalues['std_fathername'].'</td>
                            <td>'.$rowsvalues['std_rollno'].'</td>
                            <td>'.$rowsvalues['class_name'].'</td>
                            <td>'.$rowsvalues['std_phone'].'</td>
                            <td>'.$rowsvalues['std_nic'].'</td>';
                            echo'
                            <td class="center">'.get_status($rowsvalues['std_status']).'</td>
                            <td class="center">';
                                if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'edit' => '1'))){
                                    echo'<a class="btn btn-success btn-xs mr-xs" href="students.php?id='.$rowsvalues['std_id'].'"> <i class="fa fa-user-circle-o"></i></a>';
                                }
                                echo'
                            </td>
                        </tr>';
                        //-----------------------------------------------------
                        }
                        //-----------------------------------------------------
                        echo '

                    </tbody>
                </table>
            </div>
        </section>
    </div>
    </div>';
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
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
    </section>';
//-----------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------------
} else{

    header("Location: dashboard.php");
}
?>