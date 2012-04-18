<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/jquery/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/jquery/fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='<?php echo base_url(); ?>assets/jquery/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/jquery/fullcalendar/gcal.js'></script>
<?php print_r($this->lang->line('buttonArr')); ?>

<script type='text/javascript'>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
<?php if($this->lang->line('calendarToday')){ ?> 			
			
			buttonText: {
				today: '<?php echo $this->lang->line('calendarToday'); ?>',
				day: '<?php echo $this->lang->line('calendarDay'); ?>',
				week:'<?php echo $this->lang->line('calendarWeek'); ?>',
				month:'<?php echo $this->lang->line('calendarMonth'); ?>'
			},
			
<?php }	
				

	if($this->lang->line('months')) {
		
		echo "monthNames: [";
		
		foreach($this->lang->line('months') as $month){
			
			echo '"' . $month . '",';
		
		}
	
		echo "],";
	}
	
	if($this->lang->line('monthsShort')) {
		
		echo "monthNamesShort: [";
		
		foreach($this->lang->line('monthsShort') as $monthShort) {
			
			echo '"' . $monthShort .'",';
		}
		
		echo "],";
	
	}					
	
	if($this->lang->line('days')) {
		
		echo "dayNames: [";
		
		foreach($this->lang->line('days') as $day) {
			
			echo '"' . $day .'",';
		}
		
		echo "],";
	
	}			
	if($this->lang->line('daysShort')) {
		
		echo "dayNamesShort: [";
		
		foreach($this->lang->line('daysShort') as $dayShort) {
			
			echo '"' . $dayShort .'",';
		}
		
		echo "],";
	
	}	

	
?>

			editable: false,

			height: 350,
			
			eventSources:[

				{
					url: "calendar/jquery_get_invoices/overdue",
          color: 'red',
          textColor: 'white'
				},
				{
					url: "calendar/jquery_get_invoices/open",
					color: 'blue',
					textColor: 'white'
				},
				{
					url: "calendar/jquery_get_invoices/quotes",
					color: 'green',
					textColor: 'white'
				},				


			],

			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}

		});

	});

</script>

<style type='text/css'>

	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>