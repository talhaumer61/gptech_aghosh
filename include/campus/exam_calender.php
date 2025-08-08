<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || (arrayKeyValueSearch($_SESSION['userroles'], 'right_name', '12')))
{
	echo '
	<title> Exam Calender | '.TITLE_HEADER.'</title>
	<section role="main" class="content-body">
		<header class="page-header">
			<h2> Exam Panel  </h2>
		</header>
	<!-- INCLUDEING PAGE -->
	<div class="row">
	<div class="col-md-12">';
	//-----------------------------------------------
	include_once("exam_calender/list.php");
	//-----------------------------------------------
	echo '
	</div>
	</div>
	</section>
	</div>
	</section>	';
	//-----------------------------------------------
} 
else{
	header("Location: dashboard.php");
}
?>