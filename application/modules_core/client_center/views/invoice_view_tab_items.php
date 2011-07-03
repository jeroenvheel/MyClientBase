<table style="width: 100%;">

	<tr>
		<th scope="col" class="first" style="width: 25%;"><?php echo $this->lang->line('item_name'); ?></th>
		<th scope="col" style="width: 35%;"><?php echo $this->lang->line('item_description'); ?></th>
		<th scope="col" style="width: 10%;"><?php echo $this->lang->line('quantity'); ?></th>
		<th scope="col"  style="width: 10%;"><?php echo $this->lang->line('unit_price'); ?></th>
		<th scope="col" style="width: 10%;"><?php echo $this->lang->line('taxable'); ?></th>
		<th scope="col" class="last" style="width: 10%;"><?php echo $this->lang->line('amount'); ?></th>
	</tr>

	<?php foreach ($invoice_items as $invoice_item) { ?>
		<tr>
			<td class="first"><?php echo $invoice_item->item_name; ?></td>
			<td><?php echo character_limiter($invoice_item->item_description, 40); ?></td>
			<td><?php echo number_format($invoice_item->item_qty, 2); ?></td>
			<td><?php echo display_currency($invoice_item->item_price); ?></td>
			<td><?php if ($invoice_item->is_taxable) { echo icon('check'); } ?></td>
			<td class="last"><?php echo display_currency($invoice_item->item_subtotal); ?></td>
		</tr>
	<?php } ?>

</table>