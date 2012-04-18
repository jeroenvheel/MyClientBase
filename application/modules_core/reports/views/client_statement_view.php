<table style="width: 100%;">

    <tr>
        <th scope="col" class="first" style="width: 25%;"><?php echo $this->lang->line('client'); ?></th>
        <th scope="col" style="width: 10%;"><?php echo $this->lang->line('invoice_number'); ?></th>
        <th scope="col" style="width: 15%;"><?php echo $this->lang->line('invoice_date'); ?></th>
        <th scope="col" style="width: 10%;"><?php echo $this->lang->line('due_date'); ?></th>
        <th scope="col" style="width: 15%; text-align: right;"><?php echo $this->lang->line('total'); ?></th>
        <th scope="col" style="width: 15%; text-align: right;"><?php echo $this->lang->line('paid'); ?></th>
        <th scope="col" class="last" style="width: 10%; text-align: right;"><?php echo $this->lang->line('balance'); ?></th>
    </tr>

    <?php foreach ($invoices as $invoice) { ?>

        <tr <?php if ($invoice->invoice_is_quote) { ?>style="font-style: italic;"<?php } ?>>
            <td class="first"><?php echo $invoice->client_name; ?></td>
            <td><?php echo $invoice->invoice_number; ?></td>
            <td><?php echo format_date($invoice->invoice_date_entered); ?></td>
            <td><?php echo format_date($invoice->invoice_due_date); ?></td>
            <td style="text-align: right;"><?php echo display_currency($invoice->invoice_total); ?></td>
            <td style="text-align: right;"><?php echo display_currency($invoice->invoice_paid); ?></td>
            <td class="last" style="text-align: right;"><?php echo display_currency($invoice->invoice_balance); ?></td>
        </tr>

    <?php } ?>

    <tr style="font-weight: bold;">
        <td class="first"><?php echo $this->lang->line('total'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="text-align: right;"><?php echo display_currency($totals['total_invoice']); ?></td>
        <td style="text-align: right;"><?php echo display_currency($totals['total_paid']); ?></td>
        <td class="last" style="text-align: right;"><?php echo display_currency($totals['total_balance']); ?></td>
    </tr>

</table>