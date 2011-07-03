<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $this->lang->line('invoice_summary_report'); ?></title>
		<style type="text/css">

			body {
				margin-left: 35px;
				margin-right: 45px;
				font-size: 80%;
			}

			th {
				border: 1px solid #666666;
				background-color: #D3D3D3;
			}

			h2 {
				margin-bottom: 0px;
			}

			p.notop {
				margin-top: 0px;
			}

		</style>
	</head>
	<body>

		<h1><?php echo $this->lang->line('invoice_summary_report'); ?></h1>

		<table style="width: 100%;">
			<tr style="text-align: right;">
				<th><?php echo $this->lang->line('item_subtotal'); ?></th>
				<th><?php echo $this->lang->line('item_tax'); ?></th>
				<th><?php echo $this->lang->line('subtotal'); ?></th>
				<th><?php echo $this->lang->line('invoice_tax'); ?></th>
				<th><?php echo $this->lang->line('shipping'); ?></th>
				<th><?php echo $this->lang->line('discount'); ?></th>
				<th><?php echo $this->lang->line('paid'); ?></th>
				<th><?php echo $this->lang->line('total'); ?></th>
				<th><?php echo $this->lang->line('balance'); ?></th>
			</tr>
			<tr style="text-align: right;">
				<td><?php echo display_currency($totals['invoice_item_subtotal']); ?></td>
				<td><?php echo display_currency($totals['invoice_item_tax']); ?></td>
				<td><?php echo display_currency($totals['invoice_subtotal']); ?></td>
				<td><?php echo display_currency($totals['invoice_tax']); ?></td>
				<td><?php echo display_currency($totals['invoice_shipping']); ?></td>
				<td><?php echo display_currency($totals['invoice_discount']); ?></td>
				<td><?php echo display_currency($totals['invoice_paid']); ?></td>
				<td><?php echo display_currency($totals['invoice_total']); ?></td>
				<td><?php echo display_currency($totals['invoice_balance']); ?></td>
			</tr>
		</table>

		<br /><br />

		<table style="width: 100%;">
			<tr style="text-align: left;">
				<th><?php echo $this->lang->line('id'); ?></th>
				<th><?php echo $this->lang->line('date'); ?></th>
				<th><?php echo $this->lang->line('client'); ?></th>
				<th style="text-align: right;"><?php echo $this->lang->line('total'); ?></th>
				<th style="text-align: right;"><?php echo $this->lang->line('paid'); ?></th>
				<th style="text-align: right;"><?php echo $this->lang->line('balance'); ?></th>
				<th><?php echo $this->lang->line('status'); ?></th>
			</tr>
			<?php foreach ($invoices as $invoice) { ?>
			<tr>
				<td><?php echo $invoice->invoice_number; ?></td>
				<td><?php echo format_date($invoice->invoice_date_entered); ?></td>
				<td><?php echo $invoice->client_name; ?></td>
				<td style="text-align: right;"><?php echo display_currency($invoice->invoice_total); ?></td>
				<td style="text-align: right;"><?php echo display_currency($invoice->invoice_paid); ?></td>
				<td style="text-align: right;"><?php echo display_currency($invoice->invoice_balance); ?></td>
				<td><?php echo $invoice->invoice_status; ?></td>
			</tr>
				<?php } ?>
		</table>

	</body>
</html>