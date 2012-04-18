<script type="text/javascript">

	$().ready(function() {

		$('.hover_links').hover(function() {}, function() {$('.actions').hide();});

		$('.hoverall').hover(
		function() {
			$('.actions').hide();
			$('#actions_' + $(this).attr('id')).show();
		});

	});

</script>