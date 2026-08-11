<?php 
//-----------------------------------------------
	require_once("../dbsetting/lms_vars_config.php");
	require_once("../dbsetting/classdbconection.php");
	require_once ("../functions/functions.php");
	$dblms = new dblms();
	require_once("../functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
  //-----------------------------------------
  
  $sqllmss	= $dblms->querylms("SELECT 
										m.id, m.status, m.id_exam, m.id_class, m.id_section, m.id_subject, m.id_session,
										s.subject_id, s.subject_name, s.subject_totalmarks, s.subject_passmarks, s.id_class,
										exam_id, e.exam_name,
										c.class_id, c.class_name, 
										cs.section_id, cs.section_name, cs.section_strength,
										sub.subject_id, sub.subject_name, sub.subject_totalmarks, sub.subject_passmarks,
										se.session_id, se.session_name,
										d.id_setup, d.id_std, d.max_marks, d.obtain_marks
	 FROM ".EXAM_MARKS." m 
	 INNER JOIN ".CLASS_SUBJECTS." s ON s.subject_id = m.id_subject
	 INNER JOIN ".EXAMS." e ON e.exam_id = m.id_exam
	 INNER JOIN ".CLASSES." c ON c.class_id = m.id_class
	 INNER JOIN ".CLASS_SECTIONS." cs ON cs.section_id = m.id_section
	 INNER JOIN ".CLASS_SUBJECTS." sub ON sub.subject_id = m.id_subject
	 INNER JOIN ".SESSIONS." se ON se.session_id = m.id_session
	 INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id
	 WHERE m.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
  ");
  //-----------------------------------------
?>

<div id="print">
	<link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="../../assets/stylesheets/theme.css"/>
	<link rel="stylesheet" href="../../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>
	<script src="../../assets/vendor/jquery/jquery.js"></script>
	
	<style type="text/css">
		td {	
		}
		
		th {
			background-color: #0088cc;
			color: white;
		}
	</style>
	<br>
	<center>
		<img src="../../uploads/logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;">
			Rudras School Management System ERP <br><span style="font-size: 18px;">Email: admin@shivas.com <br> New York, United States</span>
		</h3>
	</center>
	<br>
	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title">
				Rudyard Maddox  - SSC Exam Mark Sheet			</h4>
		</header>
		<div class="panel-body">
			<table style="width:100%; margin-top: 10px;" border="1" class="table table-bordered table-striped table-condensed mb-none">
				<thead>
					<tr>
						<th class="center">Subject</th>
						<th class="center">Passing marks</th>
						<th class="center">Obtained marks</th>
						<th class="center">Highest mark</th>
						<th class="center">Grade</th>
					</tr>
				</thead>
				<tbody>
                <?php
				$obt_total = 0;
				$grand_total = 0;
                while($rooowsvalues = mysqli_fetch_array($sqllmss)){
					echo'
					<tr>
						<th class="center">'.$rooowsvalues['subject_name'].' </th>
						<td class="center">'.$rooowsvalues['subject_passmarks'].' </td>
						<td class="center">77/'.$rooowsvalues['subject_totalmarks'].'</td>
						<td class="center">90</td>
						<td class="center">A</td>
					</tr>';
					$obt_marks = 77;
					$obt_total = $obt_total + $obt_marks;
					$sub_tmarks = $rooowsvalues['subject_totalmarks'];
					$grand_total = $grand_total + $sub_tmarks;
				}
				$per = round((($obt_total/$grand_total)*100),2);
				?>
				</tbody>
			</table>
			<br>
			<center>
				Total Marks : <?php echo $obt_total ?> / <?php echo $grand_total ?>&nbsp;&nbsp;<b style="color: black;">|</b>&nbsp;&nbsp;
                Percent(%) : <?php echo $per."%"?>&nbsp;&nbsp;<b style="color: black;">|</b>&nbsp;&nbsp;
                Average Grade Point : 4&nbsp;&nbsp;<b style="color: black;">|</b>&nbsp;&nbsp;
                Average Result : <strong>Pass</strong>
           	</center>
		</div>
	</section>
</div>


<script type="text/javascript">
	jQuery( document ).ready( function ( $ ) {
		var elem = $( '#print' );
		PrintElem( elem );
		Popup( data );

	} );

	function PrintElem( elem ) {
		Popup( $( elem ).html() );
	}

	function Popup( data ) {
		var mywindow = window.open( '', 'my div', 'height=400,width=600' );
		mywindow.document.write( '<html><head><title></title>' );
		//mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');

		mywindow.document.write( '</head><body >' );
		//mywindow.document.write('<style>.print{border : 1px;}</style>');
		mywindow.document.write( data );
		mywindow.document.write( '</body></html>' );

		mywindow.document.close(); // necessary for IE >= 10
		mywindow.focus(); // necessary for IE >= 10

		mywindow.print();
		mywindow.close();

		return true;
	}
</script>