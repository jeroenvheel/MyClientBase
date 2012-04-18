<table style="width: 100%;">
    <tr>
        <th scope="col" class="first"><?php echo $this->lang->line('status'); ?></th>
        <?php if (isset($sort_links)) { ?>
        <th scope="col"><?php echo $table_headers['invoice_number']; ?></th>
        <th scope="col"><?php echo $table_headers['date']; ?></th>
        <th scope="col"><?php echo $table_headers['due_date']; ?></th>
        <th scope="col" class="client"><?php echo $table_headers['client']; ?></th>
        <th scope="col" class="col_amount"><?php echo $table_headers['amount']; ?></th>
		<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
        <?php } else { ?>
        <th scope="col"><?php echo (!uri_assoc('is_quote') ? $this->lang->line('invoice_number') : $this->lang->line('quote_number')); ?></th>
        <th scope="col"><?php echo $this->lang->line('date'); ?></th>
        <th scope="col"><?php echo $this->lang->line('due_date'); ?></th>
        <th scope="col" class="client"><?php echo $this->lang->line('client'); ?></th>
        <th scope="col" class="col_amount"><?php echo $this->lang->line('amount'); ?></th>
		<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
        <?php } ?>
    </tr>
    <?php foreach ($invoices as $invoice) { ?>

    <tr class="hoverall">
        <td class="first invoice_<?php if (!$invoice->invoice_is_quote) { if ($invoice->invoice_is_overdue) { ?>4<?php } else { echo $invoice->invoice_status_type; } } ?>">
			<?php if ($invoice->invoice_is_quote) { echo $this->lang->line('quote'); } elseif ($invoice->invoice_is_overdue) { echo $this->lang->line('overdue'); } else { echo $invoice->invoice_status; } ?>
		</td>
        <td><?php echo $invoice->invoice_number; ?></td>
        <td><?php echo format_date($invoice->invoice_date_entered); ?></td>
        <td><?php echo format_date($invoice->invoice_due_date); ?></td>
        <td class="client"><?php echo anchor('clients/form/client_id/' . $invoice->client_id, character_limiter($invoice->client_name, 20)); ?></td>
        <td class="col_amount"><?php echo display_currency($invoice->invoice_total); ?></td>
        <td class="last">
            <a href="<?php echo site_url('invoices/edit/invoice_id/' . $invoice->invoice_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
            <?php echo icon('edit'); ?>
            </a>
            <a href="javascript:void(0)" class="output_link" id="<?php echo $invoice->invoice_id . ':' . $invoice->client_id . ':' . $invoice->invoice_is_quote; ?>" title="<?php echo $this->lang->line('generate'); ?>">
            <?php echo icon('generate_invoice'); ?>
            </a>
            <a href="<?php echo site_url('invoices/delete/invoice_id/' . $invoice->invoice_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
            <?php echo icon('delete'); ?>
            </a>
        </td>
    </tr>

    <?php } ?>
</table>

<?php if ($this->mdl_invoices->page_links) { ?>
<div id="pagination">
<?php echo $this->mdl_invoices->page_links; ?>
</div>
<?php } ?>