<table style="width: 100%;" class="hover_links">
		<tr>
            <th scope="col" class="first"><?php echo $this->lang->line('status'); ?></th>
			<th scope="col" class="first"><?php echo ($this->uri->segment(2) <> 'quotes') ? $this->lang->line('invoice_number') : $this->lang->line('quote_number'); ?></th>
			<th scope="col"><?php echo $this->lang->line('date'); ?></th>
			<th scope="col" class="client"><?php echo $this->lang->line('client'); ?></th>
			<th scope="col" class="col_amount"><?php echo $this->lang->line('amount'); ?></th>
			<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
		</tr>
		<?php foreach ($invoices as $invoice) { ?>

			<tr id="invoice_<?php echo $invoice->invoice_id; ?>" class="hoverall">
                <td class="first invoice_<?php if ($invoice->invoice_is_overdue) { ?>4<?php } else { echo $invoice->invoice_status_type; } ?>"><?php echo ($invoice->invoice_is_overdue) ? $this->lang->line('overdue') : $invoice->invoice_status; ?></td>
				<td class="first"><?php echo $invoice->invoice_number; ?></td>
				<td><?php echo format_date($invoice->invoice_date_entered); ?></td>
				<td class="client"><?php echo character_limiter($invoice->client_name, 25); ?></td>
				<td class="col_amount"><?php echo display_currency($invoice->invoice_total); ?></td>
				<td class="last">
					<a href="javascript:void(0)" class="output_link" id="<?php echo $invoice->invoice_id . ':' . $invoice->client_id . ':' . $invoice->invoice_is_quote; ?>"><?php echo $this->lang->line('generate'); ?></a> |
					<?php echo anchor('client_center/view_invoice/invoice_id/' . $invoice->invoice_id, $this->lang->line('view')); ?><?php if ($invoice->invoice_status_type == 1) { ?>
					<?php if ($payment_link = $this->lib_output->payment_link($invoice)) { echo ' | ' . $payment_link; ?><?php }} ?>
				</td>
			</tr>
		<?php } ?>
</table>

<?php if ($this->mdl_invoices->page_links) { ?>
<div id="pagination">
	<?php echo $this->mdl_invoices->page_links; ?>
</div>
<?php } ?>