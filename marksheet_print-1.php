

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
			<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
				<thead>
					<tr>
						<td class="center">Subject</td>
						<td class="center">Passing marks</td>
						<td class="center">Obtained marks</td>
						<td class="center">Highest mark</td>
						<td class="center">Grade</td>
					</tr>
				</thead>
				<tbody>
										<tr>
						<td class="center">
							English						</td>
						<td class="center">
							33						</td>
						<td class="center">
							70 / 100						</td>
						<td class="center">
							90						</td>
						<td class="center">
							A						</td>
					</tr>
										<tr>
						<td class="center">
							Bangla						</td>
						<td class="center">
							33						</td>
						<td class="center">
							72 / 100						</td>
						<td class="center">
							88						</td>
						<td class="center">
							A						</td>
					</tr>
										<tr>
						<td class="center">
							Computer						</td>
						<td class="center">
							33						</td>
						<td class="center">
							77 / 100						</td>
						<td class="center">
							77						</td>
						<td class="center">
							A						</td>
					</tr>
										<tr>
						<td class="center">
							Mathematics						</td>
						<td class="center">
							33						</td>
						<td class="center">
							77 / 100						</td>
						<td class="center">
							77						</td>
						<td class="center">
							A						</td>
					</tr>
									</tbody>
			</table>
			<br>
			<center>
				Total Marks : 296 / 400&nbsp;&nbsp;&nbsp;&nbsp;Percent(%) : 74.0&nbsp;&nbsp;&nbsp;&nbsp;Average Grade Point : 4&nbsp;&nbsp;&nbsp;&nbsp;Average Result : <strong>Pass</strong>			</center>
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