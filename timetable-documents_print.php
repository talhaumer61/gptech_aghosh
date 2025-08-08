<?php
//-----------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
	if(!empty($_SESSION['userlogininfo']['LOGINCAMPUS'])){
		$campus_id = $_SESSION['userlogininfo']['LOGINCAMPUS'];
	}
	else{
		$campus_id = 1;
	}
//-----------------------------------------------
$sqllmscampus	= $dblms->querylms("SELECT c.campus_id, c.campus_code, campus_name, campus_address, campus_email
										FROM ".CAMPUS." c  
										WHERE c.id_campus = '".$campus_id."'  
										LIMIT ");
$value_campus = mysqli_fetch_array($sqllmscampus);
//-----------------------------------------------
echo '
<div id="print">
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="assets/stylesheets/theme.css"/>

	<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>
	<script src="assets/vendor/jquery/jquery.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
			border: 1px solid #ffcfcf;
		}
		th {
			border: 1px solid #ffcfcf;
		}
	</style>
	<br>
	<center>
		<img src="uploads/logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;">'.$value_campus[''].'</h3>
		Email: '.$value_campus['campus_email'].'<br>
		'.$value_campus['campus_address'].'	</center>
	<br>

	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title">
				Class One ( Section - A ) Daily Class Routine			</h4>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12">
					<table style="width:100%; border-collapse:collapse; margin-top: 10px;" border="1">
						<tbody>
													<tr>
								<td width="100">SUNDAY</td>
								<td align="left">
																		<div style="float:left; padding:8px; margin:5px; background-color:#e0e8f0;">
										Computer										(1:25 AM-2:25 AM)										<br>
										<center>
											Teacher : Anzo Perez										</center>
										<center>Class Room : #1</center>									</div>
																		<div style="float:left; padding:8px; margin:5px; background-color:#e0e8f0;">
										Mathematics										(11:25 PM-9:25 PM)										<br>
										<center>
											Teacher : Anzo Perez										</center>
										<center>Class Room : #2</center>									</div>
																		<div style="float:left; padding:8px; margin:5px; background-color:#e0e8f0;">
										Bangla										(2:25 PM-3:25 PM)										<br>
										<center>
											Teacher : Anzo Perez										</center>
										<center>Class Room : #8</center>									</div>
																		<div style="float:left; padding:8px; margin:5px; background-color:#e0e8f0;">
										English										(8:30 PM-9:30 PM)										<br>
										<center>
											Teacher : Anzo Perez										</center>
										<center>Class Room : #1</center>									</div>
																	</td>
							</tr>
														<tr>
								<td width="100">MONDAY</td>
								<td align="left">
																		<div style="float:left; padding:8px; margin:5px; background-color:#e0e8f0;">
										Bangla										(11:30 AM-12:30 PM)										<br>
										<center>
											Teacher : Anzo Perez										</center>
										<center>Class Room : #2</center>									</div>
																		<div style="float:left; padding:8px; margin:5px; background-color:#e0e8f0;">
										English										(12:30 PM-1:30 PM)										<br>
										<center>
											Teacher : Anzo Perez										</center>
										<center>Class Room : #3</center>									</div>
																	</td>
							</tr>
														<tr>
								<td width="100">TUESDAY</td>
								<td align="left">
																	</td>
							</tr>
														<tr>
								<td width="100">WEDNESDAY</td>
								<td align="left">
																	</td>
							</tr>
														<tr>
								<td width="100">THURSDAY</td>
								<td align="left">
																	</td>
							</tr>
														<tr>
								<td width="100">FRIDAY</td>
								<td align="left">
																	</td>
							</tr>
														<tr>
								<td width="100">SATURDAY</td>
								<td align="left">
																	</td>
							</tr>
													</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>';
?>
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
		var mywindow = window;
		mywindow.document.write( '<html><head><title></title>' );
		//mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
		mywindow.document.write( '</head><body >' );
		//mywindow.document.write('<style>.print{border : 1px;}</style>');
		mywindow.document.write( data );
		mywindow.document.write( '</body></html>' );

		mywindow.document.close(); // necessary for IE >= 10
		mywindow.focus(); // necessary for IE >= 10

		mywindow.print();
	}
</script>
