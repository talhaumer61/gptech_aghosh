<?php 
echo '
<!-- CALENDAR-->
	<div class="col-md-9">
		<section class="panel panel-featured panel-featured-primary">
			<header class="panel-heading">
				<h2 class="panel-title">
				Event Catalogue	
				</h2>
			</header>
			<div class="panel-body">
				<div id="event_calendar"></div>
			</div>
		</section>
	</div>
<script type="application/javascript">
	
	//CALENDAR SETTINGS
	$( document ).ready( function () {
		$( "#event_calendar" ).fullCalendar( {
			header: {
				left: "title",
				right: "prev,today,next"
			},

			//DEFAULTVIEW: "BASICWEEK"
			displayEventTime : false,
			editable: false,
			firstDay: 1,
			height: 500,
			droppable: false,

			events: [
									{
					title: "Holiday",
					start: new Date( 2019, 0, 02 ),
					end: new Date( 2019, 0, 17 )
					},
							]
		} );
	} );
</script>';