<table style="width: 100%;">
    <tr>
		<th scope="col" class="first"><?php echo $this->lang->line('id'); ?></th>
		<th scope="col"><?php echo $this->lang->line('invoice_number'); ?></th>
		<th scope="col"><?php echo $this->lang->line('client'); ?></th>
		<th scope="col"><?php echo $this->lang->line('date'); ?></th>
		<th scope="col" class="last"><?php echo $this->lang->line('amount'); ?></th>
	</tr>
	<?php foreach ($invoice_payments as $payment) { ?>
		<tr>
			<td class="first"><?php echo $payment->payment_id; ?></td>
			<td><?php echo $payment->invoice_id; ?></td>
			<td><?php echo anchor('clients/form/client_id/' . $payment->client_id, $payment->client_name); ?></td>
			<td><?php echo format_date($payment->payment_date); ?></td>
			<td class="last"><?php echo display_currency($payment->payment_amount); ?></td>
		</tr>
	<?php } ?>

</table>

<?php if ($this->mdl_payments->page_links) { ?>
<div id="pagination">
	<?php echo $this->mdl_payments->page_links; ?>
</div>
<?php } ?>