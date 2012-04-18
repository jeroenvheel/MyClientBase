<table style="width: 100%;">

    <tr>
        <th scope="col" class="first" style="width: 40%;"><?php echo $this->lang->line('client'); ?></th>
        <th scope="col" style="width: 20%; text-align: right;"><?php echo $this->lang->line('invoice_count'); ?></th>
        <th scope="col" style="width: 20%; text-align: right;"><?php echo $this->lang->line('sales'); ?></th>
        <th scope="col" style="width: 20%; text-align: right;" class="last"><?php echo $this->lang->line('sales_with_tax'); ?></th>
    </tr>

    <?php foreach ($totals as $total) { ?>

        <tr>
            <td class="first"><?php echo $total->client_name; ?></td>
            <td style="text-align: right;"><?php echo $total->num_invoices; ?></td>
			<td style="text-align: right;"><?php echo display_currency($total->amt_sales); ?></td>
            <td class="last" style="text-align: right;"><?php echo display_currency($total->amt_sales_inc_tax); ?></td>
        </tr>

    <?php } ?>

		<tr style="font-weight: bold;">
			<td class="first"><?php echo $this->lang->line('total'); ?></td>
			<td style="text-align: right;"><?php echo $grand_totals['num_invoices']; ?></td>
			<td style="text-align: right;"><?php echo display_currency($grand_totals['amt_sales']); ?></td>
			<td class="last" style="text-align: right;"><?php echo display_currency($grand_totals['amt_sales_inc_tax']); ?></td>
		</tr>

</table>