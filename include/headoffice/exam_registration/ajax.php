<?php
if (!empty($_POST['idClass'])) {
require_once("../../dbsetting/lms_vars_config.php");
require_once("../../dbsetting/classdbconection.php");
require_once("../../functions/functions.php");
$dblms = new dblms();
require_once("../../functions/login_func.php");
//=============================================================================================================================
$sqllmsStd	= $dblms->querylms("
                                    SELECT 
                                          std_id 
                                        , std_name
                                        , std_photo
                                    FROM 
                                        ".STUDENTS."  
                                    WHERE 
                                            std_status      =   '1'
                                        AND 
                                            is_deleted      =   '0'
                                        AND 
                                            id_class        =   ".cleanvars($_POST['idClass'])."
                                        AND 
                                            id_campus        =   ".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."
                                    ORDER BY std_id ASC
                                ");
//=============================================================================================================================
$sqllmsSubjects	= $dblms->querylms("
                                        SELECT 
                                              subject_id 
                                            , subject_name
                                        FROM 
                                            ".CLASS_SUBJECTS."  
                                        WHERE 
                                                subject_status      =   '1'
                                            AND 
                                                is_deleted          =   '0'
                                            AND 
                                                id_class            =   ".cleanvars($_POST['idClass'])."
                                        ORDER BY subject_id ASC
                                    ");
//=============================================================================================================================
$sqllmsclassesname	= $dblms->querylms("
										SELECT 
											class_name
										FROM ".CLASSES."
										WHERE 
											    class_id			= ".cleanvars($_POST['idClass'])."
										ORDER BY class_name ASC LIMIT 1
									");
//=============================================================================================================================
if (isset($_POST['demandId'])):
$sqllms_ch_demand	= $dblms->querylms("
                                            SELECT 
                                                  detail_id
                                                , id_std
                                                , id_subjects
                                            FROM 
                                                ".EXAM_REGISTRATION_DETAIL."
                                            WHERE 
                                                id_reg             =   ".cleanvars($_POST['demandId'])."
                                        ");
    $val_demand_detail = array();
    while($row = mysqli_fetch_array($sqllms_ch_demand)):
        $val_demand_detail[] = 	array (
                                              'detail_id' 	        => $row['detail_id']
                                            , 'id_std' 		        => $row['id_std']
                                            , 'id_subjects' 		=> $row['id_subjects']
                                        );
    endwhile;
endif;
//=============================================================================================================================
$subjects = array();
while($values	= mysqli_fetch_array($sqllmsSubjects)):
    $subjects[] = 	array (
                              'subject_id' 	        => $values['subject_id']
                            , 'subject_name' 		=> $values['subject_name']
                        );
endwhile;
$sr = 0;
$r1 = 0;
$r2 = 0;
$r3 = 0;
//=============================================================================================================================
    if (mysqli_num_rows($sqllmsStd)) {
echo '
<thead>
    <tr>
        <th colspan="'.(mysqli_num_rows($sqllmsSubjects)+3).'" class="center text-danger" style="background-color: #c54147; border-radius: 10px; border: 0px; padding-bottom: 10px;">
            <h2 style="color: #ffffff;"> 
                Total No Of Students In 
                <b>('.mysqli_fetch_array($sqllmsclassesname)['class_name'].')</b>
            </h2>
        </th>
    </tr>
    <tr>
        <th width="10" class="center">
            Sr#
        </th>
        <th width="110" class="center">
            <input type="checkbox" id="check_all" class="check_all" value="1" style="transform : scale(1.0; margin-right: 10px;">
            Photo
        </th>
        <th width="150">
            Full Name
        </th>
        <th colspan="'.mysqli_num_rows($sqllmsSubjects).'" class="center">
            Subjects
        </th>
    </tr>
</thead>
<tbody>
';
    while($valClass = mysqli_fetch_array($sqllmsStd)):
        $sr++;
        $r1++;

        if (isset($_POST['demandId'])):
            $sqllms_ch_demand	= $dblms->querylms("
                                                        SELECT 
                                                              detail_id
                                                            , id_std
                                                            , id_subjects
                                                        FROM 
                                                            ".EXAM_REGISTRATION_DETAIL."
                                                        WHERE 
                                                                id_reg                  =   ".cleanvars($_POST['demandId'])."
                                                            AND 
                                                                id_std                  =   ".cleanvars($valClass['std_id'])."
                                                    ");
            $row = mysqli_fetch_array($sqllms_ch_demand);
            $splited_id_subjects = explode(',', $row['id_subjects']);            
            
            
        endif;
echo '
        <tr>
            <td class="center">
                '.$sr.'
            </td>
            <td class="center">
                <input type="checkbox" name="students['.$r1.']" id="role_'.$r1.'" class="check_all std_ch_'.$r1.'" value="1" style="transform : scale(1.0); margin-right: 10px;" '.(isset($_POST['demandId'])? (mysqli_num_rows($sqllms_ch_demand) ? 'checked': '') : '' ).'>
                <input type="hidden" name="students_id['.$r1.']" value="'.$valClass['std_id'].'">
                <input type="hidden" name="detail_id['.$r1.']" value="'.(isset($_POST['demandId'])? $row['detail_id'] : '' ).'">
                <img src="uploads/images/students/'.$valClass['std_photo'].'" style="width:50px; height:50px;">
            </td>
            <td>'.$valClass['std_name'].'</td>          
';
            if (mysqli_num_rows($sqllmsStd))
            {
                foreach($subjects as $key => $val):                  
                    $r2++;
                    
echo '

            <td class="center">
';
        if (isset($_POST['demandId'])):
            $row = mysqli_fetch_array($sqllms_ch_demand);
            // print_r($row);
            // if ($row['id_std'] == $valClass['std_id']):
            //     $splited_id_subjects = explode(',', $row['id_subjects']);            
            // endif;
        endif;
echo '
                <input type="checkbox" name="subjects['.$r1.$key.']" id="sub_ch_'.$r1.'" class="role_'.$r1.' check_all" value="1" style="transform : scale(1.0); margin-right: 10px;" '.(isset($_POST['demandId'])? (in_array($val['subject_id'], $splited_id_subjects) ? 'checked' : '' ) : '' ).'>
                <input type="hidden" 	name="subjects_id['.$r1.$key.']" value="'.$val['subject_id'].'">
                '.$val['subject_name'].'
                <script>
                    $(document).ready(function(){
                        '.(!isset($_POST['demandId'])? '$(".check_all").prop("checked", true);': '').'
                        $("#role_'.$r1.'").click(function(){
                            $(".role_'.$r1.'").prop("checked", $(this).prop("checked"));
                        });
                        $("#check_all").click(function(){
                            $(".check_all").prop("checked", $(this).prop("checked"));
                        });
                    });
                </script>
            </td>   
';   
                endforeach;
echo '
                <script>
                    
                </script>
';
            }
            else
            {
echo '
            <td class="center text-danger">
                <h3>
                    No Subject Listed In This Class 
                </h3>
            </td>   
';
            }
echo '
        </tr>
';
        $r3++;
    endwhile;
echo '
</tbody>
';
    }
    else
    {
echo '
        <div class="panel-heading text-center" style="background-color: #c54147;">
            <h4 class="panel-title" style="color: #fff;">
                <b>
                    No Students Found In This Class
                </b>      
            </h4>
        </div>
';        
    }
}
else
{
echo '
<div class="panel-heading text-center" style="background-color: #c54147;">
    <h4 class="panel-title" style="color: #fff;">
        <b>
            Please Select Any Class
        </b>      
    </h4>
</div>

';
}
?>

<!-- 


'.(!isset($_POST['demandId'])? '
                        $(".role_'.$r1.'").click(function(){
                            $("#role_'.$r1.'").prop("checked", $(this).prop("checked"));
                        });
                        ': '').'

 -->