<div class="row">
    <div class="col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div id="catwisestudents" style="height: 400px;"></div>
			</div>
		</section>
    </div>
</div>
<script type="application/javascript">
	//STUDENT LAST EXAM MARK GRAPH
	Highcharts.chart('catwisestudents', {
		chart: {
			type: 'column',
			backgroundColor: 'transparent'
		},
		title: {
			text: 'Class Category Wise Students'
		},
		xAxis: {
			categories: [
	        "Pre Section",
	        "Primary Section",
	        "Middle Section",
	        "High",
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'No of Students'
			}
		},
		tooltip: {
			crosshairs: true,
			shared: true
			},
		credits: {
			enabled: false
		},
		legend: {
			itemStyle: { "color": "#505461"},
			itemHoverStyle: { "color": "#505461" }
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		series: [{
        name: 'Total No. of Students',
        data: [
	        {y:<?php echo $pre; ?>},
	        {y:<?php echo $primary; ?>},
	        {y:<?php echo $middle; ?>},
	        {y:<?php echo $high; ?>},
		]
    }]
	});
	
</script>