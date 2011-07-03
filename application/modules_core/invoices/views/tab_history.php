<table style="width: 100%;">
	<tr>
		<th style="width: 10%; text-align: left;"><?php echo $this->lang->line('id'); ?></th>
		<th style="width: 20%; text-align: left;"><?php echo $this->lang->line('date'); ?></th>
		<th style="width: 20%; text-align: left;"><?php echo $this->lang->line('user'); ?></th>
		<th style="width: 50%; text-align: left;"><?php echo $this->lang->line('history'); ?></th>
	</tr>
	<?php foreach ($history as $history_item) { ?>
	<tr>
		<td style="text-align: left;"><?php echo $history_item->invoice_number; ?></td>
		<td style="text-align: left;"><?php echo format_date($history_item->invoice_history_date); ?></td>
		<td style="text-align: left;"><?php echo $history_item->username; ?></td>
		<td style="text-align: left;"><?php echo $history_item->invoice_history_data; ?></td>
	</tr>
		<?php } ?>
</table>


	<div style="clear: both;">&nbsp;</div>