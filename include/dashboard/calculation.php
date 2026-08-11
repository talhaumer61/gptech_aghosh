<?php 
echo '
<!--PAID AND DUE CALCULATON-->
		
<!--LIQUID METER-->								
	<div class="col-lg-3 text-center">
		<section class="panel panel-featured-left panel-featured-primary">
			<div class="panel-body">
				<div class="liquid-meter-wrapper liquid-meter-md mt-lg">
					<div class="liquid-meter">
					<meter min="0" max="100" value="67.4823194486" id="meterSales"></meter>
					</div>
					<div class="liquid-meter-selector" id="meterSalesSel">
					<a href="#" data-val="67.4823194486" class="active">Total Paid</a>
					<a href="#" data-val="32.5176805514">TOTAL DUE</a>
					</div>
				</div>
				 <!--See: assets/javascripts/dashboard/custom_dashboard.js for more settings.-->
			</div>
		</section>
	</div>
	
	<div class="col-md-3">
		<section class="panel panel-featured-left panel-featured-primary">
			<div class="panel-body">
				<div class="widget-summary widget-summary-sm">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-primary">
							<i class="fa fa-usd"></i>
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Payment</h4>
							<div class="info">
								<strong class="amount">0</strong>
								<span class="text-primary text-uppercase">Today Payments</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
   
	<div class="col-md-3">
		<section class="panel panel-featured-left panel-featured-primary">
			<div class="panel-body">
				<div class="widget-summary widget-summary-sm">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-primary">
							<i class="fa fa-hotel"></i>
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Hostel</h4>
							<div class="info">
								<strong class="amount">2</strong>
								<span class="text-primary text-uppercase">total hostel</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	
	<div class="col-md-3">
		<section class="panel panel-featured-left panel-featured-primary">
			<div class="panel-body">
				<div class="widget-summary widget-summary-sm">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-primary">
							<i class="fa fa-map-marker"></i>
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Transport</h4>
							<div class="info">
								<strong class="amount">5</strong>
								<span class="text-primary text-uppercase">total route</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>';