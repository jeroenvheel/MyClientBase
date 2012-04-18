<script type="text/javascript">

	$(function() {
		
		$('#show_initial_stock_quantity').hide();

		$('#inventory_track_stock').change(function() {
			
			var checked = $(this).is(':checked');
			
			if (checked == 1) {
				
				$('#show_initial_stock_quantity').show();
				
			}
			
			else {
				
				$('#show_initial_stock_quantity').hide();
				
			}
			
		});

	});

</script>