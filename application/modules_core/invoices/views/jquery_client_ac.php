<script type="text/javascript">

    $(function() {

		$('#client_id_autocomplete_label').each(function() {
			var autoCompeleteElement = this;
			$(this).autocomplete({source:'<?php echo site_url('clients/jquery_lookup'); ?>',
				minLength: 2,
				select: function(event, ui) {
					var selectedObj = ui.item;
					$(autoCompeleteElement).val(selectedObj.label);
					$('#client_id_autocomplete_hidden').val(selectedObj.value);
					return false;
				}
			});
		});

	});

</script>