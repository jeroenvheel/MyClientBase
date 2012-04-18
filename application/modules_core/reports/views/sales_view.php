<table style="width: 100%;">

    <tr>
        <th scope="col" class="first" style="width: 30%;"><?php echo $this->lang->line('item'); ?></th>
		<th scope="col" style="width: 13%; text-align: right;"><?php echo $this->lang->line('quantity'); ?></th>
        <th scope="col" style="width: 13%; text-align: right;"><?php echo $this->lang->line('unit_price'); ?></th>
		<th scope="col" style="width: 13%; text-align: right;"><?php echo $this->lang->line('subtotal'); ?></th>
        <th scope="col" style="width: 15%; text-align: right;" class="last"><?php echo $this->lang->line('sales_with_tax'); ?></th>
    </tr>

    <?php foreach ($items as $item) { ?>

        <tr>
            <td class="first"><?php echo $item->item_name; ?></td>
            <td style="text-align: right;"><?php echo format_number($item->sum_item_qty, FALSE); ?></td>
			<td style="text-align: right;"><?php echo display_currency($item->item_price, FALSE); ?></td>
			<td style="text-align: right;"><?php echo display_currency($item->sum_item_subtotal, FALSE); ?></td>
            <td class="last" style="text-align: right;"><?php echo display_currency($item->sum_item_total, FALSE); ?></td>
        </tr>

    <?php } ?>

</table>