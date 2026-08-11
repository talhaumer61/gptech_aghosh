	<div class="col-md-6 col-lg-12 col-xl-6">
		<section class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div id="financegraph" style="height: 240px;"></div>
					</div>
				</div>
			</div>
		</section>
	</div>
<script type="application/javascript">
//FINANCES GRAPH SCRIPT
	Highcharts.chart('financegraph', {

		chart: {
			type: 'spline',
			backgroundColor: 'transparent'
		},
		title: {
						text: '2018 Finances Graph'
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				min: 0,
				text: 'Amount'
			},
			labels: {
				overflow: 'justify'
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: 5,
			y: -10,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
		},
		credits: {
			enabled: false
		},
		tooltip: {
			crosshairs: true,
			shared: true
		},
		series: [{
			name: 'Fees Collect',
			data: [
				{ y:1200},{ y:14200},{ y:138134},{ y:116950},{ y:9600},{ y:5400},{ y:3500},{ y:4000},{ y:500},{ y:39790},{ y:10655},{ y:6650},			]
		}, {
			name: 'Costing',
			data: [
				{ y:0},{ y:0},{ y:0},{ y:1500},{ y:92499},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:500000},{ y:0},			],
			color: '#A48AA0'
		}]
	});
</script>