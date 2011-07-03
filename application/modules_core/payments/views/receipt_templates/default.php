<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			<?php echo $this->lang->line('payment_receipt'); ?>
		</title>
		<style type="text/css">

			body {
				font-family: Verdana, Geneva, sans-serif;
				margin-left: 35px;
				margin-right: 45px;
			}

			th {
				border: 1px solid #666666;
				background-color: #D3D3D3;
			}

		</style>
	</head>
	<body>

		<table width="100%">
			<tr>

				<td width="40%" valign="top">
					<?php echo invoice_to_client_name($invoice); ?><br />
					<?php echo invoice_to_address($invoice); ?><br />
					<?php if (invoice_to_address_2($invoice)) { echo invoice_from_address_2($invoice) . '<br />'; } ?>
					<?php echo invoice_to_city_state_zip($invoice); ?>
				</td>

				<td width="60%" valign="top">
					<h1 style="text-align: right;"><?php echo $this->lang->line('payment_receipt'); ?></h1>
				</td>

			</tr>
			
		</table>

		<br />

		<table width="100%">
			<tr>
				<th style="width: 20%;"><?php echo $this->lang->line('date'); ?></th>
				<th style="width: 20%;"><?php echo $this->lang->line('invoice_number'); ?></th>
				<th style="width: 45%;"><?php echo $this->lang->line('notes'); ?></th>
				<th style="width: 15%;"><?php echo $this->lang->line('paid'); ?></th>
			</tr>
			<?php foreach ($invoice_payments as $payment) { ?>
			<tr>
				<td style="text-align: center;"><?php echo format_date($payment->payment_date); ?></td>
				<td style="text-align: center;"><?php echo $invoice->invoice_number; ?></td>
				<td><?php echo nl2br($payment->payment_note); ?></td>
				<td><div style="text-align: right; margin-right: 10px;"><?php echo display_currency($payment->payment_amount); ?></div></td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="3"><div style="text-align: right;"><?php echo $this->lang->line('total'); ?></div></td>
				<td><div style="text-align: right; margin-right: 10px;"><?php echo display_currency($invoice->invoice_paid); ?></div></td>
			</tr>
		</table>

	</body>
</html>