<?php 
echo '
<div class="row">
    <div class="col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div id="attendancegraph" style="height: 400px;"></div>
			</div>
		</section>
    </div>
</div>';
?>
<script type="application/javascript">
//TOTAL SCHOOL ATTENDANCE GRAPH SCRIPT
	Highcharts.chart('attendancegraph', {
		chart: {
			type: 'areaspline',
			backgroundColor: 'transparent'
		},
		title: {
						text: 'Total School Students Attendance'
		},
		xAxis: {
			categories: [
				"Day 1","Day 2","Day 3","Day 4","Day 5","Day 6","Day 7","Day 8","Day 9","Day 10","Day 11","Day 12","Day 13","Day 14","Day 15","Day 16","Day 17","Day 18","Day 19",			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Overview ( January )'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
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
			name: 'Present',
			data: [
				{ y:0},{ y:4},{ y:0},{ y:0},{ y:0},{ y:0},{ y:6},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:6},{ y:0},{ y:5},{ y:0},			]

		}, {
			name: 'Absent',
			data: [
				{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:0},{ y:1},{ y:0},				],
			 color: 'rgba(192,2,22,0.75)'
			}]
	});
</script>