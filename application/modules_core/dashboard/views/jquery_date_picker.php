<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({ changeYear: true, changeMonth: true, dateFormat: '<?php echo $this->mdl_mcb_data->setting('default_date_format_picker'); ?>' });
		$(".datepicker").datepicker({ changeYear: true, changeMonth: true, dateFormat: '<?php echo $this->mdl_mcb_data->setting('default_date_format_picker'); ?>' });
		$("#datepicker").mask("<?php echo $this->mdl_mcb_data->setting('default_date_format_mask'); ?>");
		$(".datepicker").mask("<?php echo $this->mdl_mcb_data->setting('default_date_format_mask'); ?>");
	});
</script>