<?php if($allottedClasses != 0) { 
	$record = '<div id="classwisestudents" style="height: 400px;"></div>';
} else {
	$record = '<h3 class="text text-danger text-center"><b> No Class Allotted To You..!</b></h3>';
} 

echo'<div class="row">
    <div class="col-md-12">
		<section class="panel">
			<div class="panel-body">
				'.$record.'
			</div>
		</section>
    </div>
</div>';

if($allottedClasses != 0) {?>
<script type="application/javascript">
	//STUDENT LAST EXAM MARK GRAPH
	Highcharts.chart('classwisestudents', {
		chart: {
			type: 'column',
			backgroundColor: 'transparent'
		},
		title: {
			text: 'Class Wise Students'
		},
		xAxis: {
			categories: [
				<?php
				$classid = array();
				$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE class_status = '1' AND is_deleted != '1'
													AND class_id IN (".$allottedClasses.")
													ORDER BY class_id ASC");
				while($value_cls = mysqli_fetch_array($sqllmscls)) {
					$classid[] = $value_cls['class_id'];
					echo '"'.$value_cls['class_name'].'",';
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
			$pre = 0;
			$primary = 0;
			$middle = 0;
			$high = 0;
			foreach($classid as $id){
				$sqllmsstudents	= $dblms->querylms("SELECT COUNT(std_id) as total
													FROM ".STUDENTS."
													WHERE std_id != '' AND std_status = '1' AND id_class = '".$id."' AND is_deleted != '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' $query_gender ");
				$value_std = mysqli_fetch_array($sqllmsstudents);
				if($id <= 3){
					$pre = $pre + $value_std['total'];

				} elseif($id > 3 && $id <= 8){

					$primary = $primary + $value_std['total'];

				} elseif($id > 8 && $id <= 11){

					$middle = $middle + $value_std['total'];
					
				} elseif($id > 11 ){

					$high = $high + $value_std['total'];
					
				}
				echo '{y:'.$value_std['total'].'},';
			}
			?>
		]
    }]
	});
	
	$( document ).ready( function () {
		$( '#event_calendar' ).fullCalendar( {
			header: {
				left: 'title',
				right: 'prev,today,next'
			},
			//defaultView: 'basicWeek',
			displayEventTime: false,
			editable: false,
			firstDay: 1,
			height: 550,
			droppable: false,
			events: [
				 {
					title: "Holiday",
					start: new Date( 2019, 0, 02),
					end: new Date( 2019, 0, 17 )
					},
				 {
					title: "My Event",
					start: new Date( 2019, 6, 24 ),
					end: new Date( 2019, 6, 25 )
					},
							]
		} );
	} );
</script>
<?php } ?>