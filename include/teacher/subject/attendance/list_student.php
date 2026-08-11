<?php
if(isset($_POST['view_student'])){
//-----------------------------------------------------
echo '
<section class="panel panel-featured panel-featured-primary appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
	<form action="" id="form" method="post" accept-charset="utf-8">
        <header class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-users"></i> <span class="hidden-xs">Students List				
            </h2>
        </header>
        <div class="panel-body">';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.std_id, s.std_name, s.std_photo, s.id_class, s.id_section, s.std_regno	
                                FROM ".STUDENTS." s
                                INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
                                WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                AND s.id_class = '".cleanvars($_POST['id_class'])."' AND s.id_section = '".cleanvars($_POST['id_section'])."'
                                AND s.std_status = '1' AND s.id_session = '1'
                                ORDER BY s.std_id ASC");
//-----------------------------------------------------
if (mysqli_num_rows($sqllms) > 0) {
    echo '
            <div class="col-sm-4 mb-md">
                <div class="form-group">
                    <label class="control-label">Date <span class="required" aria-required="true">*</span></label>
                    <input type="text" class="form-control" id="dated" name="dated" required="" title="Must Be Required" autocomplete="off" data-plugin-datepicker="" aria-required="true">
                </div>
            </div>
            <div class="text-right mt-lg mb-md">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" onclick="mark_all_present()"><i class="fa fa-check"></i><span class="hidden-xs"> Set All Present</span></button>
                    <button type="button" class="btn btn-default btn-sm" onclick="mark_all_absent()"><i class="fa fa-close"></i><span class="hidden-xs"> Set All Absent</span></button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed mb-none ">
                    <thead>
                        <tr>
                            <th width="40">#</th>
                            <th width="40">Photo</th>
                            <th>Name </th>
                            <th>Regno </th>
                            <th width="40%">Status </th>
                        </tr>
                    </thead>
                    <tbody>';
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
                        echo'
                        <tr>
                            <td>'.$srno.'</td>
                            <td class="center"> <img src="uploads/images/students/'.$rowsvalues['std_photo'].'" width="35" height="35"</td>  
                            <td>'.$rowsvalues['std_name'].'</td>
                            <td>'.$rowsvalues['std_regno'].'</td>
                            <td>
                                <div class="radio-custom radio-success radio-inline">
                                    <input type="radio" value="1" name="status['.$srno.']" id="pstatus_'.$srno.'">
                                    <label for="pstatus_'.$srno.'">Present</label>
                                </div>
                                <div class="radio-custom radio-danger radio-inline">
                                    <input type="radio" value="2"  name="status['.$srno.']" id="astatus_'.$srno.'">
                                    <label for="astatus_'.$srno.'">Absent</label>
                                </div>
                                <div class="radio-custom radio-info radio-inline">
                                    <input type="radio" value="3"  name="status['.$srno.']" id="lstatus_'.$srno.'">
                                    <label for="lstatus_'.$srno.'">Late</label>
                                </div>
                            </td>
                        </tr>
                        <input type="hidden" name="std_id['.$srno.']" id="std_id['.$srno.']" value="'.$rowsvalues['std_id'].'">';
}
                        echo '	
                        <input type="hidden" id="id_subject" name="id_subject" value="'.$_POST['id_subject'].'">
                        <input type="hidden" id="id_section" name="id_section" value="'.$_POST['id_section'].'">
                        <input type="hidden" id="id_class" name="id_class" value="'.$_POST['id_class'].'">			
                        <input type="hidden" id="id_teacher" name="id_teacher" value="'.$_POST['id_teacher'].'">			
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-footer">
            <center>
                <button type="submit" class="btn btn-primary" id="mark_attendance" name="mark_attendance">
                    <i class="fa fa-save"></i> Mark Attendance</button>
            </center>
        </div>';
    }
    else{
        echo'<h4 class="center">No Record Found</h4></div>'.$_POST['id_class'].'-'.$_POST['id_section'].'';
    }
    echo '
    </form>
</section>';
?>
<script type="text/javascript">
    function mark_all_present() {
        var count = 1+<?php echo $srno; ?>;
        
        for(var i = 1; i < count; i++) {
            document.getElementById('pstatus_' + i).checked = true;
        }
    }

    function mark_all_absent() {
        var count = 1+<?php echo $srno; ?>;
        
        for(var i = 1; i < count; i++){
            document.getElementById('astatus_' + i).checked = true;
        }
    }
</script>
<?php
}