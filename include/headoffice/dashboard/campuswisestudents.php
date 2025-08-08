<div class="row">
    <div class="col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div id="classwisestudents" style="height: 400px;"></div>
			</div>
		</section>
    </div>
</div>
<script type="application/javascript">
	//STUDENT LAST EXAM MARK GRAPH
	Highcharts.chart('classwisestudents', {
		chart: {
			type: 'column',
			backgroundColor: 'transparent'
		},
		title: {
			text: 'Campus Wise Students'
		},
		xAxis: {
			categories: [
<?php
$campusid = array();
$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code 
									FROM ".CAMPUS."
									WHERE campus_status = '1'
									ORDER BY campus_id ASC");
while($value_camp = mysqli_fetch_array($sqllmscampus)) {
	$campusid[] = $value_camp['campus_id'];
	echo '"'.$value_camp['campus_code'].'",';
}
?>
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
<?php
foreach($campusid as $id){
$sqllmsstudents	= $dblms->querylms("SELECT COUNT(std_id) as total
									FROM ".STUDENTS."
									WHERE std_id != '' AND id_campus = '".$id."'");
$value_std = mysqli_fetch_array($sqllmsstudents);
	echo '{y:'.$value_std['total'].'},';
}
?>
		]
    }]
	});
</script>