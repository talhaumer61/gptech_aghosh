<?php 
//-----------------------------------------------
echo '
<title> Weekly Lecture Schedule | '.TITLE_HEADER.'</title>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Weekly Lecture Schedule </h2>
	</header>
	<style>
		[class^="hvr-"] {
			/*display: inline-block;*/
			/*vertical-align: middle;*/
			background: #0088cc;
			color: #fff;
			cursor: pointer;
			line-height: 1.2em;
			margin: .5em;
			margin-bottom: .2em;
			margin-top: .2em;
			padding: .6em;
			text-decoration: none;
			/* Prevent highlight colour when element is tapped */
			-webkit-tap-highlight-color: rgba(0,0,0,0);
		}
		.hvr-grow-shadow {
		display: inline-block;
		vertical-align: middle;
		-webkit-transform: perspective(1px) translateZ(0);
		transform: perspective(1px) translateZ(0);
		box-shadow: 0 0 1px transparent;
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
		}
		.hvr-grow-shadow:hover, .hvr-grow-shadow:focus, .hvr-grow-shadow:active {
		box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
		}
	</style>
<!-- INCLUDEING PAGE -->
<div class="row">
<div class="col-md-12">';
//-----------------------------------------------------
$sqllmstudent  = $dblms->querylms("SELECT std_id, id_class, id_section  
										FROM ".STUDENTS." 
										WHERE id_campus	= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id_loginid = '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."' LIMIT 1");
$value_stu = mysqli_fetch_array($sqllmstudent);
//-----------------------------------------------------
echo '
<section class="panel panel-featured panel-featured-primary">
	<header class="panel-heading">
		<h2 class="panel-title"> Daily Class Timetable</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped table-condensed mb-none">
            <tbody>';
            foreach($daytypes as $day){
                echo '
				<tr>
					<td width="100">'.$day['name'].'</td>
                    <td>';
//-----------------------------------------------------
$sqllmsdetail	= $dblms->querylms("SELECT c.class_name, se.section_name, s.subject_name, r.room_no, p.period_timestart, p.period_timeend
                                        FROM ".TIMETABEL_DETAIL." d 
                                        INNER JOIN ".TIMETABLE." t 	ON t.id = d.id_setup
                                        INNER JOIN ".CLASSES." c ON c.class_id = t.id_class
                                        INNER JOIN ".CLASS_SECTIONS." se ON se.section_id = t.id_section
                                        INNER JOIN ".CLASS_SUBJECTS." s ON s.subject_id = d.id_subject
                                        INNER JOIN ".CLASS_ROOMS." r ON r.room_id = d.id_room
                                        INNER JOIN ".PERIODS." p ON p.period_id = d.id_period
                                        WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND t.status = '1' 
                                        AND t.id_class = '".$value_stu['id_class']."' AND t.id_section = '".$value_stu['id_section']."' AND d.day = '".$day['id']."'
                                        ORDER BY p.period_timestart ASC");
while($value_detail = mysqli_fetch_array($sqllmsdetail)){
//-----------------------------------------------------
echo '
						<span class="hvr-grow-shadow mt-xs mb-xs" data-toggle="popover" data-html="true" data-container="body" data-placement="top" data-trigger="hover" data-content="'.$value_detail['class_name'].' ( Section '.$value_detail['section_name'].' ) <br>Class Room : '.$value_detail['room_no'].'">
                        '.$value_detail['subject_name'].' ('.$value_detail['period_timestart'].' - '.$value_detail['period_timeend'].') </span>';
}
echo '						
					</td>
                </tr>';
            }
            echo '
			</tbody>
		</table>
	</div>
</section>
</div>
</div>
</section>';
//-----------------------------------------------
?>