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
echo'<title> Dashboard | '.TITLE_HEADER.'</title>';

//------------------NOTIFICATION MODAL START----------------------
$sqllms	= $dblms->querylms("SELECT not_title, dated, not_description
                                FROM ".NOTIFICATIONS." 
                                WHERE not_status = '1' AND is_deleted != '1' AND to_donor = '1' AND id_type = '1'
                                AND (id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' OR id_campus = '0') 
                                ORDER BY not_id DESC LIMIT 1");
//---------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------
if(isset($rowsvalues['not_title']) || isset($rowsvalues['not_description']))
{
    echo'
    <div class="modal fade col-md-6 col-sm-10" id="myModal" style="position: absolute; left: 50%;top: 35%;transform: translate(-50%, -50%);">
        <section class="panel panel-featured panel-featured-primary">
            <header class="panel-heading">
                <h2 class="panel-title">
                    <span style="font-size: 30px; line-height: 30px;"><i class="fa fa-bell"></i> '.$rowsvalues['not_title'].'</span>
                    <a class="close" data-dismiss="modal"><i class="fa fa-window-close"></i></a>
                </h2>
            </header>
            <div class="panel-body" style="height: 200px; line-height: 30px; padding: 20px; text-align:center; text-align: justify;">
                <h3>'.$rowsvalues['not_description'].'</h3>
            </div>
        </section>
    </div>';
}
//------------------NOTIFICATION MODAL END----------------------
echo '
<style>
.image{
	border-radius: 40px;
	border: 2px solid white;
	height: 70px;
	width: 70px;
	}
a:hover{
	text-decoration: none;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Students </h2>
	</header>
<!-- INCLUDEING PAGE -->
<div class="row">';

//Donor
$sqllmsDonor = $dblms->querylms("SELECT donor_id, donor_name
										FROM ".DONORS."
										WHERE donor_id != ''
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'
										LIMIT 1");
$valDonor = mysqli_fetch_array($sqllmsDonor);

//-----------------------------------------------------
$sqllmsDonations = $dblms->querylms("SELECT d.id, d.status, d.amount, d.duration, s.std_id, s.std_name, s.std_fathername, s.std_regno, s.std_photo, c.class_name, cs.section_name
                                            FROM ".DONATIONS_STUDENTS." d
                                            INNER JOIN ".STUDENTS." s ON s.std_id = d.id_std
                                            INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
                                            LEFT  JOIN ".CLASS_SECTIONS." cs ON cs.section_id = s.id_section
                                            WHERE d.id != '' AND d.id_donor = '".$valDonor['donor_id']."'
                                            ORDER BY d.id ASC");
$srno = 0;
//-----------------------------------------------------
while($valueDetail = mysqli_fetch_array($sqllmsDonations)) {

    if($valueDetail['std_photo']){
        $photo = '<img class="image" src="uploads/images/employees/'.$valueDetail['std_photo'].'"/>';
    }
    else{
        $photo = '<img class="image" src="uploads/images/employees/default.jpg"/>';
    }

    echo'
    <div class="col-md-4 col-lg-4 col-xl-3">
        <a href="donations.php?std='.$valueDetail['std_id'].'&don='.$valDonor['donor_id'].'">
            <section class="panel panel-featured panel-featured-primary" >
                <header class="panel-heading">
                    <center>
                        <p>'.$photo.'</p>
                        <h4 class="text text-primary">'.$valueDetail['std_name'].' '.$valueDetail['std_fathername'].'</h4>
                    </center>
                </header>
            
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed mb-none">
                            <tr>
                                <td class="text text-primary"><i class="fa fa-check"></i> Class</td>
                                <td align="right">'.$valueDetail['class_name'].' '; if($valueDetail['section_name']){ echo''.$valueDetail['section_name'].''; } echo'</td>
                            </tr>
                            <tr>
                                <td class="text text-primary"><i class="fa fa-check"></i> Donation Amount</td>
                                <td align="right">'.$valueDetail['amount'].'</td>
                            </tr>
                            <tr>
                                <td class="text text-primary"><i class="fa fa-check"></i> Donation Duration</td>
                                <td align="right">'.$valueDetail['duration'].'</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
        </a>
    </div>';
}
echo'
</div>
</section>';
include_once("include/footer.php");
//-----------------------------------------------
?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>